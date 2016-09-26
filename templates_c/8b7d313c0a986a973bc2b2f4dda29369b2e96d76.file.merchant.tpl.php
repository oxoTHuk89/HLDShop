<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-07-24 12:25:07
         compiled from ".\templates\merchant.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10206579497832d04d9-95769935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b7d313c0a986a973bc2b2f4dda29369b2e96d76' => 
    array (
      0 => '.\\templates\\merchant.tpl',
      1 => 1468490705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10206579497832d04d9-95769935',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MerchantForm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_57949783362566_19549517',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57949783362566_19549517')) {function content_57949783362566_19549517($_smarty_tpl) {?><div id="merchant_submit">
	<?php if (isset($_smarty_tpl->tpl_vars['MerchantForm']->value)) {?>
		<form action=<?php echo $_smarty_tpl->tpl_vars['MerchantForm']->value['action'];?>
 id="merchant">
			<input type="hidden" name="account" value="<?php echo $_smarty_tpl->tpl_vars['MerchantForm']->value['inv_id'];?>
">
			<input type="hidden" name="currency" value="<?php echo $_smarty_tpl->tpl_vars['MerchantForm']->value['currency'];?>
">
			<input type="hidden" name="sum" value="<?php echo $_smarty_tpl->tpl_vars['MerchantForm']->value['cost'];?>
">
			<input type="hidden" name="desc" value="<?php echo $_smarty_tpl->tpl_vars['MerchantForm']->value['inv_desc'];?>
">
			<input type="hidden" name="signature" value="<?php echo $_smarty_tpl->tpl_vars['MerchantForm']->value['signature'];?>
">
			<input type="submit" name="SendToMerchant" id="SendToMerchant" value="Оплатить">
		</form>
	<?php }?>
</div><?php }} ?>
