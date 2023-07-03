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
</script>


<style>
      .id_file {
          position: relative;
          overflow: hidden;
          font-weight:500;
          font-size:20px;
          width: 250px; 
          height: 53px;
          text-align:center;
          align-self:center;
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
            width: 322px;
            border-radius: 12px !important;
            padding: 8px 40px 8px 40px ;
            border:none !important;
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
      
      .tel-code{
        font-size: 20px;
        font-weight: 500;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 99px;
        height: 56px;
        background: #F4F4F4;
        border-radius: 10px;
    }

      .radio-box[type="radio"]:checked,
      .radio-box[type="radio"]:not(:checked) {
          position: absolute;
          left: -9999px;
      }
      .radio-box[type="radio"]:checked + label,
      .radio-box[type="radio"]:not(:checked) + label
      {
          position: relative;
          padding-left: 35px;
          padding-top: 4px;
          cursor: pointer;
          line-height: 20px;
          display: inline-block;
          color: #666;
          font-size: 16px;
          font-weight: 400;
      }
      .radio-box[type="radio"]:checked + label:before,
      .radio-box[type="radio"]:not(:checked) + label:before {
          content: '';
          position: absolute;
          left: 0;
          top: 0;
          width: 26px;
          height: 26px;
          border: 1px solid #ddd;
          border-radius: 100%;
          background: #fff;
      }
      .radio-box[type="radio"]:checked + label:before{
        border: 1px solid #FFC914;
      }
      .radio-box[type="radio"]:checked + label:after,
      .radio-box[type="radio"]:not(:checked) + label:after {
          content: '';
          width: 18px;
          height: 18px;
          background: #FFC914;
          position: absolute;
          top: 4px;
          left: 4px;
          
          border-radius: 100%;
          -webkit-transition: all 0.2s ease;
          transition: all 0.2s ease;
      }
      .radio-box[type="radio"]:not(:checked) + label:after {
          opacity: 0;
          -webkit-transform: scale(0);
          transform: scale(0);
      }
      .radio-box[type="radio"]:checked + label:after {
          opacity: 1;
          -webkit-transform: scale(1);
          transform: scale(1);
      }

      .radio-wrapper{
        display: flex;
        justify-content: left;
        padding-left: 1em;
        align-items:center;
        height: 75px;
        width: 250px;
        border-radius: 12px;
        background-color: transparent;
        border: solid 1px #EBEBEB;
      }
       .radio-wrapper:has(input:checked){
        display: flex;
        justify-content: left;
        padding-left: 1em;
        align-items:center;
        height: 75px;
        width: 250px;
        border-radius: 12px;
        background-color: #FFF8E0;
        border: solid 1px #FFC914;
      }

      /* Select CSS */
        /*the container must be positioned relative:*/
        .ups-select {
            position: relative;
            width: 360px;
            height: 56px;
            border-radius:10px;
            background-color: #F4F4F4;
            color: black;
        }
        .ups-select select {
        display: none; /*hide original SELECT element:*/
        }

        .ups-ctb {
            position: relative;
            width: 360px;
            height: 56px;
            border-radius:10px;
            background-color: #F4F4F4;
            color: black;
        }
        .ups-ctb select {
        display: none; /*hide original SELECT element:*/
        }

        .select-selected{
            height: 56px;
            border-radius:10px; 
            color: black !important;
            font-size: 20px;
            font-weight: 500;
            padding-top: 15px !important;
        }

        /*style the arrow inside the select element:*/
        .select-selected:after {
        position: absolute;
        content: "";
        top: 25px;
        right: 25px;
        width: 0;
        height: 0;
        border: 6px solid transparent;
        border-color: black transparent transparent transparent;
        }

        /*point the arrow upwards when the select box is open (active):*/
        .select-selected.select-arrow-active:after {
        border-color: transparent transparent black transparent;
        top: 23px;
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
        top: 100%;
        left: 0;
        right: 0;
        z-index: 99;
        max-height: 300px;
        overflow: auto;
        }

        /*hide the items when the select box is closed:*/
        .select-hide {
        display: none;
        }

        .select-items div:hover, .same-as-selected {
        background-color: rgba(0, 0, 0, 0.1);
        }
        .field-view::before{  
        content: attr(data-content);
        position:absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        font-size: 14px;
        color: black;        
        padding: 5px 7px;
        background-color: white;
        border-radius: 4px;
        border:none;
        top: -14px;
        left: 15px;
    }

    .form{
      display: none;
    }
    .btnSearch{
      display: none;
    }

    .ups-input{
      letter-spacing: 0px;
    }

    .ups-input:disabled{
      color: #bababa;
    }
    
    .record-search-table{
      width: 100%;
      border: 1px solid #EBEBEB;
      border-collapse:collapse;
      border-radius: 30px 30px 30px 30px;
      margin-top: 5em;
    }
    .record-search-table thead{
        text-align: center;
        height: 34px;
        background-color: #F1F6FA;
        font-size: 14px;
        font-weight: 500;
        border-radius: 30px 30px 0px 0px;
    }
    .corner1{
        border-radius: 8px 0px 0px 0px;
        border:none !important;
    }
    .corner2{
        border-radius: 0px 8px 0px 0px;
        width: 200px
        border:none !important;
    }
    .btnApprove{
        border: none;
        padding: 7px 10px;
        width: 84px;
        height: 34px;
        color: #FFFFFF;
        background: #FFC914;
        border-radius: 8px;
        margin-top: 8px;
        margin-bottom: 8px;
      }

      .btnSelect{
        border: none;
        padding: 7px 10px;
        width: 78px;
        height: 34px;
        color: #000000;
        background: #CFCFCF;
        border-radius: 8px;
        margin-top: 8px;
        margin-bottom: 8px;
      }
      .modal2 {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        visibility: hidden;
        transform: scale(1.1);
        transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
      }
      .modal2-content {
        position: absolute;
        top: 55%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 1rem 1.5rem;
        width: 64%;
        border-radius: 0.5rem;
        vertical-align: top;
        max-height: calc(100vh - 175px);
        overflow-y: auto;
        height: 750px;
      }
      .close2-button {
          float: right;
          width: 1.5rem;
          line-height: 1.5rem;
          text-align: center;
          cursor: pointer;
          border-radius: 0.25rem;
          background-color: lightgray;
      }
      .close2-button:hover {
          background-color: darkgray;
      }
      .show2-modal {
          opacity: 1;
          visibility: visible;
          transform: scale(1.0);
          transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
      }

      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
          /* display: none; <- Crashes Chrome on hover */
          -webkit-appearance: none;
          margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
      }

      input[type=number] {
          -moz-appearance:textfield; /* Firefox */
      }

</style>


<body class="font-poppins">
  <div class="mainpanel">
    <div class="contentpanel">

      <!--####################################################### STEP 1 ####################################################### -->
      <input hidden id="getRegcode" value="<?php echo $regcode ?>"></input>
      <input hidden id="getLevel" value="<?php echo $level ?>"></input>
      <!-- SELECT SERVICE -->
      <div class="container flex-center col" id="remitForm">
        <!-- banner img -->
        <img class="img-title mt-2" src="<?php echo BASE_URL() ?>assets/images/kyc/remit_banner.png" style="text-align: center; padding-left: 70px; padding-right: 30px" alt="UPS Title Bar" width="1200" height="300">
        <h1 class="ups-h1 mt-1">Remittance <span class="ups-txt-yellow">Form</span></h1>
        <!-- select service -->
        <h1 class="ups-h2 mt-1">Select Service</h1>
        <!-- radio button first row -->
        <div id="serviceForm">
          <div class="container flex-center mt-1">
            <div class="radio-wrapper me-1" id="CEB">
              <input class="radio-box" type="radio" id="test1" name="radio-group" value="Cebuana" disabled>
              <label for="test1">Cebuana</label>
            </div>
            <div class="radio-wrapper me-1" id="WU">
              <input class="radio-box" type="radio" id="test2" name="radio-group" value="Western Union" disabled>
              <label for="test2">Western Union</label>
            </div>
            <div class="radio-wrapper">
              <input class="radio-box" type="radio" id="test3" name="radio-group" value="Smart Money" disabled>
              <label for="test3">Smart Money</label>
            </div>
          </div>
          <!-- radio button second row -->
          <div class="container flex-center mt-1">
            <div class="radio-wrapper me-1" id="CTB">
              <input class="radio-box" type="radio" id="test4" name="radio-group" value="Credit-To-Bank (CTB)" disabled>
              <label for="test4">Credit-To-Bank (CTB)</label>
            </div>
            <div class="radio-wrapper me-1" id="ECP">
              <input class="radio-box" type="radio" id="test5" name="radio-group" value="Unified Padala" disabled>
              <label for="test5">Unified Padala</label>
            </div>
            <div class="radio-wrapper" id="ECE">
              <input class="radio-box"type="radio" id="test6" name="radio-group" value="Unified to Unified" checked>
              <label for="test6">Unified to Unified</label>
            </div>
          </div>
        </div>
        <!-- select type -->
        <h1 class="ups-h2 mt-2">Select Type</h1>
        <div class="container flex-center mt-1">
          <div class="radio-wrapper me-1">
            <input class="radio-box selecttype" type="radio" id="sender" name="type" value="sender" checked>
            <label for="sender">Sender</label>
          </div>
          <div class="radio-wrapper me-1">
            <input class="radio-box selecttype" type="radio" id="receiver" name="type" value="receiver" disabled>
            <label for="receiver">Receiver</label>
          </div>
        </div>
      </div>
      <!-- END OF SELECT SERVICE -->

      <!-- SEARCH RECEIVER -->
      <form action="" class="receiver form" id="searchReceiver">
        <div class="container col flex-center ">
          <h1 class="ups-h1 mt-2 mb-2">Fill out details</h1>
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Reference Number</label>
              <input type="text" class="ups-input" style="width: 776px; height: 53px;" id="referenceNum">
            </div>
          </div>
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">First Name</label>
              <input type="text" class="ups-input" oninput="this.value = this.value.toUpperCase()" style="width: 245.33px; height: 53px;" id="fname">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Middle Name</label>
              <input type="text" class="ups-input" oninput="this.value = this.value.toUpperCase()" style="width: 225.33px; height: 53px;" id="mname">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Last Name</label>
              <input type="text" class="ups-input" oninput="this.value = this.value.toUpperCase()" style="width: 225.33px; height: 53px;" id="lname">
            </div>
          </div>
          <button type="button" class="ups-btn mt-3 mb-5 receiver btnSearch" style="width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" id="btnSearchR" class="btn btn-primary btnSearch">Search Receiver</button>
        </div> 
      </form>
      <!-- END OF SEARCH RECEIVER -->

      <!-- SEARCH SENDER -->
      <form class="sender form" name="frmCebuanaSearchSender" id="frmCebuanaSearchSender">
        <div class="container col flex-center ">
          <h1 class="ups-h1 mt-2 mb-2">Fill out details</h1>
          <div class="container flex-center mt-1" style="width:780px">
            <input hidden type="text" id="selService" name="selService">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">First Name</label>
              <input type="text" class="ups-input" oninput="this.value = this.value.toUpperCase()" style="width: 360px; height: 53px;" name="fname" id="fname">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Last Name</label>
              <input type="text" class="ups-input" oninput="this.value = this.value.toUpperCase()" style="width: 360px; height: 53px;" name="lname" id="lname">
            </div>
          </div>    
          <button class="ups-btn mt-3 mb-5 sender btnSearch" style="width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" id="btnSearchS">Search Sender</button>
        </div>
      </form> 
      <!-- END OF SEARCH SENDER -->

      <!-- FETCH LIST OF SEARCHED SENDER -->
      <div class="container col flex-center " id="fetchKYC">
        <img class="img-title mt-2" src="<?php echo BASE_URL() ?>assets/images/kyc/remit_banner.png" style="text-align: center; padding-left: 70px; padding-right: 30px" alt="UPS Title Bar" width="1200" height="300">
        <div class="container flex-center row mt-1">
          <button class="form-prev" id="form-prev"><img src="<?php echo BASE_URL()?>assets/icon/prev.png" alt="" srcset=""></button> 
          <h1 class="ups-h1 " style="text-align: center; padding-left: 70px; padding-right: 30px">Remittance Search <span class="ups-txt-yellow">Results</span></h1>
        </div>
        <table class="record-search-table" id="fetchKYC_tbl">
          <thead>
            <tr>
              <td class="corner1">USER ID</td>
              <td>FIRST NAME</td>
              <td>LAST NAME</td>
              <td>BIRTH DATE</td>
              <td>REMARKS</td>
              <td class="corner2">ACTIONS<button hidden id="btnView">SHOW</button></td>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

        <!-- MODAL CUSTOMER DETAILS -->
        <div class="modal2">
          <div class="modal2-content">
            <span class="close2-button">×</span>
            <div class="col flex-center mt-2" style="margin-left: 25px;">
              <h1 class="ups-h1 txt-center ups-txt-dark mt-1">User <span class="ups-txt-yellow">details</span></h1>
              <div class="">
                <h4 class="txt-center">Customer Information</h4>
              </div>
            </div>

            <!-- Review Full name and Addresses -->
            <div class="col flex-center mt-2">
              <div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px;" id="f1" name="fullname"></div>
            </div>
            <div class="col flex-center">
              <div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px;" id="f2" ></div>
            </div>
            <div class="col flex-center">
              <div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px" id="f3" ></div>
            </div>

            <!-- Review Mobile Number and Email -->
            <div class="col flex-center">
              <div class="row">
                <div class="col-xs-6">
                  <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f4" disabled></div>
                </div>
                <div class="col-xs-6">
                  <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f5" disabled></div>
                </div>
              </div>
            </div>

            <!-- Review Birthdate and Birthplace -->
            <div class="col flex-center">
              <div class="row">
                <div class="col-xs-6">
                  <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f6" disabled></div>
                </div>
                <div class="col-xs-6">
                  <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f7" disabled></div>
                </div>
              </div>
            </div>

            <!-- Review Occupation and Source of Fund/s -->
            <div class="col flex-center">
              <div class="row">
                <div class="col-xs-6">
                  <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f8" disabled></div>
                </div>
                <div class="col-xs-6">
                  <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f9" disabled></div>
                </div>
              </div>
            </div>

            <!-- Review Country and Nationality -->
            <div class="col flex-center">
              <div class="row">
                <div class="col-xs-6">
                  <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f10" disabled></div>
                </div>
                <div class="col-xs-6">
                  <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f11" disabled></div>
                </div>
              </div>
            </div>

            <!-- Review ID 1 -->
            <div class="col flex-center">
              <label for="" class="ups-input-label" style="text-align: center; width: 320px; font-size: 22px; font-weight: 500; margin-left: 15px" >ID # 1</label>
            </div>

            <!-- Review ID 1 Information and File Attachment -->
            <div class="col flex-center mt-2">
              <div class="row" style="margin-left: 5px;">
                <div class="col-xs-4">
                  <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f12" disabled></div>
                </div>
                <div class="col-xs-4">
                  <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f13" disabled></div>
                </div>
                <div class="col-xs-4">
                  <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f14" disabled></div>
                </div>
              </div>
            </div>
            <div class="col flex-center">
              <div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px" id="f15" ></div>
            </div>

            <!-- Review ID 2 -->
            <div class="col flex-center">
              <label for="" class="ups-input-label" style="text-align: center; width: 320px; font-size: 22px; font-weight: 500; margin-left: 15px" >ID # 2</label>
            </div>

            <!-- Review ID 2 Information and File Attachment-->
            <div class="col flex-center mt-2">
              <div class="row" style="margin-left: 5px;">
                <div class="col-xs-4">
                  <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f16" disabled></div>
                </div>
                <div class="col-xs-4">
                  <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f17" disabled></div>
                </div>
                <div class="col-xs-4">
                  <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f18" disabled></div>
                </div>
              </div>
            </div>
          
            <!-- Review Attached Signature -->
            <div class="col flex-center">
              <div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px" id="f19" ></div>
            </div>
            <div class="col flex-center">
              <label for="" class="ups-input-label" style="text-align: center; width: 320px; font-size: 22px; font-weight: 500;" >Signature</label>
            </div>
            <div class="col flex-center mt-1">
              <div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px" id="f20" ></div>
            </div>

            <div class="col flex-center mt-1" style="margin-left: 25px"id="btnSel">
              <button class="btnApprove" id="btnSelectS" data-id="">SELECT</button>
            </div>

          </div>
        </div>
        <!-- END OF MODAL CUSTOMER DETAILS-->

      </div>
      <!-- END OF FETCH LIST OF SEARCHED SENDER -->



      
      <!-- REMITTANCE FORM -->
      <div class="container flex-center col" id="senderForm">
        <div class="container flex-center col" >
          <!-- banner img -->
          <img class="img-title mt-2" src="<?php echo BASE_URL() ?>assets/images/kyc/remit_banner.png" style="text-align: center; padding-left: 70px; padding-right: 30px" alt="UPS Title Bar" width="1200" height="300">
          <div class="container flex-center row mt-1">
              <button class="form-prev" id="form-prev2"><img src="<?php echo BASE_URL()?>assets/icon/prev.png" alt="" srcset=""></button>
              <h1 class="ups-h1">Remittance <span class="ups-txt-yellow">Form</span></h1>
          </div>

          <input hidden type="text" id="rowid" name="rowid" value="">
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Selected Service</label>
              <input disabled type="text" class="ups-input" style="width:776px; height: 53px;" id="selectedService" name="selectedService" value="">
            </div>
          </div>
          
          <!-- 1st row -->
          <h1 class="ups-h2 mt-2">Sender Information</h1>
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">First Name</label>
              <input disabled type="text" class="ups-input" style="width: 245.33px; height: 53px;" id="fn" value="">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Middle Name</label>
              <input disabled type="text" class="ups-input" style="width: 245.33px; height: 53px;" id="mn" value="">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Last Name</label>
              <input disabled type="text" class="ups-input" style="width: 245.33px; height: 53px;" id="ln" value="">
            </div>
          </div>
          
          <!-- 2nd row -->
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Address</label>
              <input disabled type="text" class="ups-input" style="width: 510.67px; height: 53px;" id="address" value="">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Country</label>
              <input disabled type="text" class="ups-input" style="width: 230px; height: 53px;" id="country" value="">
            </div>
          </div>

          <!-- 3rd row  -->
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Birthdate</label>
              <input disabled type="date" class="ups-input" style="width: 245.33px; height: 53px; font-weight: 400; font-size: 18px; letter-spacing:0px" id="bd" value="">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Mobile Number</label>
              <div class="ups-input-field flex-center row mt-1" style="width: 245.33px">
                <div class="tel-code" style="width:89px;"><img src="<?php echo BASE_URL()?>assets/icon/philippines.png" alt="" srcset="">+63</div>
                <input disabled type="text" class="ups-input ms-1" style="width:156.33px; letter-spacing:0px" maxlength="11"  id="regMobile" onkeypress="return isNumberKey(event)" value="" required>
              </div>
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Email Address</label>
              <input disabled type="email" class="ups-input" style="width: 245.33px; height: 53px; letter-spacing:0px" id="email"  value="">
            </div>
          </div>

          <!-- 4th row  -->
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center" >
              <label class="ups-input-label" style="text-align:left; width:100%;">Relationship to Receiver</label>
              <div class="ups-select" style="width:245.33px; letter-spacing:0px" id="divReltore">
                <select name="reltore" id="reltore" required>
                    <option value="1" disabled selected><p style="margin:0px" >Select</p></option>  
                    <option value="Family">
                      Family
                    </option>

                    <option value="Friend">
                      Friend
                    </option>

                    <option value="Trade/BusinesPartner">
                      Trade/Business Partner 
                    </option>

                    <option value="Employee/Employer">
                      Employee/Employer
                    </option>

                    <option value="Donor/Receiver of Ch">
                      Donor/Receiver of Charitable Funds
                    </option>

                    <option value="Purchaser/Seller">
                      Purchaser/Seller
                    </option>
                </select>
              </div>
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Occupation</label>
              <input disabled type="text" class="ups-input" style="width: 245.33px; height: 53px; letter-spacing:0px" id="occupation"  value="">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Source of Fund</label>
              <input disabled type="text" class="ups-input" style="width: 230px; height: 53px;" id="sourceOfFund" value="">
            </div>
          </div>

          <!-- 5th row  -->
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Type of ID</label>
              <input disabled type="text" class="ups-input" style="width: 230px; height: 53px;" id="typeID" value="">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">ID Number</label>
              <input disabled type="text" class="ups-input" style="width: 245.33px; height: 53px; letter-spacing:0px" placeholder="000-000-000" id="idNum" value="">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Date Issued</label>
              <input disabled type="date" class="ups-input" style="width: 245.33px; height: 53px; letter-spacing:0px font-weight: 400; font-size: 18px;" id="dateIssued" value="">
            </div>
          </div>

          <!-- 6th row -->
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center" style="width:780px">
              <label class="ups-input-label" style="text-align:left; width:100%;">ID Attachment</label>
              <div class="container row flex-center">
                <input disabled type="text" class="ups-input" style="width: 700px; height: 53px; margin-right:0px; border-radius:10px 0px 0px 10px;" placeholder="No File" id="uploadedID" value="">
                <a href="#" id="idView" target="_blank"><button class="btn" style="width:76px; height: 53px; border-radius:0px 10px 10px 0px; color:#2F80ED;">View</button></a>
              </div>
            </div> 
          </div>

          <!-- 7th row -->
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center" style="width:780px">
              <label class="ups-input-label" style="text-align:left; width:100%;">Signiture Attachment</label>
              <div class="container row flex-center">
                <input disabled type="text" class="ups-input" style="width: 700px; height: 53px; margin-right:0px; border-radius:10px 0px 0px 10px;" placeholder="No File" id="uploadedSig" value="">
                <a href="#" id="signatureView" target="_blank"><button class="btn" style="width:76px; height: 53px; border-radius:0px 10px 10px 0px; color:#2F80ED;">View</button></a>
              </div>
            </div>
          </div>

          <!-- 8th row -->
          <div class="container flex-center mt-1" id="row8" style="width:780px">
            <div class="container col flex-center" id="row8purpose" style="width:780px">
              <label class="ups-input-label" style="text-align:left; width:100%;" id="lblPurpose">Purpose of Transaction</label>
              <input type="text" class="ups-input field" style="width: 378px; height: 53px;" id="purposeTrans">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;" id="lblAmount">Amount</label>
              <input type="text" class="ups-input field" style="width: 378px; height: 53px;" id="amount">
            </div>
          </div>

          <!-- sender information -->
          <h1 class="ups-h2 mt-2">Receiver Information</h1>

          <!-- 1st row -->
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">First Name</label>
              <input type="text" class="ups-input field" oninput="this.value = this.value.toUpperCase()" style="width: 245.33px; height: 53px;" id="rfn">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Middle Name</label>
              <input type="text" class="ups-input" style oninput="this.value = this.value.toUpperCase()"="width: 245.33px; height: 53px;" id="rmn"/>
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Last Name</label>
              <input type="text" class="ups-input field" oninput="this.value = this.value.toUpperCase()" style="width: 245.33px; height: 53px;" id="rln">
            </div>
          </div>
          
          <!-- 2nd row -->
          <div class="container flex-center mt-1 field" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Address</label>
              <input type="text" class="ups-input" style="width: 510.67px; height: 53px;" id="raddress">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Country</label>
              <div class="ups-select" style="width:245.33px; letter-spacing:0px" id="divSelCountryR">
                <select name="selCountryR" id="selCountryR" required>
                  <option value="1" disabled selected><p style="margin:0px" >Select</p></option>  
                  <option value="Philippines">Philippines</option>
                  <option value="Afghanistan">Afghanistan</option>
                  <option value="Aland Islands">Åland Islands</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="American Samoa">American Samoa</option>
                  <option value="Andorra">Andorra</option>
                  <option value="Angola">Angola</option>
                  <option value="Anguilla">Anguilla</option>
                  <option value="Antarctica">Antarctica</option>
                  <option value="Antigua and Barbuda">Antigua & Barbuda</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
                  <option value="Aruba">Aruba</option>
                  <option value="Australia">Australia</option>
                  <option value="Austria">Austria</option>
                  <option value="Azerbaijan">Azerbaijan</option>
                  <option value="Bahamas">Bahamas</option>
                  <option value="Bahrain">Bahrain</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Barbados">Barbados</option>
                  <option value="Belarus">Belarus</option>
                  <option value="Belgium">Belgium</option>
                  <option value="Belize">Belize</option>
                  <option value="Benin">Benin</option>
                  <option value="Bermuda">Bermuda</option>
                  <option value="Bhutan">Bhutan</option>
                  <option value="Bolivia">Bolivia</option>
                  <option value="Bonaire, Sint Eustatius and Saba">Caribbean Netherlands</option>
                  <option value="Bosnia and Herzegovina">Bosnia & Herzegovina</option>
                  <option value="Botswana">Botswana</option>
                  <option value="Bouvet Island">Bouvet Island</option>
                  <option value="Brazil">Brazil</option>
                  <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                  <option value="Brunei Darussalam">Brunei</option>
                  <option value="Bulgaria">Bulgaria</option>
                  <option value="Burkina Faso">Burkina Faso</option>
                  <option value="Burundi">Burundi</option>
                  <option value="Cambodia">Cambodia</option>
                  <option value="Cameroon">Cameroon</option>
                  <option value="Canada">Canada</option>
                  <option value="Cape Verde">Cape Verde</option>
                  <option value="Cayman Islands">Cayman Islands</option>
                  <option value="Central African Republic">Central African Republic</option>
                  <option value="Chad">Chad</option>
                  <option value="Chile">Chile</option>
                  <option value="China">China</option>
                  <option value="Christmas Island">Christmas Island</option>
                  <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                  <option value="Colombia">Colombia</option>
                  <option value="Comoros">Comoros</option>
                  <option value="Congo">Congo - Brazzaville</option>
                  <option value="Congo, Democratic Republic of the Congo">Congo - Kinshasa</option>
                  <option value="Cook Islands">Cook Islands</option>
                  <option value="Costa Rica">Costa Rica</option>
                  <option value="Cote D'Ivoire">Côte d’Ivoire</option>
                  <option value="Croatia">Croatia</option>
                  <option value="Cuba">Cuba</option>
                  <option value="Curacao">Curaçao</option>
                  <option value="Cyprus">Cyprus</option>
                  <option value="Czech Republic">Czechia</option>
                  <option value="Denmark">Denmark</option>
                  <option value="Djibouti">Djibouti</option>
                  <option value="Dominica">Dominica</option>
                  <option value="Dominican Republic">Dominican Republic</option>
                  <option value="Ecuador">Ecuador</option>
                  <option value="Egypt">Egypt</option>
                  <option value="El Salvador">El Salvador</option>
                  <option value="Equatorial Guinea">Equatorial Guinea</option>
                  <option value="Eritrea">Eritrea</option>
                  <option value="Estonia">Estonia</option>
                  <option value="Ethiopia">Ethiopia</option>
                  <option value="Falkland Islands (Malvinas)">Falkland Islands (Islas Malvinas)</option>
                  <option value="Faroe Islands">Faroe Islands</option>
                  <option value="Fiji">Fiji</option>
                  <option value="Finland">Finland</option>
                  <option value="France">France</option>
                  <option value="French Guiana">French Guiana</option>
                  <option value="French Polynesia">French Polynesia</option>
                  <option value="French Southern Territories">French Southern Territories</option>
                  <option value="Gabon">Gabon</option>
                  <option value="Gambia">Gambia</option>
                  <option value="Georgia">Georgia</option>
                  <option value="Germany">Germany</option>
                  <option value="Ghana">Ghana</option>
                  <option value="Gibraltar">Gibraltar</option>
                  <option value="Greece">Greece</option>
                  <option value="Greenland">Greenland</option>
                  <option value="Grenada">Grenada</option>
                  <option value="Guadeloupe">Guadeloupe</option>
                  <option value="Guam">Guam</option>
                  <option value="Guatemala">Guatemala</option>
                  <option value="Guernsey">Guernsey</option>
                  <option value="Guinea">Guinea</option>
                  <option value="Guinea-Bissau">Guinea-Bissau</option>
                  <option value="Guyana">Guyana</option>
                  <option value="Haiti">Haiti</option>
                  <option value="Heard Island and Mcdonald Islands">Heard & McDonald Islands</option>
                  <option value="Holy See (Vatican City State)">Vatican City</option>
                  <option value="Honduras">Honduras</option>
                  <option value="Hong Kong">Hong Kong</option>
                  <option value="Hungary">Hungary</option>
                  <option value="Iceland">Iceland</option>
                  <option value="India">India</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="Iran, Islamic Republic of">Iran</option>
                  <option value="Iraq">Iraq</option>
                  <option value="Ireland">Ireland</option>
                  <option value="Isle of Man">Isle of Man</option>
                  <option value="Israel">Israel</option>
                  <option value="Italy">Italy</option>
                  <option value="Jamaica">Jamaica</option>
                  <option value="Japan">Japan</option>
                  <option value="Jersey">Jersey</option>
                  <option value="Jordan">Jordan</option>
                  <option value="Kazakhstan">Kazakhstan</option>
                  <option value="Kenya">Kenya</option>
                  <option value="Kiribati">Kiribati</option>
                  <option value="Korea, Democratic People's Republic of">North Korea</option>
                  <option value="Korea, Republic of">South Korea</option>
                  <option value="Kosovo">Kosovo</option>
                  <option value="Kuwait">Kuwait</option>
                  <option value="Kyrgyzstan">Kyrgyzstan</option>
                  <option value="Lao People's Democratic Republic">Laos</option>
                  <option value="Latvia">Latvia</option>
                  <option value="Lebanon">Lebanon</option>
                  <option value="Lesotho">Lesotho</option>
                  <option value="Liberia">Liberia</option>
                  <option value="Libyan Arab Jamahiriya">Libya</option>
                  <option value="Liechtenstein">Liechtenstein</option>
                  <option value="Lithuania">Lithuania</option>
                  <option value="Luxembourg">Luxembourg</option>
                  <option value="Macao">Macao</option>
                  <option value="Macedonia, the Former Yugoslav Republic of">North Macedonia</option>
                  <option value="Madagascar">Madagascar</option>
                  <option value="Malawi">Malawi</option>
                  <option value="Malaysia">Malaysia</option>
                  <option value="Maldives">Maldives</option>
                  <option value="Mali">Mali</option>
                  <option value="Malta">Malta</option>
                  <option value="Marshall Islands">Marshall Islands</option>
                  <option value="Martinique">Martinique</option>
                  <option value="Mauritania">Mauritania</option>
                  <option value="Mauritius">Mauritius</option>
                  <option value="Mayotte">Mayotte</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Micronesia, Federated States of">Micronesia</option>
                  <option value="Moldova, Republic of">Moldova</option>
                  <option value="Monaco">Monaco</option>
                  <option value="Mongolia">Mongolia</option>
                  <option value="Montenegro">Montenegro</option>
                  <option value="Montserrat">Montserrat</option>
                  <option value="Morocco">Morocco</option>
                  <option value="Mozambique">Mozambique</option>
                  <option value="Myanmar">Myanmar (Burma)</option>
                  <option value="Namibia">Namibia</option>
                  <option value="Nauru">Nauru</option>
                  <option value="Nepal">Nepal</option>
                  <option value="Netherlands">Netherlands</option>
                  <option value="Netherlands Antilles">Curaçao</option>
                  <option value="New Caledonia">New Caledonia</option>
                  <option value="New Zealand">New Zealand</option>
                  <option value="Nicaragua">Nicaragua</option>
                  <option value="Niger">Niger</option>
                  <option value="Nigeria">Nigeria</option>
                  <option value="Niue">Niue</option>
                  <option value="Norfolk Island">Norfolk Island</option>
                  <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                  <option value="Norway">Norway</option>
                  <option value="Oman">Oman</option>
                  <option value="Pakistan">Pakistan</option>
                  <option value="Palau">Palau</option>
                  <option value="Palestinian Territory, Occupied">Palestine</option>
                  <option value="Panama">Panama</option>
                  <option value="Papua New Guinea">Papua New Guinea</option>
                  <option value="Paraguay">Paraguay</option>
                  <option value="Peru">Peru</option>
                  <option value="Pitcairn">Pitcairn Islands</option>
                  <option value="Poland">Poland</option>
                  <option value="Portugal">Portugal</option>
                  <option value="Puerto Rico">Puerto Rico</option>
                  <option value="Qatar">Qatar</option>
                  <option value="Reunion">Réunion</option>
                  <option value="Romania">Romania</option>
                  <option value="Russian Federation">Russia</option>
                  <option value="Rwanda">Rwanda</option>
                  <option value="Saint Barthelemy">St. Barthélemy</option>
                  <option value="Saint Helena">St. Helena</option>
                  <option value="Saint Kitts and Nevis">St. Kitts & Nevis</option>
                  <option value="Saint Lucia">St. Lucia</option>
                  <option value="Saint Martin">St. Martin</option>
                  <option value="Saint Pierre and Miquelon">St. Pierre & Miquelon</option>
                  <option value="Saint Vincent and the Grenadines">St. Vincent & Grenadines</option>
                  <option value="Samoa">Samoa</option>
                  <option value="San Marino">San Marino</option>
                  <option value="Sao Tome and Principe">São Tomé & Príncipe</option>
                  <option value="Saudi Arabia">Saudi Arabia</option>
                  <option value="Senegal">Senegal</option>
                  <option value="Serbia">Serbia</option>
                  <option value="Serbia and Montenegro">Serbia</option>
                  <option value="Seychelles">Seychelles</option>
                  <option value="Sierra Leone">Sierra Leone</option>
                  <option value="Singapore">Singapore</option>
                  <option value="Sint Maarten">Sint Maarten</option>
                  <option value="Slovakia">Slovakia</option>
                  <option value="Slovenia">Slovenia</option>
                  <option value="Solomon Islands">Solomon Islands</option>
                  <option value="Somalia">Somalia</option>
                  <option value="South Africa">South Africa</option>
                  <option value="South Georgia and the South Sandwich Islands">South Georgia & South Sandwich Islands</option>
                  <option value="South Sudan">South Sudan</option>
                  <option value="Spain">Spain</option>
                  <option value="Sri Lanka">Sri Lanka</option>
                  <option value="Sudan">Sudan</option>
                  <option value="Suriname">Suriname</option>
                  <option value="Svalbard and Jan Mayen">Svalbard & Jan Mayen</option>
                  <option value="Swaziland">Eswatini</option>
                  <option value="Sweden">Sweden</option>
                  <option value="Switzerland">Switzerland</option>
                  <option value="Syrian Arab Republic">Syria</option>
                  <option value="Taiwan, Province of China">Taiwan</option>
                  <option value="Tajikistan">Tajikistan</option>
                  <option value="Tanzania, United Republic of">Tanzania</option>
                  <option value="Thailand">Thailand</option>
                  <option value="Timor-Leste">Timor-Leste</option>
                  <option value="Togo">Togo</option>
                  <option value="Tokelau">Tokelau</option>
                  <option value="Tonga">Tonga</option>
                  <option value="Trinidad and Tobago">Trinidad & Tobago</option>
                  <option value="Tunisia">Tunisia</option>
                  <option value="Turkey">Turkey</option>
                  <option value="Turkmenistan">Turkmenistan</option>
                  <option value="Turks and Caicos Islands">Turks & Caicos Islands</option>
                  <option value="Tuvalu">Tuvalu</option>
                  <option value="Uganda">Uganda</option>
                  <option value="Ukraine">Ukraine</option>
                  <option value="United Arab Emirates">United Arab Emirates</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="United States">United States</option>
                  <option value="United States Minor Outlying Islands">U.S. Outlying Islands</option>
                  <option value="Uruguay">Uruguay</option>
                  <option value="Uzbekistan">Uzbekistan</option>
                  <option value="Vanuatu">Vanuatu</option>
                  <option value="Venezuela">Venezuela</option>
                  <option value="Viet Nam">Vietnam</option>
                  <option value="Virgin Islands, British">British Virgin Islands</option>
                  <option value="Virgin Islands, U.s.">U.S. Virgin Islands</option>
                  <option value="Wallis and Futuna">Wallis & Futuna</option>
                  <option value="Western Sahara">Western Sahara</option>
                  <option value="Yemen">Yemen</option>
                  <option value="Zambia">Zambia</option>
                  <option value="Zimbabwe">Zimbabwe</option>
                </select>
              </div>
            </div>
          </div>
          
          <!-- 3rd row  -->
          <div class="container flex-center mt-1 field" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Birthdate</label>
              <input type="date" class="ups-input" style="width: 245.33px; height: 53px; font-weight: 400; font-size: 18px; letter-spacing:0px" id="rbd">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Mobile Number</label>
              <div class="ups-input-field flex-center row mt-1" style="width: 245.33px">
                <div class="tel-code" style="width:89px;"><img src="<?php echo BASE_URL()?>assets/icon/philippines.png" alt="" srcset="">+63</div>
                <input type="text" class="ups-input ms-1" style="width:156.33px; letter-spacing:0px" maxlength="10"  id="rregMobile" onkeypress="return isNumberKey(event)" required>
              </div>
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">Email Address</label>
              <input type="email" class="ups-input" style="width: 245.33px; height: 53px; letter-spacing:0px" id="remail">
            </div>
          </div>
          
          <!-- review button  -->
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <button class="ups-btn mt-2 mb-5" style="width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" id="btnReview">Review</button>
            </div>
          </div>

        </div>
      </div>
      <!-- END OF REMITTANCE FORM -->

      <!-- CREDIT TO BANK FORM -->
      <div class="container flex-center col" id="ctbForm">
        <div class="container flex-center col" >
          <!-- banner img -->
          <img class="img-title mt-2" src="<?php echo BASE_URL() ?>assets/images/kyc/remit_banner.png" style="text-align: center; padding-left: 70px; padding-right: 30px" alt="UPS Title Bar" width="1200" height="300">
          <div class="container flex-center row mt-1">
              <button class="form-prev" id="form-ctb-prev"><img src="<?php echo BASE_URL()?>assets/icon/prev.png" alt="" srcset=""></button>
              <h1 class="ups-h1">Credit To Bank <span class="ups-txt-yellow">Form</span></h1>
          </div>

          <div class="container col flex-center mt-3" >
            <div class="ups-ctb" style="width:780px; letter-spacing:0px">
              <select name="selBank" id="selBank" required>
                <option disabled selected><p style="margin:0px" >CHOOSE BANK</p></option>  
              </select>
            </div>
          </div>

          <div class="container flex-center mt-2" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%; padding-left:30px">ACCOUNT NO</label>
              <input type="text" class="ups-input field-ctb" style="width: 370px; height: 53px; margin-left: 25px;" id="accountNumber" value="">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">AMOUNT</label>
              <input type="text" class="ups-input field-ctb" style="width: 370px; height: 53px;" id="amountCTB" value="">
            </div>
          </div>

          <!-- review button  -->
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <button class="ups-btn mt-2 mb-5" style="width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" id="btnReviewCTB">Review</button>
            </div>
          </div>

        </div>
      </div>
      <!-- END OF CREDIT TO BANK FORM -->
  
      <!-- Unified to Unified FORM -->
      <div class="container flex-center col" id="eceForm">
        <div class="container flex-center col" >
          <!-- banner img -->
          <img class="img-title mt-2" src="<?php echo BASE_URL() ?>assets/images/kyc/remit_banner.png" style="text-align: center; padding-left: 70px; padding-right: 30px" alt="UPS Title Bar" width="1200" height="300">
          <div class="container flex-center row mt-1">
              <button class="form-prev" id="form-ece-prev"><img src="<?php echo BASE_URL()?>assets/icon/prev.png" alt="" srcset=""></button>
              <h1 class="ups-h1" id="titleBlack">Unified to Unified <span class="ups-txt-yellow" id="titleYellow">Form</span></h1>
          </div>

          <div class="container flex-center mt-2" style="width:780px">
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;" id="lblAccountNumber">ACCOUNT NO</label>
              <input type="text" class="ups-input field-ece" style="width: 370px; height: 53px;" id="accountNumber" value="">
            </div>
            <div class="container col flex-center">
              <label class="ups-input-label" style="text-align:left; width:100%;">AMOUNT <span id="lblAlertAmount" style="color:red;"></span></label>
              <input type="number" class="ups-input field-ece" style="width: 370px; height: 53px;" id="amountECE" value="">
            </div>
          </div>

          <!-- review button  -->
          <div class="container flex-center mt-1" style="width:780px">
            <div class="container col flex-center">
              <button class="ups-btn mt-2 mb-5" style="width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" id="btnReviewECE">Review</button>
            </div>
          </div>

        </div>
      </div>
      <!-- END OF Unified to Unified FORM -->

      <!-- REVIEW FORM -->
      <div class="container flex-center col" id="remitReview">
        <img class="img-title mt-2" src="<?php echo BASE_URL() ?>assets/images/kyc/remit_banner.png" style="text-align: center; padding-left: 70px; padding-right: 30px" alt="UPS Title Bar" width="1200" height="300">
        <div class="container flex-center row mt-1">
           <button class="form-prev" id="form-prev3"><img src="<?php echo BASE_URL()?>assets/icon/prev.png" alt="" srcset=""></button>
           <h1 class="ups-h1">Review <span class="ups-txt-yellow">Details</span></h1>
        </div>

        <!-- Sender Data -->
        <!-- 1st row -->
        <h1 class="ups-h1 mt-2">Sender <span class="ups-txt-yellow">Information</span></h1>
        <div class="container flex-center mt-2">
            <div class="field-view me-1" style="height: 51px; width: 380px;" id="f1" ></div>
            <div class="field-view" style="height: 51px; width: 380px;" id="f2" ></div>
        </div>

        <!-- 2nd row -->
        <div class="container flex-center mt-1">
            <div class="field-view me-1" style="height: 51px; width: 560px;" id="f3" ></div>
            <div class="field-view" style="height: 51px; width: 200px;" id="f4" ></div>
        </div>

        <!--3rd row -->
        <div class="container flex-center mt-1">
            <div class="field-view me-1" style="height: 51px; width: 246.67px;" id="f5" ></div>
            <div class="field-view me-1" style="height: 51px; width: 246.67px;" id="f6" ></div>
            <div class="field-view" style="height: 51px; width: 246.67px;" id="f7" ></div>
        </div>

        <!--4th row -->
        <div class="container flex-center mt-1">
            <div class="field-view me-1" style="height: 51px; width: 246.67px;" id="f8" ></div>
            <div class="field-view me-1" style="height: 51px; width: 246.67px;" id="f9" ></div>
            <div class="field-view" style="height: 51px; width: 246.67px;" id="f10" ></div>
        </div>

        <!--5th row -->
        <div class="container flex-center mt-1">
            <div class="field-view me-1" style="height: 51px; width: 246.67px;" id="f11" ></div>
            <div class="field-view me-1" style="height: 51px; width: 246.67px;" id="f12" ></div>
            <div class="field-view" style="height: 51px; width: 246.67px;" id="f13" ></div>
        </div>

        <!--6th row -->
        <div class="container flex-center mt-1">
            <div class="field-view me-1" style="height: 51px; width: 380p;" id="f14" >
              <div style="display:flex; justify-content:end;">
                <button class="btn-link ups-txt-blue" style="align-self:center;">View</button>
              </div>
            </div>
            <div class="field-view me-1" style="height: 51px; width: 380px;" id="f15" >
              <div style="display:flex; justify-content:end;">
                <button class="btn-link ups-txt-blue" style="align-self:center;">View</button>
              </div>
            </div>
        </div>

        <!--7th row -->
        <div class="container flex-center mt-1">
            <div class="field-view me-1" style="height: 51px; width: 380p;" id="f16" ></div>
            <div class="field-view me-1" style="height: 51px; width: 380px;" id="f17" ></div>
        </div>

        <!-- Receiver Data -->
        <h1 class="ups-h1 mt-1">Receiver <span class="ups-txt-yellow">Information</span></h1>
        <!-- 1st row -->
        <div class="container flex-center mt-1">
          <div class="field-view me-1" style="height: 51px; width: 380px;" id="f18" ></div>
          <div class="field-view" style="height: 51px; width: 380px;" id="f19" ></div>
        </div>
        <!-- 2nd row -->
        <div class="container flex-center mt-1">
          <div class="field-view me-1" style="height: 51px; width: 560px;" id="f20" ></div>
          <div class="field-view" style="height: 51px; width: 200px;" id="f21" ></div>
        </div>

        <!--3rd row -->
        <div class="container flex-center mt-1">
          <div class="field-view me-1" style="height: 51px; width: 246.67px;" id="f22" ></div>
          <div class="field-view me-1" style="height: 51px; width: 246.67px;" id="f23" ></div>
          <div class="field-view" style="height: 51px; width: 246.67px;" id="f24" ></div>
        </div>

        <div class="container flex-center mt-1 ctb-review">
          <div class="field-view me-1" style="height: 51px; width: 380px;" id="f25" hidden ></div>
          <div class="field-view" style="height: 51px; width: 380px;" id="f26" hidden></div>
        </div>

        <div class="container flex-center mt-1 ctb-review">
          <div class="field-view me-1" style="height: 51px; width: 760px;" id="f27" hidden ></div>
        </div>
        
        <div style="text-align:center;">
          <label class="ups-input-label" style="text-align:center; width:100%;">Transaction Password</label>
          <input type="password" class="field-view" style="width: 246.67px; height: 51px;" name="transpass" id="transpass">
        </div>

        <button class="ups-btn mt-3 mb-5" style="width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" type="button" onclick="transactRemittance()" name="" id="">Submit</button>
      </div>
      <!--END OF REVIEW FORM -->


      <!-- TRANSACTION RESULT PAGE -->
      <center>
        <div class="container flex-center col" id="success">
          <div class="container flex-center mt-1">
              <img src="<?php echo BASE_URL()?>assets/icon/unified-logo.png" alt="" srcset=""> 
              <span style="width:155px; height:30px; font-size:20px; font-weight:600;">UPS Web Portal</span>
          </div>
          <span class="ups-input-label mt-3">Remittance Service</span>
          <div id="successNew">
            <h1 class="ups-h1 txt-center mt-1" style="width:518px; height:90px;">Good Job! Your Transaction is in Progress.</h1>
          <span class="ups-input-label mt-3">Thanks for using Unified!</span>
          </div>
          <div id="successPending">
            <h1 class="ups-h1 txt-center mt-1" style="width:518px; height:90px;">Your Transaction is still in Progress.</h1>
          </div>
          
          <img class="mt-3" src="<?php echo BASE_URL()?>assets/icon/success2.png" alt="" srcset="">
          <div class="container flex-center col mt-3">
            <a href="/Main"><button class="ups-btnRecords btn-yellow mb-2 mt-6" style="font-size: 20px; font-weight: 600;">RETURN TO HOME</button></a>
          </div>
        </div>
      <center>
      <!-- END OF TRANSACTION RESULT PAGE -->
      


    </div>          
  </div> 
</body>

<script>
  /*####################################################### STEP 1 #######################################################*/
  var regcode, userlevel,
    rowid, service, fname, mname, lname, address, addressBrgy, addressCity, province, country, addressZip, country, permanentAddress, 
    bday, nationality, placeOfBirth, regMobile, email, reltore, occupation, sourceOfFund, 
    typeID1, idNum1, dateIssued1, uploadedID1,
    typeID2, idNum2, dateIssued2, uploadedID2, uploadedSig, 
    purposeTrans, amount, rfname, rmname, 
    rlname, raddress, rcountry, rbday, rregMobile, remail, transpass,
    selVal;

  $('#fetchKYC').hide()
  $('#success').hide()
  $('#remitReview').hide() 
  $('#senderForm').hide()
  $('#eceForm').hide() // Unified to Unified form
  $('#ctbForm').hide() // credit to bank form
  $('.contentpanel').hide() // content panel
  $('#frmCebuanaSearchSender').show()
  $('.sender .btnSearch').show()

  // $('#remitForm').hide(); // STEP 1

  $('#remitForm input[type="radio"]').each(function(){
    if($(this).prop("disabled")){
      $(this).parent('div.radio-wrapper').css({"background-color": "#CCCCCC"})
    }
  })

  $(document).ready(function(){
    $('.contentpanel').show(200) // content panel
    
    regcode   = $('#getRegcode').val()
    userlevel = $('#getLevel').val()

    $('.selecttype').click(function(){
      var inputValue = $(this).attr("value")
      var targetBox = $('.' + inputValue);
      var targetBtn = $('.' + inputValue);
      $('.form').not(targetBox).hide()
      $(targetBox).show()
      $('.btnSearch').not(targetBtn).hide()
      $(targetBtn).show()
    })
    $('#serviceForm input').on('change', function() {
      selVal = $('input[name=radio-group]:checked', '#serviceForm').val();
    });
    selVal = $('input[name=radio-group]:checked', '#serviceForm').val();

  })

  /* SEARCH KY USERS */
  function searchKYC(){
    var formData = new FormData();
    fname = $("#frmCebuanaSearchSender input[id=fname]").val()
    lname = $("#frmCebuanaSearchSender input[id=lname]").val()
    formData.append('fname', fname)
    formData.append('lname', lname)
    service = selVal

    if(fname.length == 0 || lname.length == 0){
      swal({
        title: 'Blank fields detected!',
        text: 'Please fill-in required fields.',
        icon: 'warning',
        buttons: false,
      })
    }else{
      waitingDialog.show('Searching Users. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
      $('#fetchKYC_tbl tbody > tr').remove();
      $.ajax({
        url     :"/Kyc_remittance/search_kyc",
        type    :'POST',
        data    : formData,
        processData : false,
        contentType : false,
        success : function (data) {
          var jsonData = JSON.parse(data);
          if(jsonData.S == 1){
            jsonData.T_DATA.forEach(function(i){
              // console.log("searchKYC", i);

              if(i.userlevel == userlevel){
                i.remarks == "null" ? i.remarks = "- -" : i.remarks

                if(i.hitAmla == 1 && i.hitPep == 1){
                  i.remarks = "HIT HIGH"
                }else if(i.hitPep == 1){
                  i.remarks = "HIT HIGH"
                }else if(i.hitAmla == 1){
                  i.remarks = "HIT LOW"
                }

                $(`#fetchKYC_tbl tbody`).append(`
                  <tr>
                    <th class="align-middle text-center" id="rowid">${i.rowid}</th>
                    <th class="align-middle text-center" id="fname">${i.fname}</td>
                    <th class="align-middle text-center" id="lname">${i.lname}</td>
                    <td class="align-middle text-center" id="lname">${i.birthDate}</td>
                    <td class="align-middle text-center" id="remarks">${i.remarks}</td>
                    <td class="align-middle text-center" style="white-space: nowrap">
                      <button class="btnApprove" id="btnViewS" value="${i.rowid}" data-id="${i.rowid}">VIEW</button>
                      <button class="btnSelect" id="btnSelectS" value="${i.rowid}" data-id="${i.rowid}">SELECT</button>
                    </td>
                  </tr>
                `);
              }
            });
            waitingDialog.hide();

            if($('#fetchKYC_tbl tr').length == 1){
              swal({
                title: 'No Users Found!',
                text: ' ',
                icon: 'warning',
                buttons: false,
              })
            }else{
              $('#fetchKYC').show('slide', {direction: 'right'}, 200)
              $('#remitForm').hide()
              $('#frmCebuanaSearchSender').hide()
            }

          }else{
          waitingDialog.hide();

            swal({
              title: 'No Users Found!',
              text: ' ',
              icon: 'warning',
              buttons: false,
            })
          }
        }
      });
    }

  }

  function searchKYC_dealer(){
    var formData = new FormData();
    fname = $("#frmCebuanaSearchSender input[id=fname]").val()
    lname = $("#frmCebuanaSearchSender input[id=lname]").val()
    formData.append('fname', fname)
    formData.append('lname', lname)
    service = selVal

    if(fname.length == 0 || lname.length == 0){
      swal({
        title: 'Blank fields detected!',
        text: 'Please fill-in required fields.',
        icon: 'warning',
        buttons: false,
      })
    }else{
      waitingDialog.show('Searching Users. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
      $('#fetchKYC_tbl tbody > tr').remove();
      $.ajax({
        url     :"/Kyc_remittance/search_kyc",
        type    :'POST',
        data    : formData,
        processData : false,
        contentType : false,
        success : function (data) {
          var jsonData = JSON.parse(data);
          if(jsonData.S == 1){
            jsonData.T_DATA.forEach(function(i){
              console.log("searchKYC", i);
              if(i.regcode == regcode && i.userlevel == userlevel){

                i.remarks == "null" ? i.remarks = "- -" : i.remarks
                if(i.hitAmla == 1 && i.hitPep == 1){
                  i.remarks = "HIT HIGH"
                }else if(i.hitPep == 1){
                  i.remarks = "HIT HIGH"
                }else if(i.hitAmla == 1){
                  i.remarks = "HIT LOW"
                }

                $(`#fetchKYC_tbl tbody`).append(`
                  <tr>
                    <th class="align-middle text-center" id="rowid">${i.rowid}</th>
                    <th class="align-middle text-center" id="fname">${i.fname}</td>
                    <th class="align-middle text-center" id="lname">${i.lname}</td>
                    <td class="align-middle text-center" id="lname">${i.birthDate}</td>
                    <td class="align-middle text-center" id="remarks">${i.remarks}</td>
                    <td class="align-middle text-center" style="white-space: nowrap">
                      <button class="btnApprove" id="btnViewS" value="${i.rowid}" data-id="${i.rowid}">VIEW</button>
                      <button class="btnSelect" id="btnSelectS" value="${i.rowid}" data-id="${i.rowid}">SELECT</button>
                    </td>
                  </tr>
                `);
              }
            });
            waitingDialog.hide();

            if($('#fetchKYC_tbl tr').length == 1){
              swal({
                title: 'No Users Found!',
                text: ' ',
                icon: 'warning',
                buttons: false,
              })
            }else{
              $('#fetchKYC').show('slide', {direction: 'right'}, 200)
              $('#remitForm').hide()
              $('#frmCebuanaSearchSender').hide()
            }

          }else{
          waitingDialog.hide();
            swal({
              title: 'No Users Found!',
              text: ' ',
              icon: 'warning',
              buttons: false,
            })
          }
        }
      });
    }

  }

  $('#btnSearchS').click(function(e){
    e.preventDefault();
    
    if(userlevel == 7){
      searchKYC();
    }else{
      searchKYC_dealer();
    }
  })

  /*####################################################### STEP 2 #######################################################*/
  /* MODAL LABELS */
  $('.modal2 #f1').attr('data-content', 'Full Name')
  $('.modal2 #f2').attr('data-content', 'Present Address')
  $('.modal2 #f3').attr('data-content', 'Permanent Address')
  $('.modal2 #f4').attr('data-content', 'Mobile Number')
  $('.modal2 #f5').attr('data-content', 'Email')
  $('.modal2 #f6').attr('data-content', 'Birth Date')
  $('.modal2 #f7').attr('data-content', 'Birthplace')
  $('.modal2 #f8').attr('data-content', 'Occupation')
  $('.modal2 #f9').attr('data-content', 'Source of Fund')
  $('.modal2 #f10').attr('data-content', 'Country')
  $('.modal2 #f11').attr('data-content', 'Nationality')
  $('.modal2 #f12').attr('data-content', 'ID Type')
  $('.modal2 #f13').attr('data-content', 'ID Number')
  $('.modal2 #f14').attr('data-content', 'Date Issued')
  $('.modal2 #f15').attr('data-content', 'Attached ID')
  $('.modal2 #f16').attr('data-content', 'ID Type')
  $('.modal2 #f17').attr('data-content', 'ID Number')
  $('.modal2 #f18').attr('data-content', 'Date Issued')
  $('.modal2 #f19').attr('data-content', 'Attached ID')
  $('.modal2 #f20').attr('data-content', 'Attached Signature')

  /* SELECT CUSTOMER VIEW DETAILS */
  $(`#fetchKYC_tbl tbody`).on("click", "button#btnViewS", function (e) {
    e.preventDefault()
    var id =  $(this).data("id")
    
    var formData = new FormData()
    formData.append('rowid', id)

    waitingDialog.show('Fetching Details. Please Wait.', {dialogSize: 'sm', progressType: 'primary'})
    $.ajax({
      url     :"/Kyc_remittance/fetch_senderDetails",
      type    :'POST',
      data    : formData,
      processData : false,
      contentType : false,
      success : function (data) {
        var jsonData = JSON.parse(data)
        // console.log("btnViewS", jsonData)

        rowid = jsonData[0]['rowid']

        $('.modal2 #f1').text(jsonData[0]['lname']+", "+jsonData[0]['fname']+" "+jsonData[0]['mname'])
        $('.modal2 #f2').text(jsonData[0]['address']+", "+jsonData[0]['addressBrgy']+", "+jsonData[0]['addressCity']+", "+jsonData[0]['province']+", "+jsonData[0]['country']+", "+jsonData[0]['addressZip'])
        $('.modal2 #f3').text(jsonData[0]['permanentAddress'])
        $('.modal2 #f4').text(jsonData[0]['mobile'])
        $('.modal2 #f5').text(jsonData[0]['emailAdd'])
        $('.modal2 #f6').text(jsonData[0]['birthDate'])
        $('.modal2 #f7').text(jsonData[0]['placeOfBirth'])
        $('.modal2 #f8').text(jsonData[0]['occupation'])
        $('.modal2 #f9').text(jsonData[0]['sourceOfFund'])
        $('.modal2 #f10').text(jsonData[0]['country'])
        $('.modal2 #f11').text(jsonData[0]['nationality'])

        $('.modal2 #f12').text(jsonData[0]['idType1'])
        $('.modal2 #f13').text(jsonData[0]['idNumber1'])
        $('.modal2 #f14').text(jsonData[0]['dateIssued1'])
        $('.modal2 #f15').text(jsonData[0]['id_attachment1'].substring(24))

        $('.modal2 #f16').text(jsonData[0]['idType1'])
        $('.modal2 #f17').text(jsonData[0]['idNumber1'])
        $('.modal2 #f18').text(jsonData[0]['dateIssued1'])
        $('.modal2 #f19').text(jsonData[0]['id_attachment1'].substring(24))

        $('.modal2 #f20').text(jsonData[0]['signature_attachment'].substring(24))
        // alert(rowid)
        $('.modal2 #btnSelectS').attr('data-id', rowid);
        

        waitingDialog.hide();
        $('#btnView').click();
      }
    });
  });

  /* SELECT CUSTOMER */
  $(`#fetchKYC_tbl tbody, .modal2`).on("click", "button#btnSelectS", function (e) { 
    e.preventDefault()
    var id = $(this).attr("data-id")
    
    var formData = new FormData();
    formData.append('rowid', id);

    waitingDialog.show('Fetching Details. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
    $.ajax({
      url     :"/Kyc_remittance/fetch_senderDetails",
      type    :'POST',
      data    : formData,
      processData : false,
      contentType : false,
      success : function (data) {
        var jsonData = JSON.parse(data);
        // console.log("btnSelectS", jsonData);

        rowid        = jsonData[0]['rowid']
        fname        = jsonData[0]['fname']
        mname        = jsonData[0]['mname']
        lname        = jsonData[0]['lname']
        address      = jsonData[0]['address']
        addressBrgy  = jsonData[0]['addressBrgy']
        addressCity  = jsonData[0]['addressCity']
        province     = jsonData[0]['province']
        country      = jsonData[0]['country']
        addressZip   = jsonData[0]['addressZip']
        country      = jsonData[0]['country']

        permanentAddress = jsonData[0]['permanentAddress']
        bday             = jsonData[0]['birthDate']
        nationality      = jsonData[0]['nationality']
        placeOfBirth     = jsonData[0]['placeOfBirth']
        regMobile        = jsonData[0]['mobile']
        email            = jsonData[0]['emailAdd']
        occupation       = jsonData[0]['occupation']
        sourceOfFund     = jsonData[0]['sourceOfFund']

        typeID1      = jsonData[0]['idType1']
        idNum1       = jsonData[0]['idNumber1']
        dateIssued1  = jsonData[0]['dateIssued1']
        uploadedID1  = jsonData[0]['id_attachment1'].substring(24)

        uploadedSig = jsonData[0]['signature_attachment'].substring(24)

        $('#selectedService').val(service)
        $('#fn').val(fname)
        $('#mn').val(mname)
        $('#ln').val(lname)
        $('#address').val(address+", "+addressBrgy+", "+addressCity+", "+province+", "+country+", "+addressZip)
        $('#country').val(country)
        $('#bd').val(bday)
        $('#regMobile').val(regMobile)
        $('#email').val(email)
        $('#occupation').val(occupation)
        $('#sourceOfFund').val(sourceOfFund)
        $('#typeID').val(typeID1)
        $('#idNum').val(idNum1)
        $('#dateIssued').val(dateIssued1)
        $('#uploadedID').val(uploadedID1)
        $('#idView').attr('href', 'downloadSftpFile/'+uploadedID1)
        $('#uploadedSig').val(uploadedSig)
        $('#signatureView').attr('href', 'downloadSftpFile/'+uploadedSig)
        if(service == "Credit-To-Bank (CTB)" || service == "Unified to Unified" || service == "Unified Padala"){
          $('#senderForm #purposeTrans').attr('style', 'margin-left: 25px; width: 776px; height: 53px;')
          $('#senderForm #amount').hide()
          $('#senderForm #lblAmount').hide()
          $('#senderForm #amount').attr('class', 'ups-input')

          $('#btnReview').text('Proceed')
        }else{
          $('#senderForm #purposeTrans').attr('style', 'width: 378px; height: 53px;')
          $('#senderForm #amount').show()
          $('#senderForm #lblAmount').show()
          $('#senderForm #amount').attr('class', 'ups-input field')
          $('#btnReview').text('Review')
        }

        

        waitingDialog.hide();
        if($('.show2-modal').is(":visible")){
          $('#btnView').click();
        }
        $('#senderForm').show('slide', {direction: 'right'}, 200);
        $('#fetchKYC').hide();
      }
    });
  });

  /* HINDI KO ALAM */
  function SubmitForm(){
    $('#senderForm').show()
    $('#remitReview').hide()
    $('#frmCebuanaSearchSender').hide()
    $('#searchForm').hide()
    $('#remitForm').hide()
  }

  var form = document.getElementById('frmCebuanaSearchSender')
  form.addEventListener('submit', SubmitForm)

  /*####################################################### STEP 3 #######################################################*/
  /* REMOVE RED BORDER */
  $(document).ready(function() {
    $('.field input').on('change', function(){
      $('.field input').each(function() {
        if($(this).val().length > 0){
          $(this).css("border","none");
        }
      });
    });

    $('input.field-ctb').on('change', function(){
      $('input.field-ctb').each(function() {
        if($(this).val().length > 0){
          $(this).css("border","none");
        }
      });
    });

    $('input.field-ece').on('change', function(){
      $('input.field-ece').each(function() {
        if($(this).val().length > 0){
          $(this).css("border","none");
        }
      });
    });

    $('input.field').on('change', function(){
      $('input.field').each(function() {
        if($(this).val().length > 0){
          $(this).css("border","none");
        }
      });
    });

    $('#remitReview input').on('change', function(){
      $('#remitReview input').each(function() {
        if($(this).val().length > 0){
          $(this).css("border","1px solid #D4D4D4");
        }
      });
    });

    $('#divReltore .select-selected').click(function(){
      $('#divReltore .select-selected').css("border","none");
    });
    
    
    $('#divSelCountryR .select-selected').click(function(){
      $('#divSelCountryR .select-selected').css("border","none");
    });
    
  });

  /* INPUT CHECKER CTB */
  $('#btnReviewCTB').click(function(e){
    e.preventDefault();
    let empty = false;
    let emptyInput = false;
    var idArray1 = [];
    var idArray2 = [];
    
    $('input.field-ctb').each(function() {
      empty = $(this).val().length;
      $(this).val().length < 1 ? $(this).css("border","3px solid red") : $(this).css("border", "none");
      idArray1.push(empty);
    });
    
    const someIsNotZero1 = idArray1.some(item => item == 0);

    // alert(someIsNotZero1+" "+ idArray1+ " | " + someIsNotZero2+" "+ idArray2); // BLANK FIELD CHECKER
    if (!someIsNotZero1 && $('#selBank').val() != null){
      handleView();
    }else{
      swal({
        title: 'Blank fields detected!',
        text: 'Please fill-in required fields.',
        icon: 'warning',
        buttons: false,
      })
    }

  })
  
  $('#amountECE').keyup(function() {
    // $(this).val() > 50000 ? $(this).css('border','3px solid red') : $(this).css('border', 'none');
    if($(this).val() > 50000){
      $(this).css({'color':'red'})
      $('#lblAlertAmount').text('*Must not exceed 50,000')
      $('#btnReviewECE').attr('disabled', true).css({'background-color':'#CCCCCC','color':'#666'})
    }else{
      $(this).css({'color':'black'})
      $('#lblAlertAmount').text('')
      $('#btnReviewECE').attr('disabled', false).css({'background-color':'#FFC914','color':'white'})
    }
  });

  /* INPUT CHECKER CTB */
  $('#btnReviewECE').click(function(e){
    e.preventDefault();
    let empty = false;
    var idArray1 = [];
    
    $('input.field-ece').each(function() {
      empty = $(this).val().length;
      $(this).val().length < 1 ? $(this).css("border","3px solid red") : $(this).css("border", "none");
      idArray1.push(empty);
    });
    
    const someIsNotZero1 = idArray1.some(item => item == 0);

    // alert(someIsNotZero1+" "+ idArray1); // BLANK FIELD CHECKER
    if (!someIsNotZero1){
      handleView();
    }else{
      swal({
        title: 'Blank fields detected!',
        text: 'Please fill-in required fields.',
        icon: 'warning',
        buttons: false,
      })
    }

  })

  /* INPUT CHECKER REMITTANCE FORM */
  $('#btnReview').click(function(e){
    e.preventDefault();
    let empty = false;
    let emptyInput = false;

    var idArray1 = [];
    var idArray2 = [];

    $('.field input').each(function() {
      empty = $(this).val().length;
      $(this).val().length < 1 ? $(this).css("border","3px solid red") : $(this).css("border", "none");
      idArray1.push(empty);
    });

    $('input.field').each(function() {
      emptyInput = $(this).val().length;
      $(this).val().length < 1 ? $(this).css("border","3px solid red") : $(this).css("border", "none");
      idArray2.push(emptyInput);
    });
    
    $('#reltore').val() == null ? $('#divReltore .select-selected').css("border","3px solid red") : $('#divReltore .select-selected').css("border", "none");
    $('#selCountryR').val() == null ? $('#divSelCountryR .select-selected').css("border","3px solid red") : $('#divSelCountryR .select-selected').css("border", "none");

    const someIsNotZero1 = idArray1.some(item => item == 0);
    const someIsNotZero2 = idArray2.some(item => item == 0);

    // alert(someIsNotZero1+" "+ idArray1+ " | " + someIsNotZero2+" "+ idArray2); // BLANK FIELD CHECKER
    
    if (!someIsNotZero1 && !someIsNotZero2 && $('#reltore').val() != null && $('#selCountryR').val() != null){
      if(service == "Credit-To-Bank (CTB)"){
        handleCTB();
      }else if(service == "Unified to Unified" || service == "Unified Padala"){
        handleECE();
      }else{
        handleView();
      }
    }else{
      swal({
        title: 'Blank fields detected!',
        text: 'Please fill-in required fields.',
        icon: 'warning',
        buttons: false,
      })
    }

  })
  
  /*####################################################### STEP 3.1 #######################################################*/
  /* CREDIT TO BANK */
  function handleCTB(){
    var count_selBanl = $('#selBank option').length
    if(count_selBanl == 1){
      waitingDialog.show('Fetching Details. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});

      $.ajax({
        url     :"/Kyc_remittance/fetch_banks",
        type    :'POST',
        processData : false,
        contentType : false,
        success : function (data) {
          var jsonData = JSON.parse(data);
          jsonData.B_DATA.forEach(function(i){
            // console.log(i)
            $('#selBank').append($('<option>', {
              id    : i.BANK_ID,
              value : i.BANK_MNEMONIC,
              text  : i.BANK_DESCRIPTION,
            }))
          })
          
          var x, i, j, l, ll, selElmnt, a, b, c;
          /*look for any elements with the class "custom-select":*/
          x = $('#ctbForm .ups-ctb')
          l = x.length;
          for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;
            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < ll; j++) {
              /*for each option in the original select element,
              create a new DIV that will act as an option item:*/
              c = document.createElement("DIV");
              c.innerHTML = selElmnt.options[j].innerHTML;
              c.addEventListener("click", function(e) {
                  /*when an item is clicked, update the original select box,
                  and the selected item:*/
                  var y, i, k, s, h, sl, yl;
                  s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                  sl = s.length;
                  h = this.parentNode.previousSibling;
                  for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                      s.selectedIndex = i;
                      h.innerHTML = this.innerHTML;
                      y = this.parentNode.getElementsByClassName("same-as-selected");
                      yl = y.length;
                      for (k = 0; k < yl; k++) {
                        y[k].removeAttribute("class");
                      }
                      this.setAttribute("class", "same-as-selected");
                      break;
                    }
                  }
                  h.click();
              });
              b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function(e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
              });
          }
          function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,
            except the current select box:*/
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
              if (elmnt == y[i]) {
                arrNo.push(i)
              } else {
                y[i].classList.remove("select-arrow-active");
              }
            }
            for (i = 0; i < xl; i++) {
              if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
              }
            }
          }
          /*if the user clicks anywhere outside the select box,
          then close all select boxes:*/
          document.addEventListener("click", closeAllSelect);
          /* END OF SELECT SCRIPT */

          waitingDialog.hide();
          $('#ctbForm').show('slide', {direction: 'right'}, 200)
          $('#senderForm').hide()
          $('#remitReview').hide()
        }

      });
    }else{
      $('#ctbForm').show('slide', {direction: 'right'}, 200)
      $('#senderForm').hide()
      $('#remitReview').hide()
    }


  }




  /*####################################################### STEP 3.2 #######################################################*/
  /* Unified to Unified */
  function handleECE(){
    $('#lblAccountNumber').text('REGCODE')
    if(service == "Unified to Unified"){
      $('#eceForm #titlebBlack').text('Unified to Unified');
      $('#eceForm #titlebYellow').text('Form');
    }else if(service == "Unified Padala"){
      $('#eceForm #titlebBlack').text('Unified Padala');
      $('#eceForm #titlebYellow').text('Form');
    }

    $('#eceForm').show('slide', {direction: 'right'}, 200)
    $('#senderForm').hide()
    $('#remitReview').hide()
  }

  /*####################################################### STEP 4 #######################################################*/
  /* REVIEW DETAILS */
  function handleView(){
    $('#remitReview #f1').attr('data-content', 'Service')
    $('#remitReview #f2').attr('data-content', 'Full Name')
    $('#remitReview #f3').attr('data-content', 'Address')
    $('#remitReview #f4').attr('data-content', 'Country')
    $('#remitReview #f5').attr('data-content', 'Birthdate')
    $('#remitReview #f6').attr('data-content', 'Mobile Number')
    $('#remitReview #f7').attr('data-content', 'Email Address')
    $('#remitReview #f8').attr('data-content', 'Relationship to Receiver')
    $('#remitReview #f9').attr('data-content', 'Occupation')
    $('#remitReview #f10').attr('data-content', 'Source of Fund')
    $('#remitReview #f11').attr('data-content', 'Type of ID')
    $('#remitReview #f12').attr('data-content', 'ID Number')
    $('#remitReview #f13').attr('data-content', 'Date Issued')
    $('#remitReview #f14').attr('data-content', 'Uploaded ID')
    $('#remitReview #f15').attr('data-content', 'Uploaded Signiture')
    $('#remitReview #f16').attr('data-content', 'Purpose of Transaction')
    $('#remitReview #f17').attr('data-content', 'Amount')
    $('#remitReview #f18').attr('data-content', 'Service')
    $('#remitReview #f19').attr('data-content', 'Full Name')
    $('#remitReview #f20').attr('data-content', 'Address')
    $('#remitReview #f21').attr('data-content', 'Country')
    $('#remitReview #f22').attr('data-content', 'Birthdate')
    $('#remitReview #f23').attr('data-content', 'Mobile Number')
    $('#remitReview #f24').attr('data-content', 'Email Address')
    if(service == "Credit-To-Bank (CTB)"){
      $('#remitReview #f25').show()
      $('#remitReview #f26').show()
      $('#remitReview #f25').attr('data-content', 'BANK')
      $('#remitReview #f26').attr('data-content', 'Account Number')
      $('#remitReview #f27').hide()
    }else if(service == "Unified to Unified" || service == "Unified Padala"){
      $('#remitReview #f27').show()
      $('#remitReview #f27').attr('data-content', 'REGCODE')
    }else{
      $('#remitReview #f25').hide()
      $('#remitReview #f27').hide()
      $('#remitReview #f26').hide()
    }

    $('#success').hide()
    $('#ctbForm').hide()
    $('#eceForm').hide()
    $('#remitForm').hide()
    $('#remitReview').show('slide', {direction: 'right'}, 200)
    $('#senderForm').hide()
    reltore = $('#reltore').val()
    purposeTrans = $('#purposeTrans').val()
    if(service == "Credit-To-Bank (CTB)"){
      amount = $('#ctbForm #amountCTB').val()
    }else if(service == "Unified to Unified" || service == "Unified Padala"){
      amount = $('#eceForm #amountECE').val()
    }else{
      amount = $('#amount').val()
    }
    rfname = $('#rfn').val()
    rmname = $('#rmn').val()
    rlname = $('#rln').val()
    raddress = $('#raddress').val()
    rcountry = $('#selCountryR').val()
    rbday = $('#rbd').val()
    rregMobile = "0"+$('#rregMobile').val()
    remail = $('#remail').val() 

    bank = $('#ctbForm #selBank').val() 
    if(service == "Credit-To-Bank (CTB)"){
      accountNo = $('#ctbForm #accountNumber').val() 
    }else if(service == "Unified to Unified" || service == "Unified Padala"){
      accountNo = $('#eceForm #accountNumber').val() 
    }else{
      accountNo = null
    }
    // alert(reltore)

    $('#remitReview #f1').text(service)
    $('#remitReview #f2').text(lname+", "+fname+" "+mname)
    $('#remitReview #f3').text(address)
    $('#remitReview #f4').text(country)
    $('#remitReview #f5').text(bday)
    $('#remitReview #f6').text(regMobile)
    $('#remitReview #f7').text(email)
    $('#remitReview #f8').text(reltore)
    $('#remitReview #f9').text(occupation)
    $('#remitReview #f10').text(sourceOfFund)
    $('#remitReview #f11').text(typeID1)
    $('#remitReview #f12').text(idNum1)
    $('#remitReview #f13').text(dateIssued1)
    $('#remitReview #f14').text(uploadedID1)
    $('#remitReview #f15').text(uploadedSig)
    $('#remitReview #f16').text(purposeTrans)
    $('#remitReview #f17').text(amount)
    $('#remitReview #f18').text(service)
    $('#remitReview #f19').text(rlname+", "+rmname+" "+rfname)
    $('#remitReview #f20').text(raddress)
    $('#remitReview #f21').text(rcountry)
    $('#remitReview #f22').text(rbday)
    $('#remitReview #f23').text(rregMobile)
    $('#remitReview #f24').text(remail)
    $('#remitReview #f25').text(bank)
    $('#remitReview #f26').text(accountNo)
    $('#remitReview #f27').text(accountNo)
  }

  /*####################################################### STEP 5 #######################################################*/
  /* REMITTANCE TRANSACT */
  function transactRemittance(){
    transpass = $('#transpass').val();

    var params = {
      rowid                : rowid,
      service              : service,
      s_relationToReceiver : reltore,
      s_purpose            : purposeTrans,
      amount               : amount,
      r_refNo              : "N/A",
      r_fname              : rfname,
      r_mname              : rmname,
      r_lname              : rlname,
      r_address            : raddress,
      r_country            : rcountry,
      r_birthDate          : rbday,
      r_mobile             : rregMobile,
      r_email              : remail,
      transpass            : transpass,
      bank                 : bank,
      accountNo            : accountNo,
    }

    // alert(JSON.stringify(params));
    // console.log("transactRemittance", JSON.stringify(params));

    if(transpass.length == 0){
      swal({
        title: 'Blank fields detected!',
        text: 'Please fill-in Transaction Password.',
        icon: 'warning',
        buttons: false,
      })
      $('#transpass').css("border","3px solid red");

    }else{
      waitingDialog.show('Posting Transaction. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
      $.ajax({
        url     :"/Kyc_remittance/trans_test",
        type    :'POST',
        data    : params,
        datatype: 'json',
        success : function (data) {
          var jsonData = JSON.parse(data);
          // console.log(jsonData);
          if(jsonData.S == 1){
            if(jsonData.M == "TRANSACTION PENDING, WAITING FOR APPROVAL"){
              $('#success').show('slide', {direction: 'up'}, 200)
              $('#successNew').hide()
              $('#remitReview').hide()
            }
            else{
              $('#success').show('slide', {direction: 'up'}, 200)
              $('#successPending').hide()
              $('#remitReview').hide()
            }
          } else {
            swal({
              title: jsonData.M,
              text: ' ',
              icon: 'warning',
              buttons: false,
            })
          }
          waitingDialog.hide();
        }
      });
    }
    
  }

</script>


<!-- SCRIPT FOR VIEW KYC USER MODAL -->
<script>
  const modal = document.querySelector(".modal2");
  const trigger = document.querySelector("#btnView");
  const closeButton = document.querySelector(".close2-button");

  function toggleModal() {
      modal.classList.toggle("show2-modal");
      e.preventDefault();
  }

  function windowOnClick(event) {
      if (event.target === modal) {
        toggleModal();
      }
  }

  trigger.addEventListener("click", toggleModal);
  closeButton.addEventListener("click", toggleModal);
  window.addEventListener("click", windowOnClick);
</script>

<!-- select script -->
<script>
  var x, i, j, l, ll, selElmnt, a, b, c;
  /*look for any elements with the class "custom-select":*/
  x = document.getElementsByClassName("ups-select");
  l = x.length;
  for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
      /*for each option in the original select element,
      create a new DIV that will act as an option item:*/
      c = document.createElement("DIV");
      c.innerHTML = selElmnt.options[j].innerHTML;
      c.addEventListener("click", function(e) {
          /*when an item is clicked, update the original select box,
          and the selected item:*/
          var y, i, k, s, h, sl, yl;
          s = this.parentNode.parentNode.getElementsByTagName("select")[0];
          sl = s.length;
          h = this.parentNode.previousSibling;
          for (i = 0; i < sl; i++) {
            if (s.options[i].innerHTML == this.innerHTML) {
              s.selectedIndex = i;
              h.innerHTML = this.innerHTML;
              y = this.parentNode.getElementsByClassName("same-as-selected");
              yl = y.length;
              for (k = 0; k < yl; k++) {
                y[k].removeAttribute("class");
              }
              this.setAttribute("class", "same-as-selected");
              break;
            }
          }
          h.click();
      });
      b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function(e) {
        /*when the select box is clicked, close any other select boxes,
        and open/close the current select box:*/
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
      });
  }
  function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i)
      } else {
        y[i].classList.remove("select-arrow-active");
      }
    }
    for (i = 0; i < xl; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
      }
    }
  }
  /*if the user clicks anywhere outside the select box,
  then close all select boxes:*/
  document.addEventListener("click", closeAllSelect);


  function clearSearchData(){
    $('#fetchKYC_tbl tbody > tr').remove();
  }

  function clearSenderForm(){
    $('#senderForm #fn').val('')
    $('#senderForm #mn').val('')
    $('#senderForm #ln').val('')
    $('#senderForm #address').val('')
    $('#senderForm #country').val('')
    $('#senderForm #bd').val('')
    $('#senderForm #regMobile').val('')
    $('#senderForm #email').val('')
    $('#senderForm #occupation').val('')
    $('#senderForm #sourceOfFund').val('')
    $('#senderForm #typeID').val('')
    $('#senderForm #idNum').val('')
    $('#senderForm #dateIssued').val('')
    $('#senderForm #uploadedID').val('')
    $('#senderForm #uploadedSig').val('')
  }

  $('#form-prev').click(function(e){
      e.preventDefault()
      if($('#fetchKYC').show()){
        $('#fetchKYC').hide()
        $('#remitForm').show('slide', {direction: 'left'}, 200)
        $('#frmCebuanaSearchSender').show()

        clearSearchData();
      }
  })

  $('#form-prev2').click(function(e){
      e.preventDefault()
      if($('#senderForm').show()){
        $('#senderForm').hide()
        $('#fetchKYC').show('slide', {direction: 'left'}, 200)
        $('#remitForm').hide()
        $('#frmCebuanaSearchSender').hide()
        
        clearSenderForm();
      }
  })

  $('#form-ctb-prev').click(function(e){
      e.preventDefault()
      if($('#remitReview').show()){
        $('#remitReview').hide()
        $('#ctbForm').hide()
        $('#senderForm').show('slide', {direction: 'left'}, 200)
        $('#fetchKYC').hide()
        $('#remitForm').hide()
        $('#frmCebuanaSearchSender').hide()
      }
  })

  $('#form-ece-prev').click(function(e){
      e.preventDefault()
      if($('#remitReview').show()){
        $('#remitReview').hide()
        $('#eceForm').hide()
        $('#senderForm').show('slide', {direction: 'left'}, 200)
        $('#fetchKYC').hide()
        $('#remitForm').hide()
        $('#frmCebuanaSearchSender').hide()
      }
  })

  $('#form-prev3').click(function(e){
      e.preventDefault()
      if($('#remitReview').show()){
        $('#remitReview').hide()
        $('#senderForm').show('slide', {direction: 'left'}, 200)
        $('#fetchKYC').hide()
        $('#remitForm').hide()
        $('#frmCebuanaSearchSender').hide()
      }
  })

</script>
<!-- DATEPICKER SCRIPT - DISABLE FUTURE DATES & 16YRS FROM PRESENT DATE -->
<script>
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear() - 16;
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    // alert(maxDate);
    $('#rbd').attr('max', maxDate);
});
</script>