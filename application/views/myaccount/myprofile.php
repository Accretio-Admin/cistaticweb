
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
                                <h4>MY ACCOUNT</h4>
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
                              <br />
                              <br />
                            <table class="table">
                                <tr>
                                    <td><b>REGCODE</b></td>
                                    <td><?php echo $user['R'] ?></td>
                                </tr>
                                 <tr>
                                    <td><b>EMAIL</b></td>
                                    <td><?php echo $user['EA'] ?></td>
                                </tr>
                                 <tr>
                                    <td><b>CONTACT</b></td>
                                    <td><?php echo $user['MB'] ?></td>
                                </tr>
                                <tr>
                                    <td><b>ADDRESS</b></td>
                                    <td><?php echo $user['AD'] ?></td>
                                </tr>
                            </table>
                            <div class="col-md-12 text-right">
                             <a href="<?php echo BASE_URL()?>main/account_setting"><button type="button" class="btn btn-primary" name="btnSubmit">Update Account Settings</button></a>
                            </div>
                        </div>
                      </div>
                      

                    </div><!-- contentpanel -->
                    
 </div><!-- mainpanel -->            