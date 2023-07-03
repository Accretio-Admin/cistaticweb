<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-money"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>ECASH</li>
              </ul>
              <h4>E-Cash Credit To Bank</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->

  <div id="secbankConfirmSubmitdiv" class="col-md-6" style="display:none">
    <form id="secbankConfirmSubmit">
    <div class="alert alert-info">Please confirm below to proceed </div>
    <br/>
    <h4><span class="glyphicon glyphicon-th-list"></span> &nbsp;SUMMARY</h4>
    </form>
  </div>

  <div id="content" class="contentpanel" style="padding-bottom: 0px;">
  <?php if ($result['S']===0 || $API['S']===0): ?>
        <div class="alert alert-danger"><b><?php echo $result['M']?></b></div>
  <?php endif ?>
    <?php if ($result['process']===0): ?>
        <div class="alert alert-danger"><b><?php echo $result['M']?></b></div>
  <?php endif ?>
  
  <?php if ($result['S']==1): ?>
        <div class="alert alert-success"><b><?php echo $result['M']?></b></div>
  <?php endif ?>
  <?php if ($API['S']==1): ?>
        <div class="alert alert-success"><b><?php echo $API['M']?></b>
        <p><font color="#FF0000"><i>*A Copy of your receipt has been sent to your email: </i></font><?php echo $user['EA']?></p>
        <p><b>Transaction Number: </b><?php echo $API['TN']?></p>
        </div>
  <?php endif ?>

<?php if($result['process'] === 0 || $result['process'] == ''):?>
       <div class="row row-stat">
          <div class="col-md-12">
              <div class="row"> <!--row-->
                <div class="col-md-6">
               
                  <div class="row">
                    <div class="col-md-12">
                    
                        <div class="form-group">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Sender / Beneficiary</a> 
                     
                      </div>
                        <div class="form-group">
                          <form name="frmecashcredittobanksender" action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post" id="frmSSeachRemit" >
                            <div class="row">
                                <div class='col-xs-12 col-md-12'>
                                    <div class="row">
                                       <div class="col-md-10">
                                            <input type="text" class="form-control" id="inputsmartmoneySenderName" name="inputSearch" placeholder="SEARCH SENDER NAME" value="<?php echo $type['inputSenderName']; ?>" required/>
                                       </div>
                                       <div class="col-md-2 sender-search">
                                            <button type="submit" name= "btnSsearch" id="btnSender" class="btn btn-primary">
                                               <span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                            </button>
                                       </div> 
                                    </div> 
                                </div>
                            </div> 
                        </form>
                      </div>
                    </div>
                  </div>
                  <form name="frmecashcredittobankbeneficiary" action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post" id="frmBSeachRemit"  >
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                                        <div class="row">
                                            <div class='col-xs-12 col-md-12'>
                                                <div class="row">
                                                   <div class="col-md-10">
                                                        <input type="text" class="form-control" id="inputsmartmoneyBeneficiaryName" name="inputSearch" placeholder="SEARCH BENEFICIARY NAME" required />
                                                        <input type="hidden" name="inputSenderHide" id="inputSenderHide" value="<?php echo $type['inputSender']?>"/>
                                                        <input type="hidden" name="inputBeneficiaryHide" id="inputBeneficiaryHide" />
                                                   </div>
                                                   <div class="col-md-2">
                                                         <button type="submit" name= "btnBsearch" id="btnSender" class="btn btn-primary">
                                                         <span id="spanBIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                        </button>
                                                   </div> 
                                                </div> 
                                            </div>
                                        </div> 
      
                        </div>
                     </div>
                   </div>
                  <br />
                    <div class="row">
                        <div class="col-md-10 text-right">
                            <a href="#" class="btn btn-warning btnProceed" style="display:none">Proceed Transaction &nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>
                        </div>
                    </div>
              </form>
             </div>
             <div class="col-md-12">
                        <?php if ($row['S']===0): ?>
                            <div class="alert alert-danger"><b><?php echo $row['M']; ?>!!</b></div>
                        <?php endif ?>
                        <?php if ($row['S']==1): ?>
                          <hr />
                          <h4><?php echo $type['typedesc']; ?> Result :</h4>
                           
                              <table id="example"  class="table table-bordered" cellspacing="0" style="width:100%;">
                                        <thead>
                                          <tr>
                                            <th>Loyalty Cardno</th>
                                            <th>Fullname</th>
                                            <th>Address</th>
                                            <th>Mobile No</th>
                                            <th>E-Mail</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>

                                        <tbody>
                                          <?php  foreach ($row['result'] as $i): ?>
                                          <tr class="tr">
                                              <td class="td"><?php echo $i['loyaltycardno']; ?></td>
                                              <td class="td"><?php echo $i['fullname']; ?></td>
                                              <td><?php echo $i['address']; ?></td>
                                              <td><?php echo $i['mobileno']; ?></td>
                                              <td><?php echo $i['email']; ?></td>
                                              <td><a id="aFind" class="btn btn-danger" data-id="<?php echo $type['typeid']?>" href="#">Select</a></td>

                                          </tr>
                                          <?php endforeach ?>
                                      
                                        </tbody>
                                    </table>
                                     
                        <?php endif ?>
              </div>
            </div><!--row--> 
          
          </div>
      </div>
<?php endif ?>


<?php if($result['process'] == '1'): ?>
       <div class="row row-stat">
          <div class="col-md-12">
              <div class="row"> <!--row-->
                <div class="col-md-6">
                <?php if($result['M'] != ''): ?>
                        <div class="alert alert-info">Please confirm below to proceed </div>
                <?php endif ?>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4><span class="glyphicon glyphicon-th-list"></span> &nbsp;SUMMARY</h4>
                        </div>
                        <div class="form-group">
                          <form name="frmecashcredittobanksender" action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post" id="frmSSeachRemit" >
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px; font-weight: bold;">ACCOUNT NO:</span>
                                       <input type="text" class="form-control" name="inputAccountno" id="inputAccountno" value="<?php echo $result['inputAccountno'] ?>" readonly />
                                      </div>
                                  </div>  
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px; font-weight: bold;">BANK:</span>
                                      <input type="text" class="form-control" name="inputBank" id="inputBank" value="<?php echo $result['inputBank'] ?>" readonly />
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 46px; font-weight: bold;">SENDER:</span>
                                      <input type="text" class="form-control" name="inputSender" id="inputSender" value="<?php echo $result['inputSender'] ?>" readonly />
                                    </div>
                                  </div> 
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 12px; font-weight: bold;">BENEFICIARY:</span>
                                      <input type="text" class="form-control" name="inputBeneficiary" id="inputBeneficiary" value="<?php echo $result['inputBeneficiary'] ?>" readonly />
                                    </div>
                                  </div> 
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 45px; font-weight: bold;">AMOUNT:</span>
                                      <input type="text" class="form-control" name="inputAmount" id="inputAmount" value="<?php echo number_format($result['inputAmount'],2) ?>" readonly />
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 45px; font-weight: bold;">CHARGE:</span>
                                      <input type="text" class="form-control" name="inputCharge" id="inputCharge" value="<?php echo $result['inputCharge'] ?>" readonly />
                                    </div>
                                  </div> 
                                  <div class="form-group">
                                      <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 60px; font-weight: bold;">TOTAL:</span>
                                      <input type="text" class="form-control" name="inputTotal" id="inputTotal" value="<?php echo number_format($result['inputTotal'],2)  ?>" readonly/>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="input-group">
                                      <input type="hidden" class="form-control" name="inputTN" id="inputTN" value="<?php echo $result['TN'] ?>" readonly />
                                    </div>
                                  </div> 
                                  <div class="form-group">
                                    <div class="input-group">
                                      <input type="hidden" class="form-control" name="inputTpass" id="inputTpass" value="<?php echo $result['inputTpass'] ?>" readonly />
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                          <button type="cancel" class="btn btn-default" id="cancel" name="cancel">Cancel</button>
                                        </div>
                                        <div class="col-md-6 text-right" >
                                          <button type="submit" class="btn btn-primary" id="btnConfirm" name="btnConfirm">Confirm &nbsp;</button>
                                        </div>
                                    </div>
                                  </div>                   
                              </div>
                          </div> 
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div>
<?php endif ?>






  </div>
</div>


<!-- SECURITY BANK -->

<div class="modal fade" id="secbankModal" tabindex="-1" role="dialog" aria-labelledby="secbankModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

       
        <p style="font-size:20px">
          Credit to Bank
          <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/The_Security_Bank_Logo_1.jpg/1200px-The_Security_Bank_Logo_1.jpg" width="140" height="auto"> -->
        </p>

      </div>
      <div class="modal-body">
        <div role="tabpanel">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs secbank" role="tablist">
            <li role="presentation" style="pointer-events:none" class="active"><a href="#sendTab" aria-controls="sendTab" role="tab"
                data-toggle="tab">Sender Details</a>

            </li>
            <li role="presentation" style="pointer-events:none"><a href="#beneDetails" aria-controls="beneDetails" role="tab"
                data-toggle="tab">Beneficiary Details</a>

            </li>
            <li role="presentation" style="pointer-events:none"><a href="#accntDetails" aria-controls="accntDetails" role="tab"
                data-toggle="tab">Account Details</a>

            </li>
          </ul>
          <form id="secbankfrm">
          <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="sendTab">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="sendersName">Sender's Name</label>
                    <input type="text" class="form-control" disabled name="sendersName" id="sendersName" placeholder="Sender's Name">
                    <input type="hidden" class="form-control" disabled name="scard" id="scard" placeholder="Sender's Loyalty No">
                        <input type="hidden" class="form-control" disabled name="sbname" id="sbname" placeholder="Sender's Broken Name">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputEmail">Sender's Email</label>
                    <input type="email" class="form-control" disabled id="sendersEmail" name="sendersEmail" placeholder="Sender's Email">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="senderBday">Sender's Birthday</label>
                    <input type="text" class="form-control" disabled name="senderBday" id="senderBday" placeholder="Sender's Birthday">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="senderNumber">Sender's Contact Number</label>
                    <input type="text" class="form-control" disabled id="senderNumber" name="senderNumber" placeholder="Sender's Contact Number">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="senderAddress">Sender's Adrress</label>
                    <input type="text" class="form-control" name="senderAddress" id="senderAddress" placeholder="Sender's Address">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="senderNationality">Sender's Nationality</label>
                    <input type="text" class="form-control" name="senderNationality" id="senderNationality" placeholder="Sender's Nationality">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="senderBplace">Sender's Birthplace</label>
                    <input type="text" class="form-control" name="senderBplace" id="senderBplace" placeholder="Sender's Birthplace">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="senderNow">Sender's Nature of Work</label>
                    <input type="text" class="form-control" name="senderNow" id="senderNow" placeholder="Sender's Nature of Work">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="senderSof">Source of Fund</label>
                    <input type="text" class="form-control" name="senderSof" id="senderSof" placeholder="Source of Fund">
                  </div>
                </div>
              </div>

              </div>
              <div role="tabpanel" class="tab-pane" id="beneDetails">
                
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="benesName">Beneficiary's Name</label>
                        <input type="text" class="form-control" disabled name="benesName" id="benesName" placeholder="Beneficiary's Name">
                        <input type="hidden" class="form-control" disabled name="bcard" id="bcard" placeholder="Beneficiary's Loyalty No">
                        <input type="hidden" class="form-control" disabled name="bbname" id="bbname" placeholder="Beneficiary's Broken Name">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputEmail">Beneficiary's Email</label>
                        <input type="email" class="form-control" disabled id="benesEmail" name="benesEmail" placeholder="Beneficiary's Email">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="beneBday">Beneficiary's Birthday</label>
                        <input type="text" class="form-control" disabled name="beneBday" id="beneBday" placeholder="Beneficiary's Birthday">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="beneNumber">Beneficiary's Contact Number</label>
                        <input type="text" class="form-control" disabled name="beneNumber" id="beneNumber" benesEmailplaceholder="Beneficiary's Contact Number">
                      </div>
                    </div>
                  </div>

              </div>

              <div role="tabpanel" class="tab-pane" style="max-height:60vh;overflow-x:auto" id="accntDetails">
                  <div class="form-group">
                    <div id="idsecdiv1" class="input-group">
                        <span class="input-group-addon idsOne" id="basic-addon1" style="padding-right: 63px;">PRIMARY ID: </span>
                        <select class="form-control preferenceSelectsecbank" name="selvalidID1_secbank" id="selvalidID1_secbank" style="display: none;width:100%" required>
                          <option value="" disabled selected>--CHOOSE VALID ID--</option>   
                          <!-- <option value="add_id">ADD ID</option> CHOOSE VALID ID-->
                        </select>
                        <span class="form-control" id="spinAnimationsecbank1"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                        <span class="input-group-addon btn-primary" id="refreshctb" style="cursor:pointer;color: #fff;background-color: #337ab7;border-color: #2e6da4;"><i style="font-size:15px;cursor:pointer" class="fa">&#xf021;</i> </span>
                      </div>
                    </div>

                    <div class="form-group" id="id_details1_secbank" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
                        <h4 id="labelId1">PRIMARY ID DETAILS</h4>
                        <div class="input-group">
                          <span class="input-group-addon" id="id1_type" style="padding-right: 89px;">ID TYPE:</span>
                          <input type="text" class="form-control" name="id_detailtype1" id="id_detailtype1" readonly="">
                          <input type="hidden" class="form-control" name="id_detail" id="id_detail" readonly="">
                          <input type="hidden" class="form-control" name="id_secbank_type" id="id_secbank_type" readonly="">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon" id="id1_number" style="padding-right: 67px;">ID NUMBER:</span>
                          <input type="text" class="form-control" name="id_detailnumber1" id="id_detailnumber1" readonly="">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon" id="id1_expirydate" style="padding-right: 54px;">EXPIRY DATE:</span>
                          <input type="text" class="form-control" name="id_detailexpiry1" id="id_detailexpiry1" readonly="">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon" id="id1_createddate" style="padding-right: 40px;">CREATED DATE:</span>
                          <input type="text" class="form-control" name="id_detailcreated1" id="id_detailcreated1" readonly="">
                        </div>
                        <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 84px;">ID IMAGE:</span>
                        <a class="form-control btn btn-info" id="id_attachment1" href="" target="_blank">View</a>
                        </div>
                    </div>

                <div id="idsecdiv" style="display: none;" class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 39px;">SECONDARY ID 2: </span>
                        <select class="form-control preferenceSelectsecbank" name="selvalidID2_secbank" id="selvalidID2_secbank" style="display: none;">
                          <option value="" disabled selected>--CHOOSE VALID ID--</option>  
                        </select>
                        <span class="form-control" id="spinAnimationsecbank2"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                        </div>
                    </div>
                    <div class="form-group" id="id_details2_secbank" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
                    <h4>SECONDARY ID 2 DETAILS</h4>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 61px;">ID TYPE:</span>
                          <input type="text" class="form-control" name="id_detailtype2" id="id_detailtype2" readonly="">
                          <input type="hidden" class="form-control" name="id_secbank_type2" id="id_secbank_type2" readonly="">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 37px;">ID NUMBER:</span>
                          <input type="text" class="form-control" name="id_detailnumber2" id="id_detailnumber2" readonly="">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 24px;">EXPIRY DATE:</span>
                          <input type="text" class="form-control" name="id_detailexpiry2" id="id_detailexpiry2" readonly="">
                        </div>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">CREATED DATE:</span>
                          <input type="text" class="form-control" name="id_detailcreated2" id="id_detailcreated2" readonly="">
                        </div>
                        <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 54px;">ID IMAGE:</span>
                        <a class="form-control btn btn-info" id="id_attachment2" href="" target="_blank">View</a>
                        </div>

                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="bank">BANK</label>
                          <input type="text" class="form-control" disabled name="bank" id="bank" placeholder="BANK">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="amount">Amount</label>
                          <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="secbankAccntNo">Account No.</label>
                          <input type="text" class="form-control" name="secbankAccntNo" id="secbankAccntNo" placeholder="Account No.">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div id="countryDiv" class="form-group">
                          <label for="senderNumber">Country</label>
                          <select id="country" name="country" class="form-control">
                            <option value="PH">Philippines</option>
                            <option value="AE">UNITED ARAB EMIRATES</option>
                            <option value="QA">QATAR</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6" id="trPassDiv">
                        <div class="form-group">
                          <label for="senderAddress">Trasaction Password</label>
                          <input type="password" class="form-control" name="trPass" id="trPass" placeholder="Trasaction Password">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
        
            </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" type="submit" data-dismiss="modal">Close</button>
        <button type="button" id="submit" type="button" class="btn btn-primary save">Next ></button>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="myModalSecBankId" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="newheading"></h4>
              </div>
               <form id="dataSecBankId" method="post" enctype="multipart/form-data">
              <fieldset>
                        <div class="modal-body">
                          <div class="alert alert-danger" style="display:none; text-align: center;" id="updateexpired"><b></b></div>
                          <div class="alert alert-success" style="display:none; text-align: center;" id="addnewsuccess"><b></b></div>
                            <div class="form-group">
                              <div class="input-group">
                              <span class="input-group-addon" style="padding-right: 70px;">ID TYPE:</span>
                              <select class="form-control" name="newidtype" id="newidtype" style="display: none;" required>
                                 <option value="" disabled selected>--CHOOSE ID TYPE--</option>   
                              </select>
                              <span class="form-control" id="spinAnimationSecBankId3"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                              <input type="hidden" class="form-control" id="newidtype2" name="newidtype2">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                              <span class="input-group-addon"  style="padding-right: 46px;">ID NUMBER:</span>
                              <input type="text" class="form-control" id="newidnumber" name="newidnumber" required='required'>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                              <span class="input-group-addon"  style="padding-right: 33px;">EXPIRY DATE:</span>
                              <input type="text" class="form-control clsDatePicker" name="newexpirydate" id="newexpirydate" required='required'>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                              <span class="input-group-addon"  style="padding-right: 45px;">ID PICTURE:</span>
                              <input type="file" class="form-control" id="file" name="file" title="No File Found" onchange="ValidateSingleInputSecBankId(this);" required='required' >
                              <input type="hidden" class="form-control" name="selvalidID1" id="selvalidID1">
                              <input type="hidden" class="form-control" name="create_new" id="create_new">
                              </div>
                            </div>
                       </div>
                       <div class="modal-footer">
                         <button type="submit" class="btn btn-primary" id="addNewIdSubmit" >Submit</button>
                        <a href="#" class="btn btn-warning" data-dismiss="modal">Close</a>
                      </div>
              </fieldset>
              </form>
              </div>
            </div>
        </div>

<!-- END OF SECURITY BANK -->

  <!---ADD NEW SENDER AND BENIFICIARY-->
  <div class="modal fade" id="addModal" role="dialog" >
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ADD NEW SENDER AND BENIFICIARY</h4>
          </div>
          <form action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post"  id="frmAddecashcredittobank">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
               
                          <div class="form-group">
                              <input type="text" class="form-control" name="inputFname" placeholder="FIRSTNAME"/>
                          </div>  
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputMname" placeholder="MIDDLENAME"/>
                          </div> 
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputLname"  placeholder="LASTNAME" />
                          </div> 
                           <div class="form-group">
                              <input type="email" class="form-control" name="inputEmail"  placeholder="EMAIL" />
                          </div>
                          <div class='col-md-8' style="padding-left:0px!important">
                             <div class="form-group" >
                                <input type="text" class="form-control" name="inputMobile" placeholder="MOBILE NUMBER"/>
                            </div> 
                          </div>
                           <div class='col-md-4'>
                             <div class="form-group">
                                <select name="selGender" class="form-control">
                                    <option value="" selected disabled>GENDER</option>
                                    <option value="Male">MALE</option>
                                    <option value="Femal">FEMALE</option>
                                </select>
                            </div> 
                          </div>
                           <div class="form-group"> 
                              <textarea name="inputAddr" class="form-control" placeholder="ADDRESS"></textarea>
                          </div> 
                          <div class='col-md-8' style="padding-left:0px!important">

                             <div class="form-group" >
                                 <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                                  <input type="text" class="form-control" name="inputBdate" id="datetimepicker" placeholder="BIRTHDATE" readonly />
                                </div>

                            </div> 
                          </div>
                           <div class='col-md-4'>
                             <div class="form-group">
                                <select name="selCountry" class="form-control">
                                    <option value="" selected disabled>COUNTRY</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Qatar">Qatar</option>
                                </select>
                            </div> 
                          </div>
                          <div class="form-group">
                              <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="inputTpass">
                          </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                  <div class="col-md-6 text-left">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>

                  <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-default" id="btnSubmit" name="btnAddDetails">Submit &nbsp;<img id="imgloader" src="<?php echo BASE_URL()?>assets/images/loaders/loader1.gif" style="display:none" /></button>
                  </div>
              </div>
              
            </form>
          </div>
        </div>
        
      </div>
    </div>
  <!---ADD NEW SENDER AND BENIFICIARY-->

<!-- MODAL -->
  <div class="modal fade" id="myModal" role="dialog" >
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">E-cash Credit to Bank</h4>
          </div>
          <form action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post"  id="frmProceedecashcredittobank">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                            <div class="form-group">
                            <select class="form-control" name="selBankID" id="selBankID">
                                <option value="" disabled selected>CHOOSE BANK</option>  
                                  <?php 
                                  date_default_timezone_set('Asia/Manila');
                                  foreach ($banks as $key => $value): 
                                  $arrayvalues = explode("*", $value);
                                  if($arrayvalues[2] == "DIGIBANKER" && date("H") >= 17){
                                  ?>
                                    <option value="<?php echo $value; ?>"><?php echo $arrayvalues[1]; ?></option>  
                                  <?php
                                  } else {
                                  ?>
                                    <option value="<?php echo $value; ?>"><?php echo $arrayvalues[1]; ?></option>  
                                  <?php } endforeach ?>
                            </select>
                          </div>
                          <div id="hidectb" style="display:none">
                            <div class="form-group">
                                <input type="text" class="form-control" name="inputAccountno" placeholder="ACCOUNT NO" required/>
                            </div>  
                            <div class="form-group">
                                <input type="text" class="form-control" name="inputBeneficiary" id="inputBeneficiary" placeholder="" readonly />
                            </div> 
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="inputId" id="inputId" placeholder="" readonly />
                            </div> 
                          
                            <div class="form-group">
                                <input type="text" class="form-control" name="inputIDType" id="inputIDType" placeholder="ID TYPE" required/>
                            </div> 
                            <div class="form-group">
                                <input type="text" class="form-control" name="inputIDNumber" id="inputIDNumber" placeholder="ID NUMBER" required/>
                            </div> 
                            <div class="form-group">
                                <input type="text" class="form-control" name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />
                            </div> 
                            <div class="form-group">
                                <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                            </div> 
                          <div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                  <div class="col-md-6 text-left">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>

                  <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit">Submit &nbsp;<img id="imgloader" src="<?php echo BASE_URL()?>assets/images/loaders/loader1.gif" style="display:none" /></button>
                  </div>
              </div>
            </div>
            </form>
        </div>

      </div>
    </div>
  <!-- MODAL -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

$(document).ready(()=>{

  var id;
  var idtypes;
  var TN;
  var C;
  var code;
  var bank;
  var group;

  $('#selBankID').change(()=>{
    // const arr = [1,2,3,6,7,9,10,11,12,14,15,16,17,18,20,21,22,23,24,26,27,28,29,30,31,32,34,35,36,37,38,40,41,42,43,45,48,53,59,65,63,64,66,67,68,70,71,72]
    const  val = $('#selBankID').val().split("*")
    // console.log(arr, val)
    code = val[0]
    bank = val[1]
    group = val[2]
    // console.log(code, bank, group)
    if(group === "DIGIBANKER"){
      // console.log('secbank')
      waitingDialog.show()
      remittance_search_sec_bank()

    }else{
      $('#hidectb').css('display','block')
      // console.log('other')
    }
    
  })

  remittance_search_sec_bank = () => {
    var b = $('#inputBeneficiaryHide').val().split("|")[0]
    var s = $('#inputSenderHide').val().split("|")[0]
    var form_data = new FormData();
    form_data.append('lbeneficiary',b)
    form_data.append('lsender',s)
    $.ajax({
      type: 'POST',
      url: `${location.protocol}//${window.location.host}/ecash_send/remittance_search_sec_bank`,
      data: form_data,
      processData: false,
      contentType: false,
      success: function (data) {
        waitingDialog.hide()
        var res = JSON.parse(data)
        if(res.S == 1){
          var value = res.result
          // console.log(value)
          $('#sendersName').val(value.sender.fullname)
          $('#sendersEmail').val(value.sender.email)
          $('#senderBday').val(value.sender.bdate)
          $('#senderNumber').val(value.sender.mobileno)
          $('#sbname').val(value.sender.brokenname)
          $('#scard').val(s)

          $('#benesName').val(value.beneficiary.fullname)
          $('#benesEmail').val(value.beneficiary.email)
          $('#beneBday').val(value.beneficiary.bdate)
          $('#beneNumber').val(value.beneficiary.mobileno)
          $('#bbname').val(value.beneficiary.brokenname)
          $('#bcard').val(b)

          $('#myModal').modal('hide')
          $('#secbankModal').modal('show')
        }else{
          alert('Try Again')
        }
      },
      error: function (data) {
        waitingDialog.hide()
        alert('Try Again')
        // console.log(data)
      }
    });
  }

  fetch_available_ids_post = () => {
    $('#spinAnimationsecbank1').show()
    $('#selvalidID1_secbank').css('display','none');
    var form_data = new FormData();
    var sender = $('#sbname').val().split("|")
    // console.log(sender)
    form_data.append('fname',sender[1])
    form_data.append('lname',sender[3])
    form_data.append('mname',sender[2])
    form_data.append('birthdate', $('#senderBday').val())

    $.ajax({
      type: 'POST',
      url: `${location.protocol}//${window.location.host}/ecash_send/fetch_available_ids_post`,
      data: form_data,
      processData: false,
      contentType: false,
      success: function (data) {
        waitingDialog.hide()
        var res = JSON.parse(data)
        if(res.S == 1){
          id = res.T_DATA.filter(i => i.secbank_idtype != null);
          $('#selvalidID1_secbank').empty()
          $('#selvalidID1_secbank').append(`<option value="" disabled selected>--CHOOSE VALID ID--</option>`);
          id.map((data)=>{
            $('#selvalidID1_secbank').append(`<option value=${data.secbank_code}*${data.id}>${data.description}</option>`);
          })
          $('#selvalidID1_secbank').append(`<option value="add_id">--ADD NEW ID--</option>`);
          $('#spinAnimationsecbank1').hide()
          $('#selvalidID1_secbank').css('display','block');
        }else{
          alert('Try Again')
        }
      },
      error: function (data) {
        waitingDialog.hide()
        alert('Try Again')
        // console.log(data)
      }
    });
  }

  var _validFileExtensions = [".jpg", ".jpeg", ".png"];    
  function ValidateSingleInputSecBankId(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                alert("Your uploaded file type is not allowed \n\n Allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}

  $('#selvalidID1_secbank').change(()=>{
    $('#id_details1_secbank').css("display",'none')
    $('#idsecdiv').css("display","none")
    $('#id_details2_secbank').css("display",'none')
    $('#selvalidID2_secbank').empty()

    $('#id_detailtype1').val('')
    $('#id_detailnumber1').val('')
    $('#id_detailexpiry1').val('')
    $('#id_detailcreated1').val('')
    $('#id_attachment1').attr('href','')
    $('#id_secbank_type1').val('')


    if($('#selvalidID1_secbank').val() == 'add_id'){
      $('#myModalSecBankId').modal('show')
      fetch_secbank_id_types('ADD',$('#selvalidID1_secbank').val())
      $('#newheading').text('ADD NEW ID')
    } else{
      var value = $('#selvalidID1_secbank').val().split('*')[1]
        const result = id.filter(i => i.id == value)[0];
        $('#id_detailtype1').val(result.description)
        $('#id_detailnumber1').val(result.number)
        $('#id_detailexpiry1').val(result.expiry)
        $('#id_detailcreated1').val(result.created)
        $('#id_detail').val(result.secbank_idtype)
        $('#id_attachment1').attr('href',result.attachment)
        $('#id_details1_secbank').css("display",'block')
        $('.idsOne').text('PRIMARY ID:')
        $('#labelId1').text('PRIMARY ID:')
        $('#id_secbank_type').val(result.secbank_code)
        

      if(result.is_expired == "EXPIRED"){
        $('#myModalSecBankId').modal('show')
        fetch_secbank_id_types('UPDATE',$('#selvalidID1_secbank').val())
        $('#newheading').text('Update ID')
        $('#id_details1_secbank').css('display','none');
      } else {

        if(result.secbank_idtype == "SECONDARY"){
          $('#selvalidID2_secbank').append(`<option value="" disabled selected>--CHOOSE VALID ID--</option>`);
          id.filter(i => i.id != value).map((data)=>{
              if(data.secbank_idtype == "SECONDARY"){
                $('#selvalidID2_secbank').append(`<option value=${data.secbank_code}*${data.id}>${data.description}</option>`);
              }
              $('.idsOne').text('SECONDARY ID 1:')
              $('#labelId1').text('SECONDARY ID 1:')
            })
            $('#selvalidID2_secbank').append(`<option value="add_id">--ADD NEW ID--</option>`);
            $('#idsecdiv').css("display","block")
            $('#spinAnimationsecbank2').hide()
            $('#selvalidID2_secbank').css('display','block');
        }
      }

    }
  })

  $('#selvalidID2_secbank').change(()=>{
    $('#id_detailtype2').val('')
    $('#id_detailnumber2').val('')
    $('#id_detailexpiry2').val('')
    $('#id_detailcreated2').val('')
    $('#id_attachment2').attr('href','')
    $('#id_secbank_type2').val('')
    if($('#selvalidID2_secbank').val() == 'add_id'){
      $('#myModalSecBankId').modal('show')
      fetch_secbank_id_types('ADD',$('#selvalidID2_secbank').val())
      $('#newheading').text('ADD NEW ID')
      $('#id_details1_secbank').css("display",'none')
      $('#idsecdiv').css("display","none")
      $('#id_details2_secbank').css("display",'none')
      $('#selvalidID2_secbank').empty()
    } else{
    var value = $('#selvalidID2_secbank').val().split('*')[1]
    const result = id.filter(i => i.id == value)[0];
    // console.log(result)
      if(result.is_expired == "EXPIRED"){
        $('#myModalSecBankId').modal('show')
        fetch_secbank_id_types('UPDATE',$('#selvalidID1_secbank').val())
        $('#newheading').text('Update ID')
        $('#id_details1_secbank').css('display','none');
        $('#id_details2_secbank').css('display','none');
      }else{
          const id1data = $("#selvalidID1_secbank option:selected").text();
          $('#selvalidID1_secbank').empty()
          $('#selvalidID1_secbank').append(`<option value="" disabled selected>--CHOOSE VALID ID--</option>`);
          id.filter(i => i.id != value).map((data)=>{
            $('#selvalidID1_secbank').append(`<option value=${data.secbank_code}*${data.id}>${data.description}</option>`);
            })
          $('#selvalidID1_secbank').append(`<option value="add_id">--ADD NEW ID--</option>`);
          $('#id_detailtype2').val(result.description)
          $('#id_detailnumber2').val(result.number)
          $('#id_detailexpiry2').val(result.expiry)
          $('#id_detailcreated2').val(result.created)
          $('#id_attachment2').attr('href',result.attachment)
          $('#id_secbank_type2').val(result.secbank_code)
          $('#id_details2_secbank').css("display",'block')
          $("#selvalidID1_secbank option:selected").text(id1data);
      }
    }
  })

  $('#submit').click(()=>{
    var tab = $(".secbank li.active").text().trim()

    switch(tab){
      case "Sender Details":
        if($('#senderAddress').val() == ""){
          alert('Sender Address is required')
        }else  if($('#senderNationality').val() == ""){
          alert('Sender Nationality is required')
        }else if($('#senderBplace').val() == ""){
          alert('Sender Birthplace is required')
        }else if($('#senderSof').val() == ""){
          alert('Sender Source of Fund is required')
        }else if($('#senderNow').val() == ""){
          alert('Sender Nature of Work is required')
        }else{
          $('.nav-tabs a[href="#beneDetails"]').tab('show')
        }
      break;
      case "Beneficiary Details" :
        fetch_available_ids_post()
        $('.nav-tabs a[href="#accntDetails"]').tab('show')
        $('#submit').text("Submit")
        $('#id_details1_secbank').hide()
        $("#bank").val(bank)
      break;
      case "Account Details":
      if($('#id_detailtype1').val() == ""){
        alert('ID is required')
      }else if($('#id_detail').val() == 'SECONDARY' && $('#id_detailtype2').val() == "" ){
        alert('ID 2 is required')
      }else if($('#amount').val() == ""){
        alert('Amount is required')
      }else if($('#secbankAccntNo').val() == ""){
        alert('Account No is required')
      }else if($('#trPass').val() == ""){
        alert('Transaction Password is required')
      }else{
        $('#secbankfrm').submit()
      }
      break;
      default:

      break;
    }
  })

  $('#secbankModal').on('hidden.bs.modal', function () {
    $('.nav-tabs a[href="#sendTab"]').tab('show')
    $('#submit').text("Next >")
  });

  $('#myModal').on('hidden.bs.modal', function () {
     $('#selBankID').val("")
     $('#hidectb').css('display','none')
     
  });

  $('#myModalSecBankId').on('hidden.bs.modal', function () {
    $('#newidtype').empty()
    $('#newidtype').prop('readonly',false)
    $('#newidnumber').prop('readonly',false)
    $('#newidnumber').val('')
    $('#newexpirydate').val('')
    $('#file').val('')
    $('#newidtype').css("display","none");
    $('#spinAnimationSecBankId3').css("display","block");
    $('#addnewsuccess').css('display','none')
    $('#updateexpired').css('display','none')
    $('#addNewIdSubmit').prop('disabled',false)
    $('#addNewIdSubmit').show()
    $('#dataSecBankId')[0].reset()
    fetch_available_ids_post()
  });

  $('#refreshctb').click(()=>{
    waitingDialog.show()
    fetch_available_ids_post()
    $('.idsOne').text('PRIMARY ID:')
    $('#id_details1_secbank').css("display",'none')
    $('#idsecdiv').css("display","none")
    $('#id_details2_secbank').css("display",'none')
    $('#selvalidID2_secbank').empty()
  })

  $('#newidtype').change(()=>{
    id.map((i)=>{
      if(i.expirable == 'YES'){
        $('#newexpirydate').val("NO EXPIRY")
        $('#newexpirydate').prop('disabled',true)
      }else{
        $('#newexpirydate').val("")
        $('#newexpirydate').prop('disabled',false)
      }
    })
  })

  $('#secbankAccntNo').keypress(function(event){
            // console.log(event.which);
        if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
            event.preventDefault();
        }});

  $('#secbankfrm').on('submit',()=>{secbankFirstSubmit(); return false;})

  $("#newidnumber").change(function () {      

    var newidtype = $("#newidtype").val();
    var newidnumber = $("#newidnumber").val();

    const idrule = idtypes.filter(e=>e.id === newidtype)[0]
    var rule = idrule.rule;
    
    var rule = rule.replace("/g", "");
    var rule = rule.replace("/", "");
    // var rule = rule.replace("^", "");

    var rules = new RegExp(rule, "g");

    if(newidtype == id)
    {

          if(rules.test(newidnumber))
          {
          $("#updateexpired").hide();
          }
          else
          {
          $("#updateexpired").html("Please match the format of the ID type chosen.");
          $("#updateexpired").show();

          }

    }

    
});



  $('#dataSecBankId').on('submit',()=>{
    const newidtype = $('#newidtype').val()
    var newidnumber = $("#newidnumber").val();
    const idrule = idtypes.filter(e=>e.id === newidtype)[0]
    var rule = idrule.rule;
    
    var rule = rule.replace("/g", "");
    var rule = rule.replace("/", "");
    var rules = new RegExp(rule, "g");

    if(rules.test(newidnumber)) {
      $("#updateexpired").hide();
      $('#addnewsuccess').css('display','none')
      $('#updateexpired').css('display','none')
      waitingDialog.show()
      formData = $('#dataSecBankId')[0]
      var form_data = new FormData(formData)
      var sender = $('#sbname').val().split("|")
      form_data.append('senderfname',sender[1])
      form_data.append('senderlname',sender[3])
      form_data.append('sendermname',sender[2])
      form_data.append('senderbdate', $('#senderBday').val())

      $.ajax({
        type: 'POST',
        url: `${location.protocol}//${window.location.host}/ecash_send/add_newid_secbank`,
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
          waitingDialog.hide()
          var res = JSON.parse(data)
          if(res.S == 1){
            // console.log(res)
            $('#addnewsuccess').css('display','block')
            $('#addnewsuccess').text(res.M)
            $('#addNewIdSubmit').prop('disabled',true)
            $('#addNewIdSubmit').fadeOut( 5000, () => {
              $('#myModalSecBankId').modal('hide')
            });
          }else{
            $('#updateexpired').css('display','block')
            $('#updateexpired').text(res.M)
          }
        },
        error: function (data) {
          waitingDialog.hide()
          $('#updateexpired').css('display','block')
          $('#updateexpired').text('Please Try Again Later')
          // console.log(data)
        }
      });
    } else {
        $("#updateexpired").html("Please match the format of the ID type chosen.");
        $("#updateexpired").show();

    }
   
    return false;

  })

  fetch_secbank_id_types = (type,idValue) => {

    $.ajax({
      type: 'POST',
      url: `${location.protocol}//${window.location.host}/ecash_send/fetch_secbank_id_types`,
      processData: false,
      contentType: false,
      success: function (data) {
        waitingDialog.hide()
        var res = JSON.parse(data)
        if(res.S == 1){
          $('#create_new').val(type)
          idtypes = res.T_DATA.filter(i => i.secbank_idtype != null)
          if(type == 'UPDATE'){

            var value = idValue.split("*")[1];
            const result = id.filter(i => i.id == value)[0];
            idtypes.map((id)=>{
              if(result.description == id.description){
                $('#newidtype').append(`<option value="${id.id}">${id.description}</option>`)
              }
            })

            $('#newidtype').css("display","block");
            $('#spinAnimationSecBankId3').css("display","none");
            $('#newidtype option:selected').text(result.description)
            $('#newidnumber').val(result.number)
            $('#newidtype').prop('readonly',true)
            $('#newidnumber').prop('readonly',true)
            $('#selvalidID1').val(value)
          }else{
            var value = idValue.split("*")[1];
            idtypes.map((id)=>{
              $('#newidtype').append(`<option value="${id.id}">${id.description}</option>`)
            })
            $('#newidtype').css("display","block");
            $('#spinAnimationSecBankId3').css("display","none");
          }
        }else{
          alert(res.M)
        }
      },
      error: function (data) {
        waitingDialog.hide()
        alert('Try Again')
        // console.log(data)
      }
    });

    }
 
    $('#secbankConfirmSubmit').on('submit',(e)=>{
      var formData = $('#secbankConfirmSubmit')[0]
      // console.log($('#secbankConfirmSubmit')[0])
      var form_data = new FormData(formData)
      form_data.append('bank_id',code)
      form_data.append('TN',TN)
      form_data.append('C',C)

      waitingDialog.show()
      $.ajax({
      type: 'POST',
      url: `${location.protocol}//${window.location.host}/ecash_send/remittance_send_sec_bank_confirm`,
      data: form_data,
      processData: false,
      contentType: false,
      success: function (data) {
        waitingDialog.hide()
        var res = JSON.parse(data)
        if(res.S == 1){
          // console.log(res)
          $('#secbankConfirmSubmitdiv').empty()
          $('#secbankConfirmSubmitdiv').append(`
          <div class="alert alert-warning" ><b>Waiting for transaction approval..</b>
            <p><b>Transaction Number: </b>${res.TN}</p>
          </div> 
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-info" onclick="location.reload(true)">Take Another Transaction</button>
            </div>
          </div>
          `)

        }else{
          alert(`${res.M} \nTransaction Failed \nPlease restart your transaction again`)
          location.reload(true)
        }
      },
      error: function (data) {
        waitingDialog.hide()
      }
    });
    return false;
    e.preventDefault();
    })

  secbankFirstSubmit = () => {
    waitingDialog.show()
    var form_data = new FormData()
    form_data.append('transpass',$('#trPass').val())
    form_data.append('accountno',$('#secbankAccntNo').val())
    form_data.append('amount',$('#amount').val())
    form_data.append('bene_name',$('#benesName').val())
    form_data.append('code',code)
    form_data.append('bank',bank)

     $.ajax({
      type: 'POST',
      url: `${location.protocol}//${window.location.host}/ecash_send/remittance_send_sec_bank`,
      data: form_data,
      processData: false,
      contentType: false,
      success: function (data) {
        waitingDialog.hide()
        var res = JSON.parse(data)
        if(res.S == 1){
          TN = res.TN;
          C = res.C;
          var country = $('#country').val()
          $('#content').css('display','none')
          $("#sendTab").clone().appendTo("#secbankConfirmSubmit");
          $("#beneDetails").clone().appendTo("#secbankConfirmSubmit");
          $("#accntDetails").clone().appendTo("#secbankConfirmSubmit");
          $('#secbankConfirmSubmitdiv').css('display','block')
          $("#secbankConfirmSubmit #countryDiv").empty()
          $("#secbankConfirmSubmit #accntDetails #countryDiv").append(`
          <label for="country">Country</label>
          <input value="${country}" name="country" class="form-control"/>`)
          $("#secbankConfirmSubmit input").prop("disabled", false);
          $("#secbankConfirmSubmit select").prop("disabled", false);
          $("#secbankConfirmSubmit input").prop("readonly", true);
          $("#secbankConfirmSubmit select").prop("readonly", true);
          $("#secbankConfirmSubmit #accntDetails").css('overflow-x','');
          $("#secbankConfirmSubmit #accntDetails").css('max-height','');
          $("#secbankConfirmSubmit #idsecdiv").remove();
          $("#secbankConfirmSubmit #idsecdiv1").remove();
          $("#secbankConfirmSubmit #trPassDiv").css('display','none');
          $("#secbankConfirmSubmit").append(`<br/> <br/><div class="col-md-12 text-right">
                            <button id="btnCancel" type="button" onclick="location.reload(true)" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</button>
                            <button type="submit" id="btnSecBankSubmit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Submit</button>
                          </div>`)
          $('#secbankModal').modal('hide')
          
        }else{
          alert(res.M)
        }
      },
      error: function (data) {
        waitingDialog.hide()
        alert('Try Again')
        // console.log(data)
      }
    });

  }
})
</script>