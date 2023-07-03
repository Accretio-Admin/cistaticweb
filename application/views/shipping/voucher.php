  <!-- Created by jrlvaldez Date: 1/12/2018 Time: 2:49 PM -->
<html>
<head>
    <title>Hotel Voucher Preview</title>
    <style type="text/css">
        body{
            font-family: arial;
        }
        a:hover{
            text-decoration: none;
        }

        .wrap {
            width: 1024px;
            background: #fff;
            margin: auto;
        }

        .width-100{
            width:100%;
        }

        .width-80{
            width:80%;
        }

        .width-70{
            width:70%;
        }

        .width-60{
            width:60%;
        }

        .width-50{
            width:50%;
        }

        .width-40{
            width:40%;
        }

        .width-30{
            width:30%;
        }

        .width-20{
            width:20%;
        }

        .width-10{
            width:10%;
        }

        .width-5{
            width:5%;
        }

        .float-left{
            float:left;
        }

        .bill-to-table th, .bill-to-table{
            border: 0 !important;
            text-align: left;
        }

        table, th{
            border: 0;
            text-align: left;
        }
        table{
            border-collapse: collapse;
            width: 100%;
        }
        th{
            font-family : Arial;
            font-size : 13px;
            padding: 10px;
            text-align:center;
            /*color:#fff;*/
        }
        td{
            border: 1px solid #ededed;
            font-family : Arial;
            font-size : 12px;
            padding: 8px;
        }
        .lbl{
            font-weight:bold;
        }
        .lbl1{
            font-size:11px;
        }
        .lblAddress{
            font-size:10px;
        }

        .clearfix{
            clear:both;
            margin:0;
            padding:0;
        }

        @page { margin: 0px 45px; }
        .header { position: fixed; left: 0px; top: -100px; right: 0px; height: 100px; text-align: center; }
        .footer { position: fixed; left: 0px; bottom: -50px; right: 0px; height: 50px;text-align: center;}
        .footer .pagenum:before { content: counter(page); }

        h1, h2, h3, h4, h5, h6 { padding: 0; margin: 0; margin-bottom: 10px }
        h1 { font-size: 51.98102000000001px; }
        h2 { font-size: 39.985400000000006px; }
        h3 { font-size: 30.758000000000003px; }
        h4 { font-size: 23.66px; }
        h5 { font-size: 18.2px; }
        h6 { font-size: 12px; }
        * {
            box-sizing: border-box;
        }


        .headerBanner{
            color: #469824;
            font-weight: 800;
            margin-bottom: 0;
        }

        .md60NoPadding  {
            width: 60%;
            float: left;
        }

        .md40NoPadding  {
            width: 40%;
            float: left;
        }

        .mfooter {
            text-align: center;
            color: #fff;
            /*background-color: #469824;*/
            font-size: 12px;
        }
        .mfooter-top {
            width: 80%;
            margin: auto;
            /*padding: 40px 80px;*/
        }
        .mfooter-bottom {
            /*background-color: #469824;*/
        }
        .button {
            width: 200px;
            height: 50px;
            position: absolute;
            top: 0;
            right: 310px;
        }
        .book-by mcontainer a{
            text-decoration: none;
            color:black;
        }

        .ashBackground{
            background-color: #174889;
        }

        .theme-color{
            color: #469824;
        }

        a {
            text-decoration: none;
            color:black;
        }

        p{
            font-size: 12px ;
            padding-bottom: 0px;
            margin-bottom: 0px;
        }

        .tag {
            background-color: #469824;
            padding: 3px;
            position: absolute;
            top: 0;
            width: 17%;
        }

        .tag h4 {
            color: #fff;
            font-weight: 600;
            font-size: 12px;
            margin: 0;
            white-space: nowrap;
            overflow: auto;
            text-align: center;
        }

        .ashBackground2{
            background-color: #f2f1f1;
        }

        .blueBackground2{
            background-color: #174889;
        }

        .btn-primary {
            background: #469824;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 6px;
            cursor:pointer;
            text-decoration: none !important;
            margin-top: 10px;
        }

        .pull-right {
            float: right;
        }

        .text-center {
            text-align: center;
        }
    </style>

</head>

<body style="width:992px;margin:0px auto">

<div class="wrap">
    <div style=" margin: 200px -45px 0 -45px; background: #469824;">
        <div class="width-100 clearfix" style="margin: 20px 45px 0 45px; padding: 20px 0;">
            <div class="width-50 float-left" >
                <div class="width-100 clearfix" style="margin: auto">
                    <div class="width-60 float-left" >
                <span style="text-align: right">
                    {{--<img src="" style="width: 200px; height: 50px;">--}}
                    <a href="">
                        <img src="{{asset("assets/images/theme/white-logo-futi.png")}}" style="width: 200px; height: 50px;">
                        {{--<img src="" style="width: 200px; height: 50px;">--}}
                        <?php unset($image64)?>
                    </a>
                </span>
                    </div>

                    <div class="width-20 float-left" >
                        &nbsp;
                    </div>

                    <div class="width-20 float-left" >

                    </div>
                </div>
            </div>
            <div class="width-50 float-left" >
                <h2 style="float: right; color:white"> Hotel Voucher</h2>
            </div>
        </div>
    </div>

    <div style="margin:5px -25px 0 -25px">
        <div class="width-100 clearfix" style="margin: auto">
            <div class="width-60 float-left" >
                <div style="text-align: left" class="theme-color">
                    <?php
                    $address = $company->address;
                    if(!empty($city)){
                        $address .= ', '.$city->name;
                    }
                    if(!empty($country)){
                        $address .= ', '.$country->name;
                    }
                    ?>
                    <h5 class="headerBanner" style="padding-bottom: 0;font-size: 15px;"><b>{{$company->company_name}}</b></h5>
                    <p style="line-height: 1.2em;font-size: 12px;padding-top: 0px;margin:0px">
                        {{$address}} <br>
                        {{$company->telephone_number}} <br>
                        {{$company->mobile_number}} <br>
                        <a href="mailto:{{$company->email_address}}" class="theme-color">{{$company->email_address}}</a>
                    </p>
                </div>
            </div>
            <div class="width-10 float-left"></div>
            <div class="width-5 float-left"></div>
            <div class="width-40 float-left">
                Thank you for booking at <font style="color: #4cae4c;">{{$company->company_name}}</font>
                <br>
                <b style="font-weight: 800">Your reservation is confirmed.</b>
            </div>
        </div>
    </div>

    <div style="margin:5px -25px 0 -25px;">
        <div class="width-100 clearfix" style="margin:0 30px -5px 30px; padding-bottom: 10px;">
            <div class="width-100 float-left" style="margin-left: 10px;">
                <div class="width-40 float-left" >
                    <div class="img" style="padding-top: 5px;">
                        @if(empty($images))
                            <img src="{{asset('assets/images/pictures/hotel_image_not available.jpg')}}" class="searchHotelImage" alt="{{$hotels->hotel_name}}" title="{{$hotels->hotel_name}}" />
                        @else
                            <img src="{{$images[0]['url']}}" class="searchHotelImage" alt="{{$hotels->hotel_name}}" title="{{$hotels->hotel_name}}" style="width: 90%;height: 80%; text-align: center"/>
                        @endif
                    </div>
                </div>
                <div class="width-50 float-left">
                    @if(strlen($hotels->hotel_name) > 15)
                        <?php $fontSize = "20px";?>
                    @else
                        <?php $fontSize = "25px";?>
                    @endif
                    <h4 class="font-orange-bold" style="font-size: {{$fontSize}};color: #469824;">
                        {{$hotels->hotel_name}}
                    </h4>
                    <p>
                        {{$hotels->address}} <br>
                        <b>Reservation Date:</b> {{date("M d, Y",strtotime($hotels->check_in))}} - {{date("M d, Y",strtotime($hotels->check_out))}} <br>
                        <b>Booked by:</b> {{$hotels->customer_name}} <br>
                        <b>email address:</b> <a href="">{{$hotels->customer_email}}</a> <br>
                        <b>{{$company->company_name}} Reference</b> {{$hotels->reference_number}} <br>
                        <b>Booking Reference</b> {{$hotels->booking_reference_number}} <br>
                        {{$hotels->telephone}} <br>
                        {{$hotels->stars > 0 ? "RATE: {$hotels->stars} stars":''}}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="width-100 clearfix" style="margin-top: 10px; border: solid 1px #d4d4d4">
        <div class="width-5 float-left">
            &nbsp;
        </div>
        <div class="width-40 float-left">
            <p>
                <b>Check-in Time:</b>	2:00 PM <br>
                <b>Check-out Time:</b> 	noon
            </p>

            <p>
                <b>Check-in policies</b> <br>
                Check-in time starts at 2:00 PM

            </p>
            <p>
                Minimum check-in age is 18
            </p>
            <br>
        </div>

        <div class="width-40 float-left" style="border-left:solid 1px #d4d4d4; padding-left: 40px; margin-left:24px;">
            <p class="bold">
                <b>Lead Guest</b> <br>
                <?php $temp_ld = ''; $temp_ea = ''; $temp = 0; ?>
                @foreach($rooms as $r)
                    @foreach($r->guests as $g)
                        @if($g->paxType=='A' || $g->paxType=='AD')
                            <?php
                            if($temp==0){
                                $temp_ld = $g->titlename.' '.$g->firstname.' '.$g->lastname;
                                $temp_ea = '';
                                $temp = 1;
                            }
                            if(!empty($g->email)){
                                $temp_ld = $g->titlename.' '.$g->firstname.' '.$g->lastname;
                                $temp_ea = $g->email;
                                break;
                            }
                            ?>
                        @endif
                    @endforeach
                @endforeach
                <b>Name:</b> {{ucwords($temp_ld)}} <br>
                <b>E-mail:</b> <a href="" style="text-decoration: none; color:#000000" >{{$temp_ea}} </a>
            </p>

            <p>
                <b>Room Type :</b> {{$hotels->room_name}} <br>
                <b>Board Type:</b> {{$hotels->board_name}} <br>
                <b>Number of Room(s):</b> {{$hotels->room_count}} <br>
            <hr style="padding-bottom: -20px;">
            <span style="font-size: 12px;">
                <b style="padding:0px;">CANCELLATION POLICY</b> <br>
            All cancellations are subject to cancellation fee.
            </span>
            <hr  style=": 0px;">
            </p>
        </div>
    </div>

    <div class="ashBackground2" style="margin:5px -25px 0 -25px;">
        <div class="width-100 clearfix" style="margin:0 30px -5px 30px;padding-bottom: 10px;">
            {{--<div class="tag">--}}
            <div class="width-100 clearfix float-left">
                <h6 class="text-center" style="padding-top: 5px; padding-left: -30px;">Rules and restrictions</h6>
            </div>
            {{--</div>--}}
            <div class="width-50 float-left" style="width: 45%">
                <p style="font-size: 8px;">
                    <b>Cancellations and changes</b> <br>
                    If you cancel or change your plans, please cancel your reservation in accordance with the property&#39;s cancellation policies to avoid a no-show charge.
                    Cancellations or changes made after 23:59 (Local time at your hotel) on {{$transaction->cancel_policy_date !="" ? date("M d, Y",strtotime($transaction->cancel_policy_date)) : date("M d, Y",strtotime($transaction->checkin)) }} or no-shows are subject to a property fee equal to the first night&#39;s rate plus taxes and fees.
                    All cancellations are subject to cancellation processing fee
                </p>

                <p style="font-size: 8px;">
                    <b>Pricing and Payment</b> <br>
                    Hotel fees<br>
                    The price above does not include any applicable hotel service fees, charges for optional incidentals (such as minibar snacks or telephone calls), or regulatory surcharges. The hotel will assess these fees, charges, and surcharges upon check-out. <br>
                    All refunds are subject to refund processing fee.
                </p>
            </div>

            <div class="width-50 float-left" style="margin-left: 10px;">
                <p style="font-size: 8px;">
                    <b>Guest Charges and Room Capacity</b> <br />
                    Base rate is for 2 guests. <br />
                    Total maximum number of guest per room is subject to the specific hotel policy <br />
                    Include DEPOSIT (cash or credit card) UPON CHECK IN for incidental charges. To be returned to Hotel Guests if no consumption of incidental charges such as minibar or telephone calls. <br />
                    Maximum number of adults per room is subject to the specific hotel policy <br />
                    Maximum number of children per room is subject to the specific hotel policy <br />
                    Maximum number of infants per room is subject to the specific hotel policy <br />
                    This property considers guests ages 11 and under, at time of travel, to be children. <br />
                    This property considers guests ages 1 and under, at time of travel, to be infants. <br />
                    Availability of accommodation in the same property for extra guests is not guaranteed. <br />
                    The fee for extra adults is subject to the specific hotel policy <br />
                </p>
                {{--<p>Hotelbeds Customer Service 24/7 : 9029523</p>--}}
                <p style="font-size: 8px;">
                    <b>Customer Service</b> <br />
                    (632) 697-7553    8:30 AM - 5:30 AM <br />
                    {{--(632) 507-1610    after office hours--}}
                    (632) 459-0900    after office hours
                </p>
            </div>

        </div>
    </div>

    <!-- <div class="width-100 clearfix" style="margin-top: 10px;">
        <div style="text-align: center">
            @if(!empty($adsSRC->url_link))
                <a href="{{$adsSRC->url_link}}" target="_blank" style="cursor:pointer;text-decoration: none;"><img src="{{asset($adsSRC->adsBanner->url)}}" style="height: 120px;width: 80%" /></a>
            @else
                <a href="http://olitsolutions.com/" target="_blank" style="cursor:pointer;text-decoration: none;"><img src="{{asset("/assets/images/voucher/olitsolutions.jpg")}}" style="height: 120px;width: 80%" /></a>
            @endif
        </div>
    </div> -->

    <div class="width-100 clearfix" style="margin:0 30px -5px 30px;padding-bottom: 10px;">
        <div class="width-50 float-left">
            <p style="font-size: 8px;padding-bottom: 10px; text-align: center;">
                Please do not reply to this message. This email was sent from a notification-only email address that cannot accept incoming email.
            </p>
        </div>
        <div class="width-50 float-left">
            <p style="font-size: 8px;padding-bottom: 10px; text-align: center;">
                You are viewing this transactional email based on a recent booking or account-related update on <a href="" target="_blank" style="text-decoration: none !important; color:#fff;"> www.futi.com </a>
            </p>
        </div>
    </div>

    <div class="width-100 clearfix" style="margin-bottom:10px; margin-top: 20px;">
        <div class="mfooter">
            <div class="mfooter-bottom">
                <p style="font-size: 10px;padding-bottom: 10px;">&copy; Copyright . All rights reserved.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>