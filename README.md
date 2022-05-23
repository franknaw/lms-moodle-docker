#### LMS Moodle Build

This project builds an LMS moodle docker image.

The image uses supervisorD for managing both an Apache web service and an SSHD service.  Two ports are exposed, 80 and 22.

Enabling SSHD allows for managing, backups and debugging the Moodle runtime environment.


