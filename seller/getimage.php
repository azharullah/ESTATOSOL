<?php

  $id = $_GET['id'];
  //$id = 14;

  require "../login/connectdb.php";

  $sql = "SELECT IMAGE FROM PROPERTY WHERE SNO=$id";
  $query = mysql_query($sql,$mysql_conn);
  $row = mysql_fetch_assoc($query);

  header("Content-type: image/jpeg");
  echo $row['IMAGE'];
?>