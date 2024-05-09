<?php
use PHPUnit\Framework\TestCase;

class checkOutest extends TestCase
{
    // Test case for processing an order with valid data
    public function testProcessOrder_ValidData()
    {
        // Simulate form data
        $_POST["first_name"] = "John";
        $_POST["last_name"] = "Doe";
        $_POST["email"] = "john@example.com";
        $_POST["phone"] = "1234567890";
        $_POST["payment_method"] = "card"; 

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
        require 'process_payment.php';

        // Assertions
        // Check if the user is redirected to the payment page
        $this->assertStringContainsString('payment.html', xdebug_get_headers()[0]);
    }
}
?>
