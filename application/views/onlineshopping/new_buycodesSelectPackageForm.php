<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-money"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>Online Shop</li>
                </ul>
                <h4>Buycodes</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">
        <div class="row row-stat">
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <div class='divAlert' id="divAlerts"></div>
                    <div class="alert alert-danger" id="buycodesMessage" style="display: none;"><b></b></div>
                    <?php if ($result['S'] === 0 || $result['S'] === '0' ): ?>
                        <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                    <?php elseif ($result['S'] === 1 || $result['S'] === '1' ): ?>
                        <div class="alert alert-success"><?php echo $result['M'] ?></div>
                    <?php endif ?>
                    <div class="col-sm-10 document" style="padding: 20px;">
                        <table>
                            <tr>
                                <td><img  src="<?php echo BASE_URL() ?>assets/images/flags2/<?php echo  $location; ?>.png" alt="" style="width:40px; height:40px;"></td>
                                <td style="padding-left:5px;"><span><?php echo $location; ?><br> Your IP Address: <?php echo $this->ip; ?></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <?php if(empty($package_value->inclusion)) { ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 document" style="">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 buycodes-photo" align="center">
                                <?php if($package_value->id == '12') { ?>
                                    <img class="imgSize" src="<?php echo $package_value->image;?>" alt="">
                                <?php } else { ?>
                                    <img class="imgSize" src="<?php echo $package_value->image;?>" alt="">
                                <?php } ?>                                 
                                <div class="align-items">
                                    <?php if($package_value->discount > 0) { ?>
                                        <p style="color: rgb(196, 196, 196)"><del><b>₱<?php echo $package_value->amount?></b></del></p>
                                        <p style="margin-top: -10px;"><b>₱<?php $packageval= $package_value->amount- $package_value->discount; echo $packageval.'.00'?></b></p>
                                    <?php } else { ?>
                                        <p hidden class="disc" style="color: rgb(196, 196, 196)"><b><del>₱<?php echo $package_value->amount?></b></del></p>
                                        <p hidden class="disc"><b>₱<?php $packageval= $package_value->amount- 400; echo $packageval.'.00'?></b></p>
                                        <p class="nodisc"><b>₱<?php echo $package_value->amount?></b></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div> <!-- document -->
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 buycodes-photo" align="center">
                                <?php if($package_value->id == '12') { ?>
                                    <img class="imgSize" src="<?php echo $package_value->image;?>" alt="">
                                <?php } else { ?>
                                    <img class="imgSize" src="<?php echo $package_value->image;?>" alt="">
                                <?php } ?>                                 
                                <div class="align-items">
                                    <?php if($package_value->discount > 0) { ?>
                                        <p style="color: rgb(196, 196, 196)"><del><b>₱<?php echo $package_value->amount?></b></del></p>
                                        <p style="margin-top: -10px;"><b>₱<?php $packageval= $package_value->amount- $package_value->discount; echo $packageval.'.00'?></b></p>
                                    <?php } else { ?>
                                        <p hidden class="disc" style="color: rgb(196, 196, 196)"><b><del>₱<?php echo $package_value->amount?></b></del></p>
                                        <p hidden class="disc"><b>₱<?php $packageval= $package_value->amount- 400; echo $packageval.'.00'?></b></p>
                                        <p class="nodisc"><b>₱<?php echo $package_value->amount?></b></p>
                                    <?php } ?>
                                </div>
                            </div>
                
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="width: 80%; margin-left: 10%; margin-right: 10%; margin-top: 30px;">
                                <ul class="list-group list-group-flush important">
                                    <li class="list-group-item buycodes-inclusion">
                                        <p><?php echo $package_value->inclusion; ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>   
                </div>
            </div>

            <div class="col-12 col-xs-12 col-md-12 col-lg-12">
                <div class="form-group" style="margin-bottom: 50px;">
                    <?php if($retailer != 1): ?>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="width:70%; margin-top: 30px; margin-left:15%; margin-right:15%;">
                            <form id="formBuyCodes" name="formBuyCodes">
                                <div class="form-group">
                                    <label>Client Name:</label>
                                    <input type="text" class="form-control" pattern="\S(.*\S)?" name="inputClientname" id="inputClientname" placeholder="Client Name" value="<?php echo $package_info['inputClientname']?>" required/>
                                    <br>
                                </div>

                                <div class="form-group">
                                    <label>Email Address:</label>
                                    <input type="email" class="form-control" name="inputClientemail" id="inputClientemail" placeholder="Client Email" value="<?php echo $package_info['inputClientemail']?>" required/>
                                    <br>
                                </div>

                                <div class="form-group">
                                    <label>Mobile Number:</label>
                                    <input type="text" class="form-control inputNumberValidator" name="inputMobno" id="inputMobno" placeholder="Mobile Number" value="<?php echo $package_info['inputMobno']?>" maxlength="11" required/>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label>Upline:</label>
                                    <input type="text" class="form-control" pattern="\S(.*\S)?" name="inputUpline" id="inputUpline" placeholder="Upline"/>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label>Quantity:</label>
                                    <input type="number" class="form-control" name="inputQuantity" id="inputQuantity" placeholder="Quantity" required/>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <?php if($package_value->id == 12):?>
                                        <hr>Depot Discount: <input type="checkbox" id="discounts" name="discounts" value="1" onclick="rmdiscount()">
                                    <?php endif ?>
                                </div>
                                <hr>How would you like to pay?<br>
                                <div class="form-group">
                                    <select class="form-control" name="selpaymenttype" id="selpaymenttype" placeholder="Payment Option" required>
                                        <option value="" disabled selected>--PAYMENT OPTION--</option>
                                        <option value="1">ECASH</option>
                                        <!-- remove package if done testing -->
                                        <!-- <?php if(($user['L'] == '1' || $user['L'] == '6' || $user['L'] == '14' || $user['L'] == '15' || $user['R'] == '1234567' || $user['R'] == 'F756342' || $user['R'] == '13979797' || $user['R'] == 'FH000016' || $user['R'] == 'F5880126' || $user['R'] == 'FH4762228' || $user['R'] == '1234504') && $package_value->Package_ID <= '5'): ?>
                                            <option hidden value="2">CREDIT CARD</option>
                                        <?php endif?> -->
                                    </select>  
                                </div>
                                <!-- PAYLITE -->
                                <?php if($package_value->id == 3):?>
                                    <div class="form-group">
                                        <p style='text-align:center'> Choose ONE of the following Packages </p>
                                        <input type="hidden" class="form-control" name="packagecode" id="packagecode" value="<?php echo $package_value->package_code; ?>"/>
                                        <?php for($i=0;$i<count($items['M']);$i++) { ?>
                                            <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo $items['M'][$i]['image'];?>" style='cursor: pointer'>
                                                    <img src="<?php echo $items['M'][$i]['image'];?>" alt="" style="width:100%; height:auto;"><br/>
                                                </a>
                                                <input type="radio" id="variantcode" name="variantcode" placeholder="variant code" value="<?php echo $items['M'][$i]['variant_code']?>" style="height:20px; width:25px" required>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php endif ?>
                                <!-- PINOY PACKAGE-->
                                <?php if($package_value->id == 4):?>
                                    <div class="form-group">
                                        <p style='text-align:center'> Choose ONE of the following Packages </p>
                                        <input type="hidden" class="form-control" name="packagecode" id="packagecode" value="<?php echo $package_value->package_code; ?>"/>
                                        <?php for($i=0;$i<count($items['M']);$i++) { ?>
                                            <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo $items['M'][$i]['image'];?>" style='cursor: pointer'>
                                                    <img src="<?php echo $items['M'][$i]['image'];?>" alt="" style="width:100%; height:auto;"><br/>
                                                </a>
                                                <input type="radio" id="variantcode" name="variantcode" placeholder="variant code" value="<?php echo $items['M'][$i]['variant_code']?>" style="height:20px; width:25px" required>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php endif ?>
                                <div class="form-group text-right" style="margin-top: -20px;">
                                    <button type="submit" class="btn btn-primary" id="btn_validate">VALIDATE</button>
                                    <input type="hidden" class="form-control" name="inputCountry" id="inputCountry" value="<?php echo $location; ?>"/>
                                    <input type="hidden" class="form-control" name="inputPackageCode" id="inputPackageCode" value="<?php echo $package_value->package_code; ?>"/>
                                </div>
                                <!-- <div class="form-group text-right" style="margin-top: -20px;">
                                    <button type="button" class="btn btn-primary" id="Test">Test</button>
                                </div> -->
                            </form>

                            <input type="hidden" class="form-control" name="validationModal" id="validationModal" value="<?php echo $value;?>"/>
                            <div id="imagemodal" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <img id="packageImageModal" src="" alt="" style="width:100%; height:auto;">
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="col-xs-2 col-sm-5 col-md-5">
                                    <div class="alert alert-info alert-creditcard2" style="display:none; word-wrap:break-word;"></div>
                                </div>
                            </div>
                            <div class='col-xs-12 col-md-12'>
                                <hr>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>

            <div class="col-xs-12 col-md-12">
                <div class='col-xs-12 col-md-12'>
                    <div class="form-group">
                        <div class="table-responsive">
                            <div class="tab">
                                <button class="tablinks" onclick="openTransaction(event, 'NewTransaction')" id="defaultOpen">New Transactions</button>
                                <button class="tablinks" onclick="openTransaction(event, 'OldTransaction')">Old Transactions</button>
                            </div>
                            <!-- Tab Content -->
                            <div id="NewTransaction" class="tabcontent">
                                <table id="buykitsdtbl" class="table table-bordered" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tracking number</th>
                                            <th>Payment Type</th>
                                            <th>Package Code</th>
                                            <th>Variant Code</th>
                                            <th>Amount</th>
                                            <th>Discount</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
                                            <th>Date/Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($binfo_set){
                                                for($i=0;$i<count($transdata);$i++){
                                                    echo "<tr>";

                                                        echo "<td>";
                                                        echo $transdata[$i]['trackno'];
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo $transdata[$i]['payment_type'];
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo $transdata[$i]['package_code'];
                                                        echo "</td>";

                                                    
                                                        echo "<td>";
                                                        echo $transdata[$i]['variant_code'];
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo $transdata[$i]['amount'];
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo $transdata[$i]['discount'];
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo $transdata[$i]['quantity'];
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo number_format(($transdata[$i]['amount']-$transdata[$i]['discount'])*$transdata[$i]['quantity'],2,'.','');
                                                        echo "</td>";

                                                        echo "<td>";
                                                            echo $transdata[$i]['createdAT'];
                                                        echo "</td>";

                                                        echo "<td>";
                                        ?>
                                                    <a class="btn btn-primary" target="_blank" href="<?php echo "https://mobilereports.globalpinoyremittance.com/portal/new_buycode_receipt/".$transdata[$i]['trackno']; ?>">Get Receipt</a>
                                        <?php
                                                    echo "</td>";
                                                echo "</tr>";
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="OldTransaction" class="tabcontent">
                                <table id="buykitsdtbl2" class="table table-bordered" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tracking number</th>
                                            <th>Payment Type</th>
                                            <th>Package Type</th>
                                            <?php if($package_value->package_code == "PAYLITE"):?>
                                                <th>Paylite Package</th>
                                            <?php endif ?>
                                            <?php if($package_value->package_code == "PINOY2"):?>
                                                <th>Pinoy Package</th>
                                            <?php endif ?>
                                            <th>Datetime</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($binfo_set_old){
                                            for($i=0;$i<count($transdata_old);$i++){
                                            echo "<tr>";

                                            echo "<td>";
                                            echo $transdata_old[$i]['trackno'];
                                            echo "</td>";

                                            echo "<td>";
                                            echo $transdata_old[$i]['payment_type'];
                                            echo "</td>";

                                            echo "<td>";
                                            echo $transdata_old[$i]['packagetype'];
                                            echo "</td>";

                                            if($package_value->package_code == "PAYLITE"){
                                                echo "<td>";
                                                echo $transdata_old[$i]['packages'];
                                                echo "</td>";
                                            }
                                            
                                            if($package_value->package_code == "PINOY2"){
                                                echo "<td>";
                                                echo $transdata_old[$i]['packages'];
                                                echo "</td>";
                                            }

                                            echo "<td>";
                                            echo $transdata_old[$i]['datetime'];
                                            echo "</td>";

                                            echo "<td>";
                                            echo $transdata_old[$i]['status'];
                                            echo "</td>";

                                            echo "<td>";
                                            if($transdata_old[$i]['status'] == 'POSTED'){
                                                ?>
                                                <p style="color:black;">Pending for Confirmation</p>
                                                <?php
                                            }else if($transdata_old[$i]['status'] == 'CANCELLED'){
                                                ?>
                                                <p style="font-weight:bold;color:red;">Cancelled</p>
                                                <?php
                                            }else{
                                                ?>
                                                <a class="btn btn-primary" target="_blank" href="<?php echo "https://mobilereports.globalpinoyremittance.com/portal/buy_codes_receipt/".$transdata_old[$i]['trackno']; ?>">Get Receipt</a>
                                                <?php
                                            }
                                            echo "</td>";

                                            echo "</tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> 
        </div>    
    </div><!-- contentpanel -->

    <?php if($process == 1):?>
        <div class="modal fade" tabindex="-1" role="dialog" id="modalBDOframe">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close closeBDOmodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <iframe width="100%" height="550px" src="" name="BDOiframe" id="BDOiframe"></iframe>
                        <input type="hidden" class="form-control" name="inputbdoURL" id="inputbdoURL" value="<?php echo $bdoURL; ?>"/>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> -->
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <?php endif ?>
    <?php if($process == 999):?>
        <div class="modal fade" id="modalBuycodesAgreementframe" data-backdrop="static" role="dialog" style="margin-top: 3%;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p><strong><h4 style="font-family: Times New Roman, times-roman, georgia, serif">TERMS AND CONDITION</h4></strong></p>
                    </div>
                    <div class="modal-body" style="font-family: Times  New Roman; overflow-y: scroll; width: 100%; height: 500px; padding: 0px 5px 5px 5px;">
                        <iframe width="100%" height="700px" src="" name="buycodesAgreementiframe" id="buycodesAgreementiframe"></iframe>
                        <input type="hidden" class="form-control" name="inputAgreeURL" id="inputAgreeURL" value="<?php echo urlencode($content); ?>"/>
                        <textarea name="inputPackageInfo999" id="inputPackageInfo999" style="display:none;"><?php echo json_encode($package_info); ?></textarea>
                        <textarea name="inputHidPackageInfo999" id="inputHidPackageInfo999" style="display:none;"><?php echo $hid_package_info; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="modal fade" id="validateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><strong>TRANSACTION SUMMARY</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formBuyCodesTransaction" name="formBuyCodesTransaction">
                    <div class="modal-body" style="font-family: Times New Roman; overflow-y: scroll; width: 100%; height: 450px; padding 0px 5px 5px 5px;">
                        <input type="hidden" name="regcode">
                        <input type="hidden" name="country">
                        <input type="hidden" id="discount" name="discount">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:96px;">Name:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="clientName" class="clientName"></label></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:47px;">Email Address:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="clientEmail" class="clientEmail"></label></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:68px;">Mobile No:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="clientMobile" class="clientMobile"></label></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:49px;">Payment Type:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="paymentType" class="paymentType"></label></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:49px;">Package Code:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="packageCode" class="packageCode"></label></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:56px;">Variant Code:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="variantCode" class="variantCode"></label></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:80px;">Quantity:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="quantity" class="quantity"></label></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:91px;">Upline:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="upline" class="upline"></label></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <input type="password" style="display: none;" class="form-control" name="inputTpass" id="inputTpass" maxlength="15" placeholder="Transaction Password" required/>
                                <div class="alert alert-info alert-creditcard1" style="display:none; word-wrap:break-word; margin-bottom: auto;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- mainpanel --> 



<script type="text/javascript">
    function submit(valpass){
        document.getElementById("package_select").value = valpass;
        document.getElementById("selectPackage").submit();
    }

    $('#inputClientname, #inputUpline').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
    });

    $('#inputClientname').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
    });

    $('#formBuyCodes').submit((e) => {
        e.preventDefault();
        waitingDialog.show('Data Validation. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});

        var formdata = new FormData();
        formdata.append('clientname',$('#inputClientname').val());
        formdata.append('clientemail',$('#inputClientemail').val());
        formdata.append('clientmobile',$('#inputMobno').val());
        formdata.append('clientupline',$('#inputUpline').val());
        formdata.append('clientquantity',$('#inputQuantity').val());
        formdata.append('discounts',$("input[type=checkbox][name=discounts]:checked").val());
        formdata.append('clientpayment',$('#selpaymenttype').val());
        formdata.append('clientpackage',$('#inputPackageCode').val());
        formdata.append('clientvariant',$("input[type=radio][name=variantcode]:checked").val());

        $.ajax({
            url: "/Buycodes/Buycodes_validate",
            type: 'POST',
            data : formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                var buycodesdata = JSON.parse(data);
                if(buycodesdata['S'] == '1'){
                    $('#validateModal #clientName').html(buycodesdata['CN']);
                    $('#validateModal #clientEmail').html(buycodesdata['CE']);
                    $('#validateModal #clientMobile').html(buycodesdata['CM']);
                    $('#validateModal #paymentType').html(buycodesdata['PT']);
                    $('#validateModal #packageCode').html(buycodesdata['PC']);
                    if(buycodesdata['VC'] != "undefined"){
                        $('#validateModal #variantCode').html(buycodesdata['VC']);
                    }else{
                        $('#validateModal #variantCode').html(' ');
                    }
                    $('#validateModal #upline').html(buycodesdata['U']);
                    $('#validateModal #quantity').html(buycodesdata['Q']);
                    $('#validateModal #discount').html(buycodesdata['D']);
                    
                    waitingDialog.hide();
                    $('#validateModal').modal('show'); 
                }else{
                    waitingDialog.hide();
                    validationFail(buycodesdata['M']);

                    window.scroll({
                        top: 0, 
                        left: 0, 
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    $('#formBuyCodesTransaction').submit((e) => {
        e.preventDefault();

        var formdata = new FormData();
        formdata.append('cname',$('#clientName').text());
        formdata.append('cemail',$('#clientEmail').text());
        formdata.append('cmobole',$('#clientMobile').text());
        formdata.append('cupline',$('#upline').text());
        formdata.append('cquantity',$('#quantity').text());
        formdata.append('cdiscounts',$('#discount').text());
        formdata.append('cpayment',$('#paymentType').text());
        formdata.append('cpackage',$('#packageCode').text());
        formdata.append('cvariant',$('#variantCode').text());
        formdata.append('iTpass',$('#inputTpass').val());

        $.ajax({
            url: "/Buycodes/Buycodes_transaction",
            type: 'POST',
            data : formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                waitingDialog.show('Data Validation. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
                var buycodesdata = JSON.parse(data);
                if(buycodesdata['S'] == '1'){
                    waitingDialog.hide();
                    validationSuccess(buycodesdata['M']);
                    $('#validateModal').modal('hide'); 

                    window.scroll({
                        top: 0, 
                        left: 0, 
                        behavior: 'smooth'
                    });
                }else{
                    waitingDialog.hide();
                    validationFail(buycodesdata['M']);
                    $('#validateModal').modal('hide'); 

                    window.scroll({
                        top: 0, 
                        left: 0, 
                        behavior: 'smooth'
                    });
                }

            }
        });
    });

    $(document).on("click",".openImage", function (){
        var modalimage = $(this).data('id');
        $(".modal-body #packageImageModal").attr("src",modalimage);
    });

    $(document).ready(function () {
    $("#buykitsdtbl2").DataTable({
        aaSorting: [],
    });
    });

    function rmdiscount(){
        var checkBox = document.getElementById("discounts");
        if (checkBox.checked == true){
            $('.disc').attr("hidden",false);
            $('.nodisc').attr("hidden",true);
        }else{
            $('.disc').attr("hidden",true);
            $('.nodisc').attr("hidden",false);
        }
    }

    function validationFail (data) {
        $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">'+                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data+'</div>');
    }
    function validationSuccess (data) {
        $('.divAlert').html('<div class="alert alert-success alert-dismissible" role="alert">'+                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data+'</div>');
    }

    function openTransaction (evt, transaction) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(transaction).style.display = "block";
        evt.currentTarget.className += " active";
    }

    document.getElementById("defaultOpen").click();
</script>

<style>

.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

@media screen and (max-width: 600px){
    .buycodes-photo {
        width: 38%;
        height: 40%;
        margin-left: 31%;
        margin-right: 31%;
        border-radius: 15px;
        box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
        transition: transform .2s;
        position: relative;
    }
    .imgSize{
        width: 60%;
        height: 65%;
        padding: 10px;
    }
    .buycodes-inclusion{
        box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    }
}

@media screen and (min-width: 601px) {
    .buycodes-photo {
        width: 33%;
        height: 35%;
        margin-left: 33.5%;
        margin-right: 33.5%;
        border-radius: 15px;
        box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
        transition: transform .2s;
        position: relative;
    }
    .imgSize{
        width: 60%;
        height: 65%;
        padding: 10px;
    }
    .buycodes-inclusion{
        box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    }
}

@media screen and (min-width: 768px) {
    .buycodes-photo {
        width: 28%;
        height: 30%;
        margin-left: 36%;
        margin-right: 36%;
        border-radius: 15px;
        box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
        transition: transform .2s;
        position: relative;
    }
    .imgSize{
        width: 60%;
        height: 65%;
        padding: 10px;
    }
    .buycodes-inclusion{
        box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    }
}

@media screen and (min-width: 992px) {
    .buycodes-photo {
        width: 23%;
        height: 25%;
        margin-left: 38.5%;
        margin-right: 38.5%;
        border-radius: 15px;
        box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
        transition: transform .2s;
        position: relative;
    }
    .imgSize{
        width: 60%;
        height: 65%;
        padding: 10px;
    }
    .buycodes-inclusion{
        box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    }
}

@media screen and (min-width: 1200px) {
    .buycodes-photo {
        width: 18%;
        height: 20%;
        margin-left: 41%;
        margin-right: 41%;
        border-radius: 15px;
        box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
        transition: transform .2s;
        position: relative;
    }
    .imgSize{
        width: 60%;
        height: 65%;
        padding: 10px;
    }
    .buycodes-inclusion{
        box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    }
}
</style>