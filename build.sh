#!/usr/bin/env bash

# create .env file
if [ ! -f .env ]
then 
	cp .env.example .env
fi

# install compoert 
composer install

# create env key
php artisan key:gen

# create storge link to public 
if [ ! -d publish/storage ]
then 
	php artisan storage:link
fi 

echo 'Environment build finish!';
