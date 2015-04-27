

<?php 

class report
{
		
	function generate($timestamp)
	{
		$accounts = mysql_connect("localhost", "root", "")
			or die(mysql_error());
		mysql_select_db("Kelson_test", $accounts);
		
		$sql = mysql_query("select data from scraped_data where Timestamp = '$timestamp'") or die('Error: ' .mysql_error());
		
		while($query_row = mysql_fetch_assoc($sql))
		{
			foreach($query_row as $key => $value)
			{
				$data = $value;
			}
		}			
		
		$data = json_decode($data,true);	
		
		return($data);
	}
}
?>