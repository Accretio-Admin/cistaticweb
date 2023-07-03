<style>
        
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
                                <i class="fa fa-bullhorn"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-bullhorn"></i></a></li>
                                    <li>ANNOUNCEMENT</li>
                                </ul>
                                <h4>ANNOUNCEMENT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
       
                    <div class="contentpanel"  style="background:white">
                                <div class="row">
                             <div class="col-md-12 col-sm-12">
                             <div class="panel panel-default" style="padding:0px!important">
                               <div class="panel-heading" style="background-color:#666666;color:#FFFFFF">ANNOUNCEMENT</div>
                                  <div class="panel-body" style="padding:0px!important">
<!--                                        <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 810px; height: 400px; overflow: hidden; visibility: hidden; background-color: #f9f9f9;">

                                            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                            </div>
                                                  
                                              <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 400px; overflow: hidden;">
                                               <?php 
                                               // $count = 0;
                                               // foreach ($row as $r): 
                                                // $count +=1;
                                                ?>
         
                                                <div data-p="112.50" style="display: none;" id="divAnnouncement">
                                                     <div data-u="image" style="overflow:scroll;width:600px;height:400px;padding:10px">
                                                     <div class="news">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <a href="#" id="aUPS"><?php // echo 'UPS '.date('mdY',strtotime($r->entry_datetime)).'-'.$r->id;?></a>
                                                            <br />
                                                                 To: &nbsp;<?php // echo $r->to?>
                                                            <br/>
                                                            <hr />
                                                                 <?php // echo $r->content?>
                                                            </div>
                                                       </div>
                                                     </div>
                                                       </div>
                                                    <div data-u="thumb">
                                                         <img data-u="image" src="<?php // echo BASE_URL()?>assets/images/ups.png" />
                                                        <div class="t"><?php // echo "#". $count ?></div> 
                                                        <div class="c"><?php // echo 'UPS '.date('mdY',strtotime($r->entry_datetime)).'-'.$r->id;?><br/>To: &nbsp;<?php // echo $r->to?></div>
                                                    </div>
                                                </div>
                                            <?php // endforeach ?>
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
                            <iframe src="https://mobilereports.globalpinoyremittance.com/portal/announcements/<?php echo $user['CG'] ?>" style="width:100%; height:630px;"></iframe>
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
                    <?php if($this->session->flashdata('announcepopup')):?>
                     
                    <?php if($user['CG'] == 'UPS')
                    {
                    
                    $SWITCHER = date('s');
                    
                    if($SWITCHER < 30)
                    {
                    $imageModal = 'https://mobilereports.globalpinoyremittance.com/assets/images/advisory/Ecash_UPS_2018.jpg';
                    $ModalLink = 'https://mobilereports.globalpinoyremittance.com/assets/images/advisory/Ecash_UPS_2018.jpg';
                    }
                    else
                    { 
                    $imageModal = 'https://mobilereports.globalpinoyremittance.com/assets/images/advisory/Bank_Accounts_11_UPS.jpg';
                    $ModalLink = 'https://mobilereports.globalpinoyremittance.com/assets/images/advisory/Bank_Accounts_2_UPS.jpg';
                    }

                    }
                    else
                    {
                    $imageModal = 'https://mobilereports.globalpinoyremittance.com/assets/images/advisory/Bank_Accounts_11_GPRS.jpg';
                    $ModalLink = 'https://mobilereports.globalpinoyremittance.com/assets/images/advisory/Bank_Accounts_22 _GPRS.jpg';
                    }
                    ?>                
                      


                      <div class="modal fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" id="modalAnnouncementsframe">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close closeAnnouncementmodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <img src="<?php echo $imageModal; ?>" width="100%" alt="">
                             <div>
                             </br>
                              <center>
                                <a href="<?php echo $ModalLink; ?>" target="_blank">
                                <button type="button" class="btn btn-info">View More</span></button>
                                </a>
                              </center>
                              </div>
                            </div>

                            <!-- <div class="modal-body"> -->
                            <!-- <iframe width="100%" height="550px" src="" name="BDOiframe" id="BDOiframe"></iframe> -->
                            <!-- <iframe width="100%" height="550px" src="https://mobilereports.globalpinoyremittance.com/portal/announcements/<?php echo $user['CG'] ?>"></iframe> -->
                            

                            <!-- </div> -->
<!--                        <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div> -->
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
                  <?php endif ?>

                        </div><!-- row -->

                    </div><!-- contentpanel -->

                </div><!-- mainpanel -->

                        <div style="z-index: 1000; position:relative;">
                         <script src="<?php echo BASE_URL()?>assets/js/jquery-migrate-1.2.1.min.js"></script>
                                <!-- <script x-organization="59b75368b3de366e3dd4d871" x-departments="SUPPORT, RESA DOMESTIC, RESA INTERNATIONAL" src="https://gomigu.com/js/gomigu-csr-plugin/0.1.0/gomigu-csr-plugin.min.js"></script> -->
                                
                                <script x-organization="59b75368b3de366e3dd4d871" x-departments="CUSTOMER SUPPORT, CORPORATE ACCOUNT, UPS HUB SUPPORT, RBC ACCOUNT, E-CASH FUND, ROLLBACK, SMARTMONEY, TRANSFAST, IREMIT, E-CASH RELOAD VIA CREDIT CARD, TRANSFER OF ACCOUNT, ACTIVATION OF ACCOUNT, WESTERN UNION, DOMESTIC TICKETING, INTERNATIONAL TICKETING, TECHNICAL SUPPORT" src="https://gomigu.com/js/gomigu-csr-plugin/0.1.0/gomigu-csr-plugin.min.js"></script>
                        </div>


