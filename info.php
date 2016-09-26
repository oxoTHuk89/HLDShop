<?php
include("../shop_test/connect.php");
//echo json_encode($secret_key);
//require '/include/SourceQuery.class.php';
//установка текущего времени
//current date
$method = $_GET['method'];
if ($method == "check") {
    $sign = $_REQUEST['params']['sign'];
    $params = $_REQUEST['params'];
    unset($params['sign']);
    foreach ($params as $key => $param) {
        if ($key != null) $array_params[] = $param;
        else echo '$key переменная ушла как ноль';
    }
    $res = implode("", $array_params);
    $sing_res = md5($res . $secret_key);

    //echo json_encode($sign);
    if ($sing_res != $sign) {
        die('Ошибка подписи');
    } else {
        $message = 'all okai';
        echo json_encode(array(
            "jsonrpc" => "2.0",
            "result" => array(
                "message" => $message
            ),
            'id' => 1,
        ));
    }
} else if ($method === "pay") {
    $out_summ = $_REQUEST['params']['orderSum'];
    $inv_id = $_REQUEST['params']['account'];

    $tm = getdate(time() + 9 * 3600);
    $date = "$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";

    $query = $dbh->prepare("UPDATE pay_log
                             SET status = 1
                             WHERE id = :inv_id");
    $query->bindParam(':inv_id', $inv_id, PDO::PARAM_INT);
    $query->execute();

    $query = $dbh->prepare("
	SELECT pl.*, pt.active AS active, pt.access AS access, ss.servername
	FROM pay_log pl
        JOIN pay_type pt
          ON pt.id = pl.type
        JOIN servers ss
          ON ss.id = pl.server_id
    WHERE pl.id = :inv_id");
    $query->bindParam(':inv_id', $inv_id, PDO::PARAM_INT);
    $query->execute();
    $query = $query->fetch(PDO::FETCH_ASSOC);
    $db_info = $dbh->prepare("SELECT name FROM pay_games WHERE id = :inv_id");
    $db_info->bindParam(':inv_id', $query['game_type'], PDO::PARAM_INT);
    $db_info->execute();
    $db_info = $db_info->fetch(PDO::FETCH_ASSOC);

    $date = $query['date'];
    $days = $query['days'];
    $created = strtotime($date);
    $expired = strtotime("$date +$days day");
    $password = md5($query['password']);

    $query['flags'] = 'a';
    $query['ashow'] = 1;
    switch ($db_info['name']) {
        case 'halflife':
            switch ($query['active']) {
                case 1:
                    $pay = $dbh->prepare("
					INSERT INTO " . CSTRIKE . "." . CSTRIKE_PREFIX . "amxadmins
                  (username, password, access, flags, steamid, nickname, icq, ashow, created, expired, days)
                VALUES
                  (:username, :password, :access, :flags, :steamid, :nickname, :icq, :ashow, :created, :expired, :days)");

                    $pay->bindParam(':username', $query['username'], PDO::PARAM_STR);
                    $pay->bindParam(':password', $password, PDO::PARAM_STR);
                    $pay->bindParam(':access', $query['access'], PDO::PARAM_STR);
                    $pay->bindParam(':flags', $query['flags'], PDO::PARAM_STR);
                    $pay->bindParam(':steamid', $query['username'], PDO::PARAM_STR);
                    $pay->bindParam(':nickname', $query['username'], PDO::PARAM_STR);
                    $pay->bindParam(':icq', $query['vk'], PDO::PARAM_STR);
                    $pay->bindParam(':ashow', $query['ashow'], PDO::PARAM_INT);
                    $pay->bindParam(':created', $created, PDO::PARAM_STR);
                    $pay->bindParam(':expired', $expired, PDO::PARAM_STR);
                    $pay->bindParam(':days', $query['days'], PDO::PARAM_INT);
                    break;
                case 0:
                    var_dump('update');
            }
            $database = CSTRIKE . "." . CSTRIKE_PREFIX . "amxadmins";
            break;
        case 'source':
            $pay = $dbh->prepare("
                            SELECT count(1)
                              FROM " . CSGO . "." . CSGO_PREFIX . "admins admins
                             WHERE admins.user = :username");
    }

    if ($pay->execute()) {
        switch ($db_info['name']) {
            case 'halflife':
                $db_info = $dbh->prepare("SELECT id FROM " . CSTRIKE . "." . CSTRIKE_PREFIX . "serverinfo WHERE hostname = :servername");

                $db_info->bindParam(':servername', $query['servername'], PDO::PARAM_INT);
                $db_info->execute();

                $db_info = $db_info->fetch(PDO::FETCH_ASSOC);
                $adm_to_server['admin_id'] = $dbh->lastInsertId();
                $adm_to_server['server_id'] = $db_info['id'];
                $adm_to_server['use_static_bantime'] = 'yes';
                $pay = $dbh->prepare("
					INSERT INTO " . CSTRIKE . "." . CSTRIKE_PREFIX . "admins_servers
                  (admin_id, server_id, use_static_bantime)
					VALUES
                  (:admin_id, :server_id, :use_static_bantime)");
                $pay->bindParam(':admin_id', $adm_to_server['admin_id'], PDO::PARAM_INT);
                $pay->bindParam(':server_id', $adm_to_server['server_id'], PDO::PARAM_INT);
                $pay->bindParam(':use_static_bantime', $adm_to_server['use_static_bantime'], PDO::PARAM_INT);
                $pay->execute();
                break;
        }


        $message = 'Добавил в админов';
        echo json_encode(array(
            "jsonrpc" => "2.0",
            "result" => array(
                "message" => $message
            ),
            'id' => 1,
        ));
    } else {
        $message = "Запрос не обработал";
        echo json_encode(array(
            "error" => "2.0",
            "result" => array(
                "message" => $message
            ),
            'id' => 1,
        ));
    }


    die();
    $server_id_pay = $row['server_id'];
    $sql_lgsl = $dbh->query("SELECT servername FROM lgsl WHERE id='$server_id_pay'");
    $row_lgsl = $sql_lgsl->fetch();
    $servername = $row_lgsl['servername'];

    $sql_type = $dbh->query("SELECT id, access FROM pay_type WHERE cost = '$out_summ'");
    $row_type = $sql_type->fetch();
    $type = $row['type'];


    if ($type == "1" || $type == "2" || $type == "3" || $type == "4" || $type == 10 || $type == 7) {
        $access = $row_type['access'];
        $password = $row['pasword'];
        $username = "";
        $flags = "a";
        $steamid = $row['username'];
        $icq = $row['vk'];
        $nickname = $row['username'];
        $ashow = "1";
        $days = "30";
        $message2 = 'all okai2';
        echo json_encode(array(
            "jsonrpc" => "2.0",
            "result" => array(
                "message" => $out_summ
            ),
            'id' => 1,
        ));

        if ($row['game_type'] == "halflife") {
            $sql_server_id = $dbh->query("SELECT id FROM amx_serverinfo WHERE hostname='$servername'");
            $row_server_id = $sql_server_id->fetch();
            $server_id = $row_server_id['id'];

            $addtoserver = $server_id;
            $exp = "(UNIX_TIMESTAMP()+(" . ($days * 86400) . ")),";
            $query = $dbh->query
            ("INSERT INTO `amx_amxadmins`
				(`username`,`PASSWORD`,`ACCESS`,`flags`,`steamid`,`nickname`,`icq`,`ashow`,`created`,`expired`,`days`)
					VALUES ('" . $username . "','" . $password . "','" . $access . "','" . $flags . "','" . $steamid . "','" . $nickname . "','" . $icq . "'," . $ashow . ",UNIX_TIMESTAMP()," . $exp . "" . $days . ")");

            $adminid = $dbh->lastInsertId();
            $sban = "yes";
            $query = $dbh->query
            ("INSERT INTO `amx_admins_servers`
				(`admin_id`,`server_id`,`custom_flags`,`use_static_bantime`)
					VALUES('" . $adminid . "','" . $addtoserver . "','','" . $sban . "')");
        } else if ($row['game_type'] == "source") {
            $sql_server_id = $dbh->query("SELECT sid, hostname FROM `goroot_bans`.`sb_servers` WHERE hostname='" . $servername . "'");
            $row_server_id = $sql_server_id->fetch(PDO::FETCH_ASSOC);
            $server_id = $row_server_id['sid'];
            $addtoserver = $row['server_id'];
            $steamid_val = $row['steamid_val'];
            $exp = "(UNIX_TIMESTAMP()+(" . ($days * 86400) . "))";
            var_dump($type);
            if ($type == 10) {
                $query = $dbh->query
                ("INSERT INTO `goroot_bans`.`sb_admins`
					(`USER`,`AUTHID`,`PASSWORD`,`gid`,`email`,`VALIDATE`,`extraflags`,`immunity`,`srv_group`,`srv_flags`,`srv_password`, `lastvisit`, `expired`)
						VALUES ('" . $steamid . "','" . $steamid_val . "','" . $password . "','4','" . $icq . "','NULL','0','50', 'Магазин', '', '', '', " . $exp . ")");

                $adminid = $dbh->lastInsertId();

                $query = $dbh->query
                ("INSERT INTO `goroot_bans`.`sb_admins_servers_groups`
					(`admin_id`,`group_id`,`srv_group_id`,`server_id`)
						VALUES('" . $adminid . "','6','-1','" . $server_id . "')");
            }
            if ($type == 3) {
                $query = $dbh->query
                ("INSERT INTO `goroot_vip`.`vip_users`
					(`auth`,`NAME`,`auth_type`)
						VALUES ('" . $steamid_val . "','" . $steamid . "', '0')");
                $vipid = $dbh->lastInsertId();
                $query = $dbh->query
                ("INSERT INTO `goroot_vip`.`vip_overrides`
					(`user_id`,`server_id`,`GROUP`,`expires`)
						VALUES(" . $vipid . ",'0','vip1'," . $exp . ")");
            }
        }
    }
//Продляем услугу
    if ($type == 6) {
        $sql = $dbh->query("SELECT steamid, expired FROM amx_amxadmins WHERE steamid='" . $row['username'] . "'");
        $row = $sql->fetch();
        $day = 30;
        $create = date("Y-m-d H:i:s", $row['created']); //Created
        $expired = date("Y-m-d H:i:s", $row['expired']); //Current expired
        if (strtotime($expired) > strtotime(TODAY)) {
            $end = date("Y-m-d H:i:s", strtotime("+$day day", strtotime($expired))); //expired + $days
        } else {
            $end = date("Y-m-d H:i:s", strtotime("+$day day")); //expired + $days
        }
        $create = date_create($create);
        $end1 = date_create($end);
        $interval = date_diff($create, $end1);
        $days = (int)$interval->format("%a");
        $end = strtotime($end);
        $sql = $dbh->query("UPDATE amx_amxadmins SET expired = '$end' WHERE  steamid = '" . $row['steamid'] . "'");
        if (!$sql) {
            die("Произошла ошибка, обновите страницу и попробуйте обратиться к администратору.");
        }
    }
//Удаляем всю инфу о бане (bid прописывается в password)
    if ($type == 5) {
        $sql = $dbh->query("DELETE FROM amx_bans WHERE bid = '" . $row['pasword'] . "'");
        $sql = $dbh->query("DELETE FROM amx_bans_edit WHERE bid = '" . $row['pasword'] . "'");
        $sql = $dbh->query("DELETE FROM amx_bans_log WHERE bid = '" . $row['pasword'] . "'");
    }
//Посылаем amx_reloadadmins спасибо xPaw
//Пока заглушка на unban чтобы не было ошибки
    if ($type != 5) {
        $sql_server = $dbh->query("SELECT ip, c_port FROM lgsl WHERE id='$server_id_pay'");
        $row_server = $sql_server->fetch(PDO::FETCH_ASSOC);
        $Query = new SourceQuery();
        if ($row['game_type'] == "halflife") {
            $cmd = "amx_reloadadmins";
            $Query->Connect($row_server['ip'], $row_server['c_port'], 1, SourceQuery::GOLDSOURCE);
            $Query->SetRconPassword($rcon);
            $Query->Rcon($cmd);
        }
        if ($row['game_type'] == "source") {
            if ($row['type'] == 3) {
                $cmd = "sm_vip_reload";
            } else if ($row['type'] == 10) {
                $cmd = "sm_reloadadmins";
            }
            $Query->Connect($row_server['ip'], $row_server['c_port'], 1, SourceQuery::SOURCE);
            $Query->SetRconPassword($rcon);
            $Query->Rcon($cmd);
        }
        $Query->Disconnect();
    }
    $f = @fopen("order.txt", "a+") or
    die("error");
    fputs($f, "order_num :$inv_id;Summ :$out_summ;Date :$date\n");
    fclose($f);


}


