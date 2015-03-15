#!/bin/sh

php app/console doc:data:drop -q --force --env=$1;
php app/console doc:data:create --env=$1;
php app/console doc:mig:mig -n -q --env=$1;
php app/console doc:fix:load -n -q --env=$1;
