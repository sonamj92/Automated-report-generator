<?
function store($string, $Url)
		{
			$accounts = mysql_connect("localhost", "root", "")
			or die(mysql_error());

		mysql_select_db("kelson_test", $accounts);

		$sql = "INSERT INTO kelson_test.scraped_data_details(report_id, report_data, url) VALUES(1, '$string', '$Url')";
		if(!mysql_query($sql, $accounts))
		{
			die('Error : ' . mysql_error());
		}
		}	
?>