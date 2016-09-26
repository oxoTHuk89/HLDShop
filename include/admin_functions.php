<?php
/**
 * Created by PhpStorm.
 * User: sergey.burikov
 * Date: 25.01.2016
 * Time: 10:50
 */
require_once(DOCUMENT_ROOT . "/connect.php");
require_once(DOCUMENT_ROOT . "/admin_ajax.php");
//require_once(DOCUMENT_ROOT . "/smarty/Smarty.class.php");

//<!---КОНЕЦ Добавление серверов--->
//add_srv();
class srv
{
    public function add_srv($dbh, $data)
    {
        $rr = $dbh;
        $servers_check = $rr->prepare("SELECT name FROM pay_games WHERE id = :type");
        //$servers_check = $dbh->prepare("SELECT name FROM pay_games WHERE id = :type");
        $servers_check->bindParam(':type', $type, PDO::PARAM_INT);
        $servers_check->execute();
        //return $servers_check->errorInfo();
        return $servers_check;
    }
}