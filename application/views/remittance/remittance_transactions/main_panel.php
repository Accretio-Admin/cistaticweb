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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
      .ups-btn{
          height: 56px;
          width: 322px;
          border-radius: 12px !important;
          padding: 8px 40px 8px 40px !important;
          border:none !important;
      }

      .searchBar{
        position: relative;
      }

      .searchBarField{
        background: #F4F4F4;
        border-radius: 10px;
        border:none !important;
        padding-left: 10px;
      }

      .filterBtn{
        padding: 8px 12px;
        gap: 10px;
        width: 110.73px;
        height: 39px;
        background: #EAEAEA;
        border-radius: 7px;
        border:none !important;
        margin-right: -220px;
        position: absolute;
        text-align:left;

      }

      .btnApprove{
        border: none;
        padding: 7px 10px;
        width: 84px;
        height: 34px;
        color: #FFFFFF;
        background: #27AE60;
        border-radius: 8px;
        margin-top: 8px;
        margin-bottom: 8px;
      }

      .btnDeny{
        border: none;
        padding: 7px 10px;
        width: 78px;
        height: 34px;
        color: #FFFFFF;
        background: #CFCFCF;
        border-radius: 8px;
        margin-top: 8px;
        margin-bottom: 8px;
      }

      .img-title{
        height: 180px;
        width: 950px;
        border-radius: 20px;
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

    .record-search-table{
      width: 1160px;
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
    
    .no-record{
        text-align:center ;
        font-size: 14px;
        font-weight: 500;
        height: 212px;
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
</style>


<body class="font-poppins">
  <div class="mainpanel">
    <div class="contentpanel">

      <!-- <form>       -->
        <input hidden id="getLevel" value="<?php echo $level ?>"></input>
        <input hidden id="getRegcode" value="<?php echo $userR ?>"></input>

        <div class="container flex-center col">
          <img class="img-title mt-2" src="<?php echo BASE_URL() ?>assets/images/kyc/remit_banner.png" style="text-align: center; padding-left: 70px; padding-right: 30px" alt="UPS Title Bar" width="950" height="180">
          <div class="container row mt-2">
            <h1 class="ups-h1 txt-center ups-txt-dark" id="rtTitle">Remittance <span id="rtLevel"></span><span class="ups-txt-yellow"> Transactions</span></h1>
            <!-- <div class="container mt-2">
                <h4 class="txt-center" style="">Search List</h4>
            </div> -->
          </div>

          <div class="container flex-center mt-2 searchBar">
            <button hidden id="trigger">SHOW</button>
            <!-- <input type="text" class="searchBarField" placeholder="Enter Reference Number" style="width:510px; height:49px">
            <button class="filterBtn">By Ref #</button>
            <button class="ups-btn ms-1" style="width: 153px; height:49px; background-color:#FFC914; font-size:15px; font-weight:500; color: white;">Search</button> -->
          </div>
            
          <div class="container flex-center col">
            <table id="transaction" class="record-search-table">
              <thead>
                <tr>
                  <td class="corner1">NAME</td>
                  <td>SERVICE</td>
                  <td>REF #</td>
                  <td>TYPE</td>
                  <td>DATE SUBMITTED</td>
                  <td>REMARKS</td>
                  <td>STATUS</td>
                  <td class="corner2">ACTIONS</td>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div class="container row">
                <h6 class="txt-left" style="font-style: italic;">Displaying <span id="displayedRecords"></span> of <span id="totalRecords"></span> record(s)</h6>
            </div>
          </div>

        </div>
      <!-- </form> -->

      <!-- MODAL CUSTOMER DETAILS -->
      <div class="modal2">
        <div class="modal2-content">
            <span class="close2-button">×</span>

            <div class="col flex-center mt-3" style="margin-left: 25px;">
              <h1 class="ups-h1 txt-center ups-txt-dark mt-1">SENDER <span class="ups-txt-yellow">DETAILS</span></h1>
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

            <!-- Review Attached ID 1 -->
            <div class="col flex-center">
              <a href="#" id="id1View" target="_blank"><div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px" id="f15" ></div></a>
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
          
            <!-- Review Attached ID 2 -->
            <div class="col flex-center">
              <a href="#" id="id2View" target="_blank"><div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px" id="f19" ></div></a>
            </div>

            <div class="col flex-center" style="margin-left: 25px;">
              <h1 class="ups-h1 txt-center ups-txt-dark mt-1">RECEIVER <span class="ups-txt-yellow">DETAILS</span></h1>
            </div>

            <div class="col flex-center mt-2">
              <div class="row">
                <div class="col-xs-6">
                  <div class="field-view row" style="height: 52px; width: 340px; margin-left: 25px;" id="f20"></div>
                </div>
                <div class="col-xs-6">
                  <div class="field-view row" style="height: 52px; width: 340px; margin-left: 25px;" id="f21"></div>
                </div>
              </div>
            </div>

             <!-- Review Receiver Full name and Addresses -->
            <!-- 1st row -->
            <div class="col flex-center">
              <div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px" id="f22" name="fullname"></div>
            </div>
            <!-- 2nd row -->
            <div class="col flex-center">
              <div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px" id="f23" name="address"></div>
            </div>

            <!--3rd row -->
            <div class="col flex-center">
              <div class="row">
                <div class="col-xs-6">
                  <div class="field-view row" style="height: 52px; width: 340px; margin-left: 25px;" id="f24"></div>
                </div>
                <div class="col-xs-6">
                  <div class="field-view row" style="height: 52px; width: 340px; margin-left: 25px;" id="f25"></div>
                </div>
              </div>
            </div>

            <div class="col flex-center">
              <div class="row">
                <div class="col-xs-6">
                  <div class="field-view row" style="height: 52px; width: 340px; margin-left: 25px;" id="f26"></div>
                </div>
                <div class="col-xs-6">
                  <div class="field-view row" style="height: 52px; width: 340px; margin-left: 25px;" id="f27"></div>
                </div>
              </div>
            </div>
        
            <!-- Review Account No and Amount -->
            <div class="col flex-center mt-1">
              <div class="row">
                <div class="col-xs-6">
                  <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f28" disabled></div>
                </div>
                <div class="col-xs-6">
                  <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f29" disabled></div>
                </div>
              </div>
            </div>

            <!-- SUPERVISOR PASSWORD -->            
            <div class="col flex-center mt-1">
              <label class="ups-input-label" style="text-align: center; width: 320px; font-size: 22px; font-weight: 500;" id="lblPassword">Supervisor Password</label>
            </div>
            <div class="col flex-center">
              <input type="password" class="field-view row" style="height: 52px; width: 365px;" id="supervisorPass" />
            </div>

            <!-- TRANSACT -->
            <div class="col flex-center mb-3" id="btnSubmitDiv">
              <button class="btnApprove" id="btnSubmit" style="height:56px; width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" data-id="">SUBMIT</button>
            </div>
        </div>
      </div>
      <!-- END OF MODAL CUSTOMER DETAILS -->

      <!-- MODAL DENY TRANSACTION -->
      <div class="modal mt-5" id="transactionDenyModal" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">  
            <div class="modal-header">
              <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="col flex-center mt-3" style="margin-left: 25px;">
                <h1 class="ups-h1 txt-center ups-txt-dark mt-1">ARE YOU <span class="ups-txt-yellow">SURE?</span></h1>
                <h4 class="txt-center mt-2">You want to decline transaction <span style="text-decoration: underline;" id="denyTrackno"></span> ?</h4>
              </div>
            </div>

            <div class="col flex-center mt-2">
              <h4 class="txt-center" style="" id="lblDenyPassword"></h4>
              <input type="password" class="field-view row" style="height: 52px; width: 365px; " id="passwordDeny" />
            </div>
            <div class="col flex-center mb-3" id="confirmDiv">
              <button class="btnApprove" id="btnConfirm" style="height:56px; width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" data-id="">CONFIRM</button>
            </div>
          </div>
        </div>
      </div>
      <!-- END OF MODAL DENY TRANSACTION -->

    </div><!-- CONTENT PANLE -->
  </div><!-- MAIN PANEL -->
</body>

<script>
  var service, userlevel, regcode, actionID, trackno,
      s_regcode,
     f1,  f2,  f3,  f4,  f5,  f6,  f7,  f8,  f9, f10,
    f11, f12, f13, f14, f15, f16, f17, f18, f19, f20,
    f21, f22, f23, f24, f25, f26, f27, f28, f29;

  $(document).ready(function(){
    userlevel = $('#getLevel').val();
    regcode   = $('#getRegcode').val();

    /* CHECK IF DEALER OR HUB ACCOUNT */
    if(userlevel == 7){ //HUB
      fetchData();
      $('#rtLevel').text('Hub')
    } else {            //DEALER
      fetchDataDealer();
      $('#rtLevel').text('Dealer')
      $('#lblPassword').text('Transaction Password')
    }

  });
  
  function fetchData(){
    waitingDialog.show('Fetching Transaction. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
    $('#transaction tbody > tr').remove();

    $.ajax({
      url         :"/Remittance_transactions/fetch_transaction",
      type        :'POST',
      processData : false,
      contentType : false,
      success : function (data) {
        var res = JSON.parse(data)
        // console.log(res);
        if(res.length > 0) {
          res.forEach(function(i){
            // console.log(i);
            if(i.regcode == regcode && i.userlevel == userlevel){
              i.status == "POSTED" ? i.status = "PENDING" : i.status = "";
              i.remarks == null ? i.remarks = "- -" : i.remarks

              $(`#transaction tbody`).append(`
                <tr>
                  <th class="align-middle text-center" id="fullname">${i.fullname}</th>
                  <td class="align-middle text-center" id="service">${i.service}</td>
                  <td class="align-middle text-center" style="text-decoration: underline;" id="trackingNo">${i.trackingNo}</td>
                  <td class="align-middle text-center">Sender</td>
                  <td class="align-middle text-center" id="createdAt">${i.createdAt}</td>
                  <td class="align-middle text-center" id="remarks">${i.remarks}</td>
                  <td class="align-middle text-center" id="status">${i.status}</td>
                  <td class="align-middle text-center">
                    <button class="btnApprove" id="btnApprove" value="${i.id}" data-id="${i.trackingNo}" data-service="${i.service}">APPROVE</button>
                    <button class="btnDeny" id="btnDeny" value="${i.id}" data-id="${i.trackingNo}" data-service="${i.service}" data-toggle="modal" data-target="#transactionDenyModal">DENY</button>   
                  </td>
                </tr>
              `);
            }

          });

          waitingDialog.hide()
          $('#displayedRecords').text($('#transaction tr').length-1)
          $('#totalRecords').text($('#transaction tr').length-1)

          if($('#transaction tr').length == 1){
            $(`#transaction tbody`).append(`<td valign="top" style="text-align:center; padding-top:10px; padding-bottom: 10px;" colspan="10" class="dataTables_empty">No data available in table</td>`);
            $('#displayedRecords').text(0)
            $('#totalRecords').text(0)
          }
        }else{
          waitingDialog.hide()
          $(`#transaction tbody`).append(`<td valign="top" style="text-align:center; padding-top:10px; padding-bottom: 10px;" colspan="10" class="dataTables_empty">No data available in table</td>`);
          $('#displayedRecords').text(0)
          $('#totalRecords').text(0)
        }
      }
    });
  }

  function fetchDataDealer(){
    waitingDialog.show('Fetching Transaction. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
    $('#transaction tbody > tr').remove();

    $.ajax({
      url         :"/Remittance_transactions/fetch_transaction",
      type        :'POST',
      processData : false,
      contentType : false,
      success     : function (data) {
        var res = JSON.parse(data)
        // console.log(res);
        if(res.length > 0) {
          res.forEach(function(i){
            // console.log(i.regcode);
            if(i.userlevel == 6){
              i.status == "POSTED" ? i.status = "PENDING" : i.status = "";
              i.remarks == null ? i.remarks = "- -" : i.remarks

              $(`#transaction tbody`).append(`
                <tr>
                  <th class="align-middle text-center" id="fullname">${i.fullname}</th>
                  <td class="align-middle text-center" id="service">${i.service}</td>
                  <td class="align-middle text-center" style="text-decoration: underline;" id="trackingNo">${i.trackingNo}</td>
                  <td class="align-middle text-center">Sender</td>
                  <td class="align-middle text-center" id="createdAt">${i.createdAt}</td>
                  <td class="align-middle text-center" id="remarks">${i.remarks}</td>
                  <td class="align-middle text-center" id="status">${i.status}</td>
                  <td class="align-middle text-center">
                    <button class="btnApprove" id="btnApprove" value="${i.id}" data-id="${i.trackingNo}" data-service="${i.service}">APPROVE</button>
                    <button class="btnDeny" id="btnDeny" value="${i.id}" data-id="${i.trackingNo}" data-service="${i.service}" data-toggle="modal" data-target="#transactionDenyModal">DENY</button>   
                  </td>
                </tr>
              `);
            }

          });

          waitingDialog.hide()
          $('#displayedRecords').text($('#transaction tr').length-1)
          $('#totalRecords').text($('#transaction tr').length-1)

          if($('#transaction tr').length == 1){
            $(`#transaction tbody`).append(`<td valign="top" style="text-align:center; padding-top:10px; padding-bottom: 10px;" colspan="10" class="dataTables_empty">No data available in table</td>`);
            $('#displayedRecords').text(0)
            $('#totalRecords').text(0)
          }
        }else{
          waitingDialog.hide()
          $(`#transaction tbody`).append(`<td valign="top" style="text-align:center; padding-top:10px; padding-bottom: 10px;" colspan="10" class="dataTables_empty">No data available in table</td>`);
          $('#displayedRecords').text(0)
          $('#totalRecords').text(0)
        }
      }
    });
  }
  
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

  $('.modal2 #f20').attr('data-content', 'Purpose')
  $('.modal2 #f21').attr('data-content', 'Relation to Receiver')

  $('.modal2 #f22').attr('data-content', 'Full Name')
  $('.modal2 #f23').attr('data-content', 'Address')
  $('.modal2 #f24').attr('data-content', 'Country')
  $('.modal2 #f25').attr('data-content', 'Birthdate')
  $('.modal2 #f26').attr('data-content', 'Mobile Number')
  $('.modal2 #f27').attr('data-content', 'Email Address')

  $('.modal2 #f28').attr('data-content', 'Account Number')
  $('.modal2 #f29').attr('data-content', 'Amount')
  // $('.modal2 #f23').attr('data-content', 'Supervisor Password')

  /* APPROVE */
  $(`#transaction tbody`).on("click", "button#btnApprove", function (e) { 
    e.preventDefault();

    service = $(this).attr("data-service");

    var trackno =  $(this).data("id")
    
    var formData = new FormData();
    formData.append('trackno', trackno);

    waitingDialog.show('Fetching Details. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
    $.ajax({
      url         :"/Remittance_transactions/remittanceTransaction",
      type        :'POST',
      data        : formData,
      processData : false,
      contentType : false,
      success     : function (data) {
        var jsonData = JSON.parse(data);
        // console.log(jsonData);

        trackingNo = jsonData[0]['trackingNo']
        accountNo  = jsonData[0]['accountNo']
        s_regcode  = jsonData[0]['regcode']
        accountNo == "" ? accountNo = "N/A" : accountNo;

        // uploadedID1  = jsonData[0]['id_attachment1'].substring(24)

        // uploadedSig = jsonData[0]['signature_attachment'].substring(24)

        f1  = jsonData[0]['lname']+", "+jsonData[0]['fname']+" "+jsonData[0]['mname']
        f2  = jsonData[0]['address']+", "+jsonData[0]['addressBrgy']+", "+jsonData[0]['addressCity']+", "+jsonData[0]['province']+", "+jsonData[0]['country']+", "+jsonData[0]['addressZip']
        f3  = jsonData[0]['permanentAddress']
        f4  = jsonData[0]['mobile']
        f5  = jsonData[0]['emailAdd']
        f6  = jsonData[0]['birthDate']
        f7  = jsonData[0]['placeOfBirth']
        f8  = jsonData[0]['occupation']
        f9  = jsonData[0]['sourceOfFund']
        f10 = jsonData[0]['country']
        f11 = jsonData[0]['nationality']
        f12 = jsonData[0]['idType1']
        f13 = jsonData[0]['idNumber1']
        f14 = jsonData[0]['dateIssued1']
        f15 = jsonData[0]['id_attachment1'].substring(24)
        f16 = jsonData[0]['idType2']
        f17 = jsonData[0]['idNumber2']
        f18 = jsonData[0]['dateIssued2']
        f19 = jsonData[0]['id_attachment2'].substring(24)
        f20 = jsonData[0]['s_purpose']
        f21 = jsonData[0]['s_relationToReceiver']
        f22 = jsonData[0]['r_lname']+", "+jsonData[0]['r_fname']+" "+jsonData[0]['r_mname']
        f23 = jsonData[0]['r_address']
        f24 = jsonData[0]['r_country']
        f25 = jsonData[0]['r_birthDate']
        f26 = jsonData[0]['r_mobile']
        f27 = jsonData[0]['r_email']
        f28 = accountNo
        f29 = jsonData[0]['amount']
        
        $('.modal2 #f1').text(f1)
        $('.modal2 #f2').text(f2)
        $('.modal2 #f3').text(f3)
        $('.modal2 #f4').text(f4)
        $('.modal2 #f5').text(f5)
        $('.modal2 #f6').text(f6)
        $('.modal2 #f7').text(f7)
        $('.modal2 #f8').text(f8)
        $('.modal2 #f9').text(f9)
        $('.modal2 #f10').text(f10)
        $('.modal2 #f11').text(f11)
        $('.modal2 #f12').text(f12)
        $('.modal2 #f13').text(f13)
        $('.modal2 #f14').text(f14)
        $('.modal2 #f15').text(f15).css({'color':'blue','font-weight':'heavy'})
        $('.modal2 #id1View').attr('href', 'downloadSftpFile/'+f15)
        $('.modal2 #f16').text(f16)
        $('.modal2 #f17').text(f17)
        $('.modal2 #f18').text(f18)
        $('.modal2 #f19').text(f19).css({'color':'blue','font-weight':'heavy'})
        $('.modal2 #id2View').attr('href', 'downloadSftpFile/'+f19)
        $('.modal2 #f20').text(f20)
        $('.modal2 #f21').text(f21)
        $('.modal2 #f22').text(f22)
        $('.modal2 #f23').text(f23)
        $('.modal2 #f24').text(f24)
        $('.modal2 #f25').text(f25)
        $('.modal2 #f26').text(f26)
        $('.modal2 #f27').text(f27)
        $('.modal2 #f28').html(f28)
        $('.modal2 #f29').html(f29)
        $('.modal2 #btnSubmit').attr('data-id', trackingNo);

        waitingDialog.hide();
        $('#trigger').click();
      }
    });

  })

  $(`.modal2`).on("click", "button#btnSubmit", function (e) { 
    var formData = new FormData();
    formData.append('client_regcode', f28);
    formData.append('amount', f29);
    formData.append('svpass', $('#supervisorPass').val());
    formData.append('trackingNo', trackingNo);
    
    if(service == "Unified to Unified"){
      if(userlevel == 7){
        actionID = "/Remittance_transactions/ecash_to_ecash"
      }else{
        actionID = "/Remittance_transactions/ecash_to_ecash_dealer"
        formData.append('s_regcode', s_regcode);
      }
    }else if(service == "Unified Padala"){
      actionID = "/Remittance_transactions/ecash_padala"
      formData.append('sender_id', f15);
      formData.append('sender_mobile', f26);

      formData.append('bene_id', "N/A");
      formData.append('bene_name', f22);
    } else {
      swal({
        title  : 'Error!',
        text   : service+' is currently Down!',
        icon   : 'warning',
        buttons: false,
      })
      $('#trigger').click();

      return;
    }

    if($('#supervisorPass').val() == ""){
      swal({
        title: 'Blank field detected!',
        text: 'Please fill-in Password.',
        icon: 'warning',
        buttons: false,
      })
    }else{
      waitingDialog.show('Approving Transaction. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
  
      $.ajax({
        url         : actionID,
        type        : 'POST',
        data        : formData,
        processData : false,
        contentType : false,
        success     : function (data) {
          var jsonData = JSON.parse(data);
          // console.log(jsonData);
          if(jsonData.S == 1){
            swal({
              title: 'Success!',
              text: jsonData.TN,
              icon: 'success',
              buttons: false,
            })
            $('#trigger').click();
            
            if(userlevel == 7){ //HUB
              fetchData();
            } else {            //DEALER
              fetchDataDealer();
            }
          }else{
            swal({
              title   : 'Transaction Failed!',
              text    : jsonData.M,
              icon    : 'warning',
              buttons : false,
            })
          }
          waitingDialog.hide();
        }
      });
    }
   
  })

  /* DENY TRANSACTION */
  $(`#transaction tbody`).on("click", "button#btnDeny", function (e) { 
    // alert($(this).attr('data-id'))
    trackNo = $(this).data("id");
    if(userlevel == 7) { //HUB
      $('#lblDenyPassword').text("Supervisor Password")
      actionID = "/Remittance_transactions/transaction_deny_sv"
    } else {            //DEALER
      $('#lblDenyPassword').text("Transaction Password")
      actionID = "/Remittance_transactions/transaction_deny"
    }

    $('#denyTrackno').text(trackNo)
  });

  $('#btnConfirm').click(function(){
    var formData = new FormData();
    formData.append('trackno', trackNo);
    formData.append('transpass', $('#passwordDeny').val());
    
    if($('#passwordDeny').val() == ""){
      swal({
        title: 'Blank field detected!',
        text: 'Please fill-in Password.',
        icon: 'warning',
        buttons: false,
      })
    }else{
      waitingDialog.show('Denying Transaction. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});

      $.ajax({
        url         : actionID,
        type        : 'POST',
        data        : formData,
        processData : false,
        contentType : false,
        success     : function (data) {
          var jsonData = JSON.parse(data);
          // console.log(jsonData);
          if(jsonData.S == 1){
            swal({
              title: 'Success!',
              text: jsonData.M,
              icon: 'success',
              buttons: false,
            })

            if(userlevel == 7){ //HUB
              fetchData();
            } else {            //DEALER
              fetchDataDealer();
            }

            $('#transactionDenyModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            


          }else{
            swal({
              title: 'Transaction Failed!',
              text: jsonData.M,
              icon: 'warning',
              buttons: false,
            })
          }
          waitingDialog.hide();
        }
      });
    }
  })
</script>

<!-- SCRIPT FOR VIEW KYC USER MODAL -->
<script>
  const modal = document.querySelector(".modal2");
  const trigger = document.querySelector("#trigger");
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
