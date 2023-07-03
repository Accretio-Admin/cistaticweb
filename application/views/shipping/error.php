<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-book"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL().'hotels'; ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>Hotels</li>
              </ul>
              <h4>Hotel Booking</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  
  <div class="contentpanel">
    <div style="padding-bottom: 10px;">
      <div style="padding-bottom: 10px;">
        <a href="<?php echo BASE_URL()."hotels"?>" class="btn btn-default-alt" style="background-color: transparent;"> <span aria-hidden="true">←</span> BACK </a>
      </div>
      <div class="alert alert-danger" >
        <strong><?php echo $error?></strong>
      </div>
    </div>
  </div>
</div>