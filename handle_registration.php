<?php
require 'ProcessRegistration.php'; // Include the ProcessRegistration class definition
session_start(); // Start the session

$processregistration=new ProcessRegistration(new DbOperations());
$processregistration->registerUser();
//unset($_SESSION['error-message']);
//unset($_SESSION['success-message']);
$conn->close();
