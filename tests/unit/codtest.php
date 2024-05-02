<?php
use PHPUnit\Framework\TestCase;

class codTest extends TestCase
{
    // Test case for processing cash on delivery with valid data
    public function testProcessCashOnDelivery_ValidData()
    {
        // Simulate form data
        $_POST["name"] = "John Doe";
        $_POST["address"] = "123 Main St";
        $_POST["email"] = "john@example.com";
        $_POST["phone"] = "1234567890";

        // Mock DatabaseConnection class
        $dbConnectionMock = $this->getMockBuilder(DatabaseConnection::class)
                                 ->getMock();
        // Stub getConnection method to return a mocked connection
        $dbConnectionMock->expects($this->once())
                         ->method('getConnection')
                         ->willReturn($this->getMockBuilder(mysqli::class)
                                          ->disableOriginalConstructor()
                                          ->getMock());

        // Stub execute method of the statement to return true
        $stmtMock = $this->getMockBuilder(mysqli_stmt::class)
                         ->disableOriginalConstructor()
                         ->getMock();
        $stmtMock->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);

        // Stub prepare method of the connection to return the statement mock
        $dbConnectionMock->getConnection()->expects($this->once())
                                           ->method('prepare')
                                           ->willReturn($stmtMock);

        // Replace the original DatabaseConnection object with the mock
        $GLOBALS['dbConnection'] = $dbConnectionMock;

        // Include the PHP file to be tested
        require 'process_delivery.php';

        // Assertions
        // Check if the user is redirected to the thank you page
        $this->assertStringContainsString('thank_you_delivery.php', xdebug_get_headers()[0]);
    }
}
?>
