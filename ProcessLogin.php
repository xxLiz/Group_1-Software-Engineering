<?php 
require 'DbOperations.php';
require 'validations.php';

class ProcessLogin{
	private $dboperations;
	public function __construct(Dboperations $dboperations) {
        $this->dboperations = $dboperations;
    }
	public function loginUser(){
		if (isset($_POST['email']) && isset($_POST['password'])) {
			$email = validate($_POST['email']);
			$password = validate($_POST['password']);
			// hashing the password
			$password = md5($password);
			$user = $this->dboperations->loginUser($email,$password);
			if ($user!==false) {
				if ($user['email'] === $email && $user['password'] === $password) {
					$_SESSION['email'] = $user['email'];
					$_SESSION['firstname'] = $user['firstname'];
					$_SESSION['lastname'] = $user['lastname'];
					$_SESSION['mobilenumber'] = $user['mobilenumber'];
					$_SESSION['id'] = $user['id'];
					header("Location: home.html");
					//exit();
				} else {
					$_SESSION['error-message'] = "Incorect password";
					header("Location: login.php");
					//exit();
				}
			}
			else{
				$_SESSION['error-message'] = "This email is not registered";
				header("Location: login.php");
				//exit();
			}
		}
		else{
			header("Location: login.php");
			//exit();
		}
	}
}
