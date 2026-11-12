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
The contact form is processed by `index.php` and uses PHP's `mail()` function.
It no longer needs an hCaptcha key or third-party verification service.

Protection in `includes/contact-protection.php`:
- A hidden honeypot field rejects automated submissions.
- A per-session form token and a 3-second minimum form age reduce cross-site and instant submissions.
- Per-IP throttling permits up to 5 attempts in 15 minutes and 15 attempts in 24 hours.
- Rate-limit counters are stored as timestamp-only files under the server's private temporary directory, with session fallback when that directory is unavailable.
- Required fields, email formats and message lengths are checked server-side.

**Hosting requirements:** PHP 7.4+, working sessions, permission to write temporary files for full IP throttling, and a configured PHP `mail()` transport. The secret/configuration for mail delivery must remain outside Git; `config.php` is ignored. You can set `CONTACT_EMAIL` in that file. CAPTCHA credentials are no longer used.

To test: open the contact form, wait at least 3 seconds, fill it out and submit once. Check the recipient mailbox and PHP error logs if mail delivery fails. Do not use old `mail-test.php` or `test-mail.php` routes; they were removed because unauthenticated visits could send mail.

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

## 🔎 Search Engine Optimization

The site's canonical indexable URL is **https://imshivam.com/**. The portfolio is a single-page website, so its About, Experience, Skills, Projects, and Contact anchors are **not** separate sitemap entries.

Current implementation:
- `includes/header.php` provides a unique title and description, self-referencing canonical, Open Graph/Twitter preview tags, and JSON-LD describing a `Person`, `WebSite`, and `WebPage`.
- `robots.txt` points to `https://imshivam.com/sitemap.xml`, which lists only the canonical homepage.
- `.htaccess` redirects `www` and explicit `/index.php` to the canonical home URL. Template fragments include a `noindex` response header where `mod_headers` is available.
- 404 and 500 pages set their own titles and `noindex` metadata rather than inheriting homepage metadata.
- The main heading and image alt attributes describe the visible page content.

**After deployment (requires site owner access):**
1. Open `https://imshivam.com/robots.txt` and `https://imshivam.com/sitemap.xml` and confirm HTTP 200 responses.
2. In [Google Search Console](https://search.google.com/search-console), verify ownership of the domain and submit `https://imshivam.com/sitemap.xml` once.
3. Use URL Inspection for `https://imshivam.com/` to check indexing, rendered HTML, chosen canonical, and crawlability.
4. Validate the JSON-LD using [Schema Markup Validator](https://validator.schema.org/) and audit search appearance, queries, coverage, and Core Web Vitals in Search Console.
5. Update on-page content and this metadata when your portfolio changes. Don't invent reviews, rankings, certifications, or schema fields for SEO.

**Note:** A sitemap and schema improve discoverability and interpretation; they do not guarantee indexing, rich results, rankings, or a specific Lighthouse score.

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