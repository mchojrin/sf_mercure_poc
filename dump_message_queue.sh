#!/bin/bash

while [ 1 ] ; 
do
	clear
	docker-compose exec php bin/console doctrine:query:sql "SELECT body FROM messenger_messages"
	sleep 2
done
