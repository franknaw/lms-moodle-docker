FROM docker.io/library/centos:centos7.9.2009
LABEL maintainer = "Frank Naw <franknaw@gmail.com>"
LABEL version="0.0.6"
LABEL description="LMS Moodle Build"

#### This configuration will install from source the latest Apache HTTP server along with the Apache portable runtime.
#### PHP is also installed from source with the required moodle PHP extensions.
#### Once the build is complete then any unnecessary package is removed. This procedure reduces CVE's to zero.
#### TODO NFS Mount to EFS

### Install required packages.
RUN yum update -y
# The yum update command applies packages that have available updates.
# These CVEs registered on 5/11/2022 and are remediated by the update.
# CVE -- RHSA-2022:2191, RHSA-2022:2213
### yum update gzip zlib zlib-devel


RUN yum group install "Development Tools" -y
RUN yum install expat-devel pcre-devel libxml2 libxml2-devel sqlite sqlite-devel postgresql postgresql-devel \
    libicu libicu-devel openssl openssl-devel libcurl-devel libpng libpng-devel \
    openldap openldap-devel zlib zlib-devel \
    openssh-server -y

COPY ./assets/oniguruma-6.8.2-1.el7.x86_64.rpm /
COPY ./assets/oniguruma-devel-6.8.2-1.el7.x86_64.rpm /
COPY ./assets/libzip-0.11.2-6.el7.psychotic.x86_64.rpm /
COPY ./assets/libzip-devel-0.11.2-6.el7.psychotic.x86_64.rpm /
COPY ./assets/libsodium-1.0.18-1.el7.x86_64.rpm /
COPY ./assets/libsodium-devel-1.0.18-1.el7.x86_64.rpm /
COPY ./assets/supervisor-3.4.0-1.el7.noarch.rpm /
COPY ./assets/python-meld3-0.6.10-1.el7.x86_64.rpm /
### EPEL repo https://download-ib01.fedoraproject.org/pub/epel/7/x86_64/Packages/
RUN yum localinstall -y oniguruma-6.8.2-1.el7.x86_64.rpm oniguruma-devel-6.8.2-1.el7.x86_64.rpm \
    libzip-0.11.2-6.el7.psychotic.x86_64.rpm libzip-devel-0.11.2-6.el7.psychotic.x86_64.rpm \
    libsodium-1.0.18-1.el7.x86_64.rpm libsodium-devel-1.0.18-1.el7.x86_64.rpm \
    supervisor-3.4.0-1.el7.noarch.rpm python-meld3-0.6.10-1.el7.x86_64.rpm

#### Copy and extract Apache Http, APR and APR-Util.
COPY ./assets/httpd-2.4.53.tar.gz /
COPY ./assets/apr-1.7.0.tar.gz /
COPY ./assets/apr-util-1.6.1.tar.gz /
RUN tar xvzf ./httpd-2.4.53.tar.gz
RUN tar xvzf ./apr-1.7.0.tar.gz
RUN tar xvzf ./apr-util-1.6.1.tar.gz

### Install APR.
WORKDIR /apr-1.7.0
RUN ./configure --prefix=/httpd-2.4.53/srclib/apr
RUN make && make install

### Install APR-Util.
WORKDIR /apr-util-1.6.1
RUN ./configure --prefix=/httpd-2.4.53/srclib/apr-util --with-apr=/apr-1.7.0
RUN make && make install

### Install Apache HTTP.
WORKDIR /httpd-2.4.53
RUN ./configure --prefix=/usr/local/apache2 \
    --with-apr=/httpd-2.4.53/srclib/apr/bin/apr-1-config \
    --with-apr-util=/httpd-2.4.53/srclib/apr-util/bin/apu-1-config \
    --with-port=8080
RUN make && make install

### Copy PHP assets.
WORKDIR /
COPY ./assets/php.ini /etc/php.ini
COPY ./assets/php-7.4.29.tar.gz /
RUN tar xvzf php-7.4.29.tar.gz

### Install PHP.
WORKDIR /php-7.4.29
RUN ./configure --with-apxs2=/usr/local/apache2/bin/apxs \
    --with-pdo-pgsql --with-pgsql --with-config-file-path=/etc/php.ini \
    --enable-mbregex --enable-mbstring --enable-intl --enable-gd --enable-soap \
    --with-curl --with-xmlrpc --with-zip --with-openssl --with-zlib --enable-opcache --with-sodium
RUN make && make install

### Remove packages that are not needed anymore.
RUN yum update -y && yum group remove "Development Tools" -y \
    && yum remove kernel-headers kernel-debug-devel -y

WORKDIR /
RUN rm *.rpm *.gz

### Setup HTTP configuration
COPY ./assets/httpd.conf /usr/local/apache2/conf/httpd.conf

RUN useradd moodle
# -s /bin/bash -g moodle
RUN echo 'moodle:somepass' | chpasswd
#RUN echo 'root:Cvle5432!' | chpasswd
RUN echo 'root:somepass' | chpasswd

### setup supervisor
COPY ./assets/supervisord.conf /var/www/supervisord.conf

RUN ssh-keygen -A
COPY ./assets/sshd_config /etc/ssh/sshd_config

USER moodle
RUN ssh-keygen -f /home/moodle/.ssh/id_rsa
USER root

### Stage Moodle files.
RUN mkdir -p /var/www/html && chmod 777 /var/www
WORKDIR /var/www

COPY ./moodledata /var/www/moodledata
COPY ./moodle-baseline /var/www/html/moodle
COPY ./assets/config.php /var/www/html/moodle/config.php

RUN chmod -R 755 ./html/moodle \
    && mkdir ./moodlecache /local \
    && chmod -R 777 ./moodledata ./moodlecache /local

#RUN cat /etc/os-release
#RUN php -m
#RUN php -v
#RUN /usr/local/apache2/bin/httpd -v

EXPOSE 8080 22
CMD ["/usr/bin/supervisord"]
