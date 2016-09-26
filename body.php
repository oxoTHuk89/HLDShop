<?php

require_once ('connect.php');
require_once('smarty/Smarty.class.php');
require_once('include/MerchantClass.php');


//Запросы для магазина
$servers = $dbh->prepare("SELECT id, type, servername FROM servers"); //Сервера
$servers->execute();
$types = $dbh->prepare("SELECT id, name FROM ".SHOP_PREFIX."type WHERE active = 1"); //Услуги, списокпо умолчанию
$types->execute();
//Массивы для магазина
$servers = $servers->fetchAll(PDO::FETCH_ASSOC);
$types = $types->fetchAll(PDO::FETCH_ASSOC);
//

//Запросы для снятия бана
$bans = $dbh->prepare("
            SELECT bid, player_nick, admin_nick, ban_reason, ban_created, expired
            FROM $db_csbans.$bans_csbans
            ORDER BY bid DESC
            LIMIT 10
            "); //Услуги, списокпо умолчанию
$bans->execute();
//Массивы для магазина

$bans = $bans->fetchAll(PDO::FETCH_ASSOC);
//Формирование переменных для шаблона
$date = date("Y-m-d H:i:s");//Дата



//Запросы на продление
$games = $dbh->prepare("SELECT * FROM pay_games"); //Услуги, списокпо умолчанию
$games->execute();

$games = $games->fetchAll(PDO::FETCH_ASSOC);
/*
$getFrom = new Merchant();
$form = $getFrom->getFrom($merchant);
$secret_key = $form['secretkey'];*/

//Данные уходят в Smarty
$smarty = new Smarty();
//Переменные шаблона для сервера
$smarty->assign('servers', $servers);
$smarty->assign('types', $types);
$smarty->assign('titles', $titles);
//Переменные шаблона для банов
$smarty->assign('bans', $bans);
//Тут инфа по играм
$smarty->assign('games', $games);
$smarty->assign('date', $date);
//$smarty->assign('merchant_action', $form['action']);
//$smarty->assign('secretkey', $form['secretkey']);
$smarty->assign('main', true);

//** раскомментируйте следующую строку для отображения отладочной консоли
//$smarty->debugging = true;
$smarty->assign('admin', 0); //Для админки еденичка
$smarty->display('body.tpl');
//die(var_dump($error_accept ));