<table class="table table-bordered">
    <thead>
        <tr>
            <th  nowrap>#</th>
            <th  nowrap>Transaction #</th>
            <th  nowrap>Policy</th>
            <th  nowrap>Insured</th>
            <th  nowrap>Beneficiary</th>
            <th  nowrap>Occupation</th>
            <th  nowrap>Birthday</th>
            <th  nowrap>COC No.</th> 
            <th  nowrap>Amount</th>
            <th  nowrap>Charge</th>
            <th  nowrap>Date/Time</th> 
        </tr>
    </thead>
    <tbody>
    <?php $count = $offset + 1; foreach ($API['TDATA'] as $A ): ?>
        <tr>
            <td nowrap=""><?php echo $count;?></td>
            <td nowrap=""><a href="<?php echo $A['URL']?>" target="_blank"><?php echo $A['trackingno'];?></a></td>
            <td nowrap=""><?php echo $A['policy'];?></td>
            <td><?php echo $A['assured'];?></td>
            <td><?php echo $A['beneficiary'];?></td>
            <td><?php echo $A['occupation'];?></td>
            <td><?php echo $A['dob'];?></td>
            <td nowrap=""><?php echo $A['cocno'];?></td>
            <td nowrap=""><?php echo $A['amount'];?></td>
            <td nowrap=""><?php echo $A['markup'];?></td>
            <td nowrap=""><?php echo $A['datetime'];?></td>                                                                      
        </tr>
        <?php $count++; endforeach; ?>
    </tbody>
</table>