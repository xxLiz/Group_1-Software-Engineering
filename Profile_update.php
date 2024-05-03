<?php
 
 session_start();
 include "DatabaseConnection.php";
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
		<h1 class="profile__title">Profile Update</h1>
			
		<table class="table table-striped">
			<tr><th class="table-text"><i class="bi bi-person-circle"></i>First Name</th>
				<td>
					<input value="<?=$row['firstname']?>" type="text" class="form-control" name="firstname" placeholder="First name">
				</td>
			</th>
			<tr><th class="table-text"><i class="bi bi-person-square"></i>Last Name</th>
				<td>
					<input value="<?=$row['lastname']?>" type="text" class="form-control" name="lastname" placeholder="Last name">
				</td>
			</th>
			<tr><th class="table-text"><i class="bi bi-envelope"></i>Email</th>
				<td>
					<input value="<?=$row['email']?>" type="text" class="form-control" name="email" placeholder="Email">
				</td>
			</th>
			<tr><th class="table-text"><i class="bi bi-phone"></i>Phone Number</th>
				<td>
					<input value="<?=$row['mobilenumber']?>" type="text" class="form-control" name="mobilenumber" placeholder="Phone Number">
				</td>
			</th>
			<tr><th class="table-text"><i class="bi bi-address"></i>Address</th>
				<td>
					<input value="<?=$row['address_id']?>" type="text" class="form-control" name="address" placeholder="Address">
				</td>
			</th>	
		</table>
		
		<div align="center">
            <a href="home.html">
			    <button class="btn btn-primary float-end">Save</button>
            </a>
			<a href="profile.php">
				<button class="btn btn-secondary float-end">Back</button>
			</a>
		</div>

	</main>
	<div id="footer"></div>
</body>
</html>
