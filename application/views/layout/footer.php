
<script src="<?php echo BASE_URL()?>assets/js/kyc.js"></script> 
<script src="<?php echo BASE_URL()?>assets/js/emergencyfunds.js"></script> 

        <script src="<?php echo BASE_URL()?>assets/js/masked_input_1.4-min.js"></script>  
        <script src="<?php echo BASE_URL()?>assets/js/bootstrap-datepicker.js"></script>      
        <?php 
          if ($this->uri->segment(1) == 'hotels' && $this->uri->segment(2) == 'details') {
              echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
              echo '<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> 
<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> ';
          } else {?>
            <script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
            <script src="<?php echo BASE_URL()?>assets/js/jquery-migrate-1.2.1.min.js"></script>
            
        <?php }?>
        
        <script src="<?php echo BASE_URL()?>assets/js/jquery.datetimepicker.full.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/script/ecash_payout_scripts.js"></script>
        <script src="<?php echo BASE_URL()?>assets/script/ecash_payout_transfast.js"></script>
        <script src="<?php echo BASE_URL()?>assets/script/scriptstalagato.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/custom/federalv2/function.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/custom/quota_report/function.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/modernizr.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/pace.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/retina.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/jquery.cookies.js"></script>
    
       <script src="<?php echo BASE_URL()?>assets/js/flot/jquery.flot.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/flot/jquery.flot.resize.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/flot/jquery.flot.spline.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/jquery.sparkline.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/morris.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/raphael-2.1.0.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/bootstrap-wizard.min.js"></script>
        <!-- <script src="<?php echo BASE_URL()?>assets/js/select2.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.js" integrity="sha512-hIaMZEgNK4DTnrqBvp0sV7bUhmT8hfbhT+6RQ3YX5e3x25xaH5W1kLi4KLAy16gKiebweip2Ng1udOYHSkBMBw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

        <script src="<?php echo BASE_URL()?>assets/js/custom.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/dashboard.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
      <!--SLIDER-->
           <script type="text/javascript" src="<?php echo BASE_URL()?>assets/js/jssor.slider.min.js"></script>

             <!-- <style>
.datepicker_calendar {
    display: none;
    }
        .ui-datepicker-calendar {
        display: none;
    }

</style> -->


    <script type="text/javascript" src="<?php echo BASE_URL()?>assets/js/jquery.simple-dtpicker.js"></script> 
    <!-- use jssor.slider.debug.js instead for debug -->


    <!-- Select date range for international ticketing added by Sonmer -->
    <link rel="stylesheet" href="<?php echo BASE_URL()?>assets/abacus/css/daterangepicker.css"/>
    <script type="text/javascript" src="<?php echo BASE_URL()?>assets/abacus/js/moment.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL()?>assets/abacus/js/daterangepicker.js"></script>
    
    <script src="<?php echo BASE_URL()?>assets/js/typeahead.min.js"></script>
    

    <?php 
          if ($this->uri->segment(1) == 'hotels' && $this->uri->segment(2) == 'book_now') {?>
            <link href="<?php echo BASE_URL()?>assets/css/bootstrap-datetimepicker-v2.css" rel="stylesheet"/>
            <script src="<?php echo BASE_URL()?>assets/js/bootstrap-datetimepicker-v2.js"></script>
    <?php } else {?>
            <script src="<?php echo BASE_URL()?>assets/js/jquery-ui-1.10.3.min.js"></script>
    <?php } ?>
    
    <script src="<?php echo BASE_URL()?>assets/js/hotelNewService.js"></script> 
    
<script type="text/javascript">
  function btnUpdateAccount()
  {
  alert("Please Upgrade your Account first.");
  }
</script>




<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log("statusChangeCallback",response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
      // console.log("CONNECTED");
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      // document.getElementById('status').innerHTML = 'Please log ' +
      //   'into Facebook app.';
      // alert('Please log (not authorize)' + 'into Facebook app.');
      // console.log("NOT AUTHORIZED");
    // }else if (response.status === 'unknown') {
      
    //   console.log("TANGA");
    }
     else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      // document.getElementById('status').innerHTML = 'Please log ' +
      //   'into Facebook app.';
      // alert('Please log ' + 'into Facebook app.');
      // console.log("OTHER RESPONSE");
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {    
    console.log("Checkloginstate");
    FB.getLoginStatus(function(response) {   
      console.log("GETLOGINSTATE",response)
      statusChangeCallback(response);
    });
  }

  

  // function fbLogout() {
  //       FB.logout(function (response) {
  //         statusChangeCallback(response);
  //       });
  //   }

  // window.fbAsyncInit = function() {
  //   FB.init({
  //     appId      : '169614583386690', //nes 649055778576039  //kelly 169614583386690
  //     cookie     : true,  // enable cookies to allow the server to access 
  //                         // the session
  //     xfbml      : true,  // parse social plugins on this page
  //     version    : 'v12.0' //'v2.5' // use graph api version 2.5
  //   });


  // NEW FB INIT
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '169614583386690',
      cookie     : true,
      xfbml      : true,
      version    : 'v16.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
 
  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

    // FB.getLoginStatus(function(response) {
    //   statusChangeCallback(response);
    // });

  // FB.logout(function(response) {
  //  statusChangeCallback(response);
  // });

  

  // Load the SDK asynchronously
  // (function(d, s, id) {
  //   var js, fjs = d.getElementsByTagName(s)[0];
  //   if (d.getElementById(id)) return;
  //   js = d.createElement(s); js.id = id;
  //   js.src = "//connect.facebook.net/en_US/sdk.js";
  //   fjs.parentNode.insertBefore(js, fjs);
  // }(document, 'script', 'facebook-jssdk'));
  // (function(d, s, id) {
  //   var js, fjs = d.getElementsByTagName(s)[0];
  //   if (d.getElementById(id)) return;
  //   js = d.createElement(s); js.id = id;
  //   js.src = "https://connect.facebook.net/en_US/sdk.js";
  //   fjs.parentNode.insertBefore(js, fjs);
  // }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      // console.log(JSON.stringify(response));
      console.log('Successful login for: ' + response.name + '<br>' + response.id);
      // document.getElementById('status').innerHTML =
      //   'Thanks for logging in, ' + response.name + '<br>' + response.id + '!';
      //   alert('Thanks for logging in to Facebook, ' + response.name + '/' + response.id + '!');
        // location.href = '<?php echo BASE_URL(); ?>SocialRegistration/fbconnect/' + 'asd123qwe1' + '/' + response.name;
        location.href = '<?php echo BASE_URL(); ?>SocialRegistration/fbconnect/' + response.id;
    });
  }

//   function fbLogoutUser() {
//   FB.getLoginStatus(function(response) {
//     if (response && response.status === 'connected') {

//         FB.logout(function(response) {
//           // document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
//             document.location.reload();
//         });
//     } else if (response.status === 'not_authorized') 
//         {
//              FB.logout(function(response) {
//             // document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
//             document.location.reload();
//             });
//         }
// })
//   ;}
</script>

    <script>
        jssor_1_slider_init = function() {
            
            var jssor_1_options = {
              $AutoPlay: true,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 4,
                $SpacingX: 4,
                $SpacingY: 4,
                $Orientation: 2,
                $Align: 0
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 810);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 100);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
    </script>

    <script>
        jssor_1_slider_init();
    </script>

    <!-- MODAL -->
    <?php if ($API['S'] == 99 ): ?>
            <script>
                $(document).ready(function(){
                    $('#modverification').modal({
                            backdrop: 'static',
                            keyboard: false  // to prevent closing with Esc button (if you want this too)
                        })
                    $("#modverification").modal('show');
                });
            </script>
        <!-- Modal -->
            <div id="modverification" class="modal fade">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                  
                    <div class="modal-body">
                        
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
                                       
                                            <a href="<?php echo BASE_URL(); ?>" onclick="return fbLogoutUser();" class="btn btn-danger"><i><u><span class="glyphicon glyphicon-cancel" aria-hidden="true"></span> Dismiss</u></i></a>
                                        </div>
                                      </div>
                                  
                                  
                                  </form>
                      </div>
                  
                  
                  </div>
                  
                </div>
              </div>
              

           
    <?php endif ?>

    <script>
    $(document).ready(function(){
      $('#selBiller').change(function(){

         var com_group = $(this).children('option:selected').data('desc'); // select attribute billspayment (data-desc)
         var billernote = $(this).children('option:selected').data('type');

         var utilities_type = $(this).children('option:selected').data('type'); //select attribute billspayment (data-type)
         var billerval = $(this).children('option:selected').val();  //value of select 

          // $("#inputBillers").css('display','none');
          // $("#selSems").css('display','none');
        
          $('.bBtn').prop('disabled', false);
           $('#warn').hide();
          $('#idAcctName2').css('display','none');

          $('#divFullName').css('display','none');
          $('#divDynamicANTECOBiller25_0').css('display','none');
          $('#branch').css('display','none');
          $('#divDynamicANTECOBiller25').css('display','none');
          // $('#divDynamicANTECOBiller25_1').css('display','none');
          $('#divDynamicANTECOBiller25_2').css('display','none');
          $('#accountName2').css('display','none');
          $('#DynamicSubsName25').css('display','none');
          $('#DynamicCustName25').css('display','none');
          $('#grace').css('display','none');

          $('.maskAccountNo').hide();
          $('#dueDate').hide();
      

          //===============ADDED BY PABLO

          $('#divDynamicBillerDate25').hide();
          $('#divDynamicAPECBiller25').hide();
          
          $('#rp').hide();
          $('#formseries').hide();
          $('#formtype').hide();

          $('#taxtype').hide();
          $('#inputReturnPeriod').hide();
          $('#inputTPBC1').hide();
          $('#formseries1').hide();

          $('#paymentformseries').hide();
          $('#borrowersName').hide();
          $('#inputTPBCs').hide();
          $('#inputSubscriberName1').hide();

          $('#inputSubscriberName').hide();
          $('#inputDueDate').hide();
          $('#formtype1').hide();
          $('#taxtype1').hide();

          $('#billmonth').hide();
          $('#inputReturnPeriod_1').hide();
          $('#inputMobile').hide();
          $('#inputAmount').hide();


          $("#formtype").attr('readonly',false);
          $("#taxtype").attr('readonly',false);

          //===============ADDED BY PABLO

          $("#divDynamicADAMSONBiller25_1").css('display','none');
          // $("#divDynamicBillerDate25").css('display','none');
          $("#inputMobile1").css('display','none');
          $("#inputMobile2").css('display','none');
          $("#inputCoveredFrom").prop('required',false);
          $("#inputCoveredTo").prop('required',false);
          // $("#divDynamicBillerBIR").css('display','none');
          $("#campus").css('display','none');
          $("#idinputBranch").css('display','none');
          $("#idDueDate").css('display','none');
          $("#idCampus").css('display','none');
          $("#idloanref").css('display','none');

          $("#formseries").prop('required',false);
          $("#formtype").prop('required',false);
          $("#taxtype").prop('required',false);
          $("#inputReturnPeriod").prop('required',false);
          $("#formseries").val('');
          $("#inputCoveredFrom").val('');
          $("#inputCoveredTo").val('');
          $("#formtype").val('');
          $("#taxtype").val('');
          $("#idDueDate").val('');
          $("#idCampus").val('');
          $("#idloanref").val('');
          $("#idinputBranch").val('');
          $("#inputReturnPeriod").val('');
          $("#selSem1").val('');
          $(".inputAmountmyModal25").val('');
          // $('.inputSubscriberName').css('display','block');


          $("#larcerrormessage").hide();


          // $('.inputMobile').css('display','block');
          $(".inputSubscriberName").prop('required',true);
          $(".inputMobile").prop('required',true);
          $(".inputDueDate").prop('required',false);
          $(".inputBday").prop('required',false);
          $(".inputYearYear").prop('required',false);
          $(".APECBiller").prop('required',false);
          
          $("#selSem3").remove();
          $(".inputFNameID").remove();
          $(".inputLNameID").remove();
          $(".inputMNameID").remove();
          $(".inputBillingMonthID").remove();
          $(".inputCampusID").remove();
          $(".inputBranchID").remove();
          $("#LoanReference").remove();
          $(".inputAccountID").remove();
          $("#email").remove();

          $(".selCampusID").remove();
          $(".inputLastNameID").remove();
          $(".inputFirstNameID").remove();
          $(".selCourseID").remove();
          // $("#inputBday").remove();
          
          $(".inputMiddleNameID").remove();


          
          $('.inputGracePeriods_0').hide();
        // $('#borrowersName_1').hide();
        // $('#formseries_1').hide();
        // $('#inputTPBC_1').hide();

          // $("#selYearLevel").remove();
          // $("#selSem").remove();

          $('#divDynamicADAMSONBiller25').css('display','none');


          switch(billerval) {
              case '91':
              case '134':
              case '135':
              case '136':
              case '137':
              case '138':
              case '139':
              case '140':
              case '141':
              case '142':
              case '143':
                  var placeholder_desc = "ATM REFERENCE NUMBER";
                  break;
              case '94':
              case '107':
                  var placeholder_desc = "POLICY ACCOUNT NUMBER";
                  break;
              case '49':
              case '153':
              case '221':
              case '222':
              case '223':
                  var placeholder_desc = "POLICY NUMBER";
                  break;
              case '205':
                  var placeholder_desc = "REGCODE";
                  break;    
              case '208':
              case '215':
              case '502':
              case '514':
                  var placeholder_desc = "REFERENCE NUMBER";
                  break;
              case '59':
                  var placeholder_desc = "ACCOUNT/ CARD NUMBER (16-Digits)";
                  break;

            //Ecpay Phase 2
              case '157':
                  var placeholder_desc = "ACCOUNT NUMBER (11-Digits)";
                  break;            
              case '240':
              case '248':
              case '251':
              case '252':
              case '256':
              case '259':
              case '274':
              case '275':
                  var placeholder_desc = "ACCOUNT NUMBER (13-Digits)";
                  break; 
              case '242':
              case '250':
              case '291':
              case '292':
                  var placeholder_desc = "CONTRACT ACCOUNT NUMBER (8-Digits)";
                  break; 
              case '245':
              case '265':
              case '370':
                  var placeholder_desc = "ACCOUNT NUMBER (7-Digits)";
                  break;  
              case '246':
              case '545':
                  var placeholder_desc = "WIN ";
                  break;
              case '249':
              case '269':
                  var placeholder_desc = "CONTRACT NUMBER (9-Digits)";
                  break;
              case '247':
              case '254':
              case '255':
              case '260':
              case '261':
              case '268':
              case '271':
              case '277':
              case '278':
              case '280':
              case '281':
              case '286':
              case '296':
              case '343':
              case '359':
              case '360':
              case '368':
              case '365':
                  var placeholder_desc = "ACCOUNT NUMBER ";
                  break;
              case '253':
              case '270':
              case '284':
              case '297':
              case '342':
              case '364':
                  var placeholder_desc = "ACCOUNT NUMBER (9-Digits)";
                  break;
              case '272': 
              case '294': 
              case '321':  
                  var placeholder_desc = "ACCOUNT NUMBER";
                  break;  
              case '263':
              case '266':
                  var placeholder_desc = "CONTRACT ACCOUNT NUMBER";
                  break; 
              case '264':
              case '299':
              case '303':
              case '493':
                 var placeholder_desc = "ACCOUNT ID ";
                  break; 
              case '276':
                  var placeholder_desc = "CODE NUMBER";
                  break;      
              case '283':
              case '285':
              case '287':
              case '288':
              case '289':
              case '290':
              case '295':
              case '300':
              case '302':
                  var placeholder_desc = "2 DIGITS AREA CODE + ACCOUNT NUMBER";
                  break;    
              case '293':
              case '307':
                  var placeholder_desc = "CONSUMER CODE";
                  break; 
              case '298':
                  var placeholder_desc = "ID NUMBER";
                  break;
              case '304':
              case '326':
              case '337':
              case '338':
              case '357':
              case '339':
              case '340':
              case '341':
              case '349':
              case '352':
              case '354':
              case '355':
              case '369':
                  var placeholder_desc = "ACCOUNT NUMBER ";
                  break;  
              case '305':
                  var placeholder_desc = "AGREEMENT NUMBER ";
                  break; 
              case '306':
              case '314':
                  var placeholder_desc = "PN NUMBER (16-Digits)";
                  break; 
              case '309':
              case '310':
              case '311':
              case '345':
                  var placeholder_desc = "REFERENCE NUMBER (8-Digits)";
                  break;  
              case '313':
                  var placeholder_desc = "PN NUMBER (20-Digits)";
                  break; 
              case '316':
              case '393':
                  var placeholder_desc = "ACCOUNT ID";
                  break; 
              case '317':
              case '319':
              case '332':
              case '392':
              case '539':
              case '540':
                  var placeholder_desc = "PN NUMBER";
                  break;  
              case '318':
                  var placeholder_desc = "ACCOUNT NUMBER/ ID CODE";
                  break;  
              case '320':
                  var placeholder_desc = "PRODUCT CODE + BDAY (mmddyy)";
                  break;   
              case '322':
              case '330':
              case '173':
                  var placeholder_desc = "LOAN ID NUMBER";
                  break;  
              case '527':  
              case '528':  
                  var placeholder_desc = "PROMO CODE 1 (Ref No.)";
                  break;
              case '324':
              case '327':
              case '329':
              case '344':
              case '406':
              case '496':
              case '538':
                  var placeholder_desc = "REFERENCE NUMBER";
                  break;    
              case '325':
                  var placeholder_desc = "REFERENCE NUMBER (13-Digits)";
                  break;  
              case '333':
                  var placeholder_desc = "LOAN ACCOUNT NUMBER (15-Digits)";
                  break;   
              case '335':
              case '509':
                  var placeholder_desc = "ATM REFERENCE NUMBER (16-Digits)";
                  break;   
              case '336':
                  var placeholder_desc = "CONSUMER ID";
                  break;  
              case '346': 
                  var placeholder_desc = "ACCOUNT NUMBER (16-Digits)";
                  break; 
              case '347': 
                  var placeholder_desc = "POLICY NUMBER (8-Digits)";
                  break;   
              case '348':
                  var placeholder_desc = "AGREEMENT NUMBER";
                  break;  
              case '351':
              case '529':
                  var placeholder_desc = "STUDENT NUMBER";
                  break;   
              case '356':
                  var placeholder_desc = "MEMBER ID";
                  break;   
              case '361':
                  var placeholder_desc = "REFERENCE NUMBER (10-Digits)";
                  break;   
              case '362': 
                  var placeholder_desc = "POLICY NUMBER (10-Digits)";
                  break; 
              case '363':
                  var placeholder_desc = "LOAN ACCOUNT NUMBER";
                  break;                         
            //Ecpay Phase 2  
              case '371':
              // case '395':
              case '504':
              case '531':
              case '548':
                  var placeholder_desc = "CONTRACT NUMBER ";
                   break;  
              case '406':
                  var placeholder_desc = "ACCOUNT CODE";
                  break;  
              case '399':
              case '382': 
              case '381': 
              case '394':
              case '398':
              case '423':
              case '424':
              case '473':
              case '474':
              case '475':
              case '476':
              case '477':
              case '478':
              case '479':
              case '480':
              case '481':
              case '482':
                  var placeholder_desc = "ACCOUNT REFERENCE NUMBER";
                  break;
              case '386':
              case '420':
              case '421':
                  var placeholder_desc = "MEMBER ID NUMBER"; 
                  break; 
              case '429':
              case '430':  
              case '431':
              case '432':                            
              case '433':
              case '434':
              case '435':
              case '436':
              case '437':
              case '607':
              case '608':
                  var placeholder_desc = "CREDIT CARD NUMBER"; 
                  break; 
              case '397':
              case '544':
                  var placeholder_desc = "CONTRACT ACCOUNT NUMBER";
                  break; 
              case '390':
// Add a comment to this line
                  var placeholder_desc = "POLICY NUMBER";
                  break; 
                  case '411': 
              case '412':   
                  var placeholder_desc = "SALES ORDER NUMBER";
                  break; 
              case '456':   
                  var placeholder_desc = "STUDENT NUMBER";
                  break; 
              case '414':
                  break;
              case '415':
              case '416':
                  var placeholder_desc = "CLIENT ID";
                  break;  
              case '582':
              case '583':
                  var placeholder_desc = "MOBILE NUMBER";
                  break;  
              case '593':
                  var placeholder_desc = "PLATE NUM OR CONDUCTION STICKER";
                  break;      
              default:
                  var placeholder_desc = "ACCOUNT NUMBER";
          }
          
         var utilities1 = $('.utilities1'); 
         var utilities2 = $('.utilities2');
         var utilities3 = $('.utilities3'); 
         var utilities4 = $('.utilities4'); 
         var utilities5 = $('.utilities5');
         var utilities6 = $('.utilities6'); 
         var utilities9 = $('.utilities9'); 
         var utilities11 = $('.utilities11'); 
         var utilities13 = $('.utilities13'); 
         var utilities15 = $('.utilities15'); 
         var utilities18 = $('.utilities18'); 
         var utilities20 = $('.utilities20'); 
         var utilities21 = $('.utilities21');
         var utilities22= $('.utilities22'); 
         var utilities23 = $('.utilities23');
         var utilities24 = $('.utilities24');
         var utilities25 = $('.utilities25');
         var utilities26 = $('.utilities26');
         var utilities28 = $('.utilities28');
         var utilities30 = $('.utilities30');
         var utilities31 = $('.utilities31');
         utilities23.css('display','none');
           //display form//
         if (utilities_type == 1 || utilities_type == 8 || utilities_type == 7)
         {
           utilities1.show();
           utilities2.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities26.css('display','none');  
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');


           $("#inputBiller").remove();
           $("#divBiller1").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
            $("#inputAccountNumber").remove();
            // $("#inputMobile").remove();
            $("#inputBillerNo").remove();
            $("#DynamicBillerNumber").css('display','none');
            $("#DynamicBillerMobNo").css('display','none');
            $('#inputMobile').removeAttr('required');

            $("#inputSubscriberName").hide();
            $("#DynamicBillerMobNo").hide();
            $("#inputMobile").hide();
            $("#inputAmount").hide();
            $("#inputDueDateDisplay").hide();
            $("#inputMobileDisplay").hide();
            
            $("#divDyanamicAccountNo1").empty();
            $("#inputSubscriberName").attr("required","true");

            // 19, 59, 162, 168, 238
            switch(billerval) {
              case '8':
              case '1':
              case '14':
              case '43':
              case '217':

  

                  var placeholder_desc = "ACCOUNT NUMBER";
                  // $("#DynamicBillerMobNo").append('<input type="tel" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" maxlength="11" required />');
                  $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                     

                     $("#inputSubscriberName").show();
                     $("#inputAmount").show();

                 

                break;
              case '224':
              case '58':

                
                $("#DynamicBillerMobNo").show();
                $("#inputSubscriberName").show();
                $("#inputMobile").show();
                $("#inputAmount").show();

                $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#DynamicBillerMobNo").show();



              break;
              case '21':

                $("#inputSubscriberName").show();
                $("#DynamicBillerMobNo").show();
                $("#inputMobile").show();
                $("#inputAmount").show();

                $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                // $("#divDynamicBiller").append('<input type="text" class="form-control inputAmount"  name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />');
                  // $("#DynamicBillerMobNo").show();



              break;
              case '18':

                $("#inputSubscriberName").show();
                $("#DynamicBillerMobNo").show();
                $("#inputMobile").remove();
                $("#inputAmount").show();

                $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#DynamicBillerMobNo").show();



              break;
              case '3':

                $("#inputSubscriberName").show();
                $("#DynamicBillerMobNo").show();
                $("#inputMobile").remove();
                $("#inputAmount").show();

                $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#DynamicBillerMobNo").show();



              break;
              case '218':

                $("#inputSubscriberName").show();
                $("#DynamicBillerMobNo").show();
                $("#inputMobile").show();
                $("#inputAmount").show();

                $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#DynamicBillerMobNo").show();



              break;
              case '41':
              case '228':
              case '455':
              case '32':
              case '35':
              case '75':

                $("#inputSubscriberName").show();
                $("#DynamicBillerMobNo").show();
                $("#inputMobile").show();
                $("#inputAmount").show();

                $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#DynamicBillerMobNo").show();



              break;
              case '205':
              $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
              $("#inputAmount").show();
              $("#inputSubscriberName").remove();
              break;
              
              case '43':

  

                  var placeholder_desc = "ACCOUNT NUMBER";
                  $("#divDynamicBiller").append('<input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required/>');
                  $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                     $("#divDynamicBiller").append('<input type="text" class="form-control inputAmount"  name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />');


                 

                break;
            
              case '168':
                  var placeholder_desc = "CONTRACT NUMBER (10-Digits)";
                  $("#DynamicBillerMobNo").css('display','block');
                  $("#inputMobile").attr("required", "true");
                  // $("#DynamicBillerMobNo").append('<input type="tel" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" maxlength="11" required />');
                  $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="10" maxlength="10" required />');
                break;
              case '238':
                  var placeholder_desc = "ACCOUNT NUMBER (12-Digits)";
                  $("#DynamicBillerNumber").css('display','block');
                  $("#DynamicBillerMobNo").css('display','block');
                  $("#inputMobile").attr("required", "true");
                  $("#DynamicBillerNumber").append('<input type="text" class="form-control" name="inputBillerNo" id="inputBillerNo" placeholder="BILL NUMBER" required />');
                  // $("#DynamicBillerMobNo").append('<input type="tel" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" maxlength="11" required />');
                  $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="12" maxlength="12" required />');
                break;
              case '59':
                  $("#DynamicBillerMobNo").css('display','block');
                  $("#inputMobile").attr("required", "true");
                  // $("#DynamicBillerMobNo").append('<input type="tel" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" maxlength="11" required />');
                  $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="16" maxlength="16" required />');
                break;
              case '19':  
              case '162':  
                  var placeholder_desc = "ACCOUNT NUMBER (11-Digits)";
                  $("#DynamicBillerMobNo").css('display','block');
                  $("#inputMobile").attr("required", "true");
                  // $("#DynamicBillerMobNo").append('<input type="tel" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" maxlength="11" required />');
                  $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="11" maxlength="11" required />');
                break;
              case '804':
                var placeholder_desc = "ACCOUNT NUMBER";
                // $("#DynamicBillerMobNo").append('<input type="tel" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" maxlength="11" required />');
                $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                $("#inputMobile").show();
                $("#inputSubscriberName").attr('placeholder','CUSTOMER NAME');
                $("#inputSubscriberName").show();
                $("#inputAmount").show();
                break;
              case '822':
                $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (11 Digits Only)" required />');
                $('input[name=inputAccountNumber]').attr('pattern','[0-9]{11}');
                $("#inputSubscriberName").attr('placeholder','ACCOUNT NAME');
                $("#inputSubscriberName").show();
                $("#inputAmount").show();
                break;
              case '824':
                $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (9 Digits Only)" required />');
                $('input[name=inputAccountNumber]').attr('pattern','[0-9]{9}');
                $("#inputSubscriberName").attr('placeholder','ACCOUNT NAME');
                $("#inputSubscriberName").show();
                $("#inputMobile").attr('placeholder','AREA CODE + TELEPHONE NUMBER (10 Digits Only)');
                $("#inputMobile").attr('pattern','[0-9]{10}');
                $("#inputMobile").show();
                $("#inputAmount").show();
                break;
              case '825':
                $("#divDynamicBiller").empty();
                $("#divDynamicBiller").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />');
                $("#divDyanamicAccountNo1").append('<div class="form-group"><input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="FIRST NAME" required /></div>');
                $("#divDyanamicAccountNo1").append('<div class="form-group"><input type="text" class="form-control" name="inputMName" id="inputMName" placeholder="MIDDLE NAME" /></div>');
                $("#divDyanamicAccountNo1").append('<div class="form-group"><input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="LAST NAME" required /></div>');
                $("#inputAmount").show();
                $("#inputSubscriberName").removeAttr("required", "required");
                break;
              case '808':
                $("#divDynamicBiller").empty();
                $("#inputDueDateDisplay").show();
                $("#inputAmount").show();
                $("#inputSubscriberName").removeAttr("required", "required");
                $("#inputMobileNumber").removeAttr("required", "required");
                $("#divDynamicBiller").append('<div class="form-group"><input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="PAYMENT REFERENCE NUMBER" required /></div>');
                break;
              case '809':
                $("#divDynamicBiller").empty();
                $("#inputDueDateDisplay").show();
                $("#inputAmount").show();
                $("#inputSubscriberName").show();
                $("#inputSubscriberName").attr("placeholder", "BILLING NAME");
                $("#inputMobileNumber").removeAttr("required", "required");
                $("#divDynamicBiller").append('<div class="form-group"><input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="PAYMENT REFERENCE NUMBER" required /></div>');
                break;
              case '810':
              case '811':
                $("#divDynamicBiller").empty();
                $("#inputAmount").show();
                $("#inputMobileDisplay").show();
                $("#inputSubscriberName").removeAttr("required", "required");
                $("#inputMobileNumber").attr("placeholder", "PHONE NUMBER");
                $("#divDynamicBiller").append('<div class="form-group"><input type="text" class="form-control" name="inputAccountNumber1" id="inputAccountNumber1" placeholder="POLICY NUMBER" required /></div>');
                $("#divDynamicBiller").append('<div class="form-group"><input type="text" class="form-control" name="inputFirstName" id="inputFirstName" placeholder="FIRST NAME" required /></div>');
                $("#divDynamicBiller").append('<div class="form-group"><input type="text" class="form-control" name="inputMiddleName" id="inputMiddleName" placeholder="MIDDLE NAME" /></div>');
                $("#divDynamicBiller").append('<div class="form-group"><input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="LAST NAME" required /></div>');
                break;
              case '812':
                $("#divDynamicBiller").empty();
                $("#inputAmount").show();
                $("#inputMobileDisplay").show();
                $("#inputSubscriberName").removeAttr("required", "required");
                $("#inputMobileNumber").attr("placeholder", "CONTACT NUMBER");
                $("#divDynamicBiller").append('<div class="form-group"><input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="REFERENCE NUMBER" required /></div>');
                $("#divDynamicBiller").append('<div class="form-group"><input type="text" class="form-control" name="inputFirstName" id="inputFirstName" placeholder="FIRST NAME" required /></div>');
                $("#divDynamicBiller").append('<div class="form-group"><input type="text" class="form-control" name="inputMiddleName" id="inputMiddleName" placeholder="MIDDLE NAME" /></div>');
                $("#divDynamicBiller").append('<div class="form-group"><input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="LAST NAME" required /></div>');
                break;
              default:
               $("#divDynamicBiller").append('<input type="text" class="form-control inputNameValidator" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
            }

           $("#inputBiller").val(billerval);

         }else if (utilities_type == 25) {
           utilities25.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities26.css('display','none');  
           utilities24.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputAccountNumber").remove();
           $("#inputType").remove();
           $("#inputBillerNo").remove();

           $("#divDynamicBiller25").empty();
           $("#DynamicBillDate25").css('display','none');
           $("#DynamicPeriodFrom25").css('display','none');
           $("#DynamicPeriodTo25").css('display','none');

           $(".selectTPBC").remove();
           $(".clearFee").remove();
           
           $("#inputPayorName").remove();
           $('#divDynamicBiller25').css('display','block');
           $("#inputDueDate").css('visibility', 'hidden');
           $("#inputDueDate").attr("disabled", true);
           $("#DynamicBillerNumber25").css('display','none');
          
           $("#DynamicNumberInput25").css('display','none');
           $("#DynamicFullAcctName25").css('display','none');
           $("#DynamicCampus25").css('display','none');
           $("#DynamicDueDate25").css('display','none');
           $("#DynamicDueDate25mdy").css('display','none');
           $("#DynamicPayorName25").css('display','none');

           $("#inputBiller").remove();
           $("#divBiller25").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');

           if(billerval == "730" || billerval == "731" || billerval == "732" || billerval == "733" || billerval == "734" || billerval == "735" || billerval == "736" || billerval == "737" || billerval == "738" || billerval == "739" || billerval == "740" || billerval == "741" || billerval == "742" || billerval == "743" || billerval == "744" || billerval == "745" || billerval == "746" || billerval == "747" || billerval == "748"){

            

            $("#inputSubscriberName").show();
            

            $("#inputmaskAccountNo").remove();
            $("#inputB").remove();
            $("#selSemzz").remove();
            $("#inputGracePeriods_0").remove();
            $("#inputBillerz").remove(); 
            $('#inputMobile').show();
            $("#inputSubscriberName1").remove();
            $("#inputSubscriberName2").remove();
            $("#inputMobile2").remove();
            $("#inputMobile1").remove();
            $("#selSemzzz").remove();
            $("#selSemz").remove();
            $("#selSemz_1").remove();



           }

            switch(billerval) {
               //added by nes 07/12/2017
              case '419':
                  var placeholder_desc = "Enter 3-digit BranchCode/Updated Client ID# (ex: 493/123456 )";
                  // $("#DynamicBillerNumber25").css('display','block');
                  // $("#DynamicBillerNumber25").append('<input type="text" class="form-control" name="inputBillerNo" id="inputBillerNo" minlength="3" maxlength="3" placeholder="BRANCH CODE (3-Digits)" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control TSPIinputAccountNumber" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="10" maxlength="10" required />');
                  break; 
                  case '406':
                  var placeholder_desc = "PAYMENT REFERENCE NUMBER";
                  var placeholder_ext = " (11-Digits)";
                  // $("#DynamicBillerNumber25").css('display','block');
                  // $("#DynamicBillerNumber25").append('<input type="text" class="form-control" name="inputBillerNo" id="inputBillerNo" minlength="3" maxlength="3" placeholder="BRANCH CODE (3-Digits)" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="11" maxlength="11" required />');
                  $("#divDynamicBiller25").append('<select class="form-control" name="inputType" id="inputType"><option value="" disabled selected>CHOOSE LOAN TYPE</option><option value="Loan Payment">LOAN PAYMENT</option><option value="Premiums Payment">PREMIUMS PAYMENT</option></select>');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break;
                  case '404':
                  var placeholder_ext = " ACCOUNT NUMBER (12-13 alphanumeric code).";
                  // $("#DynamicBillerNumber25").css('display','block');
                  // $("#DynamicBillerNumber25").append('<input type="text" class="form-control" name="inputBillerNo" id="inputBillerNo" minlength="3" maxlength="3" placeholder="BRANCH CODE (3-Digits)" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="12" maxlength="13" required />');
                  $("#divDynamicBiller25").append('<select class="form-control" name="inputType" id="inputType"><option value="" disabled selected>CHOOSE PAYMENT TYPE</option><option value="fp">FICO DEPOSIT</option><option value="flp">FICO LOAN PAYMENT</option></select>');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break; 
                  case '405':
                  var placeholder_ext = " ACCOUNT NUMBER (12-13 alphanumeric code).";
                  // $("#DynamicBillerNumber25").css('display','block');
                  // $("#DynamicBillerNumber25").append('<input type="text" class="form-control" name="inputBillerNo" id="inputBillerNo" minlength="3" maxlength="3" placeholder="BRANCH CODE (3-Digits)" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="12" maxlength="13" required />');
                  $("#divDynamicBiller25").append('<select class="form-control" name="inputType" id="inputType"><option value="" disabled selected>CHOOSE PAYMENT TYPE</option><option value="fp">FICO DEPOSIT</option><option value="flp">FICO LOAN PAYMENT</option></select>');
                  break; 
                  case '418':
                  var placeholder_ext = " 8-DIGIT SAVINGS ACCOUNT NUMBER (ex. 00001234)";
                  // $("#DynamicBillerNumber25").css('display','block');
                  // $("#DynamicBillerNumber25").append('<input type="text" class="form-control" name="inputBillerNo" id="inputBillerNo" minlength="3" maxlength="3" placeholder="BRANCH CODE (3-Digits)" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="8" maxlength="8" required />');
                  $("#divDynamicBiller25").append('<select class="form-control inputBranchID inputCampusID" name="inputCampus" id="inputBranch"><option value="" disabled selected>SELECT BRANCH</option><option value="Main">MAIN</option><option value="Bansalan">BANSALAN</option><option value="Kidapawan">KIDAPAWAN</option><option value="Malita">MALITA</option><option value="Antipas">ANTIPAS</option></select>');
                  break; 
                  case '461':
                  var placeholder_ext = " TIN NUMBER (9-Digits)";
                  // $("#DynamicBillerNumber25").css('display','block');
                  // $("#DynamicBillerNumber25").append('<input type="text" class="form-control" name="inputBillerNo" id="inputBillerNo" minlength="3" maxlength="3" placeholder="BRANCH CODE (3-Digits)" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="9" maxlength="9" required />');

                  $('#inputSubscriberName1').show();

                  $('#divDynamicBillerBIR').show(); 

                  $(".delivery_date").attr('name','xx');
                  $('#inputReturnPeriod_1').show(); 
                  $('#inputTPBC1').show();
                  $('#inputReturnPeriod').show();  
                  $('#inputMobile_1').show();  
                  $('#inputMobile').show();
                  $('#divDynamicBillerBIR').css('display','block');
                  $("#formseries").prop('required',true);
                  $("#formtype").prop('required',true);
                  $("#taxtype").prop('required',true);

                  $("#formseries").show();
                  $("#formtype").show();
                  $("#taxtype").show();  

                  $("#formseries1").remove();
                  $("#paymentformseries").remove();  
                  $("#borrowersName").remove(); 
                  $("#inputTPBC_1").remove();
                  
                  


                  break; 
                  case '420':
                  case '421':
                  var placeholder_ext = " VALID MEMBER'S ID NUMBER (12 Digits)";
                  // $("#DynamicBillerNumber25").css('display','block');
                  // $("#DynamicBillerNumber25").append('<input type="text" class="form-control" name="inputBillerNo" id="inputBillerNo" minlength="3" maxlength="3" placeholder="BRANCH CODE (3-Digits)" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="12" maxlength="12" required />');
                  $('#divDynamicBillerDate25').css('display','block');
                  $("#inputCoveredFrom").prop('required',true);
                  $("#inputCoveredTo").prop('required',true);
                  break; 
              case '392':
              case '573':
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'1', 'maxlength':'5', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="5" maxlength="5" required />');
                 

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break; 
            case '672':
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'1', 'maxlength':'5', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="Student No. (4-10 Digts)" minlength="4" maxlength="10" required />');
                  $("#accountName2").show();
                  $("#divDynamicADAMSONBiller25_1").show();

                  $('#inputSubscriberName').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  //$('#accountName2').remove(); //STUDENT NAME //class-> inputSubscriberName2
                  $('#campus').remove(); //BRANCH //class-> selCampus
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate

                  $('#DynamicDueDate25mdy').remove(); //STUDENT BIRTHDAY (mm/dd/yyyy)//class-> inputBday
                  $('#divDynamicADAMSONBiller25').remove(); //School Year (yyyy-yyyy): //class-> selCampus
                  //$('#divDynamicADAMSONBiller25_1').remove(); //Campus //class-> inputCampus

                  //$('#inputMobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#inputAmount').remove(); //AMOUNT//class-> inputAmount

                
                  break; 
            case '660':
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'1', 'maxlength':'5', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="Account Number (7-11 Digits)" minlength="7" maxlength="11" required />')
                        $('#borrowersName_1').show();
                          $('#formseries_1').show();
                          $('#inputTPBC_1').show();

                          $('#divDynamicBillerDate25').remove(); //PERIOD COVERED FROM: | PERIOD COVERED TO: //class-> divDynamicBillerDate25
                  $('#divDynamicBillerBIR').remove(); //-- SELECT FORM SERIES -- //class-> divDynamicBillerBIR
                  $('#formtype').remove(); //--SELECT FORM NUMBER--//class-> formtype
                  $('#taxtype').remove(); //--SELECT TAX TYPE-- //class-> taxtype

                  $('#inputReturnPeriod').remove(); //Return Period: //class-> divDynamicBillerDate25
                  $('#inputTPBC').remove(); //ENTER TAX PAYER'S BRANCH CODE (5 digits) //class-> inputTPBC
                  //$('#formseries_1').remove(); //Payment Entries//class-> formseries
                  //$('#borrowersName_1').remove(); //BORROWERS NAME //class-> borrowersName

                  //$('#inputTPBC_1').remove(); //PAYOR NAME //class-> inputTPBCs
                  $('#inputSubscriberName').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#formseries_1').remove(); //Payment Entries//class-> formseries
                  //$('#borrowersName_1').remove(); //BORROWERS NAME //class-> borrowersName

                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#divDynamicAPECBiller25').remove(); //INVOICE NUMBER (2-30 digits) | BILL YEAR (yyyy) | BILL MONTH (MM) | DELIVERY DATE (yyyy-MM-dd) //class-> divDynamicAPECBiller25
                  //$('#inputMobile').remove(); //MOBILE NUMBER (11-Digits)//class-> inputMobile
                  //$('#inputAmount').remove(); //AMOUNT //class-> inputAmount


     
                
                  break; 
              // case '395': break;
              case '396':
              case '398':
              case '484':
              case '321':
              case '502':
              case '526':
              case '538':
              case '544':
              case '548':
              case '568':
              case '569':
              case '590':
                  var placeholder_desc = "REFERENCE NUMBER";
                  var placeholder_ext = " (8-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="8" maxlength="8" required />');

                
                  
                  $('#inputmaskAccountNo').remove(); //ACCOUNT NAME //class-> 
                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  // $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;
              case '675':


                  




                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (XXX-XX-XXX 10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputmaskAccountNo" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');

                          
                     
                  

                


                  // $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                   $('.maskAccountNo').show();




                  $(function () {

                      $('#inputAccountNumber').keydown(function (e) {
                         var key = e.charCode || e.keyCode || 0;
                         $text = $(this); 
                         if (key !== 8 && key !== 9) {
                             if ($text.val().length === 3) {
                                 $text.val($text.val() + '-');
                             }
                             if ($text.val().length === 6) {
                                 $text.val($text.val() + '-');
                             }

                         }

                         return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
                     })
                  });

                  break;

                 case '750':   
                      
                  var placeholder_desc = "ACCOUNT NUMBER";    
                  var placeholder_ext = "";   
                  // $('#divDynamicBiller25').css('display','none');    
                  // $("#DynamicNumberInput25").css('display','block');   
                   $("#DynamicDueDate25mdy").css('display','block'); 
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});   
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputmaskAccountNo" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');    
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" oncopy = "return false" onpaste="return false" onchange = "accountNumberValidator()" oncut="return false" placeholder="'+placeholder_desc+'" minlength = "10" maxlength="12" required />');    
                              
                        
                      
                    
                  // $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName   
                  $('#grace').remove(); //SELECT MONTH //class-> grace    
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1    
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2   
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22    
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz    
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz    
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11   
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1   
                  // $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz   
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1    
                  // $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate   
                  // $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate    
                   $('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile    
                   $('.maskAccountNo').detach();    
                   // $('#divDynamicANTECOBiller25').show();   
                   $('#divDynamicANTECOBiller25 .selSemz').detach();    



                        $('#inputAccountNumber').keydown(function (e) {
                           var key = e.charCode || e.keyCode || 0;
                           $text = $(this); 
                           if (key !== 8 && key !== 9) {
                               if ($text.val().length === 3) {
                                   $text.val($text.val() + '-');
                               }
                               if ($text.val().length === 6) {
                                   $text.val($text.val() + '-');
                               }
                               if ($text.val().length === 10) {
                                   $text.val($text.val() + '-');
                               }

                           }

                           return;
                       });

                      //    $('#inputAccountNumber').keypress(function (e) {
                      //       const re = /^[a-z0-9]+$/i;
		                  //       if (!re.test(e.key)) {
		                  //       	e.preventDefault();
	                    //     	}

                      //      return;
                      //  });

                     

          

                   
                  
                  break;
              case '596':
              case '597':
                   var placeholder_desc = "REFERENCE NUMBER";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="8" maxlength="8" required />');

                  $('.inputFullName').remove();
                  break;
              case '651':
                   var placeholder_desc = "ACCOUNT NUMBER (1-16 Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="1" maxlength="16" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break;
              case '485':
              case '159':
              case '491':
              case '399':
              case '298':
              case '543':
                $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" minlength="9" maxlength="9" required />');
              break;
              case '545':
                   var placeholder_ext = " (9-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="9" maxlength="9" required />');

                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
                  break;
              case '409': break;
              case '493':

                $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />');

                $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');

                   $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile


                  break;
              case '576':
              case '582':
              case '583':
              case '587':
                   var placeholder_desc = "MOBILE NUMBER";
                   var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="11" maxlength="11" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break;
              case '295':
              case '287':
              case '283':
              case '290':
              case '285':
              case '300':
              case '289':
              case '288':
              case '302':
              case '522':
                   var placeholder_ext = " (9-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="9" maxlength="9" required />');
                  break;
            case '522':
                   var placeholder_ext = " (9-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="9" maxlength="9" required />');
                  break;
              case '348':
                   var placeholder_ext = " AGREEMENT NUMBER (dash '-' included) (11-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="11" maxlength="11" required />');
                  break;
              case '325': break;
              case '517':
              case '516':

                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (13-Digits)" minlength="13" maxlength="13" required />');
                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();

              break;
              
              case '518':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (13-Digits)" minlength="13" maxlength="13" required />');
   

                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                   $('#divDynamicANTECOBiller25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();


                  break;
              case '749':   
                      
                  var placeholder_desc = "ACCOUNT NUMBER";    
                  var placeholder_ext = "";   
                  // $('#divDynamicBiller25').css('display','none');    
                  // $("#DynamicNumberInput25").css('display','block');   
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});   
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputmaskAccountNo" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');    
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="12" maxlength="12" required />');    
                              
                        
                      
                    
                  // $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName   
                  $('#grace').remove(); //SELECT MONTH //class-> grace    
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1    
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2   
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22    
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz    
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz    
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11   
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1   
                  // $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz   
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1    
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate   
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate    
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile    
                   $('.maskAccountNo').detach();    
                   $('#divDynamicANTECOBiller25').show();   
                   $('#divDynamicANTECOBiller25 .selSemz').detach();    
                  // $(function () {    
                  //     $('#inputAccountNumber').keydown(function (e) {    
                  //        var key = e.charCode || e.keyCode || 0;   
                  //        $text = $(this);    
                  //        if (key !== 8 && key !== 9) {   
                  //            if ($text.val().length === 3) {   
                  //                $text.val($text.val() + '-');   
                  //            }   
                  //            if ($text.val().length === 6) {   
                  //                $text.val($text.val() + '-');   
                  //            }   
                  //        }   
                  //        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));    
                  //    })    
                  // });    

                  $('#inputAccountNumber').keydown(function (e) {
                           var key = e.charCode || e.keyCode || 0;
                           $text = $(this); 
                           if (key !== 8 && key !== 9) {
                               if ($text.val().length === 2) {
                                   $text.val($text.val() + '-');
                               }
                               if ($text.val().length === 7) {
                                   $text.val($text.val() + '-');
                               }

                           }

                           return (key == 8 || key == 9 || key == 46 || key == 189 || (key >= 48 && key <= 57) || (key >= 37 && key <= 40) || (key >= 96 && key <= 105));
                       });
                  break;
              case '751':

                  var placeholder_desc = "ACCOUNT NUMBER";    
                  var placeholder_ext = "";   
                  // $('#divDynamicBiller25').css('display','none');    
                  // $("#DynamicNumberInput25").css('display','block');   
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});   
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputmaskAccountNo" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');    
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="11" maxlength="11"  required />');    
                              
                        
                      
                    
                  // $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName   
                  $('#grace').remove(); //SELECT MONTH //class-> grace    
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1    
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2   
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22    
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz    
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz    
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11   
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1   
                  // $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz   
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1    
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate   
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate    
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile    
                   $('.maskAccountNo').detach();    
                   // $('#divDynamicANTECOBiller25').show();   
                   $('#divDynamicANTECOBiller25 .selSemz').detach();    



                        $('#inputAccountNumber').keydown(function (e) {
                           var key = e.charCode || e.keyCode || 0;
                           $text = $(this); 
                           if (key !== 8 && key !== 9) {
                               if ($text.val().length === 2) {
                                   $text.val($text.val() + '-');
                               }
                               if ($text.val().length === 9) {
                                   $text.val($text.val() + '-');
                               }

                           }

                           return (key == 8 || key == 9 || key == 46 || key == 189 || (key >= 48 && key <= 57) || (key >= 37 && key <= 40) || (key >= 96 && key <= 105));
                       });
                   
                  // $(function () {    
                  //     $('#inputAccountNumber').keydown(function (e) {    
                  //        var key = e.charCode || e.keyCode || 0;   
                  //        $text = $(this);    
                  //        if (key !== 8 && key !== 9) {   
                  //            if ($text.val().length === 3) {   
                  //                $text.val($text.val() + '-');   
                  //            }   
                  //            if ($text.val().length === 6) {   
                  //                $text.val($text.val() + '-');   
                  //            }   
                  //        }   
                  //        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));    
                  //    })    
                  // });    
                  break;

              case '750':   
                      
                  var placeholder_desc = "ACCOUNT NUMBER";    
                  var placeholder_ext = "";   
                  // $('#divDynamicBiller25').css('display','none');    
                  // $("#DynamicNumberInput25").css('display','block');   
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});   
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputmaskAccountNo" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');    
                  $("#divDynamicBiller25").append('<input type="text" autocomplete="off" class="form-control LARC" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" maxlength="12" required />');    
                  $("#divDynamicBiller25").append('<span class="label label-danger" id="larcerrormessage"></span>');    
                              
                        
                      
                    
                  // $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName   
                  $('#grace').remove(); //SELECT MONTH //class-> grace    
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1    
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2   
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22    
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz    
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz    
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11   
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1   
                  // $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz   
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1    
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate   
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate    
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile    
                   $('.maskAccountNo').detach();    
                   // $('#divDynamicANTECOBiller25').show();   
                   $('#divDynamicANTECOBiller25 .selSemz').detach();    


                   $("#larcerrormessage").hide();
                        $('#inputAccountNumber').keydown(function (e) {
                           var key = e.charCode || e.keyCode || 0;
                           $text = $(this); 
                           if (key !== 8 && key !== 9) {
                               if ($text.val().length === 3) {
                                   $text.val($text.val() + '-');
                               }
                               if ($text.val().length === 6) {
                                   $text.val($text.val() + '-');
                               }
                               if ($text.val().length === 10) {
                                   $text.val($text.val() + '-');
                               }

                           }

                           // return (key == 8 || key == 9 || key == 46 || key == 189 || (key >= 48 && key <= 57) || (key >= 37 && key <= 40) || (key >= 96 && key <= 105));
                           return;
                       });

                       
                          $("#inputAccountNumber").focusout(function(){
                    
                            $("#inputAccountNumber").val().substring(0,10);
                            let regexp = /^(\d+-?)+\d+$/;
                            // alert("test");

                            $.ajax({
                              url: "/Bills_payment/biller_validation",
                              type: 'POST',
                              data: {accountnumber: $("#inputAccountNumber").val(), billercode: '750'},
                              success: function(data) {
                                let datum = JSON.parse(data);
                                console.log("PABLO",datum);

                                if(datum.result.E == 'A'){
                                  $("#larcerrormessage").show();
                                  $("#larcerrormessage").css("font-size","12px");
                                  // $("#larcerrormessage").css("font-size","12px").css("padding","10px");
                                  $("#larcerrormessage").html("Invalid location code"+ " - "+$("#inputAccountNumber").val());
                                  $("#inputAccountNumber").val("");
                                  return;
                                }

                                if(datum.result.E == 'B'){
                                  $("#larcerrormessage").show();
                                  $("#larcerrormessage").css("font-size","12px");
                                  // $("#larcerrormessage").css("font-size","12px").css("padding","10px");
                                  $("#larcerrormessage").html("Invalid classification code"+ " - "+$("#inputAccountNumber").val());
                                  $("#inputAccountNumber").val("");
                                  return;
                                }

                                if(datum.result.E == 'AB'){
                                  $("#larcerrormessage").show();
                                  $("#larcerrormessage").css("font-size","12px");
                                  // $("#larcerrormessage").css("font-size","12px").css("padding","10px");
                                  $("#larcerrormessage").html("Invalid location and classification code"+ " - "+$("#inputAccountNumber").val());
                                  $("#inputAccountNumber").val("");
                                  return;
                                }

                                if(datum.result.E == ''){
                                  $("#larcerrormessage").hide();
                                  return;
                                }

                                $("#larcerrormessage").hide();

                              },
                              error: function(data){
                                let datum = JSON.parse(data);
                                console.log(datum);
                              }
                            });
  
                              if (regexp.test($("#inputAccountNumber").val().substring(0,10)))
                              {
                                $(".btn_Modal25Submit").attr("disabled",false);
                              }
                              else
                              {
                                //alert("Invalid Reference Number");
                                $(".btn_Modal25Submit").attr("disabled",true);
                              }

                          });
                   
                  // $(function () {    
                  //     $('#inputAccountNumber').keydown(function (e) {    
                  //        var key = e.charCode || e.keyCode || 0;   
                  //        $text = $(this);    
                  //        if (key !== 8 && key !== 9) {   
                  //            if ($text.val().length === 3) {   
                  //                $text.val($text.val() + '-');   
                  //            }   
                  //            if ($text.val().length === 6) {   
                  //                $text.val($text.val() + '-');   
                  //            }   
                  //        }   
                  //        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));    
                  //    })    
                  // });    
                  break;
              
              case '519':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (13-Digits)" minlength="13" maxlength="13" required />');


                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
   

                  // $('.inputReturnPeriod').css('display','none');
                  break;
              
              case '521':
              case '549':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (13-Digits)" minlength="13" maxlength="13" required />');
   
                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  // $('.inputReturnPeriod').css('display','none');
                  break;
              case '563': 
                $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (13-Digits)" minlength="13" maxlength="13" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile


              break;
              case '520':
              case '564':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (13-Digits)" minlength="13" maxlength="13" required />');
   
                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
                  // $('.inputReturnPeriod').css('display','none');
                  break;
              case '579':
                   var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');
                  $("#DynamicSubsName25").show();

                   $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  //$('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  
                  break;
              case '669':
                   var placeholder_ext = " (9-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="9" maxlength="9" required />');

                  $("#divDynamicANTECOBiller25_1").show();
                  // $("#DynamicCustName25").show();
                  // $("#DynamicSubsName25").hide();
                  // $("#DynamicAcctName25").hide();

                   //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  //$('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  
                  break;
              case '486':
              case '286':
              case '282':
              case '171':
              case '301':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (9-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="9" maxlength="9" required />');

                   //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;
              case '674':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');

                   //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;
                  case '677':
                  var placeholder_desc = "PN / CASA Account Number ";
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="18" maxlength="20" required />');

                  $("#divDynamicBiller255").append('<input type="text" class="form-control" name="selSem" id="inputPayorName" placeholder="PAYOR NAME" required />');
                  
                  $('#datatype25 #inputFullName').remove(); //FULL NAME
                  // $('#datatype25 #inputSubscriberName').remove(); //ACCOUNT / SUBSCRIBER NAME
                  // $('#datatype25 #inputMobile11').remove(); //CONTACT NUMBER
                  $('#datatype25 #inputDueDate').remove(); //DUE DATE (mmddyyyy)
                  $('#datatype25 #inputMobile').remove(); //MOBILE NUMBER (11-Digits)
                  // $('#datatype25 #inputAmount').remove(); //AMOUNT



                  

                  break;



                  

                  break;
              case '671':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (6-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="6" maxlength="6" required />');
                  $("#DynamicCustName25").show();
                  $("#divDynamicANTECOBiller25_0").show();

                   $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  //$('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  //$('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile



                  

                  break;
              case '322':
              case '305':
                  var placeholder_desc = "AGREEMENT NUMBER";
                  var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');
                  break;
              case '296':
              case '523':
              case '532':
              case '533':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');

                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
                  break;
              // case '610':
              case '561':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break;
              case '665':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (13-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="13" maxlength="13" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break;
              case '562':
                  var placeholder_desc = "ACCOUNT NUMBER/ID CODE";
                  var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break;
              case '577':
                  var placeholder_desc = "ENTER ACCOUNT NUMBER";
                  var placeholder_ext = " (9-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile


                  break;
              case '578':
              case '581':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');

                   $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break;
              case '584':
                  var placeholder_desc = "CONSUMER CODE";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break;

              case '585':
              case '586':
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="REFERENCE NUMBER" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break;
              case '589':
              case '598':
              case '599':
                   var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');

                  // //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  // $('#grace').remove(); //SELECT MONTH //class-> grace
                  // $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  // $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  // $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  // $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  // $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  // $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  // $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  // $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  // $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  // $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  // $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  // //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;
              case '663':
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (9-Digits)" minlength="9" maxlength="9" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break;
                case '293':
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="REFERENCE NUMBER (8-Digits)" minlength="8" maxlength="8" required />');
                  
                                    
                  $("#inputMobile1").show();


                  //$('#DynamicAcctName25').remove();
                  $('#grace').remove(); //SELECT MONTH
                  $('#DynamicSubsName25').remove(); //SUBSCRIBERS NAME
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY)
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER
                  //$("#inputMobile1").remove(); //CONTACT NUMBER
                  $('#inputGracePeriods_0').remove(); //BILL NO.:
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY)
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY)
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy)
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy)
                  $('#inputMobile').remove(); //MOBILE NUMBER (11-Digits)

                  

                  break;
                case '496':
                case '507':
                case '531':
                case '535':
                   var placeholder_ext = " (6-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="6" maxlength="6" required />');
                  break;
              case '487':
              case '524':
              case '676':
              case '558':
                   var placeholder_ext = " (16-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');
                  
                  $('#inputmaskAccountNo').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                    // $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;
              case '397':
                  var placeholder_ext = " (8-Digits)";
                  $('#divDynamicBiller25').css('display','none');
                  $("#DynamicNumberInput25").css('display','block');
                  $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'8', 'maxlength':'8', 'placeholder':placeholder_desc+placeholder_ext});
                  break; 
              case '418':
                  var placeholder_desc = "SAVINGS ACCOUNT NUMBER";
                  var placeholder_ext = " (8-Digits)";
                  $("#DynamicBillerNumber25").css('display','block');
                  $("#DynamicBillerNumber25").append('<input type="text" class="form-control" name="inputBillerNo" id="inputBillerNo" placeholder="BRANCH" required />');
                  $("#DynamicNumberInput25").css('display','block');
                  $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'8', 'maxlength':'8', 'placeholder':placeholder_desc+placeholder_ext});

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break;
              case '416': 
              case '417':
              case '415':
              case '414':
                        $('#divFullName').show();
                        $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="CLIENT ID ENTER 8-DIGIT CLIENT ID (Ex. 87654321)" minlength="8" maxlength="8" required />');



                        //$('#divFullName').remove(); //FULL NAME //class-> inputFullName
                        $('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                        $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                        //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                        //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                        break;

              case '673':
                        $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="REFERENCE NUMBER/FRAG ID." required />');

                        $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount
                        break;
              case '666' :
                        $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />');

                        $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                        break;
              
              
                  // var placeholder_ext = " (8-Digits)";
                  // // $('#divDynamicBiller25').css('display','none');
                  // // $('#DynamicAcctName25').css('display','none');
                  // // $("#DynamicFullAcctName25").css('display','block');
                  // // $("#DynamicNumberInput25").css('display','block');
                  // // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'8', 'maxlength':'8', 'placeholder':placeholder_desc+placeholder_ext});
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="8" maxlength="8" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');

                  // break;  
              case '494':
              case '320':
                  var placeholder_ext = " (7-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $('#DynamicAcctName25').css('display','none');
                  // $("#DynamicFullAcctName25").css('display','block');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'8', 'maxlength':'8', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="7" maxlength="7" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');
                  $('.inputSubscriberName').css('display','none');
                  $(".inputSubscriberName").prop('required',false);
                  break; 
              case '381': 
                  var placeholder_ext = " (9 digits) or Landline (7 digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="7" maxlength="9" required />');
                  break;
              case '394':
                  var placeholder_ext = " (max 9-Digits)";
                  $('#divDynamicBiller25').css('display','none');
                  $("#DynamicNumberInput25").css('display','block');
                  $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'1', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  break;  
              case '399':
              case '386':
                  var placeholder_ext = " (9-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'9', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="9" maxlength="9" required />');
                  break;
              case '534':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (8-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'9', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="number" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="8" maxlength="8" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break;
              case '605':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'9', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');

                  // inputmaskAccountNo
                  $('#inputmaskAccountNo').remove();
                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break;
              case '536':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (7-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'9', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="7" maxlength="7" required />');
                  $("#inputMobile1").show();


                  

                  //$('#DynamicAcctName25').remove();
                  $('#grace').remove(); //SELECT MONTH
                  $('#DynamicSubsName25').remove(); //SUBSCRIBERS NAME
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY)
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER
                  $("#inputMobile1").remove(); //CONTACT NUMBER
                  $('#inputGracePeriods_0').remove(); //BILL NO.:
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY)
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY)
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy)
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy)
                  $('#inputMobile').remove(); //MOBILE NUMBER (11-Digits)



                  

                  



                  

                  break;  
              case '652':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'9', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');

                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
              break;
              case '565':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (7-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'9', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="7" maxlength="7" required />');

                                    $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
                  break;
              case '570':
                  var placeholder_desc = "CODE NUMBER";
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'9', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;
                // case '624':
                //   $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />');

                 
                //   $("#divDynamicBiller25").append('<input type="number" class="form-control inputAmount" name="inputAmount" id="inputAmount" step=".01" placeholder="AMOUNT" required />');

                //   break;
              case '574':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

              break
              case '592':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'9', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break;
              case '594':
                  var placeholder_ext = " (7-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'9', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="7" maxlength="7" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount
                  break;  
              case '506':
              case '560':
                  var placeholder_ext = " (7-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'9', 'maxlength':'9', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="7" maxlength="7" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter Billmonth + Subscriber Name" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;   
              case '382':
                  var placeholder_ext = "Account No. (8 or 10 digits) or Mobile No. (11 digits)";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="8" maxlength="11" required />');
                  break; 
              
              case '426': 
              case '541': 
                  var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter 2 Digit Area Code + Telephone Number" minlength="1" maxlength="30" required />');
                  break;
              case '423': 
                  var placeholder_ext = " (9-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="9" maxlength="9" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter 2 Digit Area Code + Telephone Number" minlength="1" maxlength="30" required />');
                  break;
              case '650': 
                  var placeholder_ext = " (11-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="6" maxlength="11" required />');
                                      
                  // $('#inputBillers').css('display','block');
                  // $('#selSems').css('display','block');

                  $('#divDynamicANTECOBiller25').css('display','block');   

                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                  // $('#inputBillerz').remove();
                  $('#inputmaskAccountNo').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  // $('#divDynamicANTECOBiller25').remove();
                 // $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  //$("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter 2 Digit Area Code + Telephone Number" minlength="1" maxlength="30" required />');
                  break;
                  // case '597': 

                  // $('.inputFullName').remove();
                  // // var placeholder_ext = " (11-Digits)";
                  // // // $('#divDynamicBiller25').css('display','none');
                  // // // $("#DynamicNumberInput25").css('display','block');
                  // // // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  // // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="6" maxlength="11" required />');
                                      
                  // // // $('#inputBillers').css('display','block');
                  // // // $('#selSems').css('display','block');

                  // // $('#divDynamicANTECOBiller25').css('display','block');                  

                  // // //$("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter 2 Digit Area Code + Telephone Number" minlength="1" maxlength="30" required />');
                  // break;
              case '424': 
                  var placeholder_ext = " (1-16 Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="1" maxlength="16" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter 2 Digit Area Code + Telephone Number" minlength="1" maxlength="30" required />');
                  break;  
              case '427': 
                  var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter 11 Digit Mobile No or Service Reference No" minlength="11" maxlength="16" required />');
                  $('.inputMobile').css('display','none');
                  $(".inputMobile").prop('required',false);
                  $("#inputSubscriberName").show();
                  break; 
              // case '337': 
              case '358': 
              case '304': 
              case '369': 
              case '175': 
              case '357': 
              case '340': 
              case '338': 
              case '352': 
              case '499':
                  var placeholder_desc = "10 DIGITS SALES ORDER NUMBER";
                  var placeholder_ext = " (Ex. 9876543210)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');
                  // $("#divAcctName").css('display','none');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  $('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break;  
              case '501': 
              
                  var placeholder_ext = " (12-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="12" maxlength="12" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter ATM Reference Number" minlength="1" maxlength="30" required />');
                  break; 
              case '337': 
                  var placeholder_ext = " (10 or 14 digits)";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="14" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter ATM Reference Number" minlength="1" maxlength="30" required />');

                   //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break; 
              case '602': 
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="number" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="8" maxlength="8" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break; 
              case '664': 
              var placeholder_desc = "ACCOUNT NUMBER";
              var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');
                  $("#divDynamicANTECOBiller25_0").show();

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  //$('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                 
                  break; 
              case '527': 
              case '528': 
                  var placeholder_ext = " (12-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="12" maxlength="12" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="PROMO CODE 2 (Ref No.)" minlength="1" maxlength="30" required />');
                  break; 
              case '529': 
                  var placeholder_ext = " (16-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="16" maxlength="16" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="SCHOOL NAME" minlength="1" maxlength="30" required />');
                  break; 
              case '503': 
                  var placeholder_ext = " (8-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="8" maxlength="8" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="ACCOUNT PHONE NUMBER" minlength="1" maxlength="30" required />');

                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAmount"  name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />');
                  break; 
              case '498': 
                  var placeholder_desc = " ACCOUNT REF. NO. (8 or 10 digits) OR MOBILE NO. (11 digits)";
                  var placeholder_ext = " (8-12 Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="8" maxlength="12" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter ATM Reference Number" minlength="1" maxlength="30" required />');
                  break; 
              case '489': 
              case '525': 
                  var placeholder_ext = " (12-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="12" maxlength="12" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter Billing Number" minlength="1" maxlength="30" required />');
                  break; 
              case '356': 
                  var placeholder_ext = " (18-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="18" maxlength="18" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="CASE NUMBER (16-Digits)" minlength="16" maxlength="16" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount
                  break; 
              case '654': 
                  var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');
                                    $('#divDynamicANTECOBiller25').css('display','block'); 

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  //$('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break; 
              case '595': 
                  var placeholder_ext = " (18-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="18" maxlength="18" required />');
                  break; 
              case '413':
                  var placeholder_desc = "10-DIGIT SALES ORDER NUMBER (Ex. 9876543210)";

                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="10" maxlength="10" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');
                  
                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount
                  break; 
              case '412': 
                  var placeholder_ext = " (10-Digits)";
                  $('#DynamicAcctName25').css('display','none');
                  $("#DynamicFullAcctName25").css('display','block');
                  $("#DynamicNumberInput25").css('display','block');
                  $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'10', 'maxlength':'10', 'placeholder':placeholder_desc+placeholder_ext});
                  break;
              case '390':
              case '407':
              case '326':
              case '510':
              case '511':
              case '512':
              case '514':
                  var placeholder_ext = " (12-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'12', 'maxlength':'12', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="12" maxlength="12" required />');
                  break; 
              case '420':
              case '421':
                  var placeholder_ext = " (12-Digits)";
                  $('#divDynamicBiller25').css('display','none');
                  $("#DynamicNumberInput25").css('display','block');
                  $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'12', 'maxlength':'12', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#DynamicDueDate25").css('display','block');
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").removeAttr("disabled", "disabled");
                  $("#inputDueDate").attr("readonly", true);
                  $('#DynamicDueDate25 input[type="text"]').attr('placeholder','PERIOD COVERED (mmddyyyy)');
                  break; 
              case '428':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#divDynamicBiller25").append('<input type="email" class="form-control" name="email" id="email" placeholder="EMAIL ADDRESS" required />');
                  break;
              case '434':
              // case '492':
              case '540':
              case '566':
                  var placeholder_desc = "PN";
                  var placeholder_ext = " (14 Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'14', 'maxlength':'14', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="14" maxlength="14" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount
                  break; 
              case '492':
                  var placeholder_desc = "REFERENCE NUMBER";
                  var placeholder_ext = "";
                  // var placeholder_ext = " (14 Digits)";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount
                  break; 
              case '456':
              case '547':
              case '591':
              case '600':
                  var placeholder_desc = "LOAN NUMBER";
                  var placeholder_ext = " (15-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="15" maxlength="15" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT NAME / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break; 
              case '410':
                  var placeholder_ext = " (15-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="15" maxlength="15" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="Enter Account Name + Contact No." minlength="1" maxlength="30" required />');
                  $('.inputSubscriberName').css('display','none');
                  $(".inputSubscriberName").prop('required',false);
                  break; 
              case '470':
                  var placeholder_ext = "Branch Code-Center Number-Group Number. (ex. RCP-01-1 please include dash)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="1" maxlength="15" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');
                  $('.inputSubscriberName').css('display','none');
                  $(".inputSubscriberName").remove();
                  $(".inputFullName").remove();


                  
                  break; 

              case '471':
                  var placeholder_ext = "EXPONENT KONKA BRANCH NAME";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="1" maxlength="30" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break; 
              case '472':
                  var placeholder_ext = "ORDER REFERENCE NUMBER (ex. 08122014-001)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountNumberPower" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="12" maxlength="12" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputCampusID" name="inputCampus" id="inputCampus" placeholder="Enter 3-digit TSPI Branch Code (ex. 493) or 0 if non-TSPI member" minlength="0" maxlength="3" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount
                  break; 
              case '483':
                  var placeholder_ext = "Enter the 11-digit mobile number that you are paying for. (Ex. 09171234567)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="11" maxlength="11" required />');
                  $('.inputMobile').css('display','none');
                  $(".inputMobile").prop('required',false);
                  break; 
                case '422':
                  var placeholder_ext = " ACCOUNT NUMBER (11-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountNumberPower" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="11" maxlength="11" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputCampusID" name="inputCampus" id="inputCampus" placeholder="LOAN CODE" minlength="1" maxlength="20" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="LoanReference" id="LoanReference" placeholder="LOAN REFERENCE" minlength="1" maxlength="30" required />');
                  break; 
                case '303':
                case '393':
                  var placeholder_ext = " ACCOUNT ID (11-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountNumberPower" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="11" maxlength="11" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break; 
              case '488':
                    var placeholder_desc = "ACCOUNT NUMBER";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="9" maxlength="9" required />');
                  $('#inputSubscriberName').show();
                  $('#inputMobile').show();

 



              break;
              case '465':
              case '467':
              case '455':
              
              case '504':
              case '173':
              case '515':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="9" maxlength="9" required />');

 


                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  //$('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile


                  break;  
                  case '610':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = "";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'"required />');

                  $('#inputmaskAccountNo').remove();
                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();
                  $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();
                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
                  $('#inputmaskAccountNo').remove();
                  break;
              case '530':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " ";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break;  
              case '662':
                  var placeholder_desc = "REFERENCE NUMBER";
                  var placeholder_ext = " (8-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="8" maxlength="8" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputMNameID" name="inputMName" id="inputMName" placeholder="MIDDLE INITIAL" required />');

                  $("#divDynamicANTECOBiller25_2").show();
                  $("#inputMobile1").show();


                  $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  //$('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  //$("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  $('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  
                  break;   
              case '537':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break;    
              case '542':
                  var placeholder_desc = "CONTRACT NUMBER";
                  var placeholder_ext = " (9-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="9" maxlength="9" required />');


                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
                  break;      
              case '411':
              case '572':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = " (10-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');

                   //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break; 
              case '603':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break; 
              case '668':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');
                  $("#divDynamicANTECOBiller25_0").show();

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  //$('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;                   
              case '429':
              case '308':
              case '505':
              case '508':
              case '513':
              case '539':
              case '550':
              case '571':
              case '601':
                  var placeholder_desc = "ATM ACCOUNT NUMBER";
                  var placeholder_ext = " (16-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="16" maxlength="16" required />');


                  break;
              case '661':
                  var placeholder_desc = "CONTRACT NUMBER";
                  var placeholder_ext = " (9-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="9" maxlength="9" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  break;
              case '667':

                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />');
                  $(".inputGracePeriods_0").show();
                  $("#divDynamicANTECOBiller25").show();

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  //$('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  //$('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;
              case '609':
                  var placeholder_ext = " (16-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'15', 'maxlength':'15', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="16" maxlength="16" required />');
                  break;
              case '429':
              case '430':
              case '431':
              case '432':
              
              case '466':
              case '435':
              case '436':
               break;
               case '437':
              case '433':
              case '646':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount



              break;
              case '459':
              // case '460':
              case '607':
              case '608':
                  var placeholder_ext = " (16-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'16', 'maxlength':'16', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="16" maxlength="16" required />');
                  break; 
              case '384':
                  var placeholder_desc = "REFERENCE NUMBER";
                  var placeholder_ext = " (20-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'20', 'maxlength':'20', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="20" maxlength="20" required />');
                  break;
              case '329':
              case '546':
                  var placeholder_desc = "REFERENCE NUMBER";
                  var placeholder_ext = " (4-20 Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'20', 'maxlength':'20', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="4" maxlength="20" required />');
                  break;
              case '567':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'20', 'maxlength':'20', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');


                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
                  break;              
              case '580':
                  var placeholder_ext = " (20-Digits)";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'20', 'maxlength':'20', 'placeholder':placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="20" maxlength="20" required />');
                  break;
              case '383':
              case '385':
              case '387':
              case '389':
              case '388':
              case '391':
              case '400':
              case '401':
              case '402':
              case '403':
              case '408':
              case '444':
              case '445':
              case '453':
              case '462':
              case '463':
              case '446':
              case '457':
              case '464':
              case '447':
              case '448':
              case '449':
              case '458':
              case '438':
              case '450':
              case '451':
              case '454':
              case '468':
              case '425':
              case '469':
              case '473':
              case '474':
              case '475':
              case '476':
              case '477':
              case '478':
              case '479':
              case '480':
              case '481':
              case '482':
              case '588':
              case '593':
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'1', 'maxlength':'30', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" required />');

                  $('#divFullName').remove(); //FULL NAME //class-> inputFullName
                  //$('#divAcctName').remove(); //ACCOUNT / SUBSCRIBER NAME //class-> inputSubscriberName
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#iamount').remove(); //AMOUNT (11-Digits) //class-> inputAmount

                  break; 
              case '405':
                  var placeholder_ext = " (12-13 ALPHANUMERIC CODE)";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="12" maxlength="13" required />');
                  break;  
              case '395':
                  var placeholder_desc = "ACCOUNT NUMBER ";
                  // var placeholder_ext = " (9-13 ALPHANUMERIC CODE)";
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="9" maxlength="13" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');

                  $('#inputmaskAccountNo').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  // $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  // $('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile




                  break;    
              // added by nes 07/12/2017 end
              case '157': // edited by sonmer 07-03-2018
                  $("#DynamicPayorName25").css('display','block');

                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="11" maxlength="11" required />');
                  $("#DynamicPayorName25").append('<input type="text" class="form-control" name="selSem" id="inputPayorName" placeholder="PAYOR NAME" required />');

                  // $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile


                break;

              case '264':
              case '282':
              case '299':
                $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />');

                $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');

                   $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile



              break;
              case '303':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="11" maxlength="11" required />');
                break;
              case '240':
              case '248':
              case '251':
              case '252':
              case '256':
              case '259':
              case '274':
              case '275':
              case '325':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="13" maxlength="13" required />');
                break; 
              case '242':
              case '250':
              case '272':
              case '291':
              case '292': break;
              case '294':  
                $("#divDynamicBiller25").append('<input type="number" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (8-Digits)" minlength="8" maxlength="8" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                break;
                case '639':  
                $("#divDynamicBiller25").append('<input type="number" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />');
                $("#divDynamicBiller25").append('<input type="tel" class="form-control" name="selSem3" id="selSem3" placeholder="Enter Service Reference Number (10-Digits)" minlength="10" maxlength="10" required />');

                //

             
                break;
              case '309':
              case '310':
              case '311':
              case '321': 
              case '345':
              case '347': 
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="8" maxlength="8" required />');
                break; 
              case '245':
              case '265':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="7" maxlength="7" required />');
                break;  
              case '246':
              case '249':
              case '253':
              case '269':
              case '270':
              case '284':
              case '297':
              case '342':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="9" maxlength="9" required />');
                break;  
              case '247':
              case '254':
              case '255':
              case '260':
              var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'1', 'maxlength':'30', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (10-Digits)" minlength="10" maxlength="10" required />');
                  // $("#divDynamicANTECOBiller25_0").show();

                   //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  // $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  $('#inputmaskAccountNo').remove();



                  break; 
              case '261':
              case '268':
              case '271':
              case '277':
                  var placeholder_ext = "";
                  // $('#divDynamicBiller25').css('display','none');
                  // $("#DynamicNumberInput25").css('display','block');
                  // $('#DynamicNumberInput25 input[type="text"]').attr({ 'name':'inputAccountNumber', 'minlength':'1', 'maxlength':'30', 'placeholder': placeholder_desc+placeholder_ext});
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (10-Digits)" minlength="10" maxlength="10" required />');
                  // $("#divDynamicANTECOBiller25_0").show();

                   //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile


                  break; 
              case '278':
              case '280':
              case '281':
              case '286':
              case '296':
              case '359':
              case '360':
              case '361':
              case '362':
              case '371':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="10" maxlength="10" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                break;  
              case '326':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="12" maxlength="12" required />');
                break;               
              case '338':
              case '339':
              case '340':
              case '341':
              case '349':
              case '352':
              case '355':
              case '369':
                  $("#DynamicBillerNumber25").css('display','block');
                  $("#DynamicBillerNumber25").append('<input type="text" class="form-control inputBillerNo" name="inputBillerNo" id="inputBillerNo" placeholder="ATM REFERENCE No." required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="12" maxlength="12" required />');
                break; 
              case '335':
              case '509':

                  
                  // $("#inputDueDate").attr("disabled", false);
                  // $("#DynamicDueDate25").append('<input type="text" class="form-control datetimepicker" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mmddyyyy)" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="16" maxlength="16" required />');

                  $('#DynamicDueDate25mdy').show();

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile



                break; 
              case '306':
              case '314':
              case '346':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="16" maxlength="16" required />');
                break; 
              case '313':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="20" maxlength="20" required />');
                break; 
              case '333':
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="15" maxlength="15" required />');
                break;   
              case '653':
                  var placeholder_ext = " (10 Digits)";
                  // $("#DynamicBillerNumber25").css('display','block');
                  // $("#DynamicBillerNumber25").append('<input type="text" class="form-control inputBillerNo" name="inputBillerNo" id="inputBillerNo" placeholder="BILL NUMBER" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="10" maxlength="10" required />');

                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
                break;    
              case '655':
                  var placeholder_desc = "SUBSCRIBER CODE";
                  var placeholder_ext = " (9 Digits)";
                  // $("#DynamicBillerNumber25").css('display','block');
                  // $("#DynamicBillerNumber25").append('<input type="text" class="form-control inputBillerNo" name="inputBillerNo" id="inputBillerNo" placeholder="BILL NUMBER" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+placeholder_ext+'" minlength="9" maxlength="9" required />');

                  $('.inputSubscriberName1').remove();
                  $('.inputSubscriberName2').remove();
                  $('.inputMobile22').remove();
                  $('.inputMobile11').remove();
                  $('#grace').remove();

                   $('#inputBillerz').remove();
                  $('#inputBillerz_1').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputGracePeriods_1').remove();

                  $('#divDynamicANTECOBiller25').remove();
                  $('#DynamicPayorName25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();

                break;             
              case '336':
                  var placeholder_ext = " (10 Digits)";
                  // $("#DynamicBillerNumber25").css('display','block');
                  // $("#DynamicBillerNumber25").append('<input type="text" class="form-control inputBillerNo" name="inputBillerNo" id="inputBillerNo" placeholder="BILL NUMBER" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');

                      $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="CONSUMER ID (10-Digits)" minlength="10" maxlength="10" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountID" name="inputAccount" id="inputAccount" placeholder="BILL NUMBER (10-Digits)" minlength="10" maxlength="10" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                break;  
              case '657':            


                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountNumber" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (9-Digits)" minlength="9" maxlength="9" required />');
                    $("#divDynamicANTECOBiller25_0").show();

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  //$('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile


                break; 

              case '658':            


                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountNumber" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (12-Digits)" minlength="12" maxlength="12" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                break; 

              case '656':            


                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountNumber" name="inputAccountNumber" id="inputAccountNumber" placeholder="STUDENT NUMBER (8-10-Digits)" minlength="8" maxlength="10" required />');

                  // $("#divDynamicBiller25").append('<input type="text" class="form-control selCampus" name="selCampus" id="selCampus" placeholder="BRANCH" required />');


                  $('#accountName2').css('display','block');
                  $('#campus').show();


                  $('#inputSubscriberName').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  //$('#accountName2').remove(); //STUDENT NAME //class-> inputSubscriberName2
                  //$('#campus').remove(); //BRANCH //class-> selCampus
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate

                  $('#DynamicDueDate25mdy').remove(); //STUDENT BIRTHDAY (mm/dd/yyyy)//class-> inputBday
                  $('#divDynamicADAMSONBiller25').remove(); //School Year (yyyy-yyyy): //class-> selCampus
                  $('#divDynamicADAMSONBiller25_1').remove(); //Campus //class-> inputCampus

                  //$('#inputMobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#inputAmount').remove(); //AMOUNT//class-> inputAmount




                  
                  

                break; 

                case '659':            


                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputAccountNumber" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER (10-Digits)" minlength="10" maxlength="10" required />');
                                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');

                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');

                                    // $("#DynamicAcctName25").css('display','none');
                                    $("#divDynamicANTECOBiller25").css('display','block');
                  // DynamicAcctName25
                  // divDynamicANTECOBiller25

                  $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  //$('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                break;


              case '343':
              case '368':
              case '365':
                  $("#DynamicBillerNumber25").css('display','block');
                  $("#DynamicBillerNumber25").append('<input type="text" class="form-control inputBillerNo" name="inputBillerNo" id="inputBillerNo" placeholder="2 DIGITS AREA CODE + TELEPHONE NUMBER" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="10" maxlength="10" required />');
                break;  
               
              case '351':
                  $("#DynamicCampus25").css('display','block');
                  $("#DynamicCampus25").append('<input type="text" class="form-control inputCampusID inputCampus" name="inputCampus" id="inputCampus" placeholder="SCHOOL NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
                break;  
              case '354':
                  $("#DynamicBillerNumber25").css('display','block');
                  $("#DynamicBillerNumber25").append('<input type="text" class="form-control inputBillerNo" name="inputBillerNo" id="inputBillerNo" placeholder="BILL NUMBER" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="12" maxlength="12" required />');
                break; 
              // case '356':
              //     $("#DynamicBillerNumber25").css('display','block');
              //     $("#DynamicBillerNumber25").append('<input type="text" class="form-control inputBillerNo" name="inputBillerNo" id="inputBillerNo" placeholder="CASE NUMBER" required />');
              //     $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
              //   break;  
              case '353':
              case '350':
                  $("#divDynamicBiller25").append('');
                  // $("#divAcctName").html('<input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName" placeholder="RIDER NAME" required/>');
                break; 
              // case '370':
              //     $("#DynamicBillerNumber25").css('display','block');
              //     $("#DynamicBillerNumber25").append('<input type="text" class="form-control inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName" placeholder="BILL MONTH + ACCOUNT NAME" required/>');
              //     $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="7" maxlength="7" required />');
              //   break;  
              case '364':
                  $("#DynamicBillerNumber25").css('display','block');
                  $("#DynamicBillerNumber25").append('<input type="text" class="form-control inputBillerNo" name="inputBillerNo" id="inputBillerNo" placeholder="2 DIGITS AREA CODE + TELEPHONE NUMBER" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="9" maxlength="9" required />');
                break;  
              case '637':
                  var placeholder_ext = "ACCOUNT NUMBER (8-17 digits)";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="8" maxlength="17" required />');
                  $("#divDynamicBiller25").append('<select class="form-control inputBranchID inputCampusID" name="inputCampus" id="inputBranch"><option value="" disabled selected>SELECT BRANCH</option><option value="Alaminos">Alaminos</option><option value="Baliuag">Baliuag</option><option value="Boracay">Boracay</option><option value="Catarman">Catarman</option><option value="Masbate">Masbate</option><option value="San Francisco">San Francisco</option><option value="San Jose, Mindoro">San Jose, Mindoro</option><option value="San Jose, Nueva Ecija">San Jose, Nueva Ecija</option><option value="Tagum">Tagum</option></select>');
                  break;  
              case '636':
                  var placeholder_ext = "ACCOUNT NUMBER (8-10 digits)";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="8" maxlength="10" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputBillingMonthID inputBillingMonth" name="inputBillingMonth" id="inputBillingMonth" placeholder="BILL INVOICE NUMBER (2-10 digits)" minlength="2" maxlength="10" required />');


                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputMNameID" name="inputMName" id="inputMName" placeholder="MIDDLE INITIAL" required />');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control datetimepicker" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mm/dd/yyyy)" required />');
                  $("#DynamicDueDate25mdy").show();

                  

                   $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  //$('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;  
              case '635':
                  var placeholder_ext = "ACCOUNT NUMBER";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" required />');
                  $("#divDynamicBiller25").append('<select class="form-control selectTPBC" name="inputTPBC" id="inputTPBC"><option value="" disabled selected>SELECT VIOLATION</option><option value="060">ALLOWING ANOTHER PERSON TO USE DRIVERS LICENSE</option><option value="114">ALLOWING ANOTHER TO USE COMML/BUSS. NAME</option><option value="061">ALLOWING IMPROPERLY LIC/UNLIC PERSON TO DRIVE</option><option value="046">ALLOWING PASSENGER ON TOP OF VEHICLE</option><option value="048">**ARROGANCE/DISCOURTESY (w/ seminar if accompanied by Spot Report)</option><option value="140">BAN ON RIGHT-HAND DRIVE MV</option><option value="074">BREACH OF FRANCHISE CONDITIONS</option><option value="149">BROKEN SEALING WIRE</option><option value="145">BROKEN TAXIMETER SEAL</option><option value="010">BUS/PUJ LANE ORDINANCE</option><option value="010P">BUS/PUJ Lane Ordinance along Commonwealth(All Veh.) Physical App. MMDA Reg. No. 11-001 Series of 2011 (February 18, 2011)</option><option value="100">CARRYING RED LIGHTS INFRONT OF MV</option><option value="135">COLORED/TINTED/PAINTED WINSHIELD/WIND GLASS</option><option value="015B">COLORUM OPERATION (CARGO VEHICLE)</option><option value="B015B">COLORUM OPERATION (CARGO VEHICLE)</option><option value="015A">COLORUM OPERATION (PASSENGER) - MMDA Reg. No. 97 - 004</option><option value="A015">COLORUM OPERATION (PASSENGER) - MMDA Reg. No. 97 - 004</option><option value="016">CR/OR NOT CARRIED (excempted for seminar DOTC MEMO ORDER # 90-379 6/4/1990)</option><option value="030">CUTTING AN OVERTAKEN VEHICLE</option><option value="097">DEFECTIVE BRAKES</option><option value="116">DEFECTIVE EQUIPMENT</option><option value="118">DEFECTIVE/BROKEN WINDSHIELD</option><option value="A017">DELINQUENT/INVALID REGISTRATION (excempted for seminar DOTC MEMO ORDER # 90-379 6/4/1990)</option><option value="017A">DELINQUENT/INVALID REGISTRATION (excempted for seminar DOTC MEMO ORDER # 90-379 6/4/1990)</option><option value="200">DETACHED/IMPROPER/TEMPORARY SIGNBOARD</option><option value="133">DIM-COLORED LIGHTS (FOR HIRE)</option><option value="E">Education</option></select>');
                  $("#divDynamicBiller25").append('<select class="form-control clearFee" name="formseries" id="formseries"><option value="" disabled selected>SELECT CLEARANCE FEE</option><option value="0">for 30 pesos additional fee</option><option value="1">no clearance fee</option></select>');
                  break; 
              case '632':
              case '616':
                  var placeholder_ext = "ACCOUNT NUMBER (11 digits)";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="11" maxlength="11" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputLNameID" name="inputLName" id="inputLName" placeholder="LAST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFNameID" name="inputFName" id="inputFName" placeholder="FIRST NAME" required />');

                  $('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;  
             
              // case '617':

              // $("#divDynamicBiller25").append("<input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required/>");


              // break;
              case '649':
                  var placeholder_ext = "ACCOUNT NUMBER";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" required />');

                  //$('#DynamicAcctName25').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#grace').remove(); //SELECT MONTH //class-> grace
                  $('#DynamicSubsName25').remove(); //SUBSCRIBER NAME //class-> inputSubscriberName1
                  $('#DynamicCustName25').remove(); //CUSTOMERS NAME //class-> inputSubscriberName2
                  $('#inputMobile2').remove(); //SUBSCRIBER NUMBER //class-> inputMobile22
                  $('#divDynamicANTECOBiller25_0').remove(); //DUE DATE: (MM/DD/YYYY) //class-> selSemzz
                  $('#divDynamicANTECOBiller25_2').remove(); // METER NUMBER //class-> selSemzzz
                  $("#inputMobile1").remove(); //CONTACT NUMBER //class-> inputMobile11
                  $('#inputGracePeriods_0').remove(); //BILL NO.: //class-> inputGracePeriods_1
                  $('#divDynamicANTECOBiller25').remove(); //DUE DATE: (MM/DD/YYYY) and BILL MONTH: (MM/YYYY) //class-> selSemz | inputBillerz
                  $('#divDynamicANTECOBiller25_1').remove(); //DUE DATE: (MM/DD/YYYY) and BEFORE DUE: (MM/YYYY) //class-> selSemz_1 | inputBillerz_1
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate
                  $('#DynamicDueDate25mdy').remove(); //DUE DATE (mm/dd/yyyy) //class-> inputDueDate
                  //$('#mobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile

                  break;  
              case '614':
                  var placeholder_ext = "ACCOUNT NUMBER";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumberx" placeholder="'+placeholder_ext+'" required />');
                  $("#divDynamicBiller25").append('<select class="form-control selCampusID" name="selCampus" id="selCampusx"><option value="" disabled selected>SELECT BRANCH</option><option value="B03">Aguinaldo Dasmariñas</option><option value="A07">C. Raymundo</option><option value="B10">Calumpang, Marikina</option><option value="C02">Concepcion Dos, Marikina</option><option value="A08">Concepcion Uno, Marikina</option><option value="B08">Dolores, Taytay</option><option value="A02">Doña Juana, Holy Spirit</option><option value="A00">EAC</option><option value="B11">España</option><option value="B05">G. Tuazon, Sampaloc</option><option value="A09">Grace Park West</option><option value="A03">Holy Spirit</option><option value="B12">JRU Lipa</option><option value="C01">Las Piñas</option><option value="A06">Mercedes</option><option value="C03">New Manila</option><option value="A04">North Fairview</option><option value="B09">Ortigas Ext., Cainta</option><option value="B01">Poblacion Muntinlupa</option><option value="B06">Roxas Blvd, Pasay</option><option value="A11">Sampaloc</option><option value="B04">San Nicolas, Bacoor</option><option value="B07">Silangan, Pateros</option><option value="B02">Sta. Rita, Sucat</option><option value="A05">Sto. Domingo</option><option value="A10">Tondo</option><option value="A01">V. Luna</option><option value="OTH">Others</option></select>');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputLastNameID" name="inputLastName" id="inputLastName" placeholder="LAST NAME" required />');
                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFirstNameID" name="inputFirstName" id="inputFirstName" placeholder="FIRST NAME" required />');
                  $("#divDynamicBiller25").append('<select class="form-control selCourseID" name="selCourse" id="selCourse"><option value="" disabled selected>SELECT PAYMENT TYPE</option><option value="AF">Admission Fee</option><option value="TF">Tuition Fee</option><option value="PEN">Penalties</option><option value="MISC">Miscellaneous</option><option value="Others">OTH</option></select>');
                  // $("#DynamicDueDate25mdy").css('display','block');
                  // $('.inputSubscriberName').css('display','none');
                  // $(".inputSubscriberName").prop('required',false);
                  $('#DynamicDueDate25mdy').show();
                  $('#inputSubscriberName').remove();
                  $('#inputSubscriberName2').remove();
                  $('#selCampuss').remove();
                  $('#inputDueDate').remove();
                  $('#divDynamicADAMSONBiller25').remove();
                  $('#divDynamicADAMSONBiller25_1').remove();
                  break;  
              case '613':
                  var placeholder_ext = "ACCOUNT NUMBER (9-20 digits)";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="9" maxlength="20" required />');
                  $("#divDynamicBiller25").append('<select class="form-control selectTPBC" name="inputTPBC" id="inputTPBC"><option value="" disabled selected>SELECT SOA TYPE</option><option value="0">No SOA presented</option><option value="1">APEC SOA</option><option value="2">ALECO SOA</option></select>');
                  // $("#divDynamicBiller25").append('<input type="text" class="form-control formtype" name="formtype" id="formtype" placeholder="INVOICE NUMBER (2-30 digits)" minlength="2" maxlength="30" required />');
                  // $('#divDynamicAPECBiller25').css('display','block');
                  
                  
                  
                  $('#formseries1').remove();
                  $('#inputTPBCs').remove();
                  $('#borrowersName').remove();
                  $('#paymentformseries').remove();
                  $("#inputSubscriberName1").show();
                  $("#formtype1").show();
                  $("#divDynamicAPECBiller25").show();

                  $("#taxtype1").show();
                  $("#billmonth").show();
                  

                  $(".APECBiller").prop('required',true);
                  break;  
              case '611':
                  var placeholder_ext = "ACCOUNT NUMBER (9 digits)";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_ext+'" minlength="9" maxlength="9" required />');

                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputLastNameID inputLastName" name="inputLastName" id="inputLastName" placeholder="LAST NAME" required />');

                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputFirstNameID inputFirstName" name="inputFirstName" id="inputFirstName" placeholder="FIRST NAME" required />');

                  $("#divDynamicBiller25").append('<input type="text" class="form-control inputMiddleNameID inputMiddleName" name="inputMiddleName" id="inputMiddleName" placeholder="MIDDLE NAME" required />');

                  $("#divDynamicBiller25").append('<input type="text" class="form-control selCourseID selCourse sC" name="selCourse" id="selCourse" placeholder="COURSE" required />');

                  $('#divDynamicADAMSONBiller25').css('display','block');

                  $('#inputSubscriberName').remove(); //ACCOUNT NAME //class-> inputSubscriberName
                  $('#accountName2').remove(); //STUDENT NAME //class-> inputSubscriberName2
                  $('#campus').remove(); //BRANCH //class-> selCampus
                  $('#DynamicDueDate25').remove(); //DUE DATE (mmddyyyy) //class-> inputDueDate

                  $('#DynamicDueDate25mdy').remove(); //STUDENT BIRTHDAY (mm/dd/yyyy)//class-> inputBday
                  //$('#divDynamicADAMSONBiller25').remove(); //School Year (yyyy-yyyy): //class-> selCampus
                  $('#divDynamicADAMSONBiller25_1').remove(); //Campus //class-> inputCampus

                  //$('#inputMobile').remove(); //MOBILE NUMBER (11-Digits) //class-> inputMobile
                  //$('#inputAmount').remove(); //AMOUNT//class-> inputAmount

                  break;  
              case '460':
                  var placeholder_ext = "26-DIGIT MERALCO REFERENCE NUMBER (MRN)";
                  $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" minlength="26" maxlength="26" placeholder="'+placeholder_ext+'" required />');

                  $('#inputmaskAccountNo').remove();
                  $('#grace').remove();
                  $('#inputSubscriberName1').remove();
                  $('#inputSubscriberName2').remove();

                  $('#inputMobile2').remove();
                  $('#divDynamicANTECOBiller25_0').remove();
                  $('#divDynamicANTECOBiller25_2').remove();
                  $('#inputMobile1').remove();

                  $('#inputGracePeriods_0').remove();
                  $('#divDynamicANTECOBiller25').remove();
                  $('#divDynamicANTECOBiller25_1').remove();
                  $('#inputBillerz_1').remove();

                  $('#DynamicDueDate25').remove();
                  $('#DynamicDueDate25mdy').remove();
                  $('#DynamicPayorName25').remove();
                  $('#inputAmount').remove();
                break;
              default:
                $("#divDynamicBiller25").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
            }
           $("#inputBiller").val(billerval);
        
         } else if(utilities_type == 26){
           
           utilities26.show();
           utilities1.css('display','none');
           utilities2.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
            //  utilities26.css('display','none');     
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller26").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller" />');
           $("#inputBiller").val(billerval);

           switch(billerval){
           //paramount
             case '752':
             
              

            break;
        
               

              }


           }
         
         else if (utilities_type == 30) {
           utilities30.show();
           utilities1.css('display','none');
           utilities2.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#inputAccountNumber").remove();
           $('#divDynamicBiller30').css('display','block');
           $("#divBiller30").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');

           var placeholder_desc = "ACCOUNT NUMBER";

           switch(billerval) {
               //added by son 06/28/2018
              case '604':
                  var placeholder_desc = "ACCOUNT NUMBER";
                  $("#divDynamicBiller30").append('<input type="text" class="form-control inputAccountNumber" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" minlength="9" maxlength="9" required />');
                break; 
              default:
                $("#divDynamicBiller30").append('<input type="text" class="form-control inputAccountNumber" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
            }

           $("#inputBiller").val(billerval);

         }else if (utilities_type == 31) {
           utilities31.show();
           utilities1.css('display','none');
           utilities2.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           
           $("#inputBiller").remove();
           $("#divBiller31").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

           var placeholder_desc = "ACCOUNT NUMBER";
           
           $("#inputAccountNumber23").detach();
              $("#SinputSubscriberName").detach();
              $("#inputMobile3").detach();

           if(billerval >= 678 || billerval <=729){
            $("#inputMobile1").detach();
              $("#inputSubscriberName1").detach();
              $("#inputAccountNumber1").detach();

                  $("#divBiller311").append('<input type="text" class="form-control inputAccountNumber" name="inputAccountNumber" id="inputAccountNumber23" minlength="8" maxlength="8" placeholder="STUDENT ID" required />');

                  $("#divBiller311").append('<input type="text" class="form-control inputNameValidator inputSubscriberName pablo" name="inputSubscriberName" id="SinputSubscriberName" placeholder="STUDENT NAME" required/>');

                  $(".pablo").keypress(function(event){
                      var inputValue = event.charCode;
                      if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
                          event.preventDefault();
                      }
                  });

                  $("#divBiller311").append('<input type="tel" class="inputNumberValidator form-control inputMobile" id="inputMobile3" name="inputMobile" placeholder="STUDENT MOBILE NUMBER" minlength="11" maxlength="11" required />');
           }

           switch(billerval) {
               
              case '678':
                  $("#inputSubscriberName1").attr('placeholder', 'STUDENT NAME');
                  $("#inputMobile1").attr('placeholder', 'STUDENT MOBILE NUMBER');
                  

                  


                break; 

              //case '714':
              //$("#inputMobile1").detach();
              //$("#inputSubscriberName1").detach();
              //$("#inputAccountNumber1").detach();

                  //$("#divBiller311").append('<input type="text" class="form-control inputAccountNumber" name="inputAccountNumber" id="inputAccountNumber23" minlength="8" maxlength="8" placeholder="STUDENT ID" required />');

                  //$("#divBiller311").append('<input type="text" class="form-control inputNameValidator inputSubscriberName pablo" name="inputSubscriberName" id="SinputSubscriberName" placeholder="STUDENT NAME" required/>');

                  //$(".pablo").keypress(function(event){
                      //var inputValue = event.charCode;
                      //if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
                          //event.preventDefault();
                      //}
                  //});

                  //$("#divBiller311").append('<input type="tel" class="inputNumberValidator form-control inputMobile" id="inputMobile3" name="inputMobile" placeholder="STUDENT MOBILE NUMBER" minlength="11" maxlength="11" required />');
                  //break;
              // default:
              //   $("#divDynamicBiller31").append('<input type="text" class="form-control inputAccountNumber" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
            }

         }else if (utilities_type == 2) {
           utilities2.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller2").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         }else if (utilities_type == 3) {
           utilities3.show();
           utilities1.css('display','none');
           utilities2.css('display','none');
           utilities4.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none'); 
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller3").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         }else if (utilities_type == 4) {
           utilities4.show();
           utilities1.css('display','none');
           utilities2.css('display','none');
           utilities3.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller4").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         }else if (utilities_type == 5) {
           utilities5.show();
           utilities1.css('display','none');
           utilities2.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller5").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         }else if (utilities_type == 6) {
           utilities6.show();
           utilities1.css('display','none');
           utilities2.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities5.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller6").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         }else if (utilities_type == 9) {
           utilities9.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities2.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller9").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         }else if (utilities_type == 11) {
           utilities11.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities2.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities26.css('display','none');  
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller11").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         }else if (utilities_type == 13) {
           utilities13.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities2.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller13").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         }else if (utilities_type == 15) {
           utilities15.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities2.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller15").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);
           $("#inputCoveredFrom").val('');
           $("#inputCoveredTo").val('');

         }else if (utilities_type == 18) {
           utilities18.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities2.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller18").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         }else if (utilities_type == 20) {
           utilities20.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities2.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller20").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         }else if (utilities_type == 21) {
           utilities21.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities2.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller21").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);
         }else if (utilities_type == 22) {
           utilities22.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities2.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller21").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);
         }
         else if (utilities_type == 23) {
           utilities23.show();
           utilities22.css('display','none');
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities2.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller23").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);

         } else if (utilities_type == 24) {
           utilities24.show();
           utilities22.css('display','none');
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities2.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities25.css('display','none'); 
           utilities28.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#divBiller24").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
           $("#inputBiller").val(billerval);
            $("#inputCoveredFrom").val('');
           $("#inputCoveredTo").val('');

         } else if (utilities_type == 28) {
           utilities28.show();
           utilities1.css('display','none');
           utilities3.css('display','none');
           utilities4.css('display','none');
           utilities5.css('display','none');
           utilities6.css('display','none');
           utilities9.css('display','none');
           utilities11.css('display','none');
           utilities13.css('display','none');
           utilities15.css('display','none');
           utilities18.css('display','none');
           utilities20.css('display','none');
           utilities21.css('display','none');
           utilities22.css('display','none');
           utilities23.css('display','none');
           utilities24.css('display','none');
           utilities25.css('display','none');
           utilities30.css('display','none');
           utilities31.css('display','none');
           $("#inputBiller").remove();
           $("#inputAccountNumber").remove();
           $("#divBiller28").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller" />');
           $('#divDynamicForms').empty();
           $('#divDyanamicAccountNo28 input[name=inputAccountxt3]').remove();

           //*** utiliies ft28 */
           $('input[name=inputAccountNumber]').attr('placeholder','ACCOUNT NUMBER');
           $('input[name=inputAccountNumber]').removeAttr('pattern');
           $('#divDyanamicAccountNo28').empty();
           $('input[name=inputAccountNumber]').val('');
           $('input[name=inputAmount]').val('');
           $('input[name=inputDueDate]').val('');
           $('input[name=inputDateFT28]').val('');
           $('input[name=inputTpass]').val('');           

           $('#inputDueDate').hide();
           $("#inputDueDate").css('visibility', 'hidden');
           $("#inputDueDate").attr("disabled", true);

           $('#inputDateFT28').hide();
           $("#inputDateFT28").css('visibility', 'hidden');
           $("#inputDateFT28").attr("disabled", true);
           //*** utiliies ft28 end*/

            switch(billerval) {
              case '552':
                  $('#divAccountNo28').css('display','block');
                  $("#divDyanamicAccountNo28").css('display','none');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr('id', 'inputAccountxt1');
                  $('#divAccountNo28 input[name=inputAccountxt1]').attr('id', 'inputAccountxt');
                  $('#divAccountNo28 input[name=inputAccountxt1]').attr("required", "true");
                  $('#divAcctName28').after('<div class="form-group" id="divDynamicForms"><input type="text" style="margin-top: 2px;" class="form-control" name="selSem" id="selSem" placeholder="PAYOR NAME"  maxlength="60" required />'+'<input type="text" style="margin-top: 7px;" class="form-control" name="selCourse" id="selCourse" placeholder="PAYOR ADDRESS"  maxlength="60" required />'+'<input type="text" style="margin-top: 7px;" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NO"  maxlength="11" required /></div>');
                  break;
              case '553':
              case '554':
                  $("#inputAccountxt, #inputAccountxt1").val('');
                  $('#divAccountNo28').css('display','none');
                  $('#divAccountNo28 input[name=inputAccountxt1]').removeAttr("required", "required");
                  $("#divDyanamicAccountNo28").css('display','block');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').css('display','block');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr('id', 'inputAccountxt');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr("required", "true");
                  $('#divAccountNo28 input[name=inputAccountxt1]').attr('id', 'inputAccountxt1');
                  $('#divAcctName28').after('<div class="form-group" id="divDynamicForms"><input type="text" style="margin-top: 2px;" class="form-control" name="selSem" id="selSem" placeholder="PAYOR NAME"  maxlength="60" required />'+'<input type="text" style="margin-top: 7px;" class="form-control" name="selCourse" id="selCourse" placeholder="PAYOR ADDRESS"  maxlength="60" required />'+'<input type="text" style="margin-top: 7px;" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NO"  maxlength="11" required /></div>');
                  break;
                case '555':
                  $("#inputAccountxt, #inputAccountxt1").val('');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr('maxlength', 15);
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr('minlength', 15);
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr('placeholder', 'PN REFERENCE NUMBER (15-Digits)');
                  $('#divAccountNo28').css('display','none');
                  $('#divAccountNo28 input[name=inputAccountxt1]').removeAttr("required", "required");
                  $("#divDyanamicAccountNo28").css('display','block');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').css('display','block');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr('id', 'inputAccountxt');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr("required", "true");
                  $('#divAccountNo28 input[name=inputAccountxt1]').attr('id', 'inputAccountxt1');
                  $('#divAcctName28').after('<div class="form-group" id="divDynamicForms"><input type="text" style="margin-top: 2px;" class="form-control" name="selSem" id="selSem" placeholder="PAYOR NAME"  maxlength="60" required />'+'<input type="text" style="margin-top: 7px;" class="form-control" name="selCourse" id="selCourse" placeholder="PAYOR ADDRESS"  maxlength="60" required />'+'<input type="text" style="margin-top: 7px;" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NO"  maxlength="11" required /></div>');
                  break;
                case '556':
                  $("#inputAccountxt, #inputAccountxt1").val('');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr('maxlength', 15);
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr('minlength', 15);
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr('placeholder', 'PN REFERENCE NUMBER (15-Digits)');
                  $('#divAccountNo28').css('display','none');
                  $('#divAccountNo28 input[name=inputAccountxt1]').removeAttr("required", "required");
                  $("#divDyanamicAccountNo28").css('display','block');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').css('display','none');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').attr('id', 'inputAccountxt2');
                  $('#divDyanamicAccountNo28 input[name=inputAccountxt2]').removeAttr("required", "required");
                  $('#divDyanamicAccountNo28').append('<input type="text" class="form-control" name="inputAccountxt3" id="inputAccountxt" pattern="[a-zA-Z0-9]+" title="15 Alphanumeric Only" placeholder="PN REFERENCE NUMBER (15-Digits)"  minlength="15" maxlength="15" required/>').attr("required", "true");

                  $('#divAccountNo28 input[name=inputAccountxt1]').attr('id', 'inputAccountxt1');
                  $('#divAcctName28').after('<div class="form-group" id="divDynamicForms"><input type="text" style="margin-top: 2px;" class="form-control" name="selSem" id="selSem" placeholder="PAYOR NAME"  maxlength="60" required />'+'<input type="text" style="margin-top: 7px;" class="form-control" name="selCourse" id="selCourse" placeholder="PAYOR ADDRESS"  maxlength="60" required />'+'<input type="text" style="margin-top: 7px;" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NO"  maxlength="11" required /></div>');
                  break;
                case '803':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputBookId" id="inputBookId" placeholder="INVOICE NUMBER" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMName" id="inputMName" placeholder="MIDDLE NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="LAST NAME" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  break;
                case '806':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="LAST NAME" required /></div>');
                  break;
                case '807':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="CONTACT NUMBER"  onkeypress="return isNumberOnlyKey(event)" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  break;
                case '813':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="BILLING NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="CONTACT NUMBER"  onkeypress="return isNumberOnlyKey(event)" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><small>Billing Month:</small><input type="month"   class="form-control" name="inputBillingMonth" placeholder="BILLING MONTH - YYYYMM" required/></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  break;
                case '815':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required /></div>');
                  $('input[name=inputAccountNumber]').attr('placeholder','CUSTOMER ACCOUNT NUMBER');
                  break;
                case '814':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="LAST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="CONTACT NUMBER"  onkeypress="return isNumberOnlyKey(event)" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  break;
                case '816':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="NAME" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  break;
                case '817':
                  $('input[name=inputAccountNumber]').attr('placeholder','ACCOUNT NUMBER (8 Digits Only)');
                  $('input[name=inputAccountNumber]').attr('pattern','[0-9]{8}');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMName" id="inputMName" placeholder="MIDDLE INITIAL" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="LAST NAME" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDateFT28").show();
                  $("#inputDateFT28").css('visibility', 'visible');
                  $("#inputDateFT28").attr("disabled", false);
                  $("#inputDateFT28").attr("placeholder", 'DISCONNECTION DATE');
                  break;
                case '821':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="LAST NAME" required /></div>');
                  break;
                case '818':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputBookId" id="inputBookId" placeholder="INVOICE NUMBER" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><select class="form-control" name="inputType" id="inputType" required><option value = "">SELECT SOA TYPE</option><option value="1">APEC SOA</option><option value="2">ALECO SOA</option></select></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><small>Billing Month:</small><input type="month"   class="form-control" name="inputBillingMonth" placeholder="BILLING MONTH - YYYYMM" required/></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><select class="form-control" name="inputType2" id="inputType2" required><option value = "">SELECT PAYMENT TYPE</option><option value="S">Cash Only</option></select></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDueDate").attr("placeholder", 'DELIVERY DATE');
                  break;
                case '819':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><select class="form-control" name="inputType" id="inputType" required><option value = "">SELECT TYPE</option><option value="WB">WATER BILLS</option><option value="Misc">MISCELLANEOUS</option></select></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDueDate").attr("placeholder", 'DUE DATE');
                  $("#inputDateFT28").show();
                  $("#inputDateFT28").css('visibility', 'visible');
                  $("#inputDateFT28").attr("disabled", false);
                  $("#inputDateFT28").attr("placeholder", 'DISCONNECTION DATE');
                  break;
                case '820':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><select class="form-control" name="inputType" id="inputType" required><option value = "">SELECT TYPE</option><option value="Service1">WATER BILLS</option><option value="Service2">MISCELLANEOUS</option></select></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDueDate").attr("placeholder", 'DUE DATE');
                  $("#inputDateFT28").show();
                  $("#inputDateFT28").css('visibility', 'visible');
                  $("#inputDateFT28").attr("disabled", false);
                  $("#inputDateFT28").attr("placeholder", 'DISCONNECTION DATE');
                  break;
                 case '826':
                  $("#divDyanamicAccountNo28").append('<div class="form-group">'+
                    '<select class="form-control" name="selSem" id="selSem" required>'+
                      '<option value = "">BRANCH CODE</option>'+
                      '<option value = "B03">Aguinaldo Dasmarinas</option>'+
                      '<option value = "A07">C. Raymundo</option>'+
                      '<option value = "B10">Calumpang, Marikina</option>'+
                      '<option value = "C02">Conception Dos, Marikina</option>'+
                      '<option value = "A08">Conception Uno, Marikina</option>'+
                      '<option value = "B08">Dolores, Taytay</option>'+
                      '<option value = "A02">Dona Juana, Holy Spirit</option>'+
                      '<option value = "A00">EAC</option>'+
                      '<option value = "B05">Espana</option>'+
                      '<option value = "B05">G. Tuazon, Sampaloc</option>'+
                      '<option value = "A09">Grace Park West</option>'+
                      '<option value = "A03">Holy Spirit</option>'+
                      '<option value = "B12">JRU Lipa</option>'+
                      '<option value = "C01">Las Pinas</option>'+
                      '<option value = "A06">Mercedes</option>'+
                      '<option value = "C03">New Manila</option>'+
                      '<option value = "A04">North Fairview</option>'+
                      '<option value = "B09">Ortigas Ext., Cainta</option>'+
                      '<option value = "B01">Poblacion Muntinlupa</option>'+
                      '<option value = "B06">Roxas Blvd, Pasay</option>'+
                      '<option value = "A11">Sampaloc</option>'+
                      '<option value = "B04">San Nicolas, Bacoor</option>'+
                      '<option value = "B07">Silangan, Pateros</option>'+
                      '<option value = "B02">Sta. Rita, Sucat</option>'+
                      '<option value = "A05">Sto. Domingo</option>'+
                      '<option value = "A10">Tondo</option>'+
                      '<option value = "A01">V. Luna</option>'+
                      '<option value = "OTH">Others</option>'+
                    '</select></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group">'+
                    '<select class="form-control" name="selCourse" id="selCourse" required>'+
                      '<option value = "">PAYMENT TYPE</option>'+
                      '<option value="AF">ADMISSION FEE</option>'+
                      '<option value="TF">TUITION FEE</option>'+
                      '<option value="PEN">PENALTIES</option>'+
                      '<option value="MISC">MISCELLANEOUS</option>'+
                      '<option value="OTH">OTHERS</option>'+
                    '</select></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFirstName" id="inputFirstName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="LAST NAME" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDueDate").attr("placeholder", 'BIRTHDAY');
                  break;
                 case '827':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="STUDENT NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group">'+
                    '<select class="form-control" name="selSem" id="selSem" required>'+
                      '<option value="">SELECT BRANCH</option>'+
                      '<option value = "manila">MANILA</option>'+
                      '<option value = "cavite">CAVITE</option>'+
                    '</select></div>');
                  break;
                 case '830':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group">'+
                    '<select class="form-control" name="selSem" id="selSem" required>'+
                      '<option value="">AFFILIATE BRANCH</option>'+
                      '<option value = "ASVCA11">Aclan Cable Network, Inc.</option>'+
                      '<option value = "ASVCA10">Batangas CATV, Inc.</option>'+
                      '<option value = "ASVCA14">Batangas CATV, Inc. - Buan</option>'+
                      '<option value = "ASVCA1">Colorview CATV, Inc.</option>'+
                      '<option value = "ASVCA3">Colorview CATV, Inc. – Bo. Barretto</option>'+
                      '<option value = "ASVCA12">Excelite CATV Batangas, Inc.</option>'+
                      '<option value = "ASVCA13">JM Cable Network, Inc.</option>'+
                      '<option value = "ASVCA6">Northwest Cable, Inc - Iba</option>'+
                      '<option value = "ASVCA7">Northwest Cable, Inc - Masinloc</option>'+
                      '<option value = "ASVCA8">Quezon CATV, Inc</option>'+
                      '<option value = "ASVCA2">Subic CATV, Inc.</option>'+
                      '<option value = "ASVCA5">Subic CATV, Inc – San Marcelino</option>'+
                      '<option value = "ASVCA9">Tayabas Resources Ventures Corp.</option>'+
                      '<option value = "ASVCA4">Wesky Cable Networks, Inc.</option>'+
                    '</select></div>');
                  break;
                case '828':
                  $('input[name=inputAccountNumber]').attr('placeholder','BILL REFERENCE NUMBER');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFirstName" id="inputFirstName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMiddleName" id="inputMiddleName" placeholder="MIDDLE NAME"/></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="LAST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMobileNumber" id="inputMobileNumber" placeholder="TELEPHONE NUMBER" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDueDate").attr("placeholder", 'DUE DATE');
                  break;                 
                case '829':
                  $('input[name=inputAccountNumber]').attr('placeholder','CONTRACT NUMBER');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group">'+
                    '<select class="form-control" name="selSem" id="selSem" required>'+
                    '<option value = "">PRODUCT TYPE</option>'+
                    '<option value = "C">C - CREMATION</option>'+
                    '<option value = "D">D - EDUCATION</option>'+
                    '<option value = "E">E - PENSION</option>'+
                    '<option value = "L">L - LIFE PLAN</option>'+
                    '<option value = "P">P - PENSION PLAN</option>'+
                    '</select></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDueDate").attr("placeholder", 'DUE DATE');
                  break;
                case '831':
                  $('input[name=inputAccountNumber]').attr('placeholder','PHILHEALTH IDENTIFICATION NUMBER (PIN)');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFirstName" id="inputFirstName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMiddleName" id="inputMiddleName" placeholder="MIDDLE NAME"/></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="LAST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group">'+
                    '<select class="form-control" name="selSem" id="selSem" required>'+
                    '<option value = "">MEMBER TYPE</option>'+
                    '<option value = "DUAL">DUAL CITIZENSHIP</option>'+
                    '<option value = "INP">INFORMAL (NON PRO)</option>'+
                    '<option value = "OFW">OFW</option>'+
                    '<option value = "PRA">PRA FOREIGN RETIREES</option>'+
                    '<option value = "SEP">SELF EARNING (PRO)</option>'+
                    '<option value = "OFN">OTHER FOREIGN NATIONALS</option>'+
                    '</select></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group">'+
                    '<select class="form-control" name="selCourse" id="selCourse" required>'+
                    '<option value = "">PAYMENT TYPE</option>'+
                    '<option value = "Quarterly">3 MONTHS</option>'+
                    '<option value = "Semi Annual">6 MONTHS</option>'+
                    '<option value = "Annually">1 YEAR</option>'+
                    '<option value = "Two Years">2 YEARS</option>'+
                    '</select></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputCampus" id="inputCampus" placeholder="SPA NUMBER" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDueDate").attr("placeholder", 'DUE DATE');
                  $("#inputDateFT28").show();
                  $("#inputDateFT28").css('visibility', 'visible');
                  $("#inputDateFT28").attr("disabled", false);
                  $("#inputDateFT28").attr("placeholder", 'BILL DATE');
                  break;
                case '832':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFirstName" id="inputFirstName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="LAST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="CONTACT NUMBER" required /></div>');
                  break;
                case '833':
                  $('input[name=inputAccountNumber]').attr('placeholder','BILL MEMBER ID / REFERENCE NO');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFirstName" id="inputFirstName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="LAST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="CONTACT NUMBER" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group">'+
                    '<select class="form-control" name="selCourse" id="selCourse" required>'+
                    '<option value = "">PAYMENT TYPE</option>'+
                    '<option value = "MC">MEMBERSHIP SAVINGS</option>'+
                    '<option value = "HL">HOUSING LOAN</option>'+
                    '</select></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDueDate").attr("placeholder", 'PERIOD FROM');
                  $("#inputDateFT28").show();
                  $("#inputDateFT28").css('visibility', 'visible');
                  $("#inputDateFT28").attr("disabled", false);
                  $("#inputDateFT28").attr("placeholder", 'PERIOD TO');
                  break;
                case '834':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required /></div>');
                  break;
                case '835':
                  $('input[name=inputAccountNumber]').attr('placeholder','CARD NUMBER');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDueDate").attr("placeholder", 'BILL DATE');
                  break;
                case '836':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="CONSUMER NAME" required /></div>');
                  break;
                case '837':
                  $('input[name=inputAccountNumber]').attr('placeholder','CARD NUMBER');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFirstName" id="inputFirstName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMiddleName" id="inputMiddleName" placeholder="MIDDLE INITIAL" required/></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="LAST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="CONTACT NUMBER" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  break;
                case '838':
                  $('input[name=inputAccountNumber]').attr('placeholder','CUSTOMER / CARD NUMBER');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="CONSUMER NAME" required /></div>');
                  break;
                case '805':
                  $('input[name=inputAccountNumber]').attr('placeholder','RELOC NUMBER');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="PAYOR NAME" required /></div>');
                  $("#inputDueDate").show();
                  $("#inputDueDate").css('visibility', 'visible');
                  $("#inputDueDate").attr("disabled", false);
                  $("#inputDueDate").attr("placeholder", 'DEPARTURE DATE');
                  $("#inputDueDate").attr("required", true);
                  break;
                case '839':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="CLIENT NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="selSem" id="selSem" placeholder="BANK PAYMENT CODE" pattern="[0-9]+" required /></div>');
                  break;
                case '840':
                  $('input[name=inputAccountNumber]').attr('placeholder','UNIT REFERENCE NUMBER');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="CUSTOMER NAME" required /></div>');
                  break;
                case '841':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMName" id="inputMName" placeholder="MIDDLE INITIAL" /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="LAST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="CONTACT NUMBER" /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group">'+
                    '<select class="form-control" name="selSem" id="selCourse" required>'+
                    '<option value = "">PARTICULAR CODE</option>'+
                    '<option value = "RF">RF</option>'+
                    '<option value = "EQ">EQUITY</option>'+
                    '<option value = "PR">PRINCIPAL</option>'+
                    '<option value = "IN">INTEREST</option>'+
                    '<option value = "PEN">PENALTY</option>'+
                    '<option value = "MF">MOVE-IN FEE</option>'+
                    '<option value = "CB">CONTRUCTION BOND</option>'+
                    '<option value = "MRI">MRI</option>'+
                    '<option value = "UPG">UPRGADING</option>'+
                    '<option value = "WU">WATER-UTLITIES</option>'+
                    '<option value = "EU">ELECTRICAL-UTILITIES</option>'+
                    '<option value = "DF">DEPOSIT FEE</option>'+
                    '<option value = "DPC">DOWNPAYMENT</option>'+
                    '<option value = "FI">FIRE INSURANCE</option>'+
                    '<option value = "HF">HOLDING FEE</option>'+
                    '<option value = "MA-HDMF">MONTHLY AMORTIZATION HDMF</option>'+
                    '<option value = "MISF">MISCELLANEOUS FEE</option>'+
                    '<option value = "TF">TRANSFER FEE</option>'+
                    '<option value = "RPT">RPT</option>'+
                    '<option value = "BBL">BUYBACK COST</option>'+
                    '<option value = "REIN-FEE">REINSTATEMENT FEE</option>'+
                    '<option value = "HMF">HOA-MEMB FEE</option>'+
                    '<option value = "MRI-FIRE">MRI AND FIRE</option>'+
                    '<option value = "MC">MONITORING COST</option>'+
                    '<option value = "MA-IHF">MONTHLY AMORTIZATION IHF</option>'+
                    '<option value = "MA-HDMF PENALTY">MA-HDMF PENALTY</option>'+
                    '<option value = "POP">PAG-IBIG OVERSEAS PROGRAM</option>'+
                    '</select></div>');
                    break;
                case '842':
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="FIRST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="LAST NAME" required /></div>');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="CONTACT NUMBER" /></div>');
                    break;
                case '843':
                  $('input[name=inputAccountNumber]').attr('placeholder','AGREEMENT NUMBER');
                  $("#divDyanamicAccountNo28").append('<div class="form-group"><input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required /></div>');
                    break;
                    default:
               $("#divDynamicBiller28").append('<input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="'+placeholder_desc+'" required />');
            }

           $("#inputBiller").val(billerval);

          }


        var res = com_group.split('|');
        var CG = res[0];
        var level = res[1];
        var TF = res[2];

        if(billerval == 168 || billerval == 470 || billerval == 509 || billerval == 499 || billerval == 652 
          || billerval == 654 || billerval == 542 || billerval == 577 || billerval == 471 || billerval == 404 || billerval == 533  || billerval == 336 || billerval == 657 || billerval == 581 || billerval == 658 || billerval == 659 || billerval == 413 || billerval == 502 || billerval == 515 || billerval == 537 || billerval == 601 || billerval == 661 || billerval == 602 || billerval == 663 || billerval == 414 || billerval == 415 || billerval == 416 || billerval == 417 || billerval == 294 || billerval == 664 || billerval == 534 || billerval == 533 || billerval == 472 || billerval == 296 || billerval == 603 || billerval == 418 || billerval == 570 || billerval == 572 || billerval == 670 || billerval == 578 || billerval == 674 || billerval == 677){
          var TFdealer = '15.00';

        }else if(billerval == 649 || billerval == 305 || billerval == 584 || billerval == 594 || billerval == 356 || billerval == 600 || billerval == 590 || billerval == 592 || billerval == 666){
          var TFdealer = '25.00'; 
        }else if(billerval == 650 || billerval == 567 || billerval == 669){
          var TFdealer = '22.00'; 
        }else if(billerval == 565 || billerval == 545 || billerval == 655 || billerval == 536 || billerval == 660 || billerval == 667 || billerval == 277 || billerval == 301){
          var TFdealer = '18.00'; 
        }else if(billerval == 593){
          var TFdealer = '35.00'; 
        }else if(billerval == 583){
          var TFdealer = '60.00'; 
        }else if(billerval == 406 || billerval == 656 || billerval == 651 || billerval == 662 || billerval == 574 || billerval == 561 || billerval == 668 || billerval == 671 || billerval == 392 || billerval == 672){
          var TFdealer = '20.00'; 
        }else if(billerval == 573 || billerval == 586){
          var TFdealer = '30.00'; 
        }else if(billerval == 591 || billerval == 519 || billerval == 516 || billerval == 517 || billerval == 564 || billerval == 520 || billerval == 549 || billerval == 665 || billerval == 563 || billerval == 579){
          var TFdealer = '17.00'; 
        }else if(billerval == 518){
          var TFdealer = '40.00'; 
        }else if(billerval == 610){
          var TFdealer = TF;
        }else if(billerval == 597 || billerval == 673){
          var TFdealer = '70.00'; 
        }else if(billerval == 239 || billerval == 605 || billerval == 676 || billerval == 730 || billerval == 731 || billerval == 732 || billerval == 733 || billerval == 734 || billerval == 735 || billerval == 736 || billerval == 737 || billerval == 738 || billerval == 739 || billerval == 740 || billerval == 741 || billerval == 742 || billerval == 743 || billerval == 744 || billerval == 745 || billerval == 746 || billerval == 747 || billerval == 748 || billerval == 749 || billerval == 751 || billerval == 804){
          var TFdealer = '7.00'; 
        }else if(billerval == 157 || billerval == 371 || billerval == 206 || billerval == 241 || billerval == 260 || billerval == 750){
          var TFdealer = '5.00';   
        }else if(billerval == 714){
          var TFdealer = '7.50';   
        }else if(billerval >= 240 && billerval <= 370){
          if(TF > 10) {                           
            var TFdealer = TF;
          } else {
            var TFdealer = '10.00';
          }
        
        }else{
          var TFdealer = '10.00';
        }

        if (TF != ''){

          if (level == '7' || level == '16'){

            if (TF != '0.00'){

              if (billerval == 59){ // 19, 59, 162, 168, 238
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font> for the Convenience Fee."
                                        + " Payment of Credit card should be made Three (3) days before due date to avoid penalties.");
              } else if (billerval == 19 || billerval == 162){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font>for the Convenience Fee."
                                        + " Payment of Electric utilities should be made Three (3) days before due date to avoid penalties or disconnection.");    
              } else if (billerval == 168 || billerval == 371){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font>for the Convenience Fee."
                                        + " <font color='red'><b>Minimum amount accepted is &#x20b1 150.00.</b></font>");

              } else if (billerval == 238){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font>for the Convenience Fee."
                                        + " Payment of Water utilities should be made Three (3) days before due date to avoid penalties or disconnection.");

              } else if (billerval == 429 ||  billerval == 456 || billerval == 444 || billerval == 430 || billerval == 428 || billerval == 431 || billerval == 462 || billerval == 453 || billerval == 445 || billerval == 463 || billerval == 446 || billerval == 457 || billerval == 464 || billerval == 447 || billerval == 448 || billerval == 449 || billerval == 432 || billerval == 458 || billerval == 438 || billerval == 450 || billerval == 465 || billerval == 433 || billerval == 451 || billerval == 454 || billerval == 466 || billerval == 434 || billerval == 435 || billerval == 467 || billerval == 455 || billerval == 436 || billerval == 468 || billerval == 437 || billerval == 459 || billerval == 425 || billerval == 469 || billerval == 460 || billerval == 386 || billerval == 607 || billerval == 608){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font>for the Convenience Fee."
                                        + " However,please input the actual amount </br><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> REMINDER: Your payment will be processed by your biller in 1 to 2 banking days.");
                if(billerval == 460){
                  $('.alert-biller-default').html($('.alert-biller-default').html()+'<br><br><h4><span style="color:black">26-DIGIT MERALCO REFERENCE NUMBER (MRN)</span></h4><center><img src="https://mobilereports.globalpinoyremittance.com/assets/images/MeralcoSample.jpg" style="width:100%;height:auto"></center>');
                }
              } 
              else if (billerval == 294){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font>for the Convenience Fee."
                                        + " </br><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>Input exact amount only.");

              }
              else if (billerval == 298){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font>for the Convenience Fee."
                                        + " </br><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>Accepting only 2 days before grace period.");

              }
              else if (billerval == 677){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<h4 class='text-info' style='font-weight: bold;'><i class='fa fa-bell' aria-hidden='true'></i> IMPORTANT REMINDERS</h4><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font>for the Convenience Fee."
                                        + " </br><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> <b>PN Number has a maximum of 20 characters</b> (including special characters [-]).<br><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> <b>CASA Acct. Number has a length of 18 characters</b> (including special characters [-])");
              }
              else if (billerval == 206){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                // Inform the customers of the additional ₱ 5.00 CONVENIENCE FEE.
                  $('.alert-biller-default').html("<h4 class='text-info' style='font-weight: bold;'><i class='fa fa-bell' aria-hidden='true'></i> IMPORTANT REMINDERS</h4> 1. Customer needs to present their <b>Statement of Account (SOA)</b> over-the-counter. <br>2. Accept Cash payments from customers or subscribers if a Statement of Account/Billing from specific biller institution is presented provided such payment is in <b>Full (No partial), Exact amount (No rounding off), Not overdue and Without any arrears such as with Disconnection notice and/or Unpaid previous bill.</b><br>3. Inform the customers or subscribers of the additional <font color='red'>&#x20b1 "+ TF +" </font><b>CONVENIENCE FEE</b>." + " </br></br><center><img src='https://mobilereports.globalpinoyremittance.com/assets/images/CagelcoSOA.jpg'></center>");
              }
              else {
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font>for the charge."
                                        + " However,please input the actual amount");
              }
            }else{
              $('.alert-biller-default').hide();
              $('.alert-biller-reminder').hide();
            }

          }
          else{

            if (TF != '0.00'){

              if (billerval == 59){ // 19, 59, 162, 168, 238
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TFdealer +"</font> for the Convenience Fee."
                                        + " Payment of Credit card should be made Three (3) days before due date to avoid penalties.");
              } else if (billerval == 19 || billerval == 162){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TFdealer +" </font>for the Convenience Fee."
                                        + " Payment of Electric utilities should be made Three (3) days before due date to avoid penalties or disconnection.");      
              } else if (billerval == 168 || billerval == 371){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TFdealer +" </font>for the Convenience Fee."
                                        + " <font color='red'><b>Minimum amount accepted is &#x20b1 150.00.</b></font>");

              } else if (billerval == 238){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TFdealer +" </font>for the Convenience Fee."
                                        + " Payment of Water utilities should be made Three (3) days before due date to avoid penalties or disconnection.");

              } else if (billerval == 429 ||  billerval == 456 || billerval == 444 || billerval == 430 || billerval == 428 || billerval == 431 || billerval == 462 || billerval == 453 || billerval == 445 || billerval == 463 || billerval == 446 || billerval == 457 || billerval == 464 || billerval == 447 || billerval == 448 || billerval == 449 || billerval == 432 || billerval == 458 || billerval == 438 || billerval == 450 || billerval == 465 || billerval == 433 || billerval == 451 || billerval == 454 || billerval == 466 || billerval == 434 || billerval == 435 || billerval == 467 || billerval == 455 || billerval == 436 || billerval == 468 || billerval == 437 || billerval == 459 || billerval == 425 || billerval == 469 || billerval == 460 || billerval == 386 || billerval == 607 || billerval == 608){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TFdealer +" </font>for the Convenience Fee."
                                        + " However,please input the actual amount </br><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> REMINDER: Your payment will be processed by your biller in 1 to 2 banking days.");
                if(billerval == 460){
                  // $('.alert-biller-default').html($('.alert-biller-default').html()+'<br><br><center><img src="https://mobilereports.globalpinoyremittance.com/assets/images/MeralcoSample.jpg" style="width:100%;height:auto"></center>');
                  $('.alert-biller-default').html($('.alert-biller-default').html()+'<br><br><h4><span style="color:black">26-DIGIT MERALCO REFERENCE NUMBER (MRN)</span></h4><center><img src="https://mobilereports.globalpinoyremittance.com/assets/images/MeralcoSample.jpg" style="width:100%;height:auto"></center>');
                }

              } else if (billerval == 294){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font>for the Convenience Fee."
                                        + " </br><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>Input exact amount only.");

              }
              else if (billerval == 298){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TF +" </font>for the Convenience Fee."
                                        + " </br><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>Accepting only 2 days before grace period.");

              }
              else if (billerval == 677){
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<h4 class='text-info' style='font-weight: bold;'><i class='fa fa-bell' aria-hidden='true'></i> IMPORTANT REMINDERS</h4><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TFdealer +" </font>for the Convenience Fee."
                                        + " </br><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> <b>PN Number has a maximum of 20 characters</b> (including special characters [-]).<br><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> <b>CASA Acct. Number has a length of 18 characters</b> (including special characters [-])");
              }
              else if (billerval == 206){
               $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                // Inform the customers of the additional ₱ 5.00 CONVENIENCE FEE.
                  $('.alert-biller-default').html("<h4 class='text-info' style='font-weight: bold;'><i class='fa fa-bell' aria-hidden='true'></i> IMPORTANT REMINDERS</h4> 1. Customer needs to present their <b>Statement of Account (SOA)</b> over-the-counter. <br>2. Accept Cash payments from customers or subscribers if a Statement of Account/Billing from specific biller institution is presented provided such payment is in <b>Full (No partial), Exact amount (No rounding off), Not overdue and Without any arrears such as with Disconnection notice and/or Unpaid previous bill.</b><br>3. Inform the customers or subscribers of the additional <font color='red'>&#x20b1 "+ TFdealer +" </font><b>CONVENIENCE FEE</b>." + " </br></br><center><img src='https://mobilereports.globalpinoyremittance.com/assets/images/CagelcoSOA.jpg'></center>");
              }
             
              else {
                $('.alert-biller-reminder').hide();
                $('.alert-biller-default').show();
                  $('.alert-biller-default').html("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span> Please collect an additional <font color='red'>&#x20b1 "+ TFdealer +" </font>for the charge."
                                        + " However,please input the actual amount");
              }
            }else{
              $('.alert-biller-reminder').hide();
              $('.alert-biller-default').hide();
            }

          }
      }


          $('.alert-biller').show();
          $('.alert-biller-reminder').hide();
          if (billernote == 8){
            
            $('.alert-biller').html(
                        // "<i><font color='red'>Notes:</font></i><br />" +
                        // "&#9632 Account Number <br />" +
                        // "For Manual Inputting of Account No. <br />" +
                        // "&#9632 Use the ATM /Phone Reference No. -16 Digits code Besides S.I.N <br />" +
                        // "Using BarCode Scanner <br />" +
                        // "&#9632 From left-to-right, scan the first and second bar codes only. <br />" +
                        '<img src="'+images_url+'/assets/images/billspayment/meralco_can.png" style="margin:0 auto; width: 100%;">'
                        );   
          }
          //else if (billernote == 3) {

            // if (com_group != 'UPS'){

            // $('.alert-biller').html("Please collect an additional <font color='red'>&#x20b1 10.00 </font>for the charge."
            //                       + " However,please input the actual amount");

            // }else{

            // $('.alert-biller').html("Please collect an additional <font color='red'>&#x20b1 7.00 </font>for the charge."
            //                       + " However,please input the actual amount");
            // }
          
          //}
          else if (billernote == 15) {
            $('.alert-biller').html("10 digit SSS number + 6 digit containing month (mm)"
                                  + " and year (yyyy) for the applicable payment period. i.e. XXXXXXXXXXmmyyyy");
          }
          else if (billernote == 5) {
            $('.alert-biller').html("Please include two decimal places [e.g. 19600.00]");
          } 
          else if (billernote == 7) {
            $('.alert-biller').html("Please enter 555 and the last 6 digits of your E-Pass Account number in the Account No. field.");
          }
          else if (billernote == 13){
            
            $('.alert-biller').html("<i><font color='red'>Notes:</font></i><br />" +
                        "The staff must validate the amount from the Statement of Account (SoA) presented by the client. Advice the client that the AR from GPRS and their SoA should be presented to the school's accounting department to get the permit." +
                        '<img src="'+images_url+'/assets/images/billspayment/rmmcr.png" style="margin:0 auto; width: 100%;">'
                        );  
          }
            
          else if (billernote == 25){ 
              if (billerval == 750){
        
                  $('.alert-biller').html("Please ONLY accept payments with this kind of SOA. <br><br>" + 
                  '<center><img src="'+images_url+'/assets/images/billspayment/water_bill_larc.png" style="margin:0 auto; width: 60%;"></center>'); 
                  // $('.alert-biller').html("Please ONLY accept payments with this kind of SOA. <br>" + 
                  // '<img src="10.10.14.14:8080/assets/images/billspayment/water_bill_larc.png" style="margin:0 auto; width: 100%;">');      
              }
              else{
                  $('.alert-biller').hide()
              } 
            }
             
           
          //else if (billernote == 20){
            
            // $('.alert-biller').html("Please collect an additional &#x20b1 9.00 for the change." +
            //             "However, please input the actual amount." +
            //             "The &#x20b1 9.00 charge will be automatically deducted to your account." +
            //             "Example: Bill = &#x20b1 2000, collect &#x20b1 2009 but input 2000"
            //             ); 
          //}                
          else {
          $('.alert-biller').hide();
          $('.alert-biller-reminder').hide();
          $('.alert-biller').html("");
          }
          //display messgae//

       });
    });

    </script>
<script>

$(document).ready(function() {
    $('#modalOTP').modal({show:true});

});

$(document).ready(function(){
    $('.closeOTPverifymodal').click(function() {
      $('#modalOTP').modal('hide');
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
     window.location.href = '<?php echo BASE_URL()?>Ecash_send/ecashtocashcard';
    //return false;
    });
});   

$(document).ready(function(){  
    $('#btnOTPResend').click(function() {
      $(".resendingOTPcode").css('display','block');
      var trackno = $("#otptrackno").val();
      $.ajax({
            type : 'POST',
            url  : 'otp_resend',
            data : {trackno:trackno},
            datatype:'json',
            success :  function( msg )
            { 
            $(".resendingOTPcode").css('display','none');
             var msgDone = JSON.parse(msg);
               console.log(msgDone);
      
             if(msgDone.S == 1){ 
              $('#otpMessage').removeAttr('style');
              $('#otpMessage').attr('style');
              $('#otpMessage').css({'color': '#3c763d','background-color': '#dff0d8', 'border-color': '#d6e9c6', 'padding': '15px', 'margin-bottom': '20px', 'border': '1px solid transparent', 'border-radius': '4px'});      
              $('#otpMessage').text(msgDone.M);    
             }else{
              $('#otpMessage').removeAttr('style');
              $('#otpMessage').attr('style');
              $('#otpMessage').css({'color': '#a94442','background-color': '#f2dede', 'border-color': '#ebccd1', 'padding': '15px', 'margin-bottom': '20px', 'border': '1px solid transparent', 'border-radius': '4px'});      
              $('#otpMessage').text(msgDone.M);                 
             }

            }

          });
    });
});

</script>

<script>
$("document").ready(function(){
  $("#upgrade_accountModal").modal('show');
  
   $('#modalAnnouncementsframe').modal({show:true}); // ANNOUNCEMENT MODAL DISPLAY
   $('#usersLocationUpdate').modal({show:true});
});
</script>

<script type="text/javascript">
//AJAX FOR REGISTRATION
$(document).ready(function() {
  hiddenMob = $(".hiddenMob");
  hiddenMobpin = $(".hiddenMobpin");
  
  // form submit event
  $("#btnmobSend").on('click',function(){
    hiddenMob.val($("#regMobile").val());
    $("#btnMobReg").click();
  });


  $("#inputPinmobile").on('keyup',function(){
    if ($("#inputPinmobile").val().length == 6) {
      hiddenMobpin.val($(this).val());
      $(".hiddenMobs").val($("#regMobile").val());
      $("#btnMobpinReg").click();
    }
  });

        $("#frmMobReg").on('submit', function() {
          $("#Mobloading").css('display','block');
          $(".pleaseWait1").css('display','block');

          var data = $(this).serialize();
          $.ajax({
              type : 'POST',
              url  : 'check_mobile',
              data : data,
              success :  function(data)
              {  
                
                $("#Mobloading").css('display','none');
                $(".pleaseWait1").css('display','none');
                $("#infos").html("");
                $("#errors").html("");
                $("#errors").css('display','none');
                $("#infos").css('display','none');
                
                var res = data.split('|'); 

                // alert(res[0]);
                if (res[0] == 1 && $("#country").val() !== null) {
                    $("#inputPinmobile").removeAttr('disabled');
                    $("#inputPinmobile").focus();
                    $("#infos").css('display','block');
                    $("#infos").html(res[1]); //MESSAGE FROM RESPONSE OF SP 
                } else {
                    $("#infos").css('display','none'); 
                    $("#errors").css('display','block');
                    $("#errors").html(res[1]);
                }

                if (res[0] == 3 ) {                 
                  $("#back").css('display','block');
                  $('#inputEmail').attr('disabled',true);
                  $("#inputPinmobile").attr('disabled', true);
                } 
              }
          });
          return false;
        });



      
        $("#frmMobpinReg").on('submit', function() {
          $("#MobPinloading").css('display','block');
          $(".pleaseWait2").css('display','block');
       
            var data = $(this).serialize();
            $.ajax({
                type : 'POST',
                url  : 'Registration/check_mobile',
                data : data,
                
                success :  function(data)
                { 
                  $("#MobPinloading").css('display','none');
                  $(".pleaseWait2").css('display','none');
                 
                  var res = data.split('|');
                  $("#infos").html("");
                  $("#errors").html("");
                  $("#errors").css('display','none');
                  $("#infos").css('display','none');
                  // alert(res[0]);

                    if (res[0] == 0 ) {                 
                      $("#errors").css('display','block');
                      $("#errors").html(res[1]);
                      $('#inputEmail').attr('disabled',true);
                    }  

                    if (res[0] == 1 ) {
                      $("#infos").css('display','block');
                      $("#infos").html(res[1]);
                      $("#inputEmail").removeAttr('disabled');
                      $("#inputEmail").focus(); 
                      $("#btnmobSend").html("Resend");
                      $("#btnmobSend").removeAttr('disabled');
                    }

                                
                }
            });

          return false;
        });
  });

  // function startInterval() {
  //   var counter = 120;
  //   timer = setInterval(function() {
  //     counter--;
  //     if (counter <= 0) {
  //         stopInterval(); 
  //         $("#btnmobSend").html("Resend");
  //         $("#btnmobSend").removeAttr('disabled');
  //       return;
  //     } else {
  //         $("#btnmobSend").attr('disabled',true);
  //         $("#btnmobSend").html('('+ counter +' sec)');
  //     }
  //   }, 1000);
  // }

  // function stopInterval() {
  //   clearInterval(timer);
  // }
  

//EMAIL CONFIRMATION
$(document).ready(function() {
  hiddenE = $(".hiddenE");
  hiddenEpin = $(".hiddenEpin");


  $("#btnemailSend").on('click',function(){
    hiddenE.val($("#inputEmail").val());
    $("#btnEReg").click();
  });


  $("#inputPinemail").on('focusout',function(){
    if ($("#inputPinemail").val() != "") {
      hiddenEpin.val($(this).val());
     $(".hiddenEpins").val($("#inputEmail").val());
      $("#btnEpinReg").click();
    }
  });

      $("#frmEReg").on('submit', function() {
          $("#Eloading").css('display','block');
          $(".pleaseWait3").css('display','block');

        var data = $(this).serialize();
        $.ajax({
            type : 'POST',
            url  : 'check_email',
            data : data,
            success :  function(data)
            { 
              $("#Eloading").css('display','none');
              $(".pleaseWait3").css('display','none');
              $("#btnemailSend").html("Resend");
              $("#errors").css('display','none');
              $("#infos").css('display','none');
              var res = data.split('|');

              // alert(res[0]);

              if (res[0] == 0 ) {
                $("#inputPinemail").removeAttr('disabled');
                $("#inputPinemail").focus();
                $("#infos").css('display','block');
                $("#infos").html(res[1]); //MESSAGE FROM RESPONSE OF SP 
                // startIntervalEmailPin();
              } else {
                $("#infos").css('display','none');
                $("#errors").css('display','block');
                $("#inputPinemail").removeAttr('disabled');
                $("#inputPinemail").focus();
                $("#errors").html(res[1]);
              }

              if (res[0] == 3 ) {
                $("#back").css('display','block');
                $('#inputAddress').attr('disabled',true);
                $('#inputZipcode').attr('disabled',true);
                $("#inputPinemail").attr('disabled', true);
              }

            }
        });
        return false;
      });

      $("#frmEpinReg").on('submit', function() {
        $("#EPinloading").css('display','block');
        $(".pleaseWait4").css('display','block');

        var data = $(this).serialize();
        $.ajax({
            type : 'POST',
            url  : 'check_email',
            data : data,
            
            success :  function(data)
            { 
              $("#EPinloading").css('display','none');
              $(".pleaseWait4").css('display','none');

              var res = data.split('|');
              $("#infos").html("");
              $("#errors").html("");
              $("#errors").css('display','none');
              $("#infos").css('display','none');

              // alert(res[0]);

              if (res[0] == 1 ) {
                $("#infos").css('display','block');
                $("#infos").html(res[1]);
                $("#inputAddress").removeAttr('disabled');
                $("#inputAddress").focus();
                $("#inputPinemail").removeAttr('disabled');
                // $("#inputPinemail").focus();
                $("#inputZipcode").removeAttr('disabled');
                $("#btnStep3").removeAttr('disabled');
                $("#tpass1").removeAttr('disabled');  
                $("#tpass2").removeAttr('disabled');  
                // stopIntervalEmailPin();
                $("#btnemailSend").html("Resend");
                $("#btnemailSend").removeAttr('disabled');
              }

              if (res[0] == 0 ) {                        
                $("#errors").css('display','block');
                $("#errors").html(res[1]);
                $('#inputAddress').attr('disabled',true);
                $('#inputZipcode').attr('disabled',true);
              }
            }

        });
        return false;
      });
});

// function startIntervalEmailPin() {
//   var counterEmailPin = 120;
//   timerEmailPin = setInterval(function() {
//     counterEmailPin--;
//     if (counterEmailPin <= 0) {
//         stopInterval(); 
//         $("#btnemailSend").html("Resend");
//         $("#btnemailSend").removeAttr('disabled');
//       return;
//     } else {
//         $("#btnemailSend").attr('disabled',true);
//         $("#btnemailSend").html('('+ counterEmailPin +' sec)');
//     }
//   }, 1000);
// }

// function stopIntervalEmailPin() {
//   clearInterval(timerEmailPin);
// }

//AJAX FOR REGISTRATION
</script>
<script type="text/javascript">

$(document).ready(function(){
  $(".inputNameValidator").on("input", function(){
    //var regexp = /[^a-zA-Z- ]/g;
    var regexp = /[^a-zA-Z- ]*$/;
    if($(this).val().match(regexp)){
      $(this).val( $(this).val().replace(regexp,'') );
    }
  });
});

$(document).ready(function(){
  $('#inputMnameEnsurance').keyup(function() {
    var myLength1 = $("#inputMnameEnsurance").val().length;
    var myLength2 = $("#inputBMnameEnsurance").val().length;

    if(myLength1 > 1 && myLength2 > 1){ 
      $("#btnContinueEnsurance").removeAttr('disabled');
    }
    else if(myLength1 > 1){
      $("#inputLnameEnsurance").removeAttr('disabled');
      $("#datetimepicker").removeAttr('disabled');
      $("#inputOccup").removeAttr('disabled');
      $("#inputEmail").removeAttr('disabled');
      $("#inputBFnameEnsurance").removeAttr('disabled');
      $("#inputBMnameEnsurance").removeAttr('disabled');
    }
    else{
      alert('Please enter your complete Middle Name.');
      $("#inputMnameEnsurance").focus();
      $('#btnContinueEnsurance').attr('disabled','disabled');
    }
  });
});

$(document).ready(function(){
  $('#inputBMnameEnsurance').keyup(function() {
    var myLength = $("#inputBMnameEnsurance").val().length;
    if(myLength > 1){
      $("#inputBLnameEnsurance").removeAttr('disabled');
      $("#btnContinueEnsurance").removeAttr('disabled');
    }else{
      alert('Please enter your complete Beneficiary Middle Name.');
      $("#inputBMnameEnsurance").focus();
      $('#btnContinueEnsurance').attr('disabled','disabled');
    }
  });
});

$(document).ready(function(){
  $("#btnContinueEnsurance").click(function(){

    var myLength1 = $("#inputMnameEnsurance").val().length;
    var myLength2 = $("#inputBMnameEnsurance").val().length;

    if(myLength1 > 1 && myLength2 > 1){
      $("#myModal").modal('show');
    }else{
      alert('Please enter your complete Middle Name/s.');
      $("#inputMnameEnsurance").focus();
      $('#btnContinueEnsurance').attr('disabled','disabled');
    }
    
  });
});

$(document).ready(function() {

    $("#BDOiframe").attr("src", $("#inputbdoURL").val());
    $('#modalBDOframe').modal({show:true});

});

$(document).ready(function() {

    $("#Dragonpayiframe").attr("src", $("#inputdragonpayURL").val());
    $('#modalDragonpayframe').modal({show:true});
    // $('#inputdragonpaysubmit').click(function() {  
    //   if ($('#inputdragonpayURL').val() != undefined) {   
    //     var NWin = window.open($("#inputdragonpayURL").val(), '', 'height=800,width=800');
    //     if (window.focus) 
    //     {
    //       NWin.focus();
    //     }
    //     return false;
    //   } 
    // });  
});

$('.DPinputAmount').on('change', function(){
    $(this).val(parseFloat($(this).val()).toFixed(2));
});

$(document).ready(function(){
    $('#selpaymenttype').change(function(){
        var paymenttype = $("#selpaymenttype").val()
        var net = $("#inputNetPrice").val()
        var totalprice = parseFloat(net) + (parseFloat(net) * 0.055);
        if(paymenttype == 1){
            $("#inputTpass").val('');
            $("#inputTpass").css('display','block');
            $(".alert-creditcard1").css('display','none');
            $(".alert-creditcard2").css('display','none');
        }else{
            $('.alert-creditcard1').show();
            $('.alert-creditcard1').html("<i><font color='red'>Note:</font></i>" +
            " Credit card payments will be charged with an additional Web admin fee of 5.5%.<br>" +
            " <u>Total Amount Due: <font color='red'><b>Php "+ Math.round(totalprice*Math.pow(10,2))/Math.pow(10,2) +"</b></font></u><br>");

            $('.alert-creditcard2').show();
            $('.alert-creditcard2').html(" <b>DISCLAIMER</b><br><br><b>By clicking submit: </b>" +
            " <ul style='list-style-type:disc'>" +
            " <li>I certify that the Credit Card to be used as a form of payment in my" +
            " transaction with UPS either belongs to me or to another person who has full" +
            " knowledge of my transaction and from whom I have also obtained the" +
            " necessary permission and authority for this particular purpose.</li>" +
            " <li>I shall comply and submit any information and/or document which UPS may" +
            " require in relation to this payment method. </li>" +
            " <li>I agree that this shall not be used this in a manner that resembles a cash" +
            " advance, remittance encashment or any other unauthorized or fraudulent mean." +
            " </ul>");
            $("#inputTpass").css('display','none');
            $("#inputTpass").val('Transaction Password');
        }

    });
});
$(document).ready(function(){
    $('.closeBDOmodal').click(function() {
      $('#modalBDOframe').modal('hide');
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
      //window.location.href = '<?php echo BASE_URL()?>Onlineshop2/index?data=1';
      window.location.href = '<?php echo BASE_URL()?>Onlineshop/buycodes';
    return false;
    });
});
</script>

<!--MLM-->

<script type="text/javascript">

      $('.btn_edit_prod').on('click', function( event ){
        event.preventDefault();
        var data = [];
        var index = $(this).index('.btn_edit_prod');
        $('.prod_row').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        console.log(data);

        var res = data[12].split('|');
        if (res[0] == 'Package') {
          var type = 1;
          var type_desc = 'Package';
        }else{
          var type = 2;
          var type_desc = 'Products';
        }
        $('#prod_code').val(data[0]);
        $('#prod_name').val(data[1]);
        $('#prod_price').val(data[2]);
        $('#prod_dealerprice').val(data[3]);
        $('#prod_eccprice').val(data[4]);
        $('#prod_hubprice').val(data[5]);
        $('#prod_pv').val(data[6]);
        $('#prod_stock').val(data[7]);
        $('#prod_type').val(type);
        $('#prod_type2').val(type_desc);
        $('#prod_id').val(res[1]);
        $('#prod_desc').val(data[13]);
        $('#myModal_edit_prod').modal('show');
      });


      $('.btn_edit_discount').on('click', function( event ){
        event.preventDefault();
        var data = [];
        var index = $(this).index('.btn_edit_discount');
        $('.prod_row').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        console.log(data);

        $('#regcode').val(data[0]);
        $('#acct_name').val(data[1]);
        $('#category').val(data[2]);
        $('#discount').val(data[3]);
        $('#myModal_edit_discount').modal('show');
      });


//added by sonmer
      $('.btn_add_inv').on('click', function( event ){
        event.preventDefault();
        var data = [];
        var index = $(this).index('.btn_add_inv');
        $('.prod_row').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        console.log(data);

        $('#prod_code').val(data[0]);
        $('#prod_name').val(data[1]);
        $('#prod_sold').val(data[2]);
        $('#prod_remaining').val(data[3]);
        $('#myModal_add_inv').modal('show');
      });



      $('.btn_del_prod').on('click', function( event ){
        event.preventDefault();
        var data = [];
        var index = $(this).index('.btn_del_prod');
        $('.prod_row').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        var del_code = data[0];

        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        setTimeout(function () {
          waitingDialog.hide();
        }, 3000);

          $.ajax({
                type : 'POST',
                url  : 'delete_products',
                data : {del_code:del_code},
                datatype:'json',
                success :  function( msg )
                { 
                  
                  $('#myModal_delete_prod').modal('hide');
                  // $('.deactivate.modal.in').modal('hide');

                  var msgDone = JSON.parse(msg);
                   console.log(msgDone);
                   if(msgDone.S == 1){
                    document.getElementById('alertSuccess').innerHTML = msgDone.M;
                    $('#alertSuccess').show();
                   }else{
                    document.getElementById('alertDanger').innerHTML = msgDone.M;
                    $('#alertDanger').show();
                   }
                  location.reload();

                }

              });  
      });


      $('#btn_add').on('click', function( event ){
        event.preventDefault();
        $('#myModal_add_prod').modal('show');
      });

        $('.btn_edit_quota').on('click', function( event ){
        event.preventDefault();
        var data = [];
        var index = $(this).index('.btn_edit_quota');
        $('.quota_row').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        console.log(data);
        // var rates = data[1];
        // alert(rates.replace("%", ""));
        $('#rank_code').val(data[0]);
        $('#rates').val(data[1].replace("%", ""));
        $('#group_sales').val(data[2]);
        $('#maintain_pv').val(data[3]);
        $('#rank_id').val(data[4]);
        $('#qualify_pv').val(data[5]);
        $('#myModal_edit_quota').modal('show');
      });

        $('.btn_edit_package_currency').on('click', function( event ){
        event.preventDefault();
        var data = [];
        var index = $(this).index('.btn_edit_package_currency');
        $('.row_currency').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        console.log(data);
        $('#i_currency').val(data[0]);
        $('#i_rate').val(data[1]);
        $('#i_gprice').val(data[2]);
        $('#p_id').val(data[3]);
        $('#myModal_edit_package').modal('show');
      });

</script>

<!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-1517010537439957",
    enable_page_level_ads: true
  });
</script> -->

  <!-- PRODUCTS -->
  <script type="text/javascript">

  $(document).ready(function(){
      $('#selinvpaymenttype').change(function(){
          var paymenttype = $("#selinvpaymenttype").val()
          if(paymenttype == ''){
              $('#btn-payout').attr('disabled','disabled');
          }else{
              $("#btn-payout").removeAttr('disabled');
          }
      });
  });

  $('#walkin_type').on('click', function (){ 
    $('.cart_regcode').attr('disabled','disabled');
    $('.cart_regcode').val('');
  });
  $('#distri_type').on('click', function (){ 
    $('.cart_regcode').removeAttr('disabled');
  });

  function modalViewProd(p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13){
      var img_url = 'https://mobilereports.globalpinoyremittance.com/assets/images/MLMProducts';//https://s3-ap-southeast-1.amazonaws.com/upsmlmprod/mlm
      var default_img_url = 'https://s3-ap-southeast-1.amazonaws.com/upsmlmprod/mlm/NO_IMG.PNG';
      var total_distributed = parseInt(p10);
      var total_remaining = parseInt(p9);
      var total_stock = parseInt(total_remaining);
      var available_stock = parseInt(total_remaining) - parseInt(total_distributed);
      var total_sold = parseInt(total_distributed) - parseInt(total_stock);
      var usertype = p11;
      if(usertype == 'admin'){
        var stock_title = 'Distributed:';
      }else{
        var stock_title = 'Sold:';
      }
    $('.tiggerclassProd').click();
    $('.EditUPStangibleProd1').empty();
    $('.EditUPStangibleProd2').html('<td colspan="7"><b>Product Name: </b>'+p3+'</td>');
    if(p2 == "RMDIN" || p2 == 'RMKAL'|| p2 == 'RMMIR'|| p2 == 'RMNF'|| p2 == 'RMRP'|| p2 == 'RMRS'|| p2 == 'RMSL'|| p2 == 'RMTPG'){
      $('.EditUPStangibleProd44').html('<td colspan="7">'+"<b>Product Description:</b> &nbsp;&nbsp;"+p4.replaceAll("-","&nbsp;&nbsp;&bull;")+'</td>');
    }else{
      $('.EditUPStangibleProd44').html('<td colspan="7">'+"<b>Product Description:</b> &nbsp;&nbsp;"+p4+'</td>');
    }
    $('.EditUPStangibleProd3').html('<td rowspan="6"><img src='+img_url+'/'+p2+'.jpg'+' alt="No Image Available" style="height:100px; width:180px; border: 0; background-image: url('+default_img_url+'); background-size: 180px;"></td><td>Product Code:</td><td colspan="2">'+p2+'</td><td><input id="product-title" name="UPStangibleProdName" type="hidden" value="'+p2+'" class="form-control UPStangibleProdName" readonly/><td><input id="product-name" name="UPStangibleProdDesc" type="hidden" value="'+p3+'" class="form-control UPStangibleProdDesc" readonly/></td>');
    
    $('#ProductCode').html(p2)

    var rm25Kg = [
      'RMKAL',
      'RMDIN',
      'RMNF',
      'RMRP',
      'RMMIR',
      'RMDBA',
      'RMGLB',
      'RMLVM',
      'RMSWS',
      'RMJ'
    ]

    var rm10Kg = [
      'RMGLB10',
      'RMLVM10'
    ]

    if (rm25Kg.includes(p2)) {
      $('.EditUPStangibleProd13').html('<td>Product Weight: </td><td>'+'25.00'+' KG'+'</td>');
    }
    else if (rm10Kg.includes(p2)) {
      $('.EditUPStangibleProd13').html('<td>Product Weight: </td><td>'+'10.00'+' KG'+'</td>');
    }
    else if (p2 == 'RMSL' || p2 == 'RMRS') {
      $('.EditUPStangibleProd13').html('<td>Product Weight: </td><td>'+'50.00'+' KG'+'</td>');
    } else {
      $('.EditUPStangibleProd13').html('<td>Product Weight: </td><td>'+p13+' KG'+'</td>');
    }

    //For Cebu Rice Product Variants Rates
    cebuRMRgCodes = [
      'RMDBA',
      'RMGLB',
      'RMLVM',
      'RMSWS',
      'RMGLB10',
      'RMLVM10',
      'RMJ'
    ]

    // manilaRM = [
    //   'RMKAL',
    //   'RMDIN',
    //   'RMTPG',
    //   'RMNF',
    //   'RMMIR',
    //   'RMSL',
    //   'RMRS',
    //   'RMRP'
    // ]

    var priceSrp = p5.replace(/\,/g,'');
    priceSrp = parseFloat(priceSrp);

    if (cebuRMRgCodes.includes(p2)) {
      if (level === '7' || level === '16') { //Reorder - ECPC/HUB Price for CEBU
        priceSrp = Math.round(priceSrp + (priceSrp * 0.03))
      } else if (level === '1' || level === '6') { //Reorder - Dealer Price CEBU
        priceSrp = Math.round(priceSrp + (priceSrp * 0.05))
      } else if (level === '5') { //Reorder - Non Member/Retail CEBU
        priceSrp = Math.round(priceSrp + (priceSrp * 0.06))
      }
    }
    // else if(manilaRM.includes(p2)){
    //   if (level === '1' || level === '6'){
    //     priceSrp = Math.round(priceSrp + (priceSrp * 0.05))
    //   }
    // }

    priceSrp = priceSrp.toFixed(2)
   
    $('.EditUPStangibleProd4').html('<td>Price (SRP):</td><td colspan="2">'+ priceSrp.replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,") +'</td><td><input name="UPStangibleProdSRPRP" id="product-priceSRP" type="hidden" value="'+p5+'" class="form-control UPStangibleProdSRPSRP" readonly/></td>');
    // $('.EditUPStangibleProd4').html('<td>Price (SRP):</td><td colspan="2">'+p5.replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,")+'</td><td><input name="UPStangibleProdSRPRP" id="product-priceSRP" type="hidden" value="'+p5+'" class="form-control UPStangibleProdSRPSRP" readonly/></td>');
    $('.EditUPStangibleProd12').html('<td>Discounted Price (SRP):</td><td colspan="2">'+p12.replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,")+'</td><td><input name="UPStangibleProdSRP" id="product-price" type="hidden" value="'+p12+'" class="form-control UPStangibleProdSRP" readonly/></td>');

    $('.EditUPStangibleProd6').html('<td>PV:</td><td colspan="2">'+p7+'</td><td><input name="UPStangibleProdPV" id="product-pv" type="hidden" value="'+p7+'" class="form-control UPStangibleProdPV" readonly/></td>');
    // $('.EditUPStangibleProd5').html('<td>Total Stocks:</td><td colspan="2">'+total_stock+'</td>');
      if(usertype == 'admin'){
        $('.EditUPStangibleProd5').html('<td>Total Stocks:</td><td colspan="2">'+total_stock+'</td>');
      }else{
        $('.EditUPStangibleProd5').html('<td>Total Stocks:</td><td colspan="2">'+total_distributed+'</td>');
      }

    // for Sold
    if(usertype == 'admin'){
      $('.EditUPStangibleProd7').html('<td>'+stock_title+'</td><td colspan="2">'+total_distributed+'</td>');
    }else{
      $('.EditUPStangibleProd7').html('<td>'+stock_title+'</td><td colspan="2">'+total_sold+'</td>');
    }

    if(usertype == 'admin'){
      var less_than_50 = available_stock;
    }else{
      var less_than_50 = total_stock;
    }

    if(less_than_50 <= 50) {
      // $('.EditUPStangibleProd8').html('<td><b>Available Stocks:</b></td><td colspan="2" style="color:#ff3000;"><b>'+available_stock+'</b></td>');
      if(usertype == 'admin'){
        $('.EditUPStangibleProd8').html('<td><b>Available Stocks:</b></td><td colspan="2" style="color:#ff3000;"><b>'+available_stock+'</b></td>');
      }else{
        $('.EditUPStangibleProd8').html('<td><b>Available Stocks:</b></td><td colspan="2" style="color:#ff3000;"><b>'+total_stock+'</b></td>');
      }
    } else {
      // $('.EditUPStangibleProd8').html('<td><b>Available Stocks:</b></td><td colspan="2"><b>'+available_stock+'</b></td>');
      if(usertype == 'admin'){
        $('.EditUPStangibleProd8').html('<td><b>Available Stocks:</b></td><td colspan="2"><b>'+available_stock+'</b></td>');
      }else{
        $('.EditUPStangibleProd8').html('<td><b>Available Stocks:</b></td><td colspan="2"><b>'+total_stock+'</b></td>');
      }
    }

    $('#product-final-price').html(p12);
    $("#product-total-price").html(p12.replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,"));
}

  $(document).ready(function() {
      $("#quantity").on('change keyup', function() {
        var x = 1 * $("#quantity").val() * $("#product-final-price").html();
        var ptotal =  x.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,")
        $("#product-total-price").html(ptotal);
      });
  });


      var rowNum = 0;
    $('#btn-addtocart').on('click', function (){
    rowNum++;
      var qty = $('#quantity').val();
      var product_title = $('#product-title').val();
      var product_name = $('#product-name').val();
      var product_price = $('#product-final-price').html();
      var product_price2 = $("#product-final-price").html().replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,");
      var product_tprice = $('#product-total-price').html();
      var total_price = 0;

          $("#cart").append("<tr class='cart_row'><td><span class='increase"+rowNum+"'><i class='glyphicon glyphicon-triangle-top btn-xs'></i></span><span class='decrease"+rowNum+"'><i class='glyphicon glyphicon-triangle-bottom btn-xs'></i></span></td><td><span id='final-qty'>"+qty+"</span></td><td id='final_title'>"+product_title+"</td><td>"+product_name+"</td><td>"+product_price2+"</td><td hidden class='final-price'>"+product_price+"</td><td hidden><span class='final-tprice'>"+product_tprice.replace(/,/g, '')+"</span></td><td><button class='btn btn-primary btn-xs pull-right btn-removetocart' style='margin-right: 20px;'><i class='glyphicon glyphicon-remove'></i></button></td></tr>");          

            $('.increase'+rowNum).on('click', function (){

            var x = $(this).parent().parent().prevAll().length;
            console.log(x);
            var a = $('#getall').val();
            var items = a.split(',');
            var altered = items[x].split('|');
             console.log(altered[1]);
             altered[1] =  parseInt(altered[1]) + 1;
             console.log(altered[1]);
              var str = '';
              for(i=0; i<items.length; i++){

                  if(i == x){
                    str +=  altered[0] + '|' + altered[1] + ','; 
                  } else{
                    str += items[i]; 
                    if(items[i] != ''){
                      str += ',';
                    }
                  }
              }        
              $('#getall').val(str);
              $(this).parent().parent().children(x).find('span#final-qty').html(altered[1]);
              var y = $(this).parent().parent().children(x).find('span.final-tprice').html(product_price*altered[1]);

                var z = $('#total-price').val();
                var ztotal = parseFloat(z) + parseFloat(product_price);
                $( ".final-tprice" ).each(function() {
                  $('#total-price').val(ztotal.toFixed(2));
                });
            });


            $('.decrease'+rowNum).on('click', function (){
            var x = $(this).parent().parent().prevAll().length;
            console.log(x);
            var a = $('#getall').val();
            var items = a.split(',');
            var altered = items[x].split('|');
            console.log(altered[1]);
             altered[1] =  parseInt(altered[1]) - 1;
             if(altered[1] <= 0){
              $('span .decrease').css("pointer-events", "none");
             } else{

              var str = '';
              for(i=0; i<items.length; i++){

                  if(i == x){
                    str +=  altered[0] + '|' + altered[1] + ','; 
                  } else{
                    str += items[i]; 
                    if(items[i] != ''){
                      str += ',';
                    }
                  }
              } 
              $('#getall').val(str);
              $(this).parent().parent().children(x).find('span#final-qty').html(altered[1]);
              var y = $(this).parent().parent().children(x).find('span.final-tprice').html(product_price*altered[1]);

                var z = $('#total-price').val();
                var ztotal = parseFloat(z) - parseFloat(product_price);
                $( ".final-tprice" ).each(function() {
                  $('#total-price').val(ztotal.toFixed(2));
                });

             }

            });

          $('#quantity').val(1);

          $( ".final-tprice" ).each(function() {
              total_price += parseFloat($(this).text());
          });

          $('#total-price').val(total_price.toFixed(2));

          $('.btn-removetocart').on('click', function (){

              var total_price = 0;
              var total_discount = 0;
              var total_pv = 0;

            $(this).closest('tr').remove();

            $( ".final-tprice" ).each(function() {
                total_price += parseFloat($(this).text());
            });
            $('#total-price').val(total_price.toFixed(2));

            var removetocart = ($(this).closest('tr').find('#final_title').html() +"|"+ $(this).closest('tr').find('#final-qty').html()+",");

            var final_list = $('#getall').val();

            $('#getall').val(final_list.replace(removetocart,''));

            if($('#getall').val() == ''){

              $("#btn-totalcart").attr("disabled",true);
              $("#btn-cancelcart").attr("disabled",true);
            }

          });

          var code = (product_title+"|"+qty);
          var getval = $('#getall').val();

          $('#getall').val(getval + code+",");

          $("#btn-totalcart").removeAttr("disabled");
          $("#btn-cancelcart").removeAttr("disabled");

          $('.cart_regcode').removeAttr('disabled');
          $('.choose_type').removeAttr('disabled');
          
          
    });


  $('#btn-totalcart').on('click', function (event){
    event.preventDefault();

      var final_set = $('#getall').val();
      $('#getall').val(final_set);
     // $('#getall').val(final_set.slice(0, -1));

      var data = $('#form-validate-cart').serialize();

      var code = $('#regcode').val();
      var type = $('input[name=radioGroup]:checked').val(); 
      // alert(code);

      if(type == 1 && code == '') {
        $('.help-inline-error').css('display','block');
      } else {
        $('.help-inline-error').css('display','none');
        
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        setTimeout(function () {
          waitingDialog.hide();
        }, 3000);

                  $.ajax({
                        type : 'POST',
                        url  : 'validate_tangible',
                        data : data,
                        datatype:'json',
                        success :  function( msg )
                        { 

                         var msgDone = JSON.parse(msg);
                           console.log(msgDone);

                          if(msgDone.RC == ''){
                              $('#selinvpaymenttype option[value="ECASH"]').hide();
                            }
                           
                          if(msgDone.S == 1){

                            $('#container-cart').empty();

                            if(msgDone.UT == 1){

                                $('#container-cart').append("<section class='col-md-10 well'>"+
                                  ''+"<h3>Cart Summary</h3>"+
                                  ''+"<table class='table table-bordered'>"+
                                  ''+"<thead><tr><th colspan='4'><font color='#4892e5'>Regcode: "+ msgDone.RC +"</font><br><font color='#4892e5'>Account Name: "+ msgDone.PN +"</font><br><font color='#4892e5'>Account Type: "+ msgDone.CA +"</font><br><font color='#4892e5'>Discount Rate on SRP: "+ msgDone.DC +"</font></th></tr></thead>"+
                                  ''+"<thead><tr><th>Qty</th><th>Product</th><th>SRP</th><th>Discounted Price</th></tr></thead>"+
                                  ''+"<tbody id='cart-content'>"+
                                  ''+"</tbody>"+
                                  ''+"<tbody id='cart-sum'>"+
                                  ''+"</tbody>"+
                                  ''+"</table>"+
                                  ''+"<button class='btn btn-primary animated bounceIn delay125s pull-right' id='btn-payout'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>&nbsp;Distribute Product</button><a href='<?php echo base_url();?>Products/ups_tangible_products' class='btn btn-default animated bounceIn delay75s pull-right' style='margin-right: 5px;'><span class='glyphicon glyphicon-remove' aria-hidden='true'>Cancel</a>"+
                                  ''+"</section>");

                                for (i = 0; i < msgDone.cart.length; i++) { 
                                      
                                      $('#cart-content').append(
                                        "<tr><td scope='row'>"+
                                        msgDone.cart[i].quantity+
                                        "</td><td scope='row'>"+
                                        msgDone.cart[i].product_desc+
                                        "</td><td scope='row'>"+
                                        msgDone.cart[i].SRP+
                                        "</td><td scope='row'>"+
                                        parseFloat(msgDone.cart[i].price).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,")+
                                        "</td></tr>");   
                                }

                                $('#cart-sum').html("<tr><td><span class='label label-danger'><b>"+msgDone.TI+" item/s</b></span></td><td colspan='2' scope='row' style='text-align: right'><font color='#FF0000'><b>Total Amount: </b></font></td><td scope='row'>"+ parseFloat(msgDone.TP).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,") +"</td></tr>");

                            }else{

                                $('#container-cart').append("<section class='col-md-10 well'>"+
                                  ''+"<h3>Cart Summary</h3>"+
                                  ''+"<table class='table table-bordered'>"+
                                  ''+"<thead><tr><th colspan='5'><font color='#4892e5'>SOLD TO: "+ msgDone.PN +"</font></th></tr></thead>"+
                                  ''+"<thead><tr><th>Qty</th><th>Product</th><th>Points</th><th>Discount</th><th>Price</th></tr></thead>"+
                                  ''+"<tbody id='cart-content'>"+
                                  ''+"</tbody>"+
                                  ''+"<tbody id='cart-sum'>"+
                                  ''+"</tbody>"+
                                  ''+"</table>"+
                                  ''+"<button class='btn btn-primary animated bounceIn delay125s pull-right' id='btn-payment' data-toggle='modal' data-target='#modalPaymentMode'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>&nbsp;Confirm</button><a href='<?php echo base_url();?>Products/hub_products' class='btn btn-default animated bounceIn delay75s pull-right' style='margin-right: 5px;'><span class='glyphicon glyphicon-remove' aria-hidden='true'>Cancel</a>"+
                                  ''+"</section>");

                                for (i = 0; i < msgDone.cart.length; i++) { 
                                      if(msgDone.cart[i].prod_code=='UPSWEL0015')msgDone.cart[i].discount=msgDone.cart[i].price * 0.5;
                                      $('#cart-content').append(
                                        "<tr><td scope='row'>"+
                                        msgDone.cart[i].quantity+
                                        "</td><td scope='row'>"+
                                        msgDone.cart[i].product_desc+
                                        "</td><td scope='row'>"+
                                        msgDone.cart[i].pv+
                                        "</td><td scope='row'>"+
                                        msgDone.cart[i].discount+
                                        "</td><td scope='row'>"+
                                        parseFloat(msgDone.cart[i].price).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,")+
                                        "</td></tr>");    
                                }

                                $('#cart-sum').html("<tr><td><span class='label label-danger'><b>"+msgDone.TI+" item/s</b></span></td><td colspan='3' scope='row' style='text-align: right'><b>Total Price: </b></td><td scope='row'>"+ parseFloat(msgDone.TP).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,") +"</td></tr>"+
                                  "<tr><td colspan='4' scope='row' style='text-align: right'><b>Total Discount: </b></td><td scope='row'>"+msgDone.TD+"</td></tr>"+
                                  "<tr><td colspan='4' scope='row' style='text-align: right'><font color='#FF0000'><b>Total Amount: </b></font></td><td scope='row'>"+ parseFloat(msgDone.AD).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,") +"</td></tr>"+
                                  "<tr><td colspan='4' scope='row' style='text-align: right'><font color='#4892e5'><b>Total Earned Points: </b></font></td><td scope='row'>"+msgDone.TPV+"</td></tr>");  
                            }

                          }else{
                            console.log(final_set);
                            //alert(msgDone.M);
                          $('#alertCart').show();
                          $('#alertCart').html("<span><strong>"+msgDone.M+"</strong></span>");
                          $('#alertCart').delay(3000).fadeOut();
                            //location.reload();
                          }


                        $('#btn-payout').on('click',function(){

                            //$('#modalPaymentMode').modal('toggle');
                            // $('#btn-payout').prop('disabled', true);
                            $("#btn-payout").attr("disabled",true);
             

                              // waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
                              //   setTimeout(function () {
                              //     waitingDialog.hide();
                              //   }, 3000);

                              var items = "";
                              for (i = 0; i < msgDone.cart.length; i++) {
                                  items += msgDone.cart[i].prod_code+'|'+msgDone.cart[i].quantity+',';
                              }
                              var cart = items.slice(0, -1);
                              var purchaser_regcode = msgDone.RC;
                              var payment_type = $('#selinvpaymenttype').val();

                              waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
                                setTimeout(function () {
                                  waitingDialog.hide();
                                }, 3000);

                              $.ajax({
                                    type : 'POST',
                                    url  : 'confirm_tangible',
                                    data : {cart:cart,regcode:purchaser_regcode,payment_type:payment_type},
                                    datatype:'json',
                                    success :  function( msg )
                                    { 

                                      var msgDone = JSON.parse(msg);
                                       console.log(msgDone);

                                      $('#modalPaymentMode').modal('show');                                     
                                      if(msgDone.S == 1){

                                      $("#modalhead").html('<button type="button" id="cartpaymentmodal" class="close closeCartPaymentmodal">&times;</button><h4 class="modal-title"><label id="lblMessage"></label></h4>'); 
                                        
                                        if(msgDone.PM == null){
                                            $("#modalbody").html('<div class="alert alert-info" id="receiptAlert" style="display: block;"><p><strong>BRANCH NAME:</strong>&nbsp;<label id="lblPN"></label></p><p><strong>TRANSACTION NUMBER:</strong>&nbsp;<a id="lblTN" href="#"></a></p><p><small>Click transaction number to download reciept.</small></p></div>'); 
                                        }else{
                                            $("#modalbody").html('<div class="alert alert-info" id="receiptAlert" style="display: block;"><p><strong>CLIENT NAME:</strong>&nbsp;<label id="lblPN"></label></p><p><strong>PAYMENT METHOD:</strong>&nbsp;<label id="lblPM"></label></p><p><strong>TRANSACTION NUMBER:</strong>&nbsp;<a id="lblTN" href="#"></a></p><p><small>Click transaction number to download reciept.</small></p></div>'); 
                                        }
                                        
                                      $('#modalfooter').css('display','none');
                                        document.getElementById('lblPN').innerHTML = msgDone.PN;
                                        if(msgDone.PM != null){ document.getElementById('lblPM').innerHTML = msgDone.PM; }
                                        document.getElementById('lblMessage').innerHTML = "<span class='glyphicon glyphicon-ok-sign' aria-hidden='true'></span>&nbsp;"+msgDone.M;
                                        document.getElementById('lblTN').innerHTML = msgDone.TN;
                                        document.getElementById("lblTN").href = msgDone.receiptURL;
                                        document.getElementById("lblTN").target = "_blank";

                                          $('.closeCartPaymentmodal').click(function() {
                                            $('#modalPaymentMode').modal('toggle');
                                            waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
                                            window.location.href = '<?php echo BASE_URL()?>Products';
                                          return false;
                                          });

                                      }else{
                                      $("#modalhead").html('<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"><label id="lblMessage"></label></h4>'); 
                                      $("#modalbody").html('<div class="alert alert-danger-customized" style="opacity: none!important;"><p>'+ msgDone.M +'<br>Please try again.</p></div>'); 
                                      $('#modalfooter').css('display','none');
                                      document.getElementById('lblMessage').innerHTML = "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>&nbsp;Purchased Failed";
                                      }

                                      // $('#btn-payout').prop('disabled', false);
                                      $("#btn-payout").removeAttr("disabled");
          
                                    }

                                });

                        }); 

                        }

                      });
        }
    });

  $(document).ready(function(){
      var currentPage = 1;
      var pageSize = $("#imagelimit").text();
      var itotalcount = $("#totalcount").text();

      showPage = function(page) {
          $(".content").hide();
          $(".content").each(function(n) {
              if (n >= pageSize * (page - 1) && n < pageSize * page)
                  $(this).show();
          });        
      }
      
        if(currentPage==1){
            $("#next").removeClass('disabled');
            $("#prev").addClass('disabled');
        }else if(currentPage==itotalcount){
            $("#prev").removeClass('disabled');
            $("#next").addClass('disabled');
        }else{
          $("#next").removeClass('disabled');
          $("#prev").removeClass('disabled');
        }

        showPage(currentPage);

      $("#pagin li a").click(function() {
        var id = ($(this).attr('id'));
        if(id == 'prev'){
          if(currentPage>1){
            currentPage-=1;
          }
        }else if(id == 'next'){
          if(currentPage<itotalcount){
            currentPage++;
          }
        }else{
          currentPage = parseInt($(this).text());
        }

        if(currentPage==1){
            $("#next").removeClass('disabled');
            $("#prev").addClass('disabled');
        }else if(currentPage>itotalcount){
            $("#prev").removeClass('disabled');
            $("#next").addClass('disabled');
        }else{
          $("#next").removeClass('disabled');
          $("#prev").removeClass('disabled');
        }
          showPage(currentPage); 

      });
   });
  </script>

  <script type="text/javascript">
  $(document).ready(function(){
      var tpcurrentPage = 1;
      var tppageSize = $("#tp_imagelimit").text();
      var tpitotalcount = $("#tp_totalcount").text();

      tpshowPage = function(tppage) {
          $(".tpcontent").hide();
          $(".tpcontent").each(function(tpn) {
              if (tpn >= tppageSize * (tppage - 1) && tpn < tppageSize * tppage)
                  $(this).show();
          });        
      }
      
        if(tpcurrentPage==1){
            $("#tp_next").removeClass('disabled');
            $("#tp_prev").addClass('disabled');
        }else if(tpcurrentPage==tpitotalcount){
            $("#tp_prev").removeClass('disabled');
            $("#tp_next").addClass('disabled');
        }else{
          $("#tp_next").removeClass('disabled');
          $("#tp_prev").removeClass('disabled');
        }

        tpshowPage(tpcurrentPage);

      $("#tp_pagin li a").click(function() {
        var id = ($(this).attr('id'));
        if(id == 'tp_prev'){
          if(tpcurrentPage>1){
            tpcurrentPage-=1;
          }
        }else if(id == 'tp_next'){
          if(tpcurrentPage<tpitotalcount){
            tpcurrentPage++;
          }
        }else{
          tpcurrentPage = parseInt($(this).text());
        }

        if(tpcurrentPage==1){
            $("#tp_next").removeClass('disabled');
            $("#tp_prev").addClass('disabled');
        }else if(tpcurrentPage>tpitotalcount){
            $("#tp_prev").removeClass('disabled');
            $("#tp_next").addClass('disabled');
        }else{
          $("#tp_next").removeClass('disabled');
          $("#tp_prev").removeClass('disabled');
        }
          tpshowPage(tpcurrentPage); 

      });
   });

  </script>

  <script>
  // ticketing
  $('.required').blur(function() {
      var empty_flds = 0;
      $(".required").each(function() {
          if(!$.trim($(this).val())) {
              empty_flds++;
          }    
      });

    if (empty_flds) { 
        $('#btnBookFlights').attr("disabled",true);
    } else {
        $('#btnBookFlights').removeAttr("disabled");
    }

  });
  </script>

  <script type="text/javascript"> //jorel
  $("#CCTOclear").on('click',function(){
       $("#inputCCTOAmount").val("");
       $("#inputCCTOAmount").removeAttr("readonly");
       $("#inputCCTOpaymenttype").attr("disabled",true);
       $("#inputCTTOFundtype").val("");
       $("#inputCCTOpaymenttype").val("");
       $(".alert-creditcard").hide();
       $(".alert-creditcard-validation").hide();
  });

  $(document).ready(function(){
    $('#inputCCTOpaymenttype').change(function(){
        var paymenttype = $("#inputCCTOpaymenttype").val()
        var net = $("#inputCCTOAmount").val()
        var totalprice = parseFloat(net) + (parseFloat(net) * 0.055);
        if(paymenttype == 1){
            $('.alert-creditcard').show();
            $('.alert-creditcard').html("<i><font color='red'>Note:</font></i>" +
            " Credit card payments will be charged with an Web Admin Fee of 5.5% on total price (Php"+ parseFloat(net).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g,"$1,") + ")<br>" +
            " Total Amount Due: <font color='red'><u><b>Php"+  Math.round(totalprice*Math.pow(10,2))/Math.pow(10,2) +"</b></font></u>"+"<br><br><i><font color='red'>Disclaimer:</font></i><br>Upon clicking submit, you agree to the following:<ul><li>I certify that as the regcode owner, the credit/debit card to be used for this payment method is under my name.</li><li>I agree that this shall not be used in a manner that resembles a cash advance, remittance encashment or any other unauthorized or fraudulent mean.</li></ul>");
            $("#inputCCTOAmount").attr("readonly",true);
        }

    });
  });

  $(document).ready(function(){
      $('#inputCCTOAmount').change(function(){
          var x = $('#inputCCTOAmount').val().replace(/,/g, '');
          if(x > 50000){
            document.getElementById("inputCCTOpaymenttype").disabled = true;
            $('.alert-creditcard-validation').show();
            $('.alert-creditcard-validation').html("<span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> You have entered greater than 50,000");
      }else{
          $(".alert-creditcard-validation").css('display','none');
          document.getElementById("inputCCTOpaymenttype").disabled = false;
      }
      });
  });

  $(document).ready(function(){

    $('#frmBuycodes').on('submit',function(){
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    });
  });

  $(document).ready(function(){
    $('.closeCCTOmodal').click(function() {
      $('#modalBDOframe').modal('hide');
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
      window.location.href = '<?php echo BASE_URL()?>fundtransfer/creditcard_topup';
    return false;
    });
});

    $('.closeDragonPaymodal').click(function() {
      $('#modalDragonpayframe').modal('hide');
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
      // window.location.href = '<?php echo BASE_URL()?>fundtransfer/dragonpay_topup';
      window.location.href = window.location.href;
    // document.getElementById("inputAmount").value = '';
    // document.location.reload();
    return false;
    });


  </script>

  <script type="text/javascript">
    $(document).ready(function() {
        $("#Agreementiframe").attr("src", "<?php echo BASE_URL()?>fundtransfer/terms_redir?d="+ $("#inputAgreeURL").val());
        $('#modalAgreementframe').modal({show:true});
    });

    $(document).ready(function(){
      $('.closeAgreementmodal').click(function() {
        $('#modalAgreementframe').modal('hide');
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        window.location.href = '<?php echo BASE_URL()?>fundtransfer';
      return false;
      });
    });

  </script>
  <script>
    function closeIframe() {
    var iframe = document.getElementById('Agreementiframe');
    $('#modalAgreementframe').modal('hide');
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    iframe.parentNode.removeChild(iframe);
    window.location.href = '<?php echo BASE_URL()?>fundtransfer/creditcard_topup';
    }  

    $(document).ready(function(){
      $('#frmUploadReq').on('submit',function(){
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
      });
    }); 
  </script>
  <script type="text/javascript">
  $(document).ready(function(){
    $('.top').click(function() {
        var data = [];
        var index = $(this).index('.highlight');
        $('.prod_row').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        console.log(data);
        var pcode = data[0];
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
      window.location.href = '<?php echo BASE_URL()?>mlm/highlighted_prod/0/'+pcode;
  return false;
    });
  });

  $(document).ready(function(){
    $('.rating').click(function() {
        var data = [];
        var index = $(this).index('.highlight');
        $('.prod_row').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        console.log(data);
        var pcode = data[0];
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
      window.location.href = '<?php echo BASE_URL()?>mlm/highlighted_prod/1/'+pcode;
  return false;
    });
  });

  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      var clientformdata = $("#inputPackageInfo999").val();
      var packageformdata = $("#inputHidPackageInfo999").val();
      //console.log(clientformdata);
        $("#buycodesAgreementiframe").attr("src", "<?php echo BASE_URL()?>Onlineshop/terms_redir?d="+ $("#inputAgreeURL").val());
        //$("#buycodesAgreementiframe").attr("src", "<?php echo BASE_URL()?>onlineshop/terms_redir?d="+ $("#inputAgreeURL").val() + "&f=" + clientformdata + "&h=" + packageformdata);
        $('#modalBuycodesAgreementframe').modal({show:true});
    });

    $(document).ready(function(){
      $('.closeBuycodesAgreementmodal').click(function() {
        $('#modalBuycodesAgreementframe').modal('hide');
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        window.location.href = '<?php echo BASE_URL()?>Onlineshop';
      return false;
      });
    });

    function closeIframeBuycodes() {
    var iframe = document.getElementById('buycodesAgreementiframe');
    var clientformdata = $("#inputPackageInfo999").val();
    var packageformdata = $("#inputHidPackageInfo999").val();
    $('#modalBuycodesAgreementframe').modal('hide');
   // waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    iframe.parentNode.removeChild(iframe);
    var url = '<?php echo BASE_URL()?>Onlineshop/creditcardpayment';
    var form = $('<form action="' + url + '" method="post">' +
      '<textarea name="creditcardpaymentdata" id="creditcardpaymentdata" style="display:none;">' + clientformdata + '</textarea>' +
      '<textarea name="inputPackageValue" id="inputPackageValue" style="display:none;">' + packageformdata + '</textarea>' +
      '<input type="hidden" name="paymentform" value="BDOCREDITCARD"/>' +
      '</form>');
    $('body').append(form);
    form.submit();
    }  
    
  </script>

  <script>
  $(document).ready(function(){
    $("#myCategory li").click(function() {
        //alert($(this).text());
        var category = $(this).text();
         //window.location.href = '<?php echo BASE_URL()?>online_shop2/buy_products/'+category;
    });
  });
  </script>
  <script type="text/javascript">
    $('#todayAndUpdatepicker').appendDtpicker({
      "dateOnly": true,
      "futureOnly": true,
      "dateFormat": "YYYY/MM/D"
    });

    $('#todayAndUpdatepicker2').datepicker({
      // minDate : -15,
      // maxDate : +15,
      dateFormat : "mm/dd/yy",
      
    });
    // $('#inputDueDate1').datepicker({
    //   dateFormat : "mm/dd/yy",
    // });
  </script>
  <script>
  $(document).ready(function(){

  var dropdown1 = $('#selCategoryCTPL');
  var dropdown2 = $('#selMVtypeCTPL');
  var dropdown3 = $('#selTenureCTPL');
  dropdown1.empty();
  var radio ;
  var items = <?php echo json_encode($result2,true); ?>
//console.log(items);
//var items2 = {'car':['lambo','gtr'],'motorcycle':['suzuki']};

      $("#radiodiv").append('<label class="radio-inline" style="padding-left: 0px;"><b>Registration Type:</b></label>');
      //for (var i=0;i<items.length;i++){
      for(i=items.length-1;i>=0;i--){  
           $("#radiodiv").append('<label class="radio-inline"><input type="radio" name="rdItem" id="rdItem" value="'+ i +'" />' + items[i]['Category_name']  + '</label>');
      }

        $('#frmFederal input:radio').on('change', function() {

          var myCategory = $('input[name=rdItem]:checked', '#frmFederal').val(); 

            if(myCategory == 0){
                // alert('renew');
                //$("#input_plateno,#input_mvfileno,#input_engineno,#input_chassisno").removeAttr('disabled','disabled');
                $("#input_plateno,#input_mvfileno,#input_engineno,#input_chassisno").removeAttr('disabled','disabled');
                $("#selTenureCTPL").val("");
                $("#selTenureCTPL").append('<option value="" disabled selected>Select Vehicle Type</option>');
                $("#formInception1").css('display','none');
                $("#input_month,#input_year,#selTenureCTPL").attr('disabled',true);
                $("#formInception2").css('display','block');
                $("#input_yrmodel,#input_bodytype,#input_company,#input_bodymake,#input_bodycolor,#input_capacity,#input_weight,#input_assuredname,#input_assuredemail,#input_assuredtin,#input_assuredaddress,#btn_submit_federal").removeAttr('disabled','disabled');
            } else{
               // alert('new');
                $("#input_engineno,#input_chassisno,#input_month,#input_year").removeAttr('disabled','disabled');
                $("#selTenureCTPL").val("");
                $("#selTenureCTPL").append('<option value="" disabled selected>Select Vehicle Type</option>');
                $("#selTenureCTPL,#input_plateno,#input_mvfileno,#input_inceptiondate").attr('disabled',true); //#input_plateno,#input_mvfileno,
                $("#formInception2").css('display','none');
                $("#formInception1").css('display','block');
                $("#input_yrmodel,#input_bodytype,#input_company,#input_bodymake,#input_bodycolor,#input_capacity,#input_weight,#input_assuredname,#input_assuredemail,#input_assuredtin,#input_assuredaddress,#btn_submit_federal").removeAttr('disabled','disabled');
            }

          $("#yearspan").val(items[this.value]['Yearspan']);

          $("#selMVtypeCTPL").removeAttr('disabled');
          dropdown2.empty();
          var option2 = '';
          dropdown2.append('<option value="" disabled selected>Select Premium Type</option>');

          for (var i=0;i<items[this.value]['premium_list'].length;i++){
              option2 += '<option value="'+ items[this.value]['premium_list'][i]['PremiumType'] + '|' + items[this.value]['premium_list'][i]['Premium_description'] + '" data-id="' +  i +'">' + items[this.value]['premium_list'][i]['Premium_description']  +'</option>';
          }
        
          $("#selTenureCTPL").removeAttr('disabled');

          dropdown2.append(option2);
       
        });
       
        dropdown2.on('change', function() {
         dropdown3.empty();
         var option3 ="";
         dropdown3.append('<option value="" disabled selected>Select Vehicle Type</option>');
         var index = $(this).children('option:selected').data('id');
         var list  = items[$("#rdItem:checked").val()]['premium_list'][index]['MV_list'];
        for(var i = 0 ; i<list.length;i++){
          option3+="<option id='optList' value='" + list[i]['mvcode'] + '|' + list[i]['mvdesc']  + "'>" + list[i]['mvdesc']   + "</option>";
        }
        dropdown3.append(option3);
       
      });


  });

  </script>
  <script>
  $(document).ready(function(){
      $('#input_plateno').on('keyup', function() {
        idPLATEno = $('#input_plateno').val();
        cDate = $('#currentdate').val();

        var regexp = /\d$/;
        var thenum = idPLATEno.match(regexp)[0];
        // alert(thenum);

        // var lastChar = idPLATEno.substr(idPLATEno.length - 1);

        var day;
        switch(parseInt(thenum)) {
            case 1:
                day = "January";
                break;
            case 2:
                day = "February";
                break;
            case 3:
                day = "March";
                break;
            case 4:
                day = "April";
                break;
            case 5:
                day = "May";
                break;
            case 6:
                day = "June";
                break;
            case 7:
                day = "July";
                break; 
            case 8:
                day = "August";
                break;  
            case 9:
                day = "September";
                break;    
            case 0:
                day = "October";
                break;    
            default:
                day = "";
        }

        $('#input_inceptiondate').val(day + ' ' +cDate);
        $('#input_expirydate').val(day + ' ' +(parseInt(cDate) + parseInt($('#yearspan').val())));


      });


      $('#input_month,#input_year').on('change', function() {
        monthOpt = $('#input_month').val();
        yearOpt = $('#input_year').val();

        var day;
        switch(parseInt(monthOpt)) {
            case 01:
                day = "January";
                break;
            case 02:
                day = "February";
                break;
            case 03:
                day = "March";
                break;
            case 04:
                day = "April";
                break;
            case 05:
                day = "May";
                break;
            case 06:
                day = "June";
                break;
            case 07:
                day = "July";
                break;
            case 08:
                day = "August";
                break; 
            case 09:
                day = "September";
                break;  
            case 10:
                day = "October";
                break;    
            case 11:
                day = "November";
                break;    
            case 12:
                day = "December";
                break;   
            default:
                day = "";
        } 

        if($('#input_month').val().length != '' && $('#input_year').val().length != ''){
            $('#input_expirydate').val(day + ' ' +(parseInt(yearOpt) + parseInt($('#yearspan').val())));
        }

      });


  });
  </script>
<script>
$('#input_assuredaddress').on('keyup',function(){
  if($("#input_yrmodel,#input_bodytype,#input_company,#input_bodymake,#input_bodycolor,#input_capacity,#input_weight,#input_assuredname,#input_assuredemail,#input_assuredtin,#input_assuredaddress").val() == ''){
    alert('Some fields are empty');
  }else{
    $("#btn_submit_federal").removeAttr('disabled','disabled');
  }

});
</script>
<script>
  $(document).ready(function() {
      $('#modalFederal').modal({show:true});
  });

$(document).ready(function(){
    $('.closeFederalmodal').click(function() {
      $('#modalBDOframe').modal('hide');
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
      window.location.href = '<?php echo BASE_URL()?>Einsurance/ctpl_insurance';
    return false;
    });
});
</script>
<script>
    $("#frmOTPverification").on('submit', function() {
        $('#modalOTP').modal('toggle');
        waitingDialog.show('Verifying please wait..', {dialogSize: 'sm', progressType: 'primary'});
        // setTimeout(function () {
        //   waitingDialog.hide();
        // }, 3000);

         var data = $(this).serialize();
            $.ajax({
                  type : 'POST',
                  url  : 'otp_verify',
                  data : data,
                  datatype:'json',
                  success :  function( msg )
                  { 

                   var msgDone = JSON.parse(msg);
                     console.log(msgDone);

                   $('#modalOTP').modal('show');        
                   if(msgDone.S == 1){ 
                      $(".modal-title").html("");
                      $(".modal-body").html("");
                      $(".modal-title").html('<h4 class="modal-title"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="font-size: large;"></span> '+ msgDone.M +'</h4>'); 
                      $(".modal-body").html('<div class="alert alert-success"><b>'+ msgDone.M +'</b><br /><b>Transaction No.:</b>&nbsp;<a href="'+ msgDone.URL +'" target="_blank">'+ msgDone.TN +'</a><br/><small>(Click transaction number to download reciept.)</small></div>'); 
                      setTimeout(function () {
                        waitingDialog.hide();
                      }, 200);
                   }else{
                      $('#otpMessage').removeAttr('style');
                      $('#otpMessage').attr('style');
                      $('#otpMessage').css({'color': '#a94442','background-color': '#f2dede', 'border-color': '#ebccd1', 'padding': '15px', 'margin-bottom': '20px', 'border': '1px solid transparent', 'border-radius': '4px'});      
                      $('#otpMessage').text(msgDone.M);    
                      $('#vcode').val("");  
                      setTimeout(function () {
                        waitingDialog.hide();
                      }, 1000);           
                   }

                  }

                });
                
                return false;
    });               
</script>
<script>
// update by nhez 03/21/2017
$('#frmAccountSettlement').on('submit',function(){
  waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
});

$('.closeConfirmAccountSettlementmodal').click(function() {
  $('#myModal_confirmAccountSettlement').modal('hide');
  waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
  window.location.href = '<?php echo BASE_URL()?>Account_Settlement/';
return false;
});

$('.confirmAccountSettlement').on('click', function( event ){
event.preventDefault();
var data = [];
var index = $(this).index('.voucheritems');
$('.prod_row').eq(index).find('td').each(function(){
  console.log(index);
  data.push($(this).text());
});
  console.log(data);

$('#as_trackno').val(data[1]);
$('#as_amount').val(data[3]);
$('#myModal_confirmAccountSettlement').modal('show');
$(".modal-title").html("");
$(".modal-title").html('<h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true" style="font-size: large;"></span> Account Settlement for Year '+ data[0] +'</h4>'); 

});

</script>
<script>
  $(document).ready(function(){

  var dropdown1 = $('#selInsuranceFederal');
  var dropdown2 = $('#inputCoverage');
  var items = <?php echo json_encode($result2,true); ?>
  //console.log(items);

    dropdown1.empty();
    var option1 = '';
    dropdown1.append('<option value="" disabled selected>Please Choose your Policy Number</option>');

    for (var i=0;i<Object.keys(items).length;i++){
       option1 += '<option value="'+ Object.keys(items)[i]  + '" data-id="' +  items[i]['option_id'] +'">' + items[i]['option_name']  + '</option>';
    }
    dropdown1.append(option1);

    dropdown1.on('change', function() {
        //console.log(items[this.value]['option_id']);
        dropdown2.removeAttr('disabled');
        $('#frmFederal input').removeAttr('disabled');
        dropdown2.empty();
        var option2 = '';
        dropdown2.append('<option value="" disabled selected>Choose Coverage</option>');
        for (var i=0;i<items[this.value]['coverage_details'].length;i++){
          option2 += '<option value="'+ items[this.value]['coverage_details'][i]['coverage'] + '|' + items[this.value]['coverage_details'][i]['coverage_name'] + '|' + items[this.value]['coverage_details'][i]['amount']  + '">' + items[this.value]['coverage_details'][i]['coverage_name']  + '</option>';
        }

    dropdown2.append(option2);

});

  
});

$('.removeVoucherFPG').click(function() {
  waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
  window.location.href = '<?php echo BASE_URL()?>Einsurance/federal_insurance';
return false;
});

$('#frmFederalVoucher').on('submit',function(){
  waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
});

</script>

<script>

$('#origin1').change(function(){

    var selCountry = $("#origin1").val();
    var dropdownOrigin = $('#origin');
    var origin = $('#origin2');

      $('#origin,#origin2').attr('disabled','disabled');
      $('#origin,#origin2').empty();
      $('#origin').append('<option value="" disabled selected>---Select City---</option>');
      $('#origin2').append('<option value="" disabled selected>---Airport---</option>');

      $("#spinAnimation").removeClass('fa fa-map-signs');
      $("#spinAnimation").addClass('fa fa-spinner fa-spin');
      $.ajax({
            type : 'POST',
            url  : 'fetch_airlines',
            data : {selCountry:selCountry},
            datatype:'json',
            success :  function( msg )
            { 
             var items = JSON.parse(msg);
              // console.log(items);
                  $("#spinAnimation").removeClass('fa fa-spinner fa-spin');
                  $("#spinAnimation").addClass('fa fa-location-arrow');
                  dropdownOrigin.removeAttr('disabled');
                  dropdownOrigin.empty();
                  var option2 = '';
                  dropdownOrigin.append('<option value="" disabled selected>---Select City---</option>');
                  for (var i=0;i<items.length;i++){
                    option2 += '<option value="'+ Object.keys(items)[i] +'">' + items[i]['City']  + '</option>';
                  }

              dropdownOrigin.append(option2);
              dropdownOrigin.on('change', function() {
               // console.log(items[this.value]['Airports']);
                  origin.removeAttr('disabled');
                  origin.empty();
                  var option3 = '';
                  origin.append('<option value="" disabled selected>---Select Airport---</option>');
                  for (var i=0;i<items[this.value]['Airports'].length;i++){
                    option3 += '<option value="'+ items[this.value]['Airports'][i]['Code'] + '|' + items[this.value]['Airports'][i]['Airport_Name'] + '">' + items[this.value]['Airports'][i]['Airport_Name']  + '</option>';
                  }

              origin.append(option3);

              });
          }
      });
      return false;
});


$('#destination1').change(function(){
    var selCountry = $("#destination1").val();
    var dropdownOrigin = $('#destination');
    var destination = $('#destination2');

      $('#destination,#destination2').attr('disabled','disabled');
      $('#destination,#destination2').empty();
      $('#destination').append('<option value="" disabled selected>---Select City---</option>');
      $('#destination2').append('<option value="" disabled selected>---Airport---</option>');

      $("#spinAnimation1").removeClass('fa fa-map-signs');
      $("#spinAnimation1").addClass('fa fa-spinner fa-spin');
      $.ajax({
            type : 'POST',
            url  : 'fetch_airlines',
            data : {selCountry:selCountry},
            datatype:'json',
            success :  function( msg )
            { 
             var items = JSON.parse(msg);
              // console.log(items);
                  $("#spinAnimation1").removeClass('fa fa-spinner fa-spin');
                  $("#spinAnimation1").addClass('fa fa-location-arrow');
                  dropdownOrigin.removeAttr('disabled');
                  dropdownOrigin.empty();
                  var option2 = '';
                  dropdownOrigin.append('<option value="" disabled selected>---Select City---</option>');
                  for (var i=0;i<items.length;i++){
                    option2 += '<option value="'+ Object.keys(items)[i] +'">' + items[i]['City']  + '</option>';
                  }

              dropdownOrigin.append(option2);
              dropdownOrigin.on('change', function() {
               // console.log(items[this.value]['Airports']);
                  destination.removeAttr('disabled');
                  destination.empty();
                  var option3 = '';
                  destination.append('<option value="" disabled selected>---Select Airport---</option>');
                  for (var i=0;i<items[this.value]['Airports'].length;i++){
                    option3 += '<option value="'+ items[this.value]['Airports'][i]['Code'] + '|' + items[this.value]['Airports'][i]['Airport_Name'] + '">' + items[this.value]['Airports'][i]['Airport_Name']  + '</option>';
                  }

              destination.append(option3);

              });
          }
      });
      return false;
});

$('#frmProceedSmartmoney').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});

  
$('#btnOTPSmartmoneyResend').click(function() {
  $(".resendingSmartmoneyOTPcode").css('display','block');
  var trackno = $("#transactionno").val();
  $.ajax({
        type : 'POST',
        url  : 'otp_smartmoney_resend',
        data : {trackno:trackno},
        datatype:'json',
        success :  function( msg )
        { 
        $(".resendingSmartmoneyOTPcode").css('display','none');
        $(".alert-warning").hide();
        
         var msgDone = JSON.parse(msg);
           console.log(msgDone);
  
         if(msgDone.S == 1){ 
          $('#otpMessage').removeAttr('style');
          $('#otpMessage').attr('style');
          $('#otpMessage').css({'color': '#3c763d','background-color': '#dff0d8', 'border-color': '#d6e9c6', 'padding': '15px', 'margin-bottom': '20px', 'border': '1px solid transparent', 'border-radius': '4px'});      
          $('#otpMessage').text(msgDone.M);    
         }else{
          $('#otpMessage').removeAttr('style');
          $('#otpMessage').attr('style');
          $('#otpMessage').css({'color': '#a94442','background-color': '#f2dede', 'border-color': '#ebccd1', 'padding': '15px', 'margin-bottom': '20px', 'border': '1px solid transparent', 'border-radius': '4px'});      
          $('#otpMessage').text(msgDone.M);                 
         }
          $('#otpMessage').delay(5000).fadeOut();
        }

      });
});

$('#btnOTPBaremiResend').click(function() {
  $(".resendingBaremiOTPcode").css('display','block');
  var trackno = $("#transactionno").val();
  $.ajax({
        type : 'POST',
        url  : 'otp_baremi_resend',
        data : {trackno:trackno},
        datatype:'json',
        success :  function( msg )
        { 
        $(".resendingBaremiOTPcode").css('display','none');
        $(".alert-warning").hide();
        
         var msgDone = JSON.parse(msg);
           console.log(msgDone);
  
         if(msgDone.S == 1){ 
          $('#otpMessage').removeAttr('style');
          $('#otpMessage').attr('style');
          $('#otpMessage').css({'color': '#3c763d','background-color': '#dff0d8', 'border-color': '#d6e9c6', 'padding': '15px', 'margin-bottom': '20px', 'border': '1px solid transparent', 'border-radius': '4px'});      
          $('#otpMessage').text(msgDone.M);    
         }else{
          $('#otpMessage').removeAttr('style');
          $('#otpMessage').attr('style');
          $('#otpMessage').css({'color': '#a94442','background-color': '#f2dede', 'border-color': '#ebccd1', 'padding': '15px', 'margin-bottom': '20px', 'border': '1px solid transparent', 'border-radius': '4px'});      
          $('#otpMessage').text(msgDone.M);                 
         }
          $('#otpMessage').delay(5000).fadeOut();
        }

      });
});


$('#btnOTPCebuanaResend').click(function() {
  $(".resendingCebuanaOTPcode").css('display','block');
  var trackno = $("#transactionno").val();
  $.ajax({
        type : 'POST',
        url  : 'otp_cebuana_resend',
        data : {trackno:trackno},
        datatype:'json',
        success :  function( msg )
        { 
        $(".resendingCebuanaOTPcode").css('display','none');
        $(".alert-warning").hide();
        
         var msgDone = JSON.parse(msg);
           console.log(msgDone);

         if(msgDone.S == 1){ 
          $('#otpMessage').removeAttr('style');
          $('#otpMessage').attr('style');
          $('#otpMessage').css({'color': '#3c763d','background-color': '#dff0d8', 'border-color': '#d6e9c6', 'padding': '15px', 'margin-bottom': '20px', 'border': '1px solid transparent', 'border-radius': '4px'});      
          $('#otpMessage').text(msgDone.M);    
         }else{
          $('#otpMessage').removeAttr('style');
          $('#otpMessage').attr('style');
          $('#otpMessage').css({'color': '#a94442','background-color': '#f2dede', 'border-color': '#ebccd1', 'padding': '15px', 'margin-bottom': '20px', 'border': '1px solid transparent', 'border-radius': '4px'});      
          $('#otpMessage').text(msgDone.M);                 
         }
          $('#otpMessage').delay(5000).fadeOut();
           
        }

      });
});

 $("#btnSubmitFR").click(function () {

    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

 });

 $("#btnSubmitFR").click(function () {

    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});


 });


  function ctplmasking() {
     MaskedInput({
        elm: document.getElementById('input_mvfileno'), // select only by id
        format: 'xxxx-xxxxxxxxxxx',
        separator: '-'
     });

     MaskedInput({
        elm: document.getElementById('input_assuredtin'), // select only by id
        format: '000-000-000-000',
        separator: '-'
     });
  }

  MaskedInput({
    elm: document.getElementById('inputYearYear'), // select only by id
    format: 'xxxx-xxxx',
    separator: '-'
  });

  // MaskedInput({
  //   elm: document.getElementById('inputmaskAccountNo'), // select only by id
  //   format: '000-00-000',
  //   separator: '-'
  // });

</script>




<script>
  // ## ECASH TO FOREX SCRIPT -- START

function buildTable(data) {
    var table = document.createElement("table");
    table.className="table table-bordered";
    table.setAttribute("id", "currtable");
    var thead = document.createElement("thead");
    var tbody = document.createElement("tbody");
    var headRow = document.createElement("tr");

    var x = 0;
    data.forEach(function(el){
      if(x == 0)
      {
        for (var o in el)
        {

        var th=document.createElement("th");
        th.appendChild(document.createTextNode(o));
        headRow.appendChild(th);
        
        }
        x++;
      }
    });
    thead.appendChild(headRow);
    table.appendChild(thead); 

    data.forEach(function(el) {
      var tr = document.createElement("tr");
      for (var o in el) {  
        var td = document.createElement("td");
        td.appendChild(document.createTextNode(el[o]))
        tr.appendChild(td);
      }
      tbody.appendChild(tr);  
    });

    table.appendChild(tbody);             
    return table;
}

window.onload = function() {
      
           $.ajax({
          url: "/Ecash_send/fetch_currencies",
          type: "POST",
          // data: parameters,
              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                 
                  // console.log(jsondata);

                  // console.log(jsondata.T_DATA);
                  
                  if(jsondata.S == 1){

                  waitingDialog.hide();

                  document.getElementById("content_table").appendChild(buildTable(jsondata.T_DATA));


                  // console.log(jsondata.T_DATA);

                  }
                  else
                  {
                    waitingDialog.hide();
                  }
              }
      });


      ctplmasking();     

}


   $("#checkcurrency").click(function () {

      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

           $.ajax({
          url: "/Ecash_send/fetch_currencies",
          type: "POST",
          // data: parameters,
              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                 
                  // console.log(jsondata);

                  // console.log(jsondata.T_DATA);
                  
                  if(jsondata.S == 1){

                  waitingDialog.hide();

                  document.getElementById("currtable").remove();

                  document.getElementById("content_table").appendChild(buildTable(jsondata.T_DATA));


                  // console.log(jsondata.T_DATA);

                  }
                  else
                  {
                    waitingDialog.hide();
                  }
              }
      });


});
 


   $("#checkbalance").click(function () {

      document.getElementById("currencybalafter").value = '';
      document.getElementById("ecashbalafter").value = '';

      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

      var currtype = $("#currtype").val();
      var inputAmountTransaction = $("#inputAmountTransaction").val();

      // var formData = new FormData($('#frmecashtoforex')[0]);
      var parameters = {currtype:currtype,inputAmountTransaction:inputAmountTransaction};


           $.ajax({
          url: "/Ecash_send/check_balanceafter_new",
          type: "POST",
          data: parameters,
          // data: formData,

              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                 
                  // console.log(jsondata);

                  // console.log(jsondata.T_DATA);
                  
                  if(jsondata.S == 1){

                  waitingDialog.hide();

                  document.getElementById("currate").value = jsondata.R;
                  document.getElementById("currencybalafter").value = jsondata.FA;
                  document.getElementById("ecashbalafter").value = jsondata.EC;

                  $("#checkbalancesuccess").html(jsondata.M);
                  $("#checkbalancesuccess").show();
                  $("#checkbalancefailed").hide();
                  $("#inputTpass").prop("disabled", false); 
                  $("#submitc").prop("disabled", false); 
                  }
                  else
                  {
                    waitingDialog.hide();

                  $("#checkbalancefailed").html(jsondata.M);
                  $("#checkbalancefailed").show();
                  $("#checkbalancesuccess").hide();
                  $("#inputTpass").prop("disabled", true); 
                  $("#submitc").prop("disabled", true); 
                  }
              }
      });


});


   $("#btnSubmitex").click(function () {

      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});


});

      $("#frmdragonpay_topup").submit(function () {

      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});


});
      


    $("#currtype").change(function () {
      var cur = '';
      var curba = '';

      cur = '1 ' + document.getElementById("currtype").value + ' = PHP :';
      curba = document.getElementById("currtype").value + ' Balance After:';

      $("#labelrate").html(cur); 
      $("#labelcurrba").html(curba); 

    });

    // ## ECASH TO FOREX SCRIPT -- END

</script>

<script>

$(document).ready(function() {

    $('#modalAnnouncementsframe').modal({show:true});
    $('#usersLocationUpdate').modal({show:true});
});

      $(document).ready(function(){
    $('.closeAnnouncementmodal').click(function() {
      $('#modalAnnouncementsframe').modal('hide');
    return false;
    });
});


  </script>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Notice</h4>
        </div>
        <div class="modal-body">
          <p>Message</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="aloading" class="btn btn-success acebuana" data-dismiss="modal">Proceed</button>
        </div>
      </div>
    </div>
</div>

<!-- <script>
$('.acebuana').click(function() {
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

    

    // window.location.href = '<?php echo BASE_URL() ?>ecash_payout/cebuana_payout';
    window.location.href = '<?php echo BASE_URL() ?>ecash_payout/cebuana_payout_activation';
    
    return false;
    waitingDialog.hide();
});

</script> -->


  </body>
</html>