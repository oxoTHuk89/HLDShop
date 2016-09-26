<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-07-24 12:24:55
         compiled from ".\templates\body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2698571fa70cdf3508-77615079%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7e76000a1cf3c9458f5b2c526bb3ab4587868e5' => 
    array (
      0 => '.\\templates\\body.tpl',
      1 => 1467709220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2698571fa70cdf3508-77615079',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_571fa70cf0c947_90923219',
  'variables' => 
  array (
    'main' => 0,
    'titles' => 0,
    'servers' => 0,
    'server' => 0,
    'types' => 0,
    'type' => 0,
    'date' => 0,
    'games' => 0,
    'game' => 0,
    'accept' => 0,
    'error1' => 0,
    'servername' => 0,
    'typename' => 0,
    'username' => 0,
    'cost' => 0,
    'find_username' => 0,
    'error' => 0,
    'result' => 0,
    'banlist' => 0,
    'username_check' => 0,
    'error_message' => 0,
    'priv_lists' => 0,
    'priv_list' => 0,
    'error_username_check' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571fa70cf0c947_90923219')) {function content_571fa70cf0c947_90923219($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\programs\\Git\\repo\\shop_new\\smarty\\plugins\\modifier.date_format.php';
?>

<body>
<?php if (isset($_smarty_tpl->tpl_vars['main']->value)) {?>
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
    
    <form class="unban">
        <table class="table">
            <tr>
                <td>
                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['titles']->value['unban'];?>
" id="title">
                    <label for="servers">Выберите сервер: </label>
                    <select id="servers" name="servers" class="select">
                        <option value="">Выберите сервер</option>
                        <?php  $_smarty_tpl->tpl_vars['server'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['server']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['servers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['server']->key => $_smarty_tpl->tpl_vars['server']->value) {
$_smarty_tpl->tpl_vars['server']->_loop = true;
?>
                            <option game="<?php echo $_smarty_tpl->tpl_vars['server']->value['type'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['server']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['server']->value['servername'];?>
</option>
                        <?php } ?>
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
        <input type="hidden" value=<?php echo $_smarty_tpl->tpl_vars['titles']->value['shop'];?>
 id="title">
        <table class="table">
            <tr>
                <td class="">
                    <label for="servers">Выберите сервер:</label>
                </td>
                <td class="">
                    <select id="servers" name="servers" class="select">
                        <option value="">Выберите сервер</option>
                        <?php  $_smarty_tpl->tpl_vars['server'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['server']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['servers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['server']->key => $_smarty_tpl->tpl_vars['server']->value) {
$_smarty_tpl->tpl_vars['server']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['server']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['server']->value['servername'];?>
</option>
                        <?php } ?>
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
                        <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['type']->value['name'];?>
</option>
                        <?php } ?>
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
                    <input type="hidden" value=<?php echo $_smarty_tpl->tpl_vars['titles']->value['shop'];?>
 id="title">
                    <input type="hidden" name="date" id="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
">
                    <input type="hidden" id="vk_auth_hidden" class="submit" value="">
                    <input type="button" id="accept" class="submit" value="Подтвердить выбор">
                </td>
            </tr>
        </table>
    </div>

    <div class="extension">
        <input type="hidden" value=<?php echo $_smarty_tpl->tpl_vars['titles']->value['extension'];?>
 id="title">
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
                        <?php  $_smarty_tpl->tpl_vars['game'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['game']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['games']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['game']->key => $_smarty_tpl->tpl_vars['game']->value) {
$_smarty_tpl->tpl_vars['game']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['game']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['game']->value['fullname'];?>
</option>
                        <?php } ?>
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
        <input type="hidden" name="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
">

        <div id="username_ressult"></div>
    </div>

    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['accept']->value)==1&&!isset($_smarty_tpl->tpl_vars['error1']->value)) {?>
        <table class="table">
            <tr>
                <th class="">Сервер:</th>
                <td class=""><?php echo $_smarty_tpl->tpl_vars['servername']->value;?>
</td>
            </tr>
            <tr>
                <th class="">Услуга:</th>
                <td class=""><?php echo $_smarty_tpl->tpl_vars['typename']->value;?>
</td>
            </tr>
            <tr>
                <th class="">Никнейм:</th>
                <td class=""><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</td>
            </tr>
            <tr>
                <th class="">Стоимость:</th>
                <td class=""><?php echo $_smarty_tpl->tpl_vars['cost']->value;?>
 (в рублях)</td>
            </tr>
        </table>
    <?php }?>

    <?php if (isset($_smarty_tpl->tpl_vars['find_username']->value)==1&&!isset($_smarty_tpl->tpl_vars['error']->value)) {?>
    <table class="table" id="search_steam">
        <tr>
            <th>Ник</th>
            <th>Причина</th>
            <th>Дата</th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['banlist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['banlist']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banlist']->key => $_smarty_tpl->tpl_vars['banlist']->value) {
$_smarty_tpl->tpl_vars['banlist']->_loop = true;
?>
            <tr class="for_select" id="unban_reslut">
                <td><?php echo $_smarty_tpl->tpl_vars['banlist']->value['player_nick'];?>
 </td>
                <td><?php echo $_smarty_tpl->tpl_vars['banlist']->value['reason'];?>
 </td>
                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['banlist']->value['ban_created'],'%d.%m.%Y, %R');?>
 </td>
            </tr>
        <?php } ?>
    </table>
    
</div>
<?php }?>


<?php if (isset($_smarty_tpl->tpl_vars['username_check']->value)) {?>
    <div id="result-page">
        <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
            <div class="alert alert-danger">
                <?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>

            </div>
        <?php } elseif (isset($_smarty_tpl->tpl_vars['priv_lists']->value)) {?>
            <?php  $_smarty_tpl->tpl_vars['priv_list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['priv_list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['priv_list']->key => $_smarty_tpl->tpl_vars['priv_list']->value) {
$_smarty_tpl->tpl_vars['priv_list']->_loop = true;
?>
                <?php if (isset($_smarty_tpl->tpl_vars['priv_list']->value['custom_flags'])&&$_smarty_tpl->tpl_vars['priv_list']->value['custom_flags']!='') {?>
                    <?php $_smarty_tpl->tpl_vars['cost'] = new Smarty_variable($_smarty_tpl->tpl_vars['priv_list']->value['custom_cost'], null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars['cost'] = new Smarty_variable($_smarty_tpl->tpl_vars['priv_list']->value['cost'], null, 0);?>
                <?php }?>
                <form class="extension_res">
                    <?php echo '<script'; ?>
>
                        $(function () {
                            $(".accordion").accordion({
                                collapsible: true,
                                active: false
                            });
                        });
                    <?php echo '</script'; ?>
>
                    <div class="accordion">
                        <h3><?php echo $_smarty_tpl->tpl_vars['priv_list']->value['hostname'];?>
</h3>
                        <div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Никнейм:</th>
                                    <td><?php echo $_smarty_tpl->tpl_vars['priv_list']->value['login'];?>
</td>
                                </tr>
                                <tr>
                                    <th>Услуга:</th>
                                    <td><?php echo $_smarty_tpl->tpl_vars['priv_list']->value['typename'];?>
</td>
                                </tr>
                                <tr>
                                    <th>Истекает:</th>
                                    <td><?php if ($_smarty_tpl->tpl_vars['priv_list']->value['expired']==0) {?>Никогда <?php } else { ?> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['priv_list']->value['expired'],'%d.%m.%Y, %R');
}?> </td>
                                </tr>
                                <tr>
                                    <th>Стоимость:</th>
                                    <td><?php echo $_smarty_tpl->tpl_vars['cost']->value;?>
</td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                        
                                        <input type="hidden" class="admin_id" name="admin_id"
                                               value=<?php echo $_smarty_tpl->tpl_vars['priv_list']->value['admin_id'];?>
>
                                        <input type="hidden" class="shop_srv_id" name="shop_srv_id"
                                               value=<?php echo $_smarty_tpl->tpl_vars['priv_list']->value['shop_srv_id'];?>
>
                                        <input type="hidden" class="pay_type" name="pay_type"
                                               value=<?php echo $_smarty_tpl->tpl_vars['priv_list']->value['pay_type'];?>
>
                                        <input type="hidden" class="cost" name="cost" value=<?php echo $_smarty_tpl->tpl_vars['cost']->value;?>
>
                                        <input type="hidden" class="game " name="game " value=<?php echo $_smarty_tpl->tpl_vars['priv_list']->value['game'];?>
>
                                        <input type="hidden" class="currency" name="currency "
                                               value=<?php echo $_smarty_tpl->tpl_vars['priv_list']->value['currency'];?>
>
                                        <input type="button" class="extension_check" value="Выбрать">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>


                </form>
            <?php } ?>

        <?php }?>
        <?php } elseif (isset($_smarty_tpl->tpl_vars['error_username_check']->value)) {?>
        <table class="table" borber="1">
            <tr>
                <td class="td_r"><?php echo $_smarty_tpl->tpl_vars['error_username_check']->value;?>
</td>
            </tr>
            <tr>
                <td><input type=button value="Вернуться" id="back"></td>
            </tr>
        </table>
    </div>
<?php }?>



<div id="unban_reslut"></div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


    <?php echo '<script'; ?>
 language="javascript">

    <?php echo '</script'; ?>
>

<?php }} ?>
