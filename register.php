<?php
include 'db_config.php';

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['mobilenumber']) && isset($_POST['email']) && isset($_POST['password'])
    && isset($_POST['addressline1']) && isset($_POST['addressline2']) && isset($_POST['city']) && isset($_POST['state'])&& isset($_POST['zipcode'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $mobilenumber = validate($_POST['mobilenumber']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $addressline1 = validate($_POST['addressline1']);
    $addressline2 = validate($_POST['addressline2']);
    $city = validate($_POST['city']);
    $state = validate($_POST['state']);
    $zipcode = validate($_POST['zipcode']);

    // Hashing the password
    $password = md5($password);

    $sql = "SELECT * FROM Users WHERE email='$email' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('The email is already registered try another one'); window.location.href = 'register.html';</script>";
        exit();
    } else {
        // Insert user data into database
        $result2 = insertUserData($firstname, $lastname, $mobilenumber, $email, $password, $addressline1, $addressline2, $city, $state, $zipcode);
        if ($result2) {
            echo "<script>alert('Your account has been created successfully'); window.location.href = 'login.html';</script>";
            exit();
        } else {
            echo "<script>alert('insert query is not executed'); window.location.href = 'register.html';</script>";
            exit();
        }
    }
} else {
    header("Location: register.html");
    exit();
}
$conn->close();
?>
