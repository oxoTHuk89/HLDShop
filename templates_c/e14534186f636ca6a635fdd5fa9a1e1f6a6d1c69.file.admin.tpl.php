<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-06-30 12:12:55
         compiled from ".\templates\admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:242555774f0a74022c2-85868164%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e14534186f636ca6a635fdd5fa9a1e1f6a6d1c69' => 
    array (
      0 => '.\\templates\\admin.tpl',
      1 => 1459353411,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '242555774f0a74022c2-85868164',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'servers' => 0,
    'server' => 0,
    'games' => 0,
    'game' => 0,
    'types' => 0,
    'type' => 0,
    'existing' => 0,
    'existing_each' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5774f0a7d0eb67_55865733',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5774f0a7d0eb67_55865733')) {function content_5774f0a7d0eb67_55865733($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>'foo'), 0);?>

<body>
<input type="button" class="open_server" value="Управление серверами"><br>
<input type="button" class="open_priv" value="Добавить новую услугу"><br>
<input type="button" class="open_priv_for_servers" value="Добавить услугу на сервер"><br>
<input type="button" class="open_relations" value="Редактировать связки сервер\услуга"><br>
<!---Добавление серверов--->
<form class="delete_server">
    <table class="table">
        <tr>
            <th colspan="2">Удалить сервер</th>
        <tr>
            <td><label for="server">Выберите сервер: </label></td>
            <td>
            <select name="server" class="server" id="server">
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
            <td class="" colspan="2">
                <input type="hidden" name="del_srv" class="del_srv" value="1">
                <input type="button" class="del_srv" value="Удалить">
            </td>
        </tr>
    </table>
</form>
<form class="create_server">
    <table class="table">
        <tr>
            <th colspan="2">Добавить сервер</th>
        <tr>
        <tr>
            <th class="">
                <label for="serverip">IP: </label>
            </th>
            <td>
                <input type="text" name="serverip" id="serverip">
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="serverpost">PORT: </label>
            </th>
            <td>
                <input type="text" name="serverpost" id="serverpost">
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="servername">Название: </label>
            </th>
            <td>
                <input type="text" name="servername" id="servername">
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="servertype">Тип: </label>
            </th>
            <td>
                <select name="servertype" id="servertype">
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
        <tr>
            <th class="">
                <label for="serverdesc">Описание: </label>
            </th>
            <td>
                <input type="text" name="serverdesc" id="serverdesc">
            </td>
        </tr>
        <tr>
            <td class="" colspan="2">
                <input type="hidden" name="add_srv" value="1">
                <input type="button" class="add_srv" value="Добавить сервер">
            </td>
        </tr>
    </table>
</form>
<!---КОНЕЦ Добавление серверов--->
<!---Добавление услуг--->
<form class="delete_type">
    <table class="table">
        <tr>
            <th colspan="2">Удалить услугу</th>
        <tr>
            <td><label for="type">Выберите сервер: </label></td>
            <td>
                <select name="type" class="type" id="type">
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
            <td class="" colspan="2">
                <input type="hidden" name="del_priv" class="del_priv" value="1">
                <input type="button" class="del_priv" value="Удалить">
            </td>
        </tr>
    </table>
</form>
<form class="create_type">
    <table class="table">
        <tr>
            <th colspan="2">Добавить услугу</th>
        <tr>
        <tr>
            <th class="">
                <label for="type">Название: </label>
            </th>
            <td>
                <input type="text" name="type" id="type">
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="flags">Флаги: </label>
            </th>
            <td>
                <input type="text" name="flags" id="flags">
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="visibility">Видимость: </label>
            </th>
            <td>
                <input type="checkbox" name="visibility" id="visibility">
            </td>
        </tr>
        <tr>
            <td class="" colspan="2">
                <input type="hidden" name="add_priv" value="1">
                <input type="button" class="add_priv" value="Добавить сервер">
            </td>
        </tr>
    </table>
</form>
<!---КОНЕЦ Добавление серверов--->
<!---Добавление услуг--->
<!---Добавление услуг к серверу--->
<form class="create_priv_for_servers">
    <table class="table">
        <tr>
            <td class="">
                <label for="serverlist">Cервер: </label>
            </td>
            <td class="">
                <select name="serverlist" id="serverlist">
                    <?php  $_smarty_tpl->tpl_vars['server'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['server']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['servers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['server']->key => $_smarty_tpl->tpl_vars['server']->value) {
$_smarty_tpl->tpl_vars['server']->_loop = true;
?>
                        <option value=<?php echo $_smarty_tpl->tpl_vars['server']->value['id'];?>
><?php echo $_smarty_tpl->tpl_vars['server']->value['servername'];?>
</option>
                    <?php } ?>
                </select>
            </td>
            <td class="">
                <label for="typelist">Услуги: </label></td>
            <td class="">
                <select name="typelist" id="typelist">
                    <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
                        <option value=<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
><?php echo $_smarty_tpl->tpl_vars['type']->value['name'];?>
</option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <label for="cost">
                    <input name="cost" type="text" class="cost">
                </label>
            </td>

            <td class="">
                <input type="hidden" name="add_priv_to_server" value="1">
                <input type="button" class="add_priv_to_server" value="Добавить услугу">
            </td>
        </tr>
    </table>
</form>
<!---Конец Добавление услуг к серверу--->
<!---Список всего, что имеется с возможностью редактирования цены и удаления--->
<form class="relations">
    <table class="table">
        <tr>
            <th class="">Cервер:</th>
            <th class="">Услуги</th>
            <th class="" colspan="2">Стоимость:</th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['existing_each'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['existing_each']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['existing']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['existing_each']->key => $_smarty_tpl->tpl_vars['existing_each']->value) {
$_smarty_tpl->tpl_vars['existing_each']->_loop = true;
?>
            <tr>
                <td class="">
                    <?php echo $_smarty_tpl->tpl_vars['existing_each']->value['server_name'];?>

                    <input type="hidden" name="server_id" class="server_id" value="<?php echo $_smarty_tpl->tpl_vars['existing_each']->value['server_id'];?>
">
                </td>
                <td class="">
                    <?php echo $_smarty_tpl->tpl_vars['existing_each']->value['type'];?>

                    <input type="hidden" name="type" class="type" value="<?php echo $_smarty_tpl->tpl_vars['existing_each']->value['type_id'];?>
">
                </td>
                <td class="">
                    <label for="cost">
                        <input type="text" name="cost" class="cost" value="<?php echo $_smarty_tpl->tpl_vars['existing_each']->value['cost'];?>
">
                    </label>
                </td>

                <td class="">
                    <input type="hidden" name="save_cost" value="1">
                    <input type="button" class="save_cost" value="Сохранить цену">
                </td>
                <td class="">
                    <input type="hidden" name="delete_relations" value="1">
                    <input type="button" class="delete_relations" value="Удалить связку">
                </td>
            </tr>
        <?php } ?>
    </table>
</form>
<!---КОНЕЦ Список всего, что имеется с возможностью редактирования цены и удаления--->
<div id="result"></div>

<?php }} ?>
