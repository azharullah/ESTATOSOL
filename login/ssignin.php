<?php  

	session_start();
	$_SESSION['seller'] = '';
	$_SESSION['name'] = '';
	
	if(isset($_POST['Sellerid']) && isset($_POST['Password']))
	{
		$name = $_POST['Sellerid'];
		$pwd = $_POST['Password'];

		require "connectdb.php";
		mysql_select_db("db_b130353cs");

		$sql = "SELECT * FROM SELLER WHERE SELLER_ID = '$name';";

		mysql_select_db("db_b130353cs");
		$query = mysql_query($sql,$mysql_conn);
		if(!$query)
		{
			die("Table cannot be accessed...".mysql_error());
		}
		$row = mysql_fetch_assoc($query);

		if(!$row)
		{
			echo "<div class='failtext'>You are not registered...Please signup...</div>";
			die();
		}
		
		if($row['PASSWORD'] == $pwd)
		{
			$_SESSION['seller'] = $row['SELLER_ID'];
			$_SESSION['name'] = $row['SELLER_NAME'];
			//echo $row['SELLER_ID'];
			echo "<div class='succtext'>Signin Successful...!</div><br>";
			echo '<a target="_parent" href="../seller/index.php"><button class="redirect">Start selling!!</button></a>';
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
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

</body>
</html>
