<?php
/**
 * Created by PhpStorm.
 * User: sergey.burikov
 * Date: 25.01.2016
 * Time: 10:50
 */
require_once(DOCUMENT_ROOT . "/connect.php");

class LastInsertInfo
{
    public function getInfo($id)
    {

        switch ($id) {
            //Под еденичкой по любому UnitPay
            case 1:
                //Все необходимые данные для Unitpay
                $result['merchant_type'] = $id; //Передаем, чтобы Smarty понял, что это Unitpay
                $result['action'] = 'https://unitpay.ru/pay/41421-2f8c5';
                $result['secretkey'] = '76f06cb01de51ac0225d74f07c4b9b3a';
                $result['publickey'] = '41421-2f8c5';
                $result['inv_id'] = $id['id'];
                $result['cost'] = $id['cost'];
                $result['currency'] = $id['currency'];
                $result['inv_desc'] = $id;
                //Делаем sha256 для мерчанта
                $signature = hash('sha256', $result['inv_id'] . '{up}' . $result['currency'] . '{up}' . $inv_desc . '{up}' . $result['cost'] . '{up}' . $result['secretkey']);
                $result['signature'] = $signature;
                break;
            //Под двойкой по любому робокасса
            case 2:
                $result['merchant_type'] = $static;
                $result['action'] = 'http://test.robokassa.ru/Index.aspx';
                $result['login'] = 'g-nation_test';
                $result['password1'] = 'Uw95OBWy1tw8R4thWPla';
                $result['password2'] = 'grBhpq02aXzd09if3Vnz';
                break;
        }
        return $result;
    }
}