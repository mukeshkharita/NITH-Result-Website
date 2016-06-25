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
	$query = "select * from subjects where semester_no = '$rollno'";
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
	}
	?>
	</tr>
	</table>
	<?php
?>
</html>