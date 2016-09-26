<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-07-14 12:05:19
         compiled from ".\templates\merchant.tpl" */ ?>
<?php /*%%SmartyHeaderCode:198125763db71cdc0c3-92798130%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2fbbeb48f6b0533509d47dc2ef65607529e7dd8' => 
    array (
      0 => '.\\templates\\merchant.tpl',
      1 => 1468490705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198125763db71cdc0c3-92798130',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5763db72031e66_33388671',
  'variables' => 
  array (
    'MerchantForm' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5763db72031e66_33388671')) {function content_5763db72031e66_33388671($_smarty_tpl) {?><div id="merchant_submit">
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
