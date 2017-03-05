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

?>

<html>

	<head>
		
		<title> <?php echo $_SESSION['name']; ?> </title>

		<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="js/seller.js"></script>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link rel="stylesheet" href="../css/materialize.css">
		<link rel="stylesheet" type="text/css" href="css/seller.css">
		<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
		<script src="../js/materialize.js"></script>

	</head>

	<body>
		
	<center><br>
		
		<h5> Welcome <span style="color: red; font-size: 30px;"><?php echo $_SESSION['name']; ?> </span> </h5> <br>

			<!--<a href="seeprevious.php"><button id="seeprev">SEE PREVIOUSLY PURCHASED PROPRERTIES</button></a>
			<a href="seefav.php"><button id="seefav">SEE FAVOURITE PROPERTIES</button></a>
			<a href="../logout.php"><button id="logout">LOGOUT</button></a>-->

			<a href="seeprevious.php" class="waves-effect waves-light btn">SEE PREVIOUSLY PURCHASED PROPRERTIES</a>
			<a href="seefav.php" class="waves-effect waves-light btn">SEE FAVOURITE PROPERTIES</a>
			<a href="../logout.php" class="waves-effect waves-light btn">LOGOUT</a> <br>
			<br><hr>

		<div id="newuploadbody">

			<h4>SEARCH FOR A PROPERTY</h4>
			
			<div id="rent">

				<h5>PROPERTIES FOR RENT</h5> <br>

				<form id="rentform1" action="showsearchrent.php" method="POST" enctype="multipart/form-data">

					<div class="input-field col s12 m12 l12">
						<select class="city1" name="city1">
							<option>City1</option>
							<option>City2</option>
							<option>City3</option>
							<option>City4</option>
						</select>
						<label>Select City : </label>
					</div> <br>

					<div class="input-field col s12  m12 l12">
						<select class="type1" name="type1">
							<option>All</option>
							<option>Flat</option>
							<option>Villa</option>
							<option>Independent House</option>
							<option>Plot</option>
						</select>
						<label>Select property type : </label>
					</div>
				
					<!--<label>Select City : </label><select class="city1" name="city1">
													<option>City1</option>
													<option>City2</option>
													<option>City3</option>
													<option>City4</option>
								  				</select> <br>-->
					<!--<label>Select property type : </label><select class="type1" name="type1">
													<option>All</option>
													<option>Flat</option>
													<option>Villa</option>
													<option>Independent House</option>
													<option>Plot</option>
											  	</select> <br>-->
					<div id="optional1"></div>

					<div id="compulsory1">
						
						<label>Max Area in SFT</label><input type="number" name="maxarea1" placeholder="Area in sft" class="validate">
						<label>Max rent in rs</label><input type="number" name="maxprice1" placeholder="Rent P/M in rs" class="validate"> <br>

					</div><br>

					<input type="submit" name="submit1" value="SEARCH" class="btn waves-effect waves-light">

				</form>
				
			</div>

			<div id="sale">

				<h5>PROPERTIES FOR SALE</h5>

				<form id="rentform2" action="showsearchsale.php" method="POST" enctype="multipart/form-data"> <br>

					<div class="input-field col s12 m12 l12">
						<select class="city2" name="city2">
							<option>City1</option>
							<option>City2</option>
							<option>City3</option>
							<option>City4</option>
						</select>
						<label>Select City : </label>
					</div> <br>

					<div class="input-field col s12  m12 l12">
						<select class="type2" name="type2">
							<option>All</option>
							<option>Flat</option>
							<option>Villa</option>
							<option>Independent House</option>
							<option>Plot</option>
						</select>
						<label>Select property type : </label>
					</div>
				
					<!--<label>Select City : </label><select class="city2" name="city2">
													<option>City1</option>
													<option>City2</option>
													<option>City3</option>
													<option>City4</option>
								  				</select> <br>
					<label>Select property type : </label><select class="type2" name="type2">
													<option>All</option>
													<option>Flat</option>
													<option>Villa</option>
													<option>Independent House</option>
													<option>Plot</option>
											  	</select> <br>-->
					<div id="optional2"></div>

					<div id="compulsory2">
						
						<label>Area in SFT</label> <input type="number" name="maxarea2" placeholder="Area in sft"> <br>
						<label>Price in rs.</label> <input type="number" name="maxprice2" placeholder="Price"> <br>

					</div>
					<br>
					<input type="submit" name="submit2" value="SEARCH" class="btn waves-effect waves-light">

				</form>
				
			</div>

		</div>

	</center>

	</body>

	<script>
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>

</html>