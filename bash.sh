#! /bin/bash

set -ex

echo "Hello $APP"

curl -fsSL https://get.docker.com/ | sh



docker image pull debian
