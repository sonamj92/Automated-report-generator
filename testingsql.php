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

 
        preg_match('~<body[^>]*>(.*?)</body>~si', $output, $html);
        $string_html = implode(',',$html);


        $parts = preg_split('~(</?[\w][^>]*>)~',$string_html , -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        
        $lengthArray = count($parts);
		
	
		
		$beds = 0;
		
      //  print_r($lengthArray);
		for($x =1; $x < $lengthArray; $x++)
		{
			
			if(preg_match('/\b(\d?) (bdrm)+/', $parts[$x], $matches4))
			{
				if(preg_match('/(?<!\d)\d{1}(?!\d)/', $parts[$x], $matches))	
					{
					
						$beds = $matches[0];
						if ($beds == 0)
							$beds = "Bach";
						echo ("Bedrooms: $matches[0] $x ");
						
							
					}
			}
				
				if(preg_match('/\b(?<!\d)(?i)sqft+?\b/',$parts[$x],$matches5))
			{
					
                    if(preg_match('/(?<!\d)([0-9]+)(?!\d)/',$parts[$x],$matches))
					   {
                        echo nl2br ("Square Feet :  $matches[0] $x \n");
						$area = $matches[0];
						}
			}
			
			if(preg_match('/(?i)from+?/',$parts[$x],$matches2))
                {
                echo nl2br ("$matches2[0]\n");
                        for($i = $x; $i < $lengthArray; $i++)
                        {
                                if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$i],$matches))
                                {
                                       
										echo nl2br ("Price : $matches[0]  \n");
										$price = $matches[0];
										break;
										
                                }
                        }
								if($beds == 0)
									$beds = "bach";
									$a =[
											"beds" => $beds,
											"area" => $area,
											"price" => $price,
										];
									
									$string = json_encode($a);
									
								//	store($string, $Url);
				}
			}
			
			
			
		}
		
	
		

?>