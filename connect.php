<?php
error_reporting(E_ALL);
define ("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']."");
define ("CSTRIKE", "burikovs_bans");
define ("CSTRIKE_PREFIX", "amx_");
define ("CSGO", "goroot_vip");
define ("CSGO_PREFIX", "vip_");
define ("SHOP", "shop");
define ("SHOP_PREFIX", "pay_");
define ("DATE", date("Y-m-d h:i:s"));
//База данных, подключение
$user = "root";
$password = "EeY9door";
$host = "localhost";
$db_shop = "shop";
//БД halflife
$db_csbans = "burikovs_bans"; //Сама БД
$admin_csbans = "amx_amxadmins"; //Таблица с админами
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
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
}/*
try {
    $connect_gobans = new PDO('mysql:host=' . $host . ';dbname=' . $db_gobans, $user, $password);
    $connect_gobans->query("SET NAMES utf8");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}*/

//Выобор платежной системы
//1 - UnitPay
//2 - Robokassa
//3 и далее резерв под WebMoney и т.д.
//Настраивать мерчат нужно в include/MerchantClass.php
//Номер нужного мерчанта соответствует переменной $merchant
$merchant = 2;

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