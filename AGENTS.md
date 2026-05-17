# AGENTS.md

## Cursor Cloud specific instructions

### Overview

This is a Laravel 12 e-commerce application ("CPX Official" - sportswear/jersey brand) with:
- **Backend**: PHP 8.3 + Laravel 12 (SQLite database)
- **Frontend**: Vite 7, Tailwind CSS v4, Alpine.js, Flowbite
- **Auth**: Laravel Breeze
- **Testing**: Pest PHP

### Running the application

Start both servers for development:

```bash
php artisan serve --host=0.0.0.0 --port=8000   # Laravel backend
npm run dev                                       # Vite frontend assets
```

Or use the Composer dev script (runs serve + queue + pail + vite concurrently):
```bash
composer dev
```

### Common commands

| Task | Command |
|------|---------|
| Lint (check) | `./vendor/bin/pint --test` |
| Lint (fix) | `./vendor/bin/pint` |
| Run tests | `php artisan test` |
| Fresh DB | `rm -f database/database.sqlite && touch database/database.sqlite && php artisan migrate` |

### Known codebase issues (pre-existing)

1. **Test failures**: All `ProfileTest` and `Auth` tests fail because `UserFactory` does not generate the required `username` field (NOT NULL constraint on `users.username`). This is a codebase bug, not an environment issue.
2. **Category slug column missing**: The `categories` migration does not create a `slug` column, but `Category` model and routes (`our-products/{category:slug}`) expect it. Adding categories to the DB will cause 500 errors on pages that render the header. The app works fine with zero categories.
3. **Database seeder broken**: `ProductSeeder` looks for a category named 'Jersey Custom' which may not exist, and relies on the slug column. Use `php artisan tinker` for manual data creation instead of `php artisan db:seed`.

### Environment notes

- **Database**: SQLite at `database/database.sqlite`. No external DB server required.
- **No Docker** infrastructure exists in this repo.
- **Storage link**: Required for product images (`php artisan storage:link`).
- **PHP extensions needed**: mbstring, xml, curl, sqlite3, zip, bcmath, tokenizer.
- After `composer install`, if you get class-not-found errors, run `composer dump-autoload`.
