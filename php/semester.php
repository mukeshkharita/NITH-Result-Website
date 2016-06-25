<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/main.css">
	<style type="text/css">
	p{
		text-align: center;
		font-size: 2.5em;
	}
	#getit
	{
		  background: rgb(229,76,16);
		  margin-top: 10px;
	}
	</style>
</head>

<?php
	$db_user="root";
	$db_pass="justgoogleit";
	$db_name="results";
	@ $db = new mysqli('localhost', 'root', 'justgoogleit', 'results');
	if (mysqli_connect_errno()) 
	{
		echo "Error: Could not connect to database. Please try again later.";
		exit;
	}
	$rollno = $_POST['Name'];
	$query = "select * from semesters where roll_no = '$rollno' order by cgpi desc";
	$result = $db->query($query);
	$num_results = $result->num_rows;
	echo "<p>Number of Results found: ".$num_results."</p>";
	?>
	<table class="inventory" width="100%">
		<caption>
			
		</caption>
		<colgroup>
			<col id="Srno">
			<col id="Roll">
			<col id="SGPI">
			<col id="CGPI">
		</colgroup>
		<tr>
			<th scope="col">Sr. No.</th>
			<th scope="col">Roll Number</th>
			<th scope="col">SGPI</th>
			<th scope="col">CGPI</th>
		</tr>
		<tr>
		
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
				<input type="submit" value="<?php echo ($row['roll_no'].($i+1)) ?>" id="getit" name="Name">
			</form>
		</td>
	</tr>
		<?php
	}
	?>
	</tr>
	</table>
	<?php
?>
</html>