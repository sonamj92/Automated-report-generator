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
		$temp = 1;
		
			/*This loop will find details of Bachelor suites from all the websites. Once it matches, it will run internal for loops to find number of bathrooms, deposit and rental price*/
		for($c1 = 1; $c1 < $lengthArray; $c1++)
        {
		
			if(preg_match('/<option value="bachelor">/',$parts[$c1],$matches2))		
			{
				$c1=400;
			}
		
            if(preg_match('/^\W*(?:\w+\b\W*){1,15}bach|Bachelor/',$parts[$c1],$matches2))
            {
               			
					/*This for loop will search for the deposit price. Once it finds it, it will break the loop.*/
                for($d = $c1; $d< $lengthArray; $d++)
               {
					if($d== $c1+300)
                    {
                            $deposit = "0";
                             break;
                    }
					
                    else if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$d],$matches5))
                    {
                        if(preg_match('/\$\d+(?:\.\d+)?./',$parts[$d],$matches6))
                        {
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
					if($i== $e+300)
                    {
						$rent = "0";
                        break;
                    }
							
					else if(preg_match('/\$\d+(?:\.\d+)?.*|\b\d+(?:\.\d)\b/',$parts[$i],$matches4))
					{
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
			if($f1== $c1+300)
            {
                $bath = "0";
				break;
            }
                    	
			else if(preg_match('/\b(?<!\d)(?i)Baths|bathrooms+?\b/',$parts[$f1],$matches6))
            {
                if(preg_match('/(?<!\d)\d{1}(?!\d)|\d{1}/',$parts[$f1],$matches))
                {
                    $bath = $matches[0];
                    break;
                }
			}
		}
                 	
			/*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/			           
		for($g = $c1; $g < $lengthArray; $g++)
                {
		    if($g== $c1+300)
                    {
                            $area = "0";
                            break;
                    }
                    else if(preg_match('/\b(?<!\d)(?i)Area|square|sqft|frSqFt+?\b/',$parts[$g],$matches7))
                    {
                        if(preg_match('/(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$g],$matches))
                        {
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
				/*This for loop will search for the deposit price. Once it finds it, it will break this loop.*/
			for($d = $c2; $d < $lengthArray; $d++)
            {
				if($d== $c2+100)
                {
                    $deposit = "0";
                    break;
                }
                   
				if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$d],$matches5))
                {
                    if(preg_match('/\$\d\,\d+|\$\d+(?:\.\d+)?.+/',$parts[$d],$matches6))
                    {
						//echo nl2br ("Deposit :  $matches6[0] $d \n");
						$deposit = $matches6[0];
                        break;
                    }
				}
			}
					
			/*This for loop will search for the rental price. Once it finds it, it will break this loop.*/
			for($e = $c2; $e< $lengthArray; $e++)
            {
				if($e== $c2+100)
                {
                    $rent = "0";
                    break;
                }
                
			if(preg_match('/(?i)rate|price|rent+?/',$parts[$e],$matches3))
            {
                for($i = $e; $i < $lengthArray; $i++)
               {
                    if(preg_match('/\$\d\,\d+|\$\d+(?:\.\d+)?.*|\b\d+(?:\.\d+)\b/',$parts[$i],$matches4))
                    {
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
				if($f== $c2+100)
				{
                        		$bath = "0";
                        		break;
                    		}
                        	
				if(preg_match('/\b(?<!\d)(?i)Baths|bathrooms+?\b/',$parts[$f],$matches6))
                    		{
                        		if(preg_match('/\d{1}|(?<!\d)\d{1}(?!\d)/',$parts[$f],$matches))
                        		{
                            			$bath = $matches[0];
                            			break;
                        		}
				}
			}
										
				/*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/			           
			for($g = $c2; $g< $lengthArray; $g++)
            		{
				if($g== $c2+100)
                		{
                    			$area = "0";
                    			break;
                		}
                        	
				if(preg_match('/\b(?<!\d)(?i)Area:|square|sqft|frSqFt+?\b/',$parts[$g],$matches7))
                {
					if(preg_match('/(\d+-?)+\d+|(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$g],$matches))
                   {
                        area = $matches[0];
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
                    	/*This for loop will search for the deposit price. Once it finds it, it will break this loop.*/
                   		for($h = $c; $h< $lengthArray; $h++)
                   		{
							if($h== $c+100)
                        		{
                            			$deposit = "0";
                            			break;
                        		}
                        	
							if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$h],$matches5))
							{
								if(preg_match('/\$\d\,\d+|\$\d+(?:\.\d+)?.+/',$parts[$h],$matches6))
								{
									$deposit = $matches6[0];
									break;
								}
							}
                    	}
						
				/*This for loop will search for the rental price. Once it finds it, it will break this loop.*/
				for($j = $c; $j< $lengthArray; $j++)
                {
					if($j== $c+100)
					{
						$rent = "0";
                        break;
                    }
                        		
					if(preg_match('/(?i)rate|price|rent|amount+?/',$parts[$j],$matches3))
                    			{
								for($k = $j; $k < $lengthArray; $k++)
                        			{
                            			if(preg_match('/\$\d\,\d+|\$\d+(?:\.\d+)?.*|\b\d+(?:\.\d+)\b/',$parts[$k],$matches4))
											{
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
				if($l== $c+100)
                {
                    $bath = "0";
					break;
                }
                        		
				if(preg_match('/\b(?<!\d)(?i)bathrooms|bath|Baths+?\b/',$parts[$l],$matches6))
                {
					if(preg_match('/\d{1}|(?<!\d)\d{1}(?!\d)/',$parts[$l],$matches))
					{
                        $bath = $matches[0];
                        break;
					}
				}
			}

                            	/*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/			           
			for($m = $c; $m< $lengthArray; $m++)
           {
				if($m== $c+100)
               {
                    $area = "0";
                    break;
                }
                        		
				if(preg_match('/\b(?<!\d)(?i)area|square|sqft|frSqFt|Sq..Ft.+?\b/',$parts[$m],$matches7))
                {
                    for($n = $m; $n< $lengthArray; $n++)
					{
						if(preg_match('/(\d+-?)+\d+|(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$n],$matches))
                        {
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
                    	/*This for loop will search for the deposit price. Once it finds it, it will break this loop.*/    
					for($h3 = $c; $h< $lengthArray; $h3++)
					{
						if($h3== $c+100)
						{
                            $deposit = "0";
							break;
						}
                       
					    if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$h3],$matches5))
						{
							if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$h3],$matches6))
                            {
                                $deposit = $matches6[0];
								break;
                            }
                       	}
                    }
						
					/*This for loop will search for the rental price. Once it finds it, it will break this loop.*/
					for($j3 = $c; $j< $lengthArray; $j3++)
                    {
						if($j3== $c+100)
                        {
                            $rent = "0";
                            break;
                      	}
							
						if(preg_match('/(?i)rate|price+|rent?/',$parts[$j3],$matches3))
						{
							for($k3 = $j3; $k3 < $lengthArray; $k3++)
                            {
								if(preg_match('/\$\d\,\d+|\$\d+(?:\.\d+)?.*|\b\d+(?:\.\d+)\b/',$parts[$k3],$matches4))
                                {
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
						if($l3== $c+100)
                        {
                            $bath = "0";
                            break;
                        }
                 
						if(preg_match('/\b(?<!\d)(?i)Bath|bathrooms+?\b/',$parts[$l3],$matches6))
						{
                            if(preg_match('/(?<!\d)\d{1}(?!\d)/',$parts[$l3],$matches))
							{
                                $bath = $matches[0];
                                break;
                            }
                        }
                    }
					                            
						/*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/			           
					for($m3 = $c; $m3< $lengthArray; $m3++)
					{
						if($m3== $c+100)
						{
                            $area = "0";
                            break;
                        }
                        			
						if(preg_match('/\b(?<!\d)(?i)square|sqft|frSqFt+?\b/',$parts[$m3],$matches7))
                        {
							if(preg_match('/(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$m3],$matches))
                            {
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
			else 
				$final[$name]['Bachelor'] = null;
			
			if(isset($a1))
				$final[$name]['1BD'] = $a1;
			else
                $final[$name]['1BD'] = null;
	
			if(isset($a2))
				$final[$name]['2BD'] = $a2;
			else
                $final[$name]['2BD'] = null;

			if(isset($a3))
				$final[$name]['3BD'] = $a3;
			else
                $final[$name]['3BD'] = null;

			return ($final);
}
}

?>
