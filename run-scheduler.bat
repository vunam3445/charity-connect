@echo off
cd /d "c:\xampp\htdocs\PMNMNC\DoAn\charity-connect"
php artisan schedule:run >> NUL 2>&1
