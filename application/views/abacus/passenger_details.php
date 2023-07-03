<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-plane"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ABACUS</li>
                </ul>
                <h4><?php echo $menu=='int'? 'INTERNATIONAL': 'DOMESTIC' ?> FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->


    <div class="contentpanel" ng-app="MyApp" ng-controller="myCtrl" ng-cloak>
        <div class="col-xs-12 col-md-12 ">
            <!--<form>
                <div>
                    <table class="table">
                        <thead>
                        <th>Passenger</th>
                        <th></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Senior Citizen</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>ADULT</td>
                            <td><select class="">
                                    <option value="1">Mr</option>
                                    <option value="2">Mrs</option>
                                    <option value="3">Miss</option>
                                    <option value="4">Mstr</option>
                                </select></td>
                            <td><input type="text" ng-model="asd" class=""
                                       name="<?php /*echo substr($k, 0, 1) . $i; */?>_fname"
                                       pattern="[a-zA-Z\s]+" required></td>
                            <td><input type="text" ng-model="asd" class=""
                                       name="<?php /*echo substr($k, 0, 1) . $i; */?>_fname"
                                       pattern="[a-zA-Z\s]+" required></td>
                            <td>
                                <input type="checkbox" ng-model=">_cbox">
                                <input type="text" class="form-control" name="<?php /*echo substr($k, 0, 1) . $i; */?>_sid" required>
                            </td>

                        </tr>

                        </tbody>
                    </table>
                </div>
            </form>-->
            <?php if($S==0):?>

                <div class="col-md-offset-2 col-lg-offset-2 col-md-8 col-lg-8">
                    <center>
                        <img src="<?php echo base_url('/assets/icon').'/'?>cancel.png">
                        <h4><?php echo $M; ?></h4>
                    </center>
                </div>

            <?php else:?>

            <form action="<?php echo BASE_URL() ?>Abacus_International_flights/book_flights"
                  method="post" class="transaction_form" id="frmDomesticFlights">
                <div class="row">
                    <div class="col-md-5 well">
                        <?php $p_count = 0; ?>
                        <?php foreach ($passengers as $k => $v): ?>

                            <?php for ($i = 0; $i < $v; $i++): ?>

                                <div>
                                    <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><?php echo strtoupper($k) ?> PASSENGER</h5>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                <b>Title </b>
                                                <select class="form-control" name="<?php echo substr($k, 0, 1) . $i; ?>_title">
                                                    <option value="1">Mr</option>
                                                    <option value="2">Mrs</option>
                                                    <option value="3">Miss</option>
                                                    <option value="4">Mstr</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6">
                                                <b>FirstName</b>
                                                <input type="text" class="form-control" name="<?php echo substr($k, 0, 1) . $i; ?>_fname" pattern="[a-zA-Z\s]+" required>
                                            </div>
                                            <div class="col-xs-6 col-md-6">
                                                <b>LastName</b>
                                                <input type="text" class="form-control" name="<?php echo substr($k, 0, 1) . $i; ?>_lname" pattern="[a-zA-Z\s]+" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="form-group" ng-show="'<?php /*echo strtoupper(substr($k, 0, 1)); */?>'=='A'">
                                        <label>
                                            <input type="checkbox" name="<?php /*echo substr($k, 0, 1) . $i; */?>_cbox">
                                            Senior Citizen
                                        </label>
                                    </div>-->

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6">
                                                <b>Birthday</b>

                                                <input type="text" class="form-control bdatetimepicker <?php echo $k.'bdate';?>" name="<?php echo substr($k, 0, 1) . $i; ?>_bdate" id="birthdate" placeholder="mm/dd/yyyy" readonly required>
                                            </div>

                                            <!--<div class="col-xs-6 col-md-6" ng-show="<?php /*echo substr($k, 0, 1) . $i; */?>_cbox">
                                                <b>Senior ID</b>
                                                <input type="text" class="form-control" name="<?php /*echo substr($k, 0, 1) . $i; */?>_sid" required>
                                            </div>-->
                                        </div>
                                    </div>

                                    <!--<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                <b>Baggage</b>
                                                <input type="text" class="form-control" readonly required>
                                            </div>

                                        </div>
                                    </div>-->

                                </div>
                                <hr>
                            <?php $p_count++; ?>
                            <?php endfor; ?>
                        <?php endforeach; ?>
                    </div>



                    <div class="col-md-5 col-lg-5 col-md-offset-2 well">
                        <div class="form-group">
                            <h5 style=" font-weight: bold; color: #4169E1;">CONTACT DETAILS</h5>

                            <div class="row">
                                <div class="col-xs-6 col-md-8">
                                    <b>Contact No</b>
                                    <input type="text" class="form-control" name="contactno"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 style="font-weight: bold; color: #4169E1;">DELIVERY
                                DETAILS</h5>

                            <div class="row">
                                <div class="col-xs-6 col-md-8">
                                    <b>Street</b>
                                    <input type="text" class="form-control" name="street"
                                           required>
                                </div>
                                <div class="col-xs-6 col-md-4">
                                    <b>Zipcode</b>
                                    <input type="text" class="form-control" name="zipcode"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <b>City</b>
                            <input type="text" class="form-control" name="city" required>
                        </div>

                        <div class="form-group">
                            <h5 style="font-weight: bold; color: #4169E1;">PAYMENT
                                DETAILS</h5>

                            <p>GPRS ensures that every transaction, including your credit
                                card information, you conduct is safe and secure. To achieve
                                this, the site is protected by leading Secured Socket Layer
                                (SSL) encryption technology.</p>
                            <b>Total Price</b>
                            <input type="text" class="form-control" value="{{<?php echo $pricing[0]['TotalFee']; ?>|currency : 'PHP '}}" readonly="">
                        </div>

                        <div class="form-group">
                            <b>Mode of Payment</b>
                            <input type="text" class="form-control" value="Deposit"
                                   readonly="">
                        </div>

                        <div class="form-group">
                            <h5 style="font-weight: bold; color: #4169E1;">TERMS AND
                                CONDITIONS</h5>

                            <p>Fares are subject to availability. In case there is any fare
                                change we will notify you at the earliest.</p>
                            <input type="checkbox" value="" required> <span>I have read and accept the <b>TERMS
                                    AND CONDITIONS</b> and <b>FARE RULES</b>.</span>
                        </div>
                        <div class="form-group">
                            <b>Transaction Password</b>
                            <input type="password" class="form-control" name="transpass" ng-model="transpass" required>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="#" class="btn btn-warning"><span
                                            class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                                    <button name="btnBookFlights" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-md-5" hidden>
                        <input type="text" name="passengers" value="{{passengers}}">
                        <input type="text" name="rqid" value="{{rqid}}">
                        <input type="text" name="transpass" value="{{transpass}}">
                        <input type="text" name="pageto" value="summary">
                    </div>

                </div>

            <!--<hr>-->

            </form>
            <?php endif; ?>
        </div>

    </div>
</div>