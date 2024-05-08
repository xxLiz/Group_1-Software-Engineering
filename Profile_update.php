<?php
require_once 'DatabaseConnection.php'; 
session_start();

$dbConnection = new DatabaseConnection();
$connection = $dbConnection->getConnection(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (isset($_SESSION['id'])) {
     
        $user_id = $_SESSION['id'];

        $firstname = $_POST['firstname'] ?? '';
        $lastname = $_POST['lastname'] ?? '';
        $email = $_POST['email'] ?? '';
        $mobilenumber = $_POST['mobilenumber'] ?? '';

        $sql = "UPDATE Users SET firstname=?, lastname=?, email=?, mobilenumber=? WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssii", $firstname, $lastname, $email, $mobilenumber, $user_id);

        if ($stmt->execute()) {
            echo "Profile updated successfully!";
        } else {
            echo "Error updating profile: " . $connection->error;
        }

     
        $stmt->close();
    } else {
        echo "User ID is not set in the session.";
    }
}


if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM Users WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
     
        echo "No user data found.";
    }
  
    $result->free();
    $stmt->close();
} else {
    echo "User ID is not set in the session.";
}

$dbConnection->closeConnection();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
        </script>
    <script>
        $(function () {
            $("#header").load("header.php");
            $("#footer").load("footer.html");
        });
    </script>
</head>

<body class="body__style">
    <div id="header"></div>
        <h1 class="profile__title">Profile Update</h1>
        <form action="" method="post">
            <table class="table table-striped">
                <tr>
                    <th class="table-text"><i class="bi bi-person-circle"></i>First Name</th>
                    <td>
                        <input value="<?=$row['firstname'] ?? ''?>" type="text" class="form-control" name="firstname" placeholder="First name">
                    </td>
                </tr>
				<tr>
                    <th class="table-text"><i class="bi bi-person-circle"></i>Last Name</th>
                    <td>
                        <input value="<?=$row['lastname'] ?? ''?>" type="text" class="form-control" name="lastname" placeholder="Last name">
                    </td>
                </tr>
				<tr>
                    <th class="table-text"><i class="bi bi-envelope"></i>Email</th>
                    <td>
                        <input value="<?=$row['email'] ?? ''?>" type="text" class="form-control" name="email" placeholder="Email">
                    </td>
                </tr>
				<tr>
                    <th class="table-text"><i class="bi bi-telephone"></i>Mobile Number</th>
                    <td>
                        <input value="<?=$row['mobilenumber'] ?? ''?>" type="text" class="form-control" name="mobilenumber" placeholder="Mobile number">
                    </td>
                </tr>
            </table>
            <div align="center">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="profile.php" class="btn btn-secondary">Back</a>
            </div>
        </form>

    <div id="footer"></div>
</body>

</html>
