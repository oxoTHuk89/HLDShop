{if $error}
	{$error}<input type=button value="Вернуться" id="back">
{else}
<table class="" borber="1">
	<tr>
		<td class="td_r">Cервер:{$inv_id}</td>
		<td class="td_l">
			{$server_id}
		</td>
	</tr>
	<tr>
		<td class="td_r">Тип покупки:</td>
		<td class="td_l">
			{$type}
		</td>
	</tr>
	<tr>
		<td class="td_r">Ваш ник на сервере:</td>
		<td class="td_l">{$steamid}</td>
	</tr>
	<tr>
		<td class="td_r">Стоимость: </td>
		<td class="td_l">{$cost} рублей</td>
	</tr>
</table>
<!---<form id = "unban" action="http://test.robokassa.ru/Index.aspx" method="POST" autocomplete="off">--->
<form action='https://merchant.roboxchange.com/Index.aspx' method=POST>
	<input type="hidden" name="MerchantLogin" value="{$mrh_login}">
	<input type="hidden" name="OutSum" id="OutSum" value="{$cost}">
	<input type="hidden" name="InvId" value="{$inv_id}">
	<input type="hidden" name="Desc" value="{$inv_desc}">
	<input type="hidden" name="SignatureValue" value="{$crc}">
	<input type="hidden" name="shp_item" value="{$shp_item}">
	<input type="hidden" name = "Encoding" value="UTF-8">
	<input type=submit value="Оплатить">
	<input type=button value="Вернуться" id="back">
</form>
{/if}