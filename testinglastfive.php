<html>
<head>
	
	
    <title>Kelson Group: Rent Comparisson Tool</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
</head>
<body>
<div id="base">
    <div id="block">
        <div class="row">
            <div id="header">
                <div id="title"><h1>Kelson Group: Rent Comparisson Tool</h1></div>
                <div id="nav">
                    <ul>
                        <li><a href="http://localhost/folder/Automated-report-generator/Front%20Page.php">Dashboard</a></li>
                        <li><a href="http://localhost/folder/Automated-report-generator/testinglastfive.php">Reports</a></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </div>
                <div id="logout">Welcome, Jason <a href="#">LOGOUT</a></div>
            </div>
        </div>
</body>
</html>

<?php
	
	
	$accounts = mysql_connect("localhost", "root", "")
			or die(mysql_error());
		mysql_select_db("Kelson_test", $accounts);
		
	$sql = mysql_query("SELECT Kelson_test.scraped_data.Report_ID, Kelson_test.scraped_data.Timestamp
				FROM Kelson_test.scraped_data
					ORDER BY Kelson_test.scraped_data.Report_ID DESC 
							LIMIT 10")or die('Error: ' .mysql_error());
		
	
     while($row = mysql_fetch_assoc($sql))
		{
			foreach($row as $key => $value)
			{
				echo "$key: $value <br/>\n";
			}
		}
 
	
?>