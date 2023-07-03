<div id='divAddSenderBeneficiary' <?php echo ($transac_det['sender_id'] != '')?'style="display: none;"':''; ?>>
    <form method="post" id="frmWesternPayoutSenderBeneficiary">
        <div class="form-group"><h4>SENDER</h4></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="inputFnameSs" placeholder="FIRSTNAME" value="<?php echo $transac_det['sender_fname'] ?>" readonly="" />
                </div>  
                <div class="form-group">
                    <input type="text" class="form-control" name="inputMnameSs" placeholder="MIDDLENAME" value="<?php echo $transac_det['sender_mname'] ?>" readonly="" />
                </div> 
                <div class="form-group">
                    <input type="text" class="form-control" name="inputLnameSs"  placeholder="LASTNAME" value="<?php echo $transac_det['sender_lname'] ?>" readonly="" />
                </div> 
                <div class="form-group">
                    <input type="email" class="form-control" name="inputEmailSs"  placeholder="EMAIL" />
                </div>
                <div class='col-md-8' style="padding-left:0px!important">
                    <div class="form-group" >
                        <input type="text" class="form-control" name="inputMobileSs" placeholder="MOBILE NUMBER"  value="<?php echo $transac_det['sender_mobileno'] ?>" readonly="" />
                    </div> 
                </div>
                <div class='col-md-4'>
                    <div class="form-group">
                        <select name="selGenderSs" class="form-control">
                            <option value="" selected disabled>GENDER</option>
                            <option value="Male">MALE</option>
                            <option value="Female">FEMALE</option>
                        </select>
                    </div> 
                </div>
                <div class="form-group"> 
                    <textarea name="inputAddrSs" class="form-control" placeholder="ADDRESSSs" readonly=""><?php echo $transac_det['sender_address'] ?></textarea>
                </div> 
                <div class='col-md-8' style="padding-left:0px!important">
                    <div class="form-group" >
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                        <input type="date" class="form-control" name="inputBdateSs" id="inputBdateSs" required/>
                        </div>
                    </div> 
                </div>
                <div class='col-md-4'>
                    <div class="form-group">
                        <select name="selCountrySs" class="form-control">
                            <option value="" disabled>COUNTRY</option>
                            <option value="Philippines" selected>Philippines</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Qatar">Qatar</option>
                        </select>
                    </div> 
                </div>
            </div>
        </div>
        <br />
        <div class="form-group"><h4>BENEFICIARY</h4></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="inputFnameBb" placeholder="FIRSTNAME" value="<?php echo $transac_det['bene_fname'] ?>" readonly="" />
                </div>  
                <div class="form-group">
                    <input type="text" class="form-control" name="inputMnameBb" placeholder="MIDDLENAME" required/>
                </div> 
                <div class="form-group">
                    <input type="text" class="form-control" name="inputLnameBb"  placeholder="LASTNAME" value="<?php echo $transac_det['bene_lname'] ?>" readonly="" />
                </div> 
                <div class="form-group">
                    <input type="email" class="form-control" name="inputEmailBb"  placeholder="EMAIL" />
                </div>
                <div class='col-md-8' style="padding-left:0px!important">
                    <div class="form-group" >
                        <input type="text" class="form-control" name="inputMobileBb" placeholder="MOBILE NUMBER"/>
                    </div> 
                </div>
                <div class='col-md-4'>
                    <div class="form-group">
                        <select name="selGenderBb" class="form-control">
                            <option value="" selected disabled>GENDER</option>
                            <option value="Male">MALE</option>
                            <option value="Female">FEMALE</option>
                        </select>
                    </div> 
                </div>
                <div class="form-group"> 
                    <textarea name="inputAddrBb" class="form-control" placeholder="ADDRESS"></textarea>
                </div> 
                <div class='col-md-8' style="padding-left:0px!important">
                    <div class="form-group" >
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                        <input type="date" class="form-control" name="inputBdateBb" id="inputBdateBb" required/>
                        </div>
                    </div> 
                </div>
                <div class='col-md-4'>
                    <div class="form-group">
                        <select name="selCountryBb" class="form-control">
                            <option value="" disabled>COUNTRY</option>
                            <option value="Philippines" selected>Philippines</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Qatar">Qatar</option>
                        </select>
                    </div> 
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="inputTpass" required>
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-12 text-right">
                <a class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Submit</button>
            </div>
        </div>
        <input type="hidden" class="form-control" name="inputMtcn" value="<?php echo $transac_det['mtcn'] ?>" />
        <br />
    </form>
</div>