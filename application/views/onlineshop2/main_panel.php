  <style type="text/css">
    .buycodepack{
      border:1px solid white;
    }
    .buycodepack:hover{
      cursor: pointer;
      -webkit-transition: border-color 0.5s ease;
      -moz-transition: border-color 0.5s ease;
      -o-transition: border-color 0.5s ease;
      -ms-transition: border-color 0.5s ease;
      transition: border-color 0.5s ease; 
      border:1px solid gray;
    }
  </style>
  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Online Shop</li>
                                </ul>
                                <h4>Buycodes</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">

                        <div class="row row-stat">
                            <div class="col-sm-12 document">
                              <table>
                                <tr>
                                  <td><img  src="<?php echo BASE_URL() ?>assets/images/flags2/<?php echo $items['L_DATA']['Description']; ?>.png" alt="" style="width:40px; height:40px;"></td>
                                  <td style="padding-left:5px;"><span><?php echo $items['L_DATA']['Description']; ?><br>Your IP: <?php echo $this->ip; ?></span></td>
                                </tr>
                              </table>
                            </div> 

                              <div class="row">                      
                                <div class="col-sm-9 col-md-9">
                                    <div class="tab-content nopadding noborder">
                                        <div class="tab-pane active" id="activities">
                                            <div class="follower-list">  
                                                <div class="col-sm-10">
                                                    <div class="row media-manager">
                                                    <?php if($retailer != 1): ?>
                                                      <form method="POST" action="<?php echo BASE_URL()?>Online_shop2/" id="selectPackage">
                                                      <input type="hidden" name="package_select" value="" id="package_select" />
                                                      <?php
                                                        for($i=0;$i<count($items['P_DATA']);$i++){
                                                          ?>
                                                          <div class="col-xs-6 col-sm-4 col-md-3 document buycodepack" onclick='submit("<?php echo urlencode(json_encode(array($items['L_DATA']['Description'],$items['P_DATA'][$i]))); ?>")'>
                                                            <div class="thmb">
                                                                <div style="background-color:white; width:auto; height:auto; float:left; position:absolute; top:35px; left:-20px; padding:5px; border:1px solid;">
                                                                <span style="font-size:14px; color:#C7080B;">PHP <?php echo number_format($items['P_DATA'][$i]['NetPrice'],2); ?></span>
                                                                <?php
                                                                  if($items['P_DATA'][$i]['Discount'] > 0){
                                                                    ?>
                                                                    <br><span style="font-size:10px; text-decoration: line-through;">PHP <?php echo $items['P_DATA'][$i]['Price']; ?></span>
                                                                    <span style="font-size:10px;">-<?php echo $items['P_DATA'][$i]['Discount']; ?></span>
                                                                    <?php
                                                                  }
                                                                ?>
                                                                </div>
                                                                <div class="thmb-prev  text-center">
                                                                  <img src="<?php echo BASE_URL() ?>assets/images/pkit.png" alt="" style="margin:0 auto; width:100px; height:150px;">
                                                                </div>
                                                                <h5 class="fm-title text-center"><?php 
                                                                  $name_arr = explode(' ', $items['P_DATA'][$i]['Name']);
                                                                  for($j=0;$j<count($name_arr);$j++){
                                                                    $name_val .= ucfirst(strtolower($name_arr[$j])).' ';
                                                                  }
                                                                  $name_val = trim($name_val);
                                                                  echo $name_val.' Package';
                                                                  unset($name_val);
                                                                ?>
                                                                </h5>
                                                            </div>
                                                          </div>
                                                          <?php
                                                        } 
                                                      ?>
                                                      </form>
                                                      <?php endif ?>
                                                     </div>
                                                 </div>      
                                            </div><!-- activity-list -->
                                        </div><!-- tab-pane -->
                                    </div>
                                </div><!-- col-md-8 -->
                              </div>
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                </div><!-- mainpanel -->        
                      <div class="">
            <div style="position:fixed; width:100%; height:70px;  padding:5px; bottom:0px;margin-left:25%;">

            <script type="text/javascript">
              function submit(valpass){
                document.getElementById("package_select").value = valpass;
                document.getElementById("selectPackage").submit();
              }
            </script>
              </div>     