
<div id="autoquota_address_modal" class="modal fade" role="dialog">
    <div style="width:20%;" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                <h4 class="modal-title">ADDRESS</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div style="padding-bottom:5px;" class="row">
                        <label style="font-size: 80%;" for="Region">REGION<span style="color:red;">*</span></label><select class="form-control" name="Region" id="Region"><option value="" selected>SELECT REGION</option></select>
                    </div>
                    <div style="padding-bottom:5px;" class="row">
                        <label style="font-size: 80%;" for="Province">PROVINCE<span style="color:red;">*</span></label><select class="form-control" name="Province" id="Province"></select>
                    </div>
                    <div style="padding-bottom:5px;" class="row">
                        <label style="font-size: 80%;" for="Municipality">CITY/MUNICIPALITY<span style="color:red;">*</span></label><select class="form-control" name="Municipality" id="Municipality"></select>
                    </div>
                    <div style="padding-bottom:5px;" class="row">
                        <label style="font-size: 80%;" for="Barangay">BARANGAY<span style="color:red;">*</span></label><select class="form-control" name="Brgy" id="Brgy"></select>
                    </div>
                    <div style="padding-bottom:5px;" class="row">
                        <label style="font-size: 80%;" for="street">STREET<span style="color:red;">*</span></label><input type="text" class="form-control" name="street" id="street" required/>
                    </div>
                    <div class="row">
                        <div style="padding:unset; padding-right:5px;" class="col-md-8">
                            <label style="font-size: 80%;" for="barangay">UNIT # / HOUSE / BUILDING</label><input type="text" class="form-control" name="unit" id="unit" />
                        </div>
                        <div style="padding:unset;" class="col-md-4">
                            <label style="font-size: 80%;" for="zipcode">ZIP CODE<span style="color:red;">*</span></label><input type="number" class="form-control" name="zipcode" id="zipcode" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <center><button id="btn_save_address">SAVE</button></center>
            </div>
        </div>
    </div>
</div>