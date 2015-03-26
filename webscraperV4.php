<?php

//curl_download('http://www.bwalk.com/en-CA/Rent/Details/Alberta/Edmonton/Fairmont-Village/');

//curl_download('http://www.bwalk.com/en-CA/Rent/Details/Alberta/Edmonton/Meadowview-Manor/');

//curl_download('http://www.har-par.com/properties.php?PropertyID=6');

curl_download('http://www.har-par.com/properties.php?PropertyID=141');

//curl_download('http://www.rentmidwest.com/property/village-southgate');

//curl_download('http://www.rentedmonton.com/Detail.aspx?prop=d46d9fab-d7bf-43e9-bf2e-c73ee30f26a1');

// curl_download('https://www.broadstreet.ca/property/131/Merecroft+Gardens/');

// curl_download('https://www.broadstreet.ca/property/131/Merecroft+Gardens/');


//need to input move in date //curl_download('http://www.parkplacesouthapartments.com/edmonton/park-place-south-apartment-homes/launch-check-availability/1/');


//body tags need to be tested //curl_download('http://www.rentedmonton.com/Detail.aspx?prop=d46d9fab-d7bf-43e9-bf2e-c73ee30f26a1');

function curl_download($Url)
{

        if (!function_exists('curl_init'))
        {
                die('Curl is not installed. Install try again.');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//set the next two curl ser option lines to avoid object moved error for rentedmonton url
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $output = curl_exec($ch);
        curl_close($ch);

        //$html=$output;
	echo nl2br ("****-------------- $Url  ----------****  \n");

//	print_r($output);

        preg_match('~<body[^>]*>(.*?)</body>~si', $output, $html);
        $string_html = implode(',',$html);

        //$start = strpos($output, '<div class="large-7 columns property-details">');
        //$end = strpos($output, '<div class="property-disclaimer">', $start);
        //$length = $end-$start;
        //$output = substr($output, $start, $length);
		
		 // return $output;
        //print_r($string_html);

        $parts = preg_split('~(</?[\w][^>]*>)~',$string_html , -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        print_r($parts);
        $lengthArray = count($parts);

        //print_r($lengthArray);
////////////////////////////-----------------------

	for($c = 1; $c < $lengthArray; $c++)
         {
		
		if(preg_match('/<option value="bachelor">/',$parts[$c],$matches2))		
		{
			//<option value="bachelor">
			//echo nl2br ("loop div tag  $matches2[0] $c \n");
			$c=400;
		}
		
                if(preg_match('/\bbachelor+?\b/',$parts[$c],$matches2))
                {
                        echo nl2br ("-------------- $matches2[0]  ---------- $c \n");

                                                for($d = $c; $d< $lengthArray; $d++)
                                                {
                                                        //echo nl2br ("inside for d  \n");
                                                        if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$d],$matches5))
                                                        {
                                                                echo nl2br ("$matches5[0]\n");
                                                                if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$d],$matches6))
                                                                {
                                                                        echo nl2br ("Deposit :  $matches6[0] $c \n");
                                                                        break;
                                                                }
                                                        //      break;
                                                         }
                                                        break;
                                                }
						for($e = $c; $e< $lengthArray; $e++)
                                                {
                                                         //echo nl2br ("loops crazy  \n");
                                                        if(preg_match('/(?i)price|rent+?/',$parts[$e],$matches3))
                                                        {
                                                                echo nl2br ("$matches3[0]  \n");
                                                                for($i = $e; $i < $lengthArray; $i++)
                                                                {
                                                                        if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$i],$matches4))
                                                                        {
                                                                                 echo nl2br ("Price : $matches4[0] $i \n");
                                                                                //print_r ($matches[0]);
                                                                                break ;
                                                                        }
                                                                        //break;
                                                                }
                                                                break;
                                                        }

                                                }
						for($f = $c; $f< $lengthArray; $f++)
                                                {
                                                        if(preg_match('/\b(?<!\d)(?i)bathrooms+?\b/',$parts[$f],$matches6))
                                                        {
                                                        echo nl2br ("$matches6[0] $c \n");
                                                        //print_r ($matches4[0] );

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
                                                                echo nl2br ("SQ  $matches7[0] $c \n");
                                                                //print_r ($matches4[0] );

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



//////////////--------------------------------------------------
        for($c = 1; $c < $lengthArray; $c++)
         {

		if(preg_match('/<option value="bachelor">/',$parts[$c],$matches2))
                {
                        //<option value="bachelor">
                        //echo nl2br ("loop div tag  $matches2[0] $c \n");
                        $c=400;
                }
	

		if(preg_match('/\b^[1].(?i)bedroom|Bedrooms:.[1]|bedroom.[1]+?\b/',$parts[$c],$matches2))
		{
			echo nl2br ("-------------- $matches2[0]  ---------- $c \n");

                                                for($d = $c; $d< $lengthArray; $d++)
                                                {
                                                        //echo nl2br ("inside for d  \n");
                                                        if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$d],$matches5))
                                                        {
                                                                //echo nl2br ("$matches5[0]\n");
                                                                if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$d],$matches6))
                                                                {
                                                                        echo nl2br ("Deposit :  $matches6[0] $c \n");
                                                                        break;
                                                                }
							//	break;
                                                         }
							break;
                                                }
						for($e = $c; $e< $lengthArray; $e++)
                                                {
                                                         //echo nl2br ("loops crazy  \n");
                                                        if(preg_match('/(?i)price|rent+?/',$parts[$e],$matches3))
                                                        {
                                                                echo nl2br ("$matches3[0]  \n");
                                                                for($i = $e; $i < $lengthArray; $i++)
                                                                {
                                                                        if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$i],$matches4))
                                                                        {
                                                                                 echo nl2br ("Price : $matches4[0] $i \n");
                                                                                //print_r ($matches[0]);
                                                                                break ;
                                                                        }
                                                                        //break;
                                                                }
                                                                break;
                                                        }

                                                }	
						for($f = $c; $f< $lengthArray; $f++)
                                                {
                                                        if(preg_match('/\b(?<!\d)(?i)bathrooms+?\b/',$parts[$f],$matches6))
                                                        {
                                                        echo nl2br ("$matches6[0] $c \n");
                                                        //print_r ($matches4[0] );

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
                                                                echo nl2br ("SQ  $matches7[0] $c \n");
                                                                //print_r ($matches4[0] );

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

	for($c = 1; $c < $lengthArray; $c++)
         {

		if(preg_match('/<option value="bachelor">/',$parts[$c],$matches2))
                {
                        //<option value="bachelor">
                        //echo nl2br ("loop div tag  $matches2[0] $c \n");
                        $c=500;
                }
		



		if(preg_match('/\b[2].(?i)bedroom|Bedrooms:.[2]|bedroom.[2]+?\b/',$parts[$c],$matches2))
                {
                        echo nl2br ("-------------- $matches2[0]  ---------- $c \n");

                                                for($h = $c; $h< $lengthArray; $h++)
                                                {
                                                        //echo nl2br ("inside for d  \n");
                                                        if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$h],$matches5))
                                                        {
                                                                //echo nl2br ("$matches5[0]\n");
                                                                if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$h],$matches6))
                                                                {
                                                                        echo nl2br ("Deposit :  $matches6[0] $c \n");
                                                                        break;
                                                                }
                                                         }
                                                }
						 for($j = $c; $j< $lengthArray; $j++)
                                                {
                                                         //echo nl2br ("loops crazy  \n");
                                                        if(preg_match('/(?i)price|rent+?/',$parts[$j],$matches3))
                                                        {
                                                                echo nl2br ("$matches3[0]  \n");
                                                                for($k = $j; $k < $lengthArray; $k++)
                                                                {
                                                                        if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$k],$matches4))
                                                                        {
                                                                                 echo nl2br ("Price : $matches4[0] $c \n");
                                                                                //print_r ($matches[0]);
                                                                                break ;
                                                                        }
                                                                        //break;
                                                                }
                                                                break;
                                                        }

                                                }
                                                for($l = $c; $l< $lengthArray; $l++)
                                                {
                                                        if(preg_match('/\b(?<!\d)(?i)bathrooms+?\b/',$parts[$l],$matches6))
                                                        {
                                                        echo nl2br ("$matches6[0] $c \n");
                                                        //print_r ($matches4[0] );

                                                                if(preg_match('/(?<!\d)\d{1}(?!\d)/',$parts[$l],$matches))
                                                                {
                                                                        echo nl2br ("Bathrooms :  $matches[0] $c \n");
                                                                        break;
                                                                }

                                                        }

                                                }
				 		 for($m = $c; $m< $lengthArray; $m++)
                                                {
                                                        if(preg_match('/\b(?<!\d)(?i)square|sqft|frSqFt+?\b/',$parts[$m],$matches7))
                                                        {
                                                                //echo nl2br ("SQ  $matches7[0] $x \n");
                                                                //print_r ($matches4[0] );

                                                                if(preg_match('/(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$m],$matches))
                                                                {
                                                                        echo nl2br ("Square Feet :  $matches[0] $c \n");
                                                                        break;
                                                                }
                                                        }
                                                }
                                                break;
			}
        }

	for($c = 1; $c< $lengthArray; $c++)
    	{

			if(preg_match('/<option value="bachelor">/',$parts[$c],$matches2))
                	{
                        	//<option value="bachelor">
                	        //echo nl2br ("loop div tag  $matches2[0] $c \n");
        	                $c=500;
	                }




			if(preg_match('/\b[3].(?i)bedroom|Bedrooms:.[3]|bedroom.[3]+?\b/',$parts[$c],$matches2))
        		{
                        	echo nl2br ("-------------- $matches2[0] ---------- $c \n");
                                                for($h3 = $c; $d< $lengthArray; $h3++)
                                                {
                                                        //echo nl2br ("inside for d \n");
                                                        if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$h3],$matches5))
                                                        {
                                                                //echo nl2br ("$matches5[0]\n");
                                                                if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$h3],$matches6))
                                                                {
                                                                        echo nl2br ("Deposit : $matches6[0] $c \n");
                                                                        break;
                                                                }
                                                         }
                                                }
						 for($j3 = $c; $j< $lengthArray; $j3++)
                                                {
                                                         //echo nl2br ("loops crazy \n");
                                                        if(preg_match('/(?i)price+|rent?/',$parts[$j3],$matches3))
                                                        {
                                                                echo nl2br ("$matches3[0] \n");
                                                                for($k3 = $j3; $k3 < $lengthArray; $k3++)
                                                                {
                                                                        if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$k3],$matches4))
                                                                        {
                                                                                 echo nl2br ("Price : $matches4[0] $c \n");
                                                                                //print_r ($matches[0]);
                                                                                break ;
                                                                        }
                                                                        //break;
                                                                }
                                                                break;
                                                        }
                                                }
                                                for($l3 = $c; $l3< $lengthArray; $l3++)
                                                {
                                                        if(preg_match('/\b(?<!\d)(?i)bathrooms+?\b/',$parts[$l3],$matches6))
                                                        {
                                                        echo nl2br ("$matches6[0] $c \n");
                                                        //print_r ($matches4[0] );
                                                                if(preg_match('/(?<!\d)\d{1}(?!\d)/',$parts[$l3],$matches))
                                                                {
                                                                        echo nl2br ("Bathrooms : $matches[0] $c \n");
                                                                        break;
                                                                }
                                                        }
                                                }
				 		 for($m3 = $c; $m3< $lengthArray; $m3++)
                                                {
                                                        if(preg_match('/\b(?<!\d)(?i)square|sqft|frSqFt+?\b/',$parts[$m3],$matches7))
                                                        {
                                                                //echo nl2br ("SQ $matches7[0] $x \n");
                                                                //print_r ($matches4[0] );
                                                                if(preg_match('/(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$m3],$matches))
                                                                {
                                                                        echo nl2br ("Square Feet : $matches[0] $c \n");
                                                                        break;
                                                                }
                                                        }
                                                }
                                                break;
		}
    }

}
?>

