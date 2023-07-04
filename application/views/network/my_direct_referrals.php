<div class="mainpanel">
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
                <h4>MY DIRECT REFERRALS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <div class="row row-stat">
          <div class="col-md-5">
            <div class="contentpanel" style="padding-top: 0px;"> 
              <div class="panel panel-default">
                <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px; color: #4169E1; font-weight: bold;">MY DIRECT REFERRALS</div>
                  <div class="panel-body">
                    <form name="frmsearch" action="<?php echo BASE_URL() ?>ecash_payout/search" method="post" >
                      <div class="form-group">
                        <div class="col-md-10">
                          <input type="text" class="form-control" id="inputSenderName" name="inputSearch" placeholder="SEARCH" required/>
                        </div>
                        <div class="col-md-2">
                          <button type="submit" name= "btnSender" id="btnSender" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </div> 
                      </div>
                    </form>
                  </div>
              </div>
            </div> 
            <div id="frmnewsender" class="contentpanel" style="padding-top: 10%; padding-left: 0%;">
              <?php if ($direct_referrals['S'] === 0 || $direct_referrals['S'] === '0' ): ?>
                <h3><?php echo $direct_referrals['M'] ?></h3>
              <?php elseif ($direct_referrals['S'] == 1): ?>
                <table class="table table-striped">
                  <thead>
                    <tr>
                        <th>LIST</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th nowrap>Entry Date</th>
                        <th nowrap>Regcode</th>
                        <th nowrap>FullName</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($direct_referrals['directReferral'] as $d ): ?>
                         <tr>
                            <td><?php echo 1?></td>
                            <td><?php echo $d['entry_date']?></td>
                            <td><?php echo $d['regcode']?></td>
                            <td><?php echo $d['fullname']?></td>
                            
                        </tr>
                  <?php endforeach ?>
                 
                  </tbody>
                </table>
              <?php endif ?>
            </div>  
          </div>
        </div>
      </div>
</div>