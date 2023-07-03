<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-money"></i>
      </div>
      <div class="media-body">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
          <li>Online Shop</li>
        </ul>
        <h4>Buycodes Listing</h4>

        
      </div>
    </div><!-- media -->
  </div><!-- pageheader -->
  <div class="contentpanel">
        <div class="row">
          <div class="col-sm-12 col-lg-12 col-md-12">
          <div class="col-xs-12 col-md-12" >
                <table id="buycodes_list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr >
                            <th>Regcode</th>
                            <th>Package Code</th>
                            <th>Tracking No.</th>
                            <th>Tag</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
  </div><!-- contentpanel -->
</div><!-- mainpanel -->        


<style>
  .card{
    width: 100%;
    height: 100%;
    border: 1px solid;
    border-radius: 10px;
    box-shadow: 15px 17px 7px -7px rgba(0,0,0,0.12);
-webkit-box-shadow: 15px 17px 7px -7px rgba(0,0,0,0.12);
-moz-box-shadow: 15px 17px 7px -7px rgba(0,0,0,0.12);
  }
</style>

<script>
  $(document).ready(function () {
    $('#buycodes_list').DataTable();
});
</script>