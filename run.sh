#!/bin/sh
screen -dm -S pmwiki php -S 0.0.0.0:8081 -t . \
    screen -ls || exit $?
