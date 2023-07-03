<style>
.table-borderless > tbody > tr > td,
.table-borderless > tbody > tr > th,
.table-borderless > tfoot > tr > td,
.table-borderless > tfoot > tr > th{
    border: none;
}
.form-control {
    border-radius: 0;
}

.table-borderless > tbody > tr > th,
.table-borderless > thead > tr > th{
    color: white;
}

/* .note > tbody > tr > td{
    background-color: #fff2e6;
} */

</style>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>E-INSURANCE</li>
                </ul>
                <h4>FEDERAL INSURANCE</h4>
                
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        <div class="row">
            <div class="follower-list">
                <div class="col-md-4">
                    <label id="voucher_code" data-voucher="0" hidden>USING VOUCHER CODE: <span style="color:red;"></span></label>
                    <table class='table table-condensed table-borderless'>
                        <tbody>
                            <tr>
                                <th bgcolor="orange">POLICY OPTION</th>
                            </tr>
                            <tr>
                                <td style="padding: 0 !important;">
                                    <div class="form-group text-right">
                                        <select class="form-control" id="selInsuranceFederalv2" name="selInsuranceFederalv2" required>
                                            <option value="" disabled selected>Please Choose your Policy Number</option>
                                        </select>
                                    </div>
                                    <div class="form-group text-right">
                                        <select class="form-control" id="inputCoveragev2" name="inputCoveragev2" disabled required>
                                            <option value="" disabled selected>Choose Coverage</option>
                                        </select>
                                    </div>
                                    <div class="form-group text-right">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="color: #64a8ce;"></span><a href="#" data-toggle="modal" data-target="#myVoucherModalv2"> Have voucher code?</a>      
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th bgcolor="orange">INSURED INFORMATION</th>
                            </tr>
                            <tr id='frmFederalv2'>
                                <td style="padding: 0 !important;">
                                    <div class="form-group">
                                        <input type="text" class="form-control inputNameValidator2" name="inputFnamev2" value="<?php echo $inputdata['inputFname']; ?>" placeholder="First Name" id="inputFnamev2" required disabled />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control inputNameValidator2" name="inputMnamev2" id="inputMnamev2" value="<?php echo $inputdata['inputMname']; ?>" placeholder="Middle Name" disabled />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control inputNameValidator2" name="inputLnamev2" id="inputLnamev2" value="<?php echo $inputdata['inputLname']; ?>" placeholder="Last Name" required disabled />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control bday" id="datetimepicker" autocomplete="off" name="inputBdatev2" onblur="validateDate();" value="<?php echo $inputdata['inputBdate']; ?>" placeholder="Birthdate" required disabled />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputOccupv2" id="inputOccupv2" placeholder="Occupation" value="<?php echo $inputdata['inputOccup']; ?>"  required disabled />
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="inputEmailv2" id="inputEmailv2"  pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" value="<?php echo $inputdata['inputEmail']; ?>" placeholder="Email Address" required disabled />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" maxlength="11" class="form-control" name="inputNumberv2" id="inputNumberv2" value="<?php echo $inputdata['inputNumber']; ?>" placeholder="Contact Number" required disabled />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputAddressv2" id="inputAddressv2"  value="<?php echo $inputdata['inputAddress']; ?>" placeholder="Address" required disabled />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th bgcolor="orange">BENEFICIARY INFORMATION</th>
                            </tr>
                            <tr id='frmFederalv2'>
                                <td style="padding: 0 !important;">
                                    <div class="form-group">
                                        <input type="text" class="form-control inputNameValidator2" name="inputbFnamev2" id="inputBFnamev2" value="<?php echo $inputdata['inputbFname']; ?>" placeholder="Beneficiary First Name"  required disabled />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control inputNameValidator2" name="inputbMnamev2" id="inputBMnamev2" value="<?php echo $inputdata['inputbMname']; ?>" placeholder="Beneficiary Middle Name" required  disabled />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control inputNameValidator2" name="inputbLnamev2" id="inputBLnamev2" value="<?php echo $inputdata['inputbLname']; ?>" placeholder="Beneficiary Last Name"  required  disabled />
                                    </div>
                                    <hr />
                                    <div class="form-group text-right">
                                        <button type="button" class="btn btn-primary" id="btn_continue">Continue <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5">
                <?php if (is_null($process)): ?>
                    <div class="" id="federalNotev2" style="display: none;">
                    <?php elseif ($process == 1): ?>
                        <div class="" id="federalNoteConfirmv2" style="display: none;">
                        <?php endif ?>
                            <div class="form-group">
                                
                                <table class='table table-condensed table-borderless'>
                                    <thead>
                                        <th bgcolor="orange">COVERAGE</th>
                                        <th bgcolor="orange">LIMITS</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td id="inclusionid_1">ACCIDENTAL DEATH AND DISABLEMENT</td>
                                        <td id="note10v2" nowrap></td>
                                        </tr>

                                        <tr>
                                        <td id="inclusionid_2">MOTORCYCLING</td>
                                        <td id="note20v2" nowrap></td>
                                        </tr>

                                        <tr>
                                        <td id="inclusionid_3">ACCIDENTAL BURIAL BENEFIT</td>
                                        <td id="note30v2" nowrap></td>
                                        </tr>

                                        <tr>
                                        <td id="inclusionid_4">FIRE CASH ASSISTANCE</td>
                                        <td id="note40v2"></td>
                                        </tr>

                                        <tr>
                                        <td>SELLING PRICE</td>
                                        <td id="selling_price" nowrap></td>
                                        </tr>
                                        <tr>
                                        <td>DISCOUNT</td>
                                        <td id="discount" nowrap></td>
                                        </tr>
                                        <tr>
                                        <td>AMOUNT DUE</td>
                                        <td id="amount_due" nowrap></td>
                                        </tr>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <img style="width: 100% !important; padding: 5px !important;" class="company-logo pull-right"  src="<?php echo BASE_URL()?>assets/images/FPG New Logo with Member 2015.png" alt="">
                </div>
            </div>
        </div>
    </div>  
</div>

<div id="myVoucherModalv2" class="modal fade" role="dialog">
    <form method="post" class="transaction_form" id="frmFederalVoucher">
        <div class="modal-dialog" style="padding-top: 4%;">
            <div class="modal-content" style="width: 500px; margin: auto;">
            <div class="modal-header">
            <h4><b> Please enter voucher code</b><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label for="vcode">Voucher Code</label>
                        <input type="text" class="form-control" name="vcode" id="vcode" aria-describedby="basic-addon1">
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn_voucher">Apply</button>
            </div>
            </div>
        </div>
    </form>
</div>

<script>
var site_url = "<?php echo site_url(); ?>"
var base_url = "<?php echo base_url(); ?>"

$(function(){
  var dropdown3 = $('#selInsuranceFederalv2');
  var dropdown4 = $('#inputCoveragev2');
  var items2 = <?php echo json_encode($result2,true); ?>
    //console.log(items2);

      dropdown3.empty();
      var option3 = '';
      dropdown3.append('<option value="" disabled selected>Please Choose your Policy Number</option>');

      for (var i=0;i<Object.keys(items2).length;i++){
        option3 += '<option value="'+ Object.keys(items2)[i]  + '" data-id="' +  items2[i]['option_id'] +'">' + items2[i]['option_name']  + '</option>';
      }
      dropdown3.append(option3);

      dropdown3.on('change', function() {
          //console.log(items2[this.value]['option_id']);
          dropdown4.removeAttr('disabled');
          $('#frmFederalv2 input').removeAttr('disabled');
          dropdown4.empty();
          var option4 = '';
          dropdown4.append('<option value="" disabled selected>Choose Coverage</option>');
          for (var i=0;i<items2[this.value]['coverage_details'].length;i++){
            option4 += '<option value="'+ items2[this.value]['coverage_details'][i]['coverage'] + '|' + items2[this.value]['coverage_details'][i]['coverage_name'] + '|' + items2[this.value]['coverage_details'][i]['amount']  + '">' + items2[this.value]['coverage_details'][i]['coverage_name']  + '</option>';
         }

      dropdown4.append(option4);
    });
})
</script>