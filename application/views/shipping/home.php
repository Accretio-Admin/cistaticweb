<style>
.img{
 
}
.wrapper {

}

.image--cover {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  margin: 20px;

  object-fit: cover;
  object-position: center right;
}
</style>

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



    <div class="contentpanel">

        
        <div class="row row-stat">
            <div class="col-sm-9 col-md-9">
                <div class="tab-content nopadding noborder">
                    <div class="tab-pane active" id="activities">
                        <div class="follower-list">
                            <div class="col-sm-12">
                                <div class="row media-manager">
                                <!-- WILL BE AVAILABLE ONCE SHIPPING IS DEPLOYED -->
                                    <!-- <div class="col-xs-6 col-sm-4 col-md-3 document">
                                        <div class="thmb" >
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;" href="<?php echo BASE_URL();?>Shipping/shipping_home" class="" id="aloading">
                                                    <img  src="<?php echo BASE_URL() ?>assets/images/online_booking/book_flights.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                </a>
                                            </div>
                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL();?>Shipping/shipping_home">BOOK SHIP</a></h5>
                                        </div>
                                    </div>

                                

                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                        <div class="thmb" >
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;" href="<?php echo BASE_URL();?>Shipping/shipping_ticket" class="" id="aloading">
                                                    <img  src="<?php echo BASE_URL() ?>assets/images/online_booking/etickets.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                </a>
                                            </div>
                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL();?>Shipping/shipping_ticket" id="aloading">ISSUE TICKET</a></h5>
                                        </div>
                                    </div> -->
                                    <!-- WILL BE AVAILABLE ONCE SHIPPING IS DEPLOYED -->

                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                        <div class="thmb" >
                                            <div class="thmb-prev  text-center">

                                                <a style="background-color: #fff;cursor:pointer;" class="provider" x="FastCat" data-toggle="modal" data-target="#ship" class="" >
                                                    <img class="img" src="<?php echo BASE_URL() ?>assets/images/shipping/fastcatLOGO.png"  alt="Avatar" style="width:200px;height:120px;border-radius: 10%;">
                                                </a>
                                            </div>
                                            <h5 class="fm-title text-center"><a style="cursor:pointer;" class="provider" x="FastCat" data-toggle="modal" data-target="#ship">FastCat</a></h5>
                                        </div>
                                    </div>


                                <!-- href="<?php echo BASE_URL();?>Shipping/shipping_ticket" -->

                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                        <div class="thmb" >
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;cursor:pointer;" class="provider" x="TransAsia" data-toggle="modal" data-target="#ship" class="" >
                                                    <img class="img" src="<?php echo BASE_URL() ?>assets/images/shipping/transasiaLOGO.png"  alt="Avatar" style="width:200px;height:120px;border-radius: 10%;">
                                                </a>

                                            </div>
                                            <h5 class="fm-title text-center"><a style="cursor:pointer;" class="provider" x="TransAsia" data-toggle="modal" data-target="#ship">TransAsia</a></h5>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                        <div class="thmb" >
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;cursor:pointer;" class="provider" x="2GO" data-toggle="modal" data-target="#ship" class="" >
                                                    <img class="img" src="<?php echo BASE_URL() ?>assets/images/shipping/2GOLOGO.png"  alt="Avatar" style="width:200px;height:120px;border-radius: 10%;">
                                                </a>

                                            </div>
                                            <h5 class="fm-title text-center"><a style="cursor:pointer;" class="provider" x="2GO" data-toggle="modal" data-target="#ship">2GO</a></h5>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="ship">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title"></h4>
                                              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                            </div><br>
                                            
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                              <div class="panel panel-info">
                                              <div class="panel-body">
                                              <p>
                                              <b>Ka-Unified!!!</b> <br><br>You are about to process a Shipping Reservation. <br>After clicking the “Proceed” button, you will be re-directed to the Online Support page where you can request for quotation/s and process a transaction.<br><br>

                                              Please be guided with the following processes: <br><br>  
                                                <b>1.</b>  Fill out the form.<br>
                                                <b>2.</b>  Using the drop down arrow, select “<span id="provider"></span> Shipping” as the category.<br>
                                                <b>3.</b>  Submit the transaction request and the provide the following: Number of Pax, Route, Date and Time. Please take note of the ticket reference number.<br>
                                                <b>4.</b>  Monitor the online support ticket you created for updates and confirmation.<br>
                                              </p>
                                              </div>
                                              </div>
                                            </div>

                                            <script type="text/javascript">
                                                $(".provider").click(function(){
                                                    $("#provider").html($(this).attr("x"));
                                                    // alert($(this).attr("x"));
                                                });
                                            </script>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <a class="btn btn-success" href="https://support.unified.ph//index.php?a=add/index.php?a=add" target="_blank">Proceed</a>
                                            </div>
                                            
                                          </div>
                                        </div>
                                      </div>

                                </div>
                            </div>
                        </div><!-- activity-list -->

                    </div><!-- tab-pane -->

                </div>
            </div><!-- col-md-8 -->
        </div><!-- row -->

    </div><!-- contentpanel -->

</div><!-- mainpanel -->



