<?php

	require "../login/connectdb.php";

	$pid = $_POST['pid'];
	$bid = $_POST['bid'];

	// $pid = "PID1022";
	// $bid = "BID1000";

	$sql = "SELECT COUNT(*) FROM SOLD AS cnt WHERE PROP_ID=$pid AND BUYER_ID=$bid";
	$query = mysql_query($sql,$mysql_conn);
	$row = mysql_fetch_assoc($query);
	if($row['cnt'] == 0)
	{
		$sql1 = "INSERT INTO SOLD(BUYER_ID,PROP_ID) VALUES('$bid','$pid')";
		$query1 = mysql_query($sql1,$mysql_conn);
		if(!$query1)
		{
			die(mysql_error());
		}
		$sql1 = "DELETE FROM PROPERTY WHERE PROP_ID='$pid'";
		$query1 = mysql_query($sql1,$mysql_conn);
		if(!$query1)
		{
			die(mysql_error());
		}
		echo json_encode("Congratulations, you have bought this property...");
	}
	else
	{
		echo json_encode("There is some problem in the transaction, please try again later...");
	}

	// echo "str";
	// while($row = mysql_fetch_assoc($query)){
	// 	echo $row['PROP_ID'];
	// }

?>