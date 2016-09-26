<?php
include "connect.php";
class Config
{
    // Ваш секретный ключ (из настроек проекта в личном кабинете unitpay.ru )
    const SECRET_KEY = '';
    // Стоимость товара в руб.
    const ITEM_PRICE = 10;

    // Таблица начисления товара, например `users`
    const TABLE_ACCOUNT = '';
    // Название поля из таблицы начисления товара по которому производится поиск аккаунта/счета, например `email`
    const TABLE_ACCOUNT_NAME = '';
    // Название поля из таблицы начисления товара которое будет увеличено на колличево оплаченого товара, например `sum`, `donate`
    const TABLE_ACCOUNT_DONATE= '';


}