<?php
 
 require 'DatabaseConnection.php';

 // Check if form is submitted
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = $_SESSION['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];  
	$addressline1 = $_POST['addressline1'];
    $addressline2 = $_POST['addressline2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];

    // Database connection
    $dbConnection = new DatabaseConnection();
    $conn=$dbConnection->getConnection();
	
	$select = "select * from users where id='$id'";
    $sql = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($sql);    
	$res = $row['id'];
    if( $res === $id)
    {
   
       $update = "update users set firstname='$firstname', lastname='$lastname', email='$email',
	   addressline1='$addressline1', addressline2='$addressline2', city='$city', state='$state', 
	   zipcode='$zipcode' where id='$id'";
       $sql2 = mysqli_query($conn, $update);
	   if($sql2)
       { 
           /*Successful*/
		   $_SESSION['success-message'] = "Account updated successfully";
           header('location:Dashboard.php');
       }
       else
       {
           $_SESSION['error-message'] = "Sorry, your profile is not updated";
           header('location:Profile_edit_form.php');
       }
    }
    else
    {
        $_SESSION['error-message'] = "Sorry, your id does not match";
        header('location:Profile_edit_form.php');
    } 
}
?>
