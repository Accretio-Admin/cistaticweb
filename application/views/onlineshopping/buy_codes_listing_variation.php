<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-money"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo BASE_URL('/Main')?>">
                            <i class="glyphicon glyphicon-home"></i>
                        </a>
                    </li>
                    <li>Online Shop</li>
                </ul>
                <h4>Buycodes Listing</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    <div class="contentpanel" style="margin: 2% 15% 0 15%;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class='divAlert' id="divAlerts"></div>
        </div>
        <?php if($error){?>
            <div class="alert alert-danger alert-dismissible" role="alert">           
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $error['M']; ?>
            </div>
        <?php } ?>
        <div class="row d-flex content-end" style="margin-bottom: 20px;">
            <form action="<?php echo BASE_URL('Buycodes/buycodes_regcode_listing_search') ?>" method="POST">
                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                    <div class="input-group">
                        <span class="input-group-addon">TRACKING NUMBER:</span>
                        <input class="form-control" name="trackingnumber" id="trackingnumber"/>
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <button type="submit" class="btn btn-primary" name="submit" value="search"><i class="fa fa-search"></i> Search</button>
                </div>
            </form>
        </div>
        <hr />
        <?php if($infos) { ?>
            <div class="row d-flex content-end" style="margin-bottom: 20px;">
                <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                    <div class="row d-flex content-center">
                        <div class="col-sm-2 col-lg-2 col-md-2">
                            <div class="pagination-prev">
                                <button class="prev btn btn-primary" disabled><span class="glyphicon glyphicon-chevron-left"></span></button>
                            </div>  
                        </div>
                        <div class="col-sm-8 col-lg-8 col-md-8">
                            <div class="pagination">
                                <ol id="numbers"></ol>
                            </div>
                        </div>
                        <div class="col-sm-2 col-lg-2 col-md-2">
                            <div class="pagination-next">
                                <button class="next btn btn-primary"><span class="glyphicon glyphicon-chevron-right"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row" id="list">
            <?php foreach($infos as $row): ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 list-item" style="margin-bottom: 10px;">
                    <div class="card card-padding" onclick='cardClick("<?php echo $row["trackno"];?>","<?php echo $row["regcode"]?>")'>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-8 col-lg-8 col-md-8">
                                <h5 class="m-0 text-muted" style="margin-left: 10px;"><span class="badge-outline"><?php echo $row['packagecode']; ?></span></h5>
                                <h3 style="margin-top: 10px; margin-left: 10px; color: #FED64B;"><strong ><?php echo $row['regcode']; ?></strong></h3>
                            </div>
                            <div class="col-sm-4 col-lg-4 col-md-4 d-flex content-center">
                                <div class="badge-circle d-flex content-center">
                                    <span style="font-size: 12px;" class="text-center"><b>TAG:</b> <?php echo $row['tag']; ?></span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4 col-md-4 d-flex content-center">
                                <div class="badge-circle d-flex content-center">
                                    <span style="font-size: 12px;" class="text-center"><b>PIN:</b> <?php echo $row['pin']; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr style="margin-left: 5px; margin-right: 5px; margin-bottom: 10px;">
                            <div class="col-sm-12 col-lg-12 col-md-12 d-flex content-center">
                                <small class="text-center"><?php echo $row['trackno']; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="custom-modal-content">
                        <h2 style="top: 0;">Provide Your Email</h2>
                        <div class="email-icon">
                            <img src="<?php echo BASE_URL()?>assets/images/email-icon.png" style="margin-top: 15px;">
                        </div>
                        <div class="input-con">
                            <form id="formSubmitModal" name="formSubmitModal" >
                                <input type="hidden" class="form-control custom-input" id="trackno" name="trackno">
                                <input type="hidden" class="form-control custom-input" id="reg" name="reg">
                                <div class="col-sm-8">
                                    <input type="email" class="form-control custom-input" placeholder="Email" id="email" name="email" required>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-block btn-primary" style="height: 50px; border-radius: 10px;">Send</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- contentpanel -->
</div><!-- mainpanel -->        

<style>
    /* Custom Modal */
    .custom-modal-header{
        display: block;
        width: 100%;
        height: 100%;
        color: white;
        font-size: 15px;
    }

    .custom-modal-content{
       width: 100%;
       height: 300px;
        margin: 0 auto;
        margin-top: 25px;
        padding-top: 15px;
        position: relative; 
        background: linear-gradient(90deg, rgba(255,168,0,1) 2%, rgba(254,216,0,1) 65%, rgba(255,226,59,1) 100%);
        color: white;
        font-size: 11px;
        letter-spacing: 0.1em;
        text-align: center;
        text-transform: uppercase;
    }

    .custom-modal-content:after{
        content: ' ';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 200px;
        border-top: 90px solid transparent;
        border-bottom: 100px solid white;
        /* border-bottom: 13px solid white; */
        border-left: 300px solid white;
        border-right: 300px solid white;
        z-index: 1;
    }

    .modal-content{
        background: rgb(255,168,0);
        background: linear-gradient(90deg, rgba(255,168,0,1) 2%, rgba(254,216,0,1) 65%, rgba(255,226,59,1) 100%);
    }

    .email-icon{
        position: absolute;
        height: 100px;
        width: 100px;
        border-radius: 100%;
        background-color: #333;
        left: 42%;
        top: 36%;
        z-index: 2;
    }

    .input-con{
        left: 0;
        right: 0;
        position: absolute;
        width: 100%;
        margin-top: 150px;
        z-index: 2;
    }

    .custom-input{
        width: 100%;
        height: 50px;
        margin:  auto 5px auto 0px;
        display: flex;
        border-radius: 13px;
        border: 1px solid #F6A21A;
        background-color: rgb(246,162,26, 0.2);
    }

   .custom-input[type=text]{
        padding-left: 15px;
    }

    .custom-input:focus{
        border: 2px solid #F6A21A;;
    }

    /* end */
    .card{
        width: 100%;
        height: 100%;
        border: 1px solid;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 15px 17px 7px -7px rgba(0,0,0,0.12);
        -webkit-box-shadow: 15px 17px 7px -7px rgba(0,0,0,0.12);
        -moz-box-shadow: 15px 17px 7px -7px rgba(0,0,0,0.12);
    }

    .card-padding{
        padding: 10px;
    }

    .m-0{
        margin: 0;
    }

    .d-flex{
        display: flex;
    }

    .content-center{
        justify-content: center;
        align-items: center;
    }

    .content-end{
        justify-content: center;
        align-items: flex-end;
    }

    .badge-circle{
        width: 13rem;
        height: 3rem;
        border-radius: 9% !important;
        background-color: #777777;
        color: white;
        margin-top: 5px;
    }

    .text-center{
        text-align: center;
    }

    .badge-outline{
       border-radius: 10px;
       border: 2px solid #337ab7;
       display: inline-block;
        min-width: 10px;
        padding: 3px 7px;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
    }

    /* Pagination. */
    .pagination {
        border: 2px solid #777777;
        padding: 1rem;
        margin-bottom: 1rem;
        text-align: center;
        display: flex;
        justify-content: center;
    }
    .pagination-next{
        margin-top: 1rem;
        text-align: center;
        display: flex;
        justify-content: center;
    }
    .pagination-prev{
        margin-top: 1rem;
        text-align: center;
        display: flex;
        justify-content: center;
    }
    #numbers {
        padding: 0rem;
        margin: 1px;
        list-style-type: none;
        display: flex;
    }

    #numbers li a {
        color: #777777;
        padding: .5rem 1rem;
        text-decoration: none;
        opacity: .7;
    }

    #numbers li a:hover {
        opacity: 1;
    }

    #numbers li a.active {
        opacity: 1;
        background: #FED64B;
        color: #333;
    }

    .numItems{
        display: block;
    }
</style>

<script>
    $(document).ready(function () {
        $('#buycodes_list').DataTable();
    });
</script>

<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#list .list-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>
    const rowsPerPage = 12;
	const rows = $('#list .list-item');
	const rowsCount = rows.length;
	const pageCount = Math.ceil(rowsCount / rowsPerPage); // avoid decimals
    const itemPerpage = 6;
	const numbers = $('#numbers');
    var indexC = 1;
    
    $('.value').text(indexC)
	
	// Generate the pagination.
	for (var i = 0; i < pageCount; i++) {
        numbers.append('<li class="numItems"><a href="#">' + (i+1) + '</a></li>');
	}
   
	// Mark the first page link as active.
	$('#numbers li:first-child a').addClass('active');

	// Display the first set of rows.
	displayRows(1);
    displayItems(1);
	
	// On pagination click.
	$('#numbers li a').click(function(e) {
		var $this = $(this);
		
		e.preventDefault();
		
		// Remove the active class from the links.
		$('#numbers li a').removeClass('active');
		
		// Add the active class to the current link.
		$this.addClass('active');
		
		// Show the rows corresponding to the clicked page ID.
		displayRows($this.text());
	});

    //nextbutton
    $(".next").click(function (){
        indexC++
        var start2 = (indexC - 1) * itemPerpage;
        var end2= start2 + itemPerpage;
    
        if($('.numItems').slice(start2, end2).length != 6){  
            //    $('.next').css('display', 'none')
            $('.next').prop('disabled', true);
        }
        $('.prev').prop('disabled', false)
        
        displayItems(indexC);
    });
    

    $(".prev").click(function(){
        indexC--
        if(indexC==1){
            $('.prev').prop('disabled', true)
            $('.next').prop('disabled', false)
        }
        displayItems(indexC)
    });
    
	// Function that displays rows for a specific page.
	function displayRows(index) {
		var start = (index - 1) * rowsPerPage;
		var end = start + rowsPerPage;
		
		// Hide all rows.
		rows.hide();
		
		// Show the proper rows for this page.
		rows.slice(start, end).show();
	}

    function displayItems(index) {
		var start1 = (index - 1) * itemPerpage;
		var end1= start1 + itemPerpage;

        $('.numItems').css('display', 'none')        
        $('.numItems').slice(start1, end1).css('display', 'block')
	}

    function cardClick(trackno,regcode){
        $('#myModal').modal('show');
        $('#trackno').val(trackno);
        $('#reg').val(regcode);
    }

    $('#formSubmitModal').submit((e) => {
        e.preventDefault();
        waitingDialog.show('Sharing Regcode. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
        var formdata = new FormData();
        formdata.append('trackingnumber',$('#trackno').val());
        formdata.append('email',$('#email').val());
        formdata.append('reg',$('#reg').val());
        
        $.ajax({
            url: "/Buycodes/share_email",
            type: 'POST',
            data : formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                
                var buycodesdata = JSON.parse(data);
                if(buycodesdata['S'] == '1'){
                    waitingDialog.hide();
                    validationSuccess(buycodesdata['M']);
                    $('#myModal').modal('hide');

                    window.scroll({
                        top: 0, 
                        left: 0, 
                        behavior: 'smooth'
                    });
                }else{
                    waitingDialog.hide();
                    validationFail(buycodesdata['M']);
                    $('#myModal').modal('hide'); 

                    window.scroll({
                        top: 0, 
                        left: 0, 
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    function validationFail (data) {
        $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">'+                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data+'</div>');
    }
    function validationSuccess (data) {
        $('.divAlert').html('<div class="alert alert-success alert-dismissible" role="alert">'+                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data+'</div>');
    }
   
</script>