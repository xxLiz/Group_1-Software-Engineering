<?php
require 'DatabaseConnection.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Database connection parameters
    $dbConnection = new DatabaseConnection();
    $conn=$dbConnection->getConnection();

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO cash_on_delivery (name, address, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $address, $email, $phone);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Redirect the user to a thank you page
        header("Location: thank_you_delivery.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect back to the form page
    header("Location: delivery.html");
    exit();
}
?>
