<?php

	require "../login/connectdb.php";

	$pid = $_POST['pid'];
	$bid = $_POST['bid'];

	 // $pid = "PID1007";
	 // $bid = "BID1000";

	$sql = "SELECT COUNT(*) AS cnt FROM FAVOURITES WHERE PROP_ID='$pid' AND BUYER_ID='$bid'";
	$query = mysql_query($sql,$mysql_conn);
	$row=mysql_fetch_assoc($query);
	//echo $row['cnt']."str";
	if($row['cnt'] == 0)
	{
		$sql1 = "INSERT INTO FAVOURITES(BUYER_ID,PROP_ID) VALUES('$bid','$pid')";
		$query1 = mysql_query($sql1,$mysql_conn);
		if(!$query1)
		{
			die(mysql_error());
		}
		echo json_encode("This property has been added to your favourites...");
	}
	else
	{
		echo json_encode("This property is already in your favourites...");
	}

	// echo "str";
	// while($row = mysql_fetch_assoc($query)){
	// 	echo $row['PROP_ID'];
	// }

?>