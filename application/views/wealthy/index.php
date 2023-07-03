<script>
    $(document).ready(function(){
        CallWealthyLifestyle2('Get');
        // CallLeadership();
    });

    const CallWealthyLifestyle2 = (Rank) => {
        $.ajax({
            type: "POST",
            url: "/Main/getRanking",
            data: {},
            success: function(result) {

                var jsonData = JSON.parse(result)
                console.log(jsonData)

                if(jsonData.S == 1) {

                    var userRankNum = jsonData.D.accumulated_pairs;
                    var userRank = jsonData.D.description;
                    var userPairingLimit = jsonData.D.pairing_limit;
                    var userNextRank = jsonData.D.next_rank;

                    rank = 6;
                    rankGoal = 10;
                    rankGoal2 = 20;
                    rankGoal3 = '~';
                    daily = 18000;
                    monthly = 540000;

                    if (userRankNum != "" ) {  
                    
                        var display = 'Rank ' + userRankNum;
                        var accnumDaily = 18000;
                        var displayDaily = '₱' + accnumDaily + '/₱' + userPairingLimit;
                        var progressRank = Number(rank * 5);
                        var progressDaily = Number(accnumDaily * 5);
                   

                        $('#rank_labelPVWL').text(display);
                        $('#rank_totalPVWL').text(display);
                        $('#rank_currentRankWL').text('DISTRIBUTOR');
                        $('#rank_nextRankWL').text('ASSOCIATE');
                        $('#rank_percentPVWL').css({"width":progressRank+"%"});
                        $('#rank_labelWealthy').text('Rank ' + rank + '-' + 10);

                        $('#smb_labelPVWL').text('Maximum SMB per day (₱' + userPairingLimit + ')');
                        $('#smb_totalPVWL').text(displayDaily);
                        $('#smb_percentPVWL').css({"width":progressDaily+"%"});
                        $('#smb_labelWealthy').text('Rank ' + userRankNum + '-' + 10);

                        $('#infoRankNum').text(userRankNum);
                        $('#infoRankDesc').text(userRank);

                        // $('#smbm_labelPVWL').text('Maximum SMB per month (₱' + monthly + ')');
                        // $('#smbm_totalPVWL').text(displayMonthly);
                        // $('#smbm_percentPVWL').css({"width":progressMonthly+"%"});
                        // $('#smbm_labelWealthy').text('Rank ' + rank + '-' + 10);

                    } else {
                        $('#currentRankWL').text('-');
                        $('#nextRankWL').text('-');
                    }
                }
            }
        });
    }
</script>

  <div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-user"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>HOME</li>
                </ul>
                <h4>MY WEALTHY LIFESTYLE</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">
        <div class="row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
            <img src="<?php echo BASE_URL()?>assets/images/photos/default_photo.png" alt="profile">
            </a>
            <h4 class="text-center" style="color:#fca600"><?php echo $user['N'] ?></h4>
        </div>
        <div class="col-xs-6 col-md-5">
            <b>INFORMATION</b>
            
            <!-- <div class="profile-details row" style="margin-top:10px;">
                <small class="text-muted col-md-12">RANK NUMBER  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge" id="infoRankNum"></span></small>
                <small class="text-muted col-md-12">RANK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge" id="infoRankDesc"></span></small>
            </div> -->

            <table class="table table-responsive">
                <tr>
                    <td><h5 style="font-size:80%; font-weight:bold;">RANK NUMBER</h5></td>
                    <td><span id="infoRankNum"> </span></td>
                </tr>
                <tr>
                    <td><h5 style="font-size:80%; font-weight:bold;">RANK</h5></td>
                    <td><span id="infoRankDesc"> </span></td>
                </tr>
            </table>

            <!-- rank -->
            <!-- <div class="form-group">
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
            </div> -->

            <!-- smb per day -->
            <div class="form-group">
                <label id="smb_labelPVWL" class="smb_labelPVWL" for="currentRank"></label>
                <div id="progressPV" style="border-radius: unset;" class="progress">
                    <span id="smb_totalPVWL" class="progress-value" style="font-size:80%; font-weight:bold;"></span>
                    <div id="smb_percentPVWL" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar"></div>
                </div>
            </div>

            <!-- smb per month -->
            <!-- <div class="form-group">
                <label id="smbm_labelPVWL" class="smbm_labelPVWL" for="currentRank"></label>
                <div id="progressPV" style="border-radius: unset;" class="progress">
                    <span id="smbm_totalPVWL" class="progress-value" style="font-size:80%; font-weight:bold;"></span>
                    <div id="smbm_percentPVWL" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar"></div>
                </div>
            </div> -->

            
           
          
        </div>
        </div>
        

    </div><!-- contentpanel -->
                    
 </div><!-- mainpanel -->            