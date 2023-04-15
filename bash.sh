#! /bin/bash

set -ex

id

su 1000

echo "Hello $APP"

apk add --update docker openrc
rc-update add docker boot

docker image pull debian
