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

<?php

	if(isset($_POST['submit1']))
	{
		require "../login/connectdb.php";
	
		 $mcity = $_POST['city1'];
		 $mtype = $_POST['type1'];
		 $maxarea = $_POST['maxarea1'];
		 $maxcost = $_POST['maxprice1'];
	
		if($mtype == "All")
		{
			if(!empty($_POST['maxarea1']) && empty($_POST['maxprice1']))
			{
				//echo "maxarea set, maxcost not";
				$sql = "SELECT * FROM PROPERTY WHERE AREA<=$maxarea AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(empty($_POST['maxarea1']) && !empty($_POST['maxprice1']))
			{	
				//echo "maxarea not, maxcost set";
				$sql = "SELECT * FROM PROPERTY WHERE PRICE<=$maxcost AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(empty($_POST['maxarea1']) && empty($_POST['maxprice1']))
			{
				//echo "maxarea not, maxcost not";
				$sql = "SELECT * FROM PROPERTY WHERE ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(!empty($_POST['maxarea1']) && !empty($_POST['maxprice1']))
			{
				//echo "maxarea set, maxcost set";
				$sql = "SELECT * FROM PROPERTY WHERE PRICE<=$maxcost AND AREA<=$maxarea AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
		}
		if($mtype == "Flat")
		{
			$bhk = $_POST['bhk1'];
			if(!empty($_POST['maxarea1']) && empty($_POST['maxprice1']))
			{
				//echo "maxarea set, maxcost not";
				$sql = "SELECT * FROM PROPERTY,FLAT WHERE PROPERTY.AREA<=$maxarea AND PROPERTY.ROS='R' AND FLAT.BHK=$bhk ORDER BY PROPERTY.TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>'.mysql_error());
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(empty($_POST['maxarea1']) && !empty($_POST['maxprice1']))
			{	
				//echo "maxarea not, maxcost set";
				$sql = "SELECT * FROM PROPERTY,FLAT WHERE PROPERTY.PRICE<=$maxcost AND PROPERTY.ROS='R' AND FLAT.BHK=$bhk ORDER BY PROPERTY.TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(empty($_POST['maxarea1']) && empty($_POST['maxprice1']))
			{
				//echo "maxarea not, maxcost not";
				$sql = "SELECT * FROM PROPERTY,FLAT WHERE PROPERTY.ROS='R' AND FLAT.BHK=$bhk ORDER BY PROPERTY.TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>'.mysql_error());
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(!empty($_POST['maxarea1']) && !empty($_POST['maxprice1']))
			{
				//echo "maxarea set, maxcost set";
				$sql = "SELECT * FROM PROPERTY,FLAT WHERE PROPERTY.PRICE<=$maxcost AND PROPERTY.AREA<=$maxarea AND PROPERTY.ROS='R' AND FLAT.BHK=$bhk ORDER BY PROPERTY.TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
		}
		if($mtype == "Villa")
		{
			if(!empty($_POST['maxarea1']) && empty($_POST['maxprice1']))
			{
				//echo "maxarea set, maxcost not";
				$sql = "SELECT * FROM PROPERTY WHERE AREA<=$maxarea AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(empty($_POST['maxarea1']) && !empty($_POST['maxprice1']))
			{	
				//echo "maxarea not, maxcost set";
				$sql = "SELECT * FROM PROPERTY WHERE PRICE<=$maxcost AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(empty($_POST['maxarea1']) && empty($_POST['maxprice1']))
			{
				//echo "maxarea not, maxcost not";
				$sql = "SELECT * FROM PROPERTY WHERE ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(!empty($_POST['maxarea1']) && !empty($_POST['maxprice1']))
			{
				//echo "maxarea set, maxcost set";
				$sql = "SELECT * FROM PROPERTY WHERE PRICE<=$maxcost AND AREA<=$maxarea AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
		}
		if($mtype == "Independent House")
		{
			if(!empty($_POST['maxarea1']) && empty($_POST['maxprice1']))
			{
				//echo "maxarea set, maxcost not";
				$sql = "SELECT * FROM PROPERTY WHERE AREA<=$maxarea AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(empty($_POST['maxarea1']) && !empty($_POST['maxprice1']))
			{	
				//echo "maxarea not, maxcost set";
				$sql = "SELECT * FROM PROPERTY WHERE PRICE<=$maxcost AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(empty($_POST['maxarea1']) && empty($_POST['maxprice1']))
			{
				//echo "maxarea not, maxcost not";
				$sql = "SELECT * FROM PROPERTY WHERE ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(!empty($_POST['maxarea1']) && !empty($_POST['maxprice1']))
			{
				//echo "maxarea set, maxcost set";
				$sql = "SELECT * FROM PROPERTY WHERE PRICE<=$maxcost AND AREA<=$maxarea AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
		}
		if($mtype == "Plot")
		{
			if(!empty($_POST['maxarea1']) && empty($_POST['maxprice1']))
			{
				//echo "maxarea set, maxcost not";
				$sql = "SELECT * FROM PROPERTY WHERE AREA<=$maxarea AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(empty($_POST['maxarea1']) && !empty($_POST['maxprice1']))
			{	
				//echo "maxarea not, maxcost set";
				$sql = "SELECT * FROM PROPERTY WHERE PRICE<=$maxcost AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(empty($_POST['maxarea1']) && empty($_POST['maxprice1']))
			{
				//echo "maxarea not, maxcost not";
				$sql = "SELECT * FROM PROPERTY WHERE ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
			if(!empty($_POST['maxarea1']) && !empty($_POST['maxprice1']))
			{
				//echo "maxarea set, maxcost set";
				$sql = "SELECT * FROM PROPERTY WHERE PRICE<=$maxcost AND AREA<=$maxarea AND ROS='R' ORDER BY TIMEDATE DESC";
				$query = mysql_query($sql,$mysql_conn);
				if(!$query)
				{
					die('<div class="errmsg">Cannot get the properties, try again later...</div>');
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
						if($mcity == $city){
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
							echo '<div class="buttons">';
								$customid = $propid . "@" . $buyerid;
								echo '<div class="get"><button id="'.$customid.'">GET THIS PROP</button></div>';
								echo '<div class="fav"><button id="'.$customid.'">FAV THIS PROP</button></div>';
							echo '</div>';
						echo '</div>'; }
					}
				}
			}
		}
	}

?>

<html>

	<head>
		
		<title> <?php echo $_SESSION['name']; ?> </title>

		<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="js/seller.js"></script>
		<link rel="stylesheet" type="text/css" href="css/seeprev.css">

	</head>

	<script type="text/javascript">

		$(".get").click(function(){
			var mixid = $(this).children("button").attr("id");
			//alert(mixid);
			//for(var i=0;i<mix.length;i++)
			var newmixid = mixid.split(/@/);
			var pid = newmixid[0];
			var bid = newmixid[1];
			// alert(pid);
			// alert(bid);

			$.ajax({
			type: "POST",
			url: "getprop.php",
			data: 
			{ 
				'pid' : pid,
				'bid' : bid 
			}
			}).done(function(data){
				var azhar = JSON.parse(data)
				alert(azhar);
				window.location.reload();
			})
		})

		$(".fav").click(function(){
			var mixid = $(this).children("button").attr("id");
			//alert(mixid);
			//for(var i=0;i<mix.length;i++)
			var newmixid = mixid.split(/@/);
			var pid = newmixid[0];
			var bid = newmixid[1];
			// alert(pid);
			// alert(bid);

			$.ajax({
			type: "POST",
			url: "getfav.php",
			data: 
			{ 
				'pid' : pid,
				'bid' : bid 
			}
			}).done(function(data){
				var azhar = JSON.parse(data)
				alert(azhar);
				window.location.reload();
			})
		})

	</script>

</html>