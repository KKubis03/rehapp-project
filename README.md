# Rehapp — Physiotherapy Management System

A web application for managing physiotherapy clinic operations, built with [Laravel 12](https://laravel.com) and PHP 8.2.

## Features

- **User authentication** — Secure login, registration, and profile management (change login, password, delete account)
- **Physiotherapists** — Create, view, edit, and delete physiotherapist records; assign services to each physiotherapist
- **Patients** — Full CRUD management of patient records with appointment history
- **Services** — Define and manage the therapy services offered by the clinic
- **Appointments** — Schedule appointments by linking a patient, a physiotherapist, and a service; query available time slots and physiotherapist-specific services dynamically

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend framework | Laravel 12 (PHP 8.2+) |
| Frontend build | Vite |
| Database (default) | SQLite (configurable to MySQL/PostgreSQL) |
| Testing | PHPUnit 11 |
| Code style | Laravel Pint |

## Requirements

- PHP >= 8.2
- Composer
- Node.js & npm
- SQLite (default) or another supported database

## Installation

```bash
# 1. Clone the repository
git clone https://github.com/KKubis03/rehapp-project.git
cd rehapp-project

# 2. Install PHP dependencies
composer install

# 3. Install JavaScript dependencies
npm install

# 4. Set up environment file
cp .env.example .env
php artisan key:generate

# 5. Create the database and run migrations
touch database/database.sqlite
php artisan migrate

# 6. Build frontend assets
npm run build
```

## Running the Application

Start all services (web server, queue worker, log watcher, and Vite dev server) with a single command:

```bash
composer run dev
```

Or run only the Laravel development server:

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

## Running Tests

```bash
composer run test
```

## Project Structure

```
app/
├── Http/Controllers/     # AppointmentController, HomeController,
│                         # PatientController, PhysiotherapistController,
│                         # ServicesController
├── Models/               # Appointment, Patient, Physiotherapist,
│                         # PhysiotherapistServices, Service, User
├── services/             # Business-logic service classes
routes/
└── web.php               # All application routes (auth-protected)
database/
└── migrations/           # Database schema migrations
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
