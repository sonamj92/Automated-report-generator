<?php

class dbconnect
{	

	function store($string)
	{
		$accounts = mysql_connect("localhost", "root", "")
			or die(mysql_error());
		mysql_select_db("Kelson_test", $accounts);
		
		$sql = "Insert into Kelson_test.scraped_data(Data) values ('$string')";
		
		if(!mysql_query($sql, $accounts))
		{
			die('Error: ' .mysql_error());
		}
	}
}
?>