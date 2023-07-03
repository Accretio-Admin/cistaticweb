<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-bed"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>REPORT</li>
              </ul>
              <h4>HOTEL BOOKINGS</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  
  <div class="contentpanel">
    <div class="row">
      <div class="col-xs-12 col-md-12">
        <form action="<?php echo BASE_URL()."report/hotel_booking"?>" method="POST">
        <div class="col-md-6">
          <div class="form-group">
            <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-4 col-sm-6">  
                <label><b>START</b></label>
                <input type="text" class="form-control" name="inputStart" id="datetimepicker" placeholder="YYYY-MM-DD" readonly  required value="<?php echo isset($searchData) ? $searchData['inputStart']:""?>"/>
            </div>
          
            <div class="col-xs-12 col-md-12 col-lg-4 col-sm-6">   
                <label><b>END <?php echo $searchData['inputEnd'] ?></b></label>
                <input type="text" class="form-control" name="inputEnd" id="datetimepicker"  placeholder="YYYY-MM-DD" readonly required value="<?php echo isset($searchData) ? $searchData['inputEnd']:""?>"/>
            </div>

            <div class="col-xs-12 col-lg-4 col-sm-6 col-md-6">
                <label><b>Transaction Number</b></label>
                <input type="text" name="txtTrackingNumber" class="form-control" placeholder="Transaction Number" value="<?php echo isset($searchData) ? $searchData['txtTrackingNumber']:""?>"/> 
            </div>


          <!--   <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('general_report') ?>" target="_blank">
              <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
            </a> -->

            </div>

          </div>

        <div class="row">
          <div class="form-group">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-2">
                <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
            </div>  

        
          </div>
        </div>

        </div>

          
        </form>

        <div class="form-group">
          <?php if (isset($searchData)) :?>
            <!-- <a href="<?php echo BASE_URL(); ?>Report/hotel_booking/" target="_blank"> -->
              <form action="<?php echo BASE_URL()."report/hotel_booking"?>" method="POST" target="_blank">
                <input type="hidden" value="<?php echo $search['txtReferenceNumber']?>" name="txtReferenceNumber">
                <input type="hidden" value="<?php echo $search['txtTrackingNumber']?>" name="txtTrackingNumber">
                <input type="hidden" value="<?php echo $search['inputStart']?>" name="inputStart">
                <input type="hidden" value="<?php echo $search['inputEnd']?>" name="inputEnd">
                <input type="hidden" value="1" name="hdnToPrint">
                
              </form>
            <!-- </a> -->
          <?php endif?>
        </div>
        </div>
      </div>
    </div>
    
    <div class="row row-stat">
      <div class="col-xs-12 col-md-12 text-right">
            <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><?php echo $result['M']; ?></h5>
      </div>
      <div class="col-xs-12 col-md-12">
        <div class="contentpanel" style="padding-top: 0px;"> 
            <div class="panel panel-default">
              <!-- <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px; color: #4169E1; font-weight: bold;">Hotel Bookings</div> -->
                <div class="panel-body" style="height: 600px;overflow: scroll;" >
                  <div class="row">
                    <table class="table table-bordered">
                      <thead>
                        <tr nowrap>
                          <th nowrap>Status</th>
                          <!-- <th nowrap>Row Id</th> -->
                          <th nowrap>Transaction Number</th>
                          <!-- <th nowrap>Booking Reference ID</th> -->
                          <!-- <th nowrap>Institution/Booking Agency</th> -->
                          <th nowrap>Date & Time</th>
                          <!-- <th nowrap>REGCODE</th> -->
                          <th nowrap>Check In</th>
                          <th nowrap>Check Out</th>
                          <th nowrap>Room(s)</th>
                          <th nowrap>Adult</th>
                          <th nowrap>Child</th>
                          <!-- <th nowrap>Guests Details</th> -->
                          <th nowrap>Customer Name</th>
                          <th nowrap>Hotel Name</th>
                          <th nowrap>Total Amount</th>
                          </tr>
                      </thead>

                      <tbody>
                        <?php
                        if (count($results)):
                          foreach($results as $key=>$result):
                            ?>
                          <tr>
                            <td width="10%"><a id="aPNR" class="btn btn-warning" href="https://mobilereports.globalpinoyremittance.com/portal/hotel_voucher/<?php echo $result['trackingNumber']?>" target="_blank" data-toggle="tooltip" title="Click here get receipt">Get Voucher</a></td>
                            <!-- <td width="3%"><?php echo $result['id']?></td> -->
                            <td width="10%"><?php echo $result['trackingNumber']?></td>
                            <!-- <td width="10%"><?php echo $result['trackingNumber']?></td> -->
                            <!-- <td width="10%">Hotelbeds</td> -->
                            <td width="10%"><?php echo $result['createdAt']?></td>
                            <!-- <td width="6%"><?php echo $result['regcode']?></td> -->
                            
                            <td width="8%"><?php echo date('M d, Y', strtotime($result['checkIn']))?></td>
                            <td width="8%"><?php echo date('M d, Y', strtotime($result['checkOut']))?></td>
                            <!-- <td width="5%"><?php //echo $result['markup']?></td> -->
                            <td width="5%"><?php echo $result['room']?></td>
                            <td width="5%"><?php echo $result['adult']?></td>
                            <td width="5%"><?php echo $result['child']?></td>
                            <!-- <td width="10%">
                            <?php 
                                // print_r($result['guests']);
                                foreach($result['guests'] as $key=>$value) {
                                    echo "{$value['firstName']} {$value['lastName']} <br>";
                                }
                            ?>
                            </td> -->
                            <td width="10%"><?php echo ucfirst($result['customer']['firstName'] . " " . $result['customer']['lastName'])?></td>
                            <td width="10%"><?php echo $result['hotel']['name']?></td>

                            <td width="6%"><?php echo number_format($result['totalAmount'], 2)?></td>
                          </tr>
                        <?php
                          endforeach;
                        else:?>
                          <tr>
                            <td colspan="15" style="text-align: center;"><span >No booking found</span></td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
            </div>
        </div>   
      </div>
    </div>