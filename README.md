# Library System

## Description

Simple Library Information System built using Laravel. This project is developed as part of a Laravel Environment Setup assignment.

## Requirements

* PHP
* Composer
* MySQL
* Laravel

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/xxiv-st/library-system.git
```

### 2. Enter the project directory

```bash
cd library-system
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Create the environment file

Copy the `.env.example` file and rename it to `.env`.

```bash
cp .env.example .env
```

For Windows Command Prompt, you can use:

```bash
copy .env.example .env
```

### 5. Generate the application key

```bash
php artisan key:generate
```

### 6. Configure the database

Open the `.env` file and configure the database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_system
DB_USERNAME=root
DB_PASSWORD=
```

Make sure the MySQL server is running and the `library_system` database has been created.

### 7. Run database migrations

```bash
php artisan migrate
```

### 8. Run the Laravel development server

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

## Author

Your Name
Ayyubi Wibowo Sentosa