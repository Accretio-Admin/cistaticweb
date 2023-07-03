<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

<script>
$(document).ready(function() {
    $('#example').DataTable({
      initComplete: function() {
        $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
      }
    });
} );
</script>

<style>
#loadercheckrefNo {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid blue;
  border-right: 5px solid green;
  border-bottom: 5px solid red;
  border-left: 5px solid pink;
  width: 30px;
  height: 30px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  display: inline-block;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.table-striped{
  width: 100%;
  background-color: #f3f3f3;
  tbody{
    height:10px;
    overflow-y:auto;
    width: 100%;
    }
  thead,tbody,tr,td,th{
    display:block;
  }
  tbody{
    td{
      float:left;
    }
  }
  thead {
    tr{
      th{
        float:left;
       background-color: #f39c12;
       border-color:#e67e22;
      }
    }
  }
}
</style>

<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-credit-card"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                   <li>BILLS PAYMENT  
                   </li>
                </ul>
                <h4>GOCAB</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
      <div class="contentpanel">
         
      </div><!-- row -->

      <div class="col-xs-12 ">
            
        <div class="panel panel-primary">
          <div class="panel-heading">GoCab REPORTS</div>
            <div class="panel-body" style="height: 600px;overflow-y: scroll;">

              <table id="example" class="table table-striped table-bordered" style="width:100%;height: 600;overflow-y: scroll;">
              <?php $countofarray = count($API['R']); echo 'Count: '.$countofarray;?>
                  <thead>
                      <tr>
                      <th>Row</th>
                          <th>Name</th>
                          <!-- <th>Address</th> -->
                          <!-- <th>Email</th> -->
                          <th>Chosen Option</th>
                          <th>Reference No.</th>
                          <th>Transaction Type</th>
                          <th>Transaction Number</th>
                          <th>Amount</th>
                          <th>Charge</th>
                          <th>Income</th>
                          <th>Balance Before</th>
                          <th>Balance After</th>
                          <th>Date</th>
                          <!-- <th>Time</th> -->
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php for($x = 0; $x < $countofarray; $x++){ ?>
                      <tr>
                          <td><?php echo $x+1; ?></td>
                          <!-- <td><?php // echo $API['R'][$x]['fname']." ".$API['R']['lname']; ?></td> -->
                          <td><?php echo $API['R'][$x]['accountname']; ?></td>
                          <!-- <td><?php // echo $API['R'][$x]['address']; ?></td> -->
                          <!-- <td><?php // echo $API['R'][$x]['email']; ?></td> -->
                          <td>Unified Outlet</td>
                          <td><?php echo $API['R'][$x]['refno']; ?></td>
                          <td><?php echo $API['R'][$x]['transtype']; ?></td>
                          <td><?php echo $API['R'][$x]['trackingno']; ?></td>
                          <td><?php echo $API['R'][$x]['amount']; ?></td>
                          <td><?php echo $API['R'][$x]['charge']; ?></td>
                          <td><?php echo $API['R'][$x]['income']; ?></td>
                          <td><?php echo $API['R'][$x]['balancebefore']; ?></td>
                          <td><?php echo $API['R'][$x]['balanceafter']; ?></td>
                          <td><?php echo $API['R'][$x]['updatedAT']; ?></td>
                          <!-- <td><?php // echo $API['R'][$x]['time']; ?></td> -->
                          <td><a href="https://mobilereports.globalpinoyremittance.com/portal/gocab_receipt/<?php echo $API['R'][$x]['trackingno'] ?>" target="_blank" class="btn btn-info" role="button">Print Receipt</a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th>Row</th>
                          <th>Name</th>
                          <!-- <th>Address</th> -->
                          <!-- <th>Email</th> -->
                          <th>Chosen Option</th>
                          <th>Reference No.</th>
                          <th>Transaction Type</th>
                          <th>Transaction Number</th>
                          <th>Amount</th>
                          <th>Charge</th>
                          <th>Income</th>
                          <th>Balance Before</th>
                          <th>Balance After</th>
                          <th>Date</th>
                          <!-- <th>Time</th> -->
                          <th>Action</th>
                      </tr>
                  </tfoot>
              </table>

            </div>
        </div>

      </div>

    </div><!-- contentpanel -->       


      <div class="modal fade" id="newModal" role="dialog">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" id="closemodal" data-dismiss="modal">×</button>
               <h4 class="modal-title">Transaction Summary</h4>
             </div>
             <div class="modal-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="firstname">First Name:</label>
                      <input type="text" class="form-control" id="fnameDetails" name="firstname" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lastname">Last Name:</label>
                      <input type="text" class="form-control" id="lnameDetails" name="lastname" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" id="addressDetails" name="address" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="emailaddress">Email Address:</label>
                      <input type="text" class="form-control" id="emailDetails" name="emailaddress" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mobilenumber">Mobile Number:</label>
                      <input type="text" class="form-control" id="mobileDetails" name="mobilenumber" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="referencenumber">Reference Number:</label>
                      <input type="text" class="form-control" id="refnoDetails" name="referencenumber" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="textamount">Amount:</label>
                      <input type="text" class="form-control" id="amountDetails" name="textamount" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="TransPass">Transaction Password:</label>
                      <input type="password" class="form-control" id="TransPass" name="TransPass">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <button id="btnSecondSubmit" class="btn btn-info">Submit</button>
                      <span class="errorMessage" id="transpassError"></span>
                    </div>
                  </div>
                </div>

             </div>
           </div>
        </div>
      </div>


</div><!-- mainpanel -->            



<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/billspayment.js"></script>
 
 
 