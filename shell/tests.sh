#!/bin/sh

shell/reset-db.sh dev
shell/reset-db.sh test
shell/behat-tests.sh
shell/phpunit-tests.sh
shell/reset-db.sh dev
