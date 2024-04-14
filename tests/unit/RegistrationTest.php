<?php

use PHPUnit\Framework\TestCase;

use MyApp\Db_operations; // Include the file containing the function to be tested

class RegistrationTest extends TestCase {

    // Mocking the database connection and SQL query execution
    public function testIsEmailRegistered() {
        // Mock the mysqli class
        $mysqliMock = $this->getMockBuilder('mysqli')
                           ->disableOriginalConstructor()
                           ->getMock();

        // Mock the mysqli_result class
        $mysqliResultMock = $this->getMockBuilder('mysqli_result')
                                 ->disableOriginalConstructor()
                                 ->getMock();

        // Set up the behavior of the mysqli_query method
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->willReturn($mysqliResultMock);

        // Set up the behavior of the mysqli_num_rows method
        $mysqliResultMock->expects($this->once())
                         ->method('num_rows')
                         ->willReturn(1);

        // Replace the connectToDatabase function with a mock that returns the mock mysqli object
        $this->expects($this->once())
             ->method('connectToDatabase')
             ->willReturn($mysqliMock);

        // Call the function with a dummy email
        $result = isEmailRegistered('test@example.com');

        // Check if the function returns true since the email is registered
        $this->assertTrue($result);
    }
}

?>
