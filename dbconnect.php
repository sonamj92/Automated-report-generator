<?php

$accounts = mysql_connect("localhost", "root", "")
or die(mysql_error());

mysql_select_db("kelson_test", $accounts);

$sql = "Insert into kelson_test.test (beds, baths, area, price, deposit) values ('1', '1' , '1', '1','1' )";

mysql_query($sql, $accounts);
?>