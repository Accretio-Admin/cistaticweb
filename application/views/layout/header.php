<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
      
        <?php if ($user['CG'] =="UPS"): ?>
            <?php if(
                    (is_array($user) && isset($user['R']) && substr($user['R'], 0, 3) == 'GRM') ||
                    (is_array($API) && isset($API['R']) && $API['R'] == 'F5880126') ||
                    (is_array($user) && isset($user['R']) && in_array($user['R'], ['F9175006', 'G7979485', 'F1205575', 'F1145677', 'F1164754', 'F1198933', 'F3989172']))
                ): ?>
                <title>Ricemart</title>
            <?php elseif (substr($user['R'],0,3) == 'GWL' || $user['R'] == 'GWL0987'): ?>
                <title>Wealthy Lifestyle</title>
            <?php else: ?>
                <title>UPS</title>
            <?php endif; ?>

            <link href="<?php echo BASE_URL()?>assets/css/style.default.css" rel="stylesheet">
        <?php else: ?>
            <link href="<?php echo BASE_URL()?>assets/css/styles.gprs.css" rel="stylesheet">
        <?php endif ?>
        
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
       <?php if ($user['CG'] =="UPS"): ?>
           <?php if (
                (is_array($user) && isset($user['R']) && substr($user['R'], 0, 3) == 'GRM') ||
                (is_array($API) && isset($API['R']) && $API['R'] == 'F5880126') ||
                (is_array($user) && isset($user['R']) && in_array($user['R'], ['F9175006', 'G7979485', 'F1205575', 'F1145677', 'F1164754', 'F1198933', 'F3989172']))
            ): ?>
                <link rel="shortcut icon" href="<?php echo BASE_URL()?>assets/login_new/images/ricemart-label.png" class="next-head">
            <?php elseif (substr($user['R'],0,3) == 'GWL' || substr($user['R'],0,3) == 'DWL' || $user['R'] == 'GWL0987'): ?>
                <link rel="shortcut icon" href="<?php echo BASE_URL()?>assets/images/logo2.png" class="next-head">
            <?php else: ?>
                <link rel="shortcut icon" href="<?php echo BASE_URL()?>assets/icon/50x50.png" class="next-head">
            <?php endif; ?>
        <?php elseif ($user['CG'] ==""):  ?>
            <link rel="shortcut icon" href="<?php echo BASE_URL()?>assets/icon/50x50.png" class="next-head"> 
        <?php  else: ?>
           <link rel="shortcut icon" href="<?php echo BASE_URL()?>assets/icon/GPRS.png" class="next-head">
        <?php endif?>
         

        <!-- New Registration UI -->
        <!-- end New Registration UI -->
        <link href="<?php echo BASE_URL()?>assets/css/registration.css" rel="stylesheet" />
        <!-- <link href="<?php echo BASE_URL()?>assets/css/select2.css" rel="stylesheet" /> -->
        <link href="<?php echo BASE_URL()?>assets/css/styles.css" rel="stylesheet" />
        
        <link href="<?php echo BASE_URL()?>assets/css/jquery.datetimepicker.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <link type="text/css" href="<?php echo BASE_URL()?>assets/css/jquery.simple-dtpicker.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.css" integrity="sha512-AQG3JVpy/h0TsLsFs/HDLjnkq1ih9uUliGGXdQ7LQcGQt7GD+1b7HWOQ2oeCH7tKdtrfRg75CGApafi+//9Dbw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <!-- POPPINS FONT -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109912688-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-109912688-1');
        </script>
        <!-- End Google Analytics -->
 
        <style>
        .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* The actual popup */
        .popup .popuptext {
            visibility: hidden;
            width: 160px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -80px;
        }

        /* Popup arrow */
        .popup .popuptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        /* Toggle this class - hide and show the popup */
        .popup .show {
            visibility: visible;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s;
        }

        /* Add animation (fade in the popup) */
        @-webkit-keyframes fadeIn {
            from {opacity: 0;} 
            to {opacity: 1;}
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity:1 ;}
        }
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

        /*FOR  ECASH PAYOUT */
        .clsDatePicker {
        z-index: 100000;
        }
        /*FOR  ECASH PAYOUT */
        </style>  
    </head>



  