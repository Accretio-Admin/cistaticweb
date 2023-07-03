<label for="">OLD RECORDS</label>
<table style="margin-bottom:20px;"  class="table table-bordered">
    <thead>
        <tr>
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
        <?php foreach ($API2['TDATA'] as $A ): ?>
            <tr>
                <td nowrap=""><a href="<?php echo $API2['URL'].$A['trackingNo'];?>" target="_blank"><?php echo $A['trackingNo'];?></a></td>
                <td nowrap=""><?php echo $A['optionId'];?></td>
                <td><?php echo $A['assured'];?></td>
                <td><?php echo $A['Beneficiary'];?></td>
                <td><?php echo $A['customerOccupation'];?></td>
                <td><?php echo $A['customerDOB'];?></td>
                <td nowrap=""><?php echo $A['COCNumber'];?></td>
                <td nowrap=""><?php echo $A['amount'];?></td>
                <td nowrap=""><?php echo $A['markup'];?></td>
                <td nowrap=""><?php echo $A['RecDate'];?></td>                                                                      
                </tr>
        <?php endforeach ?>
    </tbody>
</table>
<label for="">NEW RECORDS</label>
<div class="table-responsive">
    <table  class="table table-bordered" >
    <thead class="bg-orange">
        <tr>
            <th  nowrap>#</th>
            <th  nowrap>Transaction #</th>
            <th  nowrap>Policy</th>
            <th  nowrap>Inception Date</th>
            <th  nowrap>Expiry Date</th>
            <th  nowrap>Insured</th>
            <th  nowrap>Beneficiary</th>
            <th  nowrap>Occupation</th>
            <th  nowrap>Birthday</th>
            <th  nowrap>COC No.</th> 
            <th  nowrap>Amount</th>
            <th  nowrap>Debit</th> 
            <th  nowrap>Date/Time</th> 
        </tr>
    </thead>
    <tbody>
        <?php $count = $offset + 1; foreach ($API['TDATA'] as $A ): ?>
        <tr>
            <td nowrap=""><?php echo $count;?></td>
            <td nowrap=""><a href="<?php echo $API['URL'].$A['trackno'];?>" target="_blank"><?php echo $A['trackno'];?></a></td>
            <td nowrap=""><?php echo $A['policy_type'];?></td>
            <td nowrap=""><?php echo $A['inception_date'];?></td>
            <td nowrap=""><?php echo $A['expiry_date'];?></td>
            <td nowrap><?php echo $A['fname']." ".$A['mname']." ".$A['lname'];?></td>
            <td nowrap><?php echo $A['beneficiary'];?></td>
            <td nowrap><?php echo $A['occupation'];?></td>
            <td nowrap><?php echo $A['date_of_birth'];?></td>
            <td nowrap=""><?php echo $A['coc_no'];?></td>
            <td nowrap=""><?php echo $A['amount'];?></td>
            <td nowrap=""><?php echo $A['debit'];?></td>
            <td nowrap=""><?php echo $A['createdat'];?></td>                                                                      
        </tr>
        <?php $count++; endforeach; ?>
    </tbody>
    </table>
</div>



