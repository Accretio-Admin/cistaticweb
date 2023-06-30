

$(".img-responsivea").click(function(){
	waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
	var imgTitle = $(this).attr('alt');
	var CURRENT_REFNO = $(this).attr('id'); 
	var dt = $('#ecashpaycenterTable').DataTable({
		"order": [[ 2, 'asc' ], [ 0, 'asc' ] ],
		"bDestroy": true
	});
	dt.clear().draw();

	//setTimeout(function () {
     //waitingDialog.hide();
		$.ajax({
	        url: "/Ecash_payout/get_ecashpaycenter/"+CURRENT_REFNO,
	        type: "POST",
	        data:  new FormData(this),
	        contentType: false,
	        cache: false,
	        processData: false,
	        success: function(data){
	            var jsondata = JSON.parse(data);
	             console.log(jsondata);
	            if(jsondata.S == 1){
	            	$("#ecashpaycenterModal").modal('show');
    				$('.modal-title').text(imgTitle+' PAWNSHOP'); 
    				$('.modal-sub-title').text('List of '+ imgTitle +' Branch'); 
	            	$.each(jsondata.TDATA, function (i, item) {
	            		dt.row.add( [
	            			// (i + parseInt(1)),
				            item.branch_name,
				            item.address,
				            item.city
				        ] ).draw( false )
			        });	
			        waitingDialog.hide();
	            }else{
	            	waitingDialog.hide();
	            	$("#ecashpaycenterModal").modal('show');
	            }
	            
	        }
	    });
    //}, 6000);

});

