#!/bin/bash

# set env variables
set -a
. /usr/local/env
set +a

/usr/bin/curl --silent nginx/import/$IMPORT_TOKEN
