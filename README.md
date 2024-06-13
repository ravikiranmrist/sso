# SSO

A basic web application using Laravel and Vue.js with authentication functionalities and Single Sign-On (SSO) using social media providers.

## Prerequisites

Make sure you have the following installed on your machine:

- PHP >= 8.0
- Composer
- Node.js and npm
- MySQL or any other database supported by Laravel

## Installation Steps

1. **Clone the repository:**

2. **Install PHP dependencies:**

    ```sh
    composer install
    ```

3. **Install JavaScript dependencies:**

    ```sh
    npm install
    ```

4. **Copy `.env.example` to `.env`:**

    ```sh
    cp .env.example .env
    ```

5. **Generate the application key:**

    ```sh
    php artisan key:generate
    ```

6. **Configure the `.env` file:**

    Open the `.env` file and update the following lines with your database and social media provider credentials:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

    GOOGLE_CLIENT_ID=your-google-client-id
    GOOGLE_CLIENT_SECRET=your-google-client-secret
    GOOGLE_REDIRECT_URL=http://your-callback-url

    GITHUB_CLIENT_ID=your-github-client-id
    GITHUB_CLIENT_SECRET=your-github-client-secret
    GITHUB_REDIRECT_URL=http://your-callback-url
    ```

7. **Run database migrations:**

    ```sh
    php artisan migrate
    ```

8. **Compile the assets:**

    ```sh
    npm run dev
    ```

9. **Start the development server:**

    ```sh
    php artisan serve
    ```

    Visit `http://127.0.0.1:8000` in your browser to see the application.

## Social Login

This application supports login via Google and GitHub. To use social login, ensure that you have set up the appropriate credentials in your `.env` file.

### Google

1. Go to the [Google Developer Console](https://console.developers.google.com/).
2. Create a new project or select an existing project.
3. Navigate to the "Credentials" page and create a new OAuth 2.0 Client ID.
4. Set the authorized redirect URI to `http://your-domain.com/login/google/callback`.

### GitHub

1. Go to [GitHub Developer Settings](https://github.com/settings/developers).
2. Register a new OAuth application.
3. Set the callback URL to `http://your-domain.com/login/github/callback`.

## Additional Commands

**To run tests:**

```sh
php artisan test



This README file should help users set up and run your Laravel and Vue.js application with social authentication. Make sure to replace placeholders like `your_database`, `your_username`, `your_password`, `your-google-client-id`, `your-google-client-secret`, `your-callback-url`, `your-github-client-id`, and `your-github-client-secret` with the actual values.
