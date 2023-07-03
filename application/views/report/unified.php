<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

<script>
$(document).ready(function() {
    $('#example').DataTable();
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
                   <li>REPORTS  
                   </li>
                </ul>
                <h4>UNIFIED TOPUP</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
      <div class="contentpanel">
         
      </div><!-- row -->

      <div class="col-xs-12 ">
            
        <div class="panel panel-primary">
          <div class="panel-heading">UNIFIED TOPUP REPORTS</div>
            <div class="panel-body" style="height: 600px;overflow-y: scroll;">

              <table id="example" class="table table-striped table-bordered" style="width:100%;height: 600;overflow-y: scroll;">
              <?php $countofarray = count($API['R']); echo 'Count: '.$countofarray;?>
                  <thead>
                      <tr>
                          <th>Row</th>
                          <th>Name</th> 
                          <th>Email</th> 
                          <th>Reference No.</th>
                          <th>Tracking No.</th>
                          <th>Status</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php for($x = 0; $x < $countofarray; $x++){ ?>
                      <tr>
                          <td><?php echo $x+1; ?></td>
                          <td><?php echo $API['R'][$x]['fname']; ?></td> 
                          <td><?php echo $API['R'][$x]['email']; ?></td> 
                          <td><?php echo $API['R'][$x]['refno']; ?></td>
                          <td><?php echo $API['R'][$x]['trackno']; ?></td>
                          <td><?php echo $API['R'][$x]['status']; ?></td>
                          <td><?php echo $API['R'][$x]['amount']; ?></td>
                          <td><?php echo $API['R'][$x]['date']; ?></td>
                          <td><?php echo $API['R'][$x]['time']; ?></td>
                          <td><a href="https://mobilereports.globalpinoyremittance.com/portal/unified_receipt/<?php echo $API['R'][$x]['trackno'] ?>" target="_blank" class="btn btn-info" role="button">Print Receipt</a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th>Row</th>
                          <th>Name</th> 
                          <th>Email</th> 
                          <th>Reference No.</th>
                          <th>Tracking No.</th>
                          <th>Status</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Action</th>
                      </tr>
                  </tfoot>
              </table>

            </div>
        </div>

      </div>

    </div><!-- contentpanel -->       
 
</div><!-- mainpanel -->            



<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/billspayment.js"></script>
 
 
 