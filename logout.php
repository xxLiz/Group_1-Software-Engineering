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
    <div class="container">

		<?php
		require "DatabaseConnection.php";
		session_start();
	
		$_SESSION = array();
	
		session_destroy();

		/* redirect to login.php */
		header("Location: login.php");
		exit;
		?>
		
	<div id="footer"></div>
</body>
</html>
