<?php
require 'conf.php'; // Include your configuration file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentMethod = isset($_POST['payment-method']) ? $_POST['payment-method'] : '';

    if ($paymentMethod === 'card') {
        // Card Payment Form Handling
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $cardNumber = isset($_POST['card-number']) ? $_POST['card-number'] : '';
        $expiryDate = isset($_POST['expiry-date']) ? $_POST['expiry-date'] : '';
        $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';

        // Call the function to handle card payment
        $result = handleCardPayment($email, $cardNumber, $expiryDate, $cvv);

        if ($result["success"]) {
            // Successful payment processing
            echo "Card Payment processed successfully!";
        } else {
            // Display an error message
            echo "Card Payment processing failed: " . htmlentities($result["message"]);
        }
    } elseif ($paymentMethod === 'cash-on-delivery') {
        // Cash on Delivery Form Handling
        $result = processCashOnDelivery();
        
        if ($result["success"]) {
            // Successful payment processing
            echo "Cash on Delivery processed successfully!";
        } else {
            // Display an error message
            echo "Cash on Delivery processing failed: " . htmlentities($result["message"]);
        }
    } else {
        echo "Unsupported payment method: " . htmlentities($paymentMethod);
    }
} else {
    // Redirect if the form is not submitted
    header('Location: payment.html');
    exit();
}

function handleCardPayment($email, $cardNumber, $expiryDate, $cvv)
{
    global $conn; 

    return ["success" => true, "message" => "Card Payment processed successfully!"];
}

function processCashOnDelivery()
{
    global $conn; 

    return ["success" => true, "message" => "Cash on Delivery processed successfully!"];
}
?>
