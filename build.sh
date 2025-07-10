#!/bin/bash

# Build script for Shivam Patsariya Portfolio
echo "🚀 Building portfolio website..."

# Create build directory
mkdir -p build/css build/js

echo "📦 Minifying CSS files..."
# Concatenate and minify CSS
cat css/style.css css/certifications.css css/project-fixes.css > build/css/all.css

# Simple CSS minification (remove comments and extra whitespace)
sed 's|/\*[^*]*\*+\([^/*][^*]*\*+\)*/||g' build/css/all.css | \
sed 's/[[:space:]]\+/ /g' | \
sed 's/; /;/g' | \
sed 's/ {/{/g' | \
sed 's/{ /{/g' | \
sed 's/ }/}/g' | \
sed 's/} /}/g' > build/css/style.min.css

echo "📦 Minifying JavaScript files..."
# Concatenate JS files
cat js/certificate-icons.js js/certification-filter.js js/certification-init.js js/main.js > build/js/scripts.min.js

echo "🎨 Optimizing images..."
# Create optimized images directory
mkdir -p build/images

# Copy and note about image optimization
echo "Note: For production, consider using imagemin or similar tools for image optimization"
cp -r images/ build/images/

echo "📋 Creating production index.php..."
# Create production version with minified assets
sed 's|css/style.css|css/style.min.css|g' index.php | \
sed 's|css/certifications.css||g' | \
sed 's|css/project-fixes.css||g' | \
sed 's|js/main.js|js/scripts.min.js|g' > build/index.php

# Copy other necessary files
cp -r includes/ build/
cp -r vendor/ build/
cp -r document/ build/
cp certifications-section.php build/
cp process-form-simple.php build/
cp process-form-phpmailer.php build/
cp 404.php build/
cp 500.php build/
cp .htaccess build/

echo "✅ Build complete! Production files are in the 'build' directory."
echo "📊 File sizes:"
echo "Original CSS: $(du -h css/*.css | awk '{sum+=$1} END {print sum "K"}')"
echo "Minified CSS: $(du -h build/css/style.min.css | awk '{print $1}')"
echo "Original JS: $(du -h js/*.js | awk '{sum+=$1} END {print sum "K"}')"
echo "Minified JS: $(du -h build/js/scripts.min.js | awk '{print $1}')"
