<option value="" disabled selected>Please Select City/Municipality</option>
<?php foreach($city as $row):?>
	<option value="<?php echo $row['city_id'];?>" id="city"><?php echo $row['city_name'];?></option>
<?php endforeach;?>