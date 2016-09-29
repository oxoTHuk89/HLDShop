<?php
/**
 * Created by PhpStorm.
 * User: sergey.burikov
 * Date: 25.01.2016
 * Time: 10:50
 */
require_once(DOCUMENT_ROOT . "/connect.php");

class Merchant
{
    /**
     * @param PDO $merchant Номер мерчанта, который использовать
     * @param array $dynamic Динамические данные, приходящие из классов
     * @param array $inv_desc Описание услуги. Будет отображаться на странице подтверждения
     * @return array
     */
    public function getFrom($merchant, $dynamic, $inv_desc)
    {
        switch ($merchant) {
            //Под еденичкой по любому UnitPay
            case 1:
                //Все необходимые данные для Unitpay
                $result['merchant_type'] = $merchant; //Передаем, чтобы Smarty понял, что это Unitpay
                $result['action'] = 'https://unitpay.ru/pay/41421-2f8c5';
                $result['secretkey'] = '76f06cb01de51ac0225d74f07c4b9b3a';
                $result['publickey'] = '41421-2f8c5';
                $result['inv_id'] = $dynamic['id'];
                $result['cost'] = $dynamic['cost'];
                $result['currency'] = $dynamic['currency'];
                $result['inv_desc'] = $inv_desc;
                //Делаем sha256 для мерчанта
                $signature = hash('sha256', $result['inv_id'] . '{up}' . $result['currency'] . '{up}' . $inv_desc . '{up}' . $result['cost'] . '{up}' . $result['secretkey']);
                $result['signature'] = $signature;
                break;
            //Под двойкой по любому робокасса
            case 2:
                $result['merchant_type'] = $merchant;
                $result['action'] = 'https://auth.robokassa.ru/Merchant/Index.aspx';
                $result['login'] = 'gm_new';
                $result['password1'] = 'php.ru753';
                //$result['password1'] = 'Uw95OBWy1tw8R4thWPla';
                $result['password2'] = 'gfteam.ru753';
                //$result['password2'] = 'grBhpq02aXzd09if3Vnz';
                $result['inv_id'] = (int)$dynamic['id'];
                $result['cost'] = $dynamic['cost'];
                $result['inv_desc'] = $inv_desc;
                $result['signature'] = md5($result['login'].":".$result['cost'].":".$result['inv_id'].":".$result['password1']);
                break;
        }
        return $result;
    }
}