#!/bin/bash

clear
docker-compose exec php bin/console messenger:consume -vv
