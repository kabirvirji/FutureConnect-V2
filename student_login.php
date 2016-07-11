<?php 
// create database connection
require_once("database_connection.php");
// require the helper functions one
require_once("functions.php");


if (isset($_POST['submit'])) {
      
      $username = mysqli_real_escape_string($_POST['username']);
      $password = mysqli_real_escape_string($_POST['password']); 
      
      $sql_write = "SELECT id FROM admin WHERE username = '$username' and passcode = '$password'";
      $result = mysql_db_query("FutureConnect", $sql_write);
      
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $active = $row['active'];
}