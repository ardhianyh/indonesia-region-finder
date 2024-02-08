## Installation

1. Clone the repository:

    ```
    git clone https://github.com/ardhianyh/indonesia-region-finder.git
    ```

2. Install dependencies using Composer:

    ```
    composer install
    ```

3. Copy the .env.example file and rename it to .env:

    ```
    cp .env.example .env
    ```

4. Open the .env file and fill in the database connection configuration and Raja Ongkir API Key.

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=region_finder
    DB_USERNAME=root
    DB_PASSWORD=

    RAJA_ONGKIR_API_KEY=
    ```

5. Generate an application key:

    ```
    php artisan key:generate
    ```

6. Migrate the database:

    ```
    php artisan migrate
    ```

7. Seed the database:

    ```
    php artisan db:seed
    ```

## Fetch Data 3rd Party Command

```
php artisan fetch-data-rajaongkir
```

## Running

To run the Laravel application, execute the following command:

```
php artisan serve
```

This will start a development server, and you can access the application by visiting http://localhost:8000 in your web browser.

## Live Demo

You can also access a live demo of the application at http://103.175.217.81:82/

Credentials for the live demo:

- Email: admin@admin.com
- Password: Admin123

  
If you have any feedback or questions, feel free to reach out.