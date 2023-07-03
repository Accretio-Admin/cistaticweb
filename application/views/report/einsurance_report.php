<style>
#e_malayan:focus{
  background-color:#fca600;

}

#e_federal:focus{
  background-color:#fca600;
}
#e_malayan{
  outline: none !important;
  border-width: 1px; border-color: rgb(0,0,0);
  border-radius: 10%;
  height: 100px;
  width: 200px;
  /* background-color:#ffad33; */
  background-image:url("<?php echo BASE_URL()?>assets/images/malayan_logo.png");
  background-size: 200px 100px;
  background-repeat: no-repeat;
  background-position: center;
}
#e_federal{
  outline: none !important;
  border: 1px solid black;
  border-radius: 10%;
  height: 100px;
  width: 200px;
  /* background-color:#ffad33; */
  background-image:url("<?php echo BASE_URL()?>assets/images/FPG New Logo with Member 2015.png");
  background-size: 200px 80px;
  background-repeat: no-repeat;
  background-position: center;

}
#e_malayan:hover{
  /* background-color:orange; */
}
#e_federal:hover{
  /* background-color:orange; */
}


</style>

<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-money"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>REPORT</li>
              </ul>
              <h4>PERSONAL ACCIDENT INSURANCE REPORT</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  <div class="contentpanel">
  <div class="row">
    <div class="col-md-2 text-center">
      <button id="e_malayan" class="btn btn-default"></button>
      <label>MALAYAN INSURANCE</label>
    </div>
    <div class="col-md-2 text-center">
      <button id="e_federal" class="btn btn-default"></button>
      <label>FPG INSURANCE</label>
    </div>
    </div>
  <hr>
    <!-- <?php if ($API['S'] === 0): ?>
      <div class="alert alert-danger"><?php echo $API['M']; ?></div> 
    <?php endif ?> -->
        <!-- <div class="row">
          <div class="col-xs-12 col-md-12">

              <div class="col-xs-12 col-md-4">
                <div class="form-group">
                      <select class="form-control" id="fpg_selEinsurance">
                            <option value="0" disabled selected>SELECT EINSURANCE</option>
                            <option value="1">MALAYAN</option>
                            <option value="2">FEDERAL</option>
                      </select>  
                </div>   
              </div>

              <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <button id="fpg_btnSearch" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button> -->
                    <!-- <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('einsurance_report') ?>" target="_blank">
                    <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
                    </a> -->
                  <!-- </div>
              </div>
              <div class="col-xs-12  col-md-4">
                <div class="form-group">
                <div class="col-md-3  pull-right"><input id="fpg_limit" type="number" class="form-control text-center" min="1" value="10"/></div>
                </div>
              </div>
          </div>    
        </div> -->
          <!-- <?php if ($process['P'] == 1 && $process['S'] ==1 && $selected!=""){ ?> -->
            <!-- <div class="row">
              <div class="col-xs-12 col-md-12"> -->
                  <!-- <div class="text-right" style="margin-bottom:5px">
                      <span class="badge badge-primary"><?php echo $API['M']; ?></span>
                  </div> -->
              <div class="col-md-12 col-xs-12">
                       
              </div>
            </div>
          </div>
        <!-- <?php } ?> -->

    <div id="malayan_panel" class="panel panel-default" hidden>
      <div class="panel-heading">
        <h3 class="panel-title"><b>MALAYAN INSURANCE</b></h3>
      </div>
      <div class="panel panel-body">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-1">
                <input  id="malayan_limit" type="number" class="form-control text-center" min="1" value="10"/>
              </div>
              <div class="col-md-1">
                <button id="malayan_btnSearch" type="button" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>&nbsp;SHOW</button>
              </div>
          </div>
        </div>
        <div id="malayan_table" class="container-fluid" style="padding-top: 10px;">
        </div>
        <div id="malayan_pagination">
          <div class="col-sm-4">
              <ul class="pagination justify-content-end">
                  <li class="page-item">
                      <button id="malayan_btnfirst" value="1" class="btn btn-default btn-xs" type="button">FIRST</button>
                  </li>
                  <li class="page-item">
                      <button id="malayan_btnprev" class="btn btn-default btn-xs" type="button">PREVIOUS</button>
                  </li>
                  
                  <li class="page-item">
                      <button id="malayan_btnnext" class="btn btn-default btn-xs" type="button">NEXT</button>
                  </li>
                  <li class="page-item">
                      <button id="malayan_btnlast" class="btn btn-default btn-xs" type="button">LAST</button>
                  </li>
              </ul>
          </div>
          <div class="col-sm-4 text-center" style="margin-top: 25px;">
              Page&nbsp;<span id="malayan_currentpage" class="badge">-</span>&nbsp;of&nbsp;<span id="malayan_lastpage" class="badge">-</span>
          </div>
          <div class="col-sm-4 text-right" style="margin-top: 25px;">
              Total Records:<span id="malayan_rowcount"  class="badge">-</span>
          </div>
        </div>
      </div>
    </div>
    <div id="federal_panel" class="panel panel-default" hidden>
      <div class="panel-heading">
        <h3 class="panel-title"><b>FEDERAL INSURANCE</b></h3>
      </div>
      <div class="panel panel-body">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-1">
                <input  id="fpg_limit" type="number" class="form-control text-center" min="1" value="10"/>
              </div>
              <div class="col-md-1">
                <button id="fpg_btnSearch" type="button" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>&nbsp;SHOW</button>
              </div>
          </div>
        </div>
        <div id="fpg_table" class="container-fluid" style="padding-top: 10px;">
        </div>
        <div id="fpg_pagination">
          <div class="col-sm-4">
              <ul class="pagination justify-content-end">
                  <li class="page-item">
                      <button id="fpg_btnfirst" value="1" class="btn btn-default btn-xs" type="button">FIRST</button>
                  </li>
                  <li class="page-item">
                      <button id="fpg_btnprev" class="btn btn-default btn-xs" type="button">PREVIOUS</button>
                  </li>
                  
                  <li class="page-item">
                      <button id="fpg_btnnext" class="btn btn-default btn-xs" type="button">NEXT</button>
                  </li>
                  <li class="page-item">
                      <button id="fpg_btnlast" class="btn btn-default btn-xs" type="button">LAST</button>
                  </li>
              </ul>
          </div>
          <div class="col-sm-4 text-center" style="margin-top: 25px;">
              Page&nbsp;<span id="fpg_currentpage" class="badge">-</span>&nbsp;of&nbsp;<span id="fpg_lastpage" class="badge">-</span>
          </div>
          <div class="col-sm-4 text-right" style="margin-top: 25px;">
              Total Records:<span id="fpg_rowcount"  class="badge">-</span>
          </div>
        </div>
      </div>
    </div>
  </div><!-- contentpanel -->
</div><!-- mainpanel --> 

<script>
function getVal(){
  var element = document.getElementById("selInsurance");

  alert(element.options[element.selectedIndex].value);
}

$(function(){
  fpg_load();
  malayan_load();
});
// FPG REPORT

function fpg_load(){
  var limit = $("#fpg_limit").val();
  var page = 1;
  ajax_fpg_search(limit, page);
}
var base_url = "<?php echo base_url(); ?>";
$("#fpg_pagination").on("click", "#fpg_btnfirst", function () {
  var limit = $("#fpg_limit").val();
  var page = 1;
  ajax_fpg_search(limit, page);
});
// Pagination Button Previous Page
$("#fpg_pagination").on("click", "#fpg_btnprev", function () {
  var limit = $("#fpg_limit").val();
  var page = parseInt($("#fpg_currentpage").text()) - 1;
  if (page <= 0) page = 1;
  ajax_fpg_search(limit, page);
});
// Pagination Button Next Page
$("#fpg_pagination").on("click", "#fpg_btnnext", function () {
  var limit = $("#fpg_limit").val();
  var page = parseInt($("#fpg_currentpage").text()) + 1;
  var lastpage = parseInt($("#fpg_lastpage").text());
  if (page > lastpage) page = page - 1;
  ajax_fpg_search(limit, page);
});
// Pagination Button Last Page
$("#fpg_pagination").on("click", "#fpg_btnlast", function () {
  var limit = $("#fpg_limit").val();
  var page = $("#fpg_btnlast").val();
  ajax_fpg_search(limit, page);
});
$("#fpg_btnSearch").on("click", function () {
  var limit = $("#fpg_limit").val();
  var page = 1;

  // console.log(limit);
  // return false;
  ajax_fpg_search(limit, page);
});
$("#e_malayan").on("click", function () {
  $('#federal_panel').prop('hidden', true);
  $('#malayan_panel').prop('hidden', null);
});
$("#e_federal").on("click", function () {
  $('#malayan_panel').prop('hidden', true);
  $('#federal_panel').prop('hidden', null);
});

function ajax_fpg_search(limit, page) {
  $.ajax({
    method: "POST",
    dataType: "HTML",
    url: base_url + "Report/ajax_fpg_report",
    data: {
      limit: limit,
      page: page,
    },
    beforeSend: function () {
      $(".btn").prop("disabled", true);
    },
    complete: function () {
      $(".btn").prop("disabled", null);
    },
    success: function (response) {
      var res = JSON.parse(response);

      if(res["rowcount"] != 0 )
      $("#fpg_table").html(res["table"]);
      else
      $("#fpg_table").html("<tr><th class='text-center'>NO RECORD FOUND!</th></tr>");
      $("#fpg_rowcount").text(res["rowcount"]);
      $("#fpg_currentpage").text(res["currentpage"]);
      $("#fpg_lastpage").text(res["lastpage"]);
      $("#fpg_btnlast").val(res["lastpage"]);
    },
    error: function () {
      // alert('Failed to load records!');
      $.alert({
        title: "Error!",
        content: "Please contact developer for this error!",
      });
    },
  });
}

// MALAYAN functions

function malayan_load(){
  var limit = $("#malayan_limit").val();
  var page = 1;
  ajax_malayan_search(limit, page);
}
var base_url = "<?php echo base_url(); ?>";
$("#malayan_pagination").on("click", "#malayan_btnfirst", function () {
  var limit = $("#malayan_limit").val();
  var page = 1;
  ajax_malayan_search(limit, page);
});
// Pagination Button Previous Page
$("#malayan_pagination").on("click", "#malayan_btnprev", function () {
  var limit = $("#malayan_limit").val();
  var page = parseInt($("#malayan_currentpage").text()) - 1;
  if (page <= 0) page = 1;
  ajax_malayan_search(limit, page);
});
// Pagination Button Next Page
$("#malayan_pagination").on("click", "#malayan_btnnext", function () {
  var limit = $("#malayan_limit").val();
  var page = parseInt($("#malayan_currentpage").text()) + 1;
  var lastpage = parseInt($("#malayan_lastpage").text());
  if (page > lastpage) page = page - 1;
  ajax_malayan_search(limit, page);
});
// Pagination Button Last Page
$("#malayan_pagination").on("click", "#malayan_btnlast", function () {
  var limit = $("#malayan_limit").val();
  var page = $("#malayan_btnlast").val();
  ajax_malayan_search(limit, page);
});
$("#malayan_btnSearch").on("click", function () {
  var limit = $("#malayan_limit").val();
  var page = 1;

  // console.log(limit);
  // return false;
  ajax_malayan_search(limit, page);
});

function ajax_malayan_search(limit, page) {
  $.ajax({
    method: "POST",
    dataType: "HTML",
    url: base_url + "Report/ajax_malayan_report",
    data: {
      limit: limit,
      page: page,
    },
    beforeSend: function () {
      $(".btn").prop("disabled", true);
    },
    complete: function () {
      $(".btn").prop("disabled", null);
    },
    success: function (response) {
      var res = JSON.parse(response);

      if(res["rowcount"] == 0 || res["rowcount"] == null){
        $("#malayan_table").html("<tr><th class='text-center'>NO RECORD FOUND!</th></tr>");
      }
      else{
        $("#malayan_table").html(res["table"]);
      }
      

      $("#malayan_rowcount").text(res["rowcount"]);
      $("#malayan_currentpage").text(res["currentpage"]);
      $("#malayan_lastpage").text(res["lastpage"]);
      $("#malayan_btnlast").val(res["lastpage"]);
    },
    error: function () {
      // alert('Failed to load records!');
      $.alert({
        title: "Error!",
        content: "Please contact developer for this error!",
      });
    },
  });
}

</script>           