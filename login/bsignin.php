<?php  

	session_start();
	$_SESSION['buyer'] = '';
	$_SESSION['name'] = '';
	
	if(isset($_POST['Buyerid']) && isset($_POST['Password']))
	{
		$name = $_POST['Buyerid'];
		$pwd = $_POST['Password'];

		require "connectdb.php";
		mysql_select_db("db_b130353cs");

		$sql = "SELECT * FROM BUYER WHERE BUYER_ID = '$name';";

		mysql_select_db("db_b130353cs");
		$query = mysql_query($sql,$mysql_conn);
		if(!$query)
		{
			die("Table cannot be accessed...");
		}
		$row = mysql_fetch_assoc($query);

		if(!$row)
		{
			echo "<div class='failtext'>You are not registered...Please signup...</div>";
			die();
		}
		
		if($row['PASSWORD'] == $pwd)
		{
			$_SESSION['buyer'] = $row['BUYER_ID'];
			$_SESSION['name'] = $row['BUYER_NAME'];
			echo "<div class='succtext'>Signin Successful...!</div><br>";
			echo '<a target="_parent" href="../buyer/index.php"><button class="redirect">Start buying!!</button></a>';
		}
		else
		{	
			echo "<div class='failtext'>You have entered wrong credentials....Try logging in again...</div>";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

	<style>
		.redirect
		{
			text-decoration: none;
			color: #fff;
			background-color: #26a69a;
			text-align: center;
			letter-spacing: .5px;
			transition: .2s ease-out;
			cursor: pointer;
		}

		.redirect
		{
			background-color: #2bbbad;
		}
	</style>

</body>
</html>
