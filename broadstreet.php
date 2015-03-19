<?php
			/*Passing the website to the function*/
print curl_download('http://www.rentedmonton.com/Detail.aspx?prop=d46d9fab-d7bf-43e9-bf2e-c73ee30f26a1&AspxAutoDetectCookieSupport=1');

function curl_download($Url){

         if (!function_exists('curl_init')){
                die('Curl is not installed. Install try again.');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

		$start = strpos($output, '<span id="lblMultiUnit" style="color:#000050;font-weight:bold;"><BR/>Available Suites in Complex:</span><br />');
        $end = strpos($output, '<table cellspacing="0" rules="all" border="1" id="grdSuites" style="height:50px;border-collapse:collapse;">', $start);
        $length = $end-$start;
        $output = substr($output, $start, $length);

     echo($output);
	 echo("hi");
		// $parts = preg_split('~(</?[\w][^>]*>)~', $output, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    // print_r($parts);
        //$lengthArray = count($parts);

     
			
			
			
		}

?>