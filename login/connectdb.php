<?php
	
	$mysql_host = 'localhost';
	$mysql_username = 'root';
	$mysql_password = '';
	$mysql_db = 'db_b130353cs';
	$connection_error = "<h3>No Connection</h3> <br> Please Check Your Internet Connection";
	$mysql_conn = mysql_connect($mysql_host,$mysql_username,$mysql_password,$mysql_db);
	// echo "string";
	mysql_select_db("db_b130353cs");
?>
