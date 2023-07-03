
  <body class="login-body">
      <section>
          <?php if (is_null($process)): ?>
            <div class="contentpanel">
              <div class="col-md-8 col-md-offset-2" style="margin-top: 1%;" i>
                  <?php if ($result['S'] === 0 || $result['S'] === '0'): ?>
                      <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                  <?php elseif ($result['S'] === 1 || $result['S'] === '1'): ?>
                      <div class="alert alert-success"><?php echo $result['M']?><?php echo '<br> Please Log-In to continue.'?></div>
                  <?php endif ?>
                  <?php if ($API['S'] === 0 || $API['S'] === '0'): ?>
                      <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                  <?php elseif ($API['S'] === 1 || $API['S'] === '1'): ?>
                      <div class="alert alert-success"><?php echo $API['M']?></div>
                  <?php endif ?>
                  <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-md-5">
                                  <h2 class="text-center">Web Application</h2>
                              </div>
                              <div class="col-md-7">
                                  <div class="row">
                                      <form action="<?php echo base_url() ?>Login/" method="post" id="signin">
                                          <div class="col-md-5"  style="padding-right:0px;">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Username</label>
                                                <input type="text" class="form-control" name="sign_username" id="inputUsername" placeholder="Username" required> 
                                                <p style="margin-top: 0px;"><a href="<?php echo BASE_URL() ?>Registration/"><u>Register Dealer</u></a></p>  
                                              </div>
                                          </div>
                                          <div class="col-md-5" style="padding-left:0px;">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <input type="password" class="form-control col-md-12" name="sign_password" id="inputPassword"  placeholder="Password" required>
                                                <p><a href="#" data-toggle="modal" data-target="#myModal"><u>Forgot Password</u></a></p>
                                              </div>
                                          </div>
                                          <div class="col-md-2" style="padding-left:0px;">
                                              <div class="form-group">
                                                <button class="btn btn-default" name="btnsignin" style="margin-top: 24px;">Login</button> 
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                    </div>
                    <div class="panel-body">
                      <iframe src="https://mobilereports.globalpinoyremittance.com/portal/news" style="width:100%; height:450px;"></iframe>
                    </div>
                  </div>
              </div>
          <?php elseif ($process == 1): ?>
              <div class="col-md-4 col-md-offset-4" style="margin-top: 10%;">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-md-12">
                                 <p><?php echo $result['M'] ?></p>

                                  <form class="form-horizontal" method="post" action="<?php echo base_url() ?>Login/" id="signin">
                          
<!--                                     
                                      <div class="form-group">                                   
                                        <div class="col-sm-9">
                                          
                                          <button type="submit" name="btnResendCode" style="border: 0px; background: none;"><i><u>Resend</u></i></button> 
                                        </div>
                                      </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Regcode:</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" name="regcode" id="inputRegcode" placeholder="Regcode" value="<?php echo $result['R'] ?>" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3 control-label" style="padding-right:3px;">Device ID:</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" name="device_id" id="inputDeviceID" placeholder="Device ID" value="<?php echo $result['DI'] ?>" readonly>
                                          <button type="submit" name="btnResendCode" style="border: 0px; background: none;"><i><u>Resend Activation Code</u></i></button> 
                                        </div>
                                      </div> 
-->         
                                  
                                      <br />
                                       <!--  <label for="inputPassword3" class="col-sm-3 control-label" style="padding-right:3px;">Verification Code:</label> -->
                                        <div class="row">
                                         
                                        <div class="col-md-12" class="text-right">
                                          <input type="hidden" class="form-control" name="regcode" id="inputRegcode" placeholder="Regcode" value="<?php echo $result['R'] ?>" readonly>
                                         <!--  <input type="text" class="form-control" name="verification_code" id="inputVerificationCode" placeholder="Enter Verification Code" > -->
                                          <button type="submit" name="btnResendCode" class="btn btn-primary"><i><u><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Resend</u></i></button> 
                                       
                                            <a href="<?php echo BASE_URL(); ?>" class="btn btn-danger"><i><u><span class="glyphicon glyphicon-cancel" aria-hidden="true"></span> Dismiss</u></i></a>
                                        </div>
                                      </div>
                                  
                                  
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <?php endif ?>
      </section>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form action="<?php echo BASE_URL(); ?>Login/forgot_password" method="post" id="frmforgotpassword">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Forgot Password</h4>
      </div>
      <div class="modal-body">
       <div class="row">
          <div class="col-md-12"><input type="text" name="username" class="form-control" placeholder="Username" required /></div>
        </div>
        <br />
        <div class="row">
          <div class="col-md-12"><input type="text" name="regcode" class="form-control" placeholder="Regcode"  required /></div>
        </div>
         <br />
        <div class="row">
          <div class="col-md-12"><input type="text" name="email" class="form-control" placeholder="Email" required /></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"  name="btnForgot">Submit</button>
      </div>
      </form>
    </div>

  </div>
</div>
   
</body>
