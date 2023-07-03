<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-anchor"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ONLINE SHIPPING</li>
                </ul>
                <h4>SHIPPING</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <div class="row">
            <div class="col-md-12 hidden-xs " align="center" style="margin-bottom:10px">
               <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

                    <!-- ups-leaderboard -->
<!--                     <ins class="adsbygoogle"
                         style="display:inline-block;width:728px;height:90px"
                         data-ad-client="ca-pub-1517010537439957"
                         data-ad-slot="4829683428"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script> -->
            </div>
        </div>
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
                                <tr>
                                  <?php foreach ($field as $f): ?>
                                      <th><?php echo $f?></th>
                                  <?php endforeach ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th> Rows</th>
                                <th> Date Created</th>
                                <th> Status</th>
                                <th> Tracking no.</th>
                                <th> PNR</th>
                                <th> Passengers</th>
                                <th> Booked to</th>
                                <th> Source - Destination</th>
                                <th> Departure</th>
                                <th> Time</th>
                                <th> Seat Class</th>
                                <th> Total Fee</th>
                                </tr>

                                
                                <?php for($a = 0; $a < $results['count']['count']; $a++){ ?>
                                <tr>
                                <td><b><?php echo $a+1; ?></b></td>
                                <td><?php echo $results['result'][$a]['createdAt']; ?></td>

                                <?php if($results['result'][$a]['status'] == "APPROVED"){ ?>
                                <td><button type="button" class="btn btn-success" data-toggle="modal" onclick="approved('<?php echo $results['result'][$a]['trackingno']; ?>')" data-target="#myModal">APPROVED</button></td>
                                <?php }else if($results['result'][$a]['status'] == "PENDING"){ ?>
                                <td><button type="button" class="btn">PENDING</button></td>
                                <?php }else if($results['result'][$a]['status'] == "REVOKED"){ ?>
                                <td><button type="button" class="btn btn-warning">REVOKED</button></td>
                                <?php } ?>

                                <td><?php echo $results['result'][$a]['trackingno']; ?></td>
                                <td><?php echo $results['result'][$a]['shippingPNR']; ?></td>
                                <td><button type="button" class="btn btn-primary viewpassengers" data-toggle="modal" data-target="#myM" name="<?php echo $results['result'][$a]['trackingno']; ?>">View Passengers</button></td>
                                <td><?php echo $results['result'][$a]['shipname']; ?></td>
                                <td><?php echo $results['result'][$a]['shipfrom']. " - " .$results['result'][$a]['shipto']; ?></td>
                                <td><?php echo $results['result'][$a]['departure']; ?></td>
                                <td><?php echo $results['result'][$a]['shippingfromtime']. " - " .$results['result'][$a]['shippingtotime']; ?></td>
                                <td><?php echo $results['result'][$a]['seatname']; ?></td>
                                <td><b>P <?php echo $results['result'][$a]['totalamount']; ?></b></td>
                                </tr>
                                <?php } ?>
                                
                               
                            </tbody>
                          </table>
                        </div>
                   </div>
              </div>   
            </div>
        </div>
    </div>

<script>
function approved(e){
  $('#eticket').prop('href',`https://mobilereports.globalpinoyremittance.com/portal/ship_receipt/${e}`);
  $(".eticket").html(e);
}
</script>



</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Issue Ticket</h4>
      </div>
      <div class="modal-body">
        <center><p>Are you sure you want to generate the e-ticket of <b><span class="eticket"></span></b> ?</p></center>
      </div>
      <!-- <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo "<span class='eticket'></span>"  ?>" target="_blank"><span id="b"></span></a> -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="" target="_blank" class="btn btn-success" id="eticket">GENERATE</a>
      </div>
    </div>

  </div>
</div>

<div id="myM" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Passengers' Details</h4>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div id="p"></div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
$("#eticket").click(function(){
  var ticket = $(".eticket").html();

    $.ajax({
              type: 'POST',
              url: `/Shipping/ShippingGenerated`,
              data: {ticket : ticket},
              success: function (data) {
                var res = JSON.parse(data);
                console.log(res);
 
              },
              error: function (data) {
                console.log(data)
              }
            });




});

$(".viewpassengers").click(function(){
  var tr = $(this).attr('name');
  var a = "";
  $("#p").html("");
  waitingDialog.show();
  $.ajax({
    type: 'POST',
    url: `/Shipping/viewPassengers`,
    data: {trackno : tr},
    success: function (data) {
      var res = JSON.parse(data);
      console.log(res);

      
      a = `          
        <table class="table">
          <thead>
            <tr>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Birthday</th>

              <th>Mobile Number</th>
              <th>Email Address</th>
              <th>Age</th>
            </tr>
          </thead>
          <tbody>`;

    for(var x = 0; x < res.passengers.length; x++){
      a = a + `
      
            <tr>
              <td>${res.passengers[x].fname}</td>
              <td>${res.passengers[x].lname}</td>
              <td>${res.passengers[x].bday}</td>

              <td>${res.passengers[x].mobile}</td>
              <td>${res.passengers[x].email}</td>
              <td>${res.passengers[x].age}</td>
            </tr>
           
      `;
    }

      a = a + `</tbody>
        </table>
      `;

      $("#p").html(a);
      waitingDialog.hide();
      // alert(res.passengers.length);

    },
    error: function (data) {
      console.log(data)
    }
  });

});
</script>

<!-- <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo "<span class='eticket'></span>"  ?>" target="_blank"><span id="b"></span></a> -->


<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<!-- <script>
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

</script> -->