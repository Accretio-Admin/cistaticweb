<div class="container" style="margin:5%;">
	<div class="col-sm-6 col-md-6" style="padding-top: 10%;">
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
        <?php endif ?>
  </div>
</div>

