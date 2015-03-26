<?php
			/*Passing the website to the function*/
print curl_download('https://www.broadstreet.ca/property/131/Merecroft+Gardens/');

function curl_download($Url){

         if (!function_exists('curl_init')){
                die('Curl is not installed. Install try again.');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

		$start = strpos($output, '<h3 class="h4">Property Details</h3>');
        $end = strpos($output, '</div><!-- property_details_content -->', $start);
        $length = $end-$start;
        $output = substr($output, $start, $length);

		echo($output);
		
				
		}

?>