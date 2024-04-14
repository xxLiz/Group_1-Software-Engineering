<?php
require 'db_operations.php';
require 'validations.php';
class ProcessRegistration{
    private $dboperations;
    public function __construct() {
        $this->dboperations = new DbOperations();
    }
    public function registerUser() {
        if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['mobilenumber']) && isset($_POST['email']) && isset($_POST['password'])
        && isset($_POST['addressline1']) && isset($_POST['addressline2']) && isset($_POST['city']) && isset($_POST['state'])&& isset($_POST['zipcode'])) {
    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $mobilenumber = validate($_POST['mobilenumber']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $addressline1 = validate($_POST['addressline1']);
    $addressline2 = validate($_POST['addressline2']);
    $city = validate($_POST['city']);
    $state = validate($_POST['state']);
    $zipcode = validate($_POST['zipcode']);
    
    // Hashing the password
    $password = md5($password);
    
    if ($this->dboperations->isEmailRegistered($email)) {
        $_SESSION['error-message'] = "The email is already registered. Please try another one";
        header("Location: register.php");
        exit();
    } else {
        $result2 = $this->dboperations->insertUserData($firstname, $lastname, $mobilenumber, $email, $password, $addressline1, $addressline2, $city, $state, $zipcode);
        if ($result2) {
            $_SESSION['success-message'] = "Account created successfully";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error-message'] = "Error: Insert query is not executed";
            header("Location: register.php");
            exit();
        }
    }
} else {
    header("Location: register.php");
    exit();
}
}
}

session_start(); // Start the session
$processregistration=new ProcessRegistration();
$processregistration->registerUser();
unset($_SESSION['error-message']);
unset($_SESSION['success-message']);
$conn->close();
