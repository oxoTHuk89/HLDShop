<?php
error_reporting(E_ALL);

define ("PROJECT_ROOT", $_SERVER['DOCUMENT_ROOT']);
define ("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
define ("CSTRIKE", "amxbans");
define ("CSTRIKE_PREFIX", "amx_");
define ("CSGO", "burikovs_bans");
define ("CSGO_PREFIX", "sb_");
define ("SHOP", "shop");
define ("SHOP_PREFIX", "pay_");
define ("DATE", date("Y-m-d h:i:s"));
//База данных, подключение
$user = "root";
$password = "EeY9door";
$host = "myadmin.g-nation.ru";
$db_shop = "shop";
//БД halflife
$db_csbans = "burikovs_bans"; //Сама БД
$admin_csbans = "amxbans"; //Таблица с админами
$bans_csbans = "amx_bans"; //Таблица с банами

//БД source
$db_gobans = "goroot_bans"; //Сама БД
$admin_gobans = "sb_admins"; //Таблица с админами
$bans_gobans = "sb_bans"; //Таблица с банами

//Заголовки модальных окон (пока тут, может в БД уйдет, пока хз)
$titles['shop'] = "Магазин";
$titles['unban'] = "Снять бан";
$titles['extension'] = "Продление";
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db_shop, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $dbh->query("SET NAMES utf8");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    $connect_csbans = new PDO('mysql:host=' . $host . ';dbname=' . $db_csbans, $user, $password);
    $connect_csbans->query("SET NAMES utf8");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
try {
    $connect_gobans = new PDO('mysql:host=' . $host . ';dbname=' . $db_gobans, $user, $password);
    $connect_gobans->query("SET NAMES utf8");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

//Объявим мерчант раскомментировать нужный (по две строки)
//$merchant['name'] = "Robokassa";
//$merchant['action'] = "https://merchant.roboxchange.com/Index.aspx";
$merchant['name'] = "Unitpay";
$merchant['action'] = "https://unitpay.ru/pay/41421-2f8c5";
//$merchant = "Unitpay";


$secret_key = "76f06cb01de51ac0225d74f07c4b9b3a";
//Robokassa
$mrh_login = "g-nation_test";
$mrh_pass1 = "Uw95OBWy1tw8R4thWPla";
$mrh_pass2 = "grBhpq02aXzd09if3Vnz";
$inv_desc = "Game Nat1ons";
$culture = "ru";
$encoding = "utf-8";
//xPaw отправка amx_reloadadmins
$rcon = "Ahtae5Ae";
$cmd = "amx_reloadadmins";

//Webmoney


//Sucsess
$url = "http://g-nation.ru/index.php?/topic/367-faq-po-magazinu/#entry3715";

function StringInputCleaner($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = (filter_var($data, FILTER_SANITIZE_STRING));
    return $data;
}