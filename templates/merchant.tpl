<div id="merchant_submit">
	{if isset($MerchantForm)}
		<form action={$MerchantForm.action} id="merchant">
			<input type="hidden" name="account" value="{$MerchantForm.inv_id}">
			<input type="hidden" name="currency" value="{$MerchantForm.currency}">
			<input type="hidden" name="sum" value="{$MerchantForm.cost}">
			<input type="hidden" name="desc" value="{$MerchantForm.inv_desc}">
			<input type="hidden" name="signature" value="{$MerchantForm.signature}">
			<input type="submit" name="SendToMerchant" id="SendToMerchant" value="Оплатить">
		</form>
	{/if}
</div>