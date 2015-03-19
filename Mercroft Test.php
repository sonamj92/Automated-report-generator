<?php
			/*Passing the website to the function*/
//print curl_download('http://www.har-par.com/properties.php?PropertyID=141');
//print curl_download('http://www.har-par.com/properties.php?PropertyID=6');
print curl_download('http://www.rentmidwest.com/property/village-southgate');

function curl_download($Url){

         if (!function_exists('curl_init')){
                die('Curl is not installed. Install try again.');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

		preg_match('~<body[^>]*>(.*?)</body>~is', $output, $html);
		$string_html = implode(',',$html);

     

				/*Split the scraped source code*/
        $parts = preg_split('~(</?[\w][^>]*>)~', $string_html, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

				
		//print_r($parts);
        $lengthArray = count($parts);

    //   print_r($lengthArray);
		
		for($x =1; $x < $lengthArray; $x++)
		{
			if(preg_match('%Rent%', $parts[$x], $matches2))
			{
		
				if(preg_match('/\$\d+(\.\d+)?.*/', $parts[$x], $matches))
				{
					echo nl2br("Price: $matches[0] $x \n");
					//break;
					
				}
			}
			
			if(preg_match('%Deposit%', $parts[$x], $matches3))
			{
				
				if(preg_match('/\$\d+(\.\d+)?.*/', $parts[$x], $matches))
				{
					echo nl2br("Security Deposit: $matches[0] $x \n");
					//break;
				}
			}
			
			if(preg_match('/\b(\d?) Bedroom+/', $parts[$x], $matches4))
			{
				if(preg_match('/(?<!\d)\d{1}(?!\d)/', $parts[$x], $matches))	
					{
						echo("Bedrooms: $matches[0] $x \n ");
					}
			}
			
			if(preg_match('/\b(\d?) Bathroom+/', $parts[$x], $matches4))
			{
				if(preg_match('/(?<!\d)\d{1}(?!\d)/', $parts[$x], $matches))	
					{
						echo("Bathrooms: $matches[0] $x \n");
					}
			}
			
			 if(preg_match('/\b(?<!\d)(?i)square+?\b/',$parts[$x],$matches5))
			{

                        echo nl2br ("SQ  $matches5[0] $x \n");
                        //print_r ($matches4[0] );

                       if(preg_match('/(?<!\d)([0-9]+)(?!\d)/',$parts[$x],$matches))
					   {
                        echo nl2br ("Square Feet :  $matches[0] $x \n");
						}
			}
}
}
?>