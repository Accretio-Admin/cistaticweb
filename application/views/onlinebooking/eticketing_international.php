<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ONLINE BOOKING</li>
                </ul>
                <h4>INTERNATIONAL FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
      <?php if ($API['S'] ===0): ?>
            <div class="alert alert-danger"><?php echo $API['M']; ?></div>
      <?php endif ?>
        <?php if ($API['S'] == 1): ?>
              <div class="alert alert-success"><?php echo $API['M']; ?> : Check Status Successful Please Click Again</div>
      <?php endif ?>
        <div class="row row-stat">
            <div class="col-xs-12 col-md-12 text-right">
                  <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><?php echo $result['M']; ?></h5>
            </div>
            <div class="col-xs-12 col-md-12">
              <div class="contentpanel" style="padding-top: 0px;"> 
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px; color: #4169E1; font-weight: bold;">E-TICKETING LOGS</div>
                      <div class="panel-body" style="height: 600px;overflow: scroll;" >
                        <div class="row">
                          <table class="table table-bordered">
                            <thead>
                                <tr nowrap>
                                  <?php foreach ($field as $f): ?>
                                      <th><?php echo $f?></th>
                                  <?php endforeach ?>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($result['record'] as $t ): 
                              $passenger = explode('|^@^|',$t['passenger']);
                              $fname = explode(":", $passenger[2]);
                              $lname = explode(":", $passenger[3]);
                              $name  = $fname[1].' '.$lname[1];
                              $onward = explode("|^@^|", $t['onward']);
                              $flights = $onward[0]."-".$onward[1];  

                              // echo $t['BS'];
                              // var_dump($result['record']); die;              
                              ?>
                                   <tr class="trPNR">
                                     <?php 
                                    if(preg_match("/\bcancel|abort|failed\b/i",$t['BS'])) { ?>
                                        <td><a onclick="return confirm('This flight is <?php echo $t['BS'] ?> could not generate a report.','International Ticketing Transactions')" class="btn btn-danger" id="aPNR" data-toggle="tooltip" title="This flight is <?php echo $t['BS'] ?> could not generate a report."><?php echo $t['BS'] ?></a></td>
                                    <?php }
                                      else if($t['provider']=='ABACUS' && $t['status']==5) { ?>
                                        <td><a onclick="return confirm('This flight is <?php echo $t['BS'] ?> could not generate a report.','International Ticketing Transactions')" class="btn btn-danger" id="aPNR" data-toggle="tooltip" title="This flight is <?php echo $t['BS'] ?> could not generate a report."><?php echo $t['BS'] ?></a></td>

                                    <?php }
                                      else if(($t['provider']=='BYAHEKO' || $t['provider']=='byaheko') && $t['BS']=='FARE_ADJ') { ?>
                                        <td>
                                          <!-- <a onclick="return confirm('This flight is <?php echo $t['BS'] ?> could not generate a report.','Domestic Ticketing Transactions')" class="btn btn-primary" id="aPNR" data-toggle="tooltip" title="This flight is <?php echo $t['BS'] ?> could not generate a report."><?php echo 'Check Status' ?></a>  -->

                                          <button type="button" class="btn btn-primary btn_ModalSubmit" data-name="<?php echo $name ?>" data-tn="<?php echo $t['tn'] ?>" data-status="<?php echo $t['BS'] ?>" data-adjfee="<?php echo $t['adjustmentFee'] ?>" data-toggle="modal" id="btnSubmit" data-target="#" href="#myModal1">Check Status ?</button>

                                        </td>

                                    <?php }
                                      else if(($t['provider']=='BYAHEKO' || $t['provider']=='byaheko') && $t['BS']=='FARE_ADJ_CONF') { ?>
                                        <td>
                                          <a onclick="return confirm('This flight is Fare Adjustment Confirmation could not generate a report. Still on process. Please wait...','International Ticketing Transactions')" class="btn btn-info" id="aPNR" data-toggle="tooltip" title="This flight is <?php echo $t['BS'] ?> could not generate a report."><?php echo 'Verify Status' ?></a> 

                                          <!-- <button type="button" class="btn btn-primary btn_ModalSubmit" data-name="<?php echo $name ?>" data-tn="<?php echo $t['tn'] ?>" data-status="<?php echo $t['BS'] ?>" data-adjfee="<?php echo $t['adjustmentFee'] ?>" data-toggle="modal" id="btnSubmit" data-target="#">Check Status ?</button> -->

                                        </td>

                                    <?php } else { 
                                       if ($t['BS'] == "To Deliver"): ?>
                                        <td><a id="aPNR" class="btn btn-warning" href="https://mobilereports.globalpinoyremittance.com/portal/ticketing_international_receipt/<?php echo $t['tn'] ?>" target="_blank" data-toggle="tooltip" title="Click here get receipt"><?php echo 'Get ticket' ?></a></td>
                                        <?php else:?>

                                          <?php if ($t['provider']=='ABACUS') { ?>
                                            <td><a onclick="return confirm('This flight is <?php echo $t['BS'] ? $t['BS'] : "POSTED" ?> could not generate a report. Please create a ticket at https://csr.gomigu.com/login to verify your transactions.','International Ticketing Transactions')" class="btn btn-info" id="aPNR" data-toggle="tooltip" title="Could not generate a report or create a ticket at https://csr.gomigu.com/login."><?php echo 'Verify Status' ?></a></td>
                                          
                                          <?php } else if ($t['provider']=='BYAHEKO' || $t['provider']=='byaheko') { ?>   
                                            <td><a onclick="return confirm('Check Status?','International Ticketing Transactions')" href="<?php echo BASE_URL() ?>Merged_intl_flights/eticketing_international/2/<?php echo $t['tn'] ?>" class="btn btn-primary" id="aPNR" data-toggle="tooltip" title="Click here to check status"><?php echo 'Check Status' ?></a></td>
                                          
                                          <?php } else if ($t['provider']=='AMADEUS') { ?>   
                                            <td><a onclick="return confirm('This flight is <?php echo $t['BS'] ? $t['BS'] : "POSTED" ?> could not generate a report. Please create a ticket at https://csr.gomigu.com/login to verify your transactions.','International Ticketing Transactions')" class="btn btn-info" id="aPNR" data-toggle="tooltip" title="Could not generate a report or create a ticket at https://csr.gomigu.com/login."><?php echo 'Verify Status' ?></a></td>

                                          <?php } else if ($t['provider']=='SCOOT' || $t['provider']=='scoot') { ?>   
                                            <td><a onclick="return confirm('This flight is <?php echo $t['BS'] ? $t['BS'] : "POSTED" ?> could not generate a report. Please create a ticket at https://csr.gomigu.com/login to verify your transactions.','International Ticketing Transactions')" class="btn btn-info" id="aPNR" data-toggle="tooltip" title="Could not generate a report or create a ticket at https://csr.gomigu.com/login."><?php echo 'Verify Status' ?></a></td>

                                            <!-- Transaction completed pending verification of the submitted travel documents. You may generate your E-ticket within the hour. Thank you. -->

                                          <?php } else { ?>   
                                            <td><a onclick="return confirm('Check Status?','International Ticketing Transactions')" href="<?php echo BASE_URL() ?>Merged_intl_flights/eticketing_international/1/<?php echo $t['tn'] ?>" class="btn btn-primary" id="aPNR" data-toggle="tooltip" title="Click here to check status"><?php echo 'Check Status' ?></a></td>
                                          <?php } ?>

                                       <?php endif; 
                                     }
                                     ?>
                                      <td><?php echo $t['tn'] ?></td>
                                      <td class="tdPNR"><?php echo $t['PNR'] ?></td>
                                      <td><?php echo $name; ?></td>
                                      <td><?php echo $flights; ?></td>
                                      <td><?php echo $onward[2]; ?></td>
                                      <td><?php echo $onward[3]; ?></td>
                                      <td><?php echo $onward[4]; ?></td>
                                      <td><?php echo $onward[5]; ?></td>
                                      <td><?php echo "-";  ?></td>
                                      <td><?php echo $t['markupFee'] ?></td>
                                      <td><?php echo $t['totalFee'] ?></td>
                                      <td><?php echo "-"; ?></td>
                                  </tr>
                              <?php endforeach ?>
                               
                            </tbody>
                          </table>
                        </div>
                   </div>
              </div>   
            </div>
        </div>
    </div>

    <?php if ($API['S'] ===0): ?>
          <div class="alert alert-danger"><?php echo $API['M']; ?></div>
    <?php endif ?>
    <?php if ($API['S'] == 1): ?>
          <div class="alert alert-success"><?php echo $API['M']; ?> : Check Status Successful Please Click Again</div>
    <?php endif ?>

</div>


<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="<?php echo BASE_URL() ?>Merged_intl_flights/eticketing_international" method="post" class="loading modal_loading" id="frmEticketsCon">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">INTL BOOKING STATUS CONFIRMATION</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <p>Your booking status is <b>FARE INCREASE</b>. If you want to <b>PROCEED</b> please click <b>"confirm button"</b> to proceed your transaction else click <b>"cancel button"</b> to cancel your transaction</p>
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right:42px;">Transaction No. :</span>
                <!-- <span class="form-control" id="basic-addon2" style=""><label id="idTrackno" class="idTrackno"></label></span> -->
                <input type="text" class="form-control" name="trackno" id="idTrackno" readonly />
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right:33px;">Passenger Name :</span>
                <!-- <span class="form-control" id="basic-addon2" style=""><label id="idName" class="idName"></label></span> -->
                <input type="text" class="form-control" name="fullname" id="idName" readonly />
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right:101px;">Status :</span>
                <!-- <span class="form-control" id="basic-addon2" style=""><label id="idStatus" class="idStatus"></label></span> -->
                <input type="text" class="form-control" name="status" id="idStatus" readonly />
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right:43px;">Adjustment Fee :</span>
                <!-- <span class="form-control" id="basic-addon2" style=""><label id="idAsjFee" class="idAsjFee"></label></span> -->
                <input type="text" class="form-control" name="adjustmentfee" id="idAsjFee" readonly />
              </div>
            </div>

          </div>
          
          <div class="form-group">
            <div class="input-group">
                <!-- <span class="input-group-addon" id="basic-addon1" style="padding-right:16px;">Trasaction Password :</span>
                <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required /> -->

                <input type="checkbox" value="" required> <span> I have read and accept the <b>procedure</b>.</span>

              </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="btnSubmitTxn" value="1">Confirm</button>
          <button type="submit" class="btn btn-danger" name="btnCancelTxn" value="0">Cancel</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script>
  $(document).ready(function(){
     
    $('.btn_ModalSubmit').click(function() {
    
      // $('#myModal1').hide();

      // var name    = $('.btn_ModalSubmit').data('name');
      // var trackno = $('.btn_ModalSubmit').data('tn');
      // var status  = $('.btn_ModalSubmit').data('status');
      // var fee     = $('.btn_ModalSubmit').data('adjfee');

      var name    = $(this).data('name');
      var trackno = $(this).data('tn');
      var status  = $(this).data('status');
      var fee     = $(this).data('adjfee');
      
      var statusmsg  = 'FARE INCREASE';

      // alert(trackno);

      if(name && trackno && status && fee) {
        $('#myModal1').modal('show');

        $('#myModal1 #idName').val(name);
        $('#myModal1 #idTrackno').val(trackno);
        $('#myModal1 #idStatus').val(statusmsg);  
        $('#myModal1 #idAsjFee').val(fee); 
      }

    });

    $('#frmEticketsCon').on('submit',function(){
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    });
    
  });

//   $(document).on("click", ".btn_ModalSubmit", function () {
//      var myBookId = $(this).data('name');

//      alert(myBookId);
//      // $(".modal-body #bookId").val( myBookId );
//      // As pointed out in comments, 
//      // it is superfluous to have to manually call the modal.
//      // $('#addBookDialog').modal('show');
// });

</script>