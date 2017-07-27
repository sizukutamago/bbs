#!/bin/bash

composre install

php artisan key:generate

cp ./.env.example ./.env

vendor/bin/phinx init