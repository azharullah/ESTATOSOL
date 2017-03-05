<?php

	session_start();
	if($_SESSION['seller'] == '')
	{
		header("Location:../index.html");
	}
	if($_SESSION['name'] == '')
	{
		header("Location:../index.html");
	}

	$name = $_SESSION['name'];
	$seller = $_SESSION['seller'];
	error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> <?php echo $name; ?> </title>
	<link rel="stylesheet" type="text/css" href="css/seeprev.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" href="css/materialize.css">

</head>
<body>

	<center>
	
	<h1> Hi <?php echo $name; ?>...Here are your previously uploaded properties </h1>

	<?php  

		require "../login/connectdb.php";

		$sql = "SELECT * FROM PROPERTY WHERE SELLER_ID = '$seller' ORDER BY TIMEDATE DESC";
		$query = mysql_query($sql,$mysql_conn);
		if(!$query)
		{
			die('<div class="errmsg">Cannot get your properties, try again later...</div>');
		}		
		while($row = mysql_fetch_assoc($query))
		{
			$sno = $row['SNO'];
			$propid = $row['PROP_ID'];
			$type = $row['TYPE'];
			$price = $row['PRICE'];
			$area = $row['AREA'];
			$ros = $row['ROS'];
			if($ros == "R") $ros = "RENT"; elseif($ros == "S") $ros = "SALE";
			$image = $row['IMAGE'];
			$time = $row['TIMEDATE'];

			$url = "getimage.php?id=$sno";

			if($type == "Flat")
			{
				$sql1 = "SELECT * FROM FLAT WHERE PROP_ID = '$propid'";
				$query1 = mysql_query($sql1,$mysql_conn);
				$row2 = mysql_fetch_assoc($query1);

				$bhk = $row2['BHK'];
				$parking = $row2['PARKING'];
				if($parking == 1) $parking = "Yes"; elseif($parking == 0) $parking = "NO";
				$floorno = $row2['FLOORNO'];

				$sql2 = "SELECT * FROM ADDRESS WHERE PROP_ID = '$propid'";
				$query2 = mysql_query($sql2,$mysql_conn);
				$row3 = mysql_fetch_assoc($query2);

				$pname = $row3['PROP_NAME'];
				$locality = $row3['AREA'];
				$city = $row3['CITY'];
				$state = $row3['STATE'];
				$zip = $row3['ZIP'];
				echo "<div class='properties' style='background-image: url($url)'>";
					echo '<div class="pdet1">';
						echo '<p class="type"> Type : '.strtoupper($type).' / '.$ros.'</p>';
						echo '<p> Price : '.$price.' </p>';
						echo '<p> Area(SFT) : '.$area.' </p>';
						echo '<p> Uploaded on : '.$time.' </p>';
					echo '</div>';
					echo '<div class="pdet2">';
						if($parking != "-1") echo '<p class="type">Property Name :'.$pname.'</p>';
						echo '<p> BHK : '.$bhk.' </p>';
						echo '<p> Parking : '.$parking.' </p>';
						echo '<p> Floor No : '.$floorno.' </p>';
					echo '</div>';
					echo '<div class="pdet3">';
						echo '<center><p class="type">ADDRESS</p></center>';
						echo '<p> '.$locality.' </p>';
						echo '<p>'.$city.','.$state.'</p>';
						echo '<p> INDIA, '.$zip.'</p>';
					echo '</div>';
				echo '</div>';
				
			}
			if($type == "Villa")
			{
				$sql1 = "SELECT * FROM VILLA WHERE PROP_ID = '$propid'";
				$query1 = mysql_query($sql1,$mysql_conn);
				$row2 = mysql_fetch_assoc($query1);

				$nooffloors = $row2['NOOFFLOORS'];

				$sql2 = "SELECT * FROM ADDRESS WHERE PROP_ID = '$propid'";
				$query2 = mysql_query($sql2,$mysql_conn);
				$row3 = mysql_fetch_assoc($query2);

				$pname = $row3['PROP_NAME'];
				$locality = $row3['AREA'];
				$city = $row3['CITY'];
				$state = $row3['STATE'];
				$zip = $row3['ZIP'];
				echo "<div class='properties' style='background-image: url($url)'>";
					echo '<div class="pdet1">';
						echo '<p class="type"> Type : '.strtoupper($type).' / '.$ros.'</p>';
						echo '<p> Price : '.$price.' </p>';
						echo '<p> Area(SFT) : '.$area.' </p>';
						echo '<p> Uploaded on : '.$time.' </p>';
					echo '</div>';
					echo '<div class="pdet2">';
						if($parking != "-1") echo '<p class="type">Property Name :'.$pname.'</p>';
						echo '<p> NO. OF FLOORS : '.$nooffloors.' </p>';
					echo '</div>';
					echo '<div class="pdet3">';
						echo '<center><p class="type">ADDRESS</p></center>';
						echo '<p> '.$locality.' </p>';
						echo '<p>'.$city.','.$state.'</p>';
						echo '<p> INDIA, '.$zip.'</p>';
					echo '</div>';
				echo '</div>';
			}
			if($type == "Independent House")
			{
				$sql1 = "SELECT * FROM INDEPENDENTHOUSE WHERE PROP_ID = '$propid'";
				$query1 = mysql_query($sql1,$mysql_conn);
				$row2 = mysql_fetch_assoc($query1);

				$parking = $row2['PARKING'];
				if($parking == 1) $parking = "Yes"; elseif($parking == 0) $parking = "NO";

				$sql2 = "SELECT * FROM ADDRESS WHERE PROP_ID = '$propid'";
				$query2 = mysql_query($sql2,$mysql_conn);
				$row3 = mysql_fetch_assoc($query2);

				$pname = $row3['PROP_NAME'];
				$locality = $row3['AREA'];
				$city = $row3['CITY'];
				$state = $row3['STATE'];
				$zip = $row3['ZIP'];
				echo "<div class='properties' style='background-image: url($url)'>";
					echo '<div class="pdet1">';
						echo '<p class="type"> Type : '.strtoupper($type).' / '.$ros.'</p>';
						echo '<p> Price : '.$price.' </p>';
						echo '<p> Area(SFT) : '.$area.' </p>';
						echo '<p> Uploaded on : '.$time.' </p>';
					echo '</div>';
					echo '<div class="pdet2">';
						if($parking != "-1") echo '<p class="type">Property Name :'.$pname.'</p>';
						echo '<p> Parking : '.$parking.' </p>';
					echo '</div>';
					echo '<div class="pdet3">';
						echo '<center><p class="type">ADDRESS</p></center>';
						echo '<p> '.$locality.' </p>';
						echo '<p>'.$city.','.$state.'</p>';
						echo '<p> INDIA, '.$zip.'</p>';
					echo '</div>';
				echo '</div>';
			}
			if($type == "Plot")
			{
				$sql1 = "SELECT * FROM PLOT WHERE PROP_ID = '$propid'";
				$query1 = mysql_query($sql1,$mysql_conn);
				$row2 = mysql_fetch_assoc($query1);

				$plotno = $row2['PLOTNO'];

				$sql2 = "SELECT * FROM ADDRESS WHERE PROP_ID = '$propid'";
				$query2 = mysql_query($sql2,$mysql_conn);
				$row3 = mysql_fetch_assoc($query2);

				$pname = $row3['PROP_NAME'];
				$locality = $row3['AREA'];
				$city = $row3['CITY'];
				$state = $row3['STATE'];
				$zip = $row3['ZIP'];
				echo "<div class='properties' style='background-image: url($url)'>";
					echo '<div class="pdet1">';
						echo '<p class="type"> Type : '.strtoupper($type).' / '.$ros.'</p>';
						echo '<p> Price : '.$price.' </p>';
						echo '<p> Area(SFT) : '.$area.' </p>';
						echo '<p> Uploaded on : '.$time.' </p>';
					echo '</div>';
					echo '<div class="pdet2">';
						if($parking != "-1") echo '<p class="type">Property Name :'.$pname.'</p>';
						echo '<p> PLOT NO. : '.$plotno.' </p>';
					echo '</div>';
					echo '<div class="pdet3">';
						echo '<center><p class="type">ADDRESS</p></center>';
						echo '<p> '.$locality.' </p>';
						echo '<p>'.$city.','.$state.'</p>';
						echo '<p> INDIA, '.$zip.'</p>';
					echo '</div>';
				echo '</div>';
			}		
		}
	?>
	
	<!--<div class="properties" style="background-image: url(bg.jpg)">

		<div class="pdet1">
			
			<p class="type"> Type : Flat / Rent </p>
			<p> Price : 1000 </p>
			<p> area </p>
		</div>			
		<div class="pdet2">
			<p> Area : 4 </p>
			<p> Parking : yes </p>
			<p> Uploaded on : sdfhbv </p>
		</div>
		<div class="pdet3">
			<p>address line 1</p>
			<p> city, state</p>
			<p> country,zip</p>
		</div>
	</div>-->

	</center>
</body>
</html>
