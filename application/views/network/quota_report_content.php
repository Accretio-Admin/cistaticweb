<?php if($DATA):?>
    <?php foreach($DATA as $row):?>
    <tr>
        <td class="text-center"><?php echo $row['trackingno'];?></td>
        <td class="text-center"><?php echo $row['drcr'];?></td>
        <td class="text-center"><?php echo $row['type'];?></td>
        <td class="text-right"><?php echo $row['amount'];?></td>
        <td class="text-right"><?php echo $row['pv'];?></td>
        <td class="text-right"><?php echo $row['balance_before'];?></td>
        <td class="text-right"><?php echo $row['balance_after'];?></td>
        <td class="text-center"><?php echo $row['createdat'];?></td>
    </tr>
    <?php endforeach;?>
<?php else:?>
    <tr>
        <td colspan="8" class="text-center">NO DATA TO SHOW.</td>
    </tr>
<?php endif;?>