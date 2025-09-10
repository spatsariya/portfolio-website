<?php
/**
 * hCaptcha Debug Script
 * This helps identify why hCaptcha verification is failing
 */

// Include configuration
if (file_exists('config.php')) {
    require_once 'config.php';
    echo "<h2>✅ Config file loaded successfully</h2>";
    echo "<p><strong>Site Key:</strong> " . HCAPTCHA_SITEKEY . "</p>";
    echo "<p><strong>Secret Key:</strong> " . substr(HCAPTCHA_SECRET, 0, 8) . "...</p>";
} else {
    echo "<h2>❌ Config file not found</h2>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hcaptcha_response = $_POST['h-captcha-response'] ?? '';
    echo "<h2>Debug Information</h2>";
    echo "<p><strong>hCaptcha Response Token:</strong> " . substr($hcaptcha_response, 0, 50) . "...</p>";
    
    if (empty($hcaptcha_response)) {
        echo "<p style='color: red;'><strong>❌ No captcha response received</strong></p>";
        exit;
    }
    
    // Verify hCaptcha
    $hcaptcha_secret = HCAPTCHA_SECRET;
    $hcaptcha_verify_url = 'https://hcaptcha.com/siteverify';
    
    $hcaptcha_data = [
        'secret' => $hcaptcha_secret,
        'response' => $hcaptcha_response,
        'remoteip' => $_SERVER['REMOTE_ADDR'] ?? ''
    ];
    
    echo "<p><strong>Verification URL:</strong> $hcaptcha_verify_url</p>";
    echo "<p><strong>Remote IP:</strong> " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown') . "</p>";
    
    $hcaptcha_options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($hcaptcha_data)
        ]
    ];
    
    $hcaptcha_context = stream_context_create($hcaptcha_options);
    $hcaptcha_result = file_get_contents($hcaptcha_verify_url, false, $hcaptcha_context);
    
    echo "<p><strong>Raw Response:</strong></p>";
    echo "<pre>" . htmlspecialchars($hcaptcha_result) . "</pre>";
    
    $hcaptcha_response_data = json_decode($hcaptcha_result, true);
    
    echo "<p><strong>Parsed Response:</strong></p>";
    echo "<pre>" . print_r($hcaptcha_response_data, true) . "</pre>";
    
    if ($hcaptcha_response_data['success']) {
        echo "<h3 style='color: green;'>✅ hCaptcha verification SUCCESSFUL!</h3>";
    } else {
        echo "<h3 style='color: red;'>❌ hCaptcha verification FAILED</h3>";
        if (isset($hcaptcha_response_data['error-codes'])) {
            echo "<p><strong>Error codes:</strong></p>";
            echo "<ul>";
            foreach ($hcaptcha_response_data['error-codes'] as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>hCaptcha Debug</title>
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
</head>
<body>
    <h1>hCaptcha Debug Tool</h1>
    <form method="POST">
        <div class="h-captcha" data-sitekey="<?php echo HCAPTCHA_SITEKEY; ?>"></div>
        <br>
        <button type="submit">Test hCaptcha</button>
    </form>
</body>
</html>
