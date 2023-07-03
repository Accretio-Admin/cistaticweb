<style type="text/css">
.box-icon-center {
  margin: 0 auto;
}
.box-icon-success {
  background: #51a351;
}

.box-icon, [class^="box-icon-"], [class*=" box-icon-"] {
  z-index: 2;
  position: relative;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  display: block;
  background: #ed8323;
  color: #fff;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}

.box-icon-large {
  width: 90px;
  height: 90px;
  line-height: 90px;
  font-size: 42px;
}

.round {
  -webkit-border-radius: 50%;
  border-radius: 50%;
}

.mb30 {
  margin-bottom: 30px !important;
}
.order-payment-list > li {
  padding: 10px 15px;
  border-bottom: 1px dashed #ccc;
}
.list {
  list-style: none;
  margin: 0;
  padding: 0;
}

.order-payment-list > li:first-child {
  border-top: 1px dashed #ccc;
}
.order-payment-list > li {
 /* padding: 10px 15px;*/
 border-bottom: 1px dashed #ccc;
}

ul{
  list-style: none;
}
</style>
<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-book"></i>
      </div>
      <div class="media-body">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL()."hotels"; ?>"><i class="glyphicon glyphicon-home"></i></a></li>
          <li>Hotels</li>
        </ul>
        <h4>Hotel Booking</h4>
      </div>
    </div><!-- media -->
  </div><!-- pageheader -->
  
  <div class="contentpanel">
    <div class="row" >
      <div class="col-md-12">
        <a href="<?php echo BASE_URL()."hotels"; ?>"><i class="fa fa-check round box-icon-large box-icon-center box-icon-success mb30"></i></a>
        <!-- <h1 style="text-align: center;">Thank you for booking</h1> -->
        <h1 style="text-align: center;"><?php echo $this->user['N'] ?>, your payment was successful!</h1>
        <h3 style="text-align: center;padding-bottom: 20px;">Booking details has been sent to <?php echo $this->user['EA']?></h>
      </div>
      
      <div class="col-md-2">
      </div>
      
      <div class="col-md-8">

        <div class="row">
          <ul class="order-payment-list">
            <li>
              <div class="row">
                <div class="col-md-6">
                  <p><b>Tracking number</b> : <span><?php echo $results['trackingNumber']?></span></p>
                  <p><b>Booking Reference ID</b> : <span><?php echo $results['referenceNumber']?></span></p>
                </div>
                <div class="col-md-6">
                  <span><b>Status</b> : CONFIRMED</span>
                </div>
              </div>
            </li>
            <li>
              <div class="row">
                <div class="col-md-6">
                  <h4><b><?php echo $results['hotel']['name']?></b></p>
                  <p><b><?php echo $results['hotel']['rooms'][0]['name']?></b> (<?php echo $results['hotel']['rooms'][0]['rates'][0]['boardName']?>)</p>
                  <p><?php echo ucfirst($results['customer']['firstName'] ." ". $results['customer']['lastName'])?></p>
                </div>
                <div class="col-md-6">
                  <p><b>Check In</b> : <?php echo date('M d, Y', strtotime($results['checkIn'])) ?></p>
                  <p><b>Check Out</b> : <?php echo date('M d, Y', strtotime($results['checkOut'])) ?></p>
                </div>
              </div>
            </li>
            <li>
              <div class="row">
                <div class="col-md-6">
                  <p><b>Total Amount</b> : <span>PHP <?php echo number_format($results['totalAmount'], 2);?></span></p>
                </div>
                <div class="col-md-6">
                  
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
      </div>
<!-- 
John, your payment was successful!
Booking details has been sent to johndoe@gmail.com
 -->
    </div>
  </div>
</div>  