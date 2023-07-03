<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>

<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-home"></i>
      </div>

      <div class="media-body">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
          <li>HOME</li>
        </ul>

        <h4>HOME</h4>
      </div>
    </div>
  </div>
                     
  <div class="contentpanel"  style="background:white">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="panel panel-default" style="padding:0px!important">
          <div class="panel-heading main-announcement" style="background-color:#FFC914;color:#FFFFFF;font-weight: bold;text-align: center;font-size: 22px;">
            <div class="marquee">
              <p>
                <i class="fa fa-bullhorn" aria-hidden="true"></i>
                TODAY'S ANNOUNCEMENTS: UNIFIED PRODUCTS AND SERVICES
              </p>
            </div>  
          </div>
            <div class="panel-body" style="padding:0px!important">
              <?php if ($this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx'): ?>
                  <!-- <div class="" style="text-align: center;">
                  <marquee behavior="scroll" direction="left" width="80%" onmouseover="this.stop();" onmouseout="this.start();">
                      <?php 
                if($this->user['CG'] =="UPS")
                  echo'<a href="https://support.unified.ph" target="UPS Support"><b><span class="text-danger">For your inquiries/concerns, please visit our Online Support at support.unified.ph</span> Click Here!</b></a>';
                else 
                    echo'<a href="https://support.globalpinoyremittance.com" target="GPRS Support"><b><span class="text-danger">For your inquiries/concerns, please visit our Online Support at support.globalpinoyremittance.com.</span> Click Here!</b></a>';
              ?>
                    </marquee>
                  </div> -->
              <?php endif ?>                 
                            
              <?php if ($this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx' && $this->user['R'] != 'BDO00001'): ?>
                <iframe src="https://mobilereports.globalpinoyremittance.com/portal/announcements/<?php echo $user['CG'] ?>" style="width:100%; height:630px;"></iframe>
              <?php endif ?>
            </div>
          </div>
        </div>
                 <!-- added by rene for location service -->
              <?php if($this->session->flashdata('updatelocationservice') )
                  {
                    echo '
                    <div class="modal fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" id="usersLocationUpdate">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <h5 class="modal-title" id="exampleModalLabel">Activate new feature by updating your shop details?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="showAllowLocation()" class="btn btn-secondary">Yes</button>
                            <button type="button"  data-dismiss="modal" class="btn btn-primary">No</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    ';
                  } 
                  ?>
        <?php if($this->session->flashdata('announcepopup') && $this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx' && $this->user['R'] != 'BDO00001'):?>  
          <?php if($user['USER_COUNT'] == 1 && $this->user['USER_KYC'] == "APPROVED") { ?>
            <?php if($user['CG'] == 'UPS')
              {
                echo'
                <script>
                    var myIndex = 0;
                    function Slide(next) {
                        var i;
                        var x = document.getElementsByClassName("mySlides");
                        for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";  
                        }
                        myIndex+=next;
                        if(myIndex<0)myIndex=(x.length-1);
                        if(myIndex>=x.length)myIndex=0;
                        x[myIndex].style.display = "block";    
                        
                    }
                    $(document).ready(function(){
                        try{Slide(0);}catch(e){}
                    });
                </script>
                <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
                ';
                $imageModal='
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/announcement/ups-announcement.jpg" style="width:100%; height:500px;">
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/advisory/first.jpg" style="width:100%; height:500px;">
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/advisory/fourth.jpg" style="width:100%; height:500px;">
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/advisory/fifth.jpg" style="width:100%; height:500px;">
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/advisory/sixth.PNG" style="width:100%; height:500px;">
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/advisory/smart_promo.jpg" style="width:100%; height:500px;">
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/advisory/adv_01.jpeg" style="width:100%">
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/advisory/adv_02.jpeg" style="width:100%">
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/advisory/adv_03.jpeg" style="width:100%">
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/advisory/Ecash_UPS_2018.jpg" style="width:100%">
                    <img class="mySlides w3-animate-opacity" src="https://mobilereports.globalpinoyremittance.com/assets/images/advisory/corporate-accounts.jpg" style="width:100%">
                    <iframe class="mySlides w3-animate-opacity" src="'.BASE_URL().'Announcement/coporate_list" style="width:100%; height:540px" frameborder="0"></iframe>';
                echo '
                    <div class="modal fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" id="modalAnnouncementsframe">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close closeAnnouncementmodal" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                '.$imageModal.'
                                <br/>
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr><td><div style="display:inline-block; cursor:pointer;" onclick="Slide(-1)">&#10094;&#10094;</div></td>
                                        <td align="right"><div style="display:inline-block; cursor:pointer;" onclick="Slide(1)" >&#10095;&#10095;</div></td></tr>
                                </table>
                                
                                
                            </div>
                        </div>
                    </div>
                    </div>';
              }
              else
              {
              $imageModal = 'https://storage.googleapis.com/v3onlinestore-bucket-main-01/0fedf5aa-1d0e-431e-af93-7e5cfcee1dab.jpg';
              $ModalLink = 'https://storage.googleapis.com/v3onlinestore-bucket-main-01/4ae97dbc-8d0e-4568-8122-93d450c919b3.jpg';
                echo'
                <div class="modal fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" id="modalAnnouncementsframe">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close closeAnnouncementmodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <img src="'.$imageModal.'" width="100%" alt="">
                        <div>
                        </br>
                        <center>
                            <a href="'.$ModalLink.'" target="_blank">
                            <button type="button" class="btn btn-info">View More</span></button>
                            </a>
                        </center>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                ';
              }
            ?>
          <?php } ?>
        <?php endif ?>

        <?php if (substr($user['R'],0,3) == 'GRM' || $API['R'] == 'F5880126' || $user['R'] == 'F9175006' || $user['R'] == 'G7979485' || $user['R'] == 'F1205575' || $user['R'] == 'F1145677' || $user['R'] == 'F1164754' || $user['R'] == 'F1198933' || $user['R'] == 'F5597768' || $user['R'] == '1234567'): ?>
            <img data-u="image" class="open-button" style="cursor: pointer;" onclick="openForm()" src="<?php echo BASE_URL()?>assets/images/hamegreen.svg" id="chat-open"/>
        <?php else: ?>
            <img data-u="image" class="open-button" style="cursor: pointer;" onclick="openForm()" src="<?php echo BASE_URL()?>assets/images/hame.svg" id="chat-open"/>
        <?php endif?>

        <div class="chat-popup" id="myForm" >
          <div action="/action_page.php" class="form-container" style="border-radius: 8px 8px 8px 8px;">
            <div class="modal-headers" style="border-radius: 8px 8px 0px 0px;">
              <span style="font-size: 20px; margin: 2% 0% 0% 2%; color: white;"><i class="glyphicon glyphicon-comment" style="font-size: 20px; margin: 2% 0% 0% 2%; color: white;"> </i> Messages</span>
              <span onclick="closeForm()" style="font-color: white; cursor: pointer" id="close" ><i class="glyphicon glyphicon-minus" style="font-size: 20px; margin-bottom: 50px"></i></span>
            </div>
            
            <h1 style="font-family: 'Lato';font-size: 12px;text-align: center;margin: 15px">Choose a support you want to connect.</h1>
            
            <center>
              <div class="btnpablo">
                <a href="https://support.unified.ph" target="_blank" class="ahovery">
                  <div class="row" id="btn2" style="border-radius: 8px 8px 0px 0px;">
                    <div class="col-md-1 col-sm-1 col-lg-1">
                      <span>
                        <img data-u="image" src="<?php echo BASE_URL()?>assets/images/supportz.png" style="width: 35px; float: left;"/>
                      </span>
                    </div>
                      
                    <div class="col-md-10 col-sm-10 col-lg-10" style="padding-top: 6px;">
                      <span style="color: black; font-size: 15px; font-family: 'Lato'; padding-left: 17px;">
                        Legacy Online Support
                      </span>
                    </div>
                  </div>
                </a>
              </div>
              
            </center>
            <div class="conversation" id="myconversation">
                <!-- Right -->
                <div class="bubble-right">
                   <div class="content-message">
                      <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit deserunt sint dicta vero tempore voluptatem quidem omnis, praesentium rerum laboriosam voluptas vitae dolorum quo voluptates sunt suscipit aliquid. Unde, voluptatum!</span>
                   </div>
                </div>
                <span class="time-stamp-right">Jun 5, 2022 - 10:30 AM</span>
                <!-- Left -->
                <span class="message-user-name"><b style="margin-top: 2px;"><img class="profile-s" src="http://localhost:8090/assets/images/photos/default_photo.png" alt=""> Kristine Salonga</b></span>
                <div class="bubble-left">
                   <div class="content-message">
                      <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde debitis temporibus repudiandae quam nisi rerum quo dolore quaerat quos nesciunt, sint ducimus ipsum, aliquam beatae commodi, consectetur cupiditate nemo! Rem.</span>
                   </div>
                </div>
                <span class="time-stamp-left">Jun 5, 2022 - 10:30 AM</span>
            </div>

            <div class="chat-input-container">
              <input type="text" placeholder="Enter your Message" class="chat-input" id="chat-input">
              <span class="send-chat" id="send-message" style="cursor: pointer"><i class="glyphicon glyphicon-send" style="margin: 5px 2px 0px 0px; color: white;"></i></span>
            </div>
          </div>
        </div>
      </div><!-- row -->
  </div>
</div>

<style>
  .profile-s{
    width: 20px;
    border-radius: 50%;
    border: 2px solid #5CB85C;
   }
  .content-message{
    width: auto;
    padding: 10px;
  }

  .content-message span{
    margin: 0%;
    text-align: left;
    text-align: justify;
  }

  .time-stamp-right{
    text-align: right; 
    margin-right: 8%;
    margin-bottom: 3%;
    color: #777777;
  }

  .time-stamp-left{
    text-align: left; 
    margin-left: 8%;
    margin-bottom: 3%;
    color: #777777;
  }

  .message-user-name{
    margin: 0% 0% 1% 7%;
    font-size: small;
  }
  .conversation{
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 280px;
    max-height: 280px;
    background-color: #FEF7EA;
    overflow-y: scroll;
    padding-top: 2%;
  }


  .conversation::-webkit-scrollbar {
    width: 10px;/* width of the entire scrollbar */
   }


  .conversation::-webkit-scrollbar-thumb {
    background-color: rgb(246,162,26, 0.2);  /* color of the scroll thumb */
    border-radius: 20px;       /* roundness of the scroll thumb */
  }
  
  .bubble-right{
    width: auto;
    max-width: 80%;
    min-width: 50.59px;
    margin-left: auto;
    margin-right: 8%;
    background-color: #F6A21A;
    border-radius: 15px 15px 0px 15px;
  }

  .bubble-left{
    width: auto;
    max-width: 80%;
    margin-left: 8%;
    margin-right: auto;
    background-color: #F6A21A;
    border-radius: 0px 15px 15px 15px;
    background-color: rgb(246,162,26, 0.2);
  }
  .send-chat{
    display: none;
    width: 30px;
    height: 30px;
    margin-top: 10px;
    border-radius:90%;
    background-color: #F6A21A;
    justify-content:center;
    opacity: 0.7;
    transition: 0.3s;
  }

  .send-chat:hover{
    opacity: 1;
  }

  
  .chat-input-container{
    display: flex;
    justify-content: center;
    flex-direction: row;
    width: 100%;
    background-color: #FEF7EA;
    height: 50px;
    right: 0px;
    bottom: 0px;
    position: relative;
    border-radius: 0px 0px 8px 8px;
  }
  .chat-input{
    width: 80%;
    height: 70%;
    margin:  auto 5px auto 0px;
    display: flex;
    border-radius: 13px;
    border: 1px solid #F6A21A;
    background-color: rgb(246,162,26, 0.2);
  }
   .chat-input[type=text]{
    padding-left: 15px;
   }

   .chat-input:focus{
    border: 2px solid #F6A21A;;
   }
  /* .chat-input::placeholder{
    padding-left: 10px;
  } */
  .panel-heading {
    padding: 0px 15px !important;
  }
  .open-button {
    padding: 16px 20px;
    position: fixed;
    bottom: 20px;
    right: 28px;
    width: 100px;
    
  }

  .open-button:hover{
    animation: float 0.3s linear 0.3s infinite alternate;
  }

  @keyframes float {
  0%   {bottom:20px; bottom:28px;}
  50%   {bottom:25px; bottom:25px;}
  100%   {bottom:28px; bottom:20px;}
  

 
}
  .chat-popup {
    display: none;
    position: fixed;
    bottom: 110px;
    right: 50px;
    z-index: 9;
    max-height: 500px;
    background-color: #FEF7EA;
  }

  .form-container .btnpablo {
    color: red;
    border: none;
    cursor: pointer;
    width: 250px;
    opacity: 1;
  }
   
  .form-container #btn1 {
    background-color: rgb(238,245,249);
    margin-bottom:10px;
    width: 250px;
    padding-left: 5px;
    padding-top: 13px;
    padding-bottom: 13px;
  }

  .form-container #btn2 {
    background-color: rgb(238,245,249);
    margin-bottom:25px;
    width: 250px;
    padding-left: 5px;
    padding-top: 13px;
    padding-bottom: 13px;
  }

  .form-container {
    width: 300px;
    height: 500px;
    background-color: #FEF7EA;
    box-shadow: 5px 5px 30px grey;
  }

  .modal-headers {
    background-color: rgb(246,162,26);
    width: 300px;
    height: 40px;
  }

  .form-container #close {
    background-color: none;
    color: white;
    position: absolute;
    left: 92%;
    top: 9%;
    transform: translate(-50%, -50%);
  }

  .form-container .btn:hover, .open-button:hover {
    opacity: 1;
  }

  .close {
    color: red;
  }

  #myForm {
    border-radius: 100px;
  }

  a.ahovery:hover {
    color: black;
    background: black;
  }

  /* MARQUEE */
  .marquee {
      height: 50px;
      overflow: hidden;
      position: relative;
      color: #333;
  }

  .marquee p {
    position: absolute;
    width: 100%;
    height: 100%;
    margin: 0;
    line-height: 50px;
    text-align: center;
    -moz-transform: translateX(100%);
    -webkit-transform: translateX(100%);
    transform: translateX(100%);
    -moz-animation: scroll-left 3s linear infinite;
    -webkit-animation: scroll-left 3s linear infinite;
    animation: scroll-left 20s linear infinite;
    color: #ab9600 !important;
    font-weight: bold;
    text-align: center;
    font-size: 18px;
    text-shadow: 2px 1px 6px #ffffff;
  }

  @-moz-keyframes scroll-left {
      0% {
          -moz-transform: translateX(100%);
      }
      100% {
          -moz-transform: translateX(-100%);
      }
  }

  @-webkit-keyframes scroll-left {
      0% {
          -webkit-transform: translateX(100%);
      }
      100% {
          -webkit-transform: translateX(-100%);
      }
  }

  @keyframes scroll-left {
      0% {
          -moz-transform: translateX(100%);
          -webkit-transform: translateX(100%);
          transform: translateX(100%);
      }
      100% {
          -moz-transform: translateX(-100%);
          -webkit-transform: translateX(-100%);
          transform: translateX(-100%);
      }
  }

  <?php if (substr($this->user['R'],0,3) == 'GRM' || $API['R'] == 'F5880126' || $user['R'] == 'F9175006' || $user['R'] == 'G7979485' || $user['R'] == 'F1205575' || $user['R'] == 'F1145677' || $user['R'] == 'F1164754' || $user['R'] == 'F1198933' || $user['R'] == 'F3989172'): ?>
    .modal-headers {
      background-color: green;
      width: 300px;
      height: 40px;
    }
    .panel-heading.main-announcement {
      background-color: green !important;
    }
    .panel-heading.main-announcement .marquee p {
      color: #fff !important;
      text-shadow: 1px 1px 2px #ffffff !important;
    }
  <?php elseif (substr($this->$user['R'],0,3) == 'GWL' || substr($user['R'],0,3) == 'DWL'|| $user['R'] == 'GWL0987'): ?>
    .modal-headers {
      background-color: #4ca8de;
      width: 300px;
      height: 40px;
    }
    .panel-heading.main-announcement {
      background-color: #4ca8de !important;
    }
    .panel-heading.main-announcement .marquee p {
      color: #383e8d !important;
      text-shadow: 1px 1px 15px #ffffff !important;
    }
  <?php endif; ?>
</style>

<script src="<?php echo BASE_URL()?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/kyc.js"></script>

<script>

  //CHAT SCRIPTS
  function openForm() {
    document.getElementById("myForm").style.display = "block";
    document.getElementById("chat-open").style.display ="none"
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("chat-open").style.display ="block"
  }
  //Automatic hide and show for send button
  let chatInput = document.getElementById('chat-input')
  chatInput.addEventListener('keyup', function() {
  var valueIn = chatInput.value.length;
  if (valueIn == 0) {
    $('#send-message').css('display', 'none')
  } else {
    $('#send-message').css('display', 'flex')
  }
  });
  
  function send(){
    let message = $('#chat-input').val()
    if($('#chat-input').val()!=""){
      $('#myconversation').append(`
                <div class="bubble-right">
                   <div class="content-message">
                      <span> `+ message +` </span>
                   </div>
                </div>
                <span class="time-stamp-right">Jun 5, 2022 - 10:30 AM</span>
                <span class="message-user-name"><b style="margin-top: 2px;"><img class="profile-s" src="http://localhost:8090/assets/images/photos/default_photo.png" alt=""> Kristine Salonga</b></span>
                <div class="bubble-left">
                   <div class="content-message">
                      <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde debitis temporibus repudiandae quam nisi</span>
                   </div>
                </div>
                <span class="time-stamp-left">Jun 5, 2022 - 10:30 AM</span>
      `)
      $('#chat-input').val("")
      $('#send-message').css('display', 'none')
      $("#myconversation").animate({ scrollTop: 2000}, "slow");
    }
    else{
      alert('Type your massage')
    }
    
  }

  $('#send-message').click(send)
  
  //Send when entered
  $('#chat-input').on('keypress', function (e) {
    let message = $('#chat-input').val()
         if(e.which === 13){
            
            if($('#chat-input').val()!=""){
              $('#myconversation').append(`
                <div class="bubble-right">
                   <div class="content-message">
                      <span> `+ message +` </span>
                   </div>
                </div>
                <span class="time-stamp-right">Jun 5, 2022 - 10:30 AM</span>
                <span class="message-user-name"><b style="margin-top: 2px;"><img class="profile-s" src="http://localhost:8090/assets/images/photos/default_photo.png" alt=""> Kristine Salonga</b></span>
                <div class="bubble-left">
                   <div class="content-message">
                      <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde debitis temporibus repudiandae quam nisi</span>
                   </div>
                </div>
                <span class="time-stamp-left">Jun 5, 2022 - 10:30 AM</span>
            `)
            $('#chat-input').val("")
            }
            else if($('#chat-input').val()===""){
              alert('Type your massage')
            }
            
            $("#myconversation").animate({ scrollTop: 2000}, "slow");

         }
   });

 



  function showAllowLocation() {
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    $.ajax({
    url: '<?php echo BASE_URL().'Users_location'?>'+"/activateAllowlocation",
    type: "POST",
    cache: false,
    success: function (response) { 
      waitingDialog.hide();
      window.location = '<?php echo BASE_URL().'Users_location'?>';
    }
    });
  } 
</script>