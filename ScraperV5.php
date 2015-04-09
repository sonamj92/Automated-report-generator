<?php

			/*Passing the URL to the scraper function download*/
//curl_download('http://www.bwalk.com/en-CA/Rent/Details/Alberta/Edmonton/Fairmont-Village/');

//curl_download('http://www.bwalk.com/en-CA/Rent/Details/Alberta/Edmonton/Meadowview-Manor/');

//curl_download('http://www.har-par.com/properties.php?PropertyID=6');

//curl_download('http://www.har-par.com/properties.php?PropertyID=141');

curl_download('http://www.rentmidwest.com/property/village-southgate');

//curl_download('http://www.rentedmonton.com/Detail.aspx?prop=d46d9fab-d7bf-43e9-bf2e-c73ee30f26a1');

//curl_download('https://www.broadstreet.ca/property/131/Merecroft+Gardens/');

			/*Scraper function definition*/
function curl_download($Url)
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

			/* Finds the body tags*/
		preg_match('~<body[^>]*>(.*?)</body>~si', $output, $html);
        $string_html = implode(',',$html);
		
			/*Tokenizes the scraped data*/
		$parts = preg_split('~(</?[\w][^>]*>)~',$string_html , -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
		//print_r($parts);
        $lengthArray = count($parts);
		
			/*This loop will find details of Bachelor suites from all the websites. Once it matches, it will run internal for loops to find number of bathrooms, deposit and rental price*/
			
			$beds = 0;
			$area = 0;
			$rent = 0;
			$bath = 0;
			$deposit = 0;
			
			$a = array();
			for($c = 1; $c < $lengthArray; $c++)
			{
		
				if(preg_match('/<option value="bachelor">/',$parts[$c],$matches2))		
				{
					$c=400;
				}
				
                if(preg_match('/\bbachelor+?\b/',$parts[$c],$matches2))
                {
                        echo nl2br ("-------------- $matches2[0]  ---------- $c \n");

                             /*This for loop will search for the deposit price. Once it finds it, it will break the loop.*/
								for($d = $c; $d< $lengthArray; $d++)
                                {
                                                       
                                    if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$d],$matches5))
                                    {
                                        //echo nl2br ("$matches5[0]\n");
                                        if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$d],$matches6))
                                        {
											echo nl2br ("Deposit :  $matches6[0] $c \n");
											$deposit = $matches6[0];
											break;
                                        }               
									}
                                break;
                                }              
							
							/*This for loop will search for the rental price. Once it finds it, it will break the loop.*/	
								for($e = $c; $e< $lengthArray; $e++)
                                {
                                    if(preg_match('/(?i)price|rent+?/',$parts[$e],$matches3))
                                    {
                                      //echo nl2br ("$matches3[0]  \n");
                                        for($i = $e; $i < $lengthArray; $i++)
                                        {
                                            if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$i],$matches4))
                                            {
                                                echo nl2br ("Price : $matches4[0] $i \n");
												$rent = $matches4[0];
												break;
                                            }                 
                                        }
									break;
                                    }  

                                }
								
							/*This for loop will search for the number of bathrooms. Once it finds it, it will break the loop.*/	
								for($f = $c; $f < $lengthArray; $f++)
                                {
                                    if(preg_match('/\b(?<!\d)(?i)bathrooms+?\b/',$parts[$f],$matches6))
                                    {
                                     // echo nl2br ("$matches6[0] $c \n");
                                        if(preg_match('/(?<!\d)\d{1}(?!\d)/',$parts[$f],$matches))
                                        {
                                            echo nl2br ("Bathrooms :  $matches[0] $c \n");
											$bath = $matches[0];
										    break;
                                        }
                                    }
                                }
							
							/*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/			
								for($g = $c; $g< $lengthArray; $g++)
                                {
                                    if(preg_match('/\b(?<!\d)(?i)square|sqft|frSqFt+?\b/',$parts[$g],$matches7))
                                    {                              
                                        if(preg_match('/(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$g],$matches))
                                        {
                                            echo nl2br ("Square Feet :  $matches[0] $c \n");
											$area = $matches[0];
											break;
                                        }
                                    }
                                }
                              
							/*Breaks the if loop after it has executed all the statements within or if they do not match the if conditions*/
					break;
				}
							/*End of for loop that searches for the Bachelor suite*/
			}
			
			
							/*Second Main for Loop that finds details of 1 BDRM properties */
			
			for($c = 1; $c < $lengthArray; $c++)
			{

				if(preg_match('/<option value="bachelor">/',$parts[$c],$matches2))
                {                        
                    $c=400;
                }
				
				if(preg_match('/\b[1].(?i)bedroom|Bedrooms:.[1]|bedroom.[1]+?\b/',$parts[$c],$matches2))
				{
						echo nl2br ("-------------- $matches2[0]  ---------- $c \n");
							
							/*This for loop will search for the deposit price. Once it finds it, it will break this loop.*/
								for($d = $c; $d< $lengthArray; $d++)
								{	
									if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$d],$matches5))
									{
										if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$d],$matches6))
										{
											echo nl2br ("Deposit :  $matches6[0] $c \n");
											$deposit = $matches6[0];
											break;
										}
									}
								break;
								}
						
							/*This for loop will search for the rental price. Once it finds it, it will break this loop.*/
								for($e = $c; $e< $lengthArray; $e++)
                                {
									if(preg_match('/(?i)price|rent+?/',$parts[$e],$matches3))
                                    {
                                          //echo nl2br ("$matches3[0]  \n");
                                        for($i = $e; $i < $lengthArray; $i++)
                                        {
                                            if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$i],$matches4))
                                            {
                                                 echo nl2br ("Price : $matches4[0] $i \n");
												 $rent = $matches4[0];
												 break ;
                                            }            
                                        }
                                    break;
                                    }
								}	
								
							/*This for loop will search for the number of bathrooms. Once it finds it, it will break this loop.*/	
								for($f = $c; $f< $lengthArray; $f++)
                                {
                                    if(preg_match('/\b(?<!\d)(?i)bathrooms+?\b/',$parts[$f],$matches6))
                                    {
                                        //echo nl2br ("$matches6[0] $c \n");            
                                        if(preg_match('/(?<!\d)\d{1}(?!\d)/',$parts[$f],$matches))
                                        {
                                            echo nl2br ("Bathrooms :  $matches[0] $c \n");
											$baths = $matches[0];
                                            break;
                                        }
                                    }
                                }
								
							/*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/	
								for($g = $c; $g< $lengthArray; $g++)
                                {
                                    if(preg_match('/\b(?<!\d)(?i)square|sqft|frSqFt+?\b/',$parts[$g],$matches7))
                                    {
                                       //echo nl2br ("SQ  $matches7[0] $c \n");           
                                        if(preg_match('/(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$g],$matches))
                                        {
                                            echo nl2br ("Square Feet :  $matches[0] $c \n");
											$area = $matches[0];
											break;
                                        }
                                    }
                                }
						
						/*Breaks the if loop after it has executed all the statements within or if they do not match the if conditions*/
					break;
				}
							/*End of for loop that searches for the 1BRM suite*/
			}
			
		
							/*Third Main for Loop that finds details of 2 BDRM properties */
			for($c = 1; $c < $lengthArray; $c++)
			{
				if(preg_match('/<option value="bachelor">/',$parts[$c],$matches2))
                {
                        $c=500;
                }
		
					
				if(preg_match('/\b[2].(?i)bedroom|Bedrooms:.[2]|bedroom.[2]+?\b/',$parts[$c],$matches2))
                {
						echo nl2br ("-------------- $matches2[0]  ---------- $c \n");
						
							/*This for loop will search for the deposit price. Once it finds it, it will break this loop.*/
								for($h = $c; $h< $lengthArray; $h++)
                                {
                                    if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$h],$matches5))
                                    {
                                        if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$h],$matches6))
                                        {
                                            echo nl2br ("Deposit :  $matches6[0] $c \n");
											$deposit = $matches6[0];
                                            break;
                                        }
                                   }
                                }
								
							/*This for loop will search for the rental price. Once it finds it, it will break this loop.*/
								for($j = $c; $j< $lengthArray; $j++)
                                {
                                    if(preg_match('/(?i)price|rent+?/',$parts[$j],$matches3))
                                    {
                                      //echo nl2br ("$matches3[0]  \n");
                                        for($k = $j; $k < $lengthArray; $k++)
                                        {
                                            if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$k],$matches4))
                                            {
                                                echo nl2br ("Price : $matches4[0] $c \n");    
												$rent = $matches4[0];
                                                break ;
                                            }                                                   
                                        }
                                        break;
									}
								}
                                                
							/*This for loop will search for the number of bathrooms. Once it finds it, it will break this loop.*/	
								for($l = $c; $l< $lengthArray; $l++)
                                {
                                    if(preg_match('/\b(?<!\d)(?i)bathrooms+?\b/',$parts[$l],$matches6))
                                    {
                                      //echo nl2br ("$matches6[0] $c \n");                  
										if(preg_match('/(?<!\d)\d{1}(?!\d)/',$parts[$l],$matches))
                                        {
                                            echo nl2br ("Bathrooms :  $matches[0] $c \n");
											$bath = $matches[0];
                                            break;
                                        }
                                    }
								}
								
							/*This for loop will search for the size of the property. Once it finds it, it will break the loop.*/	
								for($m = $c; $m< $lengthArray; $m++)
                                {
                                    if(preg_match('/\b(?<!\d)(?i)square|sqft|frSqFt+?\b/',$parts[$m],$matches7))
                                    {
                                        if(preg_match('/(?<!\d)(\d+)(\d+)(?!\d)/',$parts[$m],$matches))
                                        {
                                            echo nl2br ("Square Feet :  $matches[0] $c \n");
											$area = $matches[0];
                                            break;
                                        }
                                   }
                                }
							/*Breaks the if loop after it has executed all the statements within or if they do not match the if conditions*/
				    break;
				}
							/*End of for loop that searches for the 2BDRM suite*/
			}
			
							/*Fourth Main for Loop that finds details of 3 BDRM properties */
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
								for($h3 = $c; $d< $lengthArray; $h3++)
                                {
                                    if(preg_match('/(?i)deposit|Deposit:+?/',$parts[$h3],$matches5))
                                    {
                                        if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$h3],$matches6))
                                        {
                                            echo nl2br ("Deposit : $matches6[0] $c \n");
											$deposit = $matches6[0];
                                            break;
                                        }
                                    }
                                }
									
							                                             
							/*This for loop will search for the number of bathrooms. Once it finds it, it will break this loop.*/			  
								for($l3 = $c; $l3< $lengthArray; $l3++)
                                {
                                    if(preg_match('/\b(?<!\d)(?i)bathrooms+?\b/',$parts[$l3],$matches6))
                                    {
                                      //echo nl2br ("$matches6[0] $c \n");    
                                        if(preg_match('/(?<!\d)\d{1}(?!\d)/',$parts[$l3],$matches))
                                        {
                                            echo nl2br ("Bathrooms : $matches[0] $c \n");
											$baths = $matches[0];
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
                                                echo nl2br ("Square Feet : $matches[0] $c \n");
												$area = $matches[0];
                                                break;
                                            }
                                        }
                                    }
								
								/*This for loop will search for the rental price. Once it finds it, it will break this loop.*/
								for($j3 = $c; $j< $lengthArray; $j3++)
                                {
                                    if(preg_match('/(?i)price+|rent?/',$parts[$j3],$matches3))
                                    {
											for($k3 = $j3; $k3 < $lengthArray; $k3++)
                                            {
                                                if(preg_match('/\$\d+(?:\.\d+)?.*/',$parts[$k3],$matches4))
                                                {
                                                    echo nl2br ("Price : $matches4[0] $c \n");       
													$rent = $matches4[0];
                                                    break ;
                                                }
                                            }
                                    break;
									$a = array(
												"Property Type" => "3 BDRM",
												"Website" => $Url,
												"Rent" => $price,
												"Deposit" => $deposit,
												"Area" => $area,
												"Bathroom" => $baths,
												);
									
									$test =json_encode($a);
									echo $test;
                                    }
                                }
                                  
								  /*Breaks the if loop after it has executed all the statements within or if they do not match the if conditions*/
						break;
					}
			}
		/*End of Function Download ($Url)*/
}			
?>

