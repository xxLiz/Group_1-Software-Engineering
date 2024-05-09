<?php
		require "DatabaseConnection.php";
		session_start();
?>

<?php
require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$client = new GuzzleHttp\Client(['base_uri' => 'localhost:3500/menu/']);
$api_connection = true;
$connect_error = "";
$response = null;
$menu = null;
$menulength = null;

try {
    $response = $client->request('GET', '');
    // $menu is an array of objects
    $menu = json_decode($response->getBody());
    $menulength = sizeof($menu);
} catch (GuzzleHttp\Exception\ConnectException $ex) {
    $api_connection = false;
    $connect_error = $ex->getMessage();
}

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
        <style>

.menu {
    padding: 5px;
    list-style-type: none;
}

.menuitem {
    margin: 10 0 10 0;
    padding: 10px;
    width: 50%;
    border-style: double;
    border-radius: 10px;
}

.imageplaceholder {
    margin-top: 80px;
    margin-bottom: 80px;
    text-align: center;
}

.foodname {
    text-align: center;
    background-color: #CCEEFF;
    margin: 0;
    padding: 6px;
}

.fooddesc {
    padding: 10px 3px 10px 3px;
}

.foodprice {
    padding: 6px;
    background-color: #EEEEEE;
    color: #009900;
}

.apierror {
    background-color: #FFDDDD;
    color: #DD3333;
}
</style>
</head>

<body>
<div id="header"></div>
    <script>

<?php
echo 'var api_url = "http://localhost:3500/cart/' . $_SESSION['email'] . '"'
?>

function addToCart(id, itemname) {
    fetch(api_url, {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({ id_in_menu: id })
    }).then(() => { alert(itemname + " added to cart."); });
}
    </script>
    <h1>Menu</h1>

<?php
if ($api_connection) {
    echo '<ul class=menu>';

    for ($i = 0; $i < $menulength; $i++) {
        echo '
    <li class=menuitem>
    <p class=imageplaceholder>image here?</p>
    <h3 class=foodname>' . $menu[$i]->name . '</h3>
    <div class=fooddesc>' . $menu[$i]->description . '</div>
    <div class=foodprice>$' . $menu[$i]->price . '</div>
    <button class=addtocart type=button onclick="addToCart(' . $menu[$i]->id . ', \'' . $menu[$i]->name . '\')">Add to Cart</button>
    </li>';
    }

    echo '</ul>';
}
else {
    echo '<p class=apierror>API connection failed. Error details: ' . $connect_error . '</p>';
}

?>

<div id="header"></div></body></html>
