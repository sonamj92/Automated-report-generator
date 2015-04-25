
<?php
	include("Scraper.php");
	include ("dbconnect.php");
	include ("report.php");
	
	class Controlller
	{
	
	function callme()
	{
	$scraper = new Scraper;

	$web1 = ($scraper -> curl_download('http://www.bwalk.com/en-CA/Rent/Details/Alberta/Edmonton/Fairmont-Village/', 'Fairmont Village'));

	$web2 = ($scraper -> curl_download('http://www.bwalk.com/en-CA/Rent/Details/Alberta/Edmonton/Meadowview-Manor/', 'Meadowview-Manor'));

	$web3 = ($scraper -> curl_download('http://www.rentmidwest.com/property/village-southgate', 'Southgate'));

	$web4 = ($scraper -> curl_download('http://www.har-par.com/properties.php?PropertyID=6', 'Blue Quill Gardens'));
	
	$web5 = ($scraper -> curl_download('http://www.har-par.com/properties.php?PropertyID=141', 'Pineridge'));
	
	$web6 = ($scraper -> curl_download('http://www.rentedmonton.com/Detail.aspx?prop=d46d9fab-d7bf-43e9-bf2e-c73ee30f26a1', 'Wellington Courts'));

	$finalarray ['Bwalk1'] = $web1;
	$finalarray ['Bwalk2'] = $web2;
	$finalarray ['Southgate'] = $web3;
	$finalarray ['Blue Quill Gardens'] = $web4;
	$finalarray ['Pineridge'] = $web5;
	$finalarray ['Wellington Courts'] = $web6;
	
	$string = json_encode($finalarray);

	$dbconnect = new dbconnect;
	$dbconnect -> store($string);

	$report = new report;
	$id = "75";
	$jsontoarray = $report -> generate($id);
	print_r($jsontoarray);

	}
	}
	
	

?>
