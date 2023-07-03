<style>
    .center-block {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .fit-image{
        width: 450px;
        height: 350px;
    }

    html, body {
            background-color: var(--yellow-yellow-004, #F4B000);
        height: 100%;
    }
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
                <h1 class="" style="color: white; font-size: 125px;">404</h1>
                <div style="background-color: white; border-radius: 25px;">
                    <image class="fit-image rounded mt-2 mb-2" src="<?php echo BASE_URL()?>assets/images/somethingWentWrong.png"></image>
                </div>
                <h2 class="mt-1" style="font-size: 45px;">PAGE NOT FOUND!</h2>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>