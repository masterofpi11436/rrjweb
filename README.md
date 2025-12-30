# rrjweb

In order to download and run the framework locally; the tools git, composer, node.js for npm, and XAMPP is used for the MySQL database

git pull origin main
Create the .env file from the .env.example file
composer install
npm install
php artisan key:generate
sudo /etc/init.d/apache2 stop
sudo /opt/lampp/lampp start
https://localhost/phpmyadmin
php artisan migrate
php artisan migrate:refresh
php artisan db:seed
php artisan migrate:refresh --seed

# Admin Dashboard
Dashboard for the IT administrator to manage all users and all applications.

# Phone Directory
Lists all the extensions with some outside vendor numbers

# Policy
Search through the RRJ's policies to find specific policy based on string search. Admins can upload and remove policies.
Public users are able to search through policies.

# Vehicle Repair Tracker
Maintenance departments online vehicle repair tracker. There is a VFM admin and tech version. Admin can edit and delete whereas Tech cannot

# ICS
List of inmates who are restricted from getting tablets. List is maintained by ICS staff and the mailroom, OPR, and Command Staff

# Warehouse Store
Users can submit orders to the warehouse for delivery. Users are managed by the warehouse manager but can be managed by the IT Administrator.
User, Supervisors, Proprty, Warehouse Technician, and Warehouse Supervisor are the role types.

User can submit requests to Supervisors and Property users
Supervisors can approve, edit, consolidate, and deny (delete) requests submitted to them by users.
Proprty is the same as Supervisors, but can add property items.
Warehouse Technician can approve, edit, and deny requests. Can also add or remove users, items, and create a request for 1 for 1 Exchanges.

# Jurisdiction Tracker
Tracker used by officer to log the in/out times of officers entering the facility plus other actions performed.

# Logging
Time and date of when a user logs in to any application is logged.
