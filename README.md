## 1.Clone the repository:

git clone https://github.com/kamalkrishnaa2002/billcalculator.git

## 2.Navigate into the project directory:

cd billingcalculator

## 3.Install dependencies with Composer:
composer install

## 4.Copy the .env.example file to .env and configure your environment variables & Database:
cp .env.example .env

## 5.Generate an application key:
php artisan key:generate

6.Run database migrations:
## php artisan migrate

## 7.Seed the database with sample data:
php artisan db:seed

## 8.Run server
php artisan serve
