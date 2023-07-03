<style type="text/css">
.rating {
  unicode-bidi: bidi-override;
  direction: rtl;
  text-align: center;
}
.rating > span {
  display: inline-block;
  position: relative;
}
.rating > span:hover,
.rating > span:hover ~ span {
  color: transparent;
}

.rating > span:hover:before,
.rating > span:hover ~ span:before {
   content: "\2605";
   position: absolute;
   left: 0; 
   color: gold;
} 

.top {
  unicode-bidi: bidi-override;
  direction: rtl;
  text-align: center;
}
.top > span {
  display: inline-block;
  position: relative;
  color: gold;
}
.top > span:hover,
.top > span:hover ~ span {
  color: transparent;
}
.top > span:hover:before,
.top > span:hover ~ span:before {
   content: "\2605";
   position: absolute;
   left: 0; 
   color: black;
}


.table > tbody > .prod_row > td{
      vertical-align: middle;
}

</style> 
  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li><a href="/Mlm">MLM PRODUCT INVENTORY</a></li>
                                </ul>
                                <h4>HUB ACCOUNT USERS</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    <div class="contentpanel">
                      <div class="row">

                              <div class="col-lg-12">  
                                <div class="alert alert-success" id="alertSuccess" style="display: none;"></div>
                                <div class="alert alert-danger" id="alertDanger" style="display: none;"></div>
                                <?php if ($result['S'] == 1): ?>
                                  <div class="alert alert-success"><?php echo $result['M'] ?></div>
                                <?php elseif ($result['S'] == 2): ?>
                                  <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                                <?php endif ?>
                                <div class="row" style="margin-bottom: 15px;">
                                    <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>Mlm/hub_account" id="frmMlm">
                                      <div class="col-lg-6">
                                          <div class="form-group input-group" style="width: 100%;">
                                              <span class="input-group-addon">Search</span>
                                              <input type="text" name="acct_regcode" value="<?php echo $_POST['acct_regcode'];?>" class="form-control inputLetterValidator" placeholder="Regcode">
                                              <span class="input-group-btn"><button type="submit" class="btn btn-primary" name="btn_search_prod" style="height: 34px;"><i class="fa fa-search fa-5px"></i></button></span>
                                          </div>
                                      </div>
                                      <div class="col-lg-6">
                                            <?php if($mlm_user['add_tangible_product'] == 1): ?>
                                              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal_add_mlm_user">
                                                <i class="fa fa-plus" aria-hidden="true"> Add New Hub User</i>
                                              </button>
                                            <?php endif ?>
                                              <!-- <a href="<?php echo BASE_URL() ?>Mlm/csv_hub_account" class="btn btn-warning pull-right" name="btn_csv_hub_account" style="height: 34px;"><i class="fa fa-download" aria-hidden="true"> Download CSV</i></a> -->
                                      </div>
                                    </form>
                                </div>

                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover productTable">
                                      <thead>
                                        <tr>
                                          <th>Regcode</th>
                                          <th>Account Name</th>
                                          <th>Category</th>
                                          <th>Discount</th>
                                          <th>Date Created</th>
                                          <?php if($mlm_user['edit_tangible_product'] == 1): ?>
                                            <th>Action</th>
                                          <?php endif ?>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php if(isset($hub_user) && count($hub_user) && !isset($hub_user['S'])){ ?>
                                          <?php foreach ($hub_user as $mlm): ?>
                                            <tr class="prod_row" data-toggle="tooltip" title="">
                                              <td><?php echo $mlm['regcode'] ?></td>
                                              <td><?php echo $mlm['account_name'] ?></td>
                                              <td><?php echo $mlm['category'] ?></td>
                                              <td><?php echo $mlm['discount'] ?></td>
                                              <td><?php echo $mlm['datecreated'] ?></td>
                                              <?php if($mlm_user['edit_tangible_product'] == 1): ?>
                                                <td nowrap>
                                                  <a class="btn_edit_discount" data-toggle="modal"><i class="fa fa-fw fa-edit"></i> <font style="color:#636E7B; cursor: pointer;">Edit User Discount</font></a>
                                                </td>
                                                <?php else: ?>
                                                <!-- <td>&nbsp;</td> -->
                                              <?php endif ?>

                                            </tr>
                                          <?php endforeach ?>
                                        <?php }else{ ?>
                                          <!-- <tr class="text-center">
                                            <td colspan="7">
                                              <div class="alert alert-danger">
                                                <strong>No Data Available. Please Search Again.</strong>
                                              </div>
                                            </td>
                                          </tr> -->
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                </div>

                        </div>
                      </div>
                   </div> 
               

               <div class="modal fade" id="myModal_add_mlm_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" style="margin-top: 100px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Add New MLM User</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="text-right" method="post" action="<?php echo BASE_URL() ?>Mlm/hub_account">
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 30px;"><label>Regcode</label></span>
                                              <input type="text" class="form-control" name="user_regcode" id="user_regcode" placeholder="Regcode" required/>
                                          </div>
                                      </div>
                                      <br>
                                      <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                      <button type="submit" class="btn btn-primary" name="btn_add_MLMuser">Ok</button>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


                    <div class="modal fade" id="myModal_edit_discount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" style="margin-top: 100px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Update Hub User Discount</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="text-right" method="post" action="<?php echo BASE_URL() ?>Mlm/hub_account">
                                      <div class="form-group text-left">   
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 50px;"><label>Regcode</label></span>
                                              <input type="text" class="form-control" name="regcode" id="regcode" readonly="" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 12px;"><label>Account Name</label></span>
                                              <input type="text" class="form-control" name="acct_name" id="acct_name" readonly="" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 50px;"><label>Category</label></span>
                                              <input type="text" class="form-control" name="category" id="category" readonly="" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 50px;"><label>Discount</label></span>
                                              <input type="text" class="form-control inputAmount" name="discount" id="discount" required/>
                                          </div>
                                      </div>
                                      
                                      <br>
                                      <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                      <button type="submit" class="btn btn-primary" name="btn_edit_discount" id="prod_id">Ok</button>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div class="deactivate modal fade" id="myModal_delete_prod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" style="margin-top: 100px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Deactivate Product</h4>
                                </div>
                                <div class="modal-body">
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span><label>Are you sure you want to deactivate this product?</label></span>
                                          </div>
                                      </div>
                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                    <a class="btn_del_prod btn btn-primary" data-toggle="modal">Deactivate</a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    
</div><!-- mainpanel -->     