jQuery(document).ready(function() {
   
   "use strict";
   
   // Tooltip
   jQuery('.tooltips').tooltip({ container: 'body'});
   
   // Popover
   jQuery('.popovers').popover();
   
   // Show panel buttons when hovering panel heading
   jQuery('.panel-heading').hover(function() {
      jQuery(this).find('.panel-btns').fadeIn('fast');
   }, function() {
      jQuery(this).find('.panel-btns').fadeOut('fast');
   });
   
   // Close Panel
   jQuery('.panel .panel-close').click(function() {
      jQuery(this).closest('.panel').fadeOut(200);
      return false;
   });
   
   
   // Minimize Panel
   jQuery('.panel .panel-minimize').click(function(){
      var t = jQuery(this);
      var p = t.closest('.panel');
      if(!jQuery(this).hasClass('maximize')) {
         p.find('.panel-body, .panel-footer').slideUp(200);
         t.addClass('maximize');
         t.find('i').removeClass('fa-minus').addClass('fa-plus');
         jQuery(this).attr('data-original-title','Maximize Panel').tooltip();
      } else {
         p.find('.panel-body, .panel-footer').slideDown(200);
         t.removeClass('maximize');
         t.find('i').removeClass('fa-plus').addClass('fa-minus');
         jQuery(this).attr('data-original-title','Minimize Panel').tooltip();
      }
      return false;
   });
   
   jQuery('.leftpanel .nav .parent > a').click(function() {
      
      var coll = jQuery(this).parents('.collapsed').length;
      
      if (!coll) {
         jQuery('.leftpanel .nav .parent-focus').each(function() {
            jQuery(this).find('.children').slideUp('fast');
            jQuery(this).removeClass('parent-focus');
         });
         
         var child = jQuery(this).parent().find('.children');
         if(!child.is(':visible')) {
            child.slideDown('fast');
            if(!child.parent().hasClass('active'))
               child.parent().addClass('parent-focus');
         } else {
            child.slideUp('fast');
            child.parent().removeClass('parent-focus');
         }
      }
      return false;
   });
   
   
   // Menu Toggle
   jQuery('.menu-collapse').click(function() {
      if (!$('body').hasClass('hidden-left')) {
         if ($('.headerwrapper').hasClass('collapsed')) {
            $('.headerwrapper, .mainwrapper').removeClass('collapsed');
         } else {
            $('.headerwrapper, .mainwrapper').addClass('collapsed');
            $('.children').hide(); // hide sub-menu if leave open
         }
      } else {
         if (!$('body').hasClass('show-left')) {
            $('body').addClass('show-left');
         } else {
            $('body').removeClass('show-left');
         }
      }
      return false;
   });
   
   // Add class nav-hover to mene. Useful for viewing sub-menu
   jQuery('.leftpanel .nav li').hover(function(){
      $(this).addClass('nav-hover');
   }, function(){
      $(this).removeClass('nav-hover');
   });
   
   // For Media Queries
   jQuery(window).resize(function() {
      hideMenu();
   });
   
   hideMenu(); // for loading/refreshing the page
   function hideMenu() {
      
      if($('.header-right').css('position') == 'relative') {
         $('body').addClass('hidden-left');
         $('.headerwrapper, .mainwrapper').removeClass('collapsed');
      } else {
         $('body').removeClass('hidden-left');
      }
      
      // Seach form move to left
      if ($(window).width() <= 360) {
         if ($('.leftpanel .form-search').length == 0) {
            $('.form-search').insertAfter($('.profile-left'));
         }
      } else {
         if ($('.header-right .form-search').length == 0) {
            $('.form-search').insertBefore($('.btn-group-notification'));
         }
      }
   }
   
   collapsedMenu(); // for loading/refreshing the page
   function collapsedMenu() {
      
      if($('.logo').css('position') == 'relative') {
         $('.headerwrapper, .mainwrapper').addClass('collapsed');
      } else {
         $('.headerwrapper, .mainwrapper').removeClass('collapsed');
      }
   }
   testssss();
   function testssss(isF) {
      
     
    $('html, body').animate({scrollTop:$(document).height()}, 'slow');
   
     
   }




$(document).ready(function(){

   $('#btnSubmit').click(function(){
      var regEx='[^@]+@[^@]+\.[a-zA-Z]{2,6}' ;
      if($('#selBrandPaythemId').find('option:selected').val()==""){
         $('#selBrandPaythemId').css('border-color', 'red');
         return false;
      }else{
          $('#selBrandPaythemId').css('border-color', '');
      }
      if($('#selProdPaythemId').find('option:selected').val()==""){
         $('#selProdPaythemId').css('border-color', 'red');
         return false;
      }else{
          $('#selProdPaythemId').css('border-color', '');
      }
      if(!$('#emailId').val().match(regEx)){
         $('#emailId').css('border-color', 'red');
         $('#emailMsg').append('<p>Wrong Email Format</p>');
         return false;
      }else{
          $('#emailId').css('border-color', '');
      }
      if($('#qtyId').val().trim()==""){
         $('#qtyId').css('border-color', 'red');
         return false;
      }else{
          $('#qtyId').css('border-color', '');
      }
      
      if($('#capchaId').val()==""){
         $('#capchaId').css('border-color', 'red');
         return false;
      }else{
          $('#capchaId').css('border-color', '');
      }




     // alert($("#selProdPaythemId option:selected").text());
      $('#idProductName').text($("#selProdPaythemId option:selected").text());
      $('#idProductQty').text($("#qtyId").val());
      $('#idBrand').text($("#selBrandPaythemId option:selected").text());
   });

});


$(document).ready(function(){
        $('#selInsuranceFederal').change(function(){
           var policy = $('#selInsuranceFederal').val();
           
           var coverage = $('#inputCoverage').val();
           var price = 0;
            if(coverage==1 && policy==3){
               price = 50;
            }else if(coverage==2 && policy==3){
               price = 37;
            }else if(coverage==3 && policy==3){
               price = 25;
            }else if(coverage==1 && policy==4){
               price = 45;
            }else if(coverage==2 && policy==4){
               price = 34;
            }else if(coverage==3 && policy==4){
               price = 20;
            }else if(coverage==1 && policy==5){
               price = 35;
            }else if(coverage==2 && policy==5){
               price = 27;
            }else if(coverage==3 && policy==5){
               price = 15;
            }


           if(policy==3){
               $('#policyBox').show(); 
               $('#note1').html('PHP 50,000.00');
               $('#note2').html('PHP 25,000.00');
               $('#note3').html('PHP 5,000.00');
               $('#note4').html('PHP 5,000.00');
               $('#note5').html('PHP '+price);
           }else if(policy==4){
            
               $('#policyBox').show(); 
               $('#note1').html('PHP 40,000.00');
               $('#note2').html('PHP 20,000.00');
               $('#note3').html('PHP 4,000.00');
               $('#note4').html('PHP 4,000.00');
               $('#note5').html('PHP '+price);
           }else if(policy==5){
            
               $('#policyBox').show(); 
               $('#note1').html('PHP 20,000.00');
               $('#note2').html('PHP 10,000.00');
               $('#note3').html('PHP 2,000.00');
               $('#note4').html('PHP 2,000.00');
               $('#note5').html('PHP '+price);
           }

        });

         $('#inputCoverage').change(function(){
                    var policy = $('#selInsuranceFederal').val();
                    
                    var coverage =$('#inputCoverage').val();
                    var price = 0;
                   
                     if(coverage==1 && policy==3){
                        price = 50;
                     }else if(coverage==2 && policy==3){
                        price = 37;
                     }else if(coverage==3 && policy==3){
                        price = 25;
                     }else if(coverage==1 && policy==4){
                        price = 45;
                     }else if(coverage==2 && policy==4){
                        price = 34;
                     }else if(coverage==3 && policy==4){
                        price = 20;
                     }else if(coverage==1 && policy==5){
                        price = 35;
                     }else if(coverage==2 && policy==5){
                        price = 27;
                     }else if(coverage==3 && policy==5){
                        price = 15;
                     }

                     $('#note5').html('PHP '+price);
                 });

   });    


  

});