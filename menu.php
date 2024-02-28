<?php
require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$client = new GuzzleHttp\Client(['base_uri' => 'localhost:3500/menu/']);

// $menu is an array of objects
$menu = json_decode($client->request('GET', '')->getBody());
$menulength = sizeof($menu);

echo '
<DOCTYPE html>
<html lang=en>
  <head>
    <title>Browse Menu</title>
    <meta charset="utf-8">
    <!-- this css is temporary -->
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
    color: #009900
}

    </style>
  </head>
  <body>
    <nav> <!-- maybe navigation bar could be made a separate php script to include --> </nav>
    <h1>Menu</h1>';

echo '<ul class=menu>';

for ($i = 0; $i < $menulength; $i++) {
    echo '
<li class=menuitem>
  <p class=imageplaceholder>image here?</p>
  <h3 class=foodname>' . $menu[$i]->name . '</h3>
  <div class=fooddesc>' . $menu[$i]->description . '</div>
  <div class=foodprice>$' . $menu[$i]->price . '</div>
</li>';
}

echo '</ul>';

echo '</body></html>';

?>