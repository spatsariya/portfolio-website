#!/bin/bash

# Image optimization script for portfolio website
echo "🖼️  Optimizing images for web..."

# Create optimized directory
mkdir -p images/optimized

# Function to optimize images (requires imagemagick)
optimize_image() {
    local input="$1"
    local output="$2"
    local quality="$3"
    
    if command -v convert &> /dev/null; then
        convert "$input" -quality "$quality" -strip "$output"
        echo "✅ Optimized: $input -> $output"
    else
        echo "⚠️  ImageMagick not found. Please install it for image optimization."
        echo "   macOS: brew install imagemagick"
        echo "   Ubuntu/Debian: sudo apt-get install imagemagick"
        cp "$input" "$output"
    fi
}

# Optimize PNG images
for img in images/*.png; do
    if [ -f "$img" ]; then
        filename=$(basename "$img" .png)
        optimize_image "$img" "images/optimized/${filename}.png" 90
    fi
done

# Optimize JPEG images
for img in images/*.jpg images/*.jpeg; do
    if [ -f "$img" ]; then
        filename=$(basename "$img")
        optimize_image "$img" "images/optimized/${filename}" 85
    fi
done

# Optimize content images
if [ -d "images/content" ]; then
    mkdir -p images/optimized/content
    
    for img in images/content/*.{png,jpg,jpeg,webp}; do
        if [ -f "$img" ]; then
            filename=$(basename "$img")
            optimize_image "$img" "images/optimized/content/${filename}" 85
        fi
    done
fi

echo "🎉 Image optimization complete!"
echo "📊 Before/After comparison:"
if [ -d "images/optimized" ]; then
    echo "Original: $(du -sh images/ | cut -f1)"
    echo "Optimized: $(du -sh images/optimized/ | cut -f1)"
fi
