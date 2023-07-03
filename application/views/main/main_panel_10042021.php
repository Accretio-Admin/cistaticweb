<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
<style>

.open-button {
    position: fixed;
    width: 55px;
    height: 55px;
    bottom: 35px;
    right: 35px;
}

/* The popup chat - hidden by default */
.chat-popup {
  
  display: none;
  position: fixed;
  bottom: 110px;
  right: 50px;
  z-index: 9;
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
  height: 170px;
  background-color: white;
 
  box-shadow: 5px 5px 30px grey;
}

/*//
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}
*/

/* When the textarea gets focus, do something */


/* Set a style for the submit/send button */




.modal-headers {
 background-color: rgb(246,162,26);
 
 width: 300px;
 height: 40px;
}
/* Add a red background color to the cancel button */
.form-container #close {
 background-color: none;
 color: white;
 position: absolute;
  left: 92%; /* relative to nearest positioned ancestor or body element */
  top: 9%; /*  relative to nearest positioned ancestor or body element */
  transform: translate(-50%, -50%);
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

.close{
    color: red;
}

#myForm{
    border-radius: 100px;
}

a.ahovery:hover{
    color: black;
    background: black;
}
        
        /* jssor slider arrow navigator skin 02 css */
        /*
        .jssora02l                  (normal)
        .jssora02r                  (normal)
        .jssora02l:hover            (normal mouseover)
        .jssora02r:hover            (normal mouseover)
        .jssora02l.jssora02ldn      (mousedown)
        .jssora02r.jssora02rdn      (mousedown)
        */
        .jssora02l, .jssora02r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 55px;
            height: 55px;
            cursor: pointer;
            background: url('img/a02.png') no-repeat;
            overflow: hidden;
        }
        .jssora02l { background-position: -3px -33px; }
        .jssora02r { background-position: -63px -33px; }
        .jssora02l:hover { background-position: -123px -33px; }
        .jssora02r:hover { background-position: -183px -33px; }
        .jssora02l.jssora02ldn { background-position: -3px -33px; }
        .jssora02r.jssora02rdn { background-position: -63px -33px; }
/* jssor slider thumbnail navigator skin 11 css *//*.jssort11 .p            (normal).jssort11 .p:hover      (normal mouseover).jssort11 .pav          (active).jssort11 .pav:hover    (active mouseover).jssort11 .pdn          (mousedown)*/.jssort11 .p {    position: absolute;    top: 0;    left: 0;    width: 200px;    height: 69px;    background: #181818;}.jssort11 .tp {    position: absolute;    top: 0;    left: 0;    width: 100%;    height: 100%;    border: none;}.jssort11 .i, .jssort11 .pav:hover .i {    position: absolute;    top: 3px;    left: 3px;    width: 60px;    height: 30px;    border: white 1px dashed;}* html .jssort11 .i {    width /**/: 62px;    height /**/: 32px;}.jssort11 .pav .i {    border: white 1px solid;}.jssort11 .t, .jssort11 .pav:hover .t {    position: absolute;    top: 3px;    left: 68px;    width: 129px;    height: 32px;    line-height: 32px;    text-align: center;    color: #fc9835;    font-size: 13px;    font-weight: 700;}.jssort11 .pav .t, .jssort11 .p:hover .t {    color: #fff;}.jssort11 .c, .jssort11 .pav:hover .c {    position: absolute;    top: 38px;    left: 3px;    width: 197px;    height: 31px;    line-height: 31px;    color: #fff;    font-size: 11px;    font-weight: 400;    overflow: hidden;}.jssort11 .pav .c, .jssort11 .p:hover .c {    color: #fc9835;}.jssort11 .t, .jssort11 .c {    transition: color 2s;    -moz-transition: color 2s;    -webkit-transition: color 2s;    -o-transition: color 2s;}.jssort11 .p:hover .t, .jssort11 .pav:hover .t, .jssort11 .p:hover .c, .jssort11 .pav:hover .c {    transition: none;    -moz-transition: none;    -webkit-transition: none;    -o-transition: none;}.jssort11 .p:hover, .jssort11 .pav:hover {    background: #333;}.jssort11 .pav, .jssort11 .p.pdn {    background: #462300;}
      
      </style>


    <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>HOME</li>
                                </ul>
                                <h4>HOME</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
       
                    <div class="contentpanel"  style="background:white">
                                <div class="row">
                             <div class="col-md-12 col-sm-12">
                             <div class="panel panel-default" style="padding:0px!important">
                               <div class="panel-heading" style="background-color:#666666;color:#FFFFFF">ANNOUNCEMENT</div>
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
<!--                                        <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 810px; height: 400px; overflow: hidden; visibility: hidden; background-color: #f9f9f9;">

                                            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                            </div>
                                                  
                                              <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 400px; overflow: hidden;">
                                               <?php 
                                               $count = 0;
                                               foreach ($row as $r): 
                                                $count +=1;
                                                ?>
         
                                                <div data-p="112.50" style="display: none;" id="divAnnouncement">
                                                     <div data-u="image" style="overflow:scroll;width:600px;height:400px;padding:10px">
                                                     <div class="news">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <a href="#" id="aUPS"><?php echo 'UPS '.date('mdY',strtotime($r->entry_datetime)).'-'.$r->id;?></a>
                                                            <br />
                                                                 To: &nbsp;<?php echo $r->to?>
                                                            <br/>
                                                            <hr />
                                                                 <?php echo $r->content?>
                                                            </div>
                                                       </div>
                                                     </div>
                                                       </div>
                                                    <div data-u="thumb">
                                                         <img data-u="image" src="<?php echo BASE_URL()?>assets/images/ups.png" />
                                                        <div class="t"><?php echo "#". $count ?></div> 
                                                        <div class="c"><?php echo 'UPS '.date('mdY',strtotime($r->entry_datetime)).'-'.$r->id;?><br/>To: &nbsp;<?php echo $r->to?></div>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                            </div>

                                            <div data-u="thumbnavigator" class="jssort11" style="position:absolute;left:605px;top:0px;font-family:Arial, Helvetica, sans-serif;-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;right:5px;width:200px;height:900px;" data-autocenter="2">

                                                <div data-u="slides" style="cursor: default;">
                                                    <div data-u="prototype" class="p">
                                                        <div data-u="thumbnailtemplate" class="tp"></div>
                                                    </div>
                                                </div>

                                            </div>

                                            <span data-u="arrowleft" class="jssora02l" style="top:123px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
                                            <span data-u="arrowright" class="jssora02r" style="top:123px;right:218px;width:55px;height:55px;" data-autocenter="2"></span>
                                           
                                        </div> 
-->                 
                            
                            <?php if ($this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx' && $this->user['R'] != 'BDO00001'): ?>
                                <iframe src="https://mobilereports.globalpinoyremittance.com/portal/announcements/<?php echo $user['CG'] ?>" style="width:100%; height:630px;"></iframe>
                            <?php endif ?>
                             </div>
                        </div>
                            </div><!-- col-md-8 -->
<!--                             <div class="col-md-4">
                                    <div class="panel panel-default" style="padding:0px!important">
                                          <div class="panel-heading" style="background-color:#666666;color:#FFFFFF">CONTACT US</div>
                                          
                                          <div class="panel-body">

                                          </div>
                                    </div>
                            </div> 
-->
                        <!--ANNOUNCEMENTS-->
                        
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
                                <a href="http://10.9.10.6:2121/Users_Location"><button type="button" class="btn btn-secondary">Yes</button></a>
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

<!-- <button class="open-button" >Chat</button> -->
<div class="open-button">
    <!-- <img data-u="image" class="open-button" style="cursor: pointer;" onclick="openForm()" src="<?php echo BASE_URL()?>assets/images/hame.svg" /> -->
    <img data-u="image" style="cursor: pointer; width: 60px; height: 60px;" onclick="openForm()" src="<?php echo BASE_URL()?>assets/images/messagebot.png" />
</div>

<div class="chat-popup" id="myForm" >

  <div action="/action_page.php" class="form-container" style="border-radius: 8px;">
    <div class="modal-headers" style="border-radius: 8px 8px 0px 0px;">
        
        <span onclick="closeForm()" style="font-color: white; cursor: pointer" class="" id="close" >x</span>
    </div>
        <h1 style="font-family: 'Lato';font-size: 12px;text-align: center;margin: 15px">Choose a support you want to connect.</h1>
    
        <center>
        <div class="btnpablo">
            <!-- <a href="https://csr.gomigu.com" target="_blank" class="ahovery">
                <div class="row" id="btn1" style="border-radius: 8px;">
                    <div class="col-md-1 col-sm-1 col-lg-1">
                        <span>
                            <img data-u="image" src="<?php echo BASE_URL()?>assets/images/gomigz.png" style="width: 35px; float: left;"/>
                        </span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-lg-10" style="padding-top: 6px;">
                        <span style="color: red; font-size: 15px; font-family: 'Lato'; padding-left: 5px;">
                            New Online Support
                        </span>
                    </div>
                </div>
            </a> -->

            <a href="https://support.unified.ph" target="_blank" class="ahovery">
                <div class="row" id="btn2" style="border-radius: 8px;">
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

  </div>
</div>



                        </div><!-- row -->

                    </div><!-- contentpanel -->

                </div><!-- mainpanel -->

                        <div style="z-index: 1000; position:relative;">
                         <script src="<?php echo BASE_URL()?>assets/js/jquery-migrate-1.2.1.min.js"></script>
                                <!-- <script x-organization="59b75368b3de366e3dd4d871" x-departments="SUPPORT, RESA DOMESTIC, RESA INTERNATIONAL" src="https://gomigu.com/js/gomigu-csr-plugin/0.1.0/gomigu-csr-plugin.min.js"></script> -->























                                
                            <!-- <?php if ($this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx'): ?> 
                                <script x-organization="59b75368b3de366e3dd4d871" x-departments="CUSTOMER SUPPORT, CORPORATE ACCOUNT, UPS HUB SUPPORT, RBC ACCOUNT, E-CASH FUND, ROLLBACK, SMARTMONEY, TRANSFAST, IREMIT, E-CASH RELOAD VIA CREDIT CARD, TRANSFER OF ACCOUNT, ACTIVATION OF ACCOUNT, WESTERN UNION, DOMESTIC TICKETING, INTERNATIONAL TICKETING, TECHNICAL SUPPORT" src="https://gomigu.com/js/gomigu-csr-plugin/0.1.0/gomigu-csr-plugin.min.js"></script>
                            <?php endif ?> -->
                        </div>
<script src="<?php echo BASE_URL()?>assets/js/kyc.js"></script> 


<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>