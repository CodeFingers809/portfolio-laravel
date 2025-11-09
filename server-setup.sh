#!/bin/bash
# This script should be run ONCE on the server after first deployment
# to set up the necessary directories and permissions

echo "Setting up Laravel storage directories..."

# Create storage directories if they don't exist
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache/data
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set proper permissions (775 for directories, 664 for files)
chmod -R 775 storage bootstrap/cache
chmod -R 664 storage/logs/*

echo "Clearing all caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Setup complete!"
