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
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="col-xs-12 col-md-6">
                    <h5 style="font-weight: bold; color: #4169E1; text-align: center; background-color:#add8e6;"
                        class="well well-sm">PASSENGER DETAILS</h5>

                    <div style="height:350px;overflow-y: scroll;">

                        <?php
                        $passengers_obj = array();
                        foreach($passengers as $pass){
                            $temp = explode('|^@^|',$pass);
                            $ptemp = array();
                            foreach($temp as $v){
                                $v = explode(':',$v);
                                $ptemp[$v[0]] = $v[1];

                            }
                            $passengers_obj[] = $ptemp;
                        }

                        /*foreach($passengers_obj as $px){
                            echo print_r($px).'<br>';
                        }*/

                        ?>

                        <?php foreach($passengers_obj as $px):?>
                            <?php
                            switch($px['T']){
                                case 'A':
                                case 'S':
                                    $p = "ADULT";
                                    $date1=DateTime::createFromFormat('d/m/Y',$px['DOB']);
                                    $date2= new DateTime();
                                    $diff=date_diff($date1,$date2);
                                    $age = (int)$diff->format('%y');
                                    if($age>59){
                                        $p = "SENIOR";
                                    }
                                    break;
                                case 'C':
                                    $p = "CHILDREN";
                                    break;
                                case 'I':
                                    $p = "INFANT";
                                    break;
                            };

                            ?>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group" style="font-size: 15px;">
                                    <span class="label label-warning pull-right"><?php echo $p; ?>PASSENGER</span>
                                </div>
                                <div class="form-group">
                                    <label>NAME:</label>
                                    <span class="pull-right"><?php echo $px['FN'].' '.$px['LN']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label>BIRTH DATE:</label>
                                    <span class="pull-right"><?php echo $px['DOB']; ?></span>
                                </div>
                                <!--<div class="form-group">
                                    <label>BAGGAGE ONWARD:</label>
                                    <span class="pull-right"><?php /*echo $OB[1]; */?></span>
                                </div>
                                <div class="form-group">
                                    <label>BAGGAGE RETURN:</label>
                                    <span class="pull-right"><?php /*echo $RB[1]; */?></span>
                                </div>-->
                            </div>
                        <?php endforeach;?>

                    </div>
                </div>

                <div class="col-xs-12 col-md-6">
                    <h5 style="font-weight: bold; color: #4169E1; text-align: center; background-color:#add8e6;"
                        class="well well-sm">OTHER DETAILS</h5>

                    <div class="col-xs-12 col-md-12">

                        <div class="form-group-sm">
                            <label>CONTACT NO.:</label>
                            <span class="pull-right"><?php echo $contact_info['phone']; ?></span>
                        </div>
                        <div class="form-group-sm">
                            <label>STREET:</label>
                            <span class="pull-right"><?php echo $contact_info['street']; ?></span>
                        </div>
                        <div class="form-group-sm">
                            <label>CITY:</label>
                            <span class="pull-right"><?php echo $contact_info['city']; ?></span>
                        </div>
                        <div class="form-group-sm">
                            <label>ZIPCODE:</label>
                            <span class="pull-right"><?php echo $contact_info['zipcode']; ?></span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12">
                        <h5 style="font-weight: bold; color: #4169E1; text-align: center; background-color:#add8e6;"
                            class="well well-sm">PAYMENT DETAILS</h5>

                        <div class="form-group-sm">
                            <label>BASE FARE FEE</label>
                                <span class="pull-right"><?php echo number_format($pricing[0]['BaseFareFee'], 2, '.', ','); ?></span>
                        </div>
                        <div class="form-group-sm">
                            <label>TAXES & FEES</label>
                                <span class="pull-right">
                                    <?php echo number_format($pricing[0]['TaxFee']+$pricing[0]['MarkupFee']+$pricing[0]['SystemFee'], 2, '.', ','); ?>
                                </span>
                        </div>
                        <!--                                                            <div class="form-group-sm">
                                                            <label>SYTEM FEE</label>
                                                            <span class="pull-right"><?php echo number_format($payment_details['P']['SystemFee'], 2, '.', ','); ?></span>
                                                          </div>
                                                          <div class="form-group-sm">
                                                            <label>MARKUP FEE</label>
                                                            <span class="pull-right"><?php echo number_format($payment_details['P']['MarkupFee'], 2, '.', ','); ?></span>
                                                          </div> -->
                        <div class="form-group-sm">
                            <label>TOTAL FEE</label>
                                <span class="label label-danger pull-right"
                                      style="font-size:18px"><?php echo number_format($pricing[0]['TotalFee'], 2, '.', ','); ?></span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 text-right" style="margin-top:10px">
                        <hr/>
                        <form method="post" action="<?php echo BASE_URL() ?>Abacus_International_flights/book_flights"
                              class="transaction_form">
                            <button type="button" class="btn btn-danger">Cancel</button>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Confirm
                            </button>

                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h4 class="text-left">Are you sure you want to proceed ?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary" name="btnConfirm">Proceed
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" name="pageto" value="success">

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>