# Play-Metin2

Play-Metin2 is a Laravel based web application used to manage accounts and features for a Metin2 private server. It provides registration with email activation, login, rankings and an item shop.

## Features

The application includes the following functionality:

- **Multi-language support** – users can switch between English, Romanian, French, German and Turkish.
- **Account management** – registration with captcha and email activation, login/logout and password change.
- **Rankings** – top players and top guilds pages with advanced filtering options.
- **Download page** – lists game clients or patches with descriptions in the selected language.
- **Static pages** – content pages resolved by slug.
- **News system** – posts with comments and the ability to like or dislike comments.
- **Gallery** – screenshots and videos with user comments plus like/dislike functionality.
- **Item shop** – shop items grouped by categories, with a featured items section (authentication required).
- **Session check** – `/check-auth` endpoint returns the authenticated state for AJAX requests.

## Setup

1. Copy `.env.example` to `.env` and update your database credentials.
2. Run `composer install`.
3. Run `npm install && npm run build` to compile the assets.
4. Run `php artisan migrate`.
5. Start the development server using `php artisan serve`.

## Development

For an all-in-one development environment that also runs the queue worker and Vite in watch mode you can use the Composer script:

```bash
composer dev
```

This starts the application server, queue listener, log viewer and the asset build process concurrently.

## Testing

Run the test suite with:

```bash
composer test
```


