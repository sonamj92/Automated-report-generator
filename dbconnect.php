<?php

$user = 'root';
$pass = '';
$db = 'kelson_test';

$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to database");

echo "Great work";
?>