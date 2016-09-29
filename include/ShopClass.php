<?php
/**
 * Created by PhpStorm.
 * User: sergey.burikov
 * Date: 25.01.2016
 * Time: 10:50
 */
require_once(DOCUMENT_ROOT . "/connect.php");

class Shop
{
    /**
     * @param PDO $dbh
     * @return array ServerList
     */
    public function ajaxPayType($dbh, $data)
    {
        $serverid = $data['serverid'];
        $priv_by_server = $dbh->prepare("
						SELECT pt.name        AS type,
							   pt.id          AS type_id,
							   pts.cost,
							   srv.servername AS server_name,
							   srv.id         AS server_id,
							   srv.type         AS server_type
						  FROM pay_type_servers pts
						  JOIN pay_type pt
							ON pt.id = pts.pay_type
						  JOIN servers srv
							ON srv.id = pts.pay_serverid
							WHERE pts.pay_serverid = :serverid
						 ORDER BY servername");
        $priv_by_server->bindParam(':serverid', $serverid, PDO::PARAM_INT);
        $priv_by_server->execute();
        $priv_by_server = $priv_by_server->fetchAll(PDO::FETCH_ASSOC);
        $result = json_encode($priv_by_server);
        return $result;
    }

    /**
     * @param PDO $dbh Для подключения к БД
     * @param array $data из массива POST
     * @return array
     */
    public function acceptBuy($dbh, $data, $date)
    {
        $days = intval($data['days']);
        $password = StringInputCleaner($data['password']);
        $serverid = intval($data['serverid']);
        $steamid_val = StringInputCleaner($data['steamid_val']);
        $types = intval($data['types']);
        $username = StringInputCleaner($data['username']);
        $currency = StringInputCleaner($data['currency']);
        $vk_link = StringInputCleaner($data['vk_link']);

        //Берем цену услуги по умолчанию (за 30 дней)
        $query = $dbh->prepare("SELECT pts.cost, pg.name AS game_name, pg.id AS game_id
                                  FROM pay_type_servers pts
                                    JOIN servers s
                                      ON s.id = pts.pay_serverid
                                    JOIN pay_games pg
                                      ON pg.id = s.type
                                WHERE pay_serverid = :serverid
                                AND pay_type = :types");
        //Биндим переменные
        $query->bindParam(':serverid', $serverid, PDO::PARAM_INT);
        $query->bindParam(':types', $types, PDO::PARAM_INT);
        $query->execute();
        $query = $query->fetch(PDO::FETCH_ASSOC);

        //В зависимости от игры поиск существующих с таким ником
        switch ($query['game_name']) {
            case 'cstrike':
                $name_validate = $dbh->prepare("
                            SELECT count(1)
                              FROM " . CSTRIKE . "." . CSTRIKE_PREFIX . "amxadmins admins
                             WHERE admins.steamid = :username");
                break;
            case 'source':
                $name_validate = $dbh->prepare("
                            SELECT count(1)
                              FROM " . CSGO . "." . CSGO_PREFIX . "users admins
                             WHERE admins.name = :username");
        }

        //Высчитываем стоимость в зависимости от дней
        $cost_by_day = intval($query['cost']) / 30;
        $cost = $cost_by_day * $days;

        $name_validate->bindParam(':username', $username, PDO::PARAM_STR);
        $name_validate->execute();
        $name_validate = $name_validate->fetch(PDO::FETCH_NUM);
        if ($name_validate[0] != 0) {
            $result['error'] = true;
            $result['error_message'] = "STEAMID или ник заняты. Введите другой!";
        } else {
            $pay = $dbh->prepare("
                INSERT INTO pay_log
                  (cost, username, pasword, server_id, type, date, vk, game_type, steamid_val, days, currency)
                VALUES
                  (:cost, :username, :pasword, :server_id, :type, :date, :vk, :game_type, :steamid_val, :days, :currency)");

            $pay->bindParam(':cost', $cost, PDO::PARAM_INT);
            $pay->bindParam(':username', $username, PDO::PARAM_STR);
            $pay->bindParam(':pasword', $password, PDO::PARAM_STR);
            $pay->bindParam(':server_id', $serverid, PDO::PARAM_INT);
            $pay->bindParam(':type', $types, PDO::PARAM_INT);
            $pay->bindParam(':date', $date, PDO::PARAM_STR);
            $pay->bindParam(':vk', $vk_link, PDO::PARAM_STR);
            $pay->bindParam(':game_type', $query['game_id'], PDO::PARAM_STR);
            $pay->bindParam(':steamid_val', $steamid_val, PDO::PARAM_STR);
            $pay->bindParam(':days', $days, PDO::PARAM_STR);
            $pay->bindParam(':currency', $currency, PDO::PARAM_STR);
            $pay->execute();

            $inv_id = $dbh->lastInsertId();
            //Данные по серверу для визуалки
            $details = $dbh->prepare("
                                SELECT ss.servername, pt.name
                                FROM servers ss
                                  JOIN pay_type pt
                                    ON pt.id = :type
                                WHERE ss.id = :serverid");
            $typename = $dbh->prepare("SELECT name FROM pay_type WHERE id = :type");
            $details->bindParam(':serverid', $serverid, PDO::PARAM_INT);
            $details->bindParam(':type', $types, PDO::PARAM_INT);
            $details->execute();
            $details = $details->fetch(PDO::FETCH_ASSOC);

            $shp_item = "Покупка услуги " . $details['name'];
            $result['shp_item'] = $shp_item;
            $result['servername'] = $details['servername'];
            $result['typename'] = $details['name'];
            $result['username'] = $username;
            $result['cost'] = $cost;
            $result['currency'] = $currency;
            $result['id'] = $inv_id;
        }
        return $result;
    }
}