#!/bin/bash
# Start cron in background
service cron start

# Run PHP-FPM (foreground)
php-fpm