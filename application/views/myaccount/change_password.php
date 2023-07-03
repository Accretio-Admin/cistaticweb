
            
            
<form method="post" action="<?php echo base_url('/Login/change_password') ?>">
<div  class="row">
  <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
        

      <div class="jumbotron" id="divlpass" >                                     
        <h3 class="hr2"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;<span>Change  </br> Login Password</span></h3>
        <hr />
        <!-- <p class="text-center text-muted">Login Password</p> -->
            <?php if($API['M']!=""){
                    if ($data['API']['S']){ ?>
                         <div class="alert alert-warning">Successful, Please Log in again <a href="<?php echo base_url().'Login'; ?>" > here </a></div> 
            <?php }else{ ?>
                <div class="alert alert-warning"><?php echo $API['M']; ?> </div> 
            <?php }} ?>

            <div class="form-group">
                <label>Current Regcode : </label>
                <input type="text" class="form-control col-md-6" name="curr_regcode" required="">
            </div>
            <div class="form-group">
                <label>Current password : </label>
                <input type="password" class="form-control col-md-6" name="curr_pass" required="">
            </div>
            <div class="form-group">
                <label>New password : </label>
                <input type="password" class="form-control" name="new_pass" required="">
            </div>
            <div class="form-group">
                <label>Confirm new password : </label>
                <input type="password" class="form-control" name="con_pass" required="">
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-8">
                    <div class="form-group margin-top-small margin-bottom-large">
                      <a class="btn btn-default pull-right" href="<?php echo base_url()?>Login" >Cancel</a>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">
                    <div class="form-group margin-top-small margin-bottom-large">
                      <button class="btn btn-primary pull-right" type="submit" name="btnchangelp">Submit</button>
                    </div>
                </div>
            </div>
                         
     </div>

     
  </div>
</div>
</form>

<script>

</script>
          