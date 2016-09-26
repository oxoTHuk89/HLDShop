<?php
/**
 * Created by PhpStorm.
 * User: sergey.burikov
 * Date: 22.01.2016
 * Time: 8:56
 */
require_once("connect.php");
require_once("smarty/Smarty.class.php");

$existing = $dbh->prepare("
SELECT pt.name        AS type,
       pt.id          AS type_id,
       pts.cost,
       srv.servername AS server_name,
       srv.id         AS server_id
  FROM pay_type_servers pts
  JOIN pay_type pt
    ON pt.id = pts.pay_type
  JOIN servers srv
    ON srv.id = pts.pay_serverid
 ORDER BY servername
");
$existing->execute();
//
$servers = $dbh->prepare("SELECT id, type, servername FROM servers"); //
$servers->execute();
$types = $dbh->prepare("SELECT id, name, access FROM pay_type");
$types->execute();
$games = $dbh->prepare("SELECT id, name, fullname FROM pay_games");
$games->execute();


$existing = $existing->fetchAll(PDO::FETCH_ASSOC);
$servers = $servers->fetchAll(PDO::FETCH_ASSOC);
$types = $types->fetchAll(PDO::FETCH_ASSOC);
$games = $games->fetchAll(PDO::FETCH_ASSOC);


//var_dump($servers);
//var_dump($types);
$smarty = new Smarty();
$smarty->assign('servers', $servers);
$smarty->assign('types', $types);
$smarty->assign('existing', $existing);
$smarty->assign('games', $games);
$smarty->assign('admin', 1);

$smarty->display('admin.tpl');

///$smarty->debugging = true;



