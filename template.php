
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
	$ok -> callme();
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
                                <th>Pets</th>
                                <th>Pet Deposit</th>
                                <th>Includes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Callingwood / Bach</td>
                                <td>$895.00</td>
                                <td>1</td>
                                <td>487</td>
                                <td class="lowest">$495.00</td>
                                <td>Cats</td>
                                <td class="lowest">$95.00</td>
                                <td>Fridge, Stove, Dishwasher</td>
                            </tr>
                            <tr>
                                <td>Competition 1 / Bach</td>
                                <td class="lowest">$850.00</td>
                                <td>1</td>
                                <td>592</td>
                                <td>$500.00</td>
                                <td>No</td>
                                <td>-</td>
                                <td>Fridge, Stove, Dishwasher</td>
                            </tr>
                            <tr>
                                <td>Competition 2 / Bach</td>
                                <td>$900.00</td>
                                <td>1</td>
                                <td>523</td>
                                <td>$500.00</td>
                                <td>Yes</td>
                                <td>$100</td>
                                <td>Fridge, Stove, Dishwasher</td>
                            </tr>
                            <tr>
                                <td>Competition 3 / Bach</td>
                                <td>$885.00</td>
                                <td>1</td>
                                <td class="lowest">480</td>
                                <td class="highest">$550.00</td>
                                <td>Cats</td>
                                <td class="highest">$150</td>
                                <td>Fridge, Stove, Dishwasher</td>
                            </tr>
                            <tr>
                                <td>Competition 4 / Bach</td>
                                <td>$900.00</td>
                                <td>1</td>
                                <td>600</td>
                                <td class="highest">$550.00</td>
                                <td>No</td>
                                <td>-</td>
                                <td>Fridge, Stove, Dishwasher</td>
                            </tr>
                            <tr>
                                <td>Competition 5 / Bach</td>
                                <td class="highest">$925.00</td>
                                <td>1</td>
                                <td>545</td>
                                <td>$525.00</td>
                                <td>No</td>
                                <td>-</td>
                                <td>Fridge, Stove, Dishwasher</td>
                            </tr>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Averages:</td>
                                <td>$892.00</td>
                                <td>1</td>
                                <td>538</td>
                                <td>$520.00</td>
                                <td>-</td>
                                <td>$118.33</td>
                                <td>-</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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
