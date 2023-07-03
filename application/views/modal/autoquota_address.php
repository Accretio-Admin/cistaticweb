<?php if($address):?>
    <?php foreach($address as $row):?>
    <tr data-id="<?php echo $row['id'];?>">
        <?php foreach($usersetting as $u_row):?>
        <td style="width:5%;padding:5px;"><center><input type="radio" data-id="<?php echo $row['id'];?>" name="selected_address" <?php echo ($row['id'] == $u_row['default_address_id'])? 'checked': '';?>/></center></td>
        <?php endforeach;?>
        <td style="width:95%;padding:5px;"><input class="form-control address1" type="text" title="<?php echo $row['unit_house_building'];?> <?php echo $row['street'];?>, <?php echo $row['barangay'];?>, <?php echo $row['city'];?>, <?php echo $row['province'];?>, <?php echo $row['region'];?>, <?php echo $row['zipcode'];?>" value="<?php echo $row['unit_house_building'];?> <?php echo $row['street'];?>, <?php echo $row['barangay'];?>, <?php echo $row['city'];?>, <?php echo $row['province'];?>, <?php echo $row['region'];?>, <?php echo $row['zipcode'];?>" disabled/></td>
        <td style="padding:5px;"><center><button class="edit_address_setting btn btn-sm" data-id="<?php echo $row['id'];?>">EDIT</button></center></td>
        <td style="padding:5px;"><center><button class="remove_address btn btn-sm btn-danger" data-id="<?php echo $row['id'];?>">x</button></center></td>
    </tr>
    <?php endforeach;?>
<?php else:?>
    <tr>
        <td style="width:5%;padding:5px;"><center><input type="radio" name="selected_address"/></center></td>
        <td style="width:95%;padding:5px;"><input class="form-control address1" type="text" disabled/></td>
        <td style="padding:5px;"><center><button class="edit_address_setting btn btn-sm">EDIT</button></center></td>
        <td style="padding:5px;"><center><button class="remove_address btn btn-sm btn-danger">x</button></center></td>
    </tr>
<?php endif;?>
