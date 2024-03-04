<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
			integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
			crossorigin="anonymous"
		/>
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
    ?>
        <h2>Registration Form</h2>
        <form action="process_registration.php" method="post">
            <div class="row">
                <div class="col">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required onblur="validateRequiredField('firstname', 'First Name', 'firstnameError');">
                    <span id="firstnameError" class="error-message"></span>
                </div>
                <div class="col">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" onblur="validateRequiredField('lastname', 'Last Name', 'lastnameError');" required>
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
                <input type="text" id="addressline1" name="addressline1" onblur="validateRequiredField('addressline1', 'Address Line 1', 'addressline1Error');" required>
                <span id="addressline1Error" class="error-message"></span>
            </div>

            <div class="row">
                <label for="addressline2">Address Line 2:</label>
                <input type="text" id="addressline2" name="addressline2" onblur="validateRequiredField('addressline2', 'Address Line 2', 'addressline2Error');">
                <span id="addressline2Error" class="error-message"></span>
            </div>

            <div class="row">
                <div class="col">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" onblur="validateRequiredField('city', 'City', 'cityError');" required>
                    <span id="cityError" class="error-message"></span>
                </div>
                <div class="col">
                    <label for="state">State:</label>
                    <input type="text" id="state" name="state" onblur="validateRequiredField('state', 'State', 'stateError');" required>
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
    <script>
        // Function to validate mobile number format
        function validatePhoneNumber(mobilenumber) {
            var phoneNumberPattern = /^\d{10}$/;
            return phoneNumberPattern.test(mobilenumber);
        }

        // Function to display mobile number validation error
        function displayPhoneNumberError() {
            var phoneNumberInput = document.getElementById('mobilenumber');
            var phoneNumberError = document.getElementById('mobilenumberError');
            // Check if mobile number is empty
            if (!phoneNumberInput.value.trim()) {
                 phoneNumberError.textContent = 'Mobile number is required.';
             }
            else if (!validatePhoneNumber(phoneNumberInput.value)) {
                phoneNumberError.textContent = 'Please enter a valid 10-digit phone number.';
            } else {
                phoneNumberError.textContent = '';
            }
        }

        // Attach event listener for keyboard input on mobile number field
        document.getElementById('mobilenumber').addEventListener('input', displayPhoneNumberError);
        // Function to validate email format
function validateEmail(email) {
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

// Function to display email validation error
function displayEmailError() {
    var emailInput = document.getElementById('email');
    var emailError = document.getElementById('emailError');
    if (!emailInput.value.trim()) {
                emailError.textContent = 'Email is required.';
    }
    else if (!validateEmail(emailInput.value)) {
        emailError.textContent = 'Please enter a valid email address.';
    } else {
        emailError.textContent = '';
    }
}

// Attach event listener for keyboard input on email field
document.getElementById('email').addEventListener('input', displayEmailError);

// Function to validate password format
function validatePassword(password) {
    if (!password) {
        return "Password is required."; // Display error if password is empty
    }
    else if (password.length < 6) {
        return "Password must be at least 6 characters long.";
    } else if (password.length > 15) {
        return "Password must not exceed 15 characters.";
    }
    return ""; // Return empty string if password is within the acceptable range
}

// Function to display password validation error
function displayPasswordError() {
    var passwordInput = document.getElementById('password');
    var passwordError = document.getElementById('passwordError');
    var errorMessage = validatePassword(passwordInput.value);
    passwordError.textContent = errorMessage;
}

// Attach event listener for keyboard input on password field
document.getElementById('password').addEventListener('input', displayPasswordError);

// Function to validate zip code format
function validateZipCode(zipcode) {
    var zipCodePattern = /^\d{5}(?:[-\s]\d{4})?$/;
    return zipCodePattern.test(zipcode);
}

// Function to display zip code validation error
function displayZipCodeError() {
    var zipCodeInput = document.getElementById('zipcode');
    var zipCodeError = document.getElementById('zipcodeError');
    if (!zipCodeInput.value.trim()) {
        zipCodeError.textContent = 'zipcode is required.';
     }
    else if (!validateZipCode(zipCodeInput.value)) {
        zipCodeError.textContent = 'Please enter a valid zip code.';
    } else {
        zipCodeError.textContent = '';
    }
}

// Attach event listener for keyboard input on zip code field
document.getElementById('zipcode').addEventListener('input', displayZipCodeError);

//Function is to Validates if a required input field is empty.
function validateRequiredField(fieldId, fieldName, errorId) {
        var fieldInput = document.getElementById(fieldId);
        var errorElement = document.getElementById(errorId);
        if (!fieldInput.value.trim()) {
            errorElement.textContent = fieldName + ' is required.';
        } else {
            errorElement.textContent = '';
        }
    }
    // Automatically hide error message after 5 seconds
    setTimeout(function() {
        var errorMessage = document.getElementById('errorMessage');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 5000); // 5000 milliseconds = 5 seconds
    </script>
</body>
</html>
