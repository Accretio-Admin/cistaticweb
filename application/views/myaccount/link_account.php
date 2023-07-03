<div class="mainpanel">
      <div class="pageheader">
          <div class="media">
              <div class="pageicon pull-left">
                  <i class="fa fa-money"></i>
              </div>
              <div class="media-body">
                  <ul class="breadcrumb">
                      <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                      <li>LINK ACCOUNT</li>
                  </ul>
                  <h4>LINK ACCOUNT</h4>
              </div>
          </div><!-- media -->
      </div><!-- pageheader -->

      <div class="contentpanel">
        <div class="table-responsive">
            <ul class="nav nav-tabs">
              
            </ul>
        </div>

        <div class="tab-content">
          <div id="etoetab" class="tab-pane fade in active padding-five">
            <div class="row">
              <div class="col-xs-12 col-md-12">
                  <?php if ($results['S'] === 0): ?>
                    <div class="alert alert-danger"><?php echo $results['M']; ?></div> 
                  <?php endif ?>

                  <?php if ($results['S'] === 1): ?>
                    <div class="alert alert-info"><?php echo $results['M']; ?></div> 

                  <?php endif ?>

                  <?php if ($results['S'] === 2): ?>
                  <div style="background-color: #ddffdd; border-left: 6px solid #4CAF50;margin-bottom: 15px; padding: 20px 15px;">
                    <p><strong>ACCOUNT ALREADY PAIRED TO USER ID : </strong><?php echo $results['U']; ?></p>
                  </div>
                  <?php endif ?>

                  <?php if ($process['M'] != ''): ?>
                    <div class="alert alert-danger"><?php echo $process['M']; ?></div> 
                  <?php endif ?>


                  <?php if ($results['S'] !== 2): ?>
                  <div class="col-md-12 col-xs-12" style="overflow-y:scroll;height:350px" >
                   <table  class="table table-bordered">
                    <thead>
                        <tr>
                          <th>User Id</th>
                          <th>Code</th>
                          <th>Status</th>
                          <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php  foreach ($results['T_DATA'] as $A ): ?>
                        <tr>
                          <td><?php echo $A['user_id'];?></td>
                          <td><?php echo $A['code'];?></td>
                          <td><?php echo $A['status'];?></td>
                          <td><?php echo $A['ip'];?></td>
                        </tr>
                      <?php endforeach ?>
                      </tbody>
                      </table>
                  </div> 
                   <?php endif ?>

              </div>
            </div>
          </div>
        </div>
      </div><!-- contentpanel -->
</div><!-- mainpanel --> 
        