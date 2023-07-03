<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

          <?php if ($user['CG'] =="UPS") {?>
                     <title>UPS</title>
                         <link href="<?php echo BASE_URL()?>assets/css/style.default.css" rel="stylesheet">
                    <?php }else { ?>
                           <link href="<?php echo BASE_URL()?>assets/css/styles.gprs.css" rel="stylesheet">
                      <?php   }
                     ?>
       
     
        <link href="<?php echo BASE_URL()?>assets/css/morris.css" rel="stylesheet">
        <link href="<?php echo BASE_URL()?>assets/css/select2.css" rel="stylesheet" />
        <link href="<?php echo BASE_URL()?>assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo BASE_URL()?>assets/css/jquery.datetimepicker.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
 
    <style>
      .glyphicon-refresh-animate {
                      -animation: spin .7s infinite linear;
                      -webkit-animation: spin2 .7s infinite linear;
                        display:none;
                  }

                  @-webkit-keyframes spin2 {
                      from { -webkit-transform: rotate(0deg);}
                      to { -webkit-transform: rotate(360deg);}
                  }

                  @keyframes spin {
                      from { transform: scale(1) rotate(0deg);}
                      to { transform: scale(1) rotate(360deg);}
                  }
    </style>  




  