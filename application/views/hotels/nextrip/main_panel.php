<?php
  if($user['R'] == "FAC0026"){
?>
<div id="fac" class="modal fade">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <p>This service is temporarily unavailable in your account.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="buttonfac" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php
  }
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
<script>
$(document).ready(function(){
  $("#fac").modal("show");
});

$("#buttonfac").click(function(){
  $("#send").hide();
  setTimeout(function() {
  window.location.href = "/Main";
}, 100);
});

$("#fac").click(function(){
  $("#send").hide();
  setTimeout(function() {
  window.location.href = "/Main";
}, 100);
});
$(document).ready(function () {
        var x=window.scrollX;
        var y=window.scrollY;

        window.onscroll=function () {
          window.scrollTo(x, y);
        };
        
        setTimeout(() => {
          window.onscroll= function () {
          };
        }, 800);
      });
</script>

<style>
    .id_file {
      position: relative;
      overflow: hidden;
      background-color: #FFC914;
    }

    .file-upload {
      position: absolute;
      font-size: 50px;
      opacity: 0;
      right: 0;
      top: 0;
    }
      
    .ups-btn{
      height: 56px;
      width: 160px;
      border-radius: 12px !important;
      padding: 8px 40px 8px 40px !important;
      border:none !important;
      background-color: #FFC914;
      color: white;
    }
    .ups-btn[disabled]{
          background-color: #cccccc;
          color: #666666
    }

    .ups-btnRecords{
      height: 56px;
      width: 322px;
      border-radius: 12px !important;
      padding: 8px 40px 8px 40px !important;
      border:none !important;
      background-color: #FFC914;
      color: white;
    }

    .img-title{
      height: 180px;
      width: 950px;
      border-radius: 20px;
    }
    
    /* Select CSS */
    /*the container must be positioned relative:*/
    .id-select {
      position: relative;
      width: 360px;
      border-radius:10px;
      background-color: #F4F4F4;
      color: black;
      height:38px; 
      border:none
    }

    .id-select select {
      display: none; /*hide original SELECT element:*/
    }

    .select-selected{
      width: 235;
      height: 38px;
      border-radius:10px; 
      color: black !important;
      font-size: 20px;
      font-weight: 500;
      padding-top: 5px !important;
    }

    /*style the arrow inside the select element:*/
    .select-selected:after {
      position: absolute;
      content: "";
      top: 18px;
      right: 25px;
      width: 0;
      height: 0;
      border: 6px solid transparent;
      border-color: black transparent transparent transparent;
    }

    /*point the arrow upwards when the select box is open (active):*/
    .select-selected.select-arrow-active:after {
      border-color: transparent transparent black transparent;
      top: 14px;
    }

    /*style the items (options), including the selected item:*/
    .select-items div,.select-selected {
      color: black;
      padding: 8px 16px;
      border: 1px solid transparent;
      border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
      cursor: pointer;
      user-select: none;
    }

    /*style items (options):*/
    .select-items {
      position: absolute;
      background-color: #FFC914;
      left: 0;
      right: 0;
      z-index: 99;
      width:360px;
      overflow-y: scroll;
      height: auto;
      max-height: 200px;
    }

    /*hide the items when the select box is closed:*/
    .select-hide {
      display: none;
    }

    .select-items div:hover, .same-as-selected {
      background-color: rgba(0, 0, 0, 0.1);
    }

    .btn-record-search{
      border: none;
      width:1238px;
      height:60px;
      border-radius: 16px;
      background-color:#FFF8E0;
      font-size: 18px;
      font-weight: 500;
    }

    .arrow-back{
      float: left;
      margin-left: 10px;
    }

    /* The container */
    .container1 {
      display: block;
      position: relative;
      padding-left: 20px; 
      cursor: pointer;
      font-weight: 400;
      font-size: 12px;
      border-radius: 4.15385px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container1 input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }


    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 18px;
      width: 18px;
      border-radius: 4.15385px;
      background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container1:hover input ~ .checkmark {
      background-color: #ccc;
      border-radius: 4.15385px;
    }

    /* When the checkbox is checked, add a yellow background */
    .container1 input:checked ~ .checkmark {
      background: #FFC914;
      border-radius: 4.15385px;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .container1 input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .container1 .checkmark:after {
      left: 7px;
      top: 3px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }

    .record-search-table{
      width: 1160px;
      border: 1px solid #EBEBEB;
      border-collapse:collapse;
      border-radius: 8px 8px 8px 8px;
      margin-top: 5em;
    }
    .record-search-table thead{
        text-align: center;
        height: 34px;
        background-color: #F1F6FA;
        font-size: 14px;
        font-weight: 500;
        border-radius: 8px 8px 0px 0px;
    }
    
    .field-view::before{  
        content: attr(data-content);
        position:absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
        color: black;        
        padding: 5px 7px;
        background-color: #FFFFFF;
        border-radius: 4px;
        top: -11px;
        left: 15px;
    }

    .corner1{
        border-radius: 8px 0px 0px 0px;
    }

    .corner2{
        border-radius: 0px 8px 0px 0px;
    }
    
    .no-record{
        text-align:center ;
        font-size: 14px;
        font-weight: 500;
        height: 212px;
    }

    .form-prev{
        background-color: white;
        border: none;
        width: 50px;
        height: 42px;
        position: absolute;
        padding-left: 50px;
        z-index:500;
        float: left;
        top: 20px;
    }
    .flex-col{
        flex-direction: column;
    }
    .flex-right{
        justify-content: right;
    }
    .flex-left{
        justify-content: left;
    }

    .container{
        display: flex;
    }

    .text-right{
        text-align: right;
        margin-bottom: 8px;
        min-height: 32px;
        margin-top: 8px;
    }

    .text-left{
        text-align: left;
        margin-bottom: 8px;
        min-height: 32px;
        margin-top: 8px;
    }

    .mainwrapper::before{
        display: none;
    }

    .rounded-corner{
        border-radius: 25px;
        border: 2px solid #FFC914;
    }
    .receipt-deets {
        text-align: left;
        padding: 8px;
        font-size: 16px;
        font-weight: 600;
        text-overflow: clip;
        word-break: break-all;
        color: ##000000;
    }
    .receipt-deets > span {
        font-weight: 400;
        color: #444444;
    }
</style>
<script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
</script>
<div id="field-view-tag">
</div>

<body class="font-poppins">
 
    <div class="contentpanel">
      <div class="container col" id="success">
        <center>
          <?php if($response1['S'] == 1): ?>
            <div class="col-md-12">
              <div class="col-md-4"></div>
              <div class="mt-1 col-md-4 rounded-corner" id="divReceiptHeader">
                <?php if($status == 'SUCCESS'): ?>
                  <h3 class="ups-h5 txt-center mt-1" style="width:290px; height:50px;">Hooray! Transaction Completed</h3>
                  <img class="mt-3" src="<?php echo BASE_URL()?>assets/icon/success3.png" alt="" srcset="" style="width:341px; height:293px;">
                  <h3 class="mt-3" style="width:300px; height:50px;"></h3>
                <?php elseif($status == 'FAILED'): ?>
                  <h3 class="ups-h5 txt-center mt-1" style="width:290px; height:50px;">Oh no! Transaction Cancelled</h3>
                  <img src="<?php echo BASE_URL()?>assets/icon/success2.png" alt="" srcset="" style="width:341px; height:293px;">
                  <h3 class="mt-3" style="width:300px; height:50px;"></h3>
                <?php elseif($status == 'PENDING'): ?>
                  <h3 class="ups-h5 txt-center mt-1" style="width:290px; height:50px;">Transaction Pending</h3>
                  <img src="<?php echo BASE_URL()?>assets/icon/success2.png" alt="" srcset="" style="width:341px; height:293px;">
                  <h3 class="mt-3" style="width:300px; height:50px;"></h3>
                <?php endif ?>
              </div>
              <div class="col-md-4"></div>
            </div>

            <div class="col-md-12">
              <div class="col-md-4"></div>
              <div class="mt-1 col-md-4 rounded-corner" id="transactionDetails">
                <h2><b><?php if($status == "SUCCESS"){ echo "TRANSACTION "."<span style='color:green'>$status</span>";}elseif($status == "FAILED"){echo "TRANSACTION "."<span style='color:red'>$status</span>";}elseif($status == "PENDING"){echo "TRANSACTION "."<span style='color:blue'>$status</span>";} ?></b></h2>
                <h3 class="mt-2" style="width:300px; height:50px;">Please go back to the Application</h3>
                <h4 class="mt-3" style="width:300px; height:50px;">Transaction Details</h4>
                <div class="form-group" id="receipt">
                  <div class="rounded-corner mb-1">
                    <div class="receipt-deets">Regcode: <span><?php echo $regcode ?></span></div>
                    <div class="receipt-deets">Email: <span><?php echo $email ?></span></div>
                    <div class="receipt-deets">Amount: <span><?php echo $amount ?></span></div>
                    <div class="receipt-deets">Tracking No: <span><?php echo $trackno ?></span></div>
                  </div>
                </div>
              </div>
              <div class="col-md-4"></div>
            </div>

          <?php else: ?>
            <div class="col-md-12">
              <div class="col-md-4"></div>
              <div class="mt-1 rounded-corner col-md-4" id="errMessage">
                <h3 class="ups-h5 txt-center mt-1" style="width:290px; height:50px;">Oopps.. Something Went Wrong.</h3>
                <img src="<?php echo BASE_URL()?>assets/images/somethingWentWrong.png" alt="" srcset="" style="width:341px; height:293px;">
                <h3 class="mt-3" style="width:300px;"><?php echo $response1['M']; ?></h3>
              </div>
              <div class="col-md-4"></div>
            </div>
          <?php endif ?>
        </center>
  
      </div>
    </div>
</body>

<script>
  $('#transactionDetails').hide()
  $('#errMessage').hide()

  $(document).ready(function(){
   $('#errMessage').fadeIn(450)
    $('#divReceiptHeader').fadeOut(2500).promise().done(function(){
      $('#transactionDetails').fadeIn(450)
    })
  })
</script>
