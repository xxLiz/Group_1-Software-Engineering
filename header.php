<?php
require "DatabaseConnection.php";
session_start();
?>

<header class="header">
    <div class="header__container header__wrapper">
        <a class="navbar-brand" href="./home.html">
            <img src="img/logo.jpg" alt="Logo" />
            The Food Depot
        </a>

        <button class="header__menu" aria-label="Menu">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </button>

        <nav class="header__nav">
          <ul class="header__list">
            <li><a class="nav-link" href="./menu.php">Menu</a></li>
            <li><a class="nav-link" href="./globalcart.php" class="phone my-2 my-lg-0">Cart</a></li>
            
            <?php
            if(isset($_SESSION['id'])){
            ?>
            <li><a class="nav-link" href="./logout.php" class="phone my-2 my-lg-0"><?php echo "Logout" ?></a></li>
            <?php
            }
            else
            {
              ?>
                <li><a class="nav-link" href="./login.php" class="phone my-2 my-lg-0">Login</a></li>
                <li><a class="nav-link" href="./register.php" class="phone my-2 my-lg-0">Register</a></li>  
              <?php            
            }
            ?>

            <li><a class="nav-link" href="./profile.php">Profile</a></li>
            <li><a class="nav-link" href="./contacts.html">Contact us</a></li>
            <li><a class="nav-link" href="tel:414-857-0107" class="phone my-2 my-lg-0">414-857-0107</a></li>
          </ul>
        </nav>
    </div>
    <script src="./burgerMenu.js"></script>
</header>
