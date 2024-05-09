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
            $("#header").load("header.php");
            $("#footer").load("footer.html");
        });
    </script>
        <style>

.cart {
    padding: 5px;
    list-style-type: none;
}

.cartitem {
    margin: 10 0 10 0;
    padding: 10px;
    width: 50%;
    border-style: solid;
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

.foodnotes {
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


<?php
require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$client = new GuzzleHttp\Client(['base_uri' => 'localhost:3500/cart/' . $_SESSION['email']]);
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

  <body>
    <div id="header"></div>
    <script>
var api_url = "http://localhost:3500/globalcart";

function updateNotes(itemid) {
    var inputarea = document.getElementById("notes|" + itemid);
    fetch(api_url, {
        method: "PUT",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({ id: itemid, notes: inputarea.value })
    }).then(() => { alert("Item notes updated."); });
}

    </script>
    <nav> <!-- maybe navigation bar could be made a separate php script to include --> </nav>
    <h1>Cart</h1>

<?php
if ($api_connection) {
    echo '<ul class=cart>';

    for ($i = 0; $i < $menulength; $i++) {
        echo '
    <li class=cartitem>
        <p class=imageplaceholder>image here?</p>
        <h3 class=foodname>' . $menu[$i]->name . '</h3>
        <div class=fooddesc>' . $menu[$i]->description . '</div>
        <div class=foodnotes>
            Your order notes:<br>
            <textarea id="notes|' . $menu[$i]->id . '">' . $menu[$i]->notes . '</textarea><br>
            <button type=button onclick="updateNotes(' . $menu[$i]->id . ')">Update notes</button>
        </div>
        <div class=foodprice>$' . $menu[$i]->price . '</div>
    </li>';
    }

    echo '</ul>';
   
    echo '
    <div>
        <a href="checkout.html"><button type="button">Checkout</button></a>
        
    </div>';
}
else {
    echo '<p class=apierror>API connection failed. Error details: ' . $connect_error . '</p>';
}
?>
<div id="footer"></div></body></html>
