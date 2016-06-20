<?php 
	include('database.php');

	//connect to DB
	$conn = connect_db();

	//get data from the form
	$PID = $_POST['PID'];
	$comment = $_POST['content'];

	$time = date("d F Y -H:i");
	//query DB for this Post

	$result = mysqli_query($conn, "SELECT * FROM posts WHERE id='$PID'");

	$row = mysqli_fetch_assoc($result);
	$content = $row['content'];
	$content .='<br><br><b>Comment: </b>'.$comment . " ($time) ";
	//update likes

	$result = mysqli_query($conn, "UPDATE posts SET content='$content' WHERE id='$PID'");
	if($result){
		header('Location: feed.php');
	}else{

		echo "Something is wrong!";
	}

 ?>