<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers
session_start();
$auth = $_SESSION['authenticated'];
$username = $_SESSION['authenticated_user']['username'];
if ($auth) {
    echo "<h1>Hello, {$username}</h1>";
    echo '<h4>PHP $_SESSION[\'authenticated\'] is ' . ($auth ? 'true' : 'false') . '</h4>';
} else {
    echo "<a href='index.html'>Go to Login</a>";
}