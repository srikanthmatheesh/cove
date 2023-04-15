#! /bin/bash

set -ex

id

su -l root 

echo "Hello $APP"

apk add --update docker openrc
rc-update add docker boot

docker image pull debian
