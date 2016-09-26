<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-07-05 11:04:51
         compiled from ".\templates\result.tpl" */ ?>
<?php /*%%SmartyHeaderCode:244615763d5f4d24dc6-59926058%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f0c89c3336bb296be7f15e82f028e0a4729d669' => 
    array (
      0 => '.\\templates\\result.tpl',
      1 => 1467709339,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '244615763d5f4d24dc6-59926058',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5763d5f601d2e6_39249759',
  'variables' => 
  array (
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
    'priv_lists' => 0,
    'priv_list' => 0,
    'error_username_check' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5763d5f601d2e6_39249759')) {function content_5763d5f601d2e6_39249759($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\Xampp\\dev.soglasie.ru\\shop_test\\smarty\\plugins\\modifier.date_format.php';
?><?php if (isset($_smarty_tpl->tpl_vars['accept']->value)==1&&!isset($_smarty_tpl->tpl_vars['error1']->value)) {?>
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
    
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['username_check']->value)) {?>
    <div id="result-page">
        <?php if (isset($_smarty_tpl->tpl_vars['priv_lists']->value)) {?>
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

<?php }} ?>
