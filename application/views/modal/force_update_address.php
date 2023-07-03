<?php if($_SESSION['force_update_address'] == '1'):?>
    <div id="force_update_address_modal" class="modal fade" role="dialog" data-backdrop="false" data-keyboard="false" href="#">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:orange; border-top-left-radius:5px; border-top-right-radius:5px;">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button> -->
                    <h4 class="modal-title">UPDATE ADDRESS</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div style="padding-bottom:5px;" class="row">
                            <label style="font-size: 80%;" for="Region">REGION<span style="color:red;">*</span></label><select class="form-control" name="F_Region" id="F_Region"><option value="" selected>SELECT REGION</option></select>
                        </div>
                        <div style="padding-bottom:5px;" class="row">
                            <label style="font-size: 80%;" for="Province">PROVINCE<span style="color:red;">*</span></label><select class="form-control" name="F_Province" id="F_Province"></select>
                        </div>
                        <div style="padding-bottom:5px;" class="row">
                            <label style="font-size: 80%;" for="Municipality">CITY/MUNICIPALITY<span style="color:red;">*</span></label><select class="form-control" name="F_Municipality" id="F_Municipality"></select>
                        </div>
                        <div style="padding-bottom:5px;" class="row">
                            <label style="font-size: 80%;" for="Barangay">BARANGAY<span style="color:red;">*</span></label><select class="form-control" name="F_Brgy" id="F_Brgy"></select>
                        </div>
                        <div style="padding-bottom:5px;" class="row">
                            <label style="font-size: 80%;" for="street">STREET<span style="color:red;">*</span></label><input type="text" class="form-control" name="F_street" id="F_street" required/>
                        </div>
                        <div class="row">
                            <div style="padding:unset; padding-right:5px;" class="col-md-8">
                                <label style="font-size: 80%;" for="barangay">UNIT # / HOUSE / BUILDING</label><input type="text" class="form-control" name="F_unit" id="F_unit" />
                            </div>
                            <div style="padding:unset;" class="col-md-4">
                                <label style="font-size: 80%;" for="zipcode">ZIP CODE<span style="color:red;">*</span></label><input type="number" class="form-control" name="F_zipcode" id="F_zipcode" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-id="<?php echo $_SESSION['usersettingid'];?>" id="f_btn_save_address">SAVE</button>
                </div>
            </div>
        </div>
    </div>
<?php endif ;?>

<script>
    $(function(){
        $('#modalAnnouncementsframe').on('hide.bs.modal', function(){
            let force_update_address = '<?php echo $_SESSION['force_update_address'];?>';
            if(force_update_address === '1')
            {
                $.alert('Please update Delivery Address and Autoquota Settings');
            }
            $('#force_update_address_modal').modal('show');
            $('#usersLocationUpdate').modal({show:true});
        });
        
        let Source="https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/master/philippine_provinces_cities_municipalities_and_barangays_2019v2.json";
        let PhilAddress;
        $.get(Source,data=>{
            PhilAddress=JSON.parse(data);
            let NewAddress = new ForceUpdateAddressForm(PhilAddress,"F_Region","F_Province","F_Municipality","F_Brgy");
            NewAddress.Build();
            $('#F_street').val();
            $('#F_unit').val();
            $('#F_zipcode').val();
        });

        $('#f_btn_save_address').on('click', function(){
            let usersetting_id = $('#f_btn_save_address').data('id');
            let i_region = $('#F_Region :selected').val();
            let i_province = $('#F_Province :selected').val();
            let i_municipality = $('#F_Municipality :selected').val();
            let i_barangay = $('#F_Brgy :selected').val();
            let i_street = $('#F_street').val();
            let i_unit = $('#F_unit').val();
            let i_zipcode = $('#F_zipcode').val();

            if(i_region === '' || i_province === '' || i_municipality === '' || i_barangay === '' || i_street === '' || i_zipcode === '')
            {
                $.alert('Please complete all required(*) fields.');
                return false;
            }
            else
            {
                $.ajax({
                    url: aqpath + '/save_auto_quota_address_setting',
                    type: 'POST',
                    datatype: 'JSON',
                    data: {
                        usersetting_id  : usersetting_id,
                        i_region        : i_region,
                        i_province      : i_province,
                        i_city          : i_municipality,
                        i_barangay      : i_barangay,
                        i_street        : i_street,
                        i_unit          : i_unit,
                        i_zipcode       : i_zipcode
                    },
                    success: function(response){
                        $.alert('Save Successfully!');
                        $('#force_update_address_modal').modal('hide');
                        
                         let has_package = '<?php echo $_SESSION['has_package'];?>';

                        if(has_package === '')
                        {
                            $('#autoquota_modal').modal('show');
                        }
                    },
                    fail: function(){

                    }
                });
            }
        });
    });

    class ForceUpdateAddressForm{
        constructor(PhilAddress,F_Region,F_Province,F_Municipality,F_Brgy) {
            this.F_Region = F_Region;
            this.F_Province = F_Province;
            this.F_Municipality= F_Municipality;
            this.F_Brgy= F_Brgy;
            this.PhilAddress=PhilAddress;
        }
        RegionID;
        Build=()=>{
            const {F_Region,F_Province,ProvinceList,MunicipalityList,BrgyList,GetRegionID,RegionList,F_Municipality,F_Brgy,RegionID}=this;
            $('#F_AddressForm').html('');
            //|=====================================| Building |=======================================|//
            $(`#${F_Region}`).attr("list",`Address${F_Region}List`);
            $(`#${F_Region}`).attr("placeholder", `Region`);
            $('#F_AddressForm').append(`<datalist id="Address${F_Region}List"></datalist>`);
            
            $(`#${F_Province}`).attr("list", `Address${F_Province}List`);
            $(`#${F_Province}`).attr("placeholder", `Province`);
            $(`#${F_Province}`).attr("readonly", true);
            $('#F_AddressForm').append(`<datalist id="Address${F_Province}List"></datalist>`);

            $(`#${F_Municipality}`).attr("list", `Address${F_Municipality}List`);
            $(`#${F_Municipality}`).attr("placeholder", `Municipality`);
            $(`#${F_Municipality}`).attr("readonly", true);
            $('#F_AddressForm').append(`<datalist id="Address${F_Municipality}List"></datalist>`);

            $(`#${F_Brgy}`).attr("list", `Address${F_Brgy}List`);
            $(`#${F_Brgy}`).attr("placeholder", `Barangay`);
            $(`#${F_Brgy}`).attr("readonly", true);
            $('#F_AddressForm').append(`<datalist id="Address${F_Brgy}List"></datalist>`);
            $('input:reset').click(()=>{
                console.log('reset');
                $(`#Address${F_Province}List`).html('');
                $(`#Address${F_Municipality}List`).html('');
                $(`#Address${F_Brgy}List`).html('');
                $(`#${F_Province}`).val('');
                $(`#${F_Municipality}`).val('');
                $(`#${F_Brgy}`).val('');
                $(`#${F_Province}`).attr("readonly", true);
                $(`#${F_Municipality}`).attr("readonly", true);
                $(`#${F_Brgy}`).attr("readonly", true);
            })
            //|=====================================| Action |==========================================|//
            let RegionItem=this.RegionList();
            RegionItem.map(data=>$(`#Address${F_Region}List`).append(`<option value="${data.name}">${data.name}`));
            RegionItem.map(data=>$(`#F_Region`).append(`<option value="${data.name}">${data.name}`));
            $(`#${F_Region}`).change(()=>{
                $(`#Address${F_Province}List`).html('');
                $(`#Address${F_Municipality}List`).html('');
                $(`#Address${F_Brgy}List`).html('');
                // $(`#${Province}`).val('');
                // $(`#${Municipality}`).val('');
                // $(`#${Brgy}`).val('');
                $(`#${F_Province}`).empty();
                $(`#${F_Municipality}`).empty();
                $(`#${F_Brgy}`).empty();
                try{
                    ProvinceList().map(data=>$(`#Address${F_Province}List`).append(`<option value="${data}">${data}`));
                    $(`#F_Province`).append(`<option value="">SELECT PROVINCE`);
                    ProvinceList().map(data=>$(`#F_Province`).append(`<option value="${data}">${data}`));
                    $(`#${F_Province}`).attr("readonly", false);
                    $(`#${F_Municipality}`).attr("readonly", true);
                    $(`#${F_Brgy}`).attr("readonly", true);
                }catch(e){}
                
            })
            $(`#${F_Province}`).change(()=>{
                $(`#Address${F_Municipality}List`).html('');
                $(`#Address${F_Brgy}List`).html('');
                // $(`#${Municipality}`).val('');
                // $(`#${Brgy}`).val('');
                $(`#${F_Municipality}`).empty();
                $(`#${F_Brgy}`).empty();
                try{
                    MunicipalityList().map(data=>$(`#Address${F_Municipality}List`).append(`<option value="${data}">${data}`));
                    $(`#F_Municipality`).append(`<option value="">SELECT MUNICIPALITY`);
                    MunicipalityList().map(data=>$(`#F_Municipality`).append(`<option value="${data}">${data}`));
                    $(`#${F_Municipality}`).attr("readonly", false);
                    $(`#${F_Brgy}`).attr("readonly", true);
                }catch(e){}
            })
            $(`#${F_Municipality}`).change(()=>{
                $(`#Address${F_Brgy}List`).html('');
                // $(`#${Brgy}`).val('');
                $(`#${F_Brgy}`).empty();
                try{
                    BrgyList($(`#${F_Municipality}`).val()).map(data=>$(`#Address${F_Brgy}List`).append(`<option value="${data}">${data}`));
                    $(`#F_Brgy`).append(`<option value="">SELECT BARANGAY`);
                    BrgyList($(`#${F_Municipality}`).val()).map(data=>$(`#F_Brgy`).append(`<option value="${data}">${data}`));
                    $(`#${F_Brgy}`).attr("readonly", false);
                }catch(e){}
            })
        }
        RegionList=()=>{
            let result=[]
            const {PhilAddress}=this;
            for(let reg in PhilAddress){
                result.push({id:reg,name:PhilAddress[reg].region_name});
            }
            return result;
        }
        GetRegionID=()=>{
            let idx=this.GetIndex(this.RegionList(),{name:$(`#${this.F_Region}`).val()},1);
            this.RegionID=this.RegionList()[idx].id;
            return this.RegionID;
        }
        ProvinceList=()=>Object.keys(this.PhilAddress[this.GetRegionID()].province_list)
        MunicipalityList=()=>Object.keys(
            this.PhilAddress[this.RegionID]
            .province_list[$(`#${this.F_Province}`).val().toUpperCase()]
            .municipality_list
        );
        BrgyList=()=>this.PhilAddress[this.RegionID]
            .province_list[$(`#${this.F_Province}`).val().toUpperCase()]
            .municipality_list[$(`#${this.F_Municipality}`).val().toUpperCase()].barangay_list;    
        GetIndex=(data,item,sensitivity)=>{
            var type=typeof item,x,y,result=false,xresult,sensitivity=sensitivity||0,ctr;
            if(Array.isArray(data) && data.length>0){
            if(type=="object"){
                if(Array.isArray(item))type="array";
            }
            switch(type){
                case 'array':
                    result=[];
                    for(x in item){
                    result.push(data.indexOf(item[x]));
                    }
                break;
                case 'object':
                var position=0;
                for(x in data){position++;
                    xresult=false,ctr=0;
                    for(y in Object.keys(item)){ctr++;
                        try{
                        if(sensitivity)    
                                result=data[x][Object.keys(item)[y]] && data[x][Object.keys(item)[y]].toLowerCase()
                                ==item[Object.keys(item)[y]].toLowerCase() || data[x][Object.keys(item)[y]]=='All';
                        else    result=data[x][Object.keys(item)[y]] && data[x][Object.keys(item)[y]].toLowerCase()
                                ==item[Object.keys(item)[y]].toLowerCase() || data[x][Object.keys(item)[y]]=='All';
                        if(!result && Object.keys(item).length>ctr)break;
                        if(result && Object.keys(item).length==ctr)xresult=true;
                        }catch(e){}
                    }
                    if(xresult)break;
                }
                if(xresult)result=position-1;
                else result=xresult;
                break;
                default:
                    if(sensitivity){
                    data=data.map(item=>item.toLowerCase());
                    result=data.indexOf(item.toLowerCase());
                    }else{
                    result=data.indexOf(item);
                    }
                }
            }
            return result;
        }
        
    }
</script>
