<?php

class Scraper
{
			/*Scraper function definition*/
function curl_download($Url, $name)
{
			/*Checks whether cURL is installed*/
        if (!function_exists('curl_init'))
        {
                die('Curl is not installed. Install try again.');
        }

			/*Initializing the scraper*/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $output = curl_exec($ch);
        curl_close($ch);

        
		echo nl2br ("****-------------- $Url  ----------****  \n");
		
		$beds = 0;
		$area = 0;
		$rent = 0;
		$deposit = 0;
		$bath = 0;
	
			/* Finds the body tags*/
        preg_match('~<body[^>]*>(.*?)</body>~si', $output, $html);
        $string_html = implode(',',$html);

			/*Tokenizes the scraped data*/
        $parts = preg_split('~(</?[\w][^>]*>)~',$string_html , -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        $lengthArray = count($parts);    
		$temp=1;
		
	//	print_r($parts);

			/*This loop will find details of Bachelor suites from all the websites. Once it matches, it will run internal for loops to find number of bathrooms, deposit and rental price*/
		for($c1 = 1; $c1 < $lengthArray; $c1++)
        {
		
			if(preg_match('/<option value="bachelor">/',$parts[$c1],$matches2))		
			{
				$c1=400;
			}
		
            if(preg_match('/^\W*(?:\w+\b\W*){1,15}bach|Bachelor/',$parts[$c1],$matches2))
            {
                echo nl2br ("-------------- $matches2[0]  ---------- $c1 \n");
									
					/*This for loop will search for the deposit price. Once it finds it, it will break the loop.*/
                for($d = $c1; $d< $lengthArray; $d++)
               {
                    if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$d],$matches5))
                    {
                        if(preg_match('/\$\d+(?:\.\d+)?./',$parts[$d],$matches6))
                        {
                            echo nl2br ("Deposit :  $matches6[0] $d \n");
							$deposit = $matches6[0];
                            break;
                        }                               
                    }
                }
					
					/*This for loop will search for the rental price. Once it finds it, it will break the loop.*/	
				for($e = $c1; $e< $lengthArray; $e++)
                {
                    if(preg_match('/(?i)rate|price|rent+?/',$parts[$e],$matches3))
                    {
                        for($i = $e; $i < $lengthArray; $i++)
                        {
                            if(preg_match('/\$\d\,\d+|\$\d+(?:\.\d+)?.*/',$parts[$i],$matches4))
                            {
                                echo nl2br ("Price : $matches4[0] $i \n");  
								$rent = $matches4[0];
                                break ;
                            }
                        }
                    break;
                    }
                }
						
					/*This for loop will search for the number of bathrooms. Once it finds it, it will break the loop.*/	
				for($f1 = $c1; $f1 < $lengthArray; $f1++)
                {
                    if(preg_match('/\b(?<!\d)(?i)Baths|bathrooms+?\b/',$parts[$f1],$matches6))
                    {
                        if(preg_match('/(?<!\d)\d{1}(?!\d)|\d{1}/',$parts[$f1],$matches))
                        {
                            echo nl2br ("Bathrooms :  $matches[0] $f1 \n");
							$bath = $matches[0];
                            break;
                        }
					}
				}
                 	
					/*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/			           
				for($g = $c1; $g < $lengthArray; $g++)
                {
                    if(preg_match('/\b(?<!\d)(?i)Area|square|sqft|frSqFt+?\b/',$parts[$g],$matches7))
                    {
                        if(preg_match('/(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$g],$matches))
                        {
                            echo nl2br ("Square Feet :  $matches[0] $g \n");
							$area = $matches[0];
                            break;
                        }
                    }
					$temp = $g;
                }
				
				$a0 = array(
									"Rent" => $rent,
									"Deposit" => $deposit,
									"Area" => $area,
									"Bathroom" => $bath,
								);
					/*Breaks the if loop after it has executed all the statements within or if they do not match the if conditions*/
                break;
			}
				/*End of for loop that searches for the Bachelor suite*/
		}
			
				/*Second Main for Loop that finds details of 1 BDRM properties */
				
			for($c2 = $temp; $c2 < $lengthArray; $c2++)
			{
				if(preg_match('/<option value="bachelor">/',$parts[$c2],$matches2))
                {   
                    $c2=400;
                }
				
				if(preg_match('/\b^[1].(?i)bedroom|Bedrooms:.[1]|^[1].Bedroom|[1].bdrm|bedroom.[1]|[1].bedroom+?\b/',$parts[$c2],$matches2))
				{
					echo nl2br ("-------------- $matches2[0]  ---------- $c2 \n");
			
					/*This for loop will search for the deposit price. Once it finds it, it will break this loop.*/
					for($d = $c2; $d < $lengthArray; $d++)
                    {
                        if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$d],$matches5))
                        {
                            if(preg_match('/\$\d\,\d+|\$\d+(?:\.\d+)?.+/',$parts[$d],$matches6))
                            {
								echo nl2br ("Deposit :  $matches6[0] $d \n");
								$deposit = $matches6[0];
                                break;
                            }
						}
					}
					
						/*This for loop will search for the rental price. Once it finds it, it will break this loop.*/
					for($e = $c2; $e< $lengthArray; $e++)
                    {
                        if(preg_match('/(?i)rate|price|rent+?/',$parts[$e],$matches3))
                        {
                            for($i = $e; $i < $lengthArray; $i++)
                            {
                                if(preg_match('/\$\d\,\d+|\$\d+(?:\.\d+)?.*/',$parts[$i],$matches4))
                                {
                                    echo nl2br ("Price: $matches4[0] $i \n");
									$rent = $matches4[0];
                                    break ;
                                }
                            }
                        break;
                        }
					}	
					
						/*This for loop will search for the number of bathrooms. Once it finds it, it will break the loop.*/	
					for($f = $c2; $f< $lengthArray; $f++)
                    {
                        if(preg_match('/\b(?<!\d)(?i)Baths|bathrooms+?\b/',$parts[$f],$matches6))
                        {
                            if(preg_match('/\d{1}|(?<!\d)\d{1}(?!\d)/',$parts[$f],$matches))
                            {
                                echo nl2br ("Bathrooms :  $matches[0] $f \n");
								$bath = $matches[0];
                                break;
                            }
						}
					}
										
						/*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/			           
					for($g = $c2; $g< $lengthArray; $g++)
                    {
                        if(preg_match('/\b(?<!\d)(?i)Area:|square|sqft|frSqFt+?\b/',$parts[$g],$matches7))
                        {
						    if(preg_match('/(\d+-?)+\d+|(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$g],$matches))
                            {
                                echo nl2br ("Square Feet :  $matches[0] $g \n");
								$area = $matches[0];
								break;
                            }
                        }
					}
					
					$a1 = array(
									"Rent" => $rent,
									"Deposit" => $deposit,
									"Area" => $area,
									"Bathroom" => $bath,
								);
						/*Breaks the if loop after it has executed all the statements within or if they do not match the if conditions*/
					break;
				}
						/*End of for loop that searches for the 1BDRM suite*/
			}

			
						/*Third Main for Loop that finds details of 2 BDRM properties */
			for($c = 1; $c < $lengthArray; $c++)
			{
				if(preg_match('/<option value="bachelor">/',$parts[$c],$matches2))
                {
                        $c=500;
                }
		
				if(preg_match('/\b[2].(?i)bedroom|[2].bdrm|Bedrooms:.[2]|bedroom.[2]|[2].bed+?\b/',$parts[$c],$matches2))
                {
                    echo nl2br ("-------------- $matches2[0]  ---------- $c \n");
						
						/*This for loop will search for the deposit price. Once it finds it, it will break this loop.*/
                    for($h = $c; $h< $lengthArray; $h++)
                    {
                        if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$h],$matches5))
						{
							if(preg_match('/\$\d\,\d+|\$\d+(?:\.\d+)?.+/',$parts[$h],$matches6))
                            {
                                echo nl2br ("Deposit :  $matches6[0] $h \n");
								$deposit = $matches6[0];
                                break;
                            }
                        }
                    }
						
						/*This for loop will search for the rental price. Once it finds it, it will break this loop.*/
					for($j = $c; $j< $lengthArray; $j++)
                    {
                        if(preg_match('/(?i)rate|price|rent|amount+?/',$parts[$j],$matches3))
                        {
							for($k = $j; $k < $lengthArray; $k++)
                            {
                                if(preg_match('/\$\d\,\d+|\$\d+(?:\.\d+)?.+/',$parts[$k],$matches4))
                                {
                                    echo nl2br ("Price : $matches4[0] $k \n");
									$rent = $matches4[0];
                                    break ;
                                }
                            }
                              break;
                        }
					}
                                                
							/*This for loop will search for the number of bathrooms. Once it finds it, it will break the loop.*/	
					for($l = $c; $l< $lengthArray; $l++)
                    {
                        if(preg_match('/\b(?<!\d)(?i)bathrooms|bath|Baths+?\b/',$parts[$l],$matches6))
                        {
							if(preg_match('/\d{1}|(?<!\d)\d{1}(?!\d)/',$parts[$l],$matches))
                            {
                                echo nl2br ("Bathrooms :  $matches[0] $l \n");
								$bath = $matches[0];
                                break;
                            }
						}
					}

                            /*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/			           
                 	for($m = $c; $m< $lengthArray; $m++)
                    {
                        if(preg_match('/\b(?<!\d)(?i)area|square|sqft|frSqFt|Sq..Ft.+?\b/',$parts[$m],$matches7))
                        {
                            for($n = $m; $n< $lengthArray; $n++)
							{
								if(preg_match('/(\d+-?)+\d+|(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$n],$matches))
                                {
                                    echo nl2br ("Square Feet :  $matches[0] $n \n");
									$area = $matches[0];
                                    break;
                                }
							}
						break;
                        }
                    }
					
					$a2 = array(
									"Rent" => $rent,
									"Deposit" => $deposit,
									"Area" => $area,
									"Bathroom" => $bath,
								);
					
							/*Breaks the if loop after it has executed all the statements within or if they do not match the if conditions*/
					break;
				}
							/*End of for loop that searches for the 2BDRM suite*/
			}

					/*Fourth Main for Loop that finds details of 3BDRM properties */
			for($c = 1; $c< $lengthArray; $c++)
			{
				if(preg_match('/<option value="bachelor">/',$parts[$c],$matches2))
                {
                   $c=500;
	            }

				
				if(preg_match('/\b[3].(?i)bedroom|Bedrooms:.[3]|bedroom.[3]+?\b/',$parts[$c],$matches2))
				{
                    echo nl2br ("-------------- $matches2[0] ---------- $c \n");
                                         
						/*This for loop will search for the deposit price. Once it finds it, it will break this loop.*/    
					for($h3 = $c; $h< $lengthArray; $h3++)
                    {
                        if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$h3],$matches5))
                        {
							if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$h3],$matches6))
                            {
                                echo nl2br ("Deposit : $matches6[0] $h3 \n");
								$deposit = $matches6[0];
                                break;
                            }
                        }
                    }
						
						/*This for loop will search for the rental price. Once it finds it, it will break this loop.*/
					for($j3 = $c; $j< $lengthArray; $j3++)
                    {
						if(preg_match('/(?i)rate|price+|rent?/',$parts[$j3],$matches3))
                        {
                            for($k3 = $j3; $k3 < $lengthArray; $k3++)
                            {
								if(preg_match('/\$\d\,\d|\$\d+(?:\.\d+)?.+/',$parts[$k3],$matches4))
                                {
                                    echo nl2br ("Price : $matches4[0] $j3 \n");
									$rent = $matches4[0];
                                    break ;
								}
                            }
                        break;
                        }
                    }
                                               
						/*This for loop will search for the number of bathrooms. Once it finds it, it will break the loop.*/	
					for($l3 = $c; $l3 < $lengthArray; $l3++)
                    {
                        if(preg_match('/\b(?<!\d)(?i)Bath|bathrooms+?\b/',$parts[$l3],$matches6))
                        {
                            if(preg_match('/(?<!\d)\d{1}(?!\d)/',$parts[$l3],$matches))
                            {
                                echo nl2br ("Bathrooms : $matches[0] $l3 \n");
								$bath = $matches[0];
                                break;
                            }
                        }
                    }
					                            
						/*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/			           
					for($m3 = $c; $m3< $lengthArray; $m3++)
                    {
                        if(preg_match('/\b(?<!\d)(?i)square|sqft|frSqFt+?\b/',$parts[$m3],$matches7))
                        {
							if(preg_match('/(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$m3],$matches))
                            {
                                echo nl2br ("Square Feet : $matches[0] $m3 \n");
								$area = $matches[0];
                                break;
                            }
                        }
                    }
					
					$a3 = array(
									"Rent" => $rent,
									"Deposit" => $deposit,
									"Area" => $area,
									"Bathroom" => $bath,
								);
					
						/*Breaks the if loop after it has executed all the statements within or if they do not match the if conditions*/
				break;
				}
						/*End of for loop that searches for the 3BDRM suite*/
			}
			
			$final = array();
			if(isset($a0))
				$final[$name]['Bachelor'] = $a0;
			
			if(isset($a1))
				$final[$name]['1BD'] = $a1;
			

			if(isset($a2))
				$final[$name]['2BD'] = $a2;
			
			if(isset($a3))
				$final[$name]['3BD'] = $a3;
			
			return ($final);
}
}

?>

