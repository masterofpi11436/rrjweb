# rrjweb
Source code is on github. 

In order to download and run the framework locally; the tools git, composer, and XAMPP is used for the MySQL database

git pull origin main
Create the .env file from the .env.example file
composer install
php artisan key:generate
sudo /etc/init.d/apache2 stop
sudo /opt/lampp/lampp start
https://localhost/phpmyadmin
php artisan migrate
php artisan migrate:refresh
php artisan db:seed
php artisan migrate:refresh --seed

# Migrate one table
php artisan migrate --path=/database/migrations/2025_01_28_125006_create_test_table.php

# Drop one specific table:
php artisan tinker
Schema::dropIfExists('table_name');

# Run on other computer in network:
php artisan serve --host=128.168.123.75 --port=8000

# Clear Laravel Cache:

php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Link the storage to allow user to see documents in the storage folder
php artisan storage:link

# php.ini edits:
upload_max_filesize = 100M
post_max_size = 100M
max_file_uploads = 100

# Edited .htaccess file in public directory
php_value max_file_uploads 100

# Admin Dashboard
Dashboard for the IT administrator to manage all users and all applications

# Phone Directory
Lists all the extensions with some outside vendor numbers

# Policy
Search through the RRJ's policies to find specific policy based on string search. Admins can upload and remove policies.
Public users are able to search through policies.

# Vehicle Repair Tracker
Maintenance departments online vehicle repair tracker. There is a VFM admin and tech version. Admin can edit and delete whereas Tech cannot

# ICS
List of inmates who are restricted from getting tablets. List is maintained by ICS staff and the mailroom, OPR, and Command Staff

# Warehouse Store (In-Progress)
Users can submit orders to the warehouse for delivery. Users are managed by the warehouse manager but can be managed by the IT Administrator.
User, Supervisors, Proprty, Warehouse Technician, and Warehouse Supervisor are the role types.

User can submit requests to Supervisors and Property users
Supervisors can approve, edit, consolidate, and deny (delete) requests submitted to them by users.
Proprty is the same as Supervisors, but can add property items.
Warehouse Technician can approve, edit, and deny requests. Can also add or remove users, items, and create a request for 1 for 1 Exchanges.

New Features to be added
- Quantity needed to send alerts to the warehouse manager
- Consolidate orders sent by users to supervisors
- Status of orders submitted by Users
- Status of orders submitted by Supervisors
