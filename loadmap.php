<html>
<head>
	<title>Library Heatmap</title>
	<script type="text/javascript" src="heatmap.js"></script>
    <script type="text/javascript" src="jquery-2.1.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libheatmap.css">
</head>
<body class="loadmapBody">
<?php
	$host="";
	$user="";
	$password="";
	$database="";
	mysql_connect($host,$user,$password);
	mysql_select_db($database);

  $dayOfWeek;
  if(isset($_POST[dayOfWeek])){
    $dayOfWeek = $_POST[dayOfWeek];
  }

  $weekday;
  $i = 0;
  while($i < count($dayOfWeek)){
    $weekday = $weekday . $dayOfWeek[$i] . ",";
    $i++;
  }
  $weekday = rtrim($weekday, ",");

  $date_from = "'" . $_POST[dateFrom] . " 00:00:00" . "'";
  $date_to = "'" . $_POST[dateTo] . " 23:59:59" . "'";

  $time_from = "'" . $_POST[timeFrom] . "'";
  $time_to = "'" . $_POST[timeTo] . "'";

  $weekdayStr;
  $x = 0;
  while($x < 7){
    $xstr = (string)$x;
    if(strpos($weekday, $xstr) !== false){
      switch ($x){
        case 0: $weekdayStr = $weekdayStr . "Monday, ";
                break;

        case 1: $weekdayStr = $weekdayStr . "Tuesday, ";
                break;

        case 2: $weekdayStr = $weekdayStr . "Wednesday, ";
                break;

        case 3: $weekdayStr = $weekdayStr . "Thursday, ";
                break;

        case 4: $weekdayStr = $weekdayStr . "Friday, ";
                break;

        case 5: $weekdayStr = $weekdayStr . "Saturday, ";
                break;

        case 6: $weekdayStr = $weekdayStr . "Sunday, ";
                break;
      }
    }
    $x++;  
  }
  $weekdayStr = rtrim($weekdayStr, ",");

  
	$sql1="SELECT coords.xcoord, coords.ycoord, coords.coordCount, walkthrough.patronCount, walkthrough.timedate, floorNumber.floor_num
	FROM (coords INNER JOIN floorNumber ON coords.floor_key = floorNumber.floor_key) INNER JOIN walkthrough ON coords.walkthrough_key = walkthrough.walkthrough_key
	WHERE (floorNumber.floor_num = 1 AND WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";

	$sql2="SELECT coords.xcoord, coords.ycoord, coords.coordCount, walkthrough.patronCount, walkthrough.timedate, floorNumber.floor_num
	FROM (coords INNER JOIN floorNumber ON coords.floor_key = floorNumber.floor_key) INNER JOIN walkthrough ON coords.walkthrough_key = walkthrough.walkthrough_key
	WHERE (floorNumber.floor_num = 2 AND WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";

	$sql3="SELECT coords.xcoord, coords.ycoord, coords.coordCount, walkthrough.patronCount, walkthrough.timedate, floorNumber.floor_num
	FROM (coords INNER JOIN floorNumber ON coords.floor_key = floorNumber.floor_key) INNER JOIN walkthrough ON coords.walkthrough_key = walkthrough.walkthrough_key
	WHERE (floorNumber.floor_num = 3) AND (WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";
 
	$sql4="SELECT coords.xcoord, coords.ycoord, coords.coordCount, walkthrough.patronCount, walkthrough.timedate, floorNumber.floor_num
	FROM (coords INNER JOIN floorNumber ON coords.floor_key = floorNumber.floor_key) INNER JOIN walkthrough ON coords.walkthrough_key = walkthrough.walkthrough_key
	WHERE (floorNumber.floor_num = 4 AND WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";

	$sql5="SELECT coords.xcoord, coords.ycoord, coords.coordCount, walkthrough.patronCount, walkthrough.timedate, floorNumber.floor_num
	FROM (coords INNER JOIN floorNumber ON coords.floor_key = floorNumber.floor_key) INNER JOIN walkthrough ON coords.walkthrough_key = walkthrough.walkthrough_key
	WHERE (floorNumber.floor_num = 5 AND WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";

  $sqlPCOUNT="SELECT SUM(walkthrough.patronCount) 
  FROM walkthrough 
  WHERE (WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";
  
  $sqlPCOUNT1fl="SELECT SUM(coords.coordCount) 
  FROM (coords INNER JOIN floorNumber ON coords.floor_key = floorNumber.floor_key) INNER JOIN walkthrough ON coords.walkthrough_key = walkthrough.walkthrough_key
  WHERE (floorNumber.floor_num = 1 AND WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";

  $sqlPCOUNT2fl="SELECT SUM(coords.coordCount) 
  FROM (coords INNER JOIN floorNumber ON coords.floor_key = floorNumber.floor_key) INNER JOIN walkthrough ON coords.walkthrough_key = walkthrough.walkthrough_key
  WHERE (floorNumber.floor_num = 2 AND WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";

  $sqlPCOUNT3fl="SELECT SUM(coords.coordCount) 
  FROM (coords INNER JOIN floorNumber ON coords.floor_key = floorNumber.floor_key) INNER JOIN walkthrough ON coords.walkthrough_key = walkthrough.walkthrough_key
  WHERE (floorNumber.floor_num = 3 AND WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";

  $sqlPCOUNT4fl="SELECT SUM(coords.coordCount) 
  FROM (coords INNER JOIN floorNumber ON coords.floor_key = floorNumber.floor_key) INNER JOIN walkthrough ON coords.walkthrough_key = walkthrough.walkthrough_key
  WHERE (floorNumber.floor_num = 4 AND WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";

  $sqlPCOUNT5fl="SELECT SUM(coords.coordCount) 
  FROM (coords INNER JOIN floorNumber ON coords.floor_key = floorNumber.floor_key) INNER JOIN walkthrough ON coords.walkthrough_key = walkthrough.walkthrough_key
  WHERE (floorNumber.floor_num = 5 AND WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)";

  $sqlWCOUNT="SELECT * 
  FROM walkthrough
  WHERE (WEEKDAY(walkthrough.timedate) IN ($weekday)) AND (walkthrough.timedate BETWEEN $date_from AND $date_to) AND (TIME(walkthrough.timedate) BETWEEN $time_from AND $time_to)
  ORDER BY walkthrough.timedate";

	$result1 = mysql_query($sql1);
	$result2 = mysql_query($sql2);
	$result3 = mysql_query($sql3);
	$result4 = mysql_query($sql4);
	$result5 = mysql_query($sql5);
	$resultP = mysql_query($sqlPCOUNT);
  $resultW = mysql_query($sqlWCOUNT);

  $count1fl = mysql_query($sqlPCOUNT1fl);
  $count2fl = mysql_query($sqlPCOUNT2fl);
  $count3fl = mysql_query($sqlPCOUNT3fl);
  $count4fl = mysql_query($sqlPCOUNT4fl);
  $count5fl = mysql_query($sqlPCOUNT5fl);

	$mapdots1 = "";
	$mapdots2 = "";
	$mapdots3 = "";
	$mapdots4 = "";
	$mapdots5 = "";

  $pCount = mysql_fetch_row($resultP);
  $pCount1 = mysql_fetch_row($count1fl);
  $pCount2 = mysql_fetch_row($count2fl);
  $pCount3 = mysql_fetch_row($count3fl);
  $pCount4 = mysql_fetch_row($count4fl);
  $pCount5 = mysql_fetch_row($count5fl);

  $walkthroughCount = mysql_num_rows($resultW);
  $patronCount = (int) $pCount[0];
  $patronCount1fl = (int) $pCount1[0];
  $patronCount2fl = (int) $pCount2[0];
  $patronCount3fl = (int) $pCount3[0];
  $patronCount4fl = (int) $pCount4[0];
  $patronCount5fl = (int) $pCount5[0];
  $avgPatrons = $patronCount / $walkthroughCount;

	while($row = mysql_fetch_array($result1))
  {
  	$mapdots1 .= "{" . "x: " . $row['xcoord'] . ", y: " . $row['ycoord'] . ", count: " . $row['coordCount'] . "},";
  }
  	$mapdots1 = rtrim($mapdots1, ',');
  	$mapdots1 = "[" . $mapdots1 . "]";

  	while($row = mysql_fetch_array($result2))
  {
  	$mapdots2 .= "{" . "x: " . $row['xcoord'] . ", y: " . $row['ycoord'] . ", count: " . $row['coordCount'] . "},";
  }
  	$mapdots2 = rtrim($mapdots2, ',');
  	$mapdots2 = "[" . $mapdots2 . "]";

  	while($row = mysql_fetch_array($result3))
  {
  	$mapdots3 .= "{" . "x: " . $row['xcoord'] . ", y: " . $row['ycoord'] . ", count: " . $row['coordCount'] . "},";
  }
  	$mapdots3 = rtrim($mapdots3, ',');
  	$mapdots3 = "[" . $mapdots3 . "]";

  	while($row = mysql_fetch_array($result4))
  {
  	$mapdots4 .= "{" . "x: " . $row['xcoord'] . ", y: " . $row['ycoord'] . ", count: " . $row['coordCount'] . "},";
  }
  	$mapdots4 = rtrim($mapdots4, ',');
  	$mapdots4 = "[" . $mapdots4 . "]";

  	while($row = mysql_fetch_array($result5))
  {
  	$mapdots5 .= "{" . "x: " . $row['xcoord'] . ", y: " . $row['ycoord'] . ", count: " . $row['coordCount'] . "},";
  }
  	$mapdots5 = rtrim($mapdots5, ',');
  	$mapdots5 = "[" . $mapdots5 . "]";


?>

	<div class="heatmapArea" class="well" style="width:1300px;padding:0;height:550px;cursor:pointer;position:relative;">
		<canvas class="libmap1" width="1600" height="832" style="position: absolute; top: 0px; left: 0px;"></canvas>
	</div>

<div class="tableContainer">
  <h3>Currently Displaying:</h3>
  <div class="statsOutput">
    <p><span class="statType">Date Range:</span> <?php echo $_POST[dateFrom]; ?> to <?php echo $_POST[dateTo]; ?></p>
    <p><span class="statType">Time Range:</span> <?php echo $_POST[timeFrom]; ?> to <?php echo $_POST[timeTo]; ?></p>
    <p><span class="statType">Days of the Week:</span> <?php echo $weekdayStr; ?></p>
    <p><span class="statType">Number of Walkthroughs:</span> <?php echo $walkthroughCount; ?></p>
    <p><span class="statType">Total Patron Count:</span><?php echo $patronCount . "<table class='pcountTable' border='1'><tr><th>1fl</th><th>2fl</th><th>3fl</th><th>4fl</th><th>5fl</th></tr><tr><td>" . $patronCount1fl . "</td><td>" . $patronCount2fl . "</td><td>" . $patronCount3fl . "</td><td>" . $patronCount4fl . "</td><td>" . $patronCount5fl . "</td></tr></table>"; ?></p>
    <p><span class="statType">Average Patron Count (per Walkthrough):</span> <?php echo $avgPatrons; ?></p>
  </div>

  <div class="wTable">
  <?php
  echo "<table border='1'><tr><th>Timestamp</th><th>Patron Count</th><th>Initials</th></tr>";

  while($row = mysql_fetch_array($resultW))
  {
    echo "<tr>";
    echo "<td>" . $row['timedate'] . "</td>";
    echo "<td>" . $row['patronCount'] . "</td>";
    echo "<td>" . $row['initials'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";

  ?>
  </div>
</div>

<div class="floorNav">
  <button type="button" class="floorButtons" id="button1fl">1st floor</button>
  <button type="button" class="floorButtons" id="button2fl">2nd floor</button>
  <button type="button" class="floorButtons" id="button3fl">3rd floor</button>
  <button type="button" class="floorButtons" id="button4fl">4th floor</button>
  <button type="button" class="floorButtons" id="button5fl">5th floor</button>
</div>

<div class="inputForm">
  <form method="post" action="loadmap.php">
    <div id="dateRng">
      <div class="formLabel"><p>DATE RANGE</p></div>
	     <input type="date" id="dateFrom" name="dateFrom" value="2014-03-01"/>
	     <input type="date" id="dateTo" name="dateTo" value="2019-12-31"/>
      </div>

    <div id="timeRng">
      <div class="formLabel"><p>TIME RANGE</p></div>
      <input type="time" id="timeFrom" name="timeFrom" value="00:00:00"/>
      <input type="time" id="timeTo" name="timeTo" value="23:59:00"/>
    </div>

    <div id="dayWeek">
      <div class="formLabel"><p>DAY OF WEEK</p></div>
      <div class="daybox"><input type="checkbox" name="dayOfWeek[]" id="dayOfWeek" value = "0" checked>Monday</div>
      <div class="daybox"><input type="checkbox" name="dayOfWeek[]" id="dayOfWeek" value = "1" checked>Tuesday</div>
      <div class="daybox"><input type="checkbox" name="dayOfWeek[]" id="dayOfWeek" value = "2" checked>Wednesday</div>
      <div class="daybox"><input type="checkbox" name="dayOfWeek[]" id="dayOfWeek" value = "3" checked>Thursday</div>
      <div class="daybox"><input type="checkbox" name="dayOfWeek[]" id="dayOfWeek" value = "4" checked>Friday</div>
      <div class="daybox"><input type="checkbox" name="dayOfWeek[]" id="dayOfWeek" value = "5" checked>Saturday</div>
      <div class="daybox"><input type="checkbox" name="dayOfWeek[]" id="dayOfWeek" value = "6" checked>Sunday</div>
    </div>
    
    <input type="submit" id="filter" value="Submit" />
  
    <a href="http://timdannay.com/building/heatmap_v2/hmap.html"><button type="button">New Walkthrough</button></a>

  </form>
</div>

<script type="text/javascript">
window.onload = function(){

    // heatmap configuration
    var config = {
        container: document.querySelector(".heatmapArea"),
        radius: 20,
        maxOpacity: .7,
    };
    
    //creates and initializes the heatmap
    var heatmap = h337.create(config);

    heatmap.setData({max: 3, min: 0, data: <?php echo $mapdots3; ?> });


    function findFloorNum(){
        switch (currentFloor){
        case floormap.map1fl:
            currentFloorNum = 1;
            break;
        case floormap.map2fl:
            currentFloorNum = 2;
            break;
        case floormap.map3fl:
            currentFloorNum = 3;
            break;
        case floormap.map4fl:
            currentFloorNum = 4;
            break;
        case floormap.map5fl:
            currentFloorNum = 5;
            break;
        };
    }

    $("#button1fl").click(function(){
        findFloorNum();
        currentFloor = floormap.map1fl;
        imageObj.src = currentFloor;
        context.drawImage(imageObj, 0, 0);
        heatmap.setData({max: 3, min: 0, data: <?php echo $mapdots1; ?> });
    });

    $("#button2fl").click(function(){
        findFloorNum();
        currentFloor = floormap.map2fl;
        imageObj.src = currentFloor;
        context.drawImage(imageObj, 0, 0);
        heatmap.setData({max: 3, min: 0, data: <?php echo $mapdots2; ?> });
    });

    $("#button3fl").click(function(){
        findFloorNum();
        currentFloor = floormap.map3fl;
        imageObj.src = currentFloor;
        context.drawImage(imageObj, 0, 0);
        heatmap.setData({max: 3, min: 0, data: <?php echo $mapdots3; ?> });
    });

    $("#button4fl").click(function(){
        findFloorNum();
        currentFloor = floormap.map4fl;
        imageObj.src = currentFloor;
        context.drawImage(imageObj, 0, 0);
        heatmap.setData({max: 3, min: 0, data: <?php echo $mapdots4; ?> });
    });

    $("#button5fl").click(function(){
        findFloorNum();
        currentFloor = floormap.map5fl;
        imageObj.src = currentFloor;
        context.drawImage(imageObj, 0, 0);
        heatmap.setData({max: 3, min: 0, data: <?php echo $mapdots5; ?> });
    });

};

floormap = {
    map1fl: 'http://timdannay.com/building/heatmap_v2/v2_1fl.jpg',
    map2fl: 'http://timdannay.com/building/heatmap_v2/v2_2fl.jpg',
    map3fl: 'http://timdannay.com/building/heatmap_v2/v2_3fl.jpg',
    map4fl: 'http://timdannay.com/building/heatmap_v2/v2_4fl.jpg',
    map5fl: 'http://timdannay.com/building/heatmap_v2/v2_5fl.jpg',
};


var currentFloor = floormap.map3fl;

//canvas and background image creation
var canvas = document.querySelector(".libmap1");
var context = canvas.getContext("2d");
var imageObj = new Image();

imageObj.onload = function() {
context.drawImage(imageObj, 0, 0);
};

imageObj.src = currentFloor;

</script>
</body>
</html>
