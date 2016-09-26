{*config_load file="test.conf" section="setup"*}

<body>
{if isset($main)}
<div id="main-page">
    <div class="opener" id="open_unban">
        <p class="head">Снятие бана</p>

        <p class="body">Здесь можно легко снять бан, не ожидая рассмотрения, либо если действительно были читы.</p>
    </div>
    <div class="opener" id="open_zakyp">
        <p class="head">Админка, VIP, и все остальные услуги</p>

        <p class="body">Если Вы первый раз приобретаете услуги на наших серверах, Вам сюда. Здесь Вы можете выбрать
            сервер и
            услугу.</p>
    </div>
    <div class="opener" id="open_extension">
        <p class="head">Продление. Если Вы ранее пользовались нашими услугами.</p>

        <p class="body">Если Вы уже покупали у нас что-либо, в этом разделе Вы можете продлить или возобновить
            услугу.</p>
    </div>
    {*<div class="opener" id="open_tags">
        <p class="head">Звания.</p>
        <p class="body">Покупка звания разрешает Вам купить любое звание, на Ваш вкус. Отображаться это будет в виде приставки тега в чате, подрабности внутри.</p>
    </div>*}
    <form class="unban">
        <table class="table">
            <tr>
                <td>
                    <input type="hidden" value="{$titles.unban}" id="title">
                    <label for="servers">Выберите сервер: </label>
                    <select id="servers" name="servers" class="select">
                        <option value="">Выберите сервер</option>
                        {foreach $servers as $server}
                            <option game="{$server.type}" value="{$server.id}">{$server.servername}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="username">Введите ник: </label>
                    <input class="input_text" name="username" required type="text" id="username" size="45">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" class="submit" id="find_username" value="Найти">
                </td>
            </tr>
        </table>
    </form>

    <div class="zakyp">
        <input type="hidden" value={$titles.shop} id="title">
        <table class="table">
            <tr>
                <td class="">
                    <label for="servers">Выберите сервер:</label>
                </td>
                <td class="">
                    <select id="servers" name="servers" class="select">
                        <option value="">Выберите сервер</option>
                        {foreach $servers as $server}
                            <option value="{$server.id}">{$server.servername}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <td class="">
                    <label for="types">Выберите тип покупки: </label>
                </td>
                <td class="">
                    <select id="types" name="types" class="select">
                        <option value="">Выберите тип</option>
                        {foreach $types as $type}
                            <option value="{$type.id}">{$type.name}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <td class="">
                    <label for="username">Ваш ник на сервере: </label>
                </td>
                <td class="">
                    <input type="text" autocomplete="off" class="username" id="username" name="username">
                </td>
            </tr>
            <tr id="steamid">
                <td class="">
                    <label for="steamid_val">STEAMID: </label>
                </td>
                <td class="">
                    <input type="text" placeholder="STEAM_1:0:12345678" autocomplete="off" class="steamid_val" required
                           id="steamid_val" name="steamid_val">
                </td>
            </tr>
            <tr id="">
                <td class="">
                    <label for="password">Желаемый пароль: </label>
                </td>
                <td class=""><input type="password" class="password" required id="password" name="password">
                </td>
            </tr>
            <tr id="">
                <td class="">
                    <label for="days">Срок: </label>
                </td>
                <td class="">
                    <select id="days" name="days" class="select">
                        <option value="">Количество дней</option>
                        <option value="1">30</option>
                        <option value="2">60</option>
                        <option value="3">90</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="">
                    <label for="currency">Валюта: </label>
                </td>
                <td class="">
                    <select id="currency" name="currency" class="select">
                        <option value="RUB">Рубли</option>
                        <option value="UAH">Гривны</option>
                    </select>
                </td>
            </tr>
            <tr class="tr_vk">
                <td>
                    <label for="currency">Ссылка на профиль ВКонтакте: </label>
                </td>
                <td class="td_l">
                    <input type="button" id="vk_auth" class="submit" value="ВК авторизация">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="td_submit">
                    <input type="hidden" value={$titles.shop} id="title">
                    <input type="hidden" name="date" id="date" value="{$date}">
                    <input type="hidden" id="vk_auth_hidden" class="submit" value="">
                    <input type="button" id="accept" class="submit" value="Подтвердить выбор">
                </td>
            </tr>
        </table>
    </div>

    <div class="extension">
        <input type="hidden" value={$titles.extension} id="title">
        <table class="table">
            <tr>
                <td class="td_r">
                    <label for="games">Выберите игру: </label>
                </td>
                <td class="td_l">
                    <!---<select id="server_id" name="server_id" class="select">
                    <option value="">Выберите сервер</option>
                </select>--->
                    <select id="games" name="games" class="select">
                        <option value="">Выберите игру</option>
                        {foreach $games as $game}
                            <option value="{$game.id}">{$game.fullname}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
            <tr id="tr_pass">
                <td class="td_r">
                    <label for="username">Никнейм на сервере: </label>
                </td>
                <td class="td_l">
                    <input class="input_text" type="text" id="username" size="15"></td>
            </tr>
            <tr id="tr_pass">
                <td class="td_r">
                    <label for="password">Пароль: </label>
                </td>
                <td class="td_l">
                    <input class="input_text" type="password" id="password">
                </td>
            </tr>
            <tr>
                <td class="">
                    <label for="currency">Валюта: </label>
                </td>
                <td class="">
                    <select id="currency" name="currency" class="select">
                        <option value="RUB">Рубли</option>
                        <option value="UAH">Гривны</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="td_submit">
                    <input type="button" class="submit" id="username_check" value="Подтвердить выбор">
                </td>
            </tr>
        </table>
        <input type="hidden" name="date" value="{$date}">

        <div id="username_ressult"></div>
    </div>

    {/if}
    {if isset($accept) == 1 && !isset($error1)}
        <table class="table">
            <tr>
                <th class="">Сервер:</th>
                <td class="">{$servername}</td>
            </tr>
            <tr>
                <th class="">Услуга:</th>
                <td class="">{$typename}</td>
            </tr>
            <tr>
                <th class="">Никнейм:</th>
                <td class="">{$username}</td>
            </tr>
            <tr>
                <th class="">Стоимость:</th>
                <td class="">{$cost} (в рублях)</td>
            </tr>
        </table>
    {/if}

    {if isset($find_username) == 1 && !isset($error)}
    <table class="table" id="search_steam">
        <tr>
            <th>Ник</th>
            <th>Причина</th>
            <th>Дата</th>
        </tr>
        {foreach $result as $banlist}
            <tr class="for_select" id="unban_reslut">
                <td>{$banlist.player_nick} </td>
                <td>{$banlist.reason} </td>
                <td>{$banlist.ban_created|date_format:'%d.%m.%Y, %R'} </td>
            </tr>
        {/foreach}
    </table>
    {*
    {elseif isset($error)}
    <table class="table">
        <tr>
            <td class="td">Запрос вернул пустой результат</td>
        </tr>
    </table>
    *}
</div>
{/if}


{if isset($username_check)}
    <div id="result-page">
        {if isset($error)}
            <div class="alert alert-danger">
                {$error_message}
            </div>
        {elseif isset($priv_lists)}
            {foreach $result as $priv_list}
                {if isset($priv_list.custom_flags) && $priv_list.custom_flags != ""}
                    {$cost = $priv_list.custom_cost }
                {else}
                    {$cost = $priv_list.cost}
                {/if}
                <form class="extension_res">
                    <script>
                        $(function () {
                            $(".accordion").accordion({
                                collapsible: true,
                                active: false
                            });
                        });
                    </script>
                    <div class="accordion">
                        <h3>{$priv_list.hostname}</h3>
                        <div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Никнейм:</th>
                                    <td>{$priv_list.login}</td>
                                </tr>
                                <tr>
                                    <th>Услуга:</th>
                                    <td>{$priv_list.typename}</td>
                                </tr>
                                <tr>
                                    <th>Истекает:</th>
                                    <td>{if $priv_list.expired == 0}Никогда {else} {$priv_list.expired|date_format:'%d.%m.%Y, %R'}{/if} </td>
                                </tr>
                                <tr>
                                    <th>Стоимость:</th>
                                    <td>{$cost}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                        {*$priv_list|@debug_print_var*}
                                        <input type="hidden" class="admin_id" name="admin_id"
                                               value={$priv_list.admin_id}>
                                        <input type="hidden" class="shop_srv_id" name="shop_srv_id"
                                               value={$priv_list.shop_srv_id}>
                                        <input type="hidden" class="pay_type" name="pay_type"
                                               value={$priv_list.pay_type}>
                                        <input type="hidden" class="cost" name="cost" value={$cost}>
                                        <input type="hidden" class="game " name="game " value={$priv_list.game}>
                                        <input type="hidden" class="currency" name="currency "
                                               value={$priv_list.currency}>
                                        <input type="button" class="extension_check" value="Выбрать">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>


                </form>
            {/foreach}

        {/if}
        {elseif isset($error_username_check)}
        <table class="table" borber="1">
            <tr>
                <td class="td_r">{$error_username_check}</td>
            </tr>
            <tr>
                <td><input type=button value="Вернуться" id="back"></td>
            </tr>
        </table>
    </div>
{/if}

{*
{if isset($merchant_type ) && $merchant_type == 2}
    <input type="hidden" name="MerchantLogin" value="{$mrh_login}">
    <input type="hidden" name="OutSum" id="OutSum" value="{$cost}">
    <input type="hidden" name="InvId" value="{$inv_id}">
    <input type="hidden" name="Desc" value="{$inv_desc}">
    <input type="hidden" name="SignatureValue" value="{$crc}">
    <input type="hidden" name="shp_item" value="{$shp_item}">
    <input type="hidden" name="Encoding" value="UTF-8">
    <input type=submit value="Оплатить">
    <input type=button value="Вернуться" id="back">
{elseif isset($merchant_name) && $merchant_name ==2}
    <form action="https://merchant.webmoney.ru/lmi/payment.asp?at=authtype_16" method="POST">
        <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{$cost}">
        <input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="0YLQtdGB0YLQvtCy0YvQuSDRgtC+0LLQsNGA">
        <input type="hidden" name="LMI_PAYEE_PURSE" value="R934708249956">
        <input type="hidden" name="LMI_PAYMENT_NO" value="{$inv_id}">
        <input type="submit" class="wmbtn" value=" {$cost} WMU ">
        <input type=button value="Вернуться" id="back">
    </form>
{/if}
{if isset($merchant_type) && $merchant_type == 1}
    <form action={$action} id="merchant">
        <input type="hidden" name="account" value="{$inv_id}">
        <input type="hidden" name="currency" value="{$currency}">
        <input type="hidden" name="sum" value="{$cost}">
        <input type="hidden" name="desc" value="{$inv_desc}">
        <input type="hidden" name="signature" value="{$signature}">
        <input class="td_submit" type="submit" value="Оплатить">
    </form>
{/if}
*}
{*
<div id="merchnt_submit">
    {if isset($MerchantForm)}
        <form action={$MerchantForm.action} id="merchant">
            <input type="hidden" name="account" value="{$MerchantForm.inv_id}">
            <input type="hidden" name="currency" value="{$MerchantForm.currency}">
            <input type="hidden" name="sum" value="{$MerchantForm.cost}">
            <input type="hidden" name="desc" value="{$MerchantForm.inv_desc}">
            <input type="hidden" name="signature" value="{$MerchantForm.signature}">
        </form>
    {/if}
</div>
*}
<div id="unban_reslut"></div>
{include file="footer.tpl"}
{literal}
    <script language="javascript">

    </script>
{/literal}
