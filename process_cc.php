<?php
require 'DatabaseConnection.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $card = $_POST["card"];
    $expiry = $_POST["expiry"];
    $cvv = $_POST["cvv"];
    $billing = $_POST["billing"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Database connection
    $dbConnection = new DatabaseConnection();
    $conn=$dbConnection->getConnection();

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO credit_cards (card, expiry, cvv, billing, email, phone) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $card, $expiry, $cvv, $billing, $email, $phone);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Redirect the user to a thank you page
        header("Location: thank_you_delivery.php");
        // Here you can call a payment gateway API to process the payment
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If form is not submitted, redirect to checkout page
    header("Location: checkout.html");
    exit();
}
?>
