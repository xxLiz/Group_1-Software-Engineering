<?php 
session_start(); 
include 'db_config.php';

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$password = validate($_POST['password']);

	
		// hashing the password
        $password = md5($password);

        
		$sql = "SELECT * FROM Users WHERE email='$email'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			echo $row;
            if ($row['email'] === $email && $row['password'] === $password) {
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['firstname'] = $row['firstname'];
            	$_SESSION['id'] = $row['id'];
				header("Location: home.html");
		        exit();
            }else{
				$_SESSION['error-message'] = "Incorect password";
                 header("Location: login.php");
		        exit();
			}
		}else{
			$_SESSION['error-message'] = "This email is not registered";
             header("Location: login.php");
	        exit();
		}
	
	
}else{
	header("Location: login.php");
	exit();
}
