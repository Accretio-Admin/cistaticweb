<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-users"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>NETWORK</li>
                </ul>
                <h4>QUOTA REPORT</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <div class="container-fuid">
            <div style="margin-bottom:10px;" class="row">
                <div class="col-md-3">
                    SEARCH BY DATE 
                    <div class="input-group">
                        <input type="text" id="search_date" class="datetimepicker form-control"/>
                        <span class="input-group-btn">
                            <button style="line-height:1.5;" class="btn btn-primary" id="qr_btn_search" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
                <div class="col-md-9">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="tbl_quota_report" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">TRACKING NO.</th>
                                <th class="text-center">DRCR</th>
                                <th class="text-center">TYPE</th>
                                <th class="text-center">AMOUNT</th>
                                <th class="text-center">PV</th>
                                <th class="text-center">BALANCE BEFORE</th>
                                <th class="text-center">BALANCE AFTER</th>
                                <th id="orderbydate" data-order="desc" style="cursor:pointer" class="text-center">CREATED DATE <i class="fa fa-sort-down" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var base_url = '<?php echo BASE_URL();?>';
    $(function () {
        let orderby = $('#orderbydate').data('order');
        let date = $('.datetimepicker').val();

        load_quota_report(date,orderby);
    });
</script>