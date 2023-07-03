<?php if($Items):?>
<ul id="providerList" class="provider-list">
    <?php foreach($Items as $row):?>
        <?php if($Lookup):?>
            <?php if($Lookup['0']['ProviderCode'] == $row['ProviderCode']):?>
                <li class="provider col-lg-4 active" data-provider="<?php echo $row['ProviderCode'];?>">
            <?php else:?>
                <li class="provider col-lg-4" data-provider="<?php echo $row['ProviderCode'];?>">
            <?php endif;?>
        <?php else:?>
            <li class="provider col-lg-4" data-provider="<?php echo $row['ProviderCode'];?>">
        <?php endif;?>
            <a href="#" data-toggle="tab" role="tab">
                <div class="panel panel-default">
                    <div class="logo">
                        <span style="background: url('<?php echo $row['LogoUrl'];?>');background-size: contain;" class="imr-md-operator"></span>
                    </div>
                    <div class="title"><?php echo $row['Name'];?></div>
                </div>
            </a>
        </li>
    <?php endforeach;?>
</ul>
<?php else:?>
    <span>Operators are not available. You may have a low balance or the country is not supported.</span>
<?php endif;?>

<script>

$('#providerList > li.provider').click( function(){
    var providerCode = $(this).data('provider');
    $('.ding-confirm').prop('hidden', true);
    
    $.ajax({
        url: "/buy_load/fetch_ding_plan_codes",
        method: "POST",
        data: { 
            provider_code : providerCode
        },
        beforeSend: function() {
            $('.ding-amount-content').html('<center>Checking available amount...</center>');
        },
        success: function (response) { 
            $('.ding-provider').prop('hidden', null);
            $('.ding-product').prop('hidden', null);
            $('.ding-amount').prop('hidden', null);
            $('.ding-amount-content').html(response);
            $('.topup-amount').prop('hidden',null);
            
        },
        error: function () {
        },
    });
});
</script>
