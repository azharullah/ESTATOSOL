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

	</head>

	<body>
		
	<center>
		
		<h1> Welcome <?php echo "Username" ?></h1>

			<a href="seeprevious.php"><button id="seeprev">SEE PREVIOUSLY UPLOADED PROPRERTIES</button></a>
			
			<a href="../logout.php"><button id="logout">LOGOUT</button></a>

		<div id="newuploadbody">

			<h1>UPLOAD A NEW PROPERTY</h1>
			
			<div id="rent">

				<h1>PROPERTIES FOR RENT</h1>
				
				<form id="rentform1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					<label>Select City : </label><select class="city1" name="city1">
									<option>City1</option>
									<option>City2</option>
									<option>City3</option>
									<option>City4</option>
								  </select> <br>
					<label>Select property type : </label><select class="type1" name="type1">
											<option>--</option>
											<option>Flat</option>
											<option>Villa</option>
											<option>Independent House</option>
											<option>Plot</option>
										  </select> <br>
					<div class="bhk1" style="display:none">
						<label>No of bedrooms : </label><input name="bhk1" type="number" placeholder="BHK">  <br>
					</div>
					<div class="nooffloors1" style="display:none">
						<label>No of floors : </label><input name="floors1" type="number" placeholder="No. of floors">  <br>
					</div>
					<div class="area1" style="display:none">
						<label>Area in sq. ft : </label><input name="area1" type="number" placeholder="Area"> <br>
					</div>
					<div class="parking1" style="display:none">
						<label>Parking available? : </label>
						<input type="radio" name="parking1" value="Yes"> Yes
  						<input type="radio" name="parking1" value="No"> No
					</div> <br>
					<div class="price1" style="display:none">
						<label>Price of rent per month(rs): </label><input name="cost1" type="number" placeholder="Price" required>  <br>
					</div>
					<div class="picture1" style="display:none">
						<!--<label>Image : </label><input name="pic1" type="file"> -->
						<label>Image : </label><input type="file" name="pic1" id="fileToUpload"> <br>
					</div>
					<textarea name="address1" cols="30" rows="5" placeholder="Address" class="address1" style="display:none" required></textarea><br> <br>
					<input type="submit" value="UPLOAD" name="search1">
				</form>

				<?php  

					require "../login/connectdb.php";

					if(isset($_POST['search1']))
					{
					    $file = getimagesize($_FILES["pic1"]["tmp_name"]);
					    $image_name = $_FILES["pic1"]["name"];
					    $image = addslashes(file_get_contents($_FILES["pic1"]["tmp_name"]));

					    $type = $_POST['type1'];
						$bhk = $_POST['bhk1'];
						$floors = $_POST['floors1'];
						$area = $_POST['area1'];
						$parking = $_POST['parking1'];
						$cost = $_POST['cost1'];

						if(empty($bhk))
						{
							$bhk = "-1";
						}
						if(empty($floors))
						{
							$floors = "-1";
						}
						if(empty($area))
						{
							$area = "-1";
						}
						if($parking=="Yes")
						{
							$parking = 1;
						}
						else
						{
							$parking = 0;
						}
						if(!isset($parking))
						{
							$parking = -1;
						}
						if(empty($cost))
						{
							$cost = "-1";
						}
						if(!isset($file))
						{
							$image = "-1";
						}
						$city = $_POST['city1'];
						$sid = $_SESSION['seller'];
						$addr = $_POST['address1'];

						//echo $bhk . $floors . $area . $parking1 . $cost ." 00 ". $file;

						$sql = "SELECT SNO FROM RENT_PROP ORDER BY SNO DESC LIMIT 1";
						$query = mysql_query($sql,$mysql_conn);
						if(!$query)
						{
							die("error".mysql_error());
						}
						$row = mysql_fetch_assoc($query);
						$id = 1000 + $row['SNO'];
						$prop_id = "PID".$id;

						$sql = "INSERT INTO RENT_PROP(PROP_ID,TYPE,PRICE,BHK,NOOFFL,AREA,PARKING,SELLERID,IMAGE) VALUES ('$prop_id','$type','$cost','$bhk','$floors','$area','$parking','$sid','$image');";
						$query = mysql_query($sql,$mysql_conn);
						if(!$query)
						{
							die("error".mysql_error());
						}
						$sql = "INSERT INTO RENT_ADDRESS(PID,CITY,ADDRESS) VALUES ('$prop_id','$city','$addr');";
						$query = mysql_query($sql,$mysql_conn);
						if(!$query)
						{
							die("error".mysql_error());
						}
						echo "Success";
					}

				?>

			</div>

			<div id="sale">

				<h1>PROPERTIES FOR SALE</h1>

				<form id="rentform2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					<label>Select City : </label><select class="city2" name="city2">
									<option>City1</option>
									<option>City2</option>
									<option>City3</option>
									<option>City4</option>
								  </select> <br>
					<label>Select property type : </label><select class="type2" name="type2">
											<option>--</option>
											<option>Flat</option>
											<option>Villa</option>
											<option>Independent House</option>
											<option>Plot</option>
										  </select> <br>
					<div class="showall2" style="display:none">
						<input type="number2" placeholder="Price">  <br>
					</div>
					<div class="bhk2" style="display:none">
						<label>No of bedrooms : </label><input name="bhk2" type="number" placeholder="BHK">  <br>
					</div>
					<div class="nooffloors2" style="display:none">
						<label>No of floors : </label><input name="floors2" type="number" placeholder="No. of floors">  <br>
					</div>
					<div class="area2" style="display:none">
						<label>Area in sq. ft : </label><input name="area2" type="number" placeholder="Area">  <br>
					</div>
					<div class="parking2" style="display:none">
						<label>Parking available? : </label>
						<input type="radio" name="parking2" value="Yes" checked> Yes
  						<input type="radio" name="parking2" value="No"> No
					</div> <br>
					<div class="price2" style="display:none">
						<label>Price of sale(rs): </label><input name="cost2" type="number" placeholder="Price"  required>  <br>
					</div>
					<div class="picture2" style="display:none">
						<label>Image : </label><input name="pic2" type="file" placeholder="Area"> <br>
					</div>
					<textarea name="address2" cols="30" rows="5" placeholder="Address"  class="address2" style="display:none"  required></textarea><br><br>
					<input type="submit" value="UPLOAD" name="search2">
				</form>
				
				<?php  

					require "../login/connectdb.php";

					if(isset($_POST['search2']))
					{
					    $file = getimagesize($_FILES["pic2"]["tmp_name"]);
					    $image_name = $_FILES["pic2"]["name"];
					    $image = addslashes(file_get_contents($_FILES["pic2"]["tmp_name"]));

					    $type = $_POST['type2'];
						$bhk = $_POST['bhk2'];
						$floors = $_POST['floors2'];
						$area = $_POST['area2'];
						$parking = $_POST['parking2'];
						$cost = $_POST['cost2'];

						if(empty($bhk))
						{
							$bhk = "-1";
						}
						if(empty($floors))
						{
							$floors = "-1";
						}
						if(empty($area))
						{
							$area = "-1";
						}
						if($parking=="Yes")
						{
							$parking = 1;
						}
						else
						{
							$parking = 0;
						}
						if(!isset($parking))
						{
							$parking = -1;
						}
						if(empty($cost))
						{
							$cost = "-1";
						}
						if(!isset($file))
						{
							$image = "-1";
						}
						$city = $_POST['city2'];
						$sid = $_SESSION['seller'];
						$addr = $_POST['address2'];

						//echo $bhk . $floors . $area . $parking1 . $cost ." 00 ". $file;

						$sql = "SELECT SNO FROM SELL_PROP ORDER BY SNO DESC LIMIT 1";
						$query = mysql_query($sql,$mysql_conn);
						if(!$query)
						{
							die("error".mysql_error());
						}
						$row = mysql_fetch_assoc($query);
						$id = 1000 + $row['SNO'];
						$prop_id = "PID".$id;

						$sql = "INSERT INTO SELL_PROP(PROP_ID,TYPE,PRICE,BHK,NOOFFL,AREA,PARKING,SELLERID,IMAGE) VALUES ('$prop_id','$type','$cost','$bhk','$floors','$area','$parking','$sid','$image');";
						$query = mysql_query($sql,$mysql_conn);
						if(!$query)
						{
							die("error".mysql_error());
						}
						$sql = "INSERT INTO SELL_ADDRESS(PID,CITY,ADDRESS) VALUES ('$prop_id','$city','$addr');";
						$query = mysql_query($sql,$mysql_conn);
						if(!$query)
						{
							die("error".mysql_error());
						}
						echo "Success";
					}

				?>

			</div>

		</div>

		<div id="seeprevbody">
			


		</div>

	</center>

	</body>

</html>