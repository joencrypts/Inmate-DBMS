<?php
// router.php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the requested URI
$uri = $_SERVER["REQUEST_URI"];

// Remove query string if present
if (($pos = strpos($uri, '?')) !== false) {
    $uri = substr($uri, 0, $pos);
}

// Remove trailing slash if present
$uri = rtrim($uri, '/');

// If the URI is empty, serve index.php
if (empty($uri) || $uri === '/') {
    require __DIR__ . '/index.php';
    return true;
}

// Handle static files
if (preg_match('/\.(?:css|js|jpg|jpeg|png|gif|ico|map|woff|woff2|ttf|eot)$/', $uri)) {
    $file = __DIR__ . $uri;
    if (file_exists($file)) {
        // Set appropriate content type
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $content_types = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'ico' => 'image/x-icon',
            'map' => 'application/json',
            'woff' => 'application/font-woff',
            'woff2' => 'application/font-woff2',
            'ttf' => 'application/font-ttf',
            'eot' => 'application/vnd.ms-fontobject'
        ];
        if (isset($content_types[$ext])) {
            header('Content-Type: ' . $content_types[$ext]);
        }
        return false;
    }
}

// Handle PHP files
if (preg_match('/\.(?:php)$/', $uri)) {
    $file = __DIR__ . $uri;
    if (file_exists($file)) {
        // Check if the file is accessible
        if (is_readable($file)) {
            return false;
        } else {
            error_log("PHP file not readable: " . $file);
            http_response_code(403);
            echo "Access forbidden";
            return true;
        }
    }
}

// For all other requests, serve index.php
require __DIR__ . '/index.php';
return true;
?> 