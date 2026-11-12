<?php
/**
 * Small, server-side protections for the portfolio contact form.
 * No CAPTCHA, external API, database or new configuration keys required.
 */

function portfolioContactStart(): void
{
    if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
        $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'secure' => $https,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        if (!@session_start()) {
            error_log('Portfolio contact: PHP session could not be started');
            return;
        }
    }

    if (session_status() !== PHP_SESSION_ACTIVE) {
        error_log('Portfolio contact: PHP session unavailable');
        return;
    }

    if (empty($_SESSION['portfolio_contact_token'])) {
        $_SESSION['portfolio_contact_token'] = bin2hex(random_bytes(24));
    }
    if (!isset($_SESSION['portfolio_contact_opened'])) {
        $_SESSION['portfolio_contact_opened'] = microtime(true);
    }
}

function portfolioContactToken(): string
{
    return session_status() === PHP_SESSION_ACTIVE
        ? (string) ($_SESSION['portfolio_contact_token'] ?? '')
        : '';
}

/**
 * Guard against cross-site submissions, replay, and submissions made instantly.
 * On a failed check, retain the form token so a real visitor can try again.
 */
function portfolioContactCheckForm($submittedToken): string
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        return 'The contact form is temporarily unavailable. Please email contact@imshivam.com directly.';
    }

    $expected = portfolioContactToken();
    if ($expected === '' || !is_string($submittedToken) ||
        !hash_equals($expected, $submittedToken)) {
        return 'Your form session has expired. Please refresh the page and try again.';
    }

    $opened = (float) ($_SESSION['portfolio_contact_opened'] ?? 0);
    if ($opened <= 0 || microtime(true) - $opened < 3.0) {
        return 'Please take a moment to review your message, then try sending it again.';
    }

    return '';
}

/**
 * Record contact POST attempts by IP in private temporary files.
 * Limits: 5 attempts/15 minutes and 15 attempts/24 hours.
 * Files contain timestamps, not email addresses, messages, or IPs.
 * If storage is unavailable, fall back to session-based limiting and log it.
 */
function portfolioContactRateLimited(): bool
{
    $now = time();
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $ip = is_string($ip) && filter_var($ip, FILTER_VALIDATE_IP)
        ? $ip
        : 'unknown';
    $directory = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR)
        . DIRECTORY_SEPARATOR . 'imshivam-contact-rate-limit';

    if (!is_dir($directory) && !@mkdir($directory, 0700) && !is_dir($directory)) {
        error_log('Portfolio contact: rate limit directory unavailable; using session fallback');
        return portfolioContactSessionLimit($now);
    }

    $file = $directory . DIRECTORY_SEPARATOR . hash('sha256', $ip) . '.json';
    $handle = @fopen($file, 'c+');
    if ($handle === false) {
        error_log('Portfolio contact: rate limit file unavailable; using session fallback');
        return portfolioContactSessionLimit($now);
    }

    @chmod($file, 0600);
    if (!@flock($handle, LOCK_EX)) {
        fclose($handle);
        error_log('Portfolio contact: rate limit lock unavailable; using session fallback');
        return portfolioContactSessionLimit($now);
    }

    rewind($handle);
    $stored = stream_get_contents($handle);
    $history = json_decode(is_string($stored) ? $stored : '', true);
    if (!is_array($history)) {
        $history = [];
    }

    $history = array_values(array_filter($history, static function ($value) use ($now) {
        return is_int($value) && $value <= $now && $value > $now - 86400;
    }));

    $recent = 0;
    foreach ($history as $time) {
        if ($time > $now - 900) {
            $recent++;
        }
    }

    $blocked = $recent >= 5 || count($history) >= 15;
    if (!$blocked) {
        $history[] = $now;
        rewind($handle);
        ftruncate($handle, 0);
        fwrite($handle, json_encode($history));
        fflush($handle);
    }

    flock($handle, LOCK_UN);
    fclose($handle);

    // Opportunistically delete expired files without slowing every request.
    if (random_int(1, 250) === 1) {
        $expired = glob($directory . DIRECTORY_SEPARATOR . '*.json');
        if (is_array($expired)) {
            foreach (array_slice($expired, 0, 150) as $oldFile) {
                if (is_file($oldFile) && @filemtime($oldFile) < $now - 172800) {
                    @unlink($oldFile);
                }
            }
        }
    }

    return $blocked;
}

function portfolioContactSessionLimit(int $now): bool
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        return false;
    }

    $history = $_SESSION['portfolio_contact_attempts'] ?? [];
    if (!is_array($history)) {
        $history = [];
    }
    $history = array_values(array_filter($history, static function ($value) use ($now) {
        return is_int($value) && $value > $now - 86400 && $value <= $now;
    }));

    $recent = count(array_filter($history, static function ($value) use ($now) {
        return $value > $now - 900;
    }));

    $blocked = $recent >= 5 || count($history) >= 15;
    if (!$blocked) {
        $history[] = $now;
    }
    $_SESSION['portfolio_contact_attempts'] = $history;
    return $blocked;
}

function portfolioContactRotate(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        $_SESSION['portfolio_contact_token'] = bin2hex(random_bytes(24));
        $_SESSION['portfolio_contact_opened'] = microtime(true);
    }
}
