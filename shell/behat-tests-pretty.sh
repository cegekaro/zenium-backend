#!/bin/sh

php app/console cache:clear --env=prod
bin/behat
