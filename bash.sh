#! /bin/bash

set -ex

echo "Hello $APP"

apk add --update docker openrc
rc-update add docker boot

docker image pull debian
