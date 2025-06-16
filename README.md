# Play-Metin2

Play-Metin2 is a Laravel based web application used to manage accounts and features for a Metin2 private server. It provides registration with email activation, login, rankings and an item shop.

## Setup

1. Copy `.env.example` to `.env` and update your database credentials.
2. Run `composer install`.
3. Run `npm install && npm run build` to compile the assets.
4. Run `php artisan migrate`.
5. Start the development server using `php artisan serve`.

