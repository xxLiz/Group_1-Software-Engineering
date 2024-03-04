<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Registration Form</title>
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
        ?>
        <h2>Registration Form</h2>
        <form action="process_registration.php" method="post">
            <div class="row">
                <div class="col">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required
                        onblur="validateRequiredField('firstname', 'First Name', 'firstnameError');">
                    <span id="firstnameError" class="error-message"></span>
                </div>
                <div class="col">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname"
                        onblur="validateRequiredField('lastname', 'Last Name', 'lastnameError');" required>
                    <span id="lastnameError" class="error-message"></span>
                </div>
            </div>

            <div class="row">
                <label for="mobilenumber">Mobile Number:</label>
                <input type="text" id="mobilenumber" name="mobilenumber" required>
                <span id="mobilenumberError" class="error-message"></span>
            </div>

            <div class="row">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <span id="emailError" class="error-message"></span>
            </div>

            <div class="row">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span id="passwordError" class="error-message"></span>
            </div>

            <div class="row">
                <label for="addressline1">Address Line 1:</label>
                <input type="text" id="addressline1" name="addressline1"
                    onblur="validateRequiredField('addressline1', 'Address Line 1', 'addressline1Error');" required>
                <span id="addressline1Error" class="error-message"></span>
            </div>

            <div class="row">
                <label for="addressline2">Address Line 2:</label>
                <input type="text" id="addressline2" name="addressline2"
                    onblur="validateRequiredField('addressline2', 'Address Line 2', 'addressline2Error');">
                <span id="addressline2Error" class="error-message"></span>
            </div>

            <div class="row">
                <div class="col">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city"
                        onblur="validateRequiredField('city', 'City', 'cityError');" required>
                    <span id="cityError" class="error-message"></span>
                </div>
                <div class="col">
                    <label for="state">State:</label>
                    <input type="text" id="state" name="state"
                        onblur="validateRequiredField('state', 'State', 'stateError');" required>
                    <span id="stateError" class="error-message"></span>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="zipcode">Zip Code:</label>
                    <input type="text" id="zipcode" name="zipcode" required>
                    <span id="zipcodeError" class="error-message"></span>
                </div>
            </div>

            <input type="submit" value="Register">
        </form>

        <p style="text-align: center;">Already a member? <a href="process_login.php">Sign In</a></p>
    </div>
    <div id="footer"></div>
    <script src="register.js"></script>
</body>
</html>
