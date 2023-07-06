    <script src="<?php echo BASE_URL()?>assets/js/masked_input_1.4-min.js"></script>  
    <script src="<?php echo BASE_URL()?>assets/js/bootstrap-datepicker.js"></script>      
    <?php 
      if ($this->uri->segment(1) == 'hotels' && $this->uri->segment(2) == 'details') {
          echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
          echo '<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> 
                <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> ';
      } else {?>
        <script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/jquery-migrate-1.2.1.min.js"></script>
    <?php }?>
        
    <script src="<?php echo BASE_URL()?>assets/js/jquery.datetimepicker.full.js"></script>
    <script src="<?php echo BASE_URL()?>assets/script/ecash_payout_scripts.js"></script>
    <script src="<?php echo BASE_URL()?>assets/script/ecash_payout_transfast.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/custom/federalv2/function.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/custom/quota_report/function.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/modernizr.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/pace.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/jquery.cookies.js"></script>

    <script src="<?php echo BASE_URL()?>assets/js/flot/jquery.flot.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/flot/jquery.flot.resize.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/flot/jquery.flot.spline.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/morris.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/raphael-2.1.0.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/js/bootstrap-wizard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

    <script src="<?php echo BASE_URL()?>assets/js/custom.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>


    <script type="text/javascript" src="<?php echo BASE_URL()?>assets/js/jquery.simple-dtpicker.js"></script> 

    <link rel="stylesheet" href="<?php echo BASE_URL()?>assets/abacus/css/daterangepicker.css"/>
    <script type="text/javascript" src="<?php echo BASE_URL()?>assets/abacus/js/moment.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL()?>assets/abacus/js/daterangepicker.js"></script>
    
    <script src="<?php echo BASE_URL()?>assets/js/typeahead.min.js"></script>
    

    <?php 
          if ($this->uri->segment(1) == 'hotels' && $this->uri->segment(2) == 'book_now') {?>
            <link href="<?php echo BASE_URL()?>assets/css/bootstrap-datetimepicker-v2.css" rel="stylesheet"/>
            <script src="<?php echo BASE_URL()?>assets/js/bootstrap-datetimepicker-v2.js"></script>
    <?php } else {?>
            <script src="<?php echo BASE_URL()?>assets/js/jquery-ui-1.10.3.min.js"></script>
    <?php } ?>
    
    <script src="<?php echo BASE_URL()?>assets/js/hotelNewService.js"></script> 