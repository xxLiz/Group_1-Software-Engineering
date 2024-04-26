<?php
require 'DatabaseConnection.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $payment_method = $_POST["payment_method"];

    // Database connection
    $dbConnection = new DatabaseConnection();
    $conn=$dbConnection->getConnection();
    
    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO orders (first_name, last_name, email, phone, payment_method) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $payment_method);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Redirect based on payment method
        if ($payment_method == "card") {
            header("Location: payment.html");
            exit();
        } elseif ($payment_method == "cash") {
            header("Location: delivery.html");
            exit();
        } else {
            echo "Invalid payment method";
        }
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
