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


     preg_match('~<body[^>]*>(.*?)</body>~si', $output, $html);
        $string_html = implode(',',$html);

      

        $parts = preg_split('~(</?[\w][^>]*>)~',$string_html , -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
		  $lengthArray = count($parts);
    	for($x = 1; $x < $lengthArray; $x++)
    		for($c = 1; $c < $lengthArray; $c++)
         {
		
		if(preg_match('/<option value="bachelor">/',$parts[$c],$matches2))		
		{
			$c=400;
		}
		
                if(preg_match('/\bbachelor+?\b/',$parts[$c],$matches2))
                {
                        echo nl2br ("-------------- $matches2[0]  ---------- $c \n");

                                                for($d = $c; $d< $lengthArray; $d++)
                                                {
                                                       
                                                        if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$d],$matches5))
                                                        {
                                                                echo nl2br ("$matches5[0]\n");
                                                                if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$d],$matches6))
                                                                {
                                                                        echo nl2br ("Deposit :  $matches6[0] $c \n");
                                                                        break;
                                                                }
                                                        
                                                         }
                                                        break;
                                                }
						for($e = $c; $e< $lengthArray; $e++)
                                                {
                                                         if(preg_match('/(?i)price|rent+?/',$parts[$e],$matches3))
                                                        {
                                                                echo nl2br ("$matches3[0]  \n");
                                                                for($i = $e; $i < $lengthArray; $i++)
                                                                {
                                                                        if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$i],$matches4))
                                                                        {
                                                                                 echo nl2br ("Price : $matches4[0] $i \n");
                                                                                 break ;
                                                                        }
                                                                        
                                                                }
                                                                break;
                                                        }

                                                }
						for($f = $c; $f< $lengthArray; $f++)
                                                {
                                                        if(preg_match('/\b(?<!\d)(?i)bathrooms+?\b/',$parts[$f],$matches6))
                                                        {
                                                        echo nl2br ("$matches6[0] $c \n");
                                                        
                                                                if(preg_match('/(?<!\d)\d{1}(?!\d)/',$parts[$f],$matches))
                                                                {
                                                                        echo nl2br ("Bathrooms :  $matches[0] $c \n");
                                                                        break;
                                                                }

                                                        }

                                                }
						for($g = $c; $g< $lengthArray; $g++)
                                                {
                                                        if(preg_match('/\b(?<!\d)(?i)square|sqft|frSqFt+?\b/',$parts[$g],$matches7))
                                                        {
                                                                
                                                              
                                                                if(preg_match('/(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$g],$matches))
                                                                {
                                                                        echo nl2br ("Square Feet :  $matches[0] $c \n");
                                                                        break;
                                                                }
                                                        }
                                                }
                                                break;
		}
	}



       
	}



?>






