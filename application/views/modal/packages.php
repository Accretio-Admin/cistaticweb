<?php foreach($packages as $p_row):?>
    <?php if($p_row['rank_code'] == $rank_code):?>
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
        <?php foreach($usersetting as $row):?>
            <input type="radio" data-id="<?php echo $p_row['id'];?>" id="package<?php echo $p_row['id'];?>" name="select_package" <?php echo ($row['default_package_id'] == $p_row['id'])? 'checked': '';?>/>
        <?php endforeach;?>
            <label for="package1" style="all:unset;margin-left: 10px;text-decoration: underline;"><?php echo $p_row['package_name'];?></label>
        </div>
    </div>
    <div class=" row">
        <div class="col-md-7 col-md-offset-2">
        <?php foreach($inclusion as $i_row):?>
            <?php if($p_row['id'] == $i_row['package_id']):?>
            <h6>(<?php echo $i_row['qty'];?>) <?php echo $i_row['product_name'];?></h6>
            <?php endif;?>
        <?php endforeach;?>
        </div>
    </div>
    <?php endif;?>
<?php endforeach;?>
