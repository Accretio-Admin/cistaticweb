<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

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
      <div style="width: 50rem; margin: auto;">
          <ul class="list-group list-group-flush important">
            <li class="list-group-item"><b>IMPORTANT : Please Read</b></li>
              <li class="list-group-item">• All registration/activation codes will be sent to buyer's email address.</li>
              <li class="list-group-item">• Please verify if the email of the client is valid and working. </li>
              <li class="list-group-item">• Charges per country will vary, please select appropriate country.</li>
          </ul>
      </div>
      <form method="POST" action="<?php echo BASE_URL()?>Buycodes/buycodes" id="selectPackage">
        <input type="hidden" name="package_select" value="" id="package_select" />
        <?php for($i=0;$i<count($items['M']);$i++){?>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
            <div class="buycodes-form" align="center" onclick='submit("<?php echo urlencode(json_encode(array($items['M'][$i]))); ?>")'>
                <?php if($items['M'][$i]['id'] == '12') { ?>
                  <img src="<?php echo $items['M'][$i]['image'];?>" alt="" style="margin:0 auto; width:50%; height:65%; margin-top:20px">
                <?php } else { ?>
                  <img src="<?php echo $items['M'][$i]['image'];?>" alt="" style="margin:0 auto; width:50%; height:65%; margin-top:20px">
                <?php } ?>                                 
              <div class="align-items">
                  <h5><b><?php echo $items['M'][$i]['package_name']?></b></h5>
                  <?php if($items['M'][$i]['discount'] > 0) { ?>
                    <p style="color: rgb(196, 196, 196)"><del><b>₱<?php echo $items['M'][$i]['amount']?></b></del></p>
                    <p style="margin-top: -10px;"><b>₱<?php $a=$items['M'][$i]['amount']-$items['M'][$i]['discount']; echo $a.'.00'?></b></p>
                  <?php } else { ?>
                    <p><b>₱<?php echo $items['M'][$i]['amount']?></b></p>
                  <?php } ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </form>
    </div><!-- row -->
  </div><!-- contentpanel -->
</div><!-- mainpanel -->        
<script type="text/javascript">
  function submit(valpass){
    document.getElementById("package_select").value = valpass;
    document.getElementById("selectPackage").submit();
  }
</script>

<style>
@media screen and (max-width: 390px){
  .buycodes-form {
    width: 70%;
    height: 30%;
    margin-left: 30%;
    margin-right: 10%;
    margin-top: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    padding: 10px;
    transition: transform .2s;
  }
  .important{
    margin-top: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
  }
  .buycodes-form:hover{
    transform: scale(1.05); 
    cursor: pointer;
    transition: ease-in-out .3s;
  }
}

@media screen and (min-width: 391px){
  .buycodes-form {
    width: 60%;
    height: 30%;
    margin-left: 33%;
    margin-right: 10%;
    margin-top: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    padding: 10px;
    transition: transform .2s;
  }
  .important{
    margin-top: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
  }
  .buycodes-form:hover{
    transform: scale(1.05); 
    cursor: pointer;
    transition: ease-in-out .3s;
  }
}

@media screen and (min-width: 411px){
  .buycodes-form {
    width: 60%;
    height: 35%;
    margin-left: 30%;
    margin-right: 10%;
    margin-top: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    padding: 10px;
    transition: transform .2s;
  }
  .important{
    margin-top: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
  }
  .buycodes-form:hover{
    transform: scale(1.05); 
    cursor: pointer;
    transition: ease-in-out .3s;
  }
}

@media screen and (min-width: 446px){
  .buycodes-form {
    width: 60%;
    height: 25%;
    margin-left: 25%;
    margin-right: 10%;
    margin-top: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    padding: 10px;
    transition: transform .2s;
  }
  .important{
    margin-top: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
  }
  .buycodes-form:hover{
    transform: scale(1.05); 
    cursor: pointer;
    transition: ease-in-out .3s;
  }
}

@media screen and (min-width: 601px) {
  .buycodes-form {
    width: 50%;
    height: 15%;
    margin-left: 25%;
    margin-right: 25%;
    margin-top: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    padding: 10px;
    transition: transform .2s;
  }
  .important{
    margin-top: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
  }
  .buycodes-form:hover{
    transform: scale(1.05); 
    cursor: pointer;
    transition: ease-in-out .3s;
  }
}

@media screen and (min-width: 768px) {
  .buycodes-form {
    width: 50%;
    height: 25%;
    margin-left: 25%;
    margin-right: 25%;
    margin-top: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    padding: 10px;
    transition: transform .2s;
  }
  .important{
    margin-top: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
  }
  .buycodes-form:hover{
    transform: scale(1.05); 
    cursor: pointer;
    transition: ease-in-out .3s;
  }
}

@media screen and (min-width: 992px) {
  .buycodes-form {
    width: 60%;
    height: 35%;
    margin-left: 25%;
    margin-right: 25%;
    margin-top: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    padding: 10px;
    transition: transform .2s;
  }
  .important{
    margin-top: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
  }
  .buycodes-form:hover{
    transform: scale(1.05); 
    cursor: pointer;
    transition: ease-in-out .3s;
  }
}

@media screen and (min-width: 1200px) {
  .buycodes-form {
    width: 50%;
    height: 35%;
    margin-left: 20%;
    margin-right: 20%;
    margin-top: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
    padding: 10px;
    transition: transform .2s;
  }

  .important{
    margin-top: 15px;
    box-shadow: 0 15px 20px rgba(128,128,128,0.3), 0 15px 20px rgba(128,128,128,0.3);
  }

  .buycodes-form:hover{
    transform: scale(1.05); 
    cursor: pointer;
    transition: ease-in-out .3s;
  }
}
</style>

