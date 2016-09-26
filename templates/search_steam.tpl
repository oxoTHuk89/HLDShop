<script type='text/javascript'>
$("#search_steam .for_select").click(function(){		
	$.ajax({
		type:"POST",
		url:"ajax.php",
		data: "unban_id="+$(this).attr("id")+"&player_nick="+$("#player_nick").text()+"&cost_unban="+$("#cost_unban").text()+"&unban=1",
		success:function(result) {
			$("#status").html(result);
			console.log(result);
		}
	});		
});
$( "#search_steam .for_select" ).mouseover(function() {
  $( this ).css( "background-color", "rgb(176, 178, 178);" );
});
$( "#search_steam .for_select" ).mouseout(function() {
  $( this ).css( "background-color", "#FFF;" );
});
$("#unban").submit();

</script>
{if $success == 0 || $success == ""}
<div id="search_steam">
	<table>
		<tr><td>Не найден никнейм</td></tr>			
	</table>
</div>
{else}
<div id="search_steam">
<table border=2>
	<tr>
		<th>Стоимость</th>
		<th>Ник</th>
		<th>Админ</th>	
		<th>Причина</th>	
		<th>Время</th>		
	</tr>
	{section name=customer loop=$player_nick}
	<tr class = "for_select" id = "{$bid[customer]}">
		<td id = "cost_unban">200</td>
		<td id = "player_nick">{$player_nick[customer]}</td>
		<td id = "admin_nick">{$admin_nick[customer]}</td>
		<td id = "ban_reason">{$ban_reason[customer]}</td>
		<td id = "ban_created">{$ban_created[customer]}</td>
	</tr>
	{/section}
	</table>
</div>
<form id = "unban" action="http://test.robokassa.ru/Index.aspx" method="POST" autocomplete="off">
<!---<form id = "unban"  action='https://merchant.roboxchange.com/Index.aspx' method=POST>--->
	<input type="hidden" name="MerchantLogin" value="{$mrh_login}">
	<input type="hidden" name="OutSum" id="OutSum" value="{$cost}">
	<input type="hidden" name="InvId" value="{$inv_id}">
	<input type="hidden" name="Desc" value="{$inv_desc}">
	<input type="hidden" name="SignatureValue" value="{$crc}">
	<input type="hidden" name="Shp_item" value="{$Shp_item}">
	<input type="hidden" name = "Encoding" value="UTF-8">
	<input type=submit value="Оплатить">
</form>
{/if}

