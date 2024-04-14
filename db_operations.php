<?php
require 'db_config.php';
class DbOperations{
    private $dbConnection;
    public function __construct() {
        // $database = new DatabaseConnection();
        // $conn = $database->getConnection();
        // $database->closeConnection();
        $this->dbConnection = new DatabaseConnection();
    }
    public function isEmailRegistered($email) {
        $conn = $this->dbConnection->getConnection();
        $sql = "SELECT * FROM Users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result) > 0;
    }
    // Function to insert user data and address data into database
    public function insertUserData($firstname, $lastname, $mobilenumber, $email, $password, $addressline1, $addressline2, $city, $state, $zipcode) {
    $conn = $this->dbConnection->getConnection();
    // Check if the address already exists
    $existing_address_sql = "SELECT id FROM Address WHERE addressline1 = '$addressline1' AND addressline2 = '$addressline2' AND city = '$city' AND state = '$state' AND zipcode = '$zipcode'";
    $existing_address_result = $conn->query($existing_address_sql);
     if ($existing_address_result->num_rows > 0) {
        // Address already exists, retrieve the address ID
        $row = $existing_address_result->fetch_assoc();
        $address_id = $row['id'];
    }
    else {
    // Address doesn't exist, insert address data into address_table
    $address_sql = "INSERT INTO Address (addressline1, addressline2, city, state, zipcode)
                    VALUES ('$addressline1', '$addressline2', '$city', '$state', '$zipcode')";
    if ($conn->query($address_sql) === TRUE) {
        $address_id = $conn->insert_id;
    } else {
            return "Error inserting address data: " . $conn->error;
        }
    }

        // Insert user data into your_table_name and link it to the address
        $user_sql = "INSERT INTO Users (firstname, lastname, mobilenumber, email, password, address_id)
                     VALUES ('$firstname', '$lastname', '$mobilenumber', '$email', '$password', $address_id)";

        if ($conn->query($user_sql) === TRUE) {
            return true;
        } else {
            return "Error inserting user data: " . $conn->error;
        }
}
public function loginUser($email, $password){
    $conn = $this->dbConnection->getConnection();
    $sql = "SELECT * FROM Users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return false; 
    }

}
}
