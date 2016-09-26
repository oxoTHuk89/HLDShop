<?php
//error_reporting(E_ALL);
require_once('connect.php');
require_once('smarty/Smarty.class.php');
require_once('include/ShopClass.php');
require_once('include/UnbanClass.php');
require_once('include/MerchantClass.php');
require_once('include/ExtensionClass.php');
//Обновляем список услуг в зависимости от сервера


if (isset($_POST['priv_update']) && $_POST['serverid'] != "") {
    $ajaxPayType = new Shop();
    $priv_update = $ajaxPayType->ajaxPayType($dbh, $_POST);
    echo $priv_update;
} else {
    $smarty = new Smarty();
    //Магазин
    if (isset($_POST['accept'])) {
        $acceptBuy = new Shop();
        $result = $acceptBuy->acceptBuy($dbh, $_POST, DATE, $merchant);
        if (!isset($result['error'])) {
            $getMerchantForm = true;
            $smarty->assign('accept', true);
            foreach ($result as $k=>$v){
                $smarty->assign($k, $v);
            }
        }
    }


    if (isset($_POST['find_username'])) {
        $smarty->assign('find_username', true);
        $ajaxFindBan = new Unban();
        $result = $ajaxFindBan->ajaxFindBan($dbh, $_POST);
        if (empty($result)) {
            $smarty->assign('error', true);
        }
        $smarty->assign('result', $result);
        foreach ($priv_update as $k=>$v){
            $smarty->assign($k, $v);
        }

        $smarty->assign('cost', $priv_update['cost']);
        $smarty->assign('currency', $priv_update['currency']);
        $smarty->assign('inv_id', $priv_update['inv_id']);
        $smarty->assign('shp_item', $priv_update['shp_item']);
        $smarty->assign('inv_desc', $priv_update['inv_desc']);
        $smarty->assign('crc', $priv_update['crc']);
        $smarty->assign('merchant_name', $merchant);
        $smarty->assign('merchant_action', $merchant['action']);

        /*$username = $_POST['username'];
        $game = $_POST['game'];
        $username = "%$username%";
        $find_csbans = $dbh->prepare("
                        SELECT `bid` as id, `player_nick` as player_nick, `ban_reason` as ban_reason, `ban_created` as ban_created, `expired` as expired
                                    FROM $db_csbans.$bans_csbans
                                    WHERE `player_nick` LIKE :username
                                    ORDER BY `bid` DESC
                                    ");

        $find_csbans->bindParam(':username', $username, PDO::PARAM_STR);
        $find_csbans->execute();
        $error = $find_csbans->errorInfo();
        $smarty->assign('error', $error[2]);

        $find_gobans = $dbh->prepare("
                        SELECT `bid` as id, `name` as player_nick, `reason` as ban_reason, `created` as ban_created, `ends` as expired
                                    FROM $db_gobans.$bans_gobans
                                    WHERE `name` LIKE :username
                                    ORDER BY `bid` DESC
                                    ");

        $find_gobans->bindParam(':username', $username, PDO::PARAM_STR);
        $find_gobans->execute();
        $error = $find_gobans->errorInfo();
        $smarty->assign('error', $error[2]);

        $find_csbans = $find_csbans->fetchAll(PDO::FETCH_ASSOC);
        $find_gobans = $find_gobans->fetchAll(PDO::FETCH_ASSOC);

        if ($game == "halflife") {
            $banlist = $find_csbans;
        } elseif ($game == "source") {
            $banlist = $find_gobans;
        } else {
            $error = "Ошбибка связана с выбором сервера";
        }

        if ($banlist == false) {
            $error = "Ничего не найдено";
            $smarty->assign('error', $error);
        } else {

            $smarty->assign('bans', $banlist);
        }*/
    }
    //Продление начало
    if (isset($_POST['username_check'])) {
        $smarty->assign('username_check', true);
        $ajaxFindUser = new ExtensionClass();
        $result = $ajaxFindUser->ajaxFindUser($dbh, $_POST);
        if (!isset($result['error'])) {
            $smarty->assign('result', $result);
            $smarty->assign('priv_lists', true);
        }
    }
    //Продление подтверждение, если гуд, то форма сама отправится
    if (isset($_POST['extension_check'])) {
        $smarty->assign('username_check', true);
        $ajaxFindUser = new ExtensionClass();
        $result = $ajaxFindUser->ajaxValidate($dbh, $_POST);
        if (!isset($result['error'])) {
            $getMerchantForm = true;
        }
    }

    $smarty->display('result.tpl');

    if (isset($getMerchantForm)) {
        $getFrom = new Merchant();
        $MerchantForm = $getFrom->getFrom($merchant, $result, $inv_desc);
        $smarty->assign('MerchantForm', $MerchantForm);
        $smarty->display('merchant.tpl');
    }
    if (isset($result['error'])) {
        $smarty->assign('error_message', $result['error_message']);
        $smarty->display('error.tpl');
    }
    die();


    //if (isset($_POST['username_check'])) {
    //Ищем юзера по логину и паролю и т.д.
    $smarty->assign('username_check', 1);
    $serverid = intval($_POST['serverid']);
    $username = StringInputCleaner($_POST['username']);
    $username = StringInputCleaner($_POST['username']);
    $password = md5($_POST['password']);

    //Чекаем какой half-life или source, блядские базы то разные
    $server_check = $dbh->prepare("SELECT `ID`, `TYPE` FROM servers WHERE `ID` = :serverid");
    $server_check->bindParam(':serverid', $serverid, PDO::PARAM_INT);
    $server_check->execute();
    $server_check = $server_check->fetch(PDO::FETCH_ASSOC);
    //var_dump($server_check);
    //Идентифицируем админа
    if ($server_check['type'] == "halflife") {
        $query = $dbh->prepare("
                            SELECT `id`, `steamid`, `password`, `access`, `expired`
                              FROM $db_csbans.$admin_csbans
                             WHERE `steamid` = :username
                               AND `password` = :password");

    }
    if ($server_check['type'] == "source") {
        $query = $dbh->prepare("
                            SELECT `aid`, `user`, `password`, `access`, `expired`
                              FROM $db_csbans.$admin_csbans
                             WHERE `steamid` = :username
                               AND `password` = :password");
    }
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $usersinfo = $query->fetchAll(PDO::FETCH_ASSOC);
    if ($usersinfo == false) {
        $error_username_check = "Логин или пароль не верны";
        $smarty->assign('error_username_check', $error_username_check);

    } else {
        foreach ($usersinfo as $user) {
            if ($server_check['type'] == "halflife") {
                $access = $user['access'];
            }
        }
        $smarty->assign('usersinfo', $usersinfo);
        //Берем имя текущей услуги, чтобы на форме она была selected
        $selected = $dbh->prepare("
                                SELECT pt.id AS id, pt.name AS name, pts.cost AS cost
                                  FROM pay_type_servers pts
                                  JOIN pay_type pt
                                    ON pt.id = pts.pay_type
                                 WHERE ACCESS = :ACCESS
                                   AND pts.pay_serverid = :serverid");
        $selected->bindParam(':access', $access, PDO::PARAM_STR);
        $selected->bindParam(':serverid', $serverid, PDO::PARAM_INT);
        $selected->execute();
        $selected = $selected->fetch(PDO::FETCH_ASSOC);
        var_dump($selected);
        $selected = $selected['id'];
        $smarty->assign('selected', $selected);
        $query = $dbh->prepare("
                            SELECT id, name
                              FROM pay_type
                             WHERE active = 1");
        $query->execute();

        //Все услуги, если захочет поменять вдруг
        $access = $query->fetchAll(PDO::FETCH_ASSOC);
        $smarty->assign('access', $access);
        if ($access == false) {
            $error = "Услуги не найдена";
            $smarty->assign('error', $error);
        } else {
            $smarty->assign('access', $access);
        }
    }
    //}

    //$smarty->display('result.tpl');
}

$date = date("Y-m-d H:i:s");
if (isset($_POST['sid_return'])) {
    $nickname = $_POST['sid'];

    $sql = "SELECT * FROM amx_bans WHERE player_nick LIKE '%$nickname%' ORDER BY `ban_created` DESC ";
    if ($nickname == "") {
        //die("Произошла ошибка, обновите страницу и попробуйте обратиться к администратору.");
        $success = 0;
    } else {
        $success = 1;
    }
    foreach ($dbh->query($sql) as $myrow) {
        $bid[] = $myrow['bid'];
        $player_nick[] = $myrow['player_nick'];
        $admin_nick[] = $myrow['admin_nick'];
        $ban_reason[] = $myrow['ban_reason'];
        $ban_created[] = date("Y-m-d h:i", $myrow['ban_created']);
    }
    //Тут надо запилить ошибку, когда не находит ник
    if ($myrow == NULL) {
        $success = 0;
    }
    if ($myrow != "") {
        $smarty = new Smarty();
        //В шаблон визуалка
        $smarty->assign('bid', $bid);
        $smarty->assign('player_nick', $player_nick);
        $smarty->assign('admin_nick', $admin_nick);
        $smarty->assign('ban_reason', $ban_reason);
        $smarty->assign('ban_created', $ban_created);
        $smarty->assign('success', $success);
        //В шаблон Robokasa
        $smarty->assign('inv_id', $inv_id);
        $smarty->assign('inv_desc', $inv_desc);
        $smarty->assign('crc', $crc);
        $smarty->assign('Shp_item', $shp_item);
        $smarty->assign('culture', $encoding);
        $smarty->assign('mrh_login', $mrh_login);
        $smarty->assign('mrh_pass1', $mrh_pass1);
        $smarty->assign('cost', $cost);
        //$smarty->display('search_steam.tpl');
    }
}
if (isset($_POST['unban'])) {
    $type = 5;
    $unban_id = $_POST['unban_id'];
    $steamid = $_POST['player_nick'];
    $cost_unban = $_POST['cost_unban'];
    $sql_q = $dbh->query("
				INSERT INTO pay (cost, username, pasword, server_id, type, date, vk)
					VALUES ('$cost_unban', '$steamid', '$unban_id', '$server_id', '$type', '$date', '$vk')");

    if (!$sql_q) {
        die("Произошла ошибка, обновите страницу и попробуйте обратиться к администратору.");
        $success = 0;
    } else {
        $success = 1;
    }
    $inv_id = $dbh->lastInsertId();
    $shp_item = "Снятие бана";
    $crc = md5("$mrh_login:$cost_unban:$inv_id:$mrh_pass1:Shp_item=$shp_item");
    $smarty = new Smarty();
    $smarty->assign('success', $success);
    $smarty->assign('inv_id', $inv_id);
    $smarty->assign('inv_desc', $inv_desc);
    $smarty->assign('crc', $crc);
    $smarty->assign('Shp_item', $shp_item);
    $smarty->assign('culture', $encoding);
    $smarty->assign('mrh_login', $mrh_login);
    $smarty->assign('mrh_pass1', $mrh_pass1);
    $smarty->assign('cost', $cost_unban);
    //$smarty->display('search_steam.tpl');
}
if (isset($_POST['shop'])) {
    if (!empty($_POST['server_id']) &&
        !empty($_POST['cost']) &&
        !empty($_POST['username']) &&
        !empty($_POST['pass']) &&
        !empty($_POST['vk'])
    ) {
        if ($_POST['servers_type'] == "halflife") {
            $hostname = trim($_POST['hostname']);
            $sql_hostname = $dbh->query("SELECT id, hostname FROM amx_serverinfo WHERE hostname='" . $hostname . "'");
            $row_hostname = $sql_hostname->fetch(PDO::FETCH_ASSOC);
            $sql_type = $dbh->query("SELECT name FROM pay_type WHERE cost='" . $_POST['cost'] . "'");
            $row_type = $sql_type->fetch(PDO::FETCH_ASSOC);
            //Ищем админа по нику
            $sql = $dbh->query("SELECT COUNT(*) FROM amx_amxadmins WHERE steamid='" . $_POST['username'] . "'");
            $row = $sql->fetch();
            //var_dump($row);
            //die();
        } else if ($_POST['servers_type'] == "source") {
            //Для результата берем имя сервера
            $hostname = trim($_POST['hostname']);
            $sql_hostname = $dbh->query("SELECT sid, hostname FROM `goroot_bans`.`sb_servers` WHERE hostname='" . $hostname . "'");
            $row_hostname = $sql_hostname->fetch(PDO::FETCH_ASSOC);
            //Для результата берем тип покупки
            $sql_type = $dbh->query("SELECT name FROM pay_type WHERE cost='" . $_POST['cost'] . "'");
            $row_type = $sql_type->fetch(PDO::FETCH_ASSOC);
            //Ищем админа по нику
            $sql = $dbh->query("SELECT COUNT(*) FROM `goroot_bans`.`sb_admins` WHERE AUTHID = '" . $_POST['steamid'] . "'");
            $row = $sql->fetch();
        }

        if ($row[0] != 0) {
            $error = "STEAMID или ник заняты. Введите другой!";
            $smarty = new Smarty();
            $smarty->assign('error', $error);
            //$smarty->display('res.tpl');
        } else {
            $steamid = $_POST['username'];
            $pass = md5($_POST['pass']);
            $server_id = $_POST['server_id'];
            $game_type = $_POST['servers_type'];
            $steamid_val = $_POST['steamid_val'];
            $cost = $_POST['cost'];
            $vk = $_POST['vk'];
            $sql_type = $dbh->query("SELECT id, name FROM pay_type WHERE cost = '$cost'");
            $row_type = $sql_type->fetch();
            $type = $row_type['id'];
            $type_name = $row_type['name'];

            $sql_q = $dbh->query("
				INSERT INTO pay (cost, username, pasword, server_id, type, date, vk, game_type, steamid_val)
					VALUES ('$cost', '$steamid', '$pass', '$server_id', '$type', '$date', '$vk', '$game_type', '$steamid_val')");
            if (!$sql_q) {
                //print_r($dbh->errorInfo());
                die("Произошла ошибка, обновите страницу и попробуйте обратиться к администратору.");
            }
            //Robokassa для формы в зависимости от поста переменные
            $inv_id = $dbh->lastInsertId();
            $shp_item = "Получение услуг";
            $crc = md5("$mrh_login:$cost:$inv_id:$mrh_pass1:Shp_item=$shp_item");
            //$crc  = md5("$mrh_login:$inv_id:$mrh_pass1:Shp_item=$pay_type:Encoding=$encoding");
            $smarty = new Smarty();
            $smarty->assign('inv_id', $inv_id);
            $smarty->assign('inv_desc', $inv_desc);
            $smarty->assign('crc', $crc);
            $smarty->assign('Shp_item', $shp_item);
            $smarty->assign('culture', $encoding);
            $smarty->assign('mrh_login', $mrh_login);
            $smarty->assign('mrh_pass1', $mrh_pass1);
            $smarty->assign('cost', $cost);
            //Для визуалки
            $smarty->assign('server_id', $row_hostname['hostname']);
            $smarty->assign('type', $type_name);
            $smarty->assign('steamid', $steamid);
            //$smarty->display('res.tpl');
        }
    }
}
if (isset($_POST['renewal'])) {
    $login_name = $_POST['login_name'];
    $login_pass = md5($_POST['login_pass']);
    $sql = $dbh->query(
        "SELECT id, steamid, password, ACCESS, expired
		FROM amx_amxadmins
			WHERE steamid = '" . $login_name . "' AND
					PASSWORD = '" . $login_pass . "'");
    $row = $sql->fetch();
    $steamid = $row['steamid'];
    $sql_admin_server = $dbh->query(
        "SELECT server_id
		FROM amx_admins_servers
			WHERE admin_id = '" . $row['id'] . "'");
    $row_admin_server = $sql_admin_server->fetch();
    $server_id = $row_admin_server['server_id'];


    $expired = date('Ymd', $row['expired']);
    $today = date('Ymd', strtotime('NOW'));

    if ($row['expired'] < strtotime('NOW') && $row['expired'] <> 0) {
        $timeleft = "Истекло";
    } else if ($row['expired'] == 0) {
        $timeleft = "Никогда";
    } else if ($expired > $today) {
        //$timeleft = $expired - $today;
        $datetime1 = new DateTime($expired);
        $datetime2 = new DateTime($today);
        $interval = $datetime1->diff($datetime2);
        $timeleft = $interval->format('%a дней');
    }
    if (!$row) {
        $login_incorrect = "Неправильные данные";
        $timeleft = "";
        //echo "Данные не верны";
    } else {
        $sql_access = $dbh->query("SELECT id, name, cost FROM pay_type WHERE ACCESS = '" . $row['access'] . "'");
        $row = $sql_access->fetch();
        //$type = $row['id']; //пока тип передаем вручну для обновы
        $type = 6;
        $type_name = $row['name'];
        $cost = $row['cost'];
    }
    if (!$login_incorrect) {
        $sql_q = $dbh->query("
				INSERT INTO pay (cost, username, pasword, server_id, type, date, vk)
					VALUES ('$cost', '$steamid', '$pass', '$server_id', '$type', '$date', '$vk')");
        if (!$sql_q) {
            die("Произошла ошибка, обновите страницу и попробуйте обратиться к администратору.");
        }
    }
    $inv_id = $dbh->lastInsertId();
    $shp_item = "Продление услуг";
    $crc = md5("$mrh_login:$cost:$inv_id:$mrh_pass1:Shp_item=$shp_item");
    $smarty = new Smarty();
    $smarty->assign('inv_id', $inv_id);
    $smarty->assign('inv_desc', $inv_desc);
    $smarty->assign('crc', $crc);
    $smarty->assign('Shp_item', $shp_item);
    $smarty->assign('culture', $encoding);
    $smarty->assign('mrh_login', $mrh_login);
    $smarty->assign('mrh_pass1', $mrh_pass1);

    $smarty->assign('login_incorrect', $login_incorrect);
    $smarty->assign('type', $type);
    $smarty->assign('type_name', $type_name);
    $smarty->assign('cost', $cost);
    $smarty->assign('timeleft', $timeleft);
    //$smarty->display('renewal.tpl');
}