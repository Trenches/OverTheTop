<?php
// Create connection
$mysqli = new mysqli("localhost","gamer","RycHHfEtSE4Fw4xL","OverTheTop");

/* check connection */
if (mysqli_connect_errno())
{
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
?>