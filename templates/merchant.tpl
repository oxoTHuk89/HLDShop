<div id="merchant_submit">
    {if isset($MerchantForm)}
        {*<form action={$MerchantForm.action} id="merchant">*}
        {*<form action="result.php" id="merchant">*}
        <form action="result.php" id="merchant">
            {if $MerchantForm.merchant_type == 1}
                <input type="hidden" name="account" value="{$MerchantForm.inv_id}">
                <input type="hidden" name="currency" value="{$MerchantForm.currency}">
                <input type="hidden" name="sum" value="{$MerchantForm.cost}">
                <input type="hidden" name="desc" value="{$MerchantForm.inv_desc}">
                <input type="hidden" name="signature" value="{$MerchantForm.signature}">
            {/if}
            {if $MerchantForm.merchant_type == 2}
                <input type="hidden" name="MrchLogin" value="{$MerchantForm.login}">
                <input type="hidden" name="OutSum" value="{$MerchantForm.cost}">
                <input type="hidden" name="InvId" value="{$MerchantForm.inv_id}">
                <input type="hidden" name="OutSumCurrency" value="{*$MerchantForm.currency*}">
                <input type="hidden" name="Desc" value="{$MerchantForm.inv_desc}">
                <input type="hidden" name="SignatureValue" value="{$MerchantForm.signature}">
                <input type="hidden" name="IsTest" value="0">
            {/if}
            <input type="submit" name="SendToMerchant" id="SendToMerchant" value="Оплатить">
        </form>
    {/if}
</div>