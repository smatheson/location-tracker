<html>
<head>
	<title>Submitted</title>
</head>
<body>
	<h2>Your data has been submitted. Patron Count: <?php print_r($_POST[pcount]); ?></h2>
		
	<?php
		$host="";
		$user="";
		$password="";
		$database="";

		mysql_connect($host,$user,$password);
		mysql_select_db($database);

		$json1fl = $_POST[dot1fl];
		$json2fl = $_POST[dot2fl];
		$json3fl = $_POST[dot3fl];
		$json4fl = $_POST[dot4fl];
		$json5fl = $_POST[dot5fl];

		$insert1fl = json_decode($json1fl, true);
		$insert2fl = json_decode($json2fl, true);
		$insert3fl = json_decode($json3fl, true);
		$insert4fl = json_decode($json4fl, true);
		$insert5fl = json_decode($json5fl, true);

		$xcoord;
		$ycoord;
		$countCoord;

		$sql = "INSERT INTO walkthrough (patronCount, initials) VALUES (\"$_POST[pcount]\", \"$_POST[initials]\")";
		$result = mysql_query($sql);
		$insertID = mysql_insert_id();

		foreach($insert1fl['data'] as $coord){
			$xcoord = $coord['x'];
			$ycoord = $coord['y'];
			$countCoord = $coord['value'];

			$sql1 = "INSERT into coords(xcoord, ycoord, coordCount, walkthrough_key, floor_key) values($xcoord, $ycoord, $countCoord, $insertID, 1)";
			$result1 = mysql_query($sql1);	
		}


		foreach($insert2fl['data'] as $coord){
			$xcoord = $coord['x'];
			$ycoord = $coord['y'];
			$countCoord = $coord['value'];

			$sql2 = "INSERT into coords(xcoord, ycoord, coordCount, walkthrough_key, floor_key) values($xcoord, $ycoord, $countCoord, $insertID, 2)";
			$result2 = mysql_query($sql2);	
		}

		foreach($insert3fl['data'] as $coord){
			$xcoord = $coord['x'];
			$ycoord = $coord['y'];
			$countCoord = $coord['value'];

			$sql3 = "INSERT into coords(xcoord, ycoord, coordCount, walkthrough_key, floor_key) values($xcoord, $ycoord, $countCoord, $insertID, 3)";
			$result3 = mysql_query($sql3);	
		}

		foreach($insert4fl['data'] as $coord){
			$xcoord = $coord['x'];
			$ycoord = $coord['y'];
			$countCoord = $coord['value'];

			$sql4 = "INSERT into coords(xcoord, ycoord, coordCount, walkthrough_key, floor_key) values($xcoord, $ycoord, $countCoord, $insertID, 4)";
			$result4 = mysql_query($sql4);	
		}

		foreach($insert5fl['data'] as $coord){
			$xcoord = $coord['x'];
			$ycoord = $coord['y'];
			$countCoord = $coord['value'];

			$sql5 = "INSERT into coords(xcoord, ycoord, coordCount, walkthrough_key, floor_key) values($xcoord, $ycoord, $countCoord, $insertID, 5)";
			$result5 = mysql_query($sql5);	
		}
	?>

</body>
</html>