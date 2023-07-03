<option value="" disabled selected>Please Select Province</option>
<?php foreach($province as $row):?>
	<option value="<?php echo $row['province_id'];?>" id="province"><?php echo $row['province_name'];?></option>
<?php endforeach;?>