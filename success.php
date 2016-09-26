<?php 
//echo "Оплата успешна";
include "connect.php";
var_dump($url);
header("Location:$url");
