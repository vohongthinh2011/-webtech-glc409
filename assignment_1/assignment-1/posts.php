<?php
	
	session_start();

	//include('database.php');
	
	function sanitizeString($var)
	{	
	    $var = strip_tags($var);
	    $var = htmlentities($var);
	    $var = stripslashes($var);
	    return ($var);
	}



	//Get data from the form
	$content = sanitizeString($_POST['content']);
	$UID = sanitizeString($_POST['UID']);

	//New Codes
	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";



	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//End

	//connect to DB
	//$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
	$row = mysqli_fetch_assoc($result);

	//Fetch User information
	// ----	
	$name = sanitizeString($row["first_name"]);
	$profile_pic = $row["profile_pic"];

	echo "$name";

	$result_insert = mysqli_query($conn, "INSERT INTO posts (content, UID, name, profile_pic, likes) VALUES ('$content', $UID, '$name', '$profile_pic', 0)");




	//check if insert was okay
	if($result_insert){

		//redirect to feed page 
		header("Location: feed.php");

	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}
	
 

?>