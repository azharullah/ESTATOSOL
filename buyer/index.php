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
		<link rel="stylesheet" type="text/css" href="css/seller.css">

	</head>

	<body>
		
	<center>
		
		<h1> Welcome <?php echo $_SESSION['name']; ?></h1>

			<a href="seeprevious.php"><button id="seeprev">SEE PREVIOUSLY PURCHASED PROPRERTIES</button></a>
			
			<a href="seefav.php"><button id="seefav">SEE FAVOURITE PROPERTIES</button></a>

			<a href="../logout.php"><button id="logout">LOGOUT</button></a>

		<div id="newuploadbody">

			<h1>SEARCH FOR A PROPERTY</h1>
			
			<div id="rent">

				<h1>PROPERTIES FOR RENT</h1>

				<form id="rentform1" action="showsearchrent.php" method="POST" enctype="multipart/form-data">
				
					<label>Select City : </label><select class="city1" name="city1">
													<option>City1</option>
													<option>City2</option>
													<option>City3</option>
													<option>City4</option>
								  				</select> <br>
					<label>Select property type : </label><select class="type1" name="type1">
													<option>All</option>
													<option>Flat</option>
													<option>Villa</option>
													<option>Independent House</option>
													<option>Plot</option>
											  	</select> <br>
					<div id="optional1"></div>

					<div id="compulsory1">
						
						<label>Max Area in SFT</label><br><input type="number" name="maxarea1" placeholder="Area in sft"> <br>
						<label>Max rent in rs</label><br><input type="number" name="maxprice1" placeholder="Rent P/M in rs"> <br>

					</div>
					<br>
					<input type="submit" name="submit1" value="SEARCH">

				</form>
				
			</div>

			<div id="sale">

				<h1>PROPERTIES FOR SALE</h1>

				<form id="rentform2" action="showsearchsale.php" method="POST" enctype="multipart/form-data">
				
					<label>Select City : </label><select class="city2" name="city2">
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
											  	</select> <br>
					<div id="optional2"></div>

					<div id="compulsory2">
						
						<label>Area in SFT</label> <input type="number" name="maxarea2" placeholder="Area"> <br>
						<label>Price in rs.</label> <input type="number" name="maxprice2" placeholder="Price"> <br>

					</div>
					<br>
					<input type="submit" name="submit2" value="SEARCH">

				</form>
				
			</div>

		</div>

	</center>

	</body>

</html>