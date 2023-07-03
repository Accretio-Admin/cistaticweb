  <div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-money"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>Activity Logs</li>
              </ul>
              <h4>Activity Logs</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  <div class="contentpanel">
    <div class="row">
        <div class="col-md-12 hidden-xs " align="center" style="margin-bottom:10px">
           <!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->

                <!-- ups-leaderboard -->
<!--                 <ins class="adsbygoogle"
                     style="display:inline-block;width:728px;height:90px"
                     data-ad-client="ca-pub-1517010537439957"
                     data-ad-slot="4829683428"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script> -->
        </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-12">
          <div class="text-right" style="margin-bottom:5px">
              <span class="badge badge-primary"></span>
          </div>
          <br>
             <h5> Last Password Changed : <br> <?php echo $results['TDATA']['LP'] ?> </h5> <br>
             <h5> Last Log in : <br>  <?php echo $results['TDATA']['LL'] ?> </h5>
      </div>
    </div>

    
  
</div><!-- mainpanel -->            