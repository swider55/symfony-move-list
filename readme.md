# Movie list

This is a Symfony7 application running in a Docker container, utilizing SQLite as the database. The application is designed to be easily set up and run on your local machine.

## Prerequisites

Before you start, make sure you have the following installed:
- Docker
- Docker Compose
- Composer

## Installation

1. **Clone the Repository**

   First, clone the repository from GitHub to your local machine:

   ```console
   git clone [Your-Repository-URL]
    ```

2. **Install Dependencies**

    Navigate to the project directory and run the Composer install command:

    ```console
    cd movie-list
    composer install
    ```

2. **Running the Application**

    To start the application, use Docker Compose:

    ```console
    docker compose up -d
    ```
    The -d flag is optional. Use it if you want to run the container in detached mode, allowing you to continue using the terminal.

    After the containers are up and running, the application will be accessible at http://localhost:8000/.

## Running Tests
To execute tests, use the following command after the containers are running:

```console
docker compose exec web bin/phpunit
```

## Code Style Fixing
The project includes PHP CS Fixer for maintaining code quality. To fix the coding standards in the src directory, run:
```console
vendor/bin/php-cs-fixer fix src
```