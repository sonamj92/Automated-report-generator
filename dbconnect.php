<?php

$user = 'root';
$pass = '';
$db = 'kelson_test';

$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to database");

$sql = '"insert into kelson_test.website1 (no_of_bedrooms) values ('2');"';
echo ($sql);

if (!mysql_query($sql)) {
	die('Error: ' . mysql_error());
}					
echo "Great work";
?>