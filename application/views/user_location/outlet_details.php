<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

<script>
$(document).ready(function() {
    $('#locationTable').DataTable();
    // $('#locationTable').DataTable({
    //     "order": [[ 3, "desc" ]]
    // });
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
</style>

        <form method="post" method="<?php echo BASE_URL()?>Location/index" id="frmreport">
        
            <?php if ($result['S'] === 0): ?>
                <div class="alert alert-danger"><?php echo $result['M']; ?></div>
            <?php endif ?>
            <?php if ($result['S'] == 1): ?>
                <div class="alert alert-success"><?php echo $result['M']; ?></div>
            <?php endif ?>

            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-3">
                        <div class="form-group">
                            <select class="form-control" name="selAccountType">
                                    <option value="" disabled selected>SELECT ACCOUNT TYPE</option>
                                    <option value="1" <?php echo $_POST["selAccountType"] == '1' ? 'selected':''?> >UNIFIED DEALERS</option>
                                    <option value="2" <?php echo $_POST["selAccountType"] == '2' ? 'selected':''?> >ECASHPAY CENTERS</option>
                                    <option value="3" <?php echo $_POST["selAccountType"] == '3' ? 'selected':''?> >UNIFIED HUBS/CORPORATE PARTNERS</option>
                            </select>  
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="form-group">
                            <select class="form-control" name="selLocation">
                                    <option value="" disabled selected>SELECT LOCATION</option>
                                    <option value="4" <?php echo $_POST["selLocation"] == '4' ? 'selected':''?> >COUNTRY</option>
                                    <option value="5" <?php echo $_POST["selLocation"] == '5' ? 'selected':''?> >REGION</option>
                                    <option value="6" <?php echo $_POST["selLocation"] == '6' ? 'selected':''?> >PROVINCE/CITY</option>
                            </select>  
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-2">
                        <div class="form-group">
                            <select class="form-control" name="selLocation">
                                    <option value="" disabled selected>SELECT</option>
                                    <!-- loop result from selected location filter -->
                                    <?php foreach ($country as $row): ?>
                                        <option value="<?php echo $row ?>"> <?php echo $row ?> </option> 
                                    <?php endforeach ?>
                            </select> 
                            <select class="form-control" name="selLocation">
                                    <option value="" disabled selected>SELECT</option>
                                    <!-- loop result from selected location filter -->
                                    <?php foreach ($region as $row): ?>
                                        <option value="<?php echo $row ?>"> <?php echo $row ?> </option> 
                                    <?php endforeach ?>
                            </select> 
                            <select class="form-control" name="selLocation">
                                    <option value="" disabled selected>SELECT</option>
                                    
                                    <?php foreach ($city as $row): ?>
                                        <option value="<?php echo $row ?>"> <?php echo $row ?> </option> 
                                    <?php endforeach ?>
                            </select>  
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-2">
                        <div class="form-group">
                            <select class="form-control" name="selSort">
                                    <option value="" disabled selected>SELECT SORT</option>
                                    <option value="7" <?php echo $_POST["selSort"] == '7' ? 'selected':''?> >NEAREST TO FARTHEST</option>
                                    <option value="8" <?php echo $_POST["selSort"] == '8' ? 'selected':''?> >FARTHEST TO NEAREST</option>
                            </select>  
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-2 text-right">
                        <div class="form-group">
                            <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                            <!-- <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('ecash') ?>" target="_blank">
                                <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
                            </a> -->
                        </div>
                    </div>
                </div>    
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class='col-xs-12 col-md-12'>
                            <div class="panel panel-primary">
                                <div class="panel-heading">UNIFIED LIST OF LOCATIONS TABLE</div>
                                    <div class="panel-body">

                                        <!-- <?php if ($process['P'] == 1 && $process['S'] ===0): ?>
                                            <div class="row">
                                                <div class="col-xs-10 col-md-10">
                                                <div class="alert alert-danger"><b><?php echo $process['M']; ?></b></div>
                                                </div>   
                                            </div>
                                        <?php endif ?> -->
                                        
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                <div class="text-right" style="margin-bottom:5px">
                                                    <span class="badge badge-danger"><?php echo $process['M']; ?></span>
                                                </div>
                                    
                                                <table id="locationTable" class="table table-striped table-bordered" style="width:100%;overflow-y: scroll;">
                                                    <thead>
                                                        <tr>
                                                            <th width="150">Account Type</th>
                                                            <th width="150">Complete Location</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php for ($x = 0 ; $x < count($T_DATA); $x++) { ?>
                                                            <tr>
                                                                <td><?php 
                                                                if ($T_DATA[$x]['userlevel'] == 1) {
                                                                    echo 'SUB DEALER';
                                                                } else if($T_DATA[$x]['userlevel'] == 6) {
                                                                    echo 'DEALER';
                                                                }else if($T_DATA[$x]['userlevel'] == 7) {
                                                                    echo 'HUB';
                                                                }else if($T_DATA[$x]['userlevel'] == 16) {
                                                                    echo 'ECASHPAY';
                                                                }
                                                                ?></td>
                                                                
                                                                <!-- <td><a href=""><button  type="button" id="viewMap" class="btn"><?php echo $T_DATA[$x]['brgy'].", ".$T_DATA[$x]['city'].", ".$T_DATA[$x]['province'].", ".$T_DATA[$x]['country']; ?></button></a></td> -->
                                                            </tr>
                                                        <?php } ?>
                                                        <!-- <tr>
                                                            <td>DEALER</td>
                                                            <td>MANILA</td>
                                                        </tr>
                                                        <tr>
                                                            <td>HUB</td>
                                                            <td>QUEZON CITY</td>
                                                        </tr> -->
                                                    </tbody>  
                                                </table>
                                            </div>
                                        </div>
                                       

                                    </div> <!-- col-xs-8 col-md-8-->
                                </div> <!-- row -->
                            </div> <!--col-xs-6 col-md-6-->
                        </div>
                    </div>
                </div>
            </div><!-- row -->
        </form><!-- form -->

<div class="modal fade" tabindex="-1" role="dialog" id="modalMapframe">
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body"> 
        <iframe width="100%" height="550px" src="" class="iframe-placeholder" name="mapFrame" id="mapFrame"></iframe> 
        <input type="hidden" class="form-control" name="inputdragonpayURL" id="inputdragonpayURL" value="<?php echo $inputdragonpayURL; ?>"/>
      </div> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- <script>
    $("#viewMap").click(function() {
       document.getElementById('mapFrame').src = "";
       document.getElementById('mapFrame').src = window.location.href+"/mapFrame"; 
       $('#mapFrame').load(function() {
                $('#mapFrame').contents().find('#idDestination').attr('value', '9.555357236650886,125.70811457470205');
       });
       $("#modalMapframe").modal("show");
    });
</script> -->

<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
            