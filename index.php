<?php

print curl_download('http://www.bwalk.com/en-CA/Rent/Details/Alberta/Edmonton/Fairmont-Village/');

function curl_download($Url){

        if (!function_exists('curl_init')){
                die('Curl is not installed. Install try again.');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);


        $start = strpos($output, '<div class="large-7 columns property-details">');
        $end = strpos($output, '<div class="property-disclaimer">', $start);
        $length = $end-$start;
        $output = substr($output, $start, $length);


        // return $output;

        $parts = preg_split('~(</?[\w][^>]*>)~', $output, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

          print_r($parts);
        $lengthArray = count($parts);

        print_r($lengthArray);

                   
}

?>