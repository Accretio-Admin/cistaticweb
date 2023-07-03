<?php if($Topup || $Data || $Bundle):?>
<div id="topupAmount-content">
    <ul id="amountList" class="amount-list">
        <?php foreach($Topup as $row):?>
            <li class="amount col-lg-4 topup-amount" hidden>
                <a href="#" data-toggle="tab" role="tab">
                    <div class="panel panel-default">
                        <div class="data" data-type="Top-Up" data-skucode="<?php echo $row['SkuCode'];?>">
                            <div class="price" data-receivecurr="<?php echo $row['Maximum']['ReceiveCurrencyIso'];?>" data-sendcurr="<?php echo $row['Maximum']['SendCurrencyIso'];?>" data-receive="<?php echo $row['Maximum']['ReceiveValue'];?>" data-send="<?php echo $row['Maximum']['SendValue'];?>"><strong><?php echo $row['Maximum']['SendCurrencyIso'];?> <?php echo $row['Maximum']['SendValue'];?></strong></div>
                            <div class="receive-amount"><strong><?php echo $row['DefaultDisplayText'];?></strong> will be received</div>
                            <?php if($row['ValidityPeriodIso']):?>
                            <?php switch($row['ValidityPeriodIso']){
                                case 'P1D': echo '<div class="validity-period">Valid for <span>1 Day</span></div>';
                                break;
                                case 'P3D': echo '<div class="validity-period">Valid for <span>3 Days</span></div>';
                                break;
                                case 'P7D': echo '<div class="validity-period">Valid for <span>7 Days</span></div>';
                                break;
                                case 'P15D': echo '<div class="validity-period">Valid for <span>15 Days</span></div>';
                                break;
                                case 'P30D': echo '<div class="validity-period">Valid for <span>30 Days</span></div>';
                                break;
                                case 'P365D': echo '<div class="validity-period">Valid for <span>1 Year</span></div>';
                                break;
                                default: echo '';
                            }?>
                            <?php endif;?>
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach;?>
        <?php foreach($Data as $row):?>
            <li class="amount col-lg-4 data-amount" hidden>
                <a href="#" data-toggle="tab" role="tab">
                    <div class="panel panel-default">
                        <div class="data" data-type="Data" data-skucode="<?php echo $row['SkuCode'];?>">
                            <div class="price" data-receivecurr="<?php echo $row['Maximum']['ReceiveCurrencyIso'];?>" data-sendcurr="<?php echo $row['Maximum']['SendCurrencyIso'];?>" data-receive="<?php echo $row['Maximum']['ReceiveValue'];?>" data-send="<?php echo $row['Maximum']['SendValue'];?>"><strong><?php echo $row['Maximum']['SendCurrencyIso'];?> <?php echo $row['Maximum']['SendValue'];?></strong></div>
                            <div class="receive-amount"><strong><?php echo $row['DefaultDisplayText'];?></strong> will be receive</div>
                            <?php if($row['ValidityPeriodIso']):?>
                            <?php switch($row['ValidityPeriodIso']){
                                case 'P1D': echo '<div class="validity-period">Valid for <span>1 Day</span></div>';
                                break;
                                case 'P3D': echo '<div class="validity-period">Valid for <span>3 Days</span></div>';
                                break;
                                case 'P7D': echo '<div class="validity-period">Valid for <span>7 Days</span></div>';
                                break;
                                case 'P15D': echo '<div class="validity-period">Valid for <span>15 Days</span></div>';
                                break;
                                case 'P30D': echo '<div class="validity-period">Valid for <span>30 Days</span></div>';
                                break;
                                case 'P365D': echo '<div class="validity-period">Valid for <span>1 Year</span></div>';
                                break;
                                default: echo '';
                            }?>
                            <?php endif;?>
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach;?>
        <?php foreach($Bundle as $row):?>
            <li class="amount col-lg-4 bundle-amount" hidden>
                <a href="#" data-toggle="tab" role="tab">
                    <div class="panel panel-default">
                        <div class="data" data-type="Bundle" data-skucode="<?php echo $row['SkuCode'];?>">
                            <div class="price" data-receivecurr="<?php echo $row['Maximum']['ReceiveCurrencyIso'];?>" data-sendcurr="<?php echo $row['Maximum']['SendCurrencyIso'];?>" data-receive="<?php echo $row['Maximum']['ReceiveValue'];?>" data-send="<?php echo $row['Maximum']['SendValue'];?>"><strong><?php echo $row['Maximum']['SendCurrencyIso'];?> <?php echo $row['Maximum']['SendValue'];?></strong></div>
                            <div class="receive-amount"><strong><?php echo $row['DefaultDisplayText'];?></strong> will be received</div>
                            <?php if($row['ValidityPeriodIso']):?>
                            <?php switch($row['ValidityPeriodIso']){
                                case 'P1D': echo '<div class="validity-period">Valid for <span>1 Day</span></div>';
                                break;
                                case 'P3D': echo '<div class="validity-period">Valid for <span>3 Days</span></div>';
                                break;
                                case 'P7D': echo '<div class="validity-period">Valid for <span>7 Days</span></div>';
                                break;
                                case 'P15D': echo '<div class="validity-period">Valid for <span>15 Days</span></div>';
                                break;
                                case 'P30D': echo '<div class="validity-period">Valid for <span>30 Days</span></div>';
                                break;
                                case 'P365D': echo '<div class="validity-period">Valid for <span>1 Year</span></div>';
                                break;
                                default: echo '';
                            }?>
                            <?php endif;?>
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach;?>
    </ul>
</div>
<?php else:?>
    <span>No amount are available. You may have a low balance or the country is not supported.</span>
<?php endif;?>

<script>
$('#amountList .data').click( function(){
    var skucode = $(this).data('skucode');

    $('.ding-confirm').prop('hidden', null);
});

$('#topupAmount').click( function(){
    $('.topup-amount').prop('hidden',null);
    $('.data-amount').prop('hidden',true);
    $('.bundle-amount').prop('hidden',true);
});

$('#dataAmount').click( function(){
    $('.topup-amount').prop('hidden',true);
    $('.data-amount').prop('hidden',null);
    $('.bundle-amount').prop('hidden',true);
});

$('#bundleAmount').click( function(){
    $('.topup-amount').prop('hidden',true);
    $('.data-amount').prop('hidden',true);
    $('.bundle-amount').prop('hidden',null);
});
</script>
