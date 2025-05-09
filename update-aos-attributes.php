<?php
/**
 * Script to update certification items with animation attributes
 */

// File path
$filePath = 'certifications-section.php';

// Read the file content
$content = file_get_contents($filePath);

// Replace the certification items without data-aos attribute
$content = str_replace(
    'class="certification-item" data-aos-delay=', 
    'class="certification-item" data-aos="fade-up" data-aos-delay=', 
    $content
);

// Write the updated content back to the file
file_put_contents($filePath, $content);

echo "File updated successfully!\n";
