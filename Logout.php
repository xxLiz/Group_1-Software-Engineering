<?php
require 'DatabaseConnection.php';

// Database connection
$dbConnection = new DatabaseConnection();
$conn=$dbConnection->getConnection();

if(isset($_SESSION['username']))
{
     unset($_SESSION['username']);
     /* redirect to login.php */
     header("Location: login.php");
}
else
{
     /* redirect to login.php */
     header("Location: login.php");
}
?>
