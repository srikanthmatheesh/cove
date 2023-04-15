#! /bin/bash

set -ex

USER root

echo "Hello $APP"

apk add --update docker openrc
rc-update add docker boot

docker image pull debian
