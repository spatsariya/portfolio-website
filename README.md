# Shivam Patsariya - Portfolio Website

A modern, responsive portfolio website showcasing UI/UX design expertise, professional experience, and project portfolio.

## 🌟 Features

- **Responsive Design**: Mobile-first approach ensuring optimal viewing on all devices
- **Modern UI/UX**: Clean, professional design with smooth animations
- **Interactive Elements**: Animated counters, skill progress bars, and project filters
- **Contact Form**: Multiple form processing options with email functionality
- **SEO Optimized**: Proper meta tags, Open Graph, and Twitter Card support
- **Performance Focused**: Optimized images and lazy loading

## 🛠️ Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP
- **Libraries**: 
  - AOS (Animate On Scroll)
  - Font Awesome Icons
  - Google Fonts (Poppins)
- **Server**: Apache with URL rewriting

## 📁 Project Structure

```
portfolio-website/
├── css/
│   ├── style.css                 # Main stylesheet
│   ├── certifications.css        # Certifications section styles
│   └── project-fixes.css         # Additional fixes
├── js/
│   ├── main.js                   # Main JavaScript functionality
│   ├── certificate-icons.js      # Certificate icon mappings
│   ├── certification-filter.js   # Certification filtering
│   └── certification-init.js     # Certification initialization
├── images/
│   ├── content/                  # Project and content images
│   └── *.png, *.webp           # Various site images
├── includes/
│   ├── header.php               # Site header
│   └── footer.php               # Site footer
├── vendor/
│   └── PHPMailer/               # Email library
├── document/
│   └── shivam_patsariya_resume_ux_designer.pdf
├── index.php                    # Main page
├── certifications-section.php   # Certifications content
├── process-form-simple.php     # Simple form processor
├── process-form-phpmailer.php  # PHPMailer form processor
└── .htaccess                   # URL rewriting rules
```

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- Apache web server with mod_rewrite enabled
- SMTP server for contact form (optional)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/spatsariya/portfolio-website.git
   cd portfolio-website
   ```

2. **Set up web server**
   - Place files in your web server document root
   - Ensure `.htaccess` file is present and mod_rewrite is enabled

3. **Configure contact form** (optional)
   - Update email settings in `process-form-simple.php` or `process-form-phpmailer.php`
   - For PHPMailer, configure SMTP settings

4. **Access the website**
   - Open `http://localhost/` or your domain in a web browser

## ⚙️ Configuration

### Contact Form Setup
The website includes multiple form processing options:

- **Simple PHP Mail**: `process-form-simple.php` (uses PHP's mail() function)
- **PHPMailer**: `process-form-phpmailer.php` (SMTP support)

Update the recipient email in your chosen form processor:
```php
$to = "your-email@domain.com";
```

### URL Rewriting
The `.htaccess` file provides:
- Clean URLs (removes .php extensions)
- Trailing slash removal
- Default document handling

## 🎨 Customization

### Colors
Primary colors are defined in CSS custom properties:
```css
:root {
    --primary-color: #6e57e0;
    --secondary-color: #ff6b6b;
    --dark-color: #0c0c14;
    /* ... */
}
```

### Content
- Update personal information in `index.php`
- Modify certifications in `certifications-section.php`
- Replace images in `images/` directory

## 📱 Responsive Breakpoints

- Desktop: 1200px+
- Tablet: 768px - 1199px
- Mobile: 320px - 767px

## 🔧 Development

### Local Development
1. Use a local PHP server:
   ```bash
   php -S localhost:8000
   ```

2. Or use XAMPP/WAMP/MAMP for full Apache environment

### Performance Optimization
- Images are optimized for web (WebP format where supported)
- CSS and JavaScript are modular for easy maintenance
- Lazy loading implemented for below-the-fold content

## 📄 License

This project is created by Shivam Patsariya. All rights reserved.

## 📞 Contact

- **Email**: contact@imshivam.com
- **LinkedIn**: [linkedin.com/in/shivampatsariya](https://www.linkedin.com/in/shivampatsariya/)
- **Behance**: [behance.net/shivampatsariya](https://www.behance.net/shivampatsariya)

## 🤝 Contributing

This is a personal portfolio project. If you find any issues or have suggestions, please feel free to open an issue.

---

Built with ❤️ by [Shivam Patsariya](https://imshivam.com)