# Railway Deployment Configuration

## Environment Variables Setup

When deploying to Railway, you need to properly configure the following environment variables to avoid email sending issues:

### Required Environment Variables

1. **APP_URL**: Set this to your actual Railway domain
   ```
   APP_URL=https://your-app-name.railway.app
   ```
   
2. **MAIL_EHLO_DOMAIN**: Set this to your domain to fix SMTP EHLO errors
   ```
   MAIL_EHLO_DOMAIN=your-app-name.railway.app
   ```

### Common Issues and Solutions

#### SMTP EHLO Error (501-5.5.4)
**Problem**: Email sending fails with error:
```
Expected response code "250" but got code "501", with message "501-5.5.4 HELO/EHLO argument "${RAILWAY_PUBLIC_DOMAIN}" invalid
```

**Solution**: 
1. Set `APP_URL` to your actual Railway domain (not a variable)
2. Add `MAIL_EHLO_DOMAIN` environment variable with your domain
3. Ensure the domain is accessible and valid

#### Gmail Daily Sending Limits
**Problem**: Gmail SMTP has daily sending limits for personal accounts

**Solution**: 
1. Use Gmail App Passwords (already configured)
2. For production, consider using:
   - SendGrid
   - Mailgun
   - Amazon SES
   - Other professional email services

### Railway-Specific Configuration

1. **Database**: Already configured with Railway MySQL
2. **Sessions**: Using database driver for persistence
3. **Cache**: Using database driver
4. **CORS**: Configured for Vercel frontend

### Deployment Steps

1. Set environment variables in Railway dashboard
2. Deploy the application
3. Run migrations: `php artisan migrate`
4. Test email functionality

### Testing Email Configuration

Use the debug route to test email sending:
```
GET /debug/test-email
```

This will attempt to send a test email and show any configuration issues.