<?php

include ("dbconnect.php");
include("Scraper.php");
$scraper = new Scraper;

$web1 = ($scraper -> curl_download('http://www.bwalk.com/en-CA/Rent/Details/Alberta/Edmonton/Fairmont-Village/', 'Fairmont Village'));

$web2 = ($scraper -> curl_download('http://www.bwalk.com/en-CA/Rent/Details/Alberta/Edmonton/Meadowview-Manor/', 'Meadowview-Manor'));

$web3 = ($scraper -> curl_download('http://www.rentmidwest.com/property/village-southgate', 'Southgate'));

$finalarray ['Bwalk1'] = $web1;
$finalarray ['Bwalk2'] = $web2;
$finalarray ['Southgate'] = $web3;

$string = json_encode($finalarray);

$dbconnect = new dbconnect;
$dbconnect -> store($string);



?>