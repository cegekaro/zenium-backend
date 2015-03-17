#!/bin/sh

bin/phpunit -c app --coverage-text --coverage-clover=coverage.clover
rm -f coverage.clover