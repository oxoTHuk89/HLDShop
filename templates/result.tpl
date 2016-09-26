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
{/if}

{if isset($username_check)}
    <div id="result-page">
        {if isset($priv_lists)}
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

{*include file="merchant.tpl"
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
{elseif isset($merchant_type) && $merchant_type == 1}
    <input type="hidden" name="account" value="{$inv_id}">
    <input type="hidden" name="currency" value="{$currency}">
    <input type="hidden" name="sum" value="{$cost}">
    <input type="hidden" name="desc" value="{$inv_desc}">
    <input type="hidden" name="sign" value="{$crc}">
    <input class="td_submit" type="submit" value="Оплатить">
{/if}
*}