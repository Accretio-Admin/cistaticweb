function buildTable(data) {
    var table = document.createElement("table");
    table.className="table table-bordered";
    table.setAttribute("id", "currtable");
    var thead = document.createElement("thead");
    var tbody = document.createElement("tbody");
    var headRow = document.createElement("tr");

    var x = 0;
    data.forEach(function(el){
      if(x == 0)
      {
        for (var o in el)
        {

        var th=document.createElement("th");
        th.appendChild(document.createTextNode(o));
        headRow.appendChild(th);
        
        }
        x++;
      }
    });
    thead.appendChild(headRow);
    table.appendChild(thead); 

    data.forEach(function(el) {
      var tr = document.createElement("tr");
      for (var o in el) {  
        var td = document.createElement("td");
        td.appendChild(document.createTextNode(el[o]))
        tr.appendChild(td);
      }
      tbody.appendChild(tr);  
    });

    table.appendChild(tbody);             
    return table;
}

window.onload = function() {
        console.log('test');
           $.ajax({
          url: "/Ecash_send/fetch_currencies",
          type: "POST",
          // data: parameters,
              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                 
                  console.log(jsondata);

                  console.log(jsondata.T_DATA);
                  
                  if(jsondata.S == 1){

                  waitingDialog.hide();

                  document.getElementById("content_table").appendChild(buildTable(jsondata.T_DATA));


                  // console.log(jsondata.T_DATA);

                  }
                  else
                  {
                    waitingDialog.hide();
                  }
              }
      });

}


   $("#checkcurrency").click(function () {

      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

           $.ajax({
          url: "/Ecash_send/fetch_currencies",
          type: "POST",
          // data: parameters,
              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                 
                  // console.log(jsondata);

                  // console.log(jsondata.T_DATA);
                  
                  if(jsondata.S == 1){

                  waitingDialog.hide();

                  document.getElementById("currtable").remove();

                  document.getElementById("content_table").appendChild(buildTable(jsondata.T_DATA));


                  // console.log(jsondata.T_DATA);

                  }
                  else
                  {
                    waitingDialog.hide();
                  }
              }
      });


});
 


   $("#checkbalance").click(function () {

      document.getElementById("currencybalafter").value = '';
      document.getElementById("ecashbalafter").value = '';

      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

      var currtype = $("#currtype").val();
      var inputAmountTransaction = $("#inputAmountTransaction").val();

      // var formData = new FormData($('#frmecashtoforex')[0]);
      var parameters = {currtype:currtype,inputAmountTransaction:inputAmountTransaction};


           $.ajax({
          url: "/Ecash_send/check_balanceafter",
          type: "POST",
          data: parameters,
          // data: formData,

              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                 
                  // console.log(jsondata);

                  // console.log(jsondata.T_DATA);
                  
                  if(jsondata.S == 1){

                  waitingDialog.hide();

                  document.getElementById("currate").value = jsondata.R;
                  document.getElementById("currencybalafter").value = jsondata.FA;
                  document.getElementById("ecashbalafter").value = jsondata.EC;

                  $("#checkbalancesuccess").html(jsondata.M);
                  $("#checkbalancesuccess").show();
                  $("#checkbalancefailed").hide();
                  $("#inputTpass").prop("disabled", false); 
                  $("#submitc").prop("disabled", false); 
                  }
                  else
                  {
                    waitingDialog.hide();

                  $("#checkbalancefailed").html(jsondata.M);
                  $("#checkbalancefailed").show();
                  $("#checkbalancesuccess").hide();
                  $("#inputTpass").prop("disabled", true); 
                  $("#submitc").prop("disabled", true); 
                  }
              }
      });


});


   $("#btnSubmitex").click(function () {

      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});


});



    $("#currtype").change(function () {
      var cur = '';
      var curba = '';

      cur = document.getElementById("currtype").value + ' Rate:';
      curba = document.getElementById("currtype").value + ' Balance After:';

      $("#labelrate").html(cur); 
      $("#labelcurrba").html(cur); 

    });