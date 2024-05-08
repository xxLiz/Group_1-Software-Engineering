<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>LOGIN</title>
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

<body>
    <div id="header"></div>
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
        <h2 class="text-center">LOGIN</h2>
        <form action="handle_login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" placeholder="Enter your Email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" placeholder="Enter your Password" id="password"
                    name="password" required>
            </div>
            <input type="submit" value="Login">
        </form>
        <p style="text-align: center;">Not Yet Registered? <a href="handle_registration.php">Sign Up</a></p>
    </div>
    <div id="footer"></div>
    <script>
        // Automatically hide error message after 5 seconds
        setTimeout(function () {
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
