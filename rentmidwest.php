<?php
			/*Passing the website to the function*/
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

		$start = strpos($output, '<ul class="unitsAvailable">');
        $end = strpos($output, '<div id="propertyVirtualTours" style="display:block;">', $start);
        $length = $end-$start;
        $output = substr($output, $start, $length);

     
		 $parts = preg_split('~(</?[\w][^>]*>)~', $output, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

     print_r($parts);
        $lengthArray = count($parts);
$count = 0;
      //  print_r($lengthArray);
		for($x =1; $x < $lengthArray; $x++)
		{
			
			if(preg_match('/\b(\d?) (bdrm)+/', $parts[$x], $matches4))
			{
				if(preg_match('/(?<!\d)\d{1}(?!\d)/', $parts[$x], $matches))	
					{
						echo("Bedrooms: $matches[0]  \n ");
						
					}
			}
				
				if(preg_match('/\b(?<!\d)(?i)sqft+?\b/',$parts[$x],$matches5))
			{
					
                    if(preg_match('/(?<!\d)([0-9]+)(?!\d)/',$parts[$x],$matches))
					   {
                        
						echo nl2br ("Square Feet :  $matches[0]  \n");
						}
			}
			
			if(preg_match('/(?i)from+?/',$parts[$x],$matches2))
                {
                //echo nl2br ("$matches2[0]\n");
                        for($i = $x; $i < $lengthArray; $i++)
                        {
                                if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$i],$matches))
                                {
                                       
										echo nl2br ("Price : $matches[0]  \n");
                                       break;
										
                                }
                        }

                }
			}
			
			
			
		}

?>