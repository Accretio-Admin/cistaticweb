<style>
    #hover:hover{
        background-color: #DEDEDE;
        border-radius: 15px;
    }
    .frame {
        width: 100%; 
        height: auto;
    }
    .frame span {
        height: 29px;
        width: 185.51px;
        font-weight: 600;
        font-size: 19px;
        line-height: 28px;
        font-family: 'Poppins';
        font-style: normal;
        align-items: center;
        color: #464B53;
        margin-bottom: auto;
        user-select: none;
    }
    ._price{
        width: 50%;
        height: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-end;
        text-align: right;
        cursor: pointer;
        padding: 6px 10px;
        font-size: 19px;
        line-height: 29px;
    }
    ._price123{
        width: 50%;
        height: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-end;
        text-align: left;
        cursor: pointer;
        padding: 6px 10px;
        font-size: 19px;
        line-height: 29px;
    }
    ._label{
        width: 50%;
         height: 100%;
         display: flex;
         align-items: center;
         padding: 6px 10px;
         line-height: 29px;
        
    }
    ._unionArrow{
        margin-bottom: 3px;
    }
    .availEarnings{
        margin-left: 10px;
        display: flex;
        width: 430px;
        height: 222px;
        align-items: flex-start;
        padding: 5px;
        border-radius: 20px;
        gap: 5px;
        background: linear-gradient(110.97deg, #F7F7F7 0%, #F2F2F2 100%);
        margin: 10px;
    }
    .availEarnings123{
        border-radius: 20px;
        background: linear-gradient(110.97deg, #F7F7F7 0%, #F2F2F2 100%);
        height: auto;
        width: 550px;
        top: 50%;
        position: absolute;
        left: 50%;
        transform: translate(-50%, 0%);
        padding: 10px;

    }
    .fBanner{
        display: flex;
        width: 420px;
        height: 90px;
        background: linear-gradient(86.92deg, #F3AE22 0%, #FFC755 100%), linear-gradient(167.96deg, #FFC914 33.85%, #FFB800 100%);
        border-radius: 15px;
        padding: 0px 15px;
        justify-content: space-between;
        align-items: flex-start;
    }
    .pBanner{
        width: 250px;
        height: 80px;
        font-family: 'Poppins';
        font-weight: 600;
        line-height: 15px;
        display: flex;
        color: #FFFFFF;
        text-shadow: 0px 2px 5px rgba(0, 0, 0, 0.22);
        flex-direction: column;
        margin-block: auto;
        padding-block: 20px;
    }
</style>

<div class="mainpanel">
    <div>
        
</div>
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-users"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>NETWORK</li>
                </ul>
                <h4>Network Dashboard</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
<div class="contentpanel"> 
            <!-- available earnings -->
            <div style = 'margin: auto; width: 100%;' id = 'content23'>

                <div style = 'flex-direction: row; display:flex;'>
                    <div class='availEarnings' style='flex-direction: column; height: auto;'>
                        <div class='fBanner'>
                            <div class='pBanner'>
                                <p style='font-size:22px;'>Available</p>
                                <p style='font-size:30px;'>Earnings</p>
                            </div>
                            <img src="/assets/images/available_earnings.png" style='width: 90px; height: 80px;'/>
                        </div>

                        <div class = 'frame' style='height:auto;'>

                            <div style='width: 100%; height: auto; display: flex; flex-direction: row;'>
                                <div class = '_label'>
                                    <span>Network Earnings</span>
                                </div>

                                <div class='_price' style = 'cursor: default;'>
                                    <span style='margin-right: 3px;'>P<?php echo $API['network_fund_avail'] ?></span>
                                    <!-- <img src="/assets/images/_greaterThanArrow.png" class = '_unionArrow' id = 'network_Earnings'/> -->
                                </div>
                            </div>

                            <div style='width: 100%; height: 30%; display: flex; flex-direction: row;'>
                                <div class = '_label'>
                                    <span>MLM Earnings</span>
                                </div>

                                <div class='_price' style = 'cursor: default;'>
                                    <span style='margin-right: 6px;'>P<?php echo $API['mlm_fund_avail'] ?></span>
                                    <!-- <img src="/assets/images/_greaterThanArrow.png" style= 'margin-bottom: -3px;'/> -->
                                </div>
                            </div>

                            <div style='width: 100%; height: 30%; display: flex; flex-direction: row;'>
                                <div class = '_label'>
                                    <span>GC</span>
                                </div>

                                <div class='_price' style = 'cursor: default;'>
                                    <span style='margin-right: 6px;'>P<?php echo $API['gc_avail'] ?></span>
                                    <!-- <img src="/assets/images/_greaterThanArrow.png" style= 'margin-bottom: -3px;'/> -->
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    <!-- end of available earnings -->

                    <!-- current earnings -->
                    <div class='availEarnings' style='flex-direction: column; height: auto;'>
                        <div class='fBanner'>
                            <div class='pBanner'>
                                <p style='font-size:22px;'>Current</p>
                                <p style='font-size:30px;'>Earnings</p>
                            </div>
                            <img src="/assets/images/current_earnings.png" style='width: 90px; height: 80px;'/>
                        </div>

                        <div class = 'frame'>

                            <div style='width: 100%; height: 30%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>Network Earnings</span>
                                </div>

                                <div class='_price toHide' data-value = 'network_earnings'>
                                    <span style='margin-right: 3px;'>P<?php echo $API['network_fund_current'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" class = '_unionArrow'/>
                                </div>
                            </div>

                            <div style='width: 100%; height: 30%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>MLM Earnings</span>
                                </div>

                                <div class='_price toHide' data-value = 'mlm_earnings'>
                                    <span style='margin-right: 6px;'>P<?php echo $API['mlm_fund_current'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" class = '_unionArrow'/>
                                </div>
                            </div>

                            <div style='width: 100%; height: 30%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>GC</span>
                                </div>

                                <div class='_price toHide' data-value = 'gc_earnings'>
                                    <span style='margin-right: 6px;'>P<?php echo $API['gc_current'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" class = '_unionArrow'/>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- bottom part -->
                <div style = 'flex-direction: row; display:flex; '>
                    <div class='availEarnings' style='height:300px; flex-direction: column;'>
                        <div class='fBanner'>
                            <div class='pBanner'>
                                <p style='font-size:22px;'>Today's</p>
                                <p style='font-size:30px;'>Earnings</p>
                            </div>
                            <img src="/assets/images/todays_earnings.png" style='width: 90px; height: 80px;'/>
                        </div>

                        <div class = 'frame' style='height: 70%;'>

                            <div style='width: 100%; height: 20%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>Match Sales</span>
                                </div>

                                <div class='_price toHide' data-value = 'match_sales'>
                                    <span style='margin-right: 3px;'>P<?php echo $API['ms_today'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" style='margin-bottom: 2px;'/>
                                </div>
                            </div>

                            <div style='width: 100%; height: 20%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>Direct Referrals</span>
                                </div>

                                <div class='_price toHide' data-value = 'direct'>
                                    <span style='margin-right: 6px;'>P<?php echo $API['dr_today'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" style='margin-bottom: 2px;'/>
                                </div>
                            </div>

                            <div style='width: 100%; height: 20%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>Indirect Referrals</span>
                                </div>

                                <div class='_price toHide' data-value = 'indirect'>
                                    <span style='margin-right: 6px;'>P<?php echo $API['ind_today'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" style='margin-bottom: 2px;'/>
                                </div>
                            </div>

                            <div style='width: 100%; height: 20%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>MLM</span>
                                </div>

                                <div class='_price toHide' data-value = 'mlm'>
                                    <span style='margin-right: 6px;'>P<?php echo $API['mlm_today'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" style='margin-bottom: 2px;'/>
                                </div>
                            </div>

                            <div style='width: 100%; height: 20%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>Unilevel</span>
                                </div>

                                <div class='_price toHide' data-value = 'unilevel'>
                                    <span style='margin-right: 6px;'>P<?php echo $API['unilevel'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" style='margin-bottom: 2px;'/>
                                </div>
                            </div>

                        </div>
                       
                    </div>

                    <div class='availEarnings' style='height:300px; flex-direction: column;'>
                        <div class='fBanner'>
                            <div class='pBanner'>
                                <p style='font-size:22px;'>Today's</p>
                                <p style='font-size:30px;'>Network Activity</p>
                            </div>
                            <img src="/assets/images/network_activities.png" style='width: 90px; height: 80px;'/>
                        </div>
                        <div class = 'frame' style='height: 70%;'>

                            <div style='width: 100%; height: 20%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>Downlines</span>
                                </div>

                                <div class='_price toHide' data-value = 'downline'>
                                    <span style='margin-right: 3px;'><?php echo $API['downlines'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" style='margin-bottom: 2px;'/>
                                </div>
                            </div>

                            <div style='width: 100%; height: 20%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>Directs</span>
                                </div>

                                <div class='_price toHide' data-value = 'directs'>
                                    <span style='margin-right: 6px;'><?php echo $API['directs'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" style='margin-bottom: 2px;'/>
                                </div>
                            </div>

                            <div style='width: 100%; height: 20%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>Hi5 Directs</span>
                                </div>

                                <div class='_price toHide' data-value = 'hi5directs'>
                                    <span style='margin-right: 6px;'><?php echo $API['hifive'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" style='margin-bottom: 2px;'/>
                                </div>
                            </div>

                            <div style='width: 100%; height: 20%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>Personal Purchase</span>
                                </div>

                                <div class='_price toHide' data-value = 'personal_purchase'>
                                    <span style='margin-right: 6px;'>P<?php echo $API['personal_purchase'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" style='margin-bottom: 2px;'/>
                                </div>
                            </div>

                            <div style='width: 100%; height: 20%; display: flex; flex-direction: row;' id='hover'>
                                <div class = '_label'>
                                    <span>Groups Sales</span>
                                </div>

                                <div class='_price toHide' data-value = 'group_sales'>
                                    <span style='margin-right: 6px;'>P<?php echo $API['group_sales'] ?></span>
                                    <img src="/assets/images/_greaterThanArrow.png" style='margin-bottom: 2px;'/>
                                </div>
                            </div>

                        </div>
    
                    </div>
                </div>
                <!-- end bottom part -->
            </div>
            <!-- style='height: auto; width: 550px; border-color: red; border-style: solid; top: 50%; position: absolute;left: 50%; transform: translate(-50%, 0%);' -->
            <div  id = 'jepoy' class ='_toShow availEarnings123' style='background: #F4F4F4;' hidden>
                <button id = 'btnBack' style='font-size: 30px; border:none;background-color: #F4F4F4;'><img src = '/assets/images/_btnBack.png' style = 'height: 70px; width: 75%;'></button>
                
                <div id = '_map'>
                    
                </div>

            </div>



        </div>
    </div>
</div>


<script>

    $(document).ready(function() {

        $('.toHide').click(function(){
            
            
            waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
            var action = $(this).data('value');
            // alert(action);

            var formData = new FormData();

            formData.append('action', action);
            
                            
            $.ajax({
                url         : '/Network/fetching_Earnings',
                type        : 'POST',
                data        : formData,
                processData : false,
                contentType : false,
                success     : function (data) { 
                        var jsonData = JSON.parse(data);
console.log("array123",jsonData)
                        if(jsonData.S == 0){   
                            alert(jsonData.M)
                        }else{
                            $('#content23').slideUp();
                            $('._toShow').attr('hidden', false);

                            var arr = Object.keys(jsonData);
                            document.getElementById("_map").innerHTML = "";
                            for(var value of arr) {
                                if(value != "regcode") {
                                   console.log("qwqweqew",value)
                                    $('#_map').append($('<div>', {
                                        id: value,
                                        value: value,
                                    }));
                                    $('#'+value).attr("style","display:flex; flex-direction:row; width: 100%;");
                                    // $('#'+value).text(jsonData[value])
                                    $('#'+ value).append($('<input>', {
                                        type: 'text',
                                        disabled: true,
                                        id: value+"0",
                                        value: value
                                    }));
                                    $('#'+ value).append($('<input>', {
                                        type: 'text',
                                        disabled: true,
                                        id: value+"1",
                                        value: jsonData[value]
                                    }));
                                    $(`#${value}0,#${value}1`).attr("style","width: 50%; border:none");
                                    $(`#${value}0`).attr('class', '_price123');
                                    $(`#${value}1`).attr("class","_price");
                                    

                                }
                            }   
                        }
                        waitingDialog.hide()
                }
            });
        });

    });

    $('#btnBack').click(function (){
        $('#content23').slideDown();
        $('._toShow').attr('hidden', true);

    })

</script>