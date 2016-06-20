<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
	<style>
	h1{
		color:red;
	}
	h2{
		color: #FF1493;
	}
	</style>
</head>
<body background="feed.jpg">
<?php
	include('database.php');
	
	session_start();

	$conn = connect_db();

	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	//user information 
	$row = mysqli_fetch_assoc($result);

	echo "<h1>Welcome back ".$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";

	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content' onclick='this.value=\"\"' onblur='if(this.value==\"\") this.value=\"Say something...\"' >What's on your mind?</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";

	echo "<br>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);

	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}

	//show all posts on myfacebook
	for($i = 0; $i < $num_of_rows; $i++){

		$row = mysqli_fetch_row($result_posts);

		echo "<span style='color:white; font-size:15px'>Time: $row[6], <br> Like: ($row[5]) <br> $row[3] said $row[1] </span><form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> <input type='submit' value='Like'></form>  ";
		echo "";
		echo "<br>";
		echo "<form action='comment.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> ";
		echo "<textarea name='content' onclick='this.value=\"\"' onblur='if(this.value==\"\") this.value=\"Say something...\"' >Write a comment...</textarea><br><input type='submit' value='Comment'></form><br><br>";
	}
?>
</body>
</html>
