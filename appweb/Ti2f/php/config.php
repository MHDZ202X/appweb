<?php

define("KEY_TOKEN", "MILTON_123");
define("MONEDA", "$");

session_start();

$num_cart=0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart=count($_SESSION['carrito']['productos']);
}
?>