<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/main.css">
	<title>Subjects Information</title>
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
	#supply
	{
		background: rgb(229,76,16);
		color: white;
		margin: 10% 0;
	}
	</style>
	
</head>

<?php
	include 'db_connect.php';
	@ $db = new mysqli($db_host, $db_root, $db_password, $db_name);
	if (mysqli_connect_errno()) 
	{
		echo "Error: Could not connect to database. Please try again later.";
		exit;
	}
	$rollno = $_POST['Name'];
	$query = "select * from subjects where semester_no = '$rollno'";
	$result = $db->query($query);
	$num_results = $result->num_rows;
	$count=0;
	echo "<p>Number of Results found: ".$num_results."</p>";
	?>
	<table class="inventory" width="100%">
		<caption>
			
		</caption>
		<colgroup>
			<col id="Srno">
			<col id="Roll">
			<col id="SubjectName">
			<col id="ObtainedCredit">
			<col id="TotalCredit">
		</colgroup>
		<tr>
			<th scope="col">Sr. No.</th>
			<th scope="col">Roll Number</th>
			<th scope="col">Subject Name</th>
			<th scope="col">Obtained Credit</th>
			<th scope="col">Total Credit</th>
		</tr>
		<tr>
		
	<?php
	for ($i=0; $i <$num_results; $i++) 
	{
		$row = $result->fetch_assoc();
		?>
		<td><?php echo ($i+1) ?></td>
		<td><?php echo stripslashes($row['roll_no'])?></td>
		<td><?php echo htmlspecialchars(stripslashes($row['subject_name']))?></td>
		<td><?php echo stripslashes($row['ObtainCR']) ?></td>
		<td><?php echo stripslashes($row['TotalCR']) ?></td>
	</tr>
		<?php
		if(stripslashes($row['ObtainCR']) =="0")
		{
			$count++;
		}
		
	}
	?>
	</tr>
	</table>
	<?php
	if($count==0)
	{
		?>
		<p id="supply">
			<?php
				echo "Well Done All Clear";
			?>
		</p>
		<?php
	}
	else
	{
		?>
		<p id="supply">
			<?php
				echo "$count Supplies";
			?>
		</p>
		<?php
	}
?>

</html>