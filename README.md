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

# No longer used

@php
    $ua = request()->header('User-Agent');
    $isEdge = str_contains($ua, 'Edg') || str_contains($ua, 'Edge');
    $isIE = str_contains($ua, 'Trident') || str_contains($ua, 'MSIE');
@endphp

@if ($isEdge || $isIE)
    <div style="position: fixed; inset: 0; display: flex; align-items: center; justify-content: center; background-color: #ef4444; color: white; text-align: center; padding: 2rem; z-index: 9999;">
        <div>
            <p style="font-size: 40px; font-weight: bold;">You have opened this link in Microsoft Edge.</p>
            <p>This application is not supported in Microsoft Edge.</p>
            <p style="font-size: 40px;">Please open Google Chrome or Firefox and use this web address:</p>
            <p style="font-size: 30px;">http://rrjapps/policy-search</p>
            <p style="margin-top: 1rem;">If you have any problems, please contact Mark in MIU at ext 6035.</p>
        </div>
    </div>
@else
    @livewire('policy.public-policy-search')
@endif
