<?php foreach($usersetting as $row):?>
<?php $branches = array(
    array('id' => 'F756342','branch' => 'UNIFIED QUEZON CITY'),
    array('id' => '13979797','branch' => 'UNIFIED CEBU'),
    array('id' => 'FH000016','branch' => 'UNIFIED DAVAO'),
    array('id' => 'FH0874610','branch' => 'UNIFIED BUTUAN')
);

// print_r($user['AQ_usersettings']);
?>

<!-- <div id="autoquota_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                <h4 class="modal-title">AUTO QUOTA SETTINGS</h4>
            </div>
            <div class="modal-body">
                <span style="font-size:80%; font-weight:bold; display:none;" id="lblAQ">AUTO QUOTA SWITCH : </span>
                <span class="Switch" title="Auto Quota Switch" style="border: solid 1px black;" onclick="Turn(this)">ON</span><span class="Switch" style="border: solid 1px black;" title="Auto Quota Switch" onclick="Turn(this)">OFF</span>
                <span style="font-size:80%; font-weight:bold; text-overflow: ellipsis; display:inline-block" id="Notif"></span>
                <hr />
                <div style="background-color:#ffdd99; border:solid 1px black; border-radius: 5px;padding: 20px;margin-bottom: 10px;">
                    <div style="all:unset;margin-top: 5px;"><label for="setting_currentRank">RANK: <span data-rank="" id="setting_currentRank" style="background-color:white; border:solid 1px black;padding: 0 2px">-</span></label></div>
                    <div><h4 style="all:unset;font-style: italic; font-weight:bold;">PACKAGES</h4></div>
                    
                    <div style="height:150px;overflow-y:scroll;overflow-x:hidden;" class="package-inclusion">

                    </div>
                    
                </div> -->
                <div style="background-color:#ffdd99; border:solid 1px black; border-radius: 5px;padding: 20px;margin-bottom: 10px;">
                    <div>
                        
                        <input type="radio" data-selected="<?php echo ($row['claim_option'] == 'PICKUP')?'PICKUP':'';?>" name="claim_option" id="pickup_claim" value="PICK UP" <?php echo ($row['claim_option'] == 'PICKUP')?'checked':'';?>/> PICK UP
                        <!-- <label for="pickup" id="label_pickup">PICK UP</label> -->
                        <input style="margin-left:10px;" name="claim_option" data-selected="<?php echo ($row['claim_option'] == 'DELIVERY')?'DELIVERY':'';?>" type="radio" id="delivery_claim"  value="DELIVERY"<?php echo ($row['claim_option'] == 'DELIVERY')?'checked':'';?>/> DELIVERY
                        <!-- <label for="deliver" id="label_delivery">DELIVERY</label> -->
                    </div>
                    <div class="show_pickup" hidden>
                        <!-- <div><h4 style="all:unset;font-style: italic; font-weight:bold;">PICK UP</h4></div> -->
                        <select class="form-control" id="select_branch">
                            <option value="">SELECT BRANCH</option>
                            <?php foreach($branches as $data):?>
                                <?php if($data['id'] == $row['pickup_branch']):?>
                                    <option value="<?php echo $data['id']?>" selected hidden><?php echo $data['branch']?></option>
                                <?php endif;?>
                                <option value="<?php echo $data['id']?>"><?php echo $data['branch']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="show_delivery" hidden>
                        <!-- <div><h4 style="all:unset;font-style: italic; font-weight:bold;">DELIVERY ADDRESS</h4></div> -->
                        <table id="tbl_address">
                            <thead>
                                <tr>
                                    <th colspan="3">ADDRESS</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <center><button id="add_address_setting"style="margin-bottom: 10px;margin-top: 10px;">ADD ADDRESS</button></center>
                    </div>
                </div>
                <div style="background-color:#ffdd99; border:solid 1px black; border-radius: 5px;padding: 20px;margin-bottom: 10px;"> 
                    <div><h4 style="all:unset;padding-bottom: 10px;font-style: italic; font-weight:bold;">CONTACT DETAILS</h4></div>
                    <div style="padding-bottom: 5px;" class="container-fluid">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <label for="contact_name">NAME</label>
                            </div>
                            <div class="col-md-6">
                                <input id="aq_contact_name" class="form-control" type="text" value="<?php echo $row['contact_name'];?>"/>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 5px;" class="container-fluid">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <label for="">CONTACT #</label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="number" id="aq_contact_no"  value="<?php echo $row['contact_number'];?>"/>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 5px;" class="container-fluid">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <label for="">EMAIL ADD</label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" id="aq_email" value="<?php echo $row['email'];?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <center><button data-id="<?php echo $row['id'];?>" class="" id="save_aq_settings">SAVE</button></center>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>