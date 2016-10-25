<?php
/**
 * Created by PhpStorm.
 * User: sergey.burikov
 * Date: 25.01.2016
 * Time: 10:50
 */
require_once(DOCUMENT_ROOT . "/connect.php");

class ExtensionClass
{
    /**
     * @param PDO $dbh
     * @return array
     */
    public function ajaxFindUser($dbh, $data)
    {
        $game = intval($data['game']);
        $username = StringInputCleaner($data['username']);
        $password = md5(StringInputCleaner($data['password']));

        $currency = StringInputCleaner($data['currency']);

        if (isset($game)) {
            $query = $dbh->prepare("
						SELECT name AS gamename
						  FROM shop.pay_games
							WHERE id = :game");
            $query->bindParam(':game', $game, PDO::PARAM_INT);
            $query->execute();
            $query = $query->fetch(PDO::FETCH_ASSOC);

            switch ($query['gamename']) {
                case 'cstrike':
                    $usersinfo = $dbh->prepare("
                                    SELECT admin.id AS admin_id,
                                           admin.steamid  AS login,
                                           admin.password AS password,
                                           admin.access   AS flags,
                                           admin.expired  AS expired,
                                           pt.name        AS access,
                                           aas.custom_flags AS custom_flags,
                                           si.hostname AS hostname,
                                           si.address AS address,
                                           ss.id AS shop_srv_id,
                                           pts.pay_type,
                                           pt_custom.name AS custom_name,
                                           pt_custom.id AS custom_id,
                                           pts.cost,
                                           pts_custom.cost AS custom_cost
                                      FROM " . CSTRIKE . "." . CSTRIKE_PREFIX . "amxadmins admin
                                       LEFT JOIN " . CSTRIKE . "." . CSTRIKE_PREFIX . "admins_servers aas
                                        ON aas.admin_id = admin.id
                                       JOIN " . SHOP . "." . SHOP_PREFIX . "type pt
                                        ON pt.access = admin.access
                                      LEFT JOIN " . SHOP . "." . SHOP_PREFIX . "type pt_custom
                                        ON pt_custom.access = aas.custom_flags AND aas.custom_flags <> ''
                                       JOIN " . CSTRIKE . "." . CSTRIKE_PREFIX . "serverinfo si
                                        ON si.id = aas.server_id
                                      JOIN " . SHOP . ".servers ss
                                        ON si.address LIKE CONCAT('%',ss.ip, '%')
                                      JOIN " . SHOP . "." . SHOP_PREFIX . "type_servers pts
                                        ON pts.pay_type = pt.id AND pts.pay_serverid = ss.id
                                      LEFT JOIN " . SHOP . "." . SHOP_PREFIX . "type_servers pts_custom
                                        ON pts_custom.pay_type = pt_custom.id AND pts_custom.pay_serverid = ss.id AND pt_custom.id IS NOT NULL
                                     WHERE admin.steamid = :username
                                       AND admin.password = :password");
                    $game = $query['gamename'];
                    break;
                case 'csgo':
                    $usersinfo = $dbh->prepare("
										SELECT vp.name      AS login,
											   vp.id        AS admin_id,
											   vo.group     AS vogroup,
											   vo.server_id AS shop_srv_id,
											   vo.expires   AS expired,
											   pts.cost     AS cost,
											   pt.id 		AS pay_type,
											   ss.servername as hostname
										  FROM goroot_vip.vip_users vp
										  JOIN goroot_vip.vip_overrides vo
											ON vo.user_id = vp.id
										  JOIN shop.pay_type pt
											ON pt.csgo = vo.group
											JOIN shop.servers ss
											ON ss.id = vo.server_id
										  JOIN shop.pay_type_servers pts
											ON pts.pay_serverid = vo.server_id
										   AND pts.pay_type = pt.id
										 WHERE vp.name = :username
										   AND vp.password = :password");
                    $game = $query['gamename'];
                    break;
                case 'samp':
                    echo "i это пирог";
                    break;
            }
            $usersinfo->bindParam(':username', $username, PDO::PARAM_STR);
            $usersinfo->bindParam(':password', $password, PDO::PARAM_STR);
            $usersinfo->execute();

            $usersinfo = $usersinfo->fetchAll(PDO::FETCH_ASSOC);

            if ($usersinfo) {
			
                switch ($query['gamename']) {
                    case 'cstrike':
                        for ($i = 0; $i < count($usersinfo); $i++) {
                            $usersinfo[$i]['typename'] = ($usersinfo[$i]['custom_flags']) ? $usersinfo[$i]['custom_name'] : $usersinfo[$i]['access'];
                            $usersinfo[$i]['pay_type'] = ($usersinfo[$i]['custom_id']) ? $usersinfo[$i]['custom_id'] : $usersinfo[$i]['pay_type'];
                            $usersinfo[$i]['game'] = $game;
                            $usersinfo[$i]['currency'] = $currency;
                            $result[] = $usersinfo[$i];
                        }
                        break;
                    case 'csgo':
                        for ($i = 0; $i < count($usersinfo); $i++) {
                            $usersinfo[$i]['typename'] = $usersinfo[$i]['vogroup'];
                            $usersinfo[$i]['pay_type'] = $usersinfo[$i]['pay_type'];
                            $usersinfo[$i]['game'] = $game;
                            $usersinfo[$i]['currency'] = $currency;
                            $result[] = $usersinfo[$i];
                        }
                }
            } else {
                $result['error'] = true;
                $result['error_message'] = "Не найден никнем!";
            }
            return $result;
        }
    }

    /**
     * @param PDO $dbh
     * @return array
     */
    public function ajaxValidate($dbh, $data)
    {
        $date = DATE;
        $status = 0;
        $admin_id = intval($data['admin_id']);
        $shop_srv_id = intval($data['shop_srv_id']);
        $pay_type = StringInputCleaner($data['pay_type']);
        $cost = intval($data['cost']);
        $game = StringInputCleaner($data['game']);
        $currency = StringInputCleaner($data['currency']);
        $days = 30;
        if ($game == 'cstrike') {
            $query_admin = $dbh->prepare("
							SELECT count(1), nickname AS nickname, password AS password, icq 
							  FROM " . CSTRIKE . "." . CSTRIKE_PREFIX . "amxadmins admin
								WHERE id = :admin_id
								");
            $query_admin->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
            $query_admin->execute();
        }
        if ($game == 'csgo') {
            $query_admin = $dbh->prepare("
							SELECT count(1), name AS nickname, password AS password, auth as icq
							  FROM " . CSGO . "." . CSGO_PREFIX . "users vp
								WHERE id = :admin_id
								");
            $query_admin->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
            $query_admin->execute();
        }
        $query_cost = $dbh->prepare("
						SELECT pts.cost, ss.type AS gametype
						  FROM " . SHOP . "." . SHOP_PREFIX . "type_servers pts
						  JOIN " . SHOP . ".servers ss
                             ON pts.pay_serverid = ss.id
							WHERE pay_type = :pay_type
							AND pay_serverid = :shop_srv_id");
        $query_cost->bindParam(':pay_type', $pay_type, PDO::PARAM_INT);
        $query_cost->bindParam(':shop_srv_id', $shop_srv_id, PDO::PARAM_INT);
        $query_cost->execute();
        //Массивы
        $query_admin = $query_admin->fetch(PDO::FETCH_ASSOC);
        $query_cost = $query_cost->fetch(PDO::FETCH_ASSOC);
        if ($query_admin['count(1)'] == 0 || $query_admin['count(1)'] === false) {
            $result['error'] = true;
            $result['error_message'] = "Форма не прошла проверку - ошибка в логине!";
        } elseif ($query_cost['cost'] != $cost) {
            $result['error'] = true;
            $result['error_message'] = "Форма не прошла проверку - сумма не совпадает!";
        } else {
            $insert = $dbh->prepare("
                            INSERT INTO shop.pay_log (cost, username, pasword, server_id, type, status, date, vk, game_type, days, currency, updater)
                              VALUES (:cost, :username, :password, :serverid, :type, :status, :date, :vk, :game_type, :days, :currency, 1)");
            $insert->bindParam(':cost', $query_cost['cost'], PDO::PARAM_INT);
            $insert->bindParam(':username', $query_admin['nickname'], PDO::PARAM_STR);
            $insert->bindParam(':password', $query_admin['password'], PDO::PARAM_STR);
            $insert->bindParam(':serverid', $shop_srv_id, PDO::PARAM_STR);
            $insert->bindParam(':type', $pay_type, PDO::PARAM_INT);
            $insert->bindParam(':status', $status, PDO::PARAM_INT);
            $insert->bindParam(':date', $date, PDO::PARAM_STR);
            $insert->bindParam(':vk', $query_admin['icq'], PDO::PARAM_STR);
            $insert->bindParam(':game_type', $query_cost['gametype'], PDO::PARAM_STR);
            $insert->bindParam(':days', $days, PDO::PARAM_STR);
            $insert->bindParam(':currency', $currency, PDO::PARAM_STR);
            $insert->execute();
            $lastId = $dbh->lastInsertId();

            $query_log = $dbh->prepare("
						SELECT log.id, log.cost, log.currency
						  FROM " . SHOP . "." . SHOP_PREFIX . "log log
							WHERE id = :lastId");
            $query_log->bindParam(':lastId', $lastId, PDO::PARAM_STR);
            $query_log->execute();
            $result = $query_log->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}
