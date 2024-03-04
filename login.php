<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">
        <!-- Display session message if it exists -->
        <?php
    session_start();
    if (isset($_SESSION['error-message'])) {
        echo '<p id="errorMessage" class="error">' . $_SESSION['error-message'] . '</p>';
        // Unset session message variable after displaying it
        unset($_SESSION['error-message']);
    }
	if (isset($_SESSION['success-message'])) {
        echo '<p id="successMessage" class="success">' . $_SESSION['success-message'] . '</p>';
        // Unset success session message variable after displaying it
        unset($_SESSION['success-message']);
    }
	?>
    <h2>LOGIN</h2>
     <form action="process_login.php" method="post">
     	<label>Email</label>
     	<input type="text" name="email" placeholder="Enter your Email"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Enter your Password"><br>

     	<input type="submit" value="Login">
     </form>
     <p style="text-align: center;">Not Yet Registered? <a href="process_registration.php">Sign Up</a></p>
</div>
<script>
	// Automatically hide error message after 5 seconds
    setTimeout(function() {
        var errorMessage = document.getElementById('errorMessage');
		var successMessage = document.getElementById('successMessage');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
		if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 5000); // 5000 milliseconds = 5 seconds
	</script>
</body>
</html>
