<?php
	//make sure that the values for connecting the db is in order (servername, user, password, database name)
	$servername = "localhost";
	$username = "u351518056_capstoneV2";
	$password = "b3P^9GtW?I";
	$db_name = "u351518056_capstoneV2";

	//Connection to the MySQL DB
	$mysqli = mysqli_connect($servername,$username, $password,$db_name );

	//Check the connection

	if(!$mysqli){

		die("Connection Error: " . mysqli_connect_error());

	} else {

		//echo "You are now connected to the database";

	}
?>