<?php
//update by nhez 03/21/2017
  /*  $userfunds = $this->Sp_model->userfunds(); 
    if($userfunds['S'] == 1){
      $this->user['EC'] = $userfunds['EC'];
      $this->user['PB'] = $userfunds['PB'];
      $this->user['SB'] = $userfunds['SB'];
      $this->user['AB'] = $userfunds['AB'];
      $this->session->set_userdata('user',$this->user);
    }*/
?>    


    <style type="text/css">
        .Switch{height:28px; font-size:80%; font-weight:bold; cursor:pointer; }
        .Switch{border:1px solid white; padding:5px;width:40px; display:none; text-align:center; }
        .Bar{height:28px; font-size:80%;  font-weight:bold; cursor:pointer; border:1px solid white; padding:5px;display:none; }
        .Bar{width:250px; background-color:rgba(245,245,245); text-align:right }
        .ProgressBar{background-image: linear-gradient(to right, white, lightgreen, lightgreen, green);  }
        .ProgressBar{margin-left:-398px;  }
        .BarDetails{display:none;width:140px;font-size:80%;  font-weight:bold; padding:5px; border:1px solid white; text-align:center;  }
        .BarDetailsp{display:none;width:220px;font-size:80%;  font-weight:bold; padding:5px; border:1px solid white; text-align:center;  }
        .labelPV{font-size:80%;font-weight:bold; color: black;}
        .progress {position:relative;}
        .progress-value {position:absolute;right:0; left:0;z-index:2;text-align:center; width:100%;height:100%;}
        .headerwrapper .header-right .btn-group .dropdown-menu:after {border-bottom: none;} /*removing dropdown arrow*/
        .labelWealthy{font-size:80%;font-weight:bold; color: #fff;}

        <?php if (substr($user['R'],0,3) == 'GRM' || $user['R'] == 'F5880126' || $user['R'] == 'F9175006' || $user['R'] == 'G7979485' || $user['R'] == 'F1205575' || $user['R'] == 'F1145677' || $user['R'] == 'F1164754' || $user['R'] == 'F1198933' || $user['R'] == 'F3989172'): ?>
            .headerwrapper { background-color: green !important; }
        <?php elseif (substr($user['R'],0,3) == 'GWL' || substr($user['R'],0,3) == 'DWL' || $user['R'] == 'GWL0987'): ?>
            .headerwrapper { background-color: #4ca8de !important; }
            .headerwrapper .header-right .btn-group .btn .badge { background-color: #0980c7; }
            .leftpanel .nav > li > a i { color: #4ca8de; }
        <?php endif; ?>
    </style>

    <script>
    $(document).ready(function(){
        CallTurn('Get');
        CallWealthyLifestyle('Get');
        // CallLeadership();
    });
    var aqpath='<?php echo BASE_URL().'Main'?>',rank=1;
    const Turn=(Obj)=>{
        var auto_quota=1;
        if(Obj.innerHTML=='OFF')auto_quota=0;
        if(rank>1){
            CallTurn('Update',auto_quota);
            // CallLeadership();
        }
        else 
            //CallSwitch(auto_quota);
            CallTurn('Update',auto_quota);
            // CallLeadership();
            //turnNote('Switch is disabled to this rank');
    }
    //|----------------------| Note |---------------------------|//
    const turnNote=(Msg,Time)=>{
        var obj=$('#Notif'),str='',Time=Time||9000;
        str=Msg;
        obj.finish();
        obj.html('').css({"height":"15px","width":"0px","opacity":"1"});
        obj.html(str);
        obj.animate({"width":"200px"},1000);
        obj.animate({"opacity":"0"},Time);
        obj.animate({"width":"0px"});
        obj.animate({"height":"0px"},function(){
            obj.html('');
        });
        
    }
    
    
    // MADE BY PABLOOOOOOOOOOOOO
    // function CallLeadership(){
    //   $.ajax({
    //   type: 'POST',
    //   url: `/Main/pabloDiamond`,
    //   success: function (data) {
    //     waitingDialog.hide();
    //     var resp = JSON.parse(data);
    //     // console.log("test");
    //     // console.log(resp);
    //     $('#pabloDiamond').css({"display":"inline-block"});

    //     if(resp.points === null){
    //       var points = 0.00;
    //     }else{
    //       var points = resp.points;
    //     }
        
    //     var strp= "Leadership Quota: "+Number(points).toFixed(2)+' / '+Number(resp.target).toFixed(2);
    //                 $('#pabloDiamond').html(strp);
        
        
    //     // // $("#messageTranspass").append(res.TN);
    //     // $("#messageTransno").text(res.TN);

    //   },
    //   error: function (data) {
    //     console.log(data)
    //   }
    // });
    // }

    // MADE BY PABLOOOOOOOOOOOOO
    // Updated By Kenneth O. 03-01-2021
    //|----------------------| GetGC |--------------------------|//
    const CallTurn=(Task,val)=>{
        val=val||'';
        $.ajax({
            data:JSON.parse('{"auto_quota":"'+val+'","Task":"'+Task+'"}'),
            type:'post',
            url: aqpath+'/AutoQuota', 
            beforeSend:function(){
                if(Task=='Update')turnNote('Changing Auto Quota Status');
            },
            success: function(result){
                var res=JSON.parse(result);//console.log(res);
                
                if(res[0].Found==1 && res[0].Rank>=1){                                  //| Change Rank to View Auto Quota
                    var rank=res[0].Rank;
                    var accumulated=res[0].accumulated;
                    var turn=document.getElementsByClassName('Switch'),clr='white',x,w=250,percent=100;

                    load_package(rank);

                    var sz=turn.length;
                    w=(res[0].Current/res[0].Target)*w;
                    if(w>250)w=250;
                    for(x=0;x<sz;x++){
                        clr='white';
                        turn.item(x).style.color="black";
                        if(res[0].Status==1 && x==0)clr='lightgreen'; 
                        if(res[0].Status==0 && x==1){
                            turn.item(x).style.color="black";
                            clr='lightpink';
                        } 
                        turn.item(x).style.backgroundColor=clr;
                        turn.item(x).style.display="inline-block";
                        
                    }

                    if(rank === '1')
                    {
                        var targetPV = '800.00';
                        var w = Number((accumulated/targetPV)*60);
                        var display = Number(accumulated).toFixed(2) + ' / ' + targetPV;
                        $('#totalPV').text(display);
                        $('#currentRank').text('DISTRIBUTOR');
                        $('#setting_currentRank').text('DISTRIBUTOR');
                        $('#setting_currentRank').attr('data-rank',rank);
                        $('#nextRank').text('BRONZE');
                        $('#nextRank').css({"font-size":"80%"});
                        $('#percentPV').css({"width":w+"%"});
                        $('.currentRank').css({"background-color":"#CDF0BC"});
                        $('.nextRank').css({"background-color":"#CD7F32"});
                    }else if(rank === '2')
                    {
                        var targetPV = '1600.00';
                        var w = Number((accumulated/targetPV)*60);
                        var display = Number(accumulated).toFixed(2) + ' / ' + targetPV;
                        $('#totalPV').text(display);
                        $('#currentRank').text('BRONZE');
                        $('#setting_currentRank').text('BRONZE');
                        $('#setting_currentRank').attr('data-rank',rank);
                        $('#nextRank').text('SILVER');
                        $('#nextRank').css({"font-size":"80%"});
                        $('#percentPV').css({"width":w+"%"});
                        $('.currentRank').css({"background-color":"#CD7F32"});
                        $('.nextRank').css({"background-color":"#C0C0C0"});
                    }else if(rank === '3')
                    {
                        var targetPV = '3200.00';
                        var w = Number((accumulated/targetPV)*60);
                        var display = Number(accumulated).toFixed(2) + ' / ' + targetPV;
                        $('#totalPV').text(display);
                        $('#currentRank').text('SILVER');
                        $('#setting_currentRank').text('SILVER');
                        $('#setting_currentRank').attr('data-rank',rank);
                        $('#nextRank').text('GOLD');
                        $('#nextRank').css({"font-size":"80%"});
                        $('#percentPV').css({"width":w+"%"});
                        $('.currentRank').css({"background-color":"#C0C0C0"});
                        $('.nextRank').css({"background-color":"#FFD700"});
                    }else if(rank === '4')
                    {
                        var targetPV = '6400.00';
                        var w = Number((accumulated/targetPV)*60);
                        var display = Number(accumulated).toFixed(2) + ' / ' + targetPV;
                        $('#totalPV').text(display);
                        $('#currentRank').text('GOLD');
                        $('#setting_currentRank').text('GOLD');
                        $('#setting_currentRank').attr('data-rank',rank);
                        $('#nextRank').text('DIAMOND');
                        $('#nextRank').css({"font-size":"80%"});
                        $('#percentPV').css({"width":w+"%"});
                        $('.currentRank').css({"background-color":"#FFD700"});
                        $('.nextRank').css({"background-color":"#B9F2FF"});
                    }else if(rank === '5')
                    {
                        var w = 60;
                        var display = 'Total PV Points: ' + Number(accumulated).toFixed(2);
                        $('#totalPV').text(display);
                        $('#currentRank').text('DIAMOND');
                        $('#setting_currentRank').text('DIAMOND');
                        $('#setting_currentRank').attr('data-rank',rank);
                        $('#nextRank').text('');
                        $('#nextRank').addClass('fa fa-diamond');
                        $('#percentPV').css({"width":w+"%"});
                        $('.currentRank').css({"background-color":"#B9F2FF"});
                        $('.nextRank').css({"background-color":"#B9F2FF"});
                    }else
                    {
                        $('#currentRank').text('-');
                        $('#setting_currentRank').text('-');
                        $('#nextRank').text('-');
                    }

                    $('#lblAQ').css("display","inline-block");
                    var personalQ = (res[0].Current / res[0].Target)*100;
                    $('.percentPersonalQuota').css({"width":personalQ+"%"});
                    $('#personalQuota').text(Number(res[0].Current).toFixed(2) + ' / ' + Number(res[0].Target).toFixed(2));
                    if(res[0].leaderpoints === '0.00' && res[0].leaderquota === '0.00')
                    {
                        var leadlQ = 0;
                    }
                    else
                    {
                        var leadlQ = (res[0].leaderpoints / res[0].leaderquota)*100;
                    }
                    $('.percentLeadQuota').css({"width":leadlQ+"%"});
                    $('#leadQuota').text(Number(res[0].leaderpoints).toFixed(2) + ' / ' + Number(res[0].leaderquota).toFixed(2));
                    $('#directDiamond').text(res[0].direct);

                    // var leaderpoints_test = 321;
                    // var leaderquota_test = 1000;
                    // var direct_test = 5;

                    // var leadQ_test = (leaderpoints_test / leaderquota_test)*100;
                    // $('.percentLeadQuota').css({"width":leadQ_test+"%"});
                    // $('#leadQuota').text(Number(leaderpoints_test).toFixed(2) + ' / ' + Number(leaderquota_test).toFixed(2));
                    // $('#directDiamond').text(direct_test);
                    // $('#ProgressBar').css("display","none").attr("Title","Target PV : "+Number(res[0].Target).toFixed(2));
                    // $('#ProgressBar2').css({"display":"none","width":w+"px"}).attr("Title","Current PV : "+Number(res[0].Current).toFixed(2));
                    // $('#ProgressDetails').css({"display":"inline-block"});
                    // if(res[0].Target>0)percent=((res[0].Current/res[0].Target)*100).toFixed(2);
                    // var str='<span style="background-color: white; border:1px solid lightgreen;padding:3px">\
                    //          '+percent+'%</span>&nbsp;&nbsp;\
                    //          '+Number(res[0].Current).toFixed(2)+' / '+Number(res[0].Target).toFixed(2);
                    // $('#ProgressDetails').html(str);
                    if(Task=='Update')turnNote('Auto Quota Successfully Updated');
                }
            }
        });
    }
    //|----------------------| Call Switch |--------------------|//	
    const CallWealthyLifestyle = (Rank) => {
        $.ajax({
            type: "POST",
            url: "/Main/getRanking",
            data: {},
            success: function(result) {

                var jsonData = JSON.parse(result)
                console.log(jsonData)

                if(jsonData.S == 1) {

                    console.log(jsonData)

                    var userRankNum = jsonData.D.accumulated_pairs;
                    var userRank = jsonData.D.description;
                    var userPairingLimit = jsonData.D.pairing_limit;
                    var userNextRank = jsonData.D.next_rank;

                    console.log(userRankNum)

                    if (userRankNum != "" ) {  
                    
                        var display = 'Rank ' + userRankNum;
                        var accnumDaily = 18000;
                        var displayDaily = '₱' + accnumDaily + '/₱' + userPairingLimit;
                        var progressRank = Number(rank * 5);
                        var progressDaily = Number(accnumDaily * 5);
                   

                        $('#rank_labelPVWL').text(display);
                        $('#rank_totalPVWL').text(display);
                        $('#rank_currentRankWL').text(userRank);
                        $('#rank_nextRankWL').text(userNextRank);
                        $('#rank_percentPVWL').css({"width": (progressRank * 5) +"%"});
                        // $('#rank_labelWealthy').text('Rank ' + userRankNum + '-' + 10);

                    } else {
                        $('#currentRankWL').text('-');
                        $('#nextRankWL').text('-');
                    }
                } else {
                    alert(jsonData.M)
                }
            }
        });
    }

    const CallSwitch=(Status)=>{
        var turn=document.getElementsByClassName('Switch'),clr='white';
        var sz=turn.length;
        for(x=0;x<sz;x++){
            clr='white';
            turn.item(x).style.color="black";
            if(Status==1 && x==0)clr='lightgreen'; 
            if(Status==0 && x==1){
                turn.item(x).style.color="white";
                clr='red';
            } 
            turn.item(x).style.backgroundColor=clr;
            turn.item(x).style.display="inline-block";
        }
    }
    //|---------------------------------------------------------|//
    </script>
    <header>
        <div class="headerwrapper" >
            <div class="header-left">
                <a href="/Main" class="logo">
                
                <?php if ($user['CG'] == 'UPS'): ?>
                    <?php if (
                            (is_array($user) && isset($user['R']) && substr($user['R'], 0, 3) == 'GRM') ||
                            (is_array($API) && isset($API['R']) && $API['R'] == 'F5880126') ||
                            (is_array($user) && isset($user['R']) && in_array($user['R'], ['F9175006', 'G7979485', 'F1205575', 'F1145677', 'F1164754', 'F1198933', 'F3989172']))
                        ): ?>
                        <img src="<?php echo BASE_URL()?>assets/images/ricemart-logo.png" width="145" height="auto" alt="" />                   
                    <?php elseif (substr($user['R'],0,3) == 'GWL' || substr($user['R'],0,3) == 'DWL'):?>
                        <img src="<?php echo BASE_URL()?>assets/images/logo2.png" width="50" height="auto" alt="" />
                    <?php else: ?>
                        <img src="<?php echo BASE_URL()?>assets/images/ups.png" width="50" height="auto" alt="" />
                    
                    <?php endif ?>
                <?php else: ?>
                    <img src="<?php echo BASE_URL()?>assets/images/GPRS.png" width="50" height="auto" alt="" />
                <?php endif ?>
                    
                </a>
                <div class="pull-right">
                    <a href="#" class="menu-collapse">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
            </div><!-- header-left -->

            
            <div class="header-right">
                <div class="dropdown btn-group btn-group-option">
                    <button type="button" class="btn btn-success btn-xs dropdown-toggle" id="menu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        PV PROGRESS <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="menu1" style=" background-color: #f9c000;width: 500px;border: 0 !important;padding: 20px;border-radius: 10px;padding-top: 10px;box-shadow: 0px 0px 5px rgb(57 63 72 / 40%);">
                        <div class="form-group">
                            <label class="labelPV" for="currentRank">RANK PROGRESS</label>
                            <div id="progressPV" style="border-radius: unset;" class="progress">
                                <div class="progress-bar currentRank" style="width: 20%; background-color: white;"><span id="currentRank" style="font-size:80%;color:black;font-weight: 600;">-</span></div>
                                <span id="totalPV" class="progress-value" style="font-size:80%; font-weight:bold;">0.00</span><div id="percentPV" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar"></div>
                                <div class="progress-bar nextRank" style="width: 20%; background-color: white; float: right;"><span id="nextRank" style="color:black;font-weight: 600;">-</span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="labelPV" for="leadQuota">LEADERSHIP QUOTA</label>
                            <label class="labelPV pull-right" for="leadQuota">TOTAL DIRECT DIAMOND: <span id="directDiamond"></span></label>
                            <div id="progressPV" style="border-radius: unset;" class="progress">
                            <span id="leadQuota" class="progress-value" style="font-size:80%; font-weight:bold;">0.00</span><div class="progress-bar progress-bar-danger percentLeadQuota progress-bar-striped active" style="width: 30%;"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="labelPV" for="persontalQuota">PERSONAL QUOTA</label>
                            <div id="progressPV" style="border-radius: unset;" class="progress">
                            <span id="personalQuota" class="progress-value" style="font-size:80%; font-weight:bold;">0.00</span><div class="progress-bar progress-bar-success percentPersonalQuota progress-bar-striped active"></div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <?php if ($user['R'] != "BDO00001") { ?>
                    <div class="dropdown btn-group btn-group-option">
                        <button type="button" class="btn btn-success btn-xs dropdown-toggle" id="autoquota_setting" data-target="#autoquota_modal" data-toggle="modal" aria-haspopup="true" aria-expanded="true">
                        AUTO QUOTA <i class="fa fa-gear"></i>
                        </button>
                    </div>

                    <div class="auto_quota_setting">
                        <!-- modal for auto quota -->
                        <div  id="autoquota_modal" class="modal fade" role="dialog" data-backdrop="false" data-keyboard="false" href="#">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                        <h4 class="modal-title">AUTO QUOTA SETTINGS</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span style="font-size:80%; font-weight:bold; display:none;margin-top:10px;" id="lblAQ">AUTO QUOTA SWITCH : </span>
                                                <span class="Switch" title="Auto Quota Switch" style="border: solid 1px black;" onclick="Turn(this)">ON</span><span class="Switch" style="border: solid 1px black;" title="Auto Quota Switch" onclick="Turn(this)">OFF</span>
                                                <!-- <span style="font-size:80%; font-weight:bold; text-overflow: ellipsis; display:inline-block" id="Notif"></span> -->
                                            </div>
                                            <div class="col-md-2">
                                                <a href="<?php echo BASE_URL()?>Network/quota_report" style="margin-top:4px;font-size:10px;" type="button" class="btn btn-xs btn-primary">QUOTA REPORT</a>
                                            </div>
                                            <div class="col-md-5">
                                                <span style="font-size:80%; font-weight:bold;display:inline-block;margin-top:10px;" class="pull-right">CURRENT QUOTA POINTS : <?php echo number_format($_SESSION['quota_points'],2,'.','')?></span>
                                            </div>
                                        </div>
                                        <hr />
                                        <div style="background-color:#ffdd99; border:solid 1px black; border-radius: 5px;padding: 20px;margin-bottom: 10px;">
                                        <div style="all:unset;margin-top: 5px;"><label for="setting_currentRank">RANK: <span data-rank="" id="setting_currentRank" style="background-color:white; border:solid 1px black;padding: 0 2px">-</span></label></div>
                                            <div style="height:150px;overflow-y:scroll;overflow-x:hidden;" class="package-inclusion">
                                            </div>
                                        </div>
                                        <div class="autoquota_modalpart">
                                            <!-- load autoquota_modalpart -->
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="auto_quota_setting_address">
                        <!-- modal for auto quota address-->
                        <?php $this->load->view('modal/autoquota_address_modal');?>
                    </div>
                   
                <?php } ?>
                
                <?php if (substr($user['R'],0,3) == 'GWL' || substr($user['R'],0,3) == 'DWL' || $user['R'] == "F5033230" || $user['R'] == "1234567") { ?>
                    <div class="dropdown btn-group btn-group-option">
                        <button type="button" class="btn btn-success btn-xs dropdown-toggle" id="menu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            WEALTHY LIFESTYLE <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="menu1" style="background: linear-gradient(to right, #4ca8de, #9de1f1); width: 500px;border: 0 !important;padding: 20px;border-radius: 10px;padding-top: 10px;box-shadow: 0px 0px 5px rgb(57 63 72 / 40%);">
                             <!-- rank -->
                            <div class="form-group">
                                <label id="rank_labelPVWL" class="rank_labelPVWL" for="currentRank"></label>
                                <div id="progressPV" style="border-radius: unset;" class="progress">
                                    <div class="progress-bar" style="width: 20%; background-color: #06ac5f !important;">
                                        <span id="rank_currentRankWL" style="font-size:80%;color:#fff;font-weight: 600;"></span>
                                    </div>
                                    <span id="rank_totalPVWL" class="progress-value" style="font-size:80%; font-weight:bold;"></span>
                                    <div id="rank_percentPVWL" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar"></div>
                                    <div class="progress-bar " style="width: 20%; background-color:  #fffe31 !important; float: right;">
                                        <span id="rank_nextRankWL" style="color:black;font-weight: 600;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <a href="<?php echo BASE_URL()?>Main/WealthyLifestyle" style="margin-top:4px;font-size:10px;" type="button" class="btn btn-xs btn-info">VIEW DETAILS</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            
                <div class="pull-right">
                    <div class="dropdown btn-group btn-group-option">
                        <button type="button" class="btn btn-success btn-xs" aria-haspopup="true" aria-expanded="true">
                            <a href="<?php echo BASE_URL()?>Ecashloan" style="margin-top:4px;color:white;text-decoration:none;">UCREDIT</a>
                        </button>
                    </div>
                    <?php if ($user['A_CTRL']['show_fund'] == 1): 
                        // var_dump($user);
                    ?>
                    <div class="btn-group btn-group-list btn-group-notification">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="tooltip" title="E-cash Wallet">
                            <i class="fa fa-money" style="font-size:20px"></i>
                            <span class="badge" id="spanEC"><?php echo $user['EC']; ?></span>
                        </button>
                    </div><!-- btn-group -->

                    <div class="btn-group btn-group-list btn-group-notification">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="tooltip" title="Load Wallet">
                            <i class="fa fa-mobile-phone"  style="font-size:20px"></i>
                            <span class="badge"><?php echo $user['PB']; ?></span>
                        </button>
                    </div><!-- btn-group -->
                

                    <?php if ($user['R'] != "BDO00001") { ?>

                    <div class="btn-group btn-group-list btn-group-notification">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="tooltip" title="SGD Wallet">
                            <!-- <i class="fa fa-dollar"></i> -->
                            SGD
                            <span class="badge"><?php echo $user['SB']; ?></span>
                        </button>
                    </div><!-- btn-group -->
                        <?php //if ($user['L'] != 7 || $user['R'] == '5435641'): ?>
                        <div class="btn-group btn-group-list btn-group-notification">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="tooltip" title="UAE Wallet">
                            <!-- <i class="fa fa-aed">د.إ</i> -->
                            AED
                            <span class="badge"><?php echo $user['AB']; ?></span>
                            </button>
                        </div><!-- btn-group -->
                                
                                <div class="btn-group btn-group-list btn-group-notification">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="tooltip" title="Qatar Wallet">
                            <!-- <i class="fa fa-qar">﷼</i> -->
                            QAR
                            <span class="badge"><?php echo $user['QB']; ?></span>
                            </button>
                        </div><!-- btn-group -->

                        <div class="btn-group btn-group-list btn-group-notification">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="tooltip" title="HKD Wallet">
                            <!-- <i class="fa fa-qar">﷼</i> -->
                            HKD
                            <span class="badge"><?php echo $user['HKD']; ?></span>
                            </button>
                        </div><!-- btn-group -->

                        <?php if ($user['R'] =="1234567" || $user['R'] =="F2297646" || $user['R'] =="F4445336" || $user['R'] =="F2301753" || $user['R'] =="ITC0001" || $user['R'] =="F5597768" || $user['R'] == 'RM852123' || $user['R'] == 'F1359252' || $user['R'] == 'F8901916' || $user['R'] == 'F1526245' || $user['R'] == 'FH0694346' || $user['R'] == 'AED0001' || $user['R'] == 'F1526245' || $user['R'] == 'F1359252' || $user['R'] == 'F9687521' || $user['R'] == 'F8901916'){ ?>
                        <div class="btn-group btn-group-list btn-group-notification">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="tooltip" title="MYR Wallet">
                                MYR
                                <span class="badge"><?php echo $user['MYR']; ?></span>
                            </button>
                        </div><!-- btn-group -->
                        <?php } ?>

                    <?php } ?>

                                <?php //endif ?>
                    <?php endif ?>

                                            
                        <div class="btn-group btn-group-option">
                        <button type="button" class="btn btn-default dropdown-toggle btn-user" data-toggle="dropdown">
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <?php if ($user['L'] != '5'){ ?>
                                <li><a href="<?=base_url().'assets/dl/CIS_FORM.pdf';?>" download target="_blank"><i class="glyphicon glyphicon-user"></i> CIS/KYC FORM</a></li>
                                <li><a href="<?=base_url().'assets/dl/CIS_RF_SENDING.pdf';?>" download target="_blank"><i class="fa fa-money"></i> Remittance Sender Form</a></li>
                                <li><a href="<?=base_url().'assets/dl/CIS_RF_PAYOUT.pdf';?>" download target="_blank"><i class="fa fa-money"></i> Remittance Payout Form</a></li>
                                <li><a href="<?=base_url().'assets/dl/KYC_Billspayment.pdf';?>" download target="_blank"><i class="fa fa-money"></i> Bills Payment Form</a></li>
                                <li class="divider"></li>
                            <?php } ?>
                            <?php if($user['L'] == '1' || $user['L'] == '6' || $user['L'] == '7' || $user['L'] == '14' || $user['L'] == '15' || $user['L'] == '16'){?>
                            <li class="first-li"><a href="<?php echo BASE_URL()?>Users_location"><i class="glyphicon glyphicon-map-marker"></i> Unified Users Locations</a></li>
                            <?php } ?>
                            <li class="first-li"><a href="<?php echo BASE_URL()?>Main/myaccount"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                            <li><a href="<?php echo BASE_URL(); ?>Activity_logs"><i class="glyphicon glyphicon-star"></i> Activity Log</a></li>
                            <?php
                                if($user['CG']!='NORKIS' || $user['R']=="NORKIS001")  
                                echo '<li class="first-li"><a href="'.BASE_URL().'Main/account_setting"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>';
                            ?>
                            <li><a href="<?php echo BASE_URL()?>Main/faq"><i class="glyphicon glyphicon-alert"></i> FAQ</a></li>
                    <!--       <li><a href="<?php  BASE_URL()?>Main/account_setting"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li> -->
                            <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo BASE_URL(); ?>Login/user_logout"><i class="glyphicon glyphicon-log-out"></i>Sign Out</a></li>
                        </ul>
                    </div><!-- btn-group -->
                    
                </div><!-- pull-right -->
                                            
            </div><!-- header-right -->
            
        </div><!-- headerwrapper -->
    </header>

<?php if($user['USER_COUNT'] == 0) { ?>

    <!-- <div class="modal fade modalAddAddressframe" role="dialog" data-keyboard="false" data-backdrop="static"> -->
    <div class="modal fade modalAddAddressframe" role="dialog">
    
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"> Address Information </h3>
                    <button type="button" class="close closeAddAddressmodal" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;CLOSE</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="myWizardForm">
                      <div class="stepwizard">
                          <div class="stepwizard-row setup-panel">
                              <div class="stepwizard-step">
                                  <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                  <p>Add Information</p>
                              </div>
                              <div class="stepwizard-step">
                                  <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                  <p>Confirmation</p>
                              </div>
                              <!-- <div class="stepwizard-step">
                                  <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                  <p>Step 3</p>
                              </div> -->
                          </div>
                      </div>
                        <!-- <form  id="myForm" name="myForm" action="<?php echo BASE_URL() ?>Main" method="post" class="frmclass"> -->

                        <form id="frmUserAddAddress" class="frmclassxx">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-lg-12"> 
                                      <div class="row">
                                        <div style="display:none; text-align: center;" id="alertDynammic"></div>
                                      </div>
                                    </div>
                                    <div class="row setup-content" id="step-1">
                                        <div class="col-xs-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h4 class="text-primary"><b> Present Address </b><small class="text-danger">(* Fill up all fields)</small> </h4>
                                    
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label">House #/Lot #/ Street/Subdivision/District :</label>
                                                            <input maxlength="100" type="text" required="required" name="street" class="form-control street" value="<?php echo $_POST['street'];?>" placeholder="Enter House #/Lot #/ Street/Subdivision/District"  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label"> Barangay :</label>
                                                            <input maxlength="100" type="text" required="required" name="barangay" class="form-control barangay" value="<?php echo $_POST['barangay'];?>" placeholder="Enter Barangay" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                      <div class="col-md-4 countryclass">
                                                              <label class="control-label">Country :</label>
                                                              <!-- <select class="selectpicker form-control country" data-live-search="true" name="country" required> -->
                                                              <select class="form-control country" name="country" required>
                                                                  <option value="" disabled selected>---Select Country---</option>
                                                                  <?php /**$CountryInfo = $this->session->userdata('getCountryInfo');**/ 
                                                                  $CountryInfo = $this->user['Country']; ?>
                                                                  <?php foreach ($CountryInfo as $row): ?>
                                                                    <!-- <option value="<?php echo $row->country ?>" <?php echo $row->country == $_POST['country']?'selected':'';?>><?php echo $row->country ?></option> -->
                                                                    <option value="<?php echo $row['country'] ?>" <?php echo $row['country'] == $result->DATA->presentCountry?'selected':'';?>><?php echo $row['country'] ?></option>
                                                                  <?php endforeach ?>
                                                              </select>  
                                                          </div>
                                                        <div class="col-md-4 provclass">
                                                            <label class="control-label">Province :</label>
                                                            <!-- <select class="selectpicker form-control province" data-live-search="true" name="province" required> -->
                                                            <!-- <select class="form-control province selectprovince" name="province" required> -->
                                                                <!-- <option value="" disabled selected>---Select Province---</option> -->
                                                                <?php /** $ProvinceInfo = $this->session->userdata('getProvinceInfo'); **/ 
                                                                $ProvinceInfo = $this->user['ProvInfo']; ?>
                                                                <?php 

                                                                /**foreach ($ProvinceInfo as $row): ?>
                                                                  <option value="<?php echo $row->description ?>" <?php echo $row->description == $_POST['province']?'selected':'';?>><?php echo $row->description ?></option>**/

                                                                foreach ($ProvinceInfo as $row): ?>
                                                        <!-- <option value="<?php echo $row['description'] ?>" <?php echo $row['description'] == $result->DATA->presentProvince?'selected':'';?>><?php echo $row['description'] ?></option> -->
                                                                <?php endforeach ?>
                                                            <!-- </select>   -->
                                                            <input class="form-control province" name="province" required/>
                                                        </div>
                                                        <div class="col-md-4 cityclass">
                                                            <label class="control-label">Municipality/City :</label>
                                                            <!-- <select class="selectpicker form-control city" data-live-search="true" name="city" required> -->
                                                            <!-- <select class="form-control city selectcity" name="city" required> -->
                                                                <!-- <option value="" disabled selected>---Select Municipality/City---</option> -->
                                                                <?php /**$CityInfo = $this->session->userdata('getCityInfo');**/
                                                                  $CityInfo = $this->user['CityInfo'];
                                                                 ?>
                                                                <?php foreach ($CityInfo as $row): ?>
                                                                  <!-- <option value="<?php echo $row->description ?>" <?php echo $row->description == $_POST['city']?'selected':'';?>><?php echo $row->description ?></option> -->
                                                                  <!-- <option value="<?php echo $row['description'] ?>" <?php echo $row['description'] == $result->DATA->presentCity?'selected':'';?>><?php echo $row['description'] ?></option> -->
                                                                <?php endforeach ?>
                                                            <!-- </select>   -->
                                                            <input class="form-control city" name="city" required/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr/>

                                                <div class="form-group">
                                                    <h4 class="text-primary pull-left" style="margin-right: 10px;"><b> Permanent Address </b> </h4>
                                                    <div class="checkbox" style="margin: 0;">
                                                      <label>
                                                        <input class="clickCheckBox" name="checkme" type="checkbox" value="1">
                                                        <span class="text-danger">
                                                          <b>Same with Present Address</b>
                                                        </span>
                                                      </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label">House #/Lot #/ Street/Subdivision/District :</label>
                                                            <input maxlength="100" type="text" required="required" name="prstreet" class="form-control prstreet" value="<?php echo $_POST['prstreet'];?>" placeholder="Enter House #/Lot #/ Street/Subdivision/District"  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label"> Barangay :</label>
                                                            <input maxlength="100" type="text" required="required" name="prbarangay" class="form-control prbarangay" value="<?php echo $_POST['prbarangay'];?>" placeholder="Enter Barangay" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                      <div class="col-md-4 prcountryclass">
                                                              <label class="control-label">Country :</label>
                                                              <!-- <select class="selectpicker prcountry form-control" data-live-search="true" name="prcountry" required> -->
                                                              <select class="prcountry form-control" name="prcountry" required>
                                                                  <option value="" disabled selected>---Select Country---</option>
                                                                  <?php 
                                                                  // $CountryInfo = $this->session->userdata('getCountryInfo'); 
                                                                  $CountryInfo = $this->user['Country'];
                                                                  ?>
                                                                  <?php foreach ($CountryInfo as $row): ?>
                                                                    <!-- <option value="<?php echo $row->country ?>" <?php echo $row->country == $_POST['prcountry']?'selected':'';?>><?php echo $row->country ?></option> -->
                                                                  <option value="<?php echo $row['country'] ?>" <?php echo $row['country'] == $result->DATA->presentCountry?'selected':'';?>><?php echo $row['country'] ?></option>
                                                                  <?php endforeach ?>
                                                              </select>  
                                                              <!-- <input maxlength="100" type="text" required="required" name="prcountry" class="form-control showprcountry" id="showprcountry" readonly style="display: none;" /> -->
                                                          </div>
                                                        <div class="col-md-4 prprovclass">
                                                            <label class="control-label">Province :</label>
                                                            <!-- <select class="selectpicker prprovince form-control" data-live-search="true" name="prprovince" id="prprovince" required> -->
                                                            <!-- <select class="prprovince form-control selectprprovince" name="prprovince" id="prprovince" required> -->
                                                                <!-- <option value="" disabled selected>---Select Province---</option> -->
                                                                <?php 
                                                                // $ProvinceInfo = $this->session->userdata('getProvinceInfo'); 
                                                                $ProvinceInfo = $this->user['ProvInfo']; ?>
                                                                <!-- ?> -->
                                                                <?php 
                                                                /**foreach ($ProvinceInfo as $row): ?>
                                                                  <option value="<?php echo $row->description ?>" <?php echo $row->description == $_POST['prprovince']?'selected':'';?>><?php echo $row->description ?></option>**/

                                                                  foreach ($ProvinceInfo as $row): ?>
                                                        <!-- <option value="<?php echo $row['description'] ?>" <?php echo $row['description'] == $result->DATA->presentProvince?'selected':'';?>><?php echo $row['description'] ?></option> -->

                                                                <?php endforeach ?>
                                                            <!-- </select> -->
                                                            <input class="prprovince form-control" name="prprovince" id="prprovince" required>
                                                            <!-- <input maxlength="100" type="text" required="required" name="prprovince" class="form-control showprprovince" id="showprprovince" readonly style="display: none;" /> -->
                                                        </div>
                                                        <div class="col-md-4 prcityclass">
                                                            <label class="control-label">Municipality/City :</label>
                                                            <!-- <select class="selectpicker prcity form-control" data-live-search="true" name="prcity" required> -->
                                                            <!-- <select class="prcity form-control selectprcity" name="prcity" required>
                                                                <option value="" disabled selected>---Select Municipality/City---</option>
                                                                <?php 
                                                                // $CityInfo = $this->session->userdata('getCityInfo'); 
                                                                $CityInfo = $this->user['CityInfo'];
                                                                ?>
                                                                <?php foreach ($CityInfo as $row): ?>
                                                                  <!-- <option value="<?php echo $row->description ?>" <?php echo $row->description == $_POST['prcity']?'selected':'';?>><?php echo $row->description ?></option> -->
                                                                  <!-- <option value="<?php echo $row['description'] ?>" <?php echo $row['description'] == $result->DATA->presentCity?'selected':'';?>><?php echo $row['description'] ?></option> -->
                                                                <?php endforeach ?>
                                                            <!-- </select>  -->
                                                            <input class="prcity form-control" name="prcity" required>
                                                            <!-- <input maxlength="100" type="text" required="required" name="prcity" class="form-control showprcity" id="showprcity" readonly style="display: none;" /> -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr/>
                                               
                                                <button class="btn btn-primary nextBtn btn-md pull-right nextBtnSubmit" type="button" >Next</button>
                                            </div>
                                        </div>
                                    </div>
                                      <!-- <div class="row setup-content" id="step-2">
                                          <div class="col-xs-12">
                                              <div class="col-md-12">
                                                  <h3> Step 2</h3>
                                                  <div class="form-group">
                                                      <label class="control-label">Company Name</label>
                                                      <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="control-label">Company Address</label>
                                                      <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address"  />
                                                  </div>
                                                  <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                              </div>
                                          </div>
                                      </div> -->
                                      <div class="row setup-content setup-panel" id="step-2">
                                          <div class="col-xs-12">
                                              <div class="col-md-12">
                                                  <h3> Summary </h3>

                                                  <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h4 class="text-primary"><b> Present Address </b> </h4>
                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="control-label">House #/Lot #/ Street/Subdivision/District :</label>
                                                                <input type="text" class="form-control readstreet" readonly />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="control-label"> Barangay :</label>
                                                                <input type="text" class="form-control readbarangay" readonly />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4 provclass">
                                                                <label class="control-labelx">Province :</label>
                                                                <input type="text" class="form-control readprovince" readonly />
                                                            </div>
                                                            <div class="col-md-4 cityclass">
                                                                <label class="control-labelx">Municipality/City :</label>
                                                                <input type="text" class="form-control readcity" readonly /> 
                                                            </div>
                                                            <div class="col-md-4 countryclass">
                                                                <label class="control-labelx">Country :</label>
                                                                <input type="text" class="form-control readcountry" readonly />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr/>

                                                    <div class="form-group">
                                                        <h4 class="text-primary pull-left" style="margin-right: 10px;"><b> Permanent Address </b> </h4>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="control-label">House #/Lot #/ Street/Subdivision/District :</label>
                                                                <input type="text" class="form-control readprstreet" readonly />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="control-label"> Barangay :</label>
                                                                <input type="text" class="form-control readprbarangay" readonly />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4 provclass">
                                                                <label class="control-labelx">Province :</label>
                                                                <input type="text" class="form-control readprprovince" readonly />
                                                            </div>
                                                            <div class="col-md-4 cityclass">
                                                                <label class="control-labelx">Municipality/City :</label>
                                                                <input type="text" class="form-control readprcity" readonly /> 
                                                            </div>
                                                            <div class="col-md-4 countryclass">
                                                                <label class="control-labelx">Country :</label>
                                                                <input type="text" class="form-control readprcountry" readonly />
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <hr/>
                                                    <button class="btn btn-success btn-md pull-right btnAddAdress" name="btnAddAdress" type="submit"> Confirm </button>
                                                    <a href="#step-1" type="button" class="btn btn-default nextBtn btn-md pull-right" style="margin-right: 10px;"> Back </a>
                                                  
                                                </div>

                                                  
                                              </div>
                                          </div>
                                      </div>  
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- <div class="modal-footer"> -->
                    <!-- <button type="submit" name="" class="btn btn-primary">Proceed</button> -->
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <!-- </div> -->
            </div>
        </div>
</div>
       
<style type="text/css">
  .stepwizard-step p {
      margin-top: 10px;
  }

  .stepwizard-row {
      display: table-row;
  }

  .stepwizard {
      display: table;
      width: 100%;
      position: relative;
  }

  .stepwizard-step button[disabled] {
      opacity: 1 !important;
      filter: alpha(opacity=100) !important;
  }

  .stepwizard-row:before {
      top: 14px;
      bottom: 0;
      position: absolute;
      content: " ";
      width: 100%;
      height: 1px;
      background-color: #ccc;
      z-order: 0;

  }

  .stepwizard-step {
      display: table-cell;
      text-align: center;
      position: relative;
  }

  .btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
  }
</style>
<script>

$(document).ready(function() {
    // $('.countryclass').change((e)=>{
    //   const country = e.target.value
    //   if(country === "Philippines"){
    //     $('.inputprovince').hide()
    //     $('.selectprovince').show()

    //     $('.inputcity').hide()
    //     $('.selectcity').show()
    //   } else {
    //     $('.inputprovince').show()
    //     $('.selectprovince').hide()

    //     $('.inputcity').show()
    //     $('.selectcity').hide()
    //   }
    // })

    // $('.prcountryclass').change((e)=>{
    //   const country = e.target.value
    //   if(country === "Philippines"){
    //     $('.inputprprovince').prop('required',false)
    //     $('.inputprprovince').hide()
    //     $('.selectprprovince').prop('required',false)
    //     $('.selectprprovince').show()

    //     $('.inputprprovince').prop('required',false)
    //     $('.inputprcity').hide()
    //     $('.selectprcity').prop('required',false)
    //     $('.selectprcity').show()
    //   } else {
    //     $('.inputprprovince').show()
    //     $('.selectprprovince').hide()

    //     $('.inputprcity').show()
    //     $('.selectprcity').hide()
    //   }
    // })

    $('.modalAddAddressframe').modal({show:true});

    // $('.closeAddAddressmodal').click(function() {
    //   $('.modalAddAddressframe').modal('hide');
    //     return false;
    // });

    $(".clickCheckBox").click(function () {
        
        // alert($('input:checkbox[name=checkme]').is(':checked'));

        var getcheck = $('input:checkbox[name=checkme]').is(':checked');
        var street      = $('.street').val();
        var barangay    = $('.barangay').val();
        // var province    = $('.province option:selected').val();
        // var city        = $('.city option:selected').val();
        var province    = $('.province').val();
        var city        = $('.city').val();
        var country     = $('.country option:selected').val();
        console.log(province !='', barangay)

        if(getcheck == true) {
            // $('.prprovince').hide();
            // $('.prcity').hide();
            // $('.prcountry').hide();

            // $('.showprprovince').show();
            // $('.showprcity').show();
            // $('.showprcountry').show();
            
            if(street !='' && street !=undefined) {
                $('.prstreet').attr('readonly', true);
            }else{
                $('.prstreet').attr('readonly', false);
            }

            if(barangay !='' && barangay !=undefined) {
                $('.prbarangay').attr('readonly', true);
            }else{
                $('.prbarangay').attr('readonly', false);
            }

            if(province !='' && province !=undefined) {
                $('.prprovince').attr('readonly', true);
            }else{
                $('.prprovince').attr('readonly', false);
            }

            if(city !='' && city !=undefined) {
                $('.prcity').attr('readonly', true);
            }else{
                $('.prcity').attr('readonly', false);
            }

            if(country !='' && country !=undefined) {
                $('.prcountry').attr('readonly', true);
            }else{
                $('.prcountry').attr('readonly', false);
            }
           

            $('.prstreet').val(street);
            $('.prbarangay').val(barangay);
            $('.prprovince').val(province);
            $('.prcity').val(city);
            $('.prcountry').val(country);

        } else {

            // $('.bootstrap-select.prprovince').show();
            // $('.bootstrap-select.prcity').show();
            // $('.bootstrap-select.prcountry').show();

            // $('.showprprovince').hide();
            // $('.showprcity').hide();
            // $('.showprcountry').hide();

            $('.prstreet').attr('readonly', false);
            $('.prbarangay').attr('readonly', false);

            $('.prstreet').val('');
            $('.prbarangay').val('');
            $('.prprovince').val('');
            $('.prcity').val('');
            $('.prcountry').val('');
        } 
    });

    $(".street").keyup(function () {
        var street   = $('.street').val();
        var getcheck = $('input:checkbox[name=checkme]').is(':checked');

        if(getcheck == true) {
            $('.prstreet').val(street);
        }
    });
    $(".barangay").keyup(function () {
        var barangay = $('.barangay').val();
        var getcheck = $('input:checkbox[name=checkme]').is(':checked');
        
        if(getcheck == true) {
            $('.prbarangay').val(barangay);
        }
    });

    // $('select[name=province]').on('change', function(){
      $('input[name=province]').on('change', function(){
        var selected = $('.province').val();
        var getcheck = $('input:checkbox[name=checkme]').is(':checked');
        
        if(getcheck == true) {
            $('.prprovince').val(selected);
        }
    });

    // $('select[name=city]').on('change', function(){
    $('input[name=city]').on('change', function(){
        var selected = $('.city').val();
        var getcheck = $('input:checkbox[name=checkme]').is(':checked');
        
        if(getcheck == true) {
            $('.prcity').val(selected);
        }
    });

    $('select[name=country]').on('change', function(){
        var selected = $('.country').val();
        var getcheck = $('input:checkbox[name=checkme]').is(':checked');
        
        if(getcheck == true) {
            $('.prcountry').val(selected);
        }
    });


    $(".nextBtnSubmit").click(function () {
        
        var street      = $('.street').val();
        var barangay    = $('.barangay').val();
        // var province    = $('.province option:selected').val();
        // var city        = $('.city option:selected').val();
        var province    = $('.province').val();
        var city        = $('.city').val();
        var country     = $('.country option:selected').val();

        var prstreet    = $('.prstreet').val();
        var prbarangay  = $('.prbarangay').val();
        // var prprovince  = $('.prprovince option:selected').val();
        // var prcity      = $('.prcity option:selected').val();
        var prprovince  = $('.prprovince').val();
        var prcity      = $('.prcity').val();
        var prcountry   = $('.prcountry option:selected').val();

        $('.readstreet').val(street);
        $('.readbarangay').val(barangay);
        $('.readprovince').val(province);
        $('.readcity').val(city);
        $('.readcountry').val(country);
        $('.readprstreet').val(prstreet);
        $('.readprbarangay').val(prbarangay);
        $('.readprprovince').val(prprovince);
        $('.readprcity').val(prcity);
        $('.readprcountry').val(prcountry);
        
    });

});

</script>

<script type="text/javascript">
  $(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'], select"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>

<script type="text/javascript">
    $("#frmUserAddAddress").on("submit",function(event){
      event.preventDefault();
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

        var street      = $('.street').val();
        var barangay    = $('.barangay').val();
        // var province    = $('.province option:selected').val();
        // var city        = $('.city option:selected').val();
        var province    = $('.province').val();
        var city        = $('.city').val();
        var country     = $('.country option:selected').val();

        var prstreet    = $('.prstreet').val();
        var prbarangay  = $('.prbarangay').val();
        // var prprovince  = $('.prprovince option:selected').val();
        // var prcity      = $('.prcity option:selected').val();
        var prprovince  = $('.prprovince').val();
        var prcity      = $('.prcity').val();
        var prcountry   = $('.prcountry option:selected').val();

      var parameters = {street:street, barangay:barangay, province:province, city:city, country:country, prstreet:prstreet, prbarangay:prbarangay, prprovince:prprovince, prcity:prcity, prcountry:prcountry};
// console.log(parameters);

          $.ajax({
                type : 'POST',
                url  : "/Main/user_insert_address_request",
                data : parameters,
                success :  function(data)
                { 

                   // console.log(data);
                   var jsondata = JSON.parse(data);

                   waitingDialog.hide();
                   if(jsondata.S == 1){
                      $('.btnAddAdress').attr('disabled', true);

                      $("#alertDynammic").css('display','block');
                      $("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
                      // $("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>" + jsondata.M + "</b><br>");
                      $("#alertDynammic").html("<b>" + jsondata.M + "</b><br>");
                      $("#alertDynammic").fadeTo(8000, 6000).slideUp(6000, function(){
                        $("#alertDynammic").slideUp(6000);
                        $("#alertDynammic").removeClass();
                      });
                    setTimeout(function(){
                      gotoEnd();
                    }, 5500);

                   }else{
                      $("#alertDynammic").css('display','block');
                      $("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
                      // $("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>" + jsondata.M+ "</b>");
                      $("#alertDynammic").html("<b>" + jsondata.M + "</b><br>");
                      $("#alertDynammic").fadeTo(6000, 4000).slideUp(4000, function(){
                        $("#alertDynammic").slideUp(4000);
                        $("#alertDynammic").removeClass();
                      });

                      // setTimeout(function(){
                      //     gotoEnd();
                      //   }, 5500);
                   }
                  
                }

              });  
  });

  function gotoEnd(){
      var base_url = window.location.origin;
      var pathArray = window.location.pathname;

      window.location = base_url+pathArray;
  }
</script>

<?php } ?>

<script>
    $(function(){
    });
    $('#autoquota_setting').on('click', function(){
        let rank = $('#setting_currentRank').attr('data-rank');
        load_package(rank);
        $('#autoquota_modal').modal('show');
        $('body > div.modal-backdrop.fade.in').removeClass('modal-backdrop');

        if($('#pickup_claim').prop('checked')){
            $('.show_delivery').prop('hidden',true);
            $('.show_pickup').prop('hidden',null);
        }

        if($('#delivery_claim').prop('checked')){
            $('.show_delivery').prop('hidden',null);
            $('.show_pickup').prop('hidden',true);
        }
        

    });
    $('#autoquota_modal').on('click','#add_address_setting', function(){
        
        let thisrow = $("tbody > tr:first", "#tbl_address");
        if($("tbody > tr", "#tbl_address").length >= 3)
        {
            $.alert('You cannot add anymore. Max limit is 3 only.')
        }
        else
        {
            $("tbody", "#tbl_address").prepend(thisrow.clone());
            $(thisrow).attr("data-id", "");
            $(".remove_address",thisrow).attr("data-id", "");
            $(".edit_address_setting",thisrow).attr("data-id", "");
            $("input[name='selected_address']",thisrow).attr("data-id", "");
            $(".address1",thisrow).attr("title", "");
            $(".address1",thisrow).attr("value", "");

        }
    });

    $('#autoquota_modal').on("click", ".remove_address", function (){
        let id = $(this).data('id');
        var count = 0;

        $('#tbl_address > tbody > tr > td:nth-child(2) > input').each(function() {
            if ($(this).val()) {
            count++;
            }
        });

        if(count == 1 && id != '')
        {
            $.alert('It must have at least one(1) address remaining.');
            return false;
        }

        

        if ($("tbody > tr", "#tbl_address").length > 1) {
            if(id !== '')
            {
                $.confirm({
                    title: "Remove",
                    content: "Are you sure to remove this address?",
                    buttons: {
                    confirm: function () {
                        $.ajax({
                            url: aqpath + '/remove_auto_quota_address',
                            type: 'POST',
                            datatype: 'JSON',
                            data: {
                                id: id
                            },
                            success: function(response){
                                $(this).closest("tr").remove(); //remove row
                                let rank = $('#setting_currentRank').attr('data-rank');
                                $.alert('Successfully Removed.');
                                // load_package(rank);
                                load_address(rank);
                            },
                            fail: function(){

                            }
                        });
                    },
                    cancel: function () {},
                    },
                });
            }
            else
            {
                $(this).closest("tr").remove(); //remove row
            }
        }
    });

    $("#autoquota_modal").on("click", ".edit_address_setting", function (){
        let id = $(this).attr('data-id');
        $('#autoquota_address_modal').modal('show');
        $('body > div.modal-backdrop.fade.in').removeClass('modal-backdrop');
        $('#btn_save_address').attr('data-id',id);
        $(`#AddressProvinceList`).html('');
        $(`#AddressMunicipalityList`).html('');
        $(`#AddressBrgyList`).html('');
        $(`#Province`).val('');
        $(`#Municipality`).val('');
        $(`#Brgy`).val('');
        $(`#Province`).empty();
        $(`#Municipality`).empty();
        $(`#Brgy`).empty();
        $('#street').val('');
        $('#unit').val('');
        $('#zipcode').val('');

        // console.log(id);
        // return false;

        $.ajax({
            url: aqpath + '/get_auto_quota_address',
            type: 'POST',
            datatype: 'JSON',
            data: {id: id},
            success: function(response){
            let res = JSON.parse(response);
            let address = [];
            // console.log(res);
            if(res['data']['address'].length > 0)
            {
                address.push(res['data']['address'][0]['region'],res['data']['address'][0]['province'],res['data']['address'][0]['city'],res['data']['address'][0]['barangay'])
                let Source="https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/master/philippine_provinces_cities_municipalities_and_barangays_2019v2.json";
                let PhilAddress;
                $.get(Source,data=>{
                    PhilAddress=JSON.parse(data);
                    let NewAddress = new AddressForm(PhilAddress,"Region","Province","Municipality","Brgy");
                    NewAddress.Build();
                    const LoadAddress=()=>{
                            NewAddress.LoadAddress(address);
                    }
                    LoadAddress();
                    $('#street').val(res['data']['address'][0]['street']);
                    $('#unit').val(res['data']['address'][0]['unit_house_building']);
                    $('#zipcode').val(res['data']['address'][0]['zipcode']);
                });
            }
            else
            {
                $('#Region > option[value=""]').prop('selected',true);
            }
            },
            fail: function(){

            }
        });

        
    });

    $('#btn_save_address').on('click', function(){
        let usersetting_id = $('#save_aq_settings').data('id');
        let address_id = $('#btn_save_address').attr('data-id');;
        let i_region = $('#Region :selected').val();
        let i_province = $('#Province :selected').val();
        let i_municipality = $('#Municipality :selected').val();
        let i_barangay = $('#Brgy :selected').val();
        let i_street = $('#street').val();
        let i_unit = $('#unit').val();
        let i_zipcode = $('#zipcode').val();

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
                    address_id      : address_id,
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
                    $('#autoquota_address_modal').modal('hide');
                    let rank = $('#setting_currentRank').attr('data-rank');
                    // $("#tbl_address > tbody > tr:nth-child(1) > td:nth-child(1) > center > input[type=radio]").prop("checked", true);
                    $.alert('Save Successfully!');
                    load_address(rank);
                },
                fail: function(){

                }
            });
        }
    });

    function load_address(rank)
    {
        $.ajax({
            url: aqpath + '/load_auto_quota_setting',
            type: 'POST',
            datatype: 'JSON',
            data: {rank: rank},
            success: function(response){
            let res = JSON.parse(response);
            $("#tbl_address>tbody").html(res['address']);
            },
            fail: function(){

            }
        });
    }
    
    function load_package(rank)
    {
        $.ajax({
            url: aqpath + '/load_auto_quota_setting',
            type: 'POST',
            datatype: 'JSON',
            data: {rank: rank},
            success: function(response){
                let res = JSON.parse(response);
                let claim_option = '';

                $('.autoquota_modalpart').html(res['modal']);
                $("#tbl_address>tbody").html(res['address']);
                $('.package-inclusion').html(res['packages']);
                if($('#pickup_claim').prop('checked')){
                    $('.show_delivery').prop('hidden',true);
                    $('.show_pickup').prop('hidden',null);
                }

                if($('#delivery_claim').prop('checked')){
                    $('.show_delivery').prop('hidden',null);
                    $('.show_pickup').prop('hidden',true);
                }

                $("#pickup_claim,#label_pickup").click(function() {
                    $('#pickup_claim').prop('checked',true);
                    $('#delivery_claim').prop('checked',null);
                    $('.show_pickup').show('slow');
                    $('.show_delivery').hide('slow');
                    if ($(this).find(':checked'))
                    {
                        claim_option = 'PICKUP';
                    }
                });

                $("#delivery_claim,#label_delivery").click(function() {
                    $('#pickup_claim').prop('checked',null);
                    $('#delivery_claim').prop('checked',true);
                    $('.show_pickup').hide('slow');
                    $('.show_delivery').show('slow');
                    if ($(this).find(':checked'))
                    {
                        claim_option = 'DELIVERY';
                    }
                });

                switch($('input[name="claim_option"]:checked').data('selected')){
                    case 'PICKUP':
                        claim_option = 'PICKUP';
                        break;
                    case 'DELIVERY':
                        claim_option = 'DELIVERY';
                        break;
                    default:
                        claim_option = '';
                }

                $("#save_aq_settings").click(function() {
                    let selected_package = $('input[name="select_package"]:checked').data('id');
                    let selected_claim_option = claim_option;
                    let selected_branch = $('#select_branch').find(':selected').val();
                    let i_contact_name = $('#aq_contact_name').val();
                    let i_contact_no = $('#aq_contact_no').val();
                    let i_email = $('#aq_email').val();
                    let i_address = $('input[name="selected_address"]:checked').data('id');
                    let selected_option_val = '';

                    // console.log(selected_package);
                    // console.log(selected_claim_option);
                    // console.log(selected_branch);
                    // console.log(i_contact_name);
                    // console.log(i_contact_no);
                    // console.log(i_email);
                    // console.log(i_address);
                    // console.log(selected_option_val);
                    // // return false;

                    if(selected_package === '' || selected_package === undefined)
                    {
                        $.alert('Please select prefered package.')
                        return false;
                    }

                    if(selected_claim_option === '' || selected_claim_option === undefined)
                    {
                        $.alert('Please select PICK UP or DELIVERY.')
                        return false;
                    }
                    else if(selected_claim_option === 'DELIVERY')
                    {
                        selected_option_val = i_address;
                        if(selected_option_val === '' || selected_option_val === undefined)
                        {
                            $.alert('Please select/add delivery address before saving.')
                            return false;
                        }
                    }
                    else if(selected_claim_option === 'PICKUP')
                    {
                        selected_option_val = selected_branch;
                        if(selected_option_val === '' || selected_option_val === undefined)
                        {
                            $.alert('Please select pickup branch before saving.')
                            return false;
                        }
                    }

                    if(i_contact_name === '')
                    {
                        $.alert('Please input name.')
                        return false;
                    }
                    if(i_contact_no === '')
                    {
                        $.alert('Please input contact number.')
                        return false;
                    }

                    $.ajax({
                        url: aqpath + '/save_auto_quota_setting',
                        type: 'POST',
                        datatype: 'JSON',
                        data: {
                            selected_package:selected_package,
                            selected_claim_option:selected_claim_option,
                            i_contact_name:i_contact_name,
                            i_contact_no:i_contact_no,
                            i_email:i_email,
                            selected_option_val:selected_option_val
                        },
                        success: function(response){
                            $.alert('Save Successfully!');
                            $('#autoquota_modal').modal('hide');
                        },
                        fail: function(){

                        }
                    });
                });

                
            },
            fail: function(){

            }
        });
    }

    class AddressForm{
        constructor(PhilAddress,Region,Province,Municipality,Brgy) {
            this.Region = Region;
            this.Province = Province;
            this.Municipality=Municipality;
            this.Brgy=Brgy;
            this.PhilAddress=PhilAddress;
        }
        RegionID;
        Build=()=>{
            const {Region,Province,ProvinceList,MunicipalityList,BrgyList,GetRegionID,RegionList,Municipality,Brgy,RegionID}=this;
            // console.log('Building');
            $('#AddressForm').html('');
            //|=====================================| Building |=======================================|//
            $(`#${Region}`).attr("list",`Address${Region}List`);
            $(`#${Region}`).attr("placeholder", `Region`);
            $('#AddressForm').append(`<datalist id="Address${Region}List"></datalist>`);
            
            $(`#${Province}`).attr("list", `Address${Province}List`);
            $(`#${Province}`).attr("placeholder", `Province`);
            $(`#${Province}`).attr("readonly", true);
            $('#AddressForm').append(`<datalist id="Address${Province}List"></datalist>`);

            $(`#${Municipality}`).attr("list", `Address${Municipality}List`);
            $(`#${Municipality}`).attr("placeholder", `Municipality`);
            $(`#${Municipality}`).attr("readonly", true);
            $('#AddressForm').append(`<datalist id="Address${Municipality}List"></datalist>`);

            $(`#${Brgy}`).attr("list", `Address${Brgy}List`);
            $(`#${Brgy}`).attr("placeholder", `Barangay`);
            $(`#${Brgy}`).attr("readonly", true);
            $('#AddressForm').append(`<datalist id="Address${Brgy}List"></datalist>`);
            $('input:reset').click(()=>{
                console.log('reset');
                $(`#Address${Province}List`).html('');
                $(`#Address${Municipality}List`).html('');
                $(`#Address${Brgy}List`).html('');
                $(`#${Province}`).val('');
                $(`#${Municipality}`).val('');
                $(`#${Brgy}`).val('');
                $(`#${Province}`).attr("readonly", true);
                $(`#${Municipality}`).attr("readonly", true);
                $(`#${Brgy}`).attr("readonly", true);
                $(`#${Province}`).empty();
                $(`#${Municipality}`).empty();
                $(`#${Brgy}`).empty();
            })
            //|=====================================| Action |==========================================|//
            let RegionItem=this.RegionList();
            RegionItem.map(data=>$(`#Address${Region}List`).append(`<option value="${data.name}">${data.name}`));
            RegionItem.map(data=>$(`#Region`).append(`<option value="${data.name}">${data.name}`));
            $(`#${Region}`).change(()=>{
                $(`#Address${Province}List`).html('');
                $(`#Address${Municipality}List`).html('');
                $(`#Address${Brgy}List`).html('');
                // $(`#${Province}`).val('');
                // $(`#${Municipality}`).val('');
                // $(`#${Brgy}`).val('');
                $(`#${Province}`).empty();
                $(`#${Municipality}`).empty();
                $(`#${Brgy}`).empty();
                try{
                    ProvinceList().map(data=>$(`#Address${Province}List`).append(`<option value="${data}">${data}`));
                    $(`#Province`).append(`<option value="">SELECT PROVINCE`);
                    ProvinceList().map(data=>$(`#Province`).append(`<option value="${data}">${data}`));
                    $(`#${Province}`).attr("readonly", false);
                    $(`#${Municipality}`).attr("readonly", true);
                    $(`#${Brgy}`).attr("readonly", true);
                }catch(e){}
                
            })
            $(`#${Province}`).change(()=>{
                $(`#Address${Municipality}List`).html('');
                $(`#Address${Brgy}List`).html('');
                // $(`#${Municipality}`).val('');
                // $(`#${Brgy}`).val('');
                $(`#${Municipality}`).empty();
                $(`#${Brgy}`).empty();
                try{
                    MunicipalityList().map(data=>$(`#Address${Municipality}List`).append(`<option value="${data}">${data}`));
                    $(`#Municipality`).append(`<option value="">SELECT MUNICIPALITY`);
                    MunicipalityList().map(data=>$(`#Municipality`).append(`<option value="${data}">${data}`));
                    $(`#${Municipality}`).attr("readonly", false);
                    $(`#${Brgy}`).attr("readonly", true);
                }catch(e){}
            })
            $(`#${Municipality}`).change(()=>{
                $(`#Address${Brgy}List`).html('');
                // $(`#${Brgy}`).val('');
                $(`#${Brgy}`).empty();
                try{
                    BrgyList($(`#${Municipality}`).val()).map(data=>$(`#Address${Brgy}List`).append(`<option value="${data}">${data}`));
                    $(`#Brgy`).append(`<option value="">SELECT BARANGAY`);
                    BrgyList($(`#${Municipality}`).val()).map(data=>$(`#Brgy`).append(`<option value="${data}">${data}`));
                    $(`#${Brgy}`).attr("readonly", false);
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
            let idx=this.GetIndex(this.RegionList(),{name:$(`#${this.Region}`).val()},1);
            this.RegionID=this.RegionList()[idx].id;
            return this.RegionID;
        }
        ProvinceList=()=>Object.keys(this.PhilAddress[this.GetRegionID()].province_list)
        MunicipalityList=()=>Object.keys(
            this.PhilAddress[this.RegionID]
            .province_list[$(`#${this.Province}`).val().toUpperCase()]
            .municipality_list
        );
        BrgyList=()=>this.PhilAddress[this.RegionID]
            .province_list[$(`#${this.Province}`).val().toUpperCase()]
            .municipality_list[$(`#${this.Municipality}`).val().toUpperCase()].barangay_list;    
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
        //|===========================| New Added Function |============================|//
        GetAddress=()=>{
            const {Region,Province,Municipality,Brgy}=this;
            return {
                object:{
                    region:$(`#${Region}`).val(),
                    province:$(`#${Province}`).val(),
                    municipality:$(`#${Municipality}`).val(),
                    brgy:$(`#${Brgy}`).val()
                },
                array:[$(`#${Region}`).val(),$(`#${Province}`).val(),$(`#${Municipality}`).val(),$(`#${Brgy}`).val()]
            }
        }
        LoadAddress=data=>{
            const {Region,Province,Municipality,Brgy}=this;
            var fields=[Region,Province,Municipality,Brgy],ctr;
            for(var f of fields){
                ctr=0;
                for(var itm in data){
                    $(`#${f}`).val(data[itm]);
                    if($(`#${f}`).val()!==null){
                        $(`#${f}`).change();
                        if(Array.isArray(data))data.splice(ctr,1);
                        break; 
                    }
                    ctr++;
                }
            }
        }   
        
    }
    let Source="https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/master/philippine_provinces_cities_municipalities_and_barangays_2019v2.json";
    let PhilAddress;
    
    $.get(Source,data=>{
        PhilAddress=JSON.parse(data);
        let NewAddress = new AddressForm(PhilAddress,"Region","Province","Municipality","Brgy");
        NewAddress.Build();                                                                     
        let ArrayResult=[],ObjectResult={}
        const LoadAddress=(type)=>{
            if(type=='object'){
                NewAddress.LoadAddress(ObjectResult);
            }
            else{
                NewAddress.LoadAddress(ArrayResult);
            }
        }
        const SaveAddress=()=>{
            ObjectResult=NewAddress.GetAddress().object;
            ArrayResult=NewAddress.GetAddress().array;
            var str=`Sample Object Result:\n${JSON.stringify(ObjectResult)}\n\n\n`;
                str+=`Sample Array Result:\n${JSON.stringify(ArrayResult)}`;
            $('#Result').val(`${str}`);
        }
    });

    
</script>