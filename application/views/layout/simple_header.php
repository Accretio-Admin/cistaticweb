<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Unified Products and Services</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
//<meta property="og:title" content="Facebook Open Graph META Tags"/>
//<meta property="og:image" content="https://davidwalsh.name/wp-content/themes/klass/img/facebooklogo.png"/>
//<meta property="og:site_name" content="David Walsh Blog"/>
//<meta property="og:description" content="Facebook's Open Graph protocol allows for web developers to turn their websites into Facebook "graph" objects, allowing a certain level of customization over how information is carried over from a non-Facebook website to Facebook when a page is 'recommended', 'liked', or just generally shared."/>


<link rel="icon" href="<?php echo base_url().'assets/site/icon/upsicon.ico';?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>

<meta name="sitelock-site-verification" content="10056" />


<link href="<?php echo base_url().'assets/site/bootstrapANDfont/bootstrap.css';?>" rel="stylesheet"/>
<link href="<?php echo base_url().'assets/site/bootstrapANDfont/font-awesome/css/font-awesome.css';?>" rel="stylesheet"/>

<!--<link rel="stylesheet" type="text/css" media="screen" href="<?php //echo base_url().'assets/site/bootstrap/content/pygments-manni.css';?>" />-->

<link href="<?php //echo base_url().'assets/site/css/bxslider.css';?>" rel="stylesheet"/>
<!-- Theme Specific CSS -->
<link href="<?php echo base_url().'assets/site/css/styles.css';?>" rel="stylesheet"/>
<link href="<?php echo base_url().'assets/site/css/custom.css';?>" rel="stylesheet"/>
<!-- Predefined Color Scheme -->
<link href="<?php echo base_url().'assets/site/css/colors/default.css';?>" rel="stylesheet" id="colors"/>




<!-- jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Responsive Video Slider -->
<link href="<?php echo base_url().'assets/js/rvslider.latest/css/rvslider.min.css';?>" rel="stylesheet">
<script src="<?php echo base_url().'assets/js/rvslider.latest/js/rvslider.min.js';?>"></script>

<script>
	jQuery(function($){
		$(".rvs-container").rvslider();
	});
</script>

 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


 <style>

 @media screen and (max-width: 800px) {
  .Gads {
    visibility: hidden;
    clear: both;
    float: left;
    margin: 10px auto 5px 20px;
    width: 28%;
    display: none;
  }
}

</style>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109912688-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-109912688-1');
        </script>
        <!-- End Google Analytics -->

        
</head>
<body>

<header id="header" class="navbar navbar-fixed-top">

  <div class="container">
    <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	    	<span class="sr-only">Skip navigation</span>
	    	<span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="<?php echo base_url('Unified');?>" class="navbar-brand logo"><img class="img-circle" src="<?php echo base_url();?>/assets/site/icon/50x50.png"/> <span> Unified Products and Services.</span></a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
	    <?php $this->load->view('element/nav/menu');?>
    </nav>
  </div>
</header><!-- .navbar-fixed-top -->
<div class="page-top">
	<div id="sitelock_shield_logo" class="fixed_btm" style="bottom:0;position:fixed;_position:absolute;right:0;"><a href="https://www.sitelock.com/verify.php?site=www.upsexpress.com.ph" onclick="window.open('https://www.sitelock.com/verify.php?site=www.upsexpress.com.ph','SiteLock','width=600,height=600,left=160,top=170');return false;" ><img alt="PCI Compliance and Malware Removal" title="SiteLock" src="//shield.sitelock.com/shield/www.upsexpress.com.ph"></a></div>
	<div class="container">	
        <h3 class="page-top-header animated bounceIn">Global Business for Global Community</h3>
        		
		<ol class="breadcrumb">
		   <!--<li><a href="#" data-toggle="modal" data-target="#loginModal" >Login / SignUp </a></li>-->
		  <li><a href="<?php echo BASE_URL();?>Login" >Login</a></li>
		  <!-- <li class="active">Elements</li>  -->
		  
			<!-- Start Modal -->
			<?php //$this->load->view('element/modal/login');?>
			<!-- End Modal -->
			
		</ol>
	</div>	
</div>