# Development & Deployment Guide

## 🛠️ Development Setup

### Prerequisites
- PHP 7.4+ with mail() function support
- Web server (Apache/Nginx) with mod_rewrite
- Node.js 14+ (for build tools)
- Git

### Local Development

1. **Clone and Setup**
   ```bash
   git clone https://github.com/spatsariya/portfolio-website.git
   cd portfolio-website
   npm install
   ```

2. **Start Development Server**
   ```bash
   # Using PHP built-in server
   npm start
   # or
   php -S localhost:8000
   
   # Using Apache/XAMPP
   # Place files in htdocs/portfolio-website
   ```

3. **Development Workflow**
   ```bash
   # Install dependencies
   npm install
   
   # Start development
   npm run dev
   
   # Build for production
   npm run build
   
   # Optimize images
   ./optimize-images.sh
   ```

## 🚀 Deployment

### Production Build
```bash
# Create optimized build
./build.sh

# Deploy build folder contents to web server
rsync -av build/ user@server:/var/www/html/
```

### Server Configuration

#### Apache (.htaccess included)
- Ensure mod_rewrite is enabled
- URL rewriting handles clean URLs
- Error pages configured

#### Nginx
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/html;
    index index.php;

    # Clean URLs
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP processing
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Error pages
    error_page 404 /404.php;
    error_page 500 502 503 504 /500.php;
}
```

### Email Configuration

#### PHP mail() (Simple)
```php
// In process-form-simple.php
$to = "your-email@domain.com";
```

#### SMTP (PHPMailer)
```php
// In process-form-phpmailer.php
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'your-email@gmail.com';
$mail->Password = 'your-app-password';
```

## 🔧 Performance Optimization

### Image Optimization
```bash
# Optimize all images
./optimize-images.sh

# Manual optimization with ImageMagick
convert image.jpg -quality 85 -strip optimized.jpg
```

### CSS/JS Minification
```bash
# Build with minification
npm run build

# Manual minification
npm run minify-css
npm run minify-js
```

### Caching Headers
Add to .htaccess:
```apache
# Browser caching
<IfModule mod_expires.c>
    ExpiresActive on
    ExpiresByType text/css "access plus 1 year"
    ExpiresByType application/javascript "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
</IfModule>
```

## 🧪 Testing

### Local Testing
1. Test all form submissions
2. Verify responsive design on different devices
3. Check animation performance
4. Test error pages (404, 500)

### Production Checklist
- [ ] All images optimized and loading
- [ ] Contact form working with correct email
- [ ] Clean URLs functioning
- [ ] Error pages working
- [ ] SSL certificate installed
- [ ] Performance optimized (GTMetrix/PageSpeed)
- [ ] Cross-browser testing complete

## 🐛 Troubleshooting

### Common Issues

**Contact form not working:**
- Check PHP mail() configuration
- Verify SMTP settings for PHPMailer
- Check server error logs

**Clean URLs not working:**
- Ensure mod_rewrite is enabled
- Check .htaccess file permissions
- Verify RewriteBase in .htaccess

**Images not loading:**
- Check file paths and permissions
- Verify image files exist
- Test image optimization didn't corrupt files

### Debug Mode
Enable debug mode in development:
```php
// Add to top of PHP files
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

## 📊 Monitoring

### Analytics
- Google Analytics implementation
- Performance monitoring
- Error tracking

### Maintenance
- Regular backups
- Security updates
- Performance monitoring
- Broken link checking

## 🔐 Security

### Best Practices
- Keep PHP updated
- Validate all form inputs
- Use HTTPS
- Regular security audits
- Secure file permissions (644 for files, 755 for directories)

### Form Security
- CSRF protection (if needed)
- Rate limiting
- Input sanitization (already implemented)
- Spam protection (consider adding CAPTCHA)

---

For support, contact: contact@imshivam.com
