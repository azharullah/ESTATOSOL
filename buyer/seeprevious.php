<?php

	session_start();
	if($_SESSION['buyer'] == '')
	{
		header("Location:../index.html");
	}
	if($_SESSION['name'] == '')
	{
		header("Location:../index.html");
	}

	$name = $_SESSION['name'];
	$buyerid = $_SESSION['buyer'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> <?php echo $name; ?> </title>
	<link rel="stylesheet" type="text/css" href="css/seeprev.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<!--<script src="../js/materialize.js"></script>-->
	<link rel="stylesheet" href="../css/materialize.css">
</head>
<body>

	<center>
	
	<h4> Hi <?php echo $name; ?>...Here are your previously purchased properties </h4>

	<?php  

		require "../login/connectdb.php";

		$sql = "SELECT * FROM SOLD WHERE BUYER_ID = '$buyerid'";
		$query = mysql_query($sql,$mysql_conn);
		if(!$query)
		{
			die('<div class="errmsg">Cannot get your properties, try again later...</div>');
		}		
		while($row = mysql_fetch_assoc($query))
		{
			$propid = $row['PROP_ID'];

				$sql2 = "SELECT * FROM ADDRESS WHERE PROP_ID = '$propid'";
				$query2 = mysql_query($sql2,$mysql_conn);
				$row3 = mysql_fetch_assoc($query2);

				$pname = $row3['PROP_NAME'];
				$locality = $row3['AREA'];
				$city = $row3['CITY'];
				$state = $row3['STATE'];
				$zip = $row3['ZIP'];
				echo "<div class='properties'>";
					echo '<div class="pdet1">';
						echo '<center><p class="type">PROPERTY ID</p></center>';
						echo '<p> '.$propid.' </p>';
					echo '</div>';
					echo '<div class="pdet3">';
						echo '<center><p class="type">ADDRESS</p></center>';
						echo '<p> '.$locality.' </p>';
						echo '<p>'.$city.','.$state.'</p>';
						echo '<p> INDIA, '.$zip.'</p>';
					echo '</div>';
				echo '</div>';
				
		}
	?>
	
	</center>
</body>
</html>
