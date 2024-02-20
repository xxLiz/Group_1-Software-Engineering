<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the-food-depot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Function to insert user data and address data into database
function insertUserData($firstname, $lastname, $mobilenumber, $email, $password, $addressline1, $addressline2, $city, $state, $zipcode) {
    global $conn;

    // Insert address data into address_table
    $address_sql = "INSERT INTO Address (addressline1, addressline2, city, state, zipcode)
                    VALUES ('$addressline1', '$addressline2', '$city', '$state', '$zipcode')";
    if ($conn->query($address_sql) === TRUE) {
        $address_id = $conn->insert_id;
        // Insert user data into your_table_name and link it to the address
        $user_sql = "INSERT INTO Users (firstname, lastname, mobilenumber, email, password, address_id)
                     VALUES ('$firstname', '$lastname', '$mobilenumber', '$email', '$password', $address_id)";

        if ($conn->query($user_sql) === TRUE) {
            return true;
        } else {
            return "Error inserting user data: " . $conn->error;
        }
    } else {
        return "Error inserting address data: " . $conn->error;
    }
}

?>
