	$("#frmBaremiPayoutModal").on('submit',function(e){
		e.preventDefault();
		waitingDialog.show('Please wait..', {dialogSize: 'sm', progressType: 'primary'});
		$('#myPayoutModal').modal('hide');
		setTimeout(function(){
		waitingDialog.hide();	
		}, 2000);
	});