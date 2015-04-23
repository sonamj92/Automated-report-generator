<?php 

class report
{
	function generate($id)
	
	{
		//echo ("hihihihiihihihihihihihiihihihjglsjgksjhg;aweuhte;wuhre;rhewrhek;fhe;kjrhE>KJHRA>EKJRH");
		$accounts = mysql_connect("localhost", "root", "")
			or die(mysql_error());
		mysql_select_db("Kelson_test", $accounts);
		
		$sql = mysql_query("select * from Kelson_test.scraped_data where Report_ID = $id") or die('Error: ' .mysql_error());
		
		while($query_row = mysql_fetch_assoc($sql))
		{
			foreach($query_row as $key => $value)
			{
				echo "$key: $value <br/>\n";
				if($key == "DATA")
				{
					$value = json_decode($value);
					return $value;
				}
			}
		}			
		var_dump ($sql);
		
	}
}
?>