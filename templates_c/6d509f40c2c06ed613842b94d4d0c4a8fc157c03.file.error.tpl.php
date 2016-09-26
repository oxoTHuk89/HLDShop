<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-07-01 17:06:44
         compiled from ".\templates\error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131685763e756314a41-23770258%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d509f40c2c06ed613842b94d4d0c4a8fc157c03' => 
    array (
      0 => '.\\templates\\error.tpl',
      1 => 1467385589,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131685763e756314a41-23770258',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5763e75640ea75_60394101',
  'variables' => 
  array (
    'error_message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5763e75640ea75_60394101')) {function content_5763e75640ea75_60394101($_smarty_tpl) {?><div id="error">
    <?php if (isset($_smarty_tpl->tpl_vars['error_message']->value)) {?>
        <div class="alert alert-danger">
            <?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>

        </div>
    <?php }?>
</div><?php }} ?>
