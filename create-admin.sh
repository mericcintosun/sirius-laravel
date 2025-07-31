#!/bin/bash

# Filament admin kullanıcısı oluştur
php artisan make:filament-user --name="Admin" --email="admin@example.com" --password="password123"

echo "Admin kullanıcısı oluşturuldu!"
echo "Email: admin@example.com"
echo "Password: password123"
echo "Admin panel: https://your-app-name.railway.app/admin" 