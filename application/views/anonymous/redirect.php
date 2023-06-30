<style>
    .center-block {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .fit-image{
        width: 100%;
        /* object-fit: cover; */
        height: 100%; /* only if you want fixed height */
    }

    /* body{
        background-color: red;
    } */
    .ups-btnRecords{
        height: 56px;
        width: 322px;
        border-radius: 12px !important;
        padding: 8px 40px 8px 40px !important;
        border:none !important;
        background-color: var(--yellow-yellow-004, #F4B000);
        color: white;
        transition: 0.3s;
    }

    .ups-btnRecords:hover{
        background-color: #FFC914;
    }
    
    .footer{
        border-top: 1px solid var(--white-white-005, #DEDEDE);
        background: var(--white-white-001, #FAFAFA);
    }

    .vertical-align {
        display: flex;
        align-items: center;
    }

    @media (max-width: 767px) {
      .my-container {
        height: 100vh; /* Set full viewport height for mobile devices */
        display: flex;
        align-items: center;
      }
    }
</style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
</script>

<body class="font-poppins">
 
    <div class="contentpanel container my-container">
        <div class="row vcenter">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">
                <h2 class="mt-1 mb-1">Experience seamless transaction with Unified!</h2>
                <!-- <div>referral code: <?php echo $referral; ?></div> -->
                <image class="fit-image rounded mt-2 mb-2" src="<?php echo BASE_URL()?>assets/images/redirect.png"></image>
                <h4 class="mb-2">Start your journey with a Unified account today!</h4>
                <button type="button" class="ups-btnRecords btn-yellow" id="proceed">Proceed to Registration <i class="glyphicon glyphicon-center glyphicon-menu-right"></i></button>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

<script>
    $('#proceed').on('click', function(){
        waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
        <?php if($referral): ?>
            window.location.replace('https://secure.unified.ph/RetailerV2?referral=<?php echo $referral?>')
            $(this).attr('disabled', true);
            // swal({
            //     title: 'Nice!',
            //     text: "<?php echo $referral?>",
            //     icon: 'success',
            //     buttons: false,
            // })
            waitingDialog.hide();
        <?php else: ?>
            waitingDialog.hide();
            swal({
                title: 'Ooppss!',
                text: 'No Referral',
                icon: 'warning',
                buttons: false,
            })
        <?php endif; ?>
    })
</script>