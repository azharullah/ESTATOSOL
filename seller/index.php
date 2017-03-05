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

?>

<html>

	<head>
		
		<title> <?php echo $_SESSION['name']; ?> </title>

		<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="js/seller.js"></script>
		<link rel="stylesheet" type="text/css" href="css/seller.css">
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link rel="stylesheet" href="../css/materialize.css">
		<script src="../js/materialize.js"></script>

	</head>

	<body>
		
	<center> <br>
		
		<h5> Welcome <span style="color: red; font-size: 30px;"><?php echo $_SESSION['name']; ?></span></h5> <br> 

			<!--<a href="seeprevious.php"><button id="seeprev">SEE PREVIOUSLY UPLOADED PROPRERTIES</button></a>
			<a href="../logout.php"><button id="logout">LOGOUT</button></a>-->

			<a href="seeprevious.php" id="seeprev" class="waves-effect waves-light btn">SEE PREVIOUSLY UPLOADED PROPRERTIES</a>
			<a href="../logout.php" class="waves-effect waves-light btn">LOGOUT</a> <br><br>

			<hr>

		<div id="newuploadbody">

			<h4>UPLOAD A NEW PROPERTY</h4> <br>
			
			<div id="rent">

				<h5>PROPERTIES FOR RENT</h5> <br>

				<form id="rentform1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
				
					<!--<label>Select City : </label><select class="city1" name="city1">
													<option>City1</option>
													<option>City2</option>
													<option>City3</option>
													<option>City4</option>
								  				</select> <br>
					<label>Select property type : </label><select class="type1" name="type1">
													<option></option>
													<option>Flat</option>
													<option>Villa</option>
													<option>Independent House</option>
													<option>Plot</option>
											  	</select> <br>-->

					<div class="input-field col s12 m12 l12">
						<select class="city1" name="city1">
							<option>City1</option>
							<option>City2</option>
							<option>City3</option>
							<option>City4</option>
						</select>
						<label>Select City : </label>
					</div> <br>

					<div class="input-field col s12 m12 l12">
						<select class="type1" name="type1">
							<option>--</option>
							<option>Flat</option>
							<option>Villa</option>
							<option>Independent House</option>
							<option>Plot</option>
						</select>
						<label>Select property type : </label>
					</div> <br>

					<div id="optional1"></div>

					<div id="compulsory1">
						
						<label>Area in SFT</label> <input type="number" name="area1" placeholder="Area" required> <br>
						<label>Rent in rs. per month</label> <input type="number" name="price1" placeholder="Rent P/M" required> <br><br>
						<h6>Address:</h6>
						<label>Property name</label> <input type="text" name="pname1" placeholder="Prop name"> <br>
						<label>Area/Locality</label> <input type="text" name="locality1" placeholder="Area" required> <br>
						<!--<label></label> <input type="text" name="" placeholder="" required> <br>
						<label></label> <input type="text" name="" placeholder="" required> <br>
						<label></label> <input type="text" name="" placeholder="" required> <br>-->
						<!--<label>Image : </label><input type="file" name="pic1"> <br>-->
						<div class="file-field input-field">
						<div class="btn">
							<span>Image</span>
							<input type="file" name="pic1">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text">
						</div>
						</div>

					</div>
					<br>
					<input type="submit" name="submit1" value="UPLOAD" class="btn waves-effect waves-light">

				</form>
				
				<?php

					if(isset($_POST['submit1']))
					{
						require "../login/connectdb.php";

						$city = $_POST['city1'];
						$type = $_POST['type1'];
						$area = $_POST['area1'];
						$cost = $_POST['price1'];
						$pname = $_POST['pname1'];
						$locality= $_POST['locality1'];
						$file = getimagesize($_FILES["pic1"]["tmp_name"]);
					    $image_name = $_FILES["pic1"]["name"];
					    $image = addslashes(file_get_contents($_FILES["pic1"]["tmp_name"]));
					    $sellerid = $_SESSION['seller'];
					    $state = "ANDHRA";

					    if(!isset($pname))
					    {
					    	$pname = "-1";	
					    }

					    $sql = "SELECT SNO FROM PROPERTY";
					    $query = mysql_query($sql,$mysql_conn);
					    while($row = mysql_fetch_assoc($query))
					    {
					    	$id = $row['SNO'];
					    }
					    $id = $id + 1000;
					    $propid = "PID".$id;

					    if($type == "--")
					    {
					    	echo '<div class="errmsg">Please select a valid property type</div>';
					    	die();
					    }
					    if($type == "Flat")
					    {
					    	$bhk = $_POST['bhk1'];
					    	$parking = $_POST['parking1'];
					    	$floorno = $_POST['floorno1'];

					    	if($parking == "Yes")
					    	{
					    		$parking = 1;	
					    	}
					    	else
					    	{
					    		$parking = 0;
					    	}

					    	$sql = "INSERT INTO PROPERTY (PROP_ID,TYPE,PRICE,AREA,ROS,IMAGE,SELLER_ID) ";
					    	$sql = $sql . "VALUES ('$propid','$type','$cost','$area','R','$image','$sellerid')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO ADDRESS (PROP_ID,PROP_NAME,AREA,CITY,STATE,COUNTRY,ZIP) ";
					    	$sql = $sql . "VALUES ('$propid','$pname','$locality','$city','$state','INDIA','500008')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO FLAT (PROP_ID,BHK,PARKING,FLOORNO) ";
					    	$sql = $sql . "VALUES ('$propid','$bhk','$parking','$floorno')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    }
					    if($type == "Villa")
					    {
					    	$nooffloors = $_POST['nooffloors1'];

					    	$sql = "INSERT INTO PROPERTY (PROP_ID,TYPE,PRICE,AREA,ROS,IMAGE,SELLER_ID) ";
					    	$sql = $sql . "VALUES ('$propid','$type','$cost','$area','R','$image','$sellerid')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO ADDRESS (PROP_ID,PROP_NAME,AREA,CITY,STATE,COUNTRY,ZIP) ";
					    	$sql = $sql . "VALUES ('$propid','$pname','$locality','$city','$state','INDIA','500008')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO VILLA (PROP_ID,NOOFFLOORS) ";
					    	$sql = $sql . "VALUES ('$propid','$nooffloors')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    }
					    if($type == "Independent House")
					    {
					    	$parking = $_POST['parking1'];

					    	if($parking == "Yes")
					    	{
					    		$parking = 1;	
					    	}
					    	else
					    	{
					    		$parking = 0;
					    	}

					    	$sql = "INSERT INTO PROPERTY (PROP_ID,TYPE,PRICE,AREA,ROS,IMAGE,SELLER_ID) ";
					    	$sql = $sql . "VALUES ('$propid','$type','$cost','$area','R','$image','$sellerid')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO ADDRESS (PROP_ID,PROP_NAME,AREA,CITY,STATE,COUNTRY,ZIP) ";
					    	$sql = $sql . "VALUES ('$propid','$pname','$locality','$city','$state','INDIA','500008')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO INDEPENDENTHOUSE (PROP_ID,PARKING) ";
					    	$sql = $sql . "VALUES ('$propid','$parking')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    }
					    if($type == "Plot")
					    {
					    	$plotno = $_POST['plotno1'];

					    	$sql = "INSERT INTO PROPERTY (PROP_ID,TYPE,PRICE,AREA,ROS,IMAGE,SELLER_ID) ";
					    	$sql = $sql . "VALUES ('$propid','$type','$cost','$area','R','$image','$sellerid')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO ADDRESS (PROP_ID,PROP_NAME,AREA,CITY,STATE,COUNTRY,ZIP) ";
					    	$sql = $sql . "VALUES ('$propid','$pname','$locality','$city','$state','INDIA','500008')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO PLOT (PROP_ID,PLOTNO) ";
					    	$sql = $sql . "VALUES ('$propid','$plotno')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    }
					    echo "Successfully uploaded the property...";
					}

				?>

			</div>

			<div id="sale">

				<h5>PROPERTIES FOR SALE</h5> <br>

				<form id="rentform2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
				
					<!--<label>Select City : </label><select class="city2" name="city2">
													<option>City1</option>
													<option>City2</option>
													<option>City3</option>
													<option>City4</option>
								  				</select> <br>
					<label>Select property type : </label><select class="type2" name="type2">
													<option></option>
													<option>Flat</option>
													<option>Villa</option>
													<option>Independent House</option>
													<option>Plot</option>
											  	</select> <br>-->

					<div class="input-field col s12 m12 l12">
						<select class="city2" name="city2">
							<option>City1</option>
							<option>City2</option>
							<option>City3</option>
							<option>City4</option>
						</select>
						<label>Select City : </label>
					</div> <br>

					<div class="input-field col s12 m12 l12">
						<select class="type2" name="type2">
							<option>--</option>
							<option>Flat</option>
							<option>Villa</option>
							<option>Independent House</option>
							<option>Plot</option>
						</select>
						<label>Select property type : </label>
					</div> <br>

					<div id="optional2"></div>

					<div id="compulsory2">
						
						<label>Area in SFT</label> <input type="number" name="area2" placeholder="Area" required> <br>
						<label>Price in rs.</label> <input type="number" name="price2" placeholder="Price" required> <br><br>
						<h6>Address:</h6>
						<label>Property name</label> <input type="text" name="pname2" placeholder="Prop name"> <br>
						<label>Area/Locality</label> <input type="text" name="locality2" placeholder="Area" required> <br>
						<!--<label></label> <input type="text" name="" placeholder="" required> <br>
						<label></label> <input type="text" name="" placeholder="" required> <br>
						<label></label> <input type="text" name="" placeholder="" required> <br>-->
						<!--<label>Image : </label><input type="file" name="pic2"> <br>-->
						<div class="file-field input-field">
						<div class="btn">
							<span>Image</span>
							<input type="file" name="pic2">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text">
						</div>
						</div>

					</div>
					<br>
					<input type="submit" name="submit2" value="UPLOAD" class="btn waves-effect waves-light">

				</form>
				
				<?php

					if(isset($_POST['submit2']))
					{
						require "../login/connectdb.php";

						$city = $_POST['city2'];
						$type = $_POST['type2'];
						$area = $_POST['area2'];
						$cost = $_POST['price2'];
						$pname = $_POST['pname2'];
						$locality= $_POST['locality2'];
						$file = getimagesize($_FILES["pic2"]["tmp_name"]);
					    $image_name = $_FILES["pic2"]["name"];
					    $image = addslashes(file_get_contents($_FILES["pic2"]["tmp_name"]));
					    $sellerid = $_SESSION['seller'];
					    $state = "ANDHRA";

					    if(!isset($pname))
					    {
					    	$pname = "-1";	
					    }

					    $sql = "SELECT SNO FROM PROPERTY";
					    $query = mysql_query($sql,$mysql_conn);
					    while($row = mysql_fetch_assoc($query))
					    {
					    	$id = $row['SNO'];
					    }
					    $id = $id + 1000;
					    $propid = "PID".$id;

					    if($type == "--")
					    {
					    	echo '<div class="errmsg">Please select a valid property type</div>';
					    	die();
					    }
					    if($type == "Flat")
					    {
					    	$bhk = $_POST['bhk2'];
					    	$parking = $_POST['parking2'];
					    	$floorno = $_POST['floorno2'];

					    	if($parking == "Yes")
					    	{
					    		$parking = 1;	
					    	}
					    	else
					    	{
					    		$parking = 0;
					    	}

					    	$sql = "INSERT INTO PROPERTY (PROP_ID,TYPE,PRICE,AREA,ROS,IMAGE,SELLER_ID) ";
					    	$sql = $sql . "VALUES ('$propid','$type','$cost','$area','S','$image','$sellerid')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO ADDRESS (PROP_ID,PROP_NAME,AREA,CITY,STATE,COUNTRY,ZIP) ";
					    	$sql = $sql . "VALUES ('$propid','$pname','$locality','$city','$state','INDIA','500008')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO FLAT (PROP_ID,BHK,PARKING,FLOORNO) ";
					    	$sql = $sql . "VALUES ('$propid','$bhk','$parking','$floorno')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    }
					    if($type == "Villa")
					    {
					    	$nooffloors = $_POST['nooffloors2'];

					    	$sql = "INSERT INTO PROPERTY (PROP_ID,TYPE,PRICE,AREA,ROS,IMAGE,SELLER_ID) ";
					    	$sql = $sql . "VALUES ('$propid','$type','$cost','$area','S','$image','$sellerid')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO ADDRESS (PROP_ID,PROP_NAME,AREA,CITY,STATE,COUNTRY,ZIP) ";
					    	$sql = $sql . "VALUES ('$propid','$pname','$locality','$city','$state','INDIA','500008')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO VILLA (PROP_ID,NOOFFLOORS) ";
					    	$sql = $sql . "VALUES ('$propid','$nooffloors')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    }
					    if($type == "Independent House")
					    {
					    	$parking = $_POST['parking2'];

					    	if($parking == "Yes")
					    	{
					    		$parking = 1;	
					    	}
					    	else
					    	{
					    		$parking = 0;
					    	}	

					    	$sql = "INSERT INTO PROPERTY (PROP_ID,TYPE,PRICE,AREA,ROS,IMAGE,SELLER_ID) ";
					    	$sql = $sql . "VALUES ('$propid','$type','$cost','$area','S','$image','$sellerid')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO ADDRESS (PROP_ID,PROP_NAME,AREA,CITY,STATE,COUNTRY,ZIP) ";
					    	$sql = $sql . "VALUES ('$propid','$pname','$locality','$city','$state','INDIA','500008')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO INDEPENDENTHOUSE (PROP_ID,PARKING) ";
					    	$sql = $sql . "VALUES ('$propid','$parking')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    }
					    if($type == "Plot")
					    {
					    	$plotno = $_POST['plotno2'];

					    	$sql = "INSERT INTO PROPERTY (PROP_ID,TYPE,PRICE,AREA,ROS,IMAGE,SELLER_ID) ";
					    	$sql = $sql . "VALUES ('$propid','$type','$cost','$area','S','$image','$sellerid')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO ADDRESS (PROP_ID,PROP_NAME,AREA,CITY,STATE,COUNTRY,ZIP) ";
					    	$sql = $sql . "VALUES ('$propid','$pname','$locality','$city','$state','INDIA','500008')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    	$sql = "INSERT INTO PLOT (PROP_ID,PLOTNO) ";
					    	$sql = $sql . "VALUES ('$propid','$plotno')";
					    	$query = mysql_query($sql,$mysql_conn);
					    	if(!$query)
					    	{
					    		echo "<div id='errmsg'>There's a problem uploading...Try again later...</div>";
					    		die();
					    	}
					    }
					    echo "Successfully uploaded the property...";
					}

				?>

			</div>

		</div>

	</center>

	<script>
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>

	</body>

</html>