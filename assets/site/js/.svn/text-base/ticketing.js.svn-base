
$(document).ready(function(){

  
  
	 $('.btnTicketingSearch').click(function searchavailability(){
	 	$('.btnTicketingSearch').hide();
	 	
        
        	var origin = $('.dom_airport_source').val();
    		var destination = $('.dom_airport_dest').val();
            var flighttype = $('.flighttype').val();
            var returndate = $('.returndate').val();
            var leavedate = $('.leavedate').val();
            var adult = parseInt($('.adult').val(),10);
            var children = parseInt($('.children').val(),10);
            var infant = parseInt($('.infant').val(),10);
            var passgrcount = adult + children + infant;
            

	    if(leavedate == ''){
              alert('Please choose the desired leave date for your itinerary'); /*CHECK IF HAVE A LEAVE DATE*/
              $('.btnTicketingSearch').show();
        	  return false;
	    }else{

	    	 if(document.ticketing.returndate.disabled==false && returndate == ''){ /*CHECK IF HAVE A RETURN DATE*/
                  alert('Please choose the desired return date for your itinerary');
                  $('.btnTicketingSearch').show();
            	  return false;
             }else{
                
                if(origin==destination){ /*CHECK IF HAVE ORIGIN AND DESTINATION HAS SAME PLACE*/
                     alert('Same Place Source "'+origin+'" and Destination "'+destination+'" is not allowed');
		             $('.btnTicketingSearch').show();
			 	     return false;
                }else{ /*CHECK IF LEAVE DATE IS PAST DATE ON CURRENT DATE*/
         
		            var selectedDate = $('#from').val();
		            var selectformat = new Date(selectedDate);

		            var curr = new Date();
		            var curminus = curr.setDate(curr.getDate()-1);
		            var curminus = new Date(curminus);

		            if(selectformat < curminus) {
					    alert('Invalid for choosing leave date "'+selectedDate+'" this is a past date.');
                        $('.btnTicketingSearch').show();
		 	    		return false;
					 

					 }else{ /*PASSEGER CHECK AVIALABITY MAX*/
                         
                         if(passgrcount > 9){ /*CHECK THE MAXIMUM OF PASSENGER*/
                         	    alert('A maximum of 9 passenger only can book!');
                         	    $('.btnTicketingSearch').show();
                         	    return false;
                         }else{
                            if(infant > adult){ /*CHECK IF INFANT IS GRATHERTHAN A ADULT*/
                            	alert('Infant can\'t be more than a adult passenger');
                            	$('.btnTicketingSearch').show();
                            	return false;
                            }else{ /*PASSED ALL REQUIRMENT UPON BOOKING*/
                              
                                 var html = document.getElementById('skm_LockPane'); 
                                 var base_url = $('#baseurl').val();
				                 var imgs = '<img src="http://localhost/FINAL_NEWSYSTEM_EDIT/trunk/upsexpress.com.ph/assets/system_files/images/flightsearchico.png"/>';
				                 var imgb = '<img src="http://localhost/FINAL_NEWSYSTEM_EDIT/trunk/upsexpress.com.ph/assets/system_files/images/14.gif"/>';


				                 if (html) 
						         	
						          html.className = 'LockOn'; 
						          html.innerHTML=''+imgb+'<br/><b style="color:red;">Please wait while checking the availabity flight itinerary</b>';
						    
                            }

                         }
                    

		            }

		       }		



             }


	    }


       }); 



   

   $('#btnTicketingSearchinternational').click(function intsearchavailability(){
      $('#btnTicketingSearchinternational').hide();

        var intorigin = $('.airport_source').val();
        var intdestination = $('.airport_dest').val();
        var flighttype = $('.intflighttype').val();
        var returndate = $('.intreturndate').val();
        var leavedate = $('.intleavedate').val();
        var adult = parseInt($('.intadult').val(),10);
        var children = parseInt($('.intchild').val(),10);
        var infant = parseInt($('.intinfant').val(),10);
        var passgrcount = adult + children + infant;

       
       if(leavedate == ''){
              alert('Please choose the desired leave date for your itinerary'); /*CHECK IF HAVE A LEAVE DATE*/
              $('#btnTicketingSearchinternational').show();
              return false;
        }else{

             if(document.ticketing.returndate.disabled==false && returndate == ''){ /*CHECK IF HAVE A RETURN DATE*/
                  alert('Please choose the desired return date for your itinerary');
                  $('#btnTicketingSearchinternational').show();
                  return false;
             }else{
                
                if(intorigin==intdestination){ /*CHECK IF HAVE ORIGIN AND DESTINATION HAS SAME PLACE*/
                     alert('Same Place Source "'+intorigin+'" and Destination "'+intdestination+'" is not allowed');
                     $('#btnTicketingSearchinternational').show();
                     return false;
                }else{ /*CHECK IF LEAVE DATE IS PAST DATE ON CURRENT DATE*/
         
                    var selectedDate = $('#from').val();
                    var selectformat = new Date(selectedDate);

                    var curr = new Date();
                    var curminus = curr.setDate(curr.getDate()-1);
                    var curminus = new Date(curminus);

                    if(selectformat < curminus) {
                        alert('Invalid for choosing leave date "'+selectedDate+'" this is a past date.');
                        $('#btnTicketingSearchinternational').show();
                        return false;
                     

                     }else{ /*PASSEGER CHECK AVIALABITY MAX*/
                         
                         if(passgrcount > 9){ /*CHECK THE MAXIMUM OF PASSENGER*/
                                alert('A maximum of 9 passenger only can book!');
                                $('#btnTicketingSearchinternational').show();
                                return false;
                         }else{
                            if(infant > adult){ /*CHECK IF INFANT IS GRATHERTHAN A ADULT*/
                                alert('Infant can\'t be more than a adult passenger');
                                $('#btnTicketingSearchinternational').show();
                                return false;
                            }else{ /*PASSED ALL REQUIRMENT UPON BOOKING*/
                              
                                 var html = document.getElementById('skm_LockPane'); 
                                 //var base_url = $('.baseurl').val();
                                 // var imgs = '<img src="http://localhost/FINAL_NEWSYSTEM_EDIT/trunk/upsexpress.com.ph/assets/system_files/images/flightsearchico.png"/>';
                                 //var imgb = '<img src="http://www.upsexpress.com.ph/assets/system_files/images/ajax-loader.gif"/>';
                                 


                                 if (html) 
                                    
                                  html.className = 'LockOn'; 
                                  html.innerHTML='<br/><b style="color:red;">Please wait while checking the availabity flight itinerary</b>';
                            
                            }

                         }
                    

                    }

               }        



             }


        }





   });




});




