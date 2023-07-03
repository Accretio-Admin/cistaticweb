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
                <h4>HIGH FIVE REPORT</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <div class="row row-stat">
          <div class="col-md-5">
            <div class="contentpanel" style="padding-top: 0px;"> 
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
                        
                        <th nowrap>Regcode</th>
                        <th nowrap>Reference</th>
                        <th nowrap>Package Name</th>
                        <th nowrap>Direct Income</th>
                        <th nowrap>Entry Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($direct_referrals['directReferral'] as $d ): ?>
                         <tr>
                           
                            <td><?php echo $d['reg_code']?></td>
                            <td><?php echo $d['reference']?></td>
                            <td><?php echo $d['package_name']?></td>
                            <td><?php echo $d['direct_income']?></td>
                            <td><?php echo $d['entry_date']?></td>
                            
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