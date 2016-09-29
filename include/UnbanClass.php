<?php
/**
 * Created by PhpStorm.
 * User: sergey.burikov
 * Date: 25.01.2016
 * Time: 10:50
 */
require_once(DOCUMENT_ROOT . "/connect.php");
//require_once(DOCUMENT_ROOT . "/smarty/Smarty.class.php");

//<!---КОНЕЦ Добавление серверов--->
//add_srv();
class Unban
{
    /**
     * @param PDO $dbh
     */
    public function ajaxFindBan($dbh, $data)
    {
        $serverid = $data['serverid'];
        $username = $data['username'];
        $username = "%$username%";
        $game = $data['game'];

        if (isset($game)) {
            $server = $dbh->prepare("
						SELECT sg.name AS name
						  FROM shop.servers ss
						  JOIN shop.pay_games sg
						  ON sg.id = ss.type
							WHERE ss.id = :serverid");
            $server->bindParam(':serverid', $serverid, PDO::PARAM_INT);
            $server->execute();
            $server = $server->fetch(PDO::FETCH_ASSOC);
        }

        if (isset($server) && $server['name'] = 'halflife') {
            $expired = strtotime('now');
            $username = "%$username%";
            $result = $dbh->prepare("
                                SELECT bans.bid AS id,
                                       bans.player_nick AS player_nick,
                                       bans.admin_nick AS admin,
                                       bans.ban_reason AS reason,
                                       bans.expired AS expired,
                                       bans.ban_created
                                 FROM burikovs_bans.amx_bans bans
                                 WHERE bans.player_nick LIKE :username
                                 AND bans.expired < :expired
                                 ORDER BY bans.ban_created DESC");

            $result->bindParam(':username', $username, PDO::PARAM_STR);
            $result->bindParam(':expired', $expired, PDO::PARAM_INT);
            $result->execute();
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        } elseif (isset($server) && $server = 'source') {
            $unban_table = 'goroot_bans.sb_bans';
        }
        if (isset($unban_table)) {

        }
        if (isset($result)) {
            return $result;
        } else {
            die("Ошибка в обработке класса - " . get_class($this) . ". В функции -" . __FUNCTION__);
        }
    }


    /**
     * @param PDO $dbh
     */
    public function acceptBuy($dbh, $data, $inv_desc, $secret_key, $merchant)
    {
        $date = date("Y-m-d H:i:s");
        $days = intval($data['days']);
        $password = $data['password'];
        $serverid = intval($data['serverid']);
        $steamid_val = StringInputCleaner($data['steamid_val']);
        $types = intval($data['types']);
        $username = StringInputCleaner($data['username']);
        $currency = StringInputCleaner($data['currency']);
        $vk_link = $data['vk_link'];

        //Берем цену услуги по умолчанию (за 30 дней)
        $cost_gen = $dbh->prepare("
                SELECT pts.cost, pg.name
                  FROM `pay_type` pts
                    JOIN `servers` s
					  ON s.id = pts.pay_serverid
					JOIN `pay_games` pg
					  ON pg.id = s.type
                WHERE `pay_serverid` = :serverid
                AND `pay_type` = :types");
        //Биндим переменные
        $cost_gen->bindParam(':serverid', $serverid, PDO::PARAM_INT);
        $cost_gen->bindParam(':types', $types, PDO::PARAM_INT);
        $cost_gen->execute();
        $cost_gen = $cost_gen->fetch(PDO::FETCH_ASSOC);
        //Высчитываем стоимость в зависимости от дней
        $game = $cost_gen['name'];
        $cost_by_day = intval($cost_gen['cost']) / 30;
        $cost = $cost_by_day * $days;
        if ($game == "halflife") {
            $base = "burikovs_bans";
            $table = "amx_amxadmins";
            $column = "steamid";
        } elseif ($game == "source") {
            $base = "goroot_bans";
            $table = "sb_admins";
            $column = "user";
        }
        $name_validate = $dbh->prepare("
            SELECT count(*)
              FROM $base.$table
              WHERE $column = '$username'
            ");
        $name_validate->bindParam(':name_validate', $username, PDO::PARAM_STR);
        $name_validate->execute();

        $name_validate = $name_validate->fetch(PDO::FETCH_NUM);
        if ($name_validate[0] != 0) {
            $error_accept = "STEAMID или ник заняты. Введите другой!";
            //$smarty->assign('error_accept', $error_accept);
        } else {
            $pay = $dbh->prepare("
        INSERT INTO `pay_log`
          (`cost`, `username`, `pasword`, `server_id`, `type`, `date`, `vk`, `game_type`, `steamid_val`, `days`)
        VALUES
          (:cost, :username, :pasword, :server_id, :type, :date, :vk, :game_type, :steamid_val, :days)
          ");

            $pay->bindParam(':cost', $cost, PDO::PARAM_INT);
            $pay->bindParam(':username', $username, PDO::PARAM_STR);
            $pay->bindParam(':pasword', $password, PDO::PARAM_STR);
            $pay->bindParam(':server_id', $serverid, PDO::PARAM_INT);
            $pay->bindParam(':type', $types, PDO::PARAM_INT);
            $pay->bindParam(':date', $date, PDO::PARAM_STR);
            $pay->bindParam(':vk', $vk_link, PDO::PARAM_STR);
            $pay->bindParam(':game_type', $game, PDO::PARAM_STR);
            $pay->bindParam(':steamid_val', $steamid_val, PDO::PARAM_STR);
            $pay->bindParam(':days', $days, PDO::PARAM_STR);
            $pay->execute();

            $inv_id = $dbh->lastInsertId();
            //Данные по серверу
            $servername = $dbh->prepare("SELECT `servername` FROM `servers` WHERE `id` = :serverid");
            $typename = $dbh->prepare("SELECT `name` FROM `pay_type` WHERE `id` = :type");
            $servername->bindParam(':serverid', $serverid, PDO::PARAM_INT);
            $typename->bindParam(':type', $types, PDO::PARAM_INT);
            $servername->execute();
            $typename->execute();
            $servername = $servername->fetch(PDO::FETCH_ASSOC);
            $typename = $typename->fetch(PDO::FETCH_ASSOC);

            if (isset($merchant) && $merchant == 'Robokassa') {
                // $crc = md5("$mrh_login:$cost:$inv_id:$mrh_pass1:shp_item=$shp_item");
            } elseif (isset($merchant) && $merchant == 'Unitpay') {
                $crc = md5($inv_id . $currency . $inv_desc . $cost . $secret_key);
            }

            $shp_item = "Покупка услуги " . $typename['name'];
            $result['shp_item'] = $shp_item;
            $result['servername'] = $servername['servername'];
            $result['typename'] = $typename['name'];
            $result['username'] = $username;
            $result['inv_desc'] = $inv_desc;
            $result['cost'] = $cost;
            $result['currency'] = $currency;
            $result['crc'] = $crc;
            $result['inv_id'] = $inv_id;
        }
        if (isset($result)) {
            return $result;
        } else {
            die("Ошибка в обработке класса - " . get_class($this) . ". В функции -" . __FUNCTION__);
        }
    }
}