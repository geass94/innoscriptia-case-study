# News Aggregator API

A comprehensive news aggregation API built with Laravel that collects articles from multiple trusted sources including NewsAPI, The Guardian, and NY Times. Search, filter, and personalize your news feed with powerful filtering and sorting capabilities.

## Features

- **Multi-source aggregation**: Automatically fetch articles from NewsAPI, The Guardian, and NY Times
- **Automated daily fetching**: Scheduled task runs daily at midnight to fetch latest news
- **Advanced filtering**: Filter articles by keyword, source, category, author, and date range
- **Personalization**: Retrieve articles based on user preferences for sources, categories, and authors
- **Pagination & sorting**: Efficiently browse through articles with customizable pagination and sorting
- **RESTful API**: Clean, intuitive endpoints following REST principles
- **Duplicate prevention**: Smart content hash-based deduplication
- **Queue Management**: Laravel Horizon for monitoring and managing background jobs
- **Interactive API Documentation**: Beautiful API docs powered by Scalar and Scribe
- **OpenAPI Specification**: Full OpenAPI 3.0 spec for integration with any tool

## Tech Stack

- **Framework**: Laravel 11.x
- **Database**: SQLite (default) / MySQL / PostgreSQL
- **API Clients**: Guzzle HTTP Client
- **Data Transfer**: Spatie Laravel Data
- **Documentation**: Scribe + Scalar
- **Queue System**: Laravel Horizon (Redis-backed)
- **Testing**: Pest PHP

## Requirements

- PHP 8.2 or higher
- Composer
- SQLite (or MySQL/PostgreSQL)
- Redis (for Laravel Horizon queue system)
- API Keys from news providers (see Configuration section)

## Installation

### 1. Clone the repository

```bash
git clone <repository-url>
cd innoscriptia-case-study
```

### 2. Install dependencies

```bash
composer install
```

### 3. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure database

The application uses SQLite by default. The database file will be created automatically.

```bash
# Create the SQLite database
touch database/database.sqlite
```

For MySQL or PostgreSQL, update the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news_aggregator
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Configure Redis

Ensure Redis is installed and running on your system:

```bash
# Check if Redis is running
redis-cli ping
# Should return: PONG
```

Update your `.env` file with Redis configuration (if needed):

```env
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
QUEUE_CONNECTION=redis
```

### 6. Run migrations

```bash
php artisan migrate
```

### 7. Configure API Keys

Obtain API keys from the following providers and add them to your `.env` file:

#### NewsAPI
- Visit: https://newsapi.org/
- Sign up for a free account
- Copy your API key

```env
NEWSAPI_KEY=your_newsapi_key_here
```

#### The Guardian
- Visit: https://open-platform.theguardian.com/access/
- Register for API access
- Copy your API key

```env
GUARDIAN_API_KEY=your_guardian_api_key_here
```

#### NY Times
- Visit: https://developer.nytimes.com/
- Create an account and register an app
- Copy your API key

```env
NYTIMES_API_KEY=your_nytimes_api_key_here
```

## Usage

### Starting the application

```bash
# Start the Laravel development server
php artisan serve
```

The application will be available at `http://localhost:8000`

In a separate terminal, start Laravel Horizon (for async queue processing):

```bash
# Start Laravel Horizon
php artisan horizon
```

Access the Horizon dashboard at `http://localhost:8000/horizon`

**Note:** If using `dispatchSync()` for testing, Horizon is not required as jobs run synchronously.

### Fetching articles

#### Manual Fetch

You can manually fetch articles from all configured news sources:

```bash
# Fetch articles with date range (recommended)
php artisan articles:fetch --from=2024-01-01 --to=2024-01-31

# Fetch articles from a specific date
php artisan articles:fetch --from=2024-01-15 --to=2024-01-15

# Fetch with additional filters
php artisan articles:fetch --from=2024-01-01 --to=2024-01-31 --keyword=technology
php artisan articles:fetch --from=2024-01-01 --to=2024-01-31 --category=business
```

**Available options:**
- `--from` - From date (YYYY-MM-DD format, required for effective fetching)
- `--to` - To date (YYYY-MM-DD format, required for effective fetching)
- `--keyword` - Search keyword (optional)
- `--category` - Filter by category (optional)

This command dispatches background jobs to fetch articles from NewsAPI, The Guardian, and NY Times.

#### Automatic Fetch

The application is configured to automatically fetch articles **daily at midnight (UTC)**. The scheduler automatically fetches articles from the previous day. See the "Automated Daily Article Fetching" section below for setup instructions.

### Running the queue worker

Since article fetching uses queued jobs, you need to run Laravel Horizon:

```bash
# Start Laravel Horizon
php artisan horizon
```

You can access the Horizon dashboard at `http://localhost:8000/horizon` to monitor your queues, jobs, and metrics.

#### Testing Mode (Synchronous Dispatch)

For testing purposes, the application uses `dispatchSync()` which runs jobs immediately without queuing. This means:
- No need to run Horizon during testing
- Jobs execute synchronously and block until complete
- Easier debugging and testing without background processes

To switch to async queues in production, update the job dispatch calls from `dispatchSync()` to `dispatch()`.

### Automated Daily Article Fetching

The application is configured to automatically fetch articles daily at midnight (UTC). The scheduler automatically fetches articles from **the previous day** using `--from` and `--to` parameters.

For example, when the scheduler runs on January 16th at midnight, it will fetch articles from January 15th.

#### Setting Up the Scheduler

To enable automatic daily fetching, add this to your server's cron:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

This cron job will run every minute and check if any scheduled tasks need to be executed.

#### Testing the Scheduler

For development and testing, you can run the scheduler manually:

```bash
# Run the scheduler in the foreground (keeps running)
php artisan schedule:work
```

Or check upcoming scheduled tasks:

```bash
# List all scheduled tasks
php artisan schedule:list
```

Or run the scheduled tasks immediately:

```bash
# Run all due tasks now
php artisan schedule:run
```

The scheduler is configured in `bootstrap/app.php` to run `articles:fetch` daily at midnight UTC with automatic date parameters for the previous day.

## API Documentation

This application includes comprehensive API documentation powered by Scribe and Scalar.

### Generating API Documentation

After making changes to the API endpoints or annotations, regenerate the documentation:

```bash
php artisan scribe:generate
```

This command will:
- Extract API information from your controllers
- Generate OpenAPI 3.0 specification
- Create interactive HTML documentation
- Generate a Postman collection

### Accessing Documentation

Once the application is running, you can access the documentation at:

#### Scalar (Modern Interactive UI)
```
http://localhost:8000/scalar
```

Features:
- Beautiful, modern interface
- Interactive API testing
- Code examples in multiple languages
- Built-in request playground
- Dark mode support

#### Scribe (Traditional Documentation)
```
http://localhost:8000/docs
```

Features:
- Comprehensive API reference
- Code examples in Bash and JavaScript
- Full endpoint descriptions
- Request/response examples

#### OpenAPI Specification
```
http://localhost:8000/docs.openapi
```

Download the raw OpenAPI 3.0 specification for use with:
- Postman
- Insomnia
- Swagger UI
- Any OpenAPI-compatible tool

#### Postman Collection
```
http://localhost:8000/docs.postman
```

Download the Postman collection for direct import into Postman.

## API Endpoints

### Articles

#### List Articles
```
GET /api/v1/articles
```

Query parameters:
- `page` - Page number (default: 1)
- `per_page` - Items per page (default: 15, max: 100)
- `sort` - Sort field: `published_at`, `created_at`, `title` (prefix with `-` for descending)
- `filter[keyword]` - Search in title, description, and content
- `filter[source]` - Filter by source: `NewsAPI`, `The Guardian`, `NY Times`
- `filter[sources][]` - Filter by multiple sources
- `filter[category]` - Filter by category
- `filter[categories][]` - Filter by multiple categories
- `filter[author]` - Filter by author
- `filter[authors][]` - Filter by multiple authors
- `filter[date_range][from]` - Start date (Y-m-d format)
- `filter[date_range][to]` - End date (Y-m-d format)

Example:
```bash
curl "http://localhost:8000/api/v1/articles?filter[keyword]=technology&sort=-published_at&per_page=10"
```

#### Get Single Article
```
GET /api/v1/articles/{id}
```

Example:
```bash
curl "http://localhost:8000/api/v1/articles/1"
```

#### Get Personalized Articles
```
POST /api/v1/articles/preferences
```

Request body:
```json
{
  "preferred_sources": ["NewsAPI", "The Guardian"],
  "preferred_categories": ["technology", "business"],
  "preferred_authors": ["John Doe"],
  "filter": {
    "keyword": "innovation",
    "date_range": {
      "from": "2024-01-01",
      "to": "2024-12-31"
    }
  },
  "per_page": 15
}
```

Example:
```bash
curl -X POST "http://localhost:8000/api/v1/articles/preferences" \
  -H "Content-Type: application/json" \
  -d '{
    "preferred_sources": ["NewsAPI"],
    "preferred_categories": ["technology"]
  }'
```

### Filter Options

#### Get Available Sources
```
GET /api/v1/sources
```

Returns a list of all available news sources.

#### Get Available Categories
```
GET /api/v1/categories
```

Returns a list of all available article categories.

#### Get Available Authors
```
GET /api/v1/authors
```

Returns a list of all available article authors.

## Development

### Running Tests

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

### Code Style

```bash
# Fix code style
./vendor/bin/pint
```

### Clearing Caches

```bash
# Clear all caches
php artisan optimize:clear

# Clear specific caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Project Structure

```
app/
├── Console/Commands/      # Artisan commands
├── Data/                  # Data objects and responses
├── DTOs/                  # Data Transfer Objects
├── Filters/               # Query filters
├── Http/
│   ├── Controllers/       # API Controllers
│   └── Requests/          # Form requests
├── Jobs/                  # Queued jobs
├── Models/                # Eloquent models
└── Services/              # Business logic services
    ├── NewsProviders/     # News provider integrations
    └── ArticleAggregatorService.php
```

## Troubleshooting

### Articles not fetching

1. Ensure API keys are correctly set in `.env`
2. Verify you're using `--from` and `--to` parameters when fetching manually:
   ```bash
   php artisan articles:fetch --from=2024-01-01 --to=2024-01-31
   ```
3. Check if using async queues: Ensure Horizon is running with `php artisan horizon`
4. Check if using sync dispatch: Jobs run immediately, check logs for errors
5. Check logs: `tail -f storage/logs/laravel.log`
6. Verify API rate limits haven't been exceeded
7. Monitor jobs in Horizon dashboard: `http://localhost:8000/horizon`

### Queue/Horizon issues

1. Ensure Redis is running: `redis-cli ping`
2. Clear failed jobs: `php artisan horizon:clear`
3. Restart Horizon: `php artisan horizon:terminate` then `php artisan horizon`
4. Check queue connection in `.env`: `QUEUE_CONNECTION=redis`
5. Verify Horizon is installed: `composer show laravel/horizon`

### Scheduler not running

1. Verify cron is set up correctly: `crontab -l` should show the schedule:run command
2. Check scheduled tasks: `php artisan schedule:list`
3. Test the scheduler manually: `php artisan schedule:run`
4. Check cron logs: `grep CRON /var/log/syslog` (Linux) or check system logs
5. Verify scheduler configuration in `bootstrap/app.php`
6. For testing, run: `php artisan schedule:work` to see real-time execution

### Documentation not updating

1. Clear configuration cache: `php artisan config:clear`
2. Regenerate documentation: `php artisan scribe:generate`
3. Clear browser cache or hard refresh (Ctrl+Shift+R)

### Database issues

```bash
# Reset database (WARNING: destroys all data)
php artisan migrate:fresh

# Run migrations
php artisan migrate

# Check migration status
php artisan migrate:status
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

- Built with [Laravel](https://laravel.com)
- Documentation powered by [Scribe](https://scribe.knuckles.wtf) and [Scalar](https://github.com/scalar/laravel)
- News sources: [NewsAPI](https://newsapi.org/), [The Guardian](https://open-platform.theguardian.com/), [NY Times](https://developer.nytimes.com/)
