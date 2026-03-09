# Jawara Travela

A travel booking application for managing tour packages, bookings, and user accounts.

**LIVE PROJECT:** https://jawaratravela.ubyi.my.id

## Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js 16 or higher
- NPM
- MySQL or PostgreSQL database

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/girindrada/jawara-travela.git
    cd jawara-travela
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install Node.js dependencies:

    ```bash
    npm install
    ```

4. Copy the environment file and configure it:

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials and other settings.

5. Generate application key:

    ```bash
    php artisan key:generate
    ```

6. Run database migrations:

    ```bash
    php artisan migrate
    ```

7. Seed the database (optional):

    ```bash
    php artisan db:seed
    ```

8. Connect to image:
    ```bash
    php artisan storage:link
    ```

## Running the Application

1. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

2. In a separate terminal, build and watch frontend assets:

    ```bash
    npm run dev
    ```

3. Open your browser and visit `http://localhost:8000`

### PHP Dependencies (Composer)

- Laravel Framework
- Spatie Laravel Permission
- Other Laravel packages as defined in `composer.json`

### JavaScript Dependencies (NPM)

- Vite
- Tailwind CSS
- Other frontend packages as defined in `package.json`
