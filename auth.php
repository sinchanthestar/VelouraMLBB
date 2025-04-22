<?php
$db_host = 'localhost'; // Server Name
$db_user = 'veloura'; // Username
$db_pass = 'admin'; // Password
$db_name = 'admin'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
 die ('Failed to connect to MySQL: ' . mysqli_connect_error()); 
}
?>