<div class="container" style="margin:5%;">
	<div class="col-sm-6 col-md-6" style="padding-top: 10%;">
        <input type="hidden" name="cctype" class="cctype" value="<?php echo $result['S']; ?>">
        <?php if ($result['S'] === 0 || $result['S'] === '0' ): ?>
      		<div class="alert alert-danger-customized" style="opacity: none!important;">
    	  		<p><h4><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong><?php echo $result['H']; ?></strong></h4></p>
    	  		<p><?php echo $result['M']; ?></p>
      		</div>

        <?php elseif ($result['S'] === 1 || $result['S'] === '1' ): ?>
      		<div class="alert alert-success-customized" style="opacity: none!important;">
    	  		<p><h4><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong><?php echo $result['H']; ?></strong></h4></p>
    	  		<p><?php echo $result['M']; ?><br><br><strong> Reference No: <u><?php echo $result['TN']; ?></u></strong></p>
      		</div>

          <script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
          <script>
              $(document).ready(function(){ 
                  setTimeout(function () {
                    var base_url = window.location.origin;
                    window.top.location.href = base_url+"/Merged_ticketing_flights/search_flights";
                  }, 2500);
              });
          </script>

        <?php endif ?>

        <!-- <a href="<?php echo BASE_URL()?>Merged_ticketing_flights/search_flights" class="btn btn-warning"> Back to search flights</a> -->
        <br/>
        <button class="btn btn-warning" onclick="backtosearch();">Back to search flights</button>

  </div>
</div>

<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script>
    function backtosearch() {
        $("#BDOiframe").attr("src", "");
        $('#modalBDOframe').modal('hide');

        var base_url = window.location.origin;
        window.top.location.href = base_url+"/Merged_ticketing_flights/search_flights";
    }

    function closeiframe() {
        $('#modalBDOframe').modal('hide');

          waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
          
            setTimeout(function () {
                        waitingDialog.hide();
                      }, 1000);

            return false;
    }

</script>

