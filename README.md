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

    The .env file contains important configuration values for the application’s environment, database connection, email settings, and third-party integrations. These values are specific to each environment and allow the application to run correctly both locally and in production.

    Currently, these are the most important sections for these applications

    # Determine the values to be used for local versus production environments:
    APP_NAME: The name of the application. Default is Laravel.
    APP_ENV: The environment setting, should be local for development and production for live use.
    APP_KEY: A unique application key generated with php artisan key:generate. This key is used for encryption and security.
    APP_DEBUG: Set to true for local debugging; should be false in production.
    APP_TIMEZONE: Sets the timezone, default is UTC.
    APP_URL: The base URL of the application, typically http://localhost for local development.

    # This is for determining the values for the database connection. IT MUST BE MySQL
    DB_CONNECTION: Specifies the database driver, mysql in this case.
    DB_HOST: The database host, 127.0.0.1 for local installations.
    DB_PORT: The port for the database connection, commonly 3306 for MySQL.
    DB_DATABASE: The name of the database you created for the application (e.g., laravel_app).
    DB_USERNAME: The database username, often root for local environments.
    DB_PASSWORD: The password for the database user, leave blank if not set for local.

    # Email Configuration
    MAIL_MAILER: The mail driver, smtp for Gmail.
    MAIL_HOST: The mail host, smtp.gmail.com for Gmail.
    MAIL_PORT: Port 587, common for SMTP with TLS.
    MAIL_USERNAME: The email account username.
    MAIL_PASSWORD: The password for the email account.
    MAIL_ENCRYPTION: The encryption method, typically tls for Gmail.
    MAIL_FROM_ADDRESS: The email address the application will use for outgoing emails.
    MAIL_FROM_NAME: The name displayed for outgoing emails; usually the app name, set as ${APP_NAME}.

    # Google Login Integration for allowing users to login with their google account.
    Current configuration is for rrj domain emails only.
    These values are issued by google through the google cloud console logged in as the rrjweb email.
    Username and password can be found under the MAIL_USERNAME and MAIL_PASSWORD variables under the mail section of the .env
    GOOGLE_CLIENT_ID: The Google client ID for OAuth login.
    GOOGLE_CLIENT_SECRET: The Google client secret.
    GOOGLE_REDIRECT_URI: The URL to which Google will redirect after login.

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

Clear Laravel Cache:

php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Admin Dashboard
Dashboard for the IT administrator to manage all users and all applications

# Phone Directory
Lists all the extensions with some outside vendor numbers

# Inmate Tablet
Lists the inmates that are not allowed to have a tablet. This information is used in conjuction with the 
list of inmates on the mailroom app to sort through the mail. List is maintained by ICS

# OPR List
Contains the list of names of inmates that are required to have all their mail forwarded to OPR. There is a public page to 
view the list to be seen by the mailroom staff. The protected routes are for OPR use.
