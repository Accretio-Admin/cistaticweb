<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-book"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>Hotels</li>
              </ul>
              <h4>Hotel Booking</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  
  <div class="contentpanel">
        <div class="row row-stat">
            <div class="col-md-5">
                <div class="contentpanel" style="padding-top: 0px;">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px; color: #4169E1; font-weight: bold;">MARKUP 
                        <span id="spanInformation" class="pull-right"><i class="fa fa-exclamation-circle" style="cursor:pointer"></i></span></div>
                        <div class="panel-body">
                            <?php if (isset($output)):
                                $alert = $output['S'] === 0 ? "alert-danger":"alert-success"; ?>
                                <div class="alert <?php  echo $alert; ?>"><?php  echo $output['M']; ?> </div>
                            <?php endif; ?>
                            <!--<form name="frmiremit" action="<?php /*echo BASE_URL() */?>Abacus_Domestic_Flights/markup" method="post" id="frmDomesticMarkup">-->
                                <div class="form-group">
                                    <input type="text" class="form-control" name="inputAmount" placeholder="AMOUNT" required value="<?php echo $mark_up ?> %" readonly/>
                                </div>
                                <div class="form-group text-right">
                                    <a type="submit" class="btn btn-primary"  id="BtnUpdateMarkup" name="btnSubmit">Update</a>
                                </div>
                            <!--</form>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="updateMarkup" role="dialog" >
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content modal-content-xs">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title">Update Markup</h4>
            </div>
            <!-- <form action="<?php echo BASE_URL() ?>Ticketing_<?php echo $menu=='int'? 'International': 'Domestic' ?>_Flights/markup" method="post" id="frmDomesticMarkup"> -->
            <form action="<?php echo BASE_URL() ?>hotels/markup" method="post" id="frmHotelMarkup">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Markup: </label>
                              <select id="optMarkUp" type="text" class="form-control" name="markup" value="<?php echo $mark_up ?>" required/>
                              <?php for($i=0; $i<=5; $i++) {
                                  $selected = $i == $mark_up ? "selected":"";
                                  echo "<option value={$i} {$selected}> {$i} % </option>";
                              }
                              ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Transaction Password: </label>
                              <input type="password" class="form-control" name="transpass" placeholder="Transaction Password" id="txtTransPass" required/>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <button type="button" class="btn btn-default btnModalCancel"  data-dismiss="modal">Cancel</button>
                        </div>

                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary" name="btnUpdateMarkup">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="informationOnMarkUp" role="dialog" >
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content modal-content-sm">
            <div class="modal-header">
                <h4 class="modal-title">Update Markup</h4>
            </div>
            
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Mark-up will serve as your income for every booking.</p>  
                            <p><b>Example</b></p>
                            <table class="table">
                              <tr>
                                <td>Actual Booking Amount</td>
                                <td> 5,000.00</td>
                              </tr>
                              <tr>
                                <td>Mark up @ 5%</td>
                                <td>250.00</td>
                              </tr>
                              <tr>
                                <td><b>Total Booking Amount</b></td>
                                <td><b>5,250.00</b></td>
                              </tr>
                            </table>
                            <p><b>Note: Allowable maximum percentage as a mark-up is 5% only.</b></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <button type="button" class="btn btn-default btnModalCancel pull-right"  data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#spanInformation").click(function(){
        $('#informationOnMarkUp').modal('show');
    })

    $("#frmHotelMarkup").submit(function(e){
        if (parseInt($("#optMarkUp").val()) > 5 || parseInt($("#optMarkUp").val()) < 0) {
            e.preventDefault();
        }
        
        $("#txtTransPass").attr("readonly", "readonly");
        $("#optMarkUp").attr("readonly", "readonly");
    });
});
</script>