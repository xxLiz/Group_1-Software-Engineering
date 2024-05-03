<?php
		require "DatabaseConnection.php";
		session_start();
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
            $("#header").load("header.html");
            $("#footer").load("footer.html");
        });
    </script>
</head>


<body class="body__style">

  <div id="header"></div>
  <main>
        <?php
        if(!isset($_SESSION['id'])){
          ?>
            <h1 class="profile__title" align="center">Log in to see the profile</h1>
          <div align="center">
            <a href="login.php">
                <button class="mx-auto m-1 btn-m btn btn-info text-white">Login</button>
            </a>
          </div>
          <?php
        } else {
          ?>
          <div>
            <h1 class="profile__title" align="center">Welcome <?php echo ucfirst($_SESSION['firstname']); ?></h1>
            <table class="table table-striped">
              <tr class="table-text"><th><i class="bi bi-person-circle"></i>First Name</th><td><?php echo ucfirst($_SESSION['firstname']); ?></td></th>
              <tr class="table-text"><th><i class="bi bi-person-square"></i>Last Name</th><td><?php echo ucfirst($_SESSION['lastname']); ?></td></th>
              <tr class="table-text"><th><i class="bi bi-envelope"></i>Email</th><td><?php echo ucfirst($_SESSION['email']); ?></td></th>
              <tr class="table-text"><th><i class="bi bi-phone"></i>Phone Number</th><td><?php echo ucfirst($_SESSION['mobilenumber']); ?></td></th>
            </table>
            <div align="center">
                <a href="Profile_update.php">
                  <button class="mx-auto m-1 btn-m btn btn-primary">Update Profile</button>
                </a>
                <a href="logout.php">
                  <button class="mx-auto m-1 btn-m btn btn-info text-white">Logout</button>
                </a>
            </div>
          </div>
          <?php
        }
        ?>
		
        



	</main>
	<div id="footer"></div>

</body>
</html>
