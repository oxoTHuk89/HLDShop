<?php
/**
 * Created by PhpStorm.
 * User: sergey.burikov
 * Date: 25.01.2016
 * Time: 10:50
 */
require_once("connect.php");
require_once("smarty/Smarty.class.php");
//<!---Удаление серверов--->
if (isset($_POST['del_srv'])) {
    $server_id = $_POST['server'];
    $servers_check = $dbh->prepare("SELECT id, servername FROM servers WHERE id = :server_id");
    $servers_check->bindParam(':server_id', $server_id, PDO::PARAM_INT);
    $servers_check->execute();
    $servers_check = $servers_check->fetch(PDO::FETCH_ASSOC);
    if ($servers_check) {
        $delete = $dbh->prepare("DELETE FROM servers WHERE id = :server_id");
        $delete->bindParam(':server_id', $server_id, PDO::PARAM_INT);
        $delete->execute();
        $delete = $dbh->prepare("DELETE FROM pay_type_servers WHERE pay_serverid = :server_id");
        $delete->bindParam(':server_id', $server_id, PDO::PARAM_INT);
        $delete->execute();
        $result = "Сервер " . $servers_check['servername'] . " удален!";
    } else {
        $result = "Ошибка, сервер не найден";
    }
    echo json_encode($result);
}
//<!---Добавление серверов--->
if (isset($_POST['add_srv'])) {
    $ip = $_POST['serverip'];
    $port = intval($_POST['serverpost']);
    $type = intval($_POST['servertype']);
    $servername = StringInputCleaner($_POST['servername']);
    $description = StringInputCleaner($_POST['serverdesc']);

    $servers_check = $dbh->prepare("SELECT name FROM pay_games WHERE id = :type");
    $servers_check->bindParam(':type', $type, PDO::PARAM_INT);
    $servers_check->execute();
    $result['existing'] = $servers_check->fetch(PDO::FETCH_ASSOC);
    $db_error = $servers_check->errorInfo();
    if ($result['existing'] == "" || $db_error[2] != null) {
        $result['error'] = "Ошибка выборе игры";
    } elseif (!filter_var($ip, FILTER_VALIDATE_IP)) {
        $result['error'] = "Неправильный IP";
    } else {
        $insert = $dbh->prepare("
            INSERT INTO servers (ip, port, type, servername, description)
              VALUES (:ip, :port, :type, :servername, :description)");
        $insert->bindParam(':ip', $ip, PDO::PARAM_STR);
        $insert->bindParam(':port', $result['existing']['name'], PDO::PARAM_INT);
        $insert->bindParam(':type', $type, PDO::PARAM_INT);
        $insert->bindParam(':servername', $servername, PDO::PARAM_STR);
        $insert->bindParam(':description', $description, PDO::PARAM_STR);
        $insert->execute();

        $result['error'] = "";
        $result['existing'] = "Сервер добавлен";
    }
    echo json_encode($result);
}
//<!---КОНЕЦ Добавление серверов--->
//<!---Удаление услуг--->
if (isset($_POST['del_priv'])) {
    $type = $_POST['type'];
    $priv_check = $dbh->prepare("SELECT id, name FROM pay_type WHERE id = :type");
    $priv_check->bindParam(':type', $type, PDO::PARAM_INT);
    $priv_check->execute();
    $priv_check = $priv_check->fetch(PDO::FETCH_ASSOC);
    if ($priv_check) {
        $delete = $dbh->prepare("DELETE FROM pay_type WHERE id = :type");
        $delete->bindParam(':type', $type, PDO::PARAM_INT);
        $delete->execute();
        $delete = $dbh->prepare("DELETE FROM pay_type_servers WHERE pay_type = :type");
        $delete->bindParam(':type', $type, PDO::PARAM_INT);
        $delete->execute();
        $result = "Услуга " . $priv_check['name'] . " удалена!";
    } else {
        $result = "Ошибка, услуга не найдена";
    }
    echo json_encode($result);
}
//<!---КОНЕЦ Удаление услуг--->
//<!---Добавление услуг--->
if (isset($_POST['add_priv'])) {
    $type = $_POST['type'];
    $flags = StringInputCleaner($_POST['flags']);
    if ($_POST['visibility'] == "on") $visibility = 1;
    else $visibility = 0;

    $type_check = $dbh->prepare("SELECT id FROM pay_type WHERE name = :type");
    $type_check->bindParam(':type', $type, PDO::PARAM_INT);
    $type_check->execute();
    $result = $type_check->fetch(PDO::FETCH_ASSOC);
    $db_error = $type_check->errorInfo();
    if ($result != false) {
        $result = "Ошибка, услуга с таким именем уже есть";
    } elseif ($type == "" || $flags == "") {
        $result = "Заполните все поля";
    } else {
        $insert = $dbh->prepare("
            INSERT INTO pay_type (name, access, active)
              VALUES (:name, :access, :active)");
        $insert->bindParam(':name', $type, PDO::PARAM_STR);
        $insert->bindParam(':access', $flags, PDO::PARAM_STR);
        $insert->bindParam(':active', $visibility, PDO::PARAM_INT);
        $insert->execute();
        $db_error = $type_check->errorInfo();
        if ($db_error[2] != null) {
            $result = $db_error[2];
        }
        $result = "Услуга добавлена";
    }
    echo json_encode($result);
}
//<!---КОНЕЦ Добавление услуг--->
//<!---Добавление услуги к серверу--->
if (isset($_POST['add_priv_to_server'])) {
    $serverlist = intval($_POST['serverlist']);
    $typelist = intval($_POST['typelist']);
    $cost = intval($_POST['cost']);

    $servers_check = $dbh->prepare("SELECT id FROM servers WHERE id = :serverlist");
    $servers_check->bindParam(':serverlist', $serverlist, PDO::PARAM_INT);
    $servers_check->execute();
    $servers_check = $servers_check->fetch(PDO::FETCH_ASSOC);
    $server_id = $servers_check['id'];

    $typelist_check = $dbh->prepare("SELECT id FROM pay_type WHERE id = :typelist");
    $typelist_check->bindParam(':typelist', $typelist, PDO::PARAM_INT);
    $typelist_check->execute();
    $typelist_check = $typelist_check->fetch(PDO::FETCH_ASSOC);
    $type_id = $typelist_check['id'];

    if ($server_id == null || $type_id == false) {
        $result = "Жукожоп! Сервера или услуги не существует!";
    } elseif ($cost == 0) {
        $result = "На кой хуй сумма буквами?! о0";
    } else {
        $insert = $dbh->prepare("
            INSERT INTO pay_type_servers (pay_type, pay_serverid, cost)
              VALUES (:typelist, :server_id, :cost)");
        $insert->bindParam(':typelist', $typelist, PDO::PARAM_INT);
        $insert->bindParam(':server_id', $serverlist, PDO::PARAM_INT);
        $insert->bindParam(':cost', $cost, PDO::PARAM_INT);
        try {
            $insert->execute();
        } catch (PDOException $e) {
            $error = $e->getCode();
        }
        $error = "";
        if ($error == 23000) {
            $result = "Такая услуга есть на выбранном сервере. Обновлена стоимость!";
            $update = $dbh->prepare("
                        UPDATE pay_type_servers
                        SET cost = :cost
                        WHERE pay_serverid = :server_id AND pay_type = :typelist");
            $update->bindParam(':typelist', $typelist, PDO::PARAM_INT);
            $update->bindParam(':server_id', $serverlist, PDO::PARAM_INT);
            $update->bindParam(':cost', $cost, PDO::PARAM_INT);
            $update->execute();
             } else if ($error[1] != 00000 && $error[1] != 1062) {
                 $result = $error[2];
             } else {
                 $result = "Услуга привязана к серверу!";
             }
        }
    

    if (isset($result)) {
        echo json_encode($result);
    }
}
if (isset($_POST['relations'])) {
    $server_id = intval($_POST['server_id']);
    $type = intval($_POST['type']);
    $cost = $_POST['cost'];
    if (is_numeric($cost)) {
        $cost = intval($cost);
        if (isset($_POST['delete_relations'])) {
            $query = $dbh->prepare("
                            DELETE FROM pay_type_servers
                             WHERE pay_type = :type
                               AND pay_serverid = :server_id
                               AND cost = :cost");
            $query->bindParam(':server_id', $server_id, PDO::PARAM_INT);
            $query->bindParam(':type', $type, PDO::PARAM_INT);
            $query->bindParam(':cost', $cost, PDO::PARAM_INT);
            $query->execute();
            $error = $query->errorInfo();
            if ($error[0] != '00000') {
                $result = $error['2'];
            } else {
                $result = "Связка удалена";
            }
        }
        if (isset($_POST['save_cost'])) {
            $query = $dbh->prepare("
                            UPDATE pay_type_servers
                             SET cost = :cost
                             WHERE pay_type = :type
                               AND pay_serverid = :server_id");
            $query->bindParam(':server_id', $server_id, PDO::PARAM_INT);
            $query->bindParam(':type', $type, PDO::PARAM_INT);
            $query->bindParam(':cost', $cost, PDO::PARAM_INT);
            $query->execute();
            $error = $query->errorInfo();
            if ($error[0] != '00000') {
                $result = $error['2'];
            } else {
                $result = "Сумма обновлена";
            }
        }
    } else $result = "Сумма не верна";
    echo json_encode($result);
}