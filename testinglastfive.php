<?php
	include ("Controlller.php");	
	$accounts = mysql_connect("localhost", "root", "root")or die(mysql_error());
	mysql_select_db("Kelson_test", $accounts);
		
	$sql = mysql_query("SELECT id , TIME FROM scraped_data ORDER BY id DESC LIMIT 5")or die('Error: ' .mysql_error());
		 
	$t = array();
	$r = array();
	$i = 0;
	$j = 0;
	
     while($row = mysql_fetch_assoc($sql))
		{
			foreach($row as $key => $value)
			{
				if($key == "id")
				{
					$j++;
					$r[$j] = $value;
				}
					
				if($key == "TIME")
				{
					$i++;
					$t[$i] = $value;
				}
				
				
			}
		}
?>
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
		 <div id="report">
                    <table>
                        <thead>
                            <tr>
                                <th> Report ID</th>
								<th> Date Generated </th>
                                </tr>
                        </thead>
		<div class="row">
            <div id="content">
			<div id="report_header">
                    
                        <h2> Reports Available </h2>
                        <p><script type="text/javascript">
						document.write ('<p> Current Date and Time: <span id="date-time">', new Date().toLocaleString(), '<\/span><\/p>')
						if (document.getElementById) onload = function () 
						{
							setInterval ("document.getElementById ('date-time').firstChild.data = new Date().toLocaleString()", 25)
						}
						</script></p>
                  
		<tr>
		<td>  <form action = "template.php" method = "POST"> <?php print_r($r[1]); ?></td> <td> <input type = "Submit" name = "timestamp" value = "<?php print_r($t[1]); ?>" </td> 
			</form>
		</tr>
		<tr>
		<td> <form action = "template.php" method = "POST"> <?php print_r($r[2]); ?></td> <td> <input type = "Submit"  name = "timestamp" value = "<?php print_r($t[2]); ?>"</td>
			</form>
		</tr>
		<tr>
		<td> <form action = "template.php" method = "POST"> <?php print_r($r[3]); ?></td> <td> <input type = "Submit" name = "timestamp" value = "<?php print_r($t[3]); ?>"</td>
			</form>
		</tr>
		<tr>
		<td>  <form action = "template.php" method = "POST"><?php print_r($r[4]); ?></td> <td> <input type = "Submit" name = "timestamp" value = "<?php print_r($t[4]); ?>"</td>
			</form>
		</tr>
		<tr>
		<td>  <form action = "template.php" method = "POST"><?php print_r($r[5]); ?></td> <td> <input type = "Submit" name = "timestamp" value = "<?php print_r($t[5]); ?>"</td>
			</form>
		<tr>
			<td> <form action = "Controlller.php" method = "POST"> <input type = "Submit" name = "yes" value = "Scrape Current Data"> </td>
		</tr>
		</tr>
		</tr>
		</div>
		</div>
		</div>
		
</body>
</html>

