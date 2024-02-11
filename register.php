<?php
include 'db_config.php';

// Retrieve form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$mobilenumber = $_POST['mobilenumber'];
$email = $_POST['email'];
$password = $_POST['password'];
$addressline1 = $_POST['addressline1'];
$addressline2 = $_POST['addressline2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];


// Insert user data into database
$result = insertUserData($firstname, $lastname, $mobilenumber, $email, $password, $addressline1, $addressline2, $city, $state, $zipcode);

if ($result === true) {
    echo "New record created successfully";
} else {
    echo "result is not true";
    echo $result;
}

$conn->close();
?>
