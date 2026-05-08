#!/bin/bash
# =====================================================
# CPANEL DEPLOYMENT FIX SCRIPT
# Purpose: Fix Laravel storage permissions and cache paths after upload
# =====================================================

echo "🔧 Fixing Laravel storage directories and permissions..."

# Create necessary storage directories if they don't exist
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/app/public
mkdir -p storage/logs
mkdir -p bootstrap/cache

echo "📁 Storage directories created/verified"

# Set proper permissions for storage directories
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

echo "🔐 Permissions set for storage directories"

# Clear all Laravel caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache

echo "🧹 Laravel caches cleared and rebuilt"

# Create storage link for public files
php artisan storage:link

echo "🔗 Storage link created"

# Set proper ownership (adjust 'username' to your cPanel username)
# chown -R username:username storage/
# chown -R username:username bootstrap/cache/

echo "✅ Laravel deployment fix completed!"
echo ""
echo "📋 Manual steps for cPanel:"
echo "1. Upload your files to public_html/"
echo "2. Run this script via cPanel Terminal or SSH"
echo "3. Update .env file with production settings"
echo "4. Test your application"
