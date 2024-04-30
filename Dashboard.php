<?php
require 'DatabaseConnection.php';

// Database connection
$dbConnection = new DatabaseConnection();
$conn=$dbConnection->getConnection();

if(isset($_SESSION['username']))
{
?>

    <div class="row">
        <div class="col s12 offset-s1 m12 l12 z-depth-1 white">
            <?php $user = explode("@", $_SESSION['user_session']) ?>
            Welcome, <b><?= isset($user[0]) ? $user[0] : '' ?></b>

            <div class="divider"></div>

            <h2>Congratulations</h2>
            <p>This is a dashboard than can only be access by logged memebers.</p>
            <p>If you are here, it means you created an account and logged in successfully.</p>

            <div class="divider"></div>
            <p>If you want to log out, use the button bellow:</p>
            <a href="Logout.php" class="waves-effect waves-light btn">Log out</a>
        </div>
    </div>

<?php

}
else
{
    /* redirect to login.php */
    header("Location: login.php");
}
?>
