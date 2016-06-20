<?php
		
	//start session
	session_start();	

	$conn_error = ""

	//Local host
	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "";//"root";
	$dbname = "myDB";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);



	/*
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	function NewUser()
	{
		//get username and password from $_POST
		$first = $_POST["first_name"];
		$last = $_POST['last_name'];

		$name = $first.' '.$last;

		$email = $_POST["email"];
		$username = $_POST["useranme"];
		$password = $_POST["pass"];
		$repass = $_POST["repass"];
		$year = $_POST["year"];
		$month = $_POST["month"];
		$day = $_POST["day"];

		$dob = $year.'-'.$month.'-'$day;

		$gender = $_POST["gender"];
		$verification_ques = $_POST["verification_question"];
		$verification_ans = $_POST["verification_answer"];
		$address = $_POST["address_name"];
		$city = $_POST["city_name"];
		$state = $_POST["state_name"];
		$zipcode = $_POST["zip_code"];

		$permanent_address = $address.','.$city.','.$state.' '.$zipcode;

		//$query = "INSERT INTO users"
		$query = "INSERT INTO users(Username,Password,Name,email,dob,gender,verification_question,verification_answer,location) VALUES ('$username','$password','$name','$email','$dob','$gender','$verification_ques','$verification_ans','$permanent_address')";
		$data = mysql_query ($query) or die(mysql_error());
		if($data)
		{
			echo "YOUR REGISTRATION IS COMPLETED....";
		}else
		{
			echo "INCOMPLETE REGISTRATION! PLEASE TRY AGAIN..."
		}
	}
	/*

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

	$num_of_rows = mysqli_num_rows($result);
	//Check in the DB
	if($num_of_rows > 0){

		//If authenticated: say hello!
		$_SESSION["username"] = $username;
		header("Location: feed.php");
		//echo "Success!! Welcome ".$username;

	}else{
		//else ask to login again..	
		echo "Invalid password! Try again!";

	}
	*/
?>

