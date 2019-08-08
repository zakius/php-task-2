#!/bin/bash
printenv | grep -v “no_proxy” >> /usr/local/env

