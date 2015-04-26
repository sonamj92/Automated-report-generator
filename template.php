<!DOCTYPE html>

<html>
	
<head>
	
	
    <title>Kelson Group: Rent Comparisson Tool</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
</head>
<body>
<?php include("Controlller.php");
	$ok = new Controlller;
	$data = $ok -> callme();
	print_r($data);
	?>
<div id="base">
    <div id="block">
        <div class="row">
            <div id="header">
                <div id="title"><h1>Kelson Group: Rent Comparisson Tool</h1></div>
                <div id="nav">
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </div>
                <div id="logout">Welcome, Jason <a href="#">LOGOUT</a></div>
            </div>
        </div>

        <div class="row">
            <div id="content">
                <div id="report_header">
                    <div id="report_title">
                        <h2>Report: Callingwood / Bach</h2>
                        <p>June 3, 2015 at 01:00</p>
                    </div>
                    <div id="report_actions">
                        <a href="#">Create PDF</a><br/>
                        <table align="right">
                            <tr>
                                <td>LEGEND:</td>
                                <td class="highest">&nbsp</td>
                                <td> HIGHEST</td>
                                <td class="lowest">&nbsp;</td>
                                <td> LOWEST</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="report">
                    <table>
                        <thead>
                            <tr>
                                <th>Building / Type</th>
                                <th>Rent</th>
                                <th>Bath</th>
                                <th>Sq. Ft.</th>
                                <th>Deposit</th>
                                </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Callingwood / Bach</td>
                                <td>$895.00</td>
                                <td>1</td>
                                <td>487</td>
                                <td class="lowest">$495.00</td>
                                </tr>
                            <tr>
                                <td>Fairmont Village / Bach</td>
                                <td class="lowest"><?php if($data['Bwalk1']['Fairmont Village']['Bachelor']['Rent'] == null) 
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['Bachelor']['Rent']); 
													?>
								</td>
                                <td><?php if($data['Bwalk1']['Fairmont Village']['Bachelor']['Bathroom'] == null) 
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['Bachelor']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Bwalk1']['Fairmont Village']['Bachelor']['Area'] == null) 
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['Bachelor']['Area']); 
									?>
								</td>
                                <td><?php if($data['Bwalk1']['Fairmont Village']['Bachelor']['Deposit'] == null||$data['Bwalk1']['Fairmont Village']['Bachelor']['Deposit'] == 0)
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['Bachelor']['Deposit']); 
									?>
								</td>
                             </tr>
                            <tr>
                                <td> Meadowview Manor </td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['Bachelor']['Rent'] == null) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['Bachelor']['Rent']); 
													?>
								</td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['Bachelor']['Bathroom'] == null) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['Bachelor']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['Bachelor']['Area'] == null) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['Bachelor']['Area']); 
									?>
								</td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['Bachelor']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['Bachelor']['Deposit']); 
									?>
                                </tr>
                            <tr>
                                <td>Southgate / Bach</td>
                                 <td><?php if($data['Southgate']['Southgate']['Bachelor']['Rent'] == null) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['Bachelor']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Southgate']['Southgate']['Bachelor']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['Bachelor']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Southgate']['Southgate']['Bachelor']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['Bachelor']['Area']); 
									?>
								</td>
                                <td><?php if($data['Southgate']['Southgate']['Bachelor']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['Bachelor']['Deposit']); 
									?>
								</td>
                                 </tr>
                            <tr>
                                <td>Blue Quill Garden/ Bach</td>
                               
							   <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['Bachelor']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['Bachelor']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['Bachelor']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['Bachelor']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['Bachelor']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['Bachelor']['Area']); 
									?>
								</td>
                                <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['Bachelor']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['Bachelor']['Deposit']); 
									?>
								</td>
								</tr>
                            <tr>
                                <td>Pineridge / Bach</td>
                                <td><?php if($data['Pineridge']['Pineridge']['Bachelor']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['Bachelor']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Pineridge']['Pineridge']['Bachelor']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['Bachelor']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Pineridge']['Pineridge']['Bachelor']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['Bachelor']['Area']); 
									?>
								</td>
                                <td><?php if($data['Pineridge']['Pineridge']['Bachelor']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['Bachelor']['Deposit']); 
									?>
								</td>
                                </tr>
							
							<tr>
                                <td>Wellington Courts / Bach</td>
                               <td><?php if($data['Wellington Courts']['Wellington Courts']['Bachelor']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['Bachelor']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Wellington Courts']['Wellington Courts']['Bachelor']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['Bachelor']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Wellington Courts']['Wellington Courts']['Bachelor']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['Bachelor']['Area']); 
									?>
								</td>
                                <td><?php if($data['Wellington Courts']['Wellington Courts']['Bachelor']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['Bachelor']['Deposit']); 
									?>
								</td>
                                </tr>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Averages:</td>
                                <td>$892.00</td>
                                <td>1</td>
                                <td>538</td>
                                <td>$520.00</td>
                                </tr>
                        </tfoot>
                    </table>
                </div>
				       <div id="report">
                    <table>
                        <thead>
                            <tr>
                                <th>Building / Type</th>
                                <th>Rent</th>
                                <th>Bath</th>
                                <th>Sq. Ft.</th>
                                <th>Deposit</th>
                                </tr>
                        </thead>
			<div class="row">
            <div id="content">
                <div id="report_header">
                    <div id="report_title">
                        <h2>Report: Callingwood / 1 Bedroom </h2>
                        <p>June 3, 2015 at 01:00</p>
                    </div>
                            <tr>
                                <td>Callingwood / 1 Bedroom </td>
                                <td>$895.00</td>
                                <td>1</td>
                                <td>487</td>
                                <td class="lowest">$495.00</td>
                                </tr>
                            <tr>
                                <td>Fairmont Village /1 Bedroom</td>
                                <td class="lowest"><?php if(($data['Bwalk1']['Fairmont Village']['1BD']['Deposit']) == null||($data['Bwalk1']['Fairmont Village']['1BD']['Deposit'] == 0))
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['1BD']['Rent']); 
													?>
								</td>
                                <td><?php if($data['Bwalk1']['Fairmont Village']['1BD']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['1BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Bwalk1']['Fairmont Village']['1BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['1BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Bwalk1']['Fairmont Village']['1BD']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['1BD']['Deposit']); 
									?>
								</td>
                             </tr>
                            <tr>
                                <td> Meadowview Manor </td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['1BD']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['1BD']['Rent']); 
													?>
								</td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['1BD']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['1BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['1BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['1BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['1BD']['Deposit'] == null) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['1BD']['Deposit']); 
									?>
                                </tr>
                            <tr>
                                <td>Southgate / 1 Bedroom </td>
                                 <td><?php if($data['Southgate']['Southgate']['1BD']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['1BD']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Southgate']['Southgate']['1BD']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['1BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Southgate']['Southgate']['1BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['1BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Southgate']['Southgate']['1BD']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['1BD']['Deposit']); 
									?>
								</td>
                                 </tr>
                            <tr>
                                <td>Blue Quill Garden/ 1 Bedroom </td>
                               
							   <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['1BD']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['1BD']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['1BD']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['1BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['1BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['1BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['1BD']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['1BD']['Deposit']); 
									?>
								</td>
								</tr>
                            <tr>
                                <td>Pineridge / 1 Bedroom </td>
                                <td><?php if($data['Pineridge']['Pineridge']['1BD']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['1BD']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Pineridge']['Pineridge']['1BD']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['1BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Pineridge']['Pineridge']['1BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['1BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Pineridge']['Pineridge']['1BD']['Deposit'] == null||$data['Pineridge']['Pineridge']['1BD']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['1BD']['Deposit']); 
									?>
								</td>
                                </tr>
							
							<tr>
                                <td>Wellington Courts / 1 Bedroom </td>
                               <td><?php if($data['Wellington Courts']['Wellington Courts']['1BD']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['1BD']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Wellington Courts']['Wellington Courts']['1BD']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['1BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Wellington Courts']['Wellington Courts']['1BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['1BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Wellington Courts']['Wellington Courts']['1BD']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['1BD']['Deposit']); 
									?>
								</td>
                                </tr>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Averages:</td>
                                <td>$892.00</td>
                                <td>1</td>
                                <td>538</td>
                                <td>$520.00</td>
                                </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
		
						       <div id="report">
                    <table>
                        <thead>
                            <tr>
                                <th>Building / Type</th>
                                <th>Rent</th>
                                <th>Bath</th>
                                <th>Sq. Ft.</th>
                                <th>Deposit</th>
                                </tr>
                        </thead>
			<div class="row">
            <div id="content">
                <div id="report_header">
                    <div id="report_title">
                        <h2>Report: Callingwood / 2 Bedroom </h2>
                        <p>June 3, 2015 at 01:00</p>
                    </div>
                            <tr>
                                <td>Callingwood / 2 Bedroom </td>
                                <td>$895.00</td>
                                <td>1</td>
                                <td>487</td>
                                <td class="lowest">$495.00</td>
                                </tr>
                            <tr>
                                <td>Fairmont Village /2 Bedroom</td>
                                <td class="lowest"><?php if(($data['Bwalk1']['Fairmont Village']['2BD']['Deposit']) == null)
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['2BD']['Rent']); 
													?>
								</td>
                                <td><?php if($data['Bwalk1']['Fairmont Village']['2BD']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['2BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Bwalk1']['Fairmont Village']['2BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['2BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Bwalk1']['Fairmont Village']['2BD']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk1']['Fairmont Village']['2BD']['Deposit']); 
									?>
								</td>
                             </tr>
                            <tr>
                                <td> Meadowview Manor / 2 Bedroom  </td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['2BD']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['2BD']['Rent']); 
													?>
								</td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['2BD']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['2BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['2BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['2BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Bwalk2']['Meadowview-Manor']['2BD']['Deposit'] == null) 
															echo "NA";
														else
															print_r($data['Bwalk2']['Meadowview-Manor']['2BD']['Deposit']); 
									?>
                                </tr>
                            <tr>
                                <td>Southgate / 2 Bedroom </td>
                                 <td><?php if($data['Southgate']['Southgate']['2BD']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['2BD']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Southgate']['Southgate']['2BD']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['2BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Southgate']['Southgate']['2BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['2BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Southgate']['Southgate']['2BD']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Southgate']['Southgate']['2BD']['Deposit']); 
									?>
								</td>
                                 </tr>
                            <tr>
                                <td>Blue Quill Garden/ 2 Bedroom </td>
                               
							   <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['2BD']['Rent'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['2BD']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['2BD']['Bathroom'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['2BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['2BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['2BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Blue Quill Gardens']['Blue Quill Gardens']['2BD']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Blue Quill Gardens']['Blue Quill Gardens']['2BD']['Deposit']); 
									?>
								</td>
								</tr>
                            <tr>
                                <td>Pineridge / 2 Bedroom </td>
                                <td><?php if($data['Pineridge']['Pineridge']['2BD']['Rent'] == null) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['2BD']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Pineridge']['Pineridge']['2BD']['Bathroom'] == null) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['2BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Pineridge']['Pineridge']['2BD']['Area'] == null) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['2BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Pineridge']['Pineridge']['2BD']['Deposit'] == null) 
															echo "NA";
														else
															print_r($data['Pineridge']['Pineridge']['2BD']['Deposit']); 
									?>
								</td>
                                </tr>
							
							<tr>
                                <td>Wellington Courts / 2 Bedroom </td>
                               <td><?php if($data['Wellington Courts']['Wellington Courts']['2BD']['Rent'] == null) 
															echo "";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['2BD']['Rent']); 
									?>
								</td>
                                <td><?php if($data['Wellington Courts']['Wellington Courts']['1BD']['Bathroom'] == null) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['2BD']['Bathroom']); 
									?>
								</td>
                                <td><?php if($data['Wellington Courts']['Wellington Courts']['2BD']['Area'] == 0) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['2BD']['Area']); 
									?>
								</td>
                                <td><?php if($data['Wellington Courts']['Wellington Courts']['2BD']['Deposit'] == 0) 
															echo "NA";
														else
															print_r($data['Wellington Courts']['Wellington Courts']['2BD']['Deposit']); 
									?>
								</td>
                                </tr>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Averages:</td>
                                <td>$892.00</td>
                                <td>1</td>
                                <td>538</td>
                                <td>$520.00</td>
                                </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <div class="row">
            <div id="footer">
                <div id="footer_left"></div>
                <div id="footer_right"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>