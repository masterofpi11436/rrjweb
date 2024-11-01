# rrjweb
Laravel version of the same apps with Livewire

On a new PC Instructions
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

Run on other computer in network:
php artisan serve --host=128.168.123.75 --port=8000

# Admin Dashboard
Dashboard for the IT administrator to manage all users and all applications

# Phone Directory
Lists all the extensions with some outside vendors

# Inmate Tablet
Lists the inmates that are not allowed to have a tablet. This information is used in conjuction with the 
list of inmates on the mailroom app to sort through the mail.

# Notes
Override Directly in Socialite Configuration: Instead of setting redirectUrl in each child class, configure a URL parameter based on the application. In services.php, set the redirect URL conditionally based on the application's context or an environment variable.

Alternative Solution: If the redirectUrl method continues to revert to the default, use a middleware or an interceptor on the callback route that dynamically redirects based on the request origin or user session data after authentication completes.
