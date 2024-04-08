<?php
if (!defined('HOST')) {
    define('HOST', 'localhost');
}
if (!defined('USERNAME')) {
    define('USERNAME', 'root');
}
if (!defined('PASSWORD')) {
    define('PASSWORD', '');
}
if (!defined('DATABASE')) {
    define('DATABASE', 'orit');
}

    $conn  = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
?>
