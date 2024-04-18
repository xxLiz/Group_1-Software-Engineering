<?php
 require 'process_registration.php';
 //require 'db_operations.php';
use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase {
    // Positive Test Case: Email is not registered
    public function testisEmailRegistered() {
      // Test Case 1: Successful Registration
function test_successful_registration() {
    $_POST['firstname'] = 'John';
    $_POST['lastname'] = 'Doe';
    $_POST['email'] = 'john@example.com';
    $_POST['password'] = 'password123';
    $_POST['mobilenumber'] = '1234567890';
    $_POST['addressline1'] = '123 Main St';
    $_POST['addressline2'] = '';
    $_POST['city'] = 'New York';
    $_POST['state'] = 'NY';
    $_POST['zipcode'] = '10001';

    // Simulate registration process
    $processregistration = new ProcessRegistration(new DbOperations());
    $processregistration->registerUser();

    // Verify the outcome
    // Check if the current URL contains 'login.php' after registration
    assert(strpos($_SERVER['REQUEST_URI'], 'login.php') !== false);
}
    }
}