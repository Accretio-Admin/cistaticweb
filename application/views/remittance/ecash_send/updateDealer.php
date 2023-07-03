


<script>
    var my_handlers = {
        fill_provinces2: function(){
            var region_code2 = $(this).val();
            $('#selProvince2').ph_locations('fetch_list', [{"region_code": region_code2}]);
            
        },

        fill_cities2: function(){
            var province_code2 = $(this).val();
            $('#selCity2').ph_locations('fetch_list', [{"province_code": province_code2}]);
        },

        fill_barangays2: function(){
            var city_code2 = $(this).val();
            $('#selBarangay2').ph_locations('fetch_list', [{"city_code": city_code2}]);
        }
    };

    $(function(){
            $('#selRegion2').on('change', my_handlers.fill_provinces2);
            $('#selRegion2').on('change', function(){
                if($(this).val() != 'default'){
                    $('#selProvince2').removeAttr('disabled');
                }
            });
            
            $('#selProvince2').on('change', my_handlers.fill_cities2);
            $('#selProvince2').on('change', function(){
                if($(this).val() != 'default'){
                    $('#selCity2').removeAttr('disabled');
                }
            });
            
            $('#selCity2').on('change', my_handlers.fill_barangays2);
            $('#selCity2').on('change', function(){
                if($(this).val() != 'default'){
                    $('#selBarangay2').removeAttr('disabled');
                }
            });
            

            $('#selRegion2').ph_locations({'location_type': 'regions'});
            $('#selProvince2').ph_locations({'location_type': 'provinces'});
            $('#selCity2').ph_locations({'location_type': 'cities'});
            $('#selBarangay2').ph_locations({'location_type': 'barangays'});

            $('#selRegion2').ph_locations('fetch_list');
    });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="mainpanel">
    <div class="contentpanel" style="padding-bottom: 0px;">
        <form action="" method="post"  id="frmAddEcashPadalaSender" enctype="multipart/form-data">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="addModalClose">&times;</button>
                <div class="alert alert-success" id="succesNotif" hidden><b>SUCCESSFULLY UPDATE SENDER DETAILS! Redirecting Please Wait.</b></div>
                <h4 class="modal-title">UPDATE SENDER DETAILS</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <div id="step1" class="col-md-12">
                            <input type="hidden" class="form-control" name="senderID" id="senderID" value="<?php echo $dealerSenderID; ?>"disabled/>
                            <?php if($checkSender['result'][0]['permanentAddress'] == '' || $checkSender['result'][0]['permanentAddress'] == null) : ?>
                            <div id="permanentAddress">
                                <div class='col-md-12' style="padding-top:20px">
                                    <div class="form-group">
                                        <span style="font-weight:bold;">Permanent Address</span>
                                        
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <select type="text" class="form-control selOption" name="inputCountry2" id="inputCountry2" placeholder="COUNTRY" required>
                                            <option value="" selected disabled>SELECT COUNTRY</option>
                                            <option value="PHILIPPINES">PHILIPPINES</option>
                                            <option value="SINGAPORE">SINGAPORE</option>
                                            <option value="QATAR">QATAR</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputProvince2" id="inputProvince2"  placeholder="STATE/PROVINCE" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterKey(event)" disabled required/>
                                        <select class="form-control" id="selRegion2" style="display: none;">
                                            <option value="" selected disabled>REGION</option>
                                        </select>
                                    </div> 
                                </div>

                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputCity2" id="inputCity2"  placeholder="CITY" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterKey(event)" disabled required/>
                                        <select class="form-control" id="selProvince2" style="display: none;" disabled>
                                            <option value="" selected disabled>STATE/PROVINCE</option>
                                        </select>
                                    </div> 
                                </div>

                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputBarangay2" id="inputBarangay2"  placeholder="BARANGAY" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterNumberKey(event)" disabled required/>
                                        <select class="form-control" id="selCity2" style="display: none;" disabled>
                                            <option value="" selected disabled>CITY</option>
                                        </select>
                                    </div> 
                                </div>

                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <select class="form-control" id="selBarangay2" style="display: none;" disabled>
                                            <option value="" selected disabled>BARANGAY</option>
                                        </select>
                                    </div> 
                                </div>

                                <div class='col-md-8 mb-2'>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputStreet2" id="inputStreet2"  placeholder="STREET" disabled required/>
                                    </div> 
                                </div>
                                <div class='col-md-4 mb-2'>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputPostal2" id="inputPostal2"  placeholder="POSTAL" onkeypress="return isNumberKey(event)" maxlength="4" disabled required/>
                                    </div> 
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($checkSender['result'][0]['placeOfBirth'] == '' || $checkSender['result'][0]['placeOfBirth'] == null) : ?>
                            <div class='col-md-4' id="placeOfBirth">
                                <div class="form-group" >
                                    <input type="text" class="form-control" name="inputBirthplace" id="inputBirthplace" placeholder="BIRTH PLACE"  onkeypress="return isLetterKey(event)" required/>
                                </div> 
                            </div>
                            <?php endif; ?>

                            <?php if($checkSender['result'][0]['sourceOfFund'] == '' || $checkSender['result'][0]['sourceOfFund'] == null) : ?>
                            <div class='col-md-4' id="sourceOfFund">
                                <div class="form-group">
                                    <select class="form-control selOption" name="inputSourceoffund" id="inputSourceoffund" required>
                                        <option  value="" disabled selected>SOURCE OF FUND</option>  
                                        <option  value="Salary">Salary</option>
                                        <option  value="Savings">Savings</option>
                                        <option  value="Inheritance">Inheritance</option>
                                        <option  value="Company Profit">Company Profit</option>
                                        <option  value="Investments">Investments</option>
                                        <option  value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class='col-md-4'>
                            </div>
                        </div>

                        <?php if($checkSender['id'] == '' || $checkSender['id'] == null) : ?>
                        <div id="step2" class="col-md-12">
                            <div class="alert alert-danger" style="display:none; text-align: center;" id="updateexpired"><b></b></div>
                            <div class="alert alert-success" style="display:none; text-align: center;" id="addnewsuccess"><b></b></div>
                            <div id="step2">
                                <div class="alert alert-danger" style="display:none; text-align: center;" id="updateexpired"><b></b></div>
                                <div class="alert alert-success" style="display:none; text-align: center;" id="addnewsuccess"><b></b></div>
                                <div class='col-md-12' style="padding-top:20px">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span style="font-weight:bold;">ID # 1</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="padding-right: 34px;">ID TYPE:</span>
                                        <select class="form-control selOption" name="newidtype" id="newidtype" required>
                                            <option value="" disabled selected>--CHOOSE ID TYPE--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="padding-right: 12px;">ID NUMBER:</span>
                                        <input type="text" class="form-control" name="newidnumber" id="newidnumber" required />
                                    </div>
                                </div>
                                <div class="form-group" hidden id="divNewexpirydate1">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="padding-right: 34px;">EXPIRY DATE:</span>
                                        <input type="date" class="form-control" name="newexpirydate1" id="newexpirydate1" onkeydown="return false" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="padding-right: 45px;">ID PICTURE:</span>
                                        <input type="file" class="form-control" name="file1" id="file1" title="No File Found"  accept="image/*" onchange="ValidateSingleInput(this);" required />
                                    </div>
                                </div>
                                
                                <div hidden id="divID2">
                                    <div class='col-md-12' style="padding-top:10px">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span style="font-weight:bold;">ID # 2</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="padding-right: 34px;">ID TYPE:</span>
                                            <select class="form-control" name="newidtype2" id="newidtype2" >
                                                <option value="" disabled selected>--CHOOSE ID TYPE--</option>   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"  style="padding-right: 12px;">ID NUMBER:</span>
                                            <input type="text" class="form-control" name="newidnumber2" id="newidnumber2">
                                        </div>
                                    </div>
                                    <div class="form-group" hidden id="divNewexpirydate2">
                                        <div class="input-group">
                                            <span class="input-group-addon"  style="padding-right: 34px;">EXPIRY DATE:</span>
                                            <input type="date" class="form-control" name="newexpirydate2" id="newexpirydate2" onkeydown="return false">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"  style="padding-right: 45px;">ID PICTURE:</span>
                                            <input type="file" class="form-control" name="file2" id="file2" accept="image/*" title="No File Found" onchange="ValidateSingleInput(this);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-right">
                                <button type="button" class="btn btn-primary" name="btnAddSenderBSP" id="btnAddSenderBSP">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
        </form>
    </div>       
</div>

<script>
    
    $(document).ready(function () {
        // $('#btnAddSenderBSP').prop('disabled', true)
        if($('#step2').is(':visible')){
            waitingDialog.show('Loading list of IDs, Please wait...', {dialogSize: 'sm', progressType: 'primary'});
            $.ajax({
                url         : '/Ecash_send/fetch_IDs',
                type        : 'POST',
                processData : false,
                contentType : false,
                success     : function (data) {
                    var jsonData = JSON.parse(data);
                    if(jsonData.S == 1){
                        fetchedID = "meron";

                        $('#newidtype').append($('<option>', {
                            text: "-- PRIMARY --",
                            disabled: true
                        }))

                        jsonData.T_DATA.forEach(function(i){
                            // console.log(i)
                            if(i.idtype == 'PRIMARY'){
                                $('#newidtype').append($('<option>', {
                                    id: i.id,
                                    value: i.id,
                                    text: i.description
                                }));
                                $('#'+i.id).attr('data-expiry', i.expirable)
                                $('#'+i.id).attr('data-type', i.idtype)
                                $('#'+i.id).attr('data-regex', (i.rule).replace("/g", ""))
                            }
                        })
                        
                        $('#newidtype').append($('<option>', {
                            text: "-- SECONDARY --",
                            disabled: true
                        }))

                        jsonData.T_DATA.forEach(function(i){
                            // console.log(i)
                            if(i.idtype == 'SECONDARY'){
                                $('#newidtype').append($('<option>', {
                                    id: i.id,
                                    value: i.id,
                                    text: i.description
                                }));
                                $('#'+i.id).attr('data-expiry', i.expirable)
                                $('#'+i.id).attr('data-type', i.idtype)
                                $('#'+i.id).attr('data-regex', (i.rule).replace("/g", ""))
                            }
                        })

                        jsonData.T_DATA.forEach(function(i){
                            if(i.idtype == 'SECONDARY'){
                                $('#newidtype2').append($('<option>', {
                                    id: i.id,
                                    value: i.id,
                                    text: i.description
                                }));
                                $('#newidtype2 #'+i.id).attr('data-expiry', i.expirable)
                                $('#newidtype2 #'+i.id).attr('data-type', i.idtype)
                                $('#newidtype2 #'+i.id).attr('data-regex', (i.rule).replace("/g", ""))
                            }
                        })
                        waitingDialog.hide()
                        $('#newidtype').removeAttr("disabled")
                    }
                }
            })
        }
    })

    $('#btnAddSenderBSP').on('click', function(){
        let empty1 = false;
        let empty2 = false;
        var idArray1 = [];
        var idArray2 = [];

        $('form#frmAddEcashPadalaSender').find('input').each(function(){
            if($(this).prop('required')){
                $(this).each(function() {
                    empty1 = $(this).val().length;
                    idArray1.push(empty1);
                });

            }
        });
        
        $('form#frmAddEcashPadalaSender .selOption > option:selected').each(function() {
            if($('form#frmAddEcashPadalaSender .selOption').is(':visible')){
                if($('form#frmAddEcashPadalaSender .selOption').prop('required')){
                    empty2 = $(this).val().length;
                    idArray2.push(empty2);
                }
            }
        });
        
        const someIsNotZero1 = idArray1.some(item => item == 0);
        const someIsNotZero2 = idArray2.some(item => item == 0);
        // alert(someIsNotZero1+" "+ idArray1+" | "+someIsNotZero2+" "+ idArray2)

        if (!someIsNotZero1 && !someIsNotZero2){
            waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
            updateSender()
        }else{
            swal({
                title: 'Blank fields detected!',
                text: "Please fill-in required fields.",
                icon: 'warning',
                buttons: false,
            })
        }
    })
    
    $('#inputCountry2').on('change', function(){
        $('#inputProvince2, #inputCity2, #inputBarangay2, #inputStreet2, #inputPostal2').removeAttr('disabled');
        if($(this).val() == 'PHILIPPINES'){
            $('#inputProvince2, #inputCity2, #inputBarangay2').hide().val("").removeAttr('required');
            $('#selRegion2, #selProvince2, #selCity2, #selBarangay2').css('display', '').attr('required', true);

            $('#selRegion2').append($('<option>', {
                value: 'default',
                text: 'STATE/PROVINCE'
            }));
            $('#selProvince2').append($('<option>', {
                value: 'default',
                text: 'REGION'
            }));
            $('#selCity2').append($('<option>', {
                value: 'default',
                text: 'CITY'
            }));
            $('#selBarangay2').append($('<option>', {
                value: 'default',
                text: 'BARANGAY'
            }));

            $('#selProvince2, #selCity2, #selBarangay2').attr('disabled', true);
            $('#selProvince2 option[value=default], #selCity2 option[value=default], #selBarangay2 option[value=default]').attr('selected','selected');
        }else{
            $('#inputProvince2, #inputCity2, #inputBarangay2').show().attr('required', true);
            $('#selRegion2, #selProvince2, #selCity2, #selBarangay2').css('display', 'none').val("").removeAttr('required');
        }
    })

    $('#newidtype').on('change', function(){
        if($(this).children(":selected").data('expiry') == "YES"){
            $('#divNewexpirydate1').show(200)
            $('#newexpirydate1').prop('required',true);
        }
        if($(this).children(":selected").data('expiry') == "NO"){
            $('#divNewexpirydate1').hide()
            $('#newexpirydate1').val("").removeAttr('required')
        }
        if($(this).children(":selected").data('type') == "SECONDARY"){
            $('#divID2').show(200);
            
            $('#newidtype2').prop('required',true)
            $('#newidtype2').attr('class', 'form-control selOption')
            $('#newidnumber2').prop('required',true)
            $('#file2').prop('required',true)
        }
        if($(this).children(":selected").data('type') == "PRIMARY"){
            $('#divID2').hide();

            $('#newidtype2').val("").removeAttr('required')
            $('#newidtype2').attr('class', 'form-control')
            $('#newidnumber2').val("").removeAttr('required')
            $('#file2').val("").removeAttr('required')
        }

        if($(this).children(":selected").val() == $('#newidtype2').children(":selected").val()){
            $('#btnAddSenderBSP').prop('disabled',true)
            swal({
                title: 'DUPLICATE ID!',
                text: "Please choose a different secondary ID.",
                icon: 'warning',
                buttons: false,
            })
        } else {
            $('#btnAddSenderBSP').prop('disabled',false)
        }
    })

    $('#newidtype2').on('change', function(){
        if($(this).children(":selected").data('expiry') == "YES"){
            $('#divNewexpirydate2').show(200)
            $('#newexpirydate2').prop('required',true)
        }
        if($(this).children(":selected").data('expiry') == "NO"){
            $('#divNewexpirydate2').hide()
            $('#newexpirydate2').val("").removeAttr('required')
        }

        $('#newidnumber2').attr('pattern', $(this).children(":selected").data('regex'));

        if($(this).children(":selected").val() == $('#newidtype').children(":selected").val()){
            $('#btnAddSenderBSP').prop('disabled',true)
            swal({
                title: 'DUPLICATE ID!',
                text: "Please choose a different secondary ID.",
                icon: 'warning',
                buttons: false,
            })
        } else {
            $('#btnAddSenderBSP').prop('disabled',false)
        }
    })

    function updateSender(){
        var i1, i2, i3, i4, i5, i6, i7, i8, i9, i10, 
            i11, i12, i13, i14, i15, i16
            
        if($('#placeOfBirth').is(':visible')) {
            i1 = $('#inputBirthplace').val()
        }

        if($('#permanentAddress').is(':visible')) {
            i2 = $('#inputStreet2').val()
            i3 = $('#inputCountry2').val()
            if(i3 == 'PHILIPPINES'){
                i4 = $('#selBarangay2 option:selected').text();
                i5 = $('#selCity2 option:selected').text();
                i6 = $('#selProvince2 option:selected').text() + ', ' + $('#selRegion2 option:selected').text();
            }else{
                i4 = $('#inputBarangay2').val();
                i5 = $('#inputCity2').val();
                i6 = $('#inputProvince2').val();
            }
            
            i7 = $('#inputPostal2').val();
        }

        if($('#sourceOfFund').is(':visible')) {
            i8 = $('#inputSourceoffund').val();
        }

        if($('#step2').is(':visible')) {
            i9 = $('#newidtype').val();
            i10 = $('#newidnumber').val();
            i11 = $('#newexpirydate1').val();
            i12 = $('#file1').prop('files')[0];
            
            i13 = $('#newidtype2').val();
            i14 = $('#newidnumber2').val();
            i15 = $('#newexpirydate2').val();
            i16 = $('#file2').prop('files')[0];
        }
            i17 = $('#senderID').val();
        
        var formData = new FormData();
        
        formData.append('inputBirthplace', i1)
        formData.append('inputStreet2', i2)
        formData.append('inputBarangay2', i3)
        formData.append('inputCity2', i4)
        formData.append('inputProvince2', i5)
        formData.append('inputCountry2', i6)
        formData.append('inputPostal2', i7)
        formData.append('inputSourceoffund', i8)
        formData.append('newidtype', i9)
        formData.append('newidnumber', i10)
        formData.append('newexpirydate1', i11)
        formData.append('file1', i12)
        formData.append('newidtype2', i13)
        formData.append('newidnumber2', i14)
        formData.append('newexpirydate2', i15)
        formData.append('file2', i16)
        formData.append('senderID', i17)
        
        // waitingDialog.hide()
        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]); 
        // }

        var actionID;
        if(i12) {
            actionID = '/Ecash_send/updateSenderDealerID';
        } else {
            actionID = '/Ecash_send/updateSenderDealer';
        }
        $.ajax({
            url         : actionID,
            type        : 'POST',
            data        : formData,
            processData : false,
            contentType : false,
            success     : function (data) {
                var jsonData = JSON.parse(data);
                // console.log(jsonData)
                if(jsonData.S == 1){
                    swal({
                        title: 'SUCCESS!',
                        text: 'Updated Sender Details',
                        icon: 'success',
                        buttons: false,
                    })
                    $('#succesNotif').show();
                    $('#btnAddSenderBSP').prop('disabled',true)
                    location.reload();
                }else{
                    swal({
                        title: 'Oopps..',
                        text: jsonData.M,
                        icon: 'warning',
                        buttons: false,
                    })
                }
                waitingDialog.hide()

            }
        })
    }
</script>
