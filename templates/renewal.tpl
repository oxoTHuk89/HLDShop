{if !$login_incorrect}
<tr>
	<td class="td_r">Текущий статус:</td>
	<td class="td_l">{$type_name}    {$type}</td>
</tr>
<tr>
	<td class="td_r">Истекает через:</td>
	<td class="td_l" id="timeleft">{$timeleft}</td>
</tr>
<tr>
	<td>
	<!---<form id = "unban" action="http://test.robokassa.ru/Index.aspx" method="POST" autocomplete="off">--->
	<form action='https://merchant.roboxchange.com/Index.aspx' method=POST>
		<input type="hidden" name="MerchantLogin" value="{$mrh_login}">
		<input type="hidden" name="OutSum" id="OutSum" value="{$cost}">
		<input type="hidden" name="InvId" value="{$inv_id}">
		<input type="hidden" name="Desc" value="{$inv_desc}">
		<input type="hidden" name="SignatureValue" value="{$crc}">
		<input type="hidden" name="Shp_item" value="{$Shp_item}">
		<input type="hidden" name = "Encoding" value="UTF-8">
		<input type=submit value="Оплатить">
	</form>
	</td>
</tr>
{/if}
{$login_incorrect}
