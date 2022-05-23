
# dev
acct="678678"

ver="0.0.6"
image="lms-moodle-docker"

podman build -t $image:$ver .

podman tag $image:$ver $acct.dkr.ecr.us-gov-west-1.amazonaws.com/$image:$ver
podman tag $image:$ver $acct.dkr.ecr.us-gov-west-1.amazonaws.com/$image:latest

aws ecr get-login-password --region us-gov-west-1 | podman login --username AWS --password-stdin $acct.dkr.ecr.us-gov-west-1.amazonaws.com

podman push $acct.dkr.ecr.us-gov-west-1.amazonaws.com/$image:$ver
podman push $acct.dkr.ecr.us-gov-west-1.amazonaws.com/$image:latest

