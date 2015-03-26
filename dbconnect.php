<?php

$accounts = mysql_connect("localhost", "root", "")
or die(mysql_error());

mysql_select_db("kelson_test", $accounts);

$sql = "DROP table website1";

mysql_query($sql, $accounts);
?>