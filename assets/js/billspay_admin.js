//METROTURF
    $('.btn_approve_mmtci').on('click', function( event ){
	    event.preventDefault();
        var data = [];
        var index = $(this).index('.btn_approve_mmtci');
        $('.prod_row').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        console.log(data);

	    $('#btn_approve_modal_mmtci').modal('show');
	    $("#btn_approve_modal_mmtci #approveno").val(data[0]);
      $("#btn_approve_modal_mmtci #mmtci_label").html('Are you sure you want to approve this tracking no. '+data[0]+'?');
      
    });


    $('.btn_approve_confirm_mmtci').on('click', function( event ){
        event.preventDefault();
        $('#btn_approve_modal_mmtci').modal('hide');
        var trackno = $("#btn_approve_modal_mmtci #approveno").val();

        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

          $.ajax({
                type : 'POST',
                url  : 'mmtci_confrim',
                data : {trackno:trackno},
                datatype:'json',
                success :  function( msg )
                { 

                  var msgDone = JSON.parse(msg);
                   console.log(msgDone);
                   waitingDialog.hide();
                   if(msgDone.S == 1){
                    document.getElementById('alertSuccess').innerHTML = msgDone.M;
                    $('#alertSuccess').show();
                   }else{
                    document.getElementById('alertDanger').innerHTML = msgDone.M;
                    $('#alertDanger').show();
                   }
                  location.reload();

                }

              });  
    });


//MCWD
    $('.btn_approve_mcwd').on('click', function( event ){
      event.preventDefault();

        var data = [];
        var index = $(this).index('.btn_approve_mcwd');
        $('.prod_row').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        // console.log(data);

      // var other_info = data[6].split('|');
      waitingDialog.hide();
      $('#btn_approve_modal_mcwd').modal('show');
      $("#btn_approve_modal_mcwd #trackno").val(data[0]);
      $("#btn_approve_modal_mcwd #acctno").val(data[1]);
      $("#btn_approve_modal_mcwd #accntname").val(data[2]);
      $("#btn_approve_modal_mcwd #mobno").val(data[3]);
      $("#btn_approve_modal_mcwd #amnt").val(data[4]);
      $("#btn_approve_modal_mcwd #transdate").val(data[5]);
      // $("#btn_approve_modal_mcwd #bill_sequence").val(other_info[0]);
      // $("#btn_approve_modal_mcwd #bill_book").val(other_info[1]);
      // $("#btn_approve_modal_mcwd #bill_zone").val(other_info[2]);
    });


    $('#form_approve_mcwd').on('submit', function( event ){
        event.preventDefault();
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        $('#btn_approve_modal_mcwd').modal('hide');
        var trackno = $("#btn_approve_modal_mcwd #trackno").val();
        var refno = $("#btn_approve_modal_mcwd #refno").val();

          $.ajax({
                type : 'POST',
                url  : 'mcwd_confrim',
                data : {trackno:trackno,refno:refno},
                datatype:'json',
                success :  function( msg )
                { 

                  var msgDone = JSON.parse(msg);
                   console.log(msgDone);
                   waitingDialog.hide();
                   if(msgDone.S == 1){
                    document.getElementById('alertSuccess').innerHTML = msgDone.M;
                    $('#alertSuccess').show();
                   }else{
                    document.getElementById('alertDanger').innerHTML = msgDone.M;
                    $('#alertDanger').show();
                   }
                  location.reload();

                }

              });  
    });


    $('.btn_cancel_mcwd').on('click', function( event ){
      event.preventDefault();
        var data = [];
        var index = $(this).index('.btn_cancel_mcwd');
        $('.prod_row').eq(index).find('td').each(function(){
          data.push($(this).text());
        });
        console.log(data);

      $('#myModalCancel').modal('show');
      $("#myModalCancel #trackno").val(data[0]);
      $("#myModalCancel #mcwd_label").text('Are you sure you want to reject this tracking no. '+data[0]+'?');
    });


    $('#form_reject_mcwd').on('submit', function( event ){
        event.preventDefault();
        $('#myModalCancel').modal('hide');
        var trackno = $("#myModalCancel #trackno").val();
        var remarks = $("#myModalCancel #remarks").val();
        
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

          $.ajax({
                type : 'POST',
                url  : 'mcwd_reject',
                data : {trackno:trackno,remarks:remarks},
                datatype:'json',
                success :  function( msg )
                { 

                  var msgDone = JSON.parse(msg);
                   console.log(msgDone);
                   waitingDialog.hide();
                   if(msgDone.S == 1){
                    document.getElementById('alertSuccess').innerHTML = msgDone.M;
                    $('#alertSuccess').show();
                   }else{
                    document.getElementById('alertDanger').innerHTML = msgDone.M;
                    $('#alertDanger').show();
                   }
                  location.reload();

                }

              });  

          //return false;
    });