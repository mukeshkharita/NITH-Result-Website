<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/main.css">
	<title>Semesters Information</title>
	<style type="text/css">
	p{
		text-align: center;
		font-size: 2.5em;
	}
	#getit
	{
		  background: rgb(229,76,16);
		  margin-top: 10px;
		  margin: 0 30%;
	}
	</style>
</head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
<?php
	include 'db_connect.php';
	@ $db = new mysqli($db_host, $db_root, $db_password, $db_name);
	if (mysqli_connect_errno()) 
	{
		echo "Error: Could not connect to database. Please try again later.";
		exit;
	}
	$rollno = $_POST['Name'];
	$cgpiAgg = $_POST['CGPI'];
	$query = "select * from semesters where roll_no = '$rollno'";
	$result = $db->query($query);
	$num_results = $result->num_rows;
	echo "<p>Number of Results found: ".$num_results."</p>";
	?>
	<table class="inventory" width="100%">
		<caption>
			
		</caption>
		<colgroup>
			<col id="Semester No">
			<col id="Roll">
			<col id="SGPI">
			<col id="CGPI">
			<col id="Info">
		</colgroup>
		<tr>
			<th scope="col">Semester. No.</th>
			<th scope="col">Roll Number</th>
			<th scope="col">SGPI</th>
			<th scope="col">CGPI</th>
			<th scope="col">Semester Information</th>
		</tr>
		<tr>
	<script type="text/javascript">
	var list = [];
	var singleObj = ['Semester Number','SGPI','CGPI','AggCGPI'];
	list.push(singleObj);
	</script>
	<?php
	for ($i=0; $i <$num_results; $i++) 
	{
		$row = $result->fetch_assoc();
		?>
		<td><?php echo ($i+1) ?></td>
		<td><?php echo stripslashes($row['roll_no'])?></td>
		<td><?php echo htmlspecialchars(stripslashes($row['sgpi']))?></td>
		<td><?php echo stripslashes($row['cgpi']) ?></td>
		<td>
			<form action="subjects.php" method="post">
				<input type="hidden" value="<?php echo ($row['roll_no'].($i+1)) ?>" id="getit" name="Name">
				<input type="submit" value="Get It" id="getit" name="Submit">
			</form>
		</td>
	</tr>
	<script type="text/javascript">
	singleObj = [];
	singleObj[0] = <?php echo ($i+1) ?>;
	singleObj[1] = <?php echo htmlspecialchars(stripslashes($row['sgpi']))?>;
	singleObj[2] = <?php echo stripslashes($row['cgpi']) ?>;
	singleObj[3] = <?php echo $cgpiAgg ?>;
	list.push(singleObj);
	</script>
		<?php
	}
	?>
	</tr>
	</table>
	<?php
?>
<body>
    <div id="chart_div" style="width:760px; height: 500px;;"></div>
    <script type="text/javascript">
   // var str = JSON.stringify(list, null, 2);
    //console.log(str);
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(list);

        var options = {
          title: 'Performance using Graph',
          hAxis: {title: 'Semester Number',  titleTextStyle: {color: 'rgb(229,76,16)'}},
          vAxis: {minValue: 0,title: 'SGPI',  titleTextStyle: {color: 'rgb(229,76,16)'},maxValue:10}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
 </body>
</html>