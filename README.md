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
php artisan migrate or php artisan migrate:refresh
php artisan db:seed or php artisan migrate:refresh --seed

Run on other computer in network:
php artisan serve --host=128.168.123.75 --port=8000

# Phone Directory
Lists all the extensions with some outside vendors