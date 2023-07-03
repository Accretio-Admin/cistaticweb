 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
 
<style>
  .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.modal-header {
  min-height: 16.43px;
  padding: 15px !important;
  border-bottom: 1px solid #e5e5e5 !important;
  background-color: #f0a30d !important;
  color: #fff !important;
  display: flex;
  justify-content: space-between;
}

.modal-header span{
  color: white !important;
  font-size: 35px;
}

#modalMapframe .modal-header button {
  background-color: transparent;
  border: 0 !important;
}
#modalMapframe .modal-header h4 {
  line-height: 30px;
}

/* .modal-header .close {
    margin-top: -15px;
} */

.mapFrame, #mapFrame {
  border: 0 !important;
}

#locationTable th {
  width: 248px;
  height: 50px;
  text-align: center;
  line-height: 30px;
  background-color: #fca600;
  border-bottom: 0;
  color: #fff;
}

#locationTable td {
  text-align: center;
}

input.form-control {
  height: 45px !important;
  font-size: 16px !important;
  font-weight: 500 !important;
  border-radius: 8px;
  border: 1px solid #d9d9d9;
  margin-bottom: 10px !important;
}

select.form-control {
  height: 45px !important;
  font-size: 16px !important;
  font-weight: 500 !important;
  border-radius: 8px;
  border: 1px solid #d9d9d9;
  margin-bottom: 10px !important;
}

.btn:hover {
  text-decoration: none;
  background-color: #337ab7;
  border-color: #2e6da4;
}

button#saveChangesInAddress {
    margin-bottom: 0 !important;
}

.promptButton {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100px;
  opacity: 0.8;
}
</style>

<div class="mainpanel"> 
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-mobile-phone"></i>
            </div>

            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>USER'S LOCATION</li>
                </ul>
         
                <h4>USER'S LOCATION</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel users-location"> 
        <div class="contentpanel"> 
        <div class="form-popup" id="myForm">
        <form action="" class="form-container container">
                <?php require("updateAddress.php"); ?> 
        </form>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="nav-tabs">
            
            <?php if($this->session->userdata('activateAllowlocation'))
                  {
                    echo '
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#home">Unified List of Outlets </a>
                      </li> 
                      <li class="nav-item active">
                        <a class="nav-link active" id="ShowAllowLocation" data-toggle="tab" href="#menu2">View My Store Details</a>
                      </li> 
                    ';
                  } else {
                    echo '
                      <li class="nav-item active">
                      <a class="nav-link active" data-toggle="tab" href="#home">Unified List of Outlets </a>
                      </li> 
                      <li class="nav-item">
                      <a class="nav-link" id="ShowAllowLocation" data-toggle="tab" href="#menu2">View My Store Details</a>
                      </li> 
                    ';
                  }
                ?>
            
        </ul> 
       
        <!-- Tab panes -->
        <div class="tab-content" id="tab-contents">
                <?php if($this->session->userdata('activateAllowlocation') )
                  {
                    echo '
                      <div id="home" class="contentpanel tab-pane fade"><br> 
                    ';
                  } else {
                    echo '
                      <div id="home" class="contentpanel tab-pane active"><br> 
                    ';
                  }
                ?>
              
              <div class="row">
                <div class="col-md-12 filters">
                  <table class="table">
                    <tr> 
                      <td> 
                      <label for="currectLocationName">Search Address:</label>
                      <input  class="form-control" id="userlevel" value="<?php echo $this->user['L'];?>" type="hidden">
                      <input  class="form-control" id="currectLocation" type="hidden">
                      <input class="form-control" id="currectLocationName" type="text">
                      </td>
                    </tr>
                  <tr>
                  <td>
                  <label for="selAccountType">Filter Account:</label>
                      <select class="form-control form-select form-select-sm" id="selAccountType" name="selAccountType">
                              <option value="" disabled selected>ALL</option>
                              <option value="6">UNIFIED DEALERS </option>
                              <option value="16">UNIFIED PAYMENT CENTERS </option>
                              <option value="7">UNIFIED HUBS/CORPORATE PARTNERS </option>
                      </select>
                  </td> 
                  <td>
                  <label for="selAccountType">Filter Location:</label>
                      <select class="form-control form-select form-select-sm" onchange="showSelect()" id="filterLocation" name="filterLocation">
                              <option value="" disabled selected>ALL</option>
                              <option value="COUNTRY">COUNTRY</option>
                              <option value="REGION"> REGION</option>
                              <option value="PROVINCE">PROVINCE-CITY</option> 
                      </select>  
                  </td> 
                  <td>
                  <label for="selAccountType">Select:</label>
                      <select hidden class="form-control form-select form-select-sm" id="country" name="country"> 
                        <option value="" disabled selected>ALL</option>
                      </select> 
                      <select hidden class="form-control form-select form-select-sm" id="region" name="region"> 
                        <option value="" disabled selected>ALL</option>
                      </select> 
                      <select hidden class="form-control form-select form-select-sm" id="province" name="province"> 
                        <option value="" disabled selected>ALL</option>
                      </select> 
                      <select hidden class="form-control form-select form-select-sm" id="none" name="none"> 
                        <option value="" disabled selected>ALL</option>
                      </select>
                    </td> 
                  <td>
                      <label for="radius">Distance (KM):</label>

                      <input class="form-control" type="text" list="kmlist" id="radius" name="radius" value='1' placeholder="Enter a Distance"/>

                      <datalist id="kmlist">
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                        <option>40</option>
                        <option>50</option>
                        <option>60</option>
                        <option>70</option>
                        <option>80</option>
                        <option>90</option>
                        <option>100</option>
                      </datalist>

                      <!-- <select class="form-control form-select form-select-sm"  id="radius" name="radius">
                        <option value="" disabled selected>SELECT DISTANCE</option>
                        <option value="10">10 KM</option>
                        <option value="20">20 KM</option>
                        <option value="30">30 KM</option>
                        <option value="40">40 KM</option>
                        <option value="50">50 KM</option>
                      </select>   -->
                  </td> 
                  </tr> 
                  <tr>
                    <td>
                    </td> 
                  </tr> 
                  <tr>
                    <td>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="nTf" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Nearest To Farthest</label>
                      </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input"  id='fTn' type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">Farthest To Nearest</label>
                      </div>  
                    </td>
                    <td> 
                    </td>
                  </tr>
              </table>
              <div class="col-md-12">
                <div class="form-group"> 
                  <button type="button" id="btnSearch" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>    
                  <button type="button" id="btnRemoveFilter" name="btnSearch" class="btn btn-danger"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;REMOVE FILTER</button>     
                  <button type="button" id="btnNearbyOutlet" name="btnSearch" class="btn btn-warning"><i class="glyphicon glyphicon-map-marker"></i>&nbsp;NEARBY OUTLET</button>     
                </div>
              </div>
            </div>
           
            </div>
            <table id="locationTable" class="table table-striped table-bordered" style="width:100%;overflow-y: scroll;">
                <thead>   
                    <tr> 
                        <th width="150">Account Type</th>
                        <th width="150">Complete Location</th>
                        <th width="150">Distance (km)</th>
                    </tr>
                </thead> 
                <tbody>
                </tbody>  
            </table> 
            </div> 
            <?php if($this->session->userdata('activateAllowlocation') )
              {
                echo '
                <div id="menu2" class="contentpanel tab-pane active"><br> 
                ';
              } else {
                echo '
                <div id="menu2" class="contentpanel tab-pane fade"><br> 
                ';
              }
            ?>
             
            
            <!-- Rounded switch --> 
                    <div class="contentpanel">
                      <div class="row">
                        <div class="col-xs-6 col-md-3">
                          <a href="#" class="thumbnail">
                            <img src="<?php echo BASE_URL()?>assets/images/photos/default_photo.png" alt="profile">
                          </a>
                        </div>
                        
                        <div class="col-xs-6 col-md-9"> 
                              <b style="font-size: 18px;"> MY LOCATION INFORMATION </b>
                              <br /> 
                              <br />
                            <table class="table table-bordered"> 
                                <?php if (($this->user['L'] == 1 || $this->user['L'] == 6 || $this->user['L'] == 14 || $this->user['L'] == 15) && $locationService['visible'] !== null) {?>
                                <tr>
                                  <td>
                                    <b>Location Status: <?php if($locationService['visible'] == 1){ echo 'ON'; } else { echo "OFF";} ?></b>
                                  </td>
                                  <td> 
                                    <label class="switch">
                                      <input id="toggle-event" <?php if($locationService['visible'] == 1){ echo ' checked="checked"'; } ?> type="checkbox">
                                      <span class="slider round"> 
                                      </span>
                                    </label>
                                  </td> 
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td>
                                        <b>Outlet Name</b>
                                    </td>
                                    <td>
                                        <h4 class="text-center" style="color:#fca600"><input class='disableTxt form-control input-sm' id="iName" type="text" disabled value="<?php echo $locationService['name'] ?>"></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Full Address</b></td>
                                    <td><button type="button" disabled id="showUpdateAddress" onclick="openForm()" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#mapModal">...  <?php echo $locationService['detailedAdd']; ?></button></td>
                                    
                                    <td hidden id="sdLatLong"></td>
                                    <td hidden id="sdCountry"></td>
                                    <td hidden id="sdRegion"></td>
                                    <td hidden id="sdProvince"></td>
                                    <td hidden id="sdCity"></td>
                                    <td hidden id="sdBrgy"></td>
                                    <td hidden id="sdDetailedAdd"></td>
                                </tr>
                                <tr>
                                    <td><b>Store Hours </b></td>
                                    <td><input type="text"  class="form-control input-sm" disabled id="storeSchedule" value="<?php echo $locationService['storeOpeningDay']." To ".$locationService['storeClosingDay']." TIME: ".$locationService['storeOpeningHours']." To ".$locationService['storeClosingHours'] ?>"></td>
                                    <tr  class="hid">
                                        <td>
                                            <small for="sel1">From:</small>
                                            <select onchange="onchanged()" class="form-control input-sm"  id="openingDay">
                                                <option <?php if($locationService['storeOpeningDay'] == 'Monday'){ echo ' selected="selected"'; } ?> >Monday</option>
                                                <option <?php if($locationService['storeOpeningDay'] == 'Tuesday'){ echo ' selected="selected"'; } ?>>Tuesday</option>
                                                <option <?php if($locationService['storeOpeningDay'] == 'Wednesday'){ echo ' selected="selected"'; } ?>>Wednesday</option>
                                                <option <?php if($locationService['storeOpeningDay'] == 'Thursday'){ echo ' selected="selected"'; } ?>>Thursday</option>
                                                <option <?php if($locationService['storeOpeningDay'] == 'Friday'){ echo ' selected="selected"'; } ?>>Friday</option>
                                                <option <?php if($locationService['storeOpeningDay'] == 'Saturday'){ echo ' selected="selected"'; } ?>>Saturday</option>
                                                <option <?php if($locationService['storeOpeningDay'] == 'Sunday'){ echo ' selected="selected"'; } ?> >Sunday</option>
                                            </select> 
                                            <small for="sel1">To:</small>
                                            <select onchange="onchanged()" class="form-control input-sm"   id="closingDay">
                                                <option <?php if($locationService['storeClosingDay'] == 'Monday'){ echo ' selected="selected"'; } ?>>Monday</option>
                                                <option <?php if($locationService['storeClosingDay'] == 'Tuesday'){ echo ' selected="selected"'; } ?>>Tuesday</option>
                                                <option <?php if($locationService['storeClosingDay'] == 'Wednesday'){ echo ' selected="selected"'; } ?>>Wednesday</option>
                                                <option <?php if($locationService['storeClosingDay'] == 'Thursday'){ echo ' selected="selected"'; } ?>>Thursday</option>
                                                <option <?php if($locationService['storeClosingDay'] == 'Friday'){ echo ' selected="selected"'; } ?>>Friday</option>
                                                <option <?php if($locationService['storeClosingDay'] == 'Saturday'){ echo ' selected="selected"'; } ?>>Saturday</option>
                                                <option <?php if($locationService['storeClosingDay'] == 'Sunday'){ echo ' selected="selected"'; } ?> >Sunday</option>
                                            </select>
                                        </td> 
                                        <td>
                                        <small for="openTime">Opening time:</small>
                                        <input class="form-control input-sm" onchange="onchanged()" value="<?php echo $locationService['storeOpeningHours'] ?>" type="time" id="openTime" name="openTime">  
                                        <small for="closeTime">Closing time:</small>
                                         <input class="form-control input-sm" onchange="onchanged()" value="<?php echo $locationService['storeClosingHours'] ?>" type="time" id="closeTime" name="openTime"> 
                                        </td> 
                                    </tr>
                                    <tr  class="hid">
                                        
                                    </tr>
                                </tr>
                                <tr>
                                    <td><b>Store Email Address </b></td>
                                    <td> 
                                    <input class='form-control input-sm'     type="text" id="HidiEmail" disabled value="<?php echo $locationService['storeEmail'] ?>" autocomplete="off">
                                    <small for="iEmail" class="hid">Enter new email</small>   
                                    <div class="input-group hid"> 
                                         
                                        <input class='disableTxt form-control input-sm' onchange="onchanged()" required type="text" id="iEmail" disabled value="<?php echo $locationService['storeEmail'] ?>" autocomplete="off">
                                        <span class="input-group-btn"> 
									    <button id="btnEmailSend"  onclick="sendCode('EMAIL')" class="btn btn-default"  type="button" tabindex="-1" style="height:40px;">Verify</button> 
									    </span>
									    </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td><b>Contact Number </b></td>
                                    <td> 
                                    <input class='form-control input-sm'     type="text" id="HidiContact" disabled value="<?php echo $locationService['storeContact'] ?>" autocomplete="off">
                                    <small for="iEmail" class="hid">Enter new Contact</small>    
                                    <div class="input-group hid"> 
                                        <input class='disableTxt form-control input-sm' onchange="onchanged()" required type="text" id="iContact" disabled value="<?php echo $locationService['storeContact'] ?>" autocomplete="off">
                                        <span class="input-group-btn"> 
									    <button id="btnContactSend" onclick="sendCode('SMS')" class="btn btn-default" type="button" tabindex="-1" style="height:40px;">Verify</button> 
									    </span>
									    </div>
                                    </td>
                                </tr> 
                            </table>
                            <div class="col-md-12 text-right">
                                <div class="hid">
                                    <button type="button"  onclick="validateChanges()" class="btn btn-danger" id="cancel">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="showSummary">Save</button>
                                </div>
                                <br>
                              <button type="button" class="btn btn-primary" onclick="Update()" id="btnSubmit">Update</button> 
                            </div>
                        </div>
                      </div> 
                    </div><!-- contentpanel -->          
            </div>
        </div>  
        </div> 
    </div><!-- contentpanel -->
</div><!-- mainpanel -->      

<!-- for pin verification of email -->
<!-- Modal -->
<div class="modal fade" id="verifyEmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verify Email Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  "> 
          <div class="row">
            <div class="col-md-12 text-right">
                <input class='disableTxt form-control input-sm col-xs-6' required type="text" id="iEmailPin" value="">
            </div> 
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="VerifyCode('EMAIL')" class="btn btn-secondary" id="verifyEmailPin">Verify</button>
        <button type="button" onclick="sendCode('EMAIL')" id="resendEmail" class="btn btn-primary">Resend</button>
      </div>
    </div>
  </div>
</div>



<!-- summary modal -->
<div class="modal fade" id="summaryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:1000px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Summary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  "> 
          <div class="row">
            <div class="col-md-12 text-right">
                <table class="table"> 
                <tr>
                    <td>
                        <b>Outlet Name</b>
                    </td>
                    <td>
                        <h4 class="text-center" style="color:#fca600"><input disabled class='form-control input-sm' id="sname" type="text" disabled value=""></h4>
                    </td>
                </tr>
                <tr>
                    <td><b>Full Address</b></td>  
                    <td>
                        <input type="text"  disabled class="form-control input-sm"  id="saddress"   value="">
                    </td>
                </tr>
                <tr>
                    <td><b>Store Hours </b></td>
                    <td><input type="text"  disabled class="form-control input-sm"  id="sstoreSchedule"   value=""></td>
                </tr>
                <tr>
                    <td><b>Store Email Address </b></td>
                    <td> 
                    <input class='form-control input-sm'     type="text" id="semail" disabled value="">
                    
                </tr>
                <tr>
                    <td><b>Contact Number </b></td>
                    <td> 
                    <input class='form-control input-sm'     type="text" id="scontact" disabled value="">
                </tr> 
            </table>
            </div> 
          </div>
      </div>
      <div class="modal-footer"> 
          <button type="button"  class="btn btn-primary" id="btnSaveDetails">Yes</button> 
        <button type="button" data-dismiss="modal" class="btn btn-danger">No</button>
      </div>
    </div>
  </div>
</div> 

<!-- for pin verification of mobile -->
<!-- Modal -->
<div class="modal fade" id="verifyContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verify Mobile Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  "> 
          <div class="row">
            <div class="col-md-12 text-right">
                <input class='disableTxt form-control input-sm col-xs-6' required type="text" id="iSmsPin" value="">
            </div> 
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="VerifyCode('SMS')" class="btn btn-secondary" id="verifySmsPin">Verify</button>
        <button type="button" onclick="sendCode('SMS')" id="resendSms" class="btn btn-primary">Resend</button>
      </div>
    </div>
  </div>
</div> 
<div class="d-flex justify-content-center">
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalMapframe">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content" >
      <div class="modal-header">
        <h4>View Location</h4>
        <button type="button"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body"> 
        
        <iframe width="100%" height="80%" src="" class="" name="mapFrame" id="mapFrame"></iframe> 
        <input type="hidden" class="form-control" name="inputdragonpayURL" id="inputdragonpayURL" value="<?php echo $inputdragonpayURL; ?>"/>
      </div> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="cancelChangesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Prompt</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to cancel? Changes you made will not be saved.</h5>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCancelDetails" class="btn btn-primary promptButton">Yes</button>
        <button type="button"  data-dismiss="modal" class="btn btn-primary promptButton">No</button>
      </div>
    </div>
  </div>
</div>
<!-- 
<?php if ($locationService['visible'] == 0 && $locationService['visible'] != null) {?>
<div class="modal fade" id="userlevel6LocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4>Prompt</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h5 class="modal-title" id="exampleModalLabel">Allow Unified to display your location details?</h5>
      </div>
      <div class="modal-footer">
        <button type="button"  id="visibilityOn" class="btn btn-secondary">Yes</button>
        <button type="button" onclick="window.location.reload(true);"   class="btn btn-primary">No</button>
      </div>
    </div>
  </div>
</div>
<?php } ?> -->
<!-- show location Modal -->
<div class="modal fade" id="nearbyOutletModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 60%;">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4>Nearby Outlet</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <iframe width="100%" height="80%" src="" class="" name="nearbyOutletFrame" id="nearbyOutletFrame"></iframe>
      </div> 
    </div>
  </div>
</div>

<!-- Modal -->
<!-- <div id="loading" class="modal fade" role="dialog">
  <div class="modal-dialog" style="height:40%;width:20%"> 
        <div id="first modal-content"  style=" 
    height:100%;
    width:100%;
    bottom:0;
    left:0;
    right:0;
    top:20%;  
    opacity:0.8;
    background-color:#000;
    color:#fff;
    z-index:9999;">
          <img style=" height:100%;
    width:100%;
     " src="http://i.stack.imgur.com/XEupj.gif">
        </div> 
  </div>
</div> -->
 
 
<script>
    $('.hid').hide(); 
    $('#btnEmailSend').hide();  
    $('#btnContactSend').hide();  
    $('#input_starttime').pickatime({});
function openForm() {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("tab-contents").style.display = "none";
  document.getElementById("nav-tabs").style.display = "none";
}



function onchanged() {
   let openTime =  $("#openTime").val();
   let closeTime =  $("#closeTime").val();
   let openDay =  $("#openingDay").val();
   let closeDay =  $("#closingDay").val();  
   if ($("#HidiEmail").val() != $("#iEmail").val()) {
        $('#btnEmailSend').show('slow');  
   } else { 
        $('#btnEmailSend').hide('slow');  
   }
   if ($("#HidiContact").val() != $("#iContact").val()) {
        $('#btnContactSend').show('slow');  
   } else { 
        $('#btnContactSend').hide('slow');  
   }

   openTime = openTime.replace(":",'').replace(/(\d+)/g, (match) => {return getFormattedTime(match)});
   closeTime = closeTime.replace(":",'').replace(/(\d+)/g, (match) => {return getFormattedTime(match)});

   $("#storeSchedule").val(openDay+" To "+closeDay+ " TIME: "+ openTime+ " To "+closeTime);  
}

function getFormattedTime(fourDigitTime) {
    var hours24 = parseInt(fourDigitTime.substring(0, 2),10);
    var hours = ((hours24 + 11) % 12) + 1;
    var amPm = hours24 > 11 ? 'pm' : 'am';
    var minutes = fourDigitTime.substring(2);
    return hours + ':' + minutes + amPm;
};

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("pac-input").value = "";
  document.getElementById("tab-contents").style.display = "block";
  document.getElementById("nav-tabs").style.display = "block";
  clearText();
}

function Update() { 
    if($('.hid').css('display') == 'none'){ 
        $('.hid').show('slow'); 
        $('#btnSubmit').hide('slow'); 
        $('#showUpdateAddress').removeAttr("disabled");
        $('.disableTxt').removeAttr("disabled");
    } 
}

function validateChanges() {
    let name = $("#iName").val();
    let alatLong = $("#alatLong").val();
    let aCountry = $("#aCountry").val();
    let aRegion = $("#aRegion").val();
    let aProvince = $("#aProvince").val();
    let aCity = $("#aCity").val();
    let aBrgy = $("#aBrgy").val();
    let aDetailedAdd = $("#aDetailedAdd").val();
    let storeOpeningDay = $("#openingDay").val();
    let storeClosingDay = $("#closingDay").val();
    let storeOpeningHours = $("#openTime").val();
    let storeClosingHours = $("#closeTime").val();
    let email = $("#iEmail").val();
    let contact = $("#iContact").val(); 

    var parameter = {
        'name':name,
        'latlong':alatLong,
        'country':aCountry,
        'region':aRegion,
        'province':aProvince,
        'city':aCity,
        'brgy':aBrgy,
        'detailedAdd':aDetailedAdd, 
        'storeOpeningDay':storeOpeningDay,
        'storeClosingDay':storeClosingDay,
        'storeOpeningHours':storeOpeningHours,
        'storeClosingHours':storeClosingHours,
        'storeEmail':email,
        "storeContact":contact
    };

    $.ajax({
      url: '<?php echo BASE_URL().'Users_location'?>'+"/ajaxcheckUpdate",
      type: "POST",
      data: parameter,
      dataType: "json",
      cache: false,
      success: function (response) {
         if (response.S == 0) {
            $("#cancelChangesModal").modal("show"); 
         } else {
            location.reload();
         }
      }
    });
}

var emailCodeTimer = setInterval(countdown, 1000);
function startTimerEmail() { 
    var timeLeft = 60; 
    emailCodeTimer = setInterval(countdown, 1000);
    
    function countdown() {
        if (timeLeft == -1) {
            clearTimeout(emailCodeTimer); 
            $("#resendEmail").html('Resend');
            $("#resendEmail").removeAttr("disabled"); 
        } else { 
            $("#resendEmail").attr('disabled', 'disabled');
            $("#resendEmail").html('Resend '+timeLeft);
            timeLeft--;
        }
    }
}
var smsCodeTimer = setInterval(countdown, 1000);
function startTimerSms() { 
    var timeLeft = 60; 
    smsCodeTimer = setInterval(countdown, 1000);
    
    function countdown() {
        if (timeLeft == -1) {
            clearTimeout(smsCodeTimer); 
            $("#resendSms").html('Resend');
            $("#resendSms").removeAttr("disabled"); 
        } else { 
            $("#resendSms").attr('disabled', 'disabled');
            $("#resendSms").html('Resend '+timeLeft);
            timeLeft--;
        }
    }
}
function sendCode(type) { 
    if(type == 'EMAIL') {
        var parameter = {
          type: "EMAIL",
          email:  $("#iEmail").val()
        };

        $.ajax({
          url: '<?php echo BASE_URL().'Users_location'?>'+"/sendVerification",
          type: "POST",
          data: parameter,
          dataType: "json",
          cache: false,
          success: function (response) {  
              if (response.S == 0) {
                  alert(response.M);
              } else { 
                  clearTimeout(emailCodeTimer); 
                  startTimerEmail();
                  $("#verifyEmailModal").modal('show');
              }
          }
        });
    } 
    if(type == "SMS") {
        var parameter = {
          type: "SMS",
          mobile:  $("#iContact").val()
        };

        $.ajax({
          url: '<?php echo BASE_URL().'Users_location'?>'+"/sendVerification",
          type: "POST",
          data: parameter,
          dataType: "json",
          cache: false,
          success: function (response) {
              
              if (response.S == 0) { 
                  alert(response.M);
              } else { 
                  clearTimeout(smsCodeTimer); 
                  startTimerSms();
                  $("#verifyContactModal").modal('show');
              }
          }
        });
    }
} 

function VerifyCode(type) { 
    if(type == 'EMAIL') {
        var parameter = {
        type: "EMAIL",
        email:  $("#iEmail").val(),
        vcode: $("#iEmailPin").val()
        };

        $.ajax({
        url: '<?php echo BASE_URL().'Users_location'?>'+"/verifyPin",
        type: "POST",
        data: parameter,
        dataType: "json",
        cache: false,
        success: function (response) {  
            if (response.S == 0) {
                alert(response.M);
            } else {    
                $("#verifyEmailModal").modal("hide");
                $('#btnEmailSend').hide('slow');  
                $("#HidiEmail").val($("#iEmail").val());
                alert("Email Address has been successfully verified and set.");
            }
        }
        });
    } 
    if(type == "SMS") {
        var parameter = {
        type: "SMS",
        mobile:  $("#iContact").val(),
        vcode: $("#iSmsPin").val()
        };

        $.ajax({
        url: '<?php echo BASE_URL().'Users_location'?>'+"/verifyPin",
        type: "POST",
        data: parameter,
        dataType: "json",
        cache: false,
        success: function (response) {
             
            if (response.S == 0) { 
                alert(response.M);
            } else {  
               $("#verifyContactModal").modal("hide");
               $('#btnContactSend').hide('slow');  
               $("#HidiContact").val($("#iContact").val());
               alert("Mobile Number  has been successfully verified and set.");
            }
        }
        });
    }
} 
</script>

<script>
    $( "#showSummary" ).click(function() {
      let name = $("#iName").val();
      let alatLong = $("#sdLatLong").html();
      let aCountry = $("#sdCountry").html();
      let aRegion = $("#sdRegion").html();
      let aProvince = $("#sdProvince").html();
      let aCity = $("#sdCity").html();
      let aBrgy = $("#sdBrgy").html();
      let aDetailedAdd = $("#sdDetailedAdd").html();
      let storeOpeningDay = $("#openingDay").val();
      let storeClosingDay = $("#closingDay").val();
      let storeOpeningHours = $("#openTime").val();
      let storeClosingHours = $("#closeTime").val();
      let email = $("#iEmail").val();
      let contact = $("#iContact").val(); 
      
      storeOpeningHours = storeOpeningHours.replace(":",'').replace(/(\d+)/g, (match) => {return getFormattedTime(match)});
      storeClosingHours = storeClosingHours.replace(":",'').replace(/(\d+)/g, (match) => {return getFormattedTime(match)});

      var parameter = {
        'name': name,
        'latlong': alatLong,
        'country': aCountry,
        'region': aRegion,
        'province': aProvince,
        'city': aCity,
        'brgy': aBrgy,
        'detailedAdd': aDetailedAdd, 
        'storeOpeningDay': storeOpeningDay,
        'storeClosingDay': storeClosingDay,
        'storeOpeningHours': storeOpeningHours,
        'storeClosingHours': storeClosingHours,
        'storeEmail': email,
        "storeContact": contact
      };

      // console.log('users_location_details', parameter)

      var isFieldsValidated = true

      for (var key in parameter) {
        if (parameter.hasOwnProperty(key)) {
          if (!parameter[key]) { 
            isFieldsValidated = false
            break
          }
        }
      }

      if (isFieldsValidated)  {
        $.ajax({
          url: '<?php echo BASE_URL().'Users_location'?>'+"/ajaxcheckUpdate",
          type: "POST",
          data: parameter,
          dataType: "json",
          cache: false,
          success: function (response) {
            if (response.S == 0) {
              $("#sname").val(response.D.name); 
              $("#saddress").val(response.D.detailedAdd);
              $("#sstoreSchedule").val(response.D.storeOpeningDay+" To "+response.D.storeClosingDay + " TIME: "+response.D.storeOpeningHours+" To "+response.D.storeClosingHours);
              $("#semail").val(response.D.storeEmail);
              $("#scontact").val(response.D.storeContact);
              $("#summaryModal").modal("show");
            } else {
              alert("No changes have been made.");
            }
          }
        });
      } else { 
        alert("Oops! Please complete your store details to fully activate this new feature.");
      }
    });
</script>


<script>
    $( "#btnSaveDetails" ).click(function() { 
      $.ajax({
        url: '<?php echo BASE_URL().'Users_location'?>'+"/saveDetails",
        type: "POST",
        data: '',
        dataType: "json",
        cache: false,
        success: function (response) {
          if (response.S == 1) {
            alert("Store details has been successfully updated.");
            window.location.reload(true);
          }
        }
      });
    });

    $( "#btnCancelDetails" ).click(function() { 
      location.reload();
    });

  
</script>
  
<script>
  let table;

$(document).ready(function() { 
  $("#radius").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      return false;
    }
   });

  if ($("#userlevel").val() == 6 || $("#userlevel").val() == 1) {
    $("#userlevel6LocationModal").modal("show");
  }

  table = $('#locationTable').DataTable({"ordering": false});  
    $("#fTn").click(function() { 
      generateOutlet("desc","","");
    });
    $('#locationTable tbody').on( 'click', 'tr', function () {
      let  data = table.row( this ).data(); 
      viewMap(data[3],data[0],data[1],data[2],data[4],data[5],data[7]);
    });
    $("#nTf").click(function() {
        generateOutlet("asc","","");
    }); 
});

$("#btnSearch").click(function() { 
  if (loadedApi == false) {
    alert("Reloading this page..."); 
  }
  
  if ($("#radius").val() == "") {
    $("#radius").css('background-color', 'red'); 
  } else if ($("#currectLocationName").val() == "" || $("#currectLocation").val() == "") {
    $("#currectLocationName").css('background-color', 'red'); 
  } else {
    let search = ""; 
    if ($("#filterLocation").val() == 'REGION') {
      search = $("#region").val();
    } else if ($("#filterLocation").val() == 'COUNTRY') {
      search = $("#country").val();
    }else if ($("#filterLocation").val() == 'PROVINCE') {
      search = $("#province").val();
    }
    generateOutlet("asc",search,$("#selAccountType").val()); 
  } 

});

$("#currectLocationName").click(function() { 
   
    $("#currectLocationName").css('background-color', 'white');
   
});

$("#radius").click(function() { 
   
   $("#radius").css('background-color', 'white');
  
});
  
$("#visibilityOn").click(function() { 
 
});

$("#btnRemoveFilter").click(function() { 
  table.clear().draw();  
  $("#filterLocation").val($("#filterLocation option:first").val());
  $("#country").val($("#country option:first").val());
  $("#province").val($("#province option:first").val());
  $("#region").val($("#region option:first").val()); 
  $("#none").val($("#none option:first").val());
  $("#selAccountType").val($("#selAccountType option:first").val());
  $("#none").show("slow");
  $("#province").hide("slow");
  $("#country").hide("slow");
  $("#region").hide("slow");
  if ($("#currectLocationName").val() == "" || $("#currectLocation").val() == "") {
    $("#currectLocationName").css('background-color', 'red');
  } else { 
    // generateOutlet("asc","",""); 
  } 
});

$("#ShowAllowLocation").click(function() { 
  if ($("#userlevel").val() == 6 || $("#userlevel").val() == 1) {
    $("#userlevel6LocationModal").modal("show");
  }
});

function generateOutlet(order,search,userlevel) {

 
  let location = $("#currectLocation").val().split(",");
  // $("#loading").modal("show");
  waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
 
  table
      .clear()
      .draw();
      $.ajax({
        url: '<?php echo BASE_URL().'Users_location'?>'+"/getOutletDetails",
        type: "POST",
        data: {
          order: order,
          lat:location[0],
          lng:location[1], 
          search: search, 
          userlevel: userlevel,
          radius: $("#radius").val()
        },
        datatype: "json",
        success: function (response) {  
          // $("#loading").modal("hide");
          let res = JSON.parse(response); 
          var $empty = $('#locationTable').find('.dataTables_empty');
          if ($empty) $empty.html(res.M); 
          waitingDialog.hide();
          if (res == "null") {
            var $empty = $('#locationTable').find('.dataTables_empty');
            if ($empty) $empty.html("No nearby outlet please adjust the distance!"); 
          } else if (res.S == 0 || res.s == 0) {  
            // alert(res.M);
          } else {
            res.D.forEach((item, index) => {  
            let userLevel = ""; 
            if (item.userlevel == 1) userLevel = "UNIFIED DEALERS";
            if (item.userlevel == 6) userLevel = "UNIFIED DEALERS";
            if (item.userlevel == 7) userLevel = "UNIFIED HUBS/CORPORATE PARTNERS";
            if (item.userlevel == 16) userLevel = "UNIFIED PAYMENT CENTERS";
            if (item.userlevel == 15) userLevel = "UNIFIED DEALERS";
            if (item.userlevel == 14) userLevel = "UNIFIED DEALERS";

            let address = item.detailedAdd;
            let storeHours = "Opens from "+item.storeOpeningDay+ " To " + item.storeClosingDay + " - " + item.storeOpeningHours + " - " + item.storeClosingHours;
            const tr = $('<tr><td>'+userLevel+'</td><td>'+address+'</td><td hidden>'+storeHours+'</td><td hidden>'+item.latlong+'</td><td hidden>'+item.storeEmail+'</td><td hidden>'+item.storeContact+'</td><td>'+Number(item.distance).toFixed(2)+'</td><td hidden>'+item.name+'</td></tr>');
            table.row.add(tr[0]).draw();   

            if (item.country != "N/A" || item.region != "N/A" || item.province != "N/A" || item.city != "N/A") {
              if (!$("#country").find('option[value="' + item.country + '"]').length) { 
                $("#country").append("<option value='"+item.country+"'>"+item.country+"</option>");
              }  
              if (!$("#region").find('option[value="' + item.region + '"]').length) { 
                $("#region").append("<option value='"+item.region+"'>"+item.region+"</option>");
              }  
              if (!$("#province").find('option[value="' + item.province + '"]').length) { 
                $("#province").append("<option value='"+item.province+"'>"+item.province+"</option>");
              }   
              if (!$("#province").find('option[value="' + item.city + '"]').length) { 
                $("#province").append("<option value='"+item.city+"'>"+item.city+"</option>");
              } 
            }
          });
        }
        }
      }); 
}
function viewMap(latlong,accountType,address,hours,email,contact,name) { 
  
  // $("#mapFrame").contents().find("body").html('<style>#first{     position:absolute;    height:100%;    width:100%;    bottom:0;    left:0;    right:0;    top:0;      opacity:0.5;    background-color:#000;    color:#fff;    z-index:9999;}.load{    height:100%;    width:100%;}img{    height:100%;    width:100%;    position:absolute;}</style><div id="first"><img src="http://i.stack.imgur.com/XEupj.gif"></div>');
  $("#mapFrame").contents().find("body").html(waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'}));
  document.getElementById('mapFrame').src = window.location.href+"/mapFrame"; 
 
  $('#mapFrame').load(function() {
          $('#mapFrame').contents().find('#idDestination').attr('value', latlong);
          $('#mapFrame').contents().find('#idDestinationName').attr('value', address);
          $('#mapFrame').contents().find('#idAccountType').attr('value', accountType);
          $('#mapFrame').contents().find('#idOutletName').attr('value', name);
          $('#mapFrame').contents().find('#idFulladdress').attr('value', address);
          $('#mapFrame').contents().find('#idStoreHours').attr('value', hours);
          $('#mapFrame').contents().find('#idStoreEmail').attr('value', email);
          $('#mapFrame').contents().find('#idContactNumber').attr('value', contact);
          $('#mapFrame').contents().find('#btnDirection').attr('disabled', false);
          $('#mapFrame').contents().find('#first').attr('hidden', true); 
          waitingDialog.hide();
  });
  $("#modalMapframe").modal("show");
}

showSelect();

function showSelect() {
  // $.ajax({
  //     url: '<?php echo BASE_URL().'Users_location'?>'+"/getOutletDetailsAddress",
  //       type: "POST", 
  //       datatype: "json",
  //       success: function (response) {  
  //         // $("#loading").modal("hide");
  //         let res = JSON.parse(response);
         
  //         waitingDialog.hide();
  //         if (res == "null") {
  //           alert("No Nearby Outlet Please Adjust Radius!");
  //         }  else {
  //           res.D.forEach((item, index) => {  
  //           if (!$("#country").find('option[value="' + item.country + '"]').length) { 
  //             $("#country").append("<option value='"+item.country+"'>"+item.country+"</option>");
  //           } 
  //           if (!$("#region").find('option[value="' + item.region + '"]').length) { 
  //             $("#region").append("<option value='"+item.region+"'>"+item.region+"</option>");
  //           }  
  //           if (!$("#province").find('option[value="' + item.province + '"]').length) { 
  //             $("#province").append("<option value='"+item.province+"'>"+item.province+"</option>");
  //           }   
  //           if (!$("#province").find('option[value="' + item.city + '"]').length) { 
  //             $("#province").append("<option value='"+item.city+"'>"+item.city+"</option>");
  //           } 
  //         });
  //       }
  //       }
  //     }); 
  $("#region").val($("#region option:first").val());
  $("#country").val($("#country option:first").val());
  $("#province").val($("#province option:first").val());
  $("#none").val($("#none option:first").val());
  
  let filterLocation = $("#filterLocation").val();
      if (filterLocation == "REGION") {
        $("#region").show("slow");
        $("#country").hide("slow");
        $("#province").hide("slow");
        $("#none").hide("slow");
      } else if (filterLocation == "COUNTRY") {
        $("#country").show("slow");
        $("#region").hide("slow");
        $("#province").hide("slow");
        $("#none").hide("slow");
      } else if (filterLocation == "PROVINCE") {
        $("#province").show("slow");
        $("#country").hide("slow");
        $("#region").hide("slow");
        $("#none").hide("slow");
      } else {
        $("#none").show("slow");
        $("#province").hide("slow");
        $("#country").hide("slow");
        $("#region").hide("slow");
  } 
  
    // generateOutlet("asc","","");  
} 
</script> 
<script>
  $("#btnNearbyOutlet").click(function() {
    $("#nearbyOutletFrame").contents().find("body").html('<style>#first{     position:absolute;    height:100%;    width:100%;    bottom:0;    left:0;    right:0;    top:0;      opacity:0.5;    background-color:#000;    color:#fff;    z-index:9999;}.load{    height:100%;    width:100%;}img{    height:100%;    width:100%;    position:absolute;}</style><div id="first"><img src="http://i.stack.imgur.com/XEupj.gif"></div>');
    document.getElementById('nearbyOutletFrame').src = window.location.href+"/nearbyOutlet"; 
    
    $('#nearbyOutletFrame').load(function() {
            let location = $("#currectLocation").val().split(",");
            $('#nearbyOutletFrame').contents().find('#lat').attr('value', location[0]);
            $('#nearbyOutletFrame').contents().find('#lng').attr('value', location[1]);
            $('#nearbyOutletFrame').contents().find('#radius').attr('value', $("#radius").val()); 
    });
    $("#nearbyOutletModal").modal("show");
    
  }); 
</script>

<script>
  $(function() {
    $('#toggle-event').change(function() { 
      if (loadedApi == false) {
        alert("Reloading this page..."); 
      }
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        $.ajax({
            url: '<?php echo BASE_URL().'Users_location'?>'+"/LocationVisibility",
            type: "POST",
            data: '',
            dataType: "json",
            cache: false,
            success: function (response) {
                waitingDialog.hide(); 
                if (response.S == 1) {
                    alert(`Your store details are now ${document.getElementById("toggle-event").checked ? 'visible' : 'hidden' } to clients.`); 
                    $("#userlevel6LocationModal").modal("hide");
                    window.location.reload(true);
                } else {
                    alert(response.M);
                }
            }
          }); 
    })
  })
</script>