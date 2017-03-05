<?php  
	
	if(isset($_POST['Name']) && isset($_POST['Email']) && isset($_POST['PhoneNumber']) && isset($_POST['Password']))
	{
		$name = $_POST['Name'];
		$email = $_POST['Email'];
		$phno = $_POST['PhoneNumber'];
		$pwd = $_POST['Password'];

		require "connectdb.php";
		mysql_select_db("db_b130353cs");

		$sql = "SELECT * FROM BUYER WHERE EMAIL = '$email';";

		mysql_select_db("db_b130353cs");
		$query = mysql_query($sql,$mysql_conn);
		if(!$query)
		{
			die("Table cannot be accessed...".mysql_error());
		}
		$row = mysql_fetch_assoc($query);
		
		if($row['PHNO'] == $phno)
		{
			echo "<div class='succtext'>You are already registered with this Email and Phone Number</div><br>";
			echo "<div class='succtext'>Your Buyer ID is " . $row['BUYER_ID'] . "...</div>";
		}
		else
		{
			$sql = "SELECT COUNT(*) AS num FROM BUYER;";
			$query = mysql_query($sql,$mysql_conn);		
			$row = mysql_fetch_assoc($query);
			$count = 1000 + $row['num'];
			$buyerid = "BID" . $count;
			$sql = "INSERT INTO BUYER(BUYER_NAME,BUYER_ID,EMAIL,PHNO,PASSWORD) VALUES('$name','$buyerid','$email','$phno','$pwd');";
			$query = mysql_query($sql,$mysql_conn);		
			if(!$query)
			{
				die("<div class='failtext'>Error in addind buyer...Try again later</div>");
			}
			echo "<div class='succtext'>You are now registered with us...Your Buyer ID is " . $buyerid . "...</div>";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

</body>
</html>