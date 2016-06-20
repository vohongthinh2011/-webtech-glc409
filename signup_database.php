<?php 



$dbhost = "localhost";	
$dbuser = "root";
$dbpass = "root";
$dbname = "myDB";


function connect_db(){
	$conn = mysqli_connect( $GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	return $conn;
}	

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return ($var);
}

////////End of New Codes
	

	$conn = connect_db();
	//Check connection
	if($conn -> connect_errno)
	{
		die("Connection failed: " . $conn ->connect_error);
	}
	//echo "Connected successfully";


	//SignUp(); 

	
	if(isset($_POST['submit']))
	{
		//echo "Congratualations!";
			$first = sanitizeString($_POST['first_name']);
			$last = sanitizeString($_POST['last_name']);

			$name = sanitizeString($first.' '.$last);

			$email = sanitizeString($_POST['email']);
			$username = sanitizeString($_POST['username']);
			$password = sanitizeString($_POST['pass']);
			$repass = sanitizeString($_POST['repass']);
			$year = sanitizeString($_POST['year']);
			$month = sanitizeString($_POST['month']);
			$day = sanitizeString($_POST['day']);

			$dob = sanitizeString($year.'-'.$month.'-'.$day);

			$gender = sanitizeString($_POST['gender']);
			$verification_ques = sanitizeString($_POST['verification_question']);
			$verification_ans = sanitizeString($_POST['verification_answer']);

			$address = sanitizeString($_POST['address_name']);
			$city = sanitizeString($_POST['city_name']);
			$state = sanitizeString($_POST['state_name']);
			$zipcode = sanitizeString($_POST['zip_code']);
			

			$permanent_address = sanitizeString($address.','.$city.','.$state.' '.$zipcode);

				if( (empty($first) || empty($last) || empty($email) || empty($username) || empty($password) || empty($repass) || empty($year) || empty($month) || empty($day) || empty($gender) || empty($verification_ques) || empty($verification_ans) || empty($address) || empty($city) || empty($state) || empty($zipcode) ) )
				{
					echo "Oops! Can't leave any field blank!";

				}
				else if ( ($password != $repass) ) 
				{
					echo "Password did not match! Please try again.";
					echo "<br><a href='javascript:history.back()'>Go back to Sign Up Page</a>";
				}
				else
				{
					$password = sha1($password);

					// >>>>>>>>>>>> MISSING PROFILE PIC<<<<<<<<<<<<<
					// insert photo
					$file_name = null;

					if($_FILES["profile_pic"]["name"]){
						$file_name = $_FILES["profile_pic"]["name"];
					}

					$target_dir = "uploads/";
					$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					if(isset($_POST["submit"])) {
					    $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
					    if($check !== false) {
					        //echo "File is an image - " . $check["mime"] . ".";
					        $uploadOk = 1;
					    } else {
					        echo "File is not an image.";
					        $uploadOk = 0;
					    }
					}
					// Check if file already exists
					if (file_exists($target_file)) {
					    echo "Sorry, file already exists.";
					    $uploadOk = 0;
					}
					// Check file size
					/*
					if ($_FILES["profile_pic"]["size"] > 500000) {
					    echo "Sorry, your file is too large.";
					    $uploadOk = 0;
					}
					*/
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					    $uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
					    echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
					    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
					        echo "The file ". basename( $_FILES["profile_pic"]["name"]). " has been uploaded.";
					    } else {
					        echo "Sorry, there was an error uploading your file.";
					    }
					}


					$sql = "INSERT INTO users(Username,Password,Name,email,dob,gender,verification_question,verification_answer,location, profile_pic ) VALUES ('$username','$password','$name','$email','$dob','$gender','$verification_ques','$verification_ans','$permanent_address','$file_name')";
					
					$res = mysqli_query($conn,$sql);
					if(!$res)
					{
						die("Query Failed! " . mysqli-error($conn));
					}
					else
					{
						echo ("Congratulations! you have successfully registered!");
						echo "<br><a href='login.html'>Go To Login Page</a>";
					}
				}

				echo "<br><a href='javascript:history.back()'>Go back to Sign Up Page</a>";
		}

	else
		{
			echo "Form not submitted properly!<br>";
			echo "<a href='javascript:history.back()'>Go back to Sign Up Page</a>";
		}
?>