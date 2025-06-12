# VitalUp Backend (Laravel)

## Description
VitalUp Backend is a robust Laravel-based API that powers the VitalUp health and wellness platform. It provides comprehensive user management, health tracking, and data analytics capabilities with a focus on scalability and security.

## Tech Stack
- Laravel 12.0
- PHP 8.2+
- MySQL/PostgreSQL
- Laravel Sanctum (API Authentication)
- Laravel Tinker (REPL)

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL or PostgreSQL database
- Node.js (for asset compilation)

### Setup Steps
1. Clone the repository
   ```bash
   git clone https://github.com/alghailaniyoussef/VitalUp_backend.git
   cd VitalUp_backend
   ```

2. Install dependencies
   ```bash
   composer install
   ```

3. Environment configuration
   ```bash
   cp .env.example .env
   ```

4. Generate application key
   ```bash
   php artisan key:generate
   ```

5. Configure database in `.env` file
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=vitalup
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. Run database migrations
   ```bash
   php artisan migrate
   ```

7. Seed the database (optional)
   ```bash
   php artisan db:seed
   ```

8. Start the development server
   ```bash
   php artisan serve
   ```

## API Endpoints

### Authentication
- `POST /api/register` - User registration
- `POST /api/login` - User login
- `POST /api/logout` - User logout
- `GET /api/user` - Get authenticated user

### User Management
- `GET /api/users` - List users (admin)
- `GET /api/users/{id}` - Get user details
- `PUT /api/users/{id}` - Update user profile
- `DELETE /api/users/{id}` - Delete user (admin)

### Health Data
- `GET /api/health-records` - Get user health records
- `POST /api/health-records` - Create health record
- `PUT /api/health-records/{id}` - Update health record
- `DELETE /api/health-records/{id}` - Delete health record

### Analytics
- `GET /api/analytics/dashboard` - Get dashboard data
- `GET /api/analytics/trends` - Get health trends
- `GET /api/analytics/reports` - Generate reports

## Testing

Run the test suite:
```bash
php artisan test
```

Run specific test files:
```bash
php artisan test tests/Feature/AuthTest.php
```

## Deployment

### Railway Deployment
This application is configured for deployment on Railway. The deployment process is automated through the Railway platform.

#### Environment Variables for Production
Ensure the following environment variables are set in Railway:

```env
APP_NAME=VitalUp
APP_ENV=production
APP_KEY=base64:your_generated_key
APP_DEBUG=false
APP_URL=https://vitalupbackend-production.up.railway.app

DB_CONNECTION=mysql
DB_HOST=your_railway_db_host
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=your_railway_db_password

SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls

FRONTEND_URL=https://your-vercel-domain.vercel.app
```

## Environment Variables

### Required Variables
- `APP_KEY` - Application encryption key
- `DB_*` - Database connection details
- `FRONTEND_URL` - Frontend application URL for CORS

### Optional Variables
- `MAIL_*` - Email configuration for notifications
- `CACHE_DRIVER` - Cache driver (redis, database, file)
- `QUEUE_CONNECTION` - Queue driver for background jobs
- `SESSION_DRIVER` - Session storage driver

## API Documentation

Detailed API documentation is available at `/api/documentation` when running in development mode.

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'feat: add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Related Repositories

- [VitalUp Frontend](https://github.com/alghailaniyoussef/VitalUp_frontend) - Next.js frontend application

## Support

For support and questions, please open an issue in the GitHub repository or contact the development team.
