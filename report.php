<?php 
class report
{
	
	function generate($string)
	
	{
		$accounts = mysql_connect("localhost", "root", "root")or die(mysql_error());
		mysql_select_db("Kelson_test", $accounts);
		
		$sql = mysql_query("SELECT DATA FROM scraped_data WHERE TIME ='$string'")or die (mysql_error());

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
