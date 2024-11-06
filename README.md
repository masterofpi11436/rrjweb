# rrjweb
Source code is on github. 

In order to download and run the framework locally; the tools git and composer are required for download. XAMPP is used for the MySQL database, any MySQL database can be used.

# How to Run the Application on a Local Environment (Windows)
Ensure XAMPP, Git, and Composer are installed. The latest versions are recommended.

1. Clone the repository where the application is stored
    command: git clone <repository-url>

2. Create the Environment File
    Copy the .env.example file to create a new .env file
    If using a different MySQL database

3. Install Dependencies
    Install PHP dependencies using Composer: composer install

4. Generate the Application Key
    Run the following command to generate an application key: php artisan key:generate

5. Ensure your database is up and running
    If using XAMPP, make sure Apache and MySQL is running

6. Run Migrations and Seeders
    Run the following commands to set up the database structure and seed sample data:
        php artisan migrate
        php artisan db:seed

7. Serve the application (Start the application)
    Start the Laravel Development server with the command(This is will run it locally):
        php artisan serve

8. Open the browser to view the application
    Go to the web page: http://localhost:8000

git pull origin main
Copy the .env file from the .env.example file
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
