<style>
    
    .flex-center{
        display: flex;
        justify-content:center;
        align-items: center;
    }
    .ups-card-active{
        height: 240px;
        width: 440px;
        border-radius: 14px;
        border: solid 2px #FFB800;
        box-shadow: 0px 6px 26px -8px rgba(0, 0, 0, 0.16);
        padding-bottom: 20px;
    }
    .ups-card{
        height: 240px;
        width: 440px;
        border-radius: 14px;
        box-shadow: 0px 6px 26px -8px rgba(0, 0, 0, 0.16);
        padding-bottom: 20px;
    }
    .ups-card-active::before{
        position: relative;
        content: 'SELECTED';
        width: 81px;
        height: 24px;
        background-color: #FFB800;
        border-radius: 5px;
        font-weight: 500;
        font-size: 13px;
        text-align: center;
        padding: 2px 5px;
        left: 30px;
        top: -13px
    }

    .ups-card::before{
        position: relative;
        content: '';
        width: 81px;
        height: 24px;
        background-color: white;
        border-radius: 5px;
        font-weight: 500;
        font-size: 13px;
        text-align: center;
        padding: 2px 5px;
        left: 30px;
        top: -13px
    }
    .img-card{
        margin-left: 50px;
        width: 86px;
        height: 86px;
        position: relative;
        transform: translateY(-58px);
    }
    .ups-card-header{
        display: flex;
        margin: 0px 30px;
        height: 34px;
    }
    .ups-txt{
       font-size: 15px;
       font-weight: 400;
       line-height: 22.5px;
    }
    .ups-content{
        margin: 0px 30px;
    }
    .ups-ul{
        margin-left: -12px;
    }
    .flex-center{
        display: flex;
        justify-content:center;

    }
    
    .show{
        display: block;
    }
    .hide{
        display: none;
    }

    .ups-btn{
        height: 56px;
        width: 322px;
        border-radius: 12px !important;
        padding: 8px 40px 8px 40px !important;
        border:none !important;
    }
    </style>
<body class="login-body font-poppins">
    <div class="contentpanel">
            <div class="ups-container">
                <h1 class="ups-h1 ups-txt-dark txt-center mt-5">Select your preferred </h1>
                <h1 class="ups-h1 ups-txt-yellow txt-center">account type</h1>
            </div>
         
            <div class="ups-container flex-center">
                <!-- Retailer -->
                <div class="cc ups-card-active mt-5 me-5">
                    <div class="ups-card-header">
                        <h2 class="ups-h2 me-1">Free Account</h2>
                        <img src="<?php echo BASE_URL()?>assets/icon/img-1.png" alt="" class="img-card" >
                    </div> 
                    <div class="ups-content">
                     
                       <ul class="ups-ul">
                         <li class="ups-txt-dark">Free e-loading</li>
                         <li class="ups-txt-dark">Bills Payment</li>
                         <li class="ups-txt-dark">Insurance</li>
                       </ul>
                       
                    </div>
                </div>
                <div class="cc ups-card mt-5" >
                    <div class="ups-card-header">
                        <h2 class="ups-h2 me-1">Dealer Account</h2>
                        <img src="<?php echo BASE_URL()?>assets/icon/img-2.png" alt="" class="img-card" style="margin-left: 5em">
                    </div> 
                    <div class="ups-content">
                      
                       <ul class="ups-ul">
                         <li class="ups-txt-dark">E-loading</li>
                         <li class="ups-txt-dark">Bills Payment</li>
                         <li class="ups-txt-dark">Package inclusions 1</li>
                         <li class="ups-txt-dark">Insurance</li>
                         <li class="ups-txt-dark">Remittance</li>
                         <li class="ups-txt-dark">Ticketing</li>
                         <li class="ups-txt-dark">Hotels and more</li>
                       </ul>
            
                    </div>
                </div>
                
            </div>
            <div class="ups-container flex-center mt-5">
                <!-- <button class="ups-btn btn-dark show" style="font-size: 20px; font-weight: 500;" onclick="window.open('<?php echo BASE_URL() ?>Retailer','_self');">Free Account</button> -->
                <button class="ups-btn btn-dark show" style="font-size: 20px; font-weight: 500;" >Not Available</button>
                <button class="ups-btn btn-dark hide" style="font-size: 20px; font-weight: 500;" onclick="window.open('<?php echo BASE_URL() ?>Registration','_self');">Create Dealer Account</button>
            </div>
    </div>
</body>

<script>
    $('.cc').click(function(){
        $('.cc').toggleClass('ups-card-active ups-card');
        $('.ups-btn').toggleClass('show hide');
    });
</script>