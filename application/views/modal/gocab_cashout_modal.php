<div id="gocab_shipper_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                <h4 class="modal-title">&nbsp;</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid" style="width:80%;">
                    <div class="row">
                        <center><table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="background-color:black; color:yellow;" colspan ="2" class="text-center">
                                        TRANSACTION SUMMARY
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h5><strong>REFERENCE NO</strong></h5></td>
                                    <td class="text-right"><h5><?php echo $result['objectId'];?></h5></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>ACCOUNT NAME</strong></h5></td>
                                    <td class="text-right"><h5><?php echo ($result['roleType'] == 'MERCHANT') ? $result['user']['username'] : $result['user']['firstName'].' '.$result['user']['lastName'];?></h5></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>ACCOUNT TYPE</strong></h5></td>
                                    <td class="text-right"><h5><?php echo $result['roleType'];?></h5></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>AMOUNT</strong></h5></td>
                                    <td class="text-right"><h5><?php echo number_format($result['amount'], 2);?></h5></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>SERVICE FEE</strong></h5></td>
                                    <td class="text-right"><h5><?php echo number_format($result['transactionFee'], 2);?></h5></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>CHANNEL FEE</strong></h5></td>
                                    <td class="text-right"><h5><?php echo number_format($result['channelFee'], 2);?></h5></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>TOTAL</strong></h5></td>
                                    <td class="text-right"><h5><?php echo number_format($result['total'], 2);?></h5></td>
                                </tr>
                            </tbody>
                        </table></center>
                        <h5><strong>Transaction Password</strong></h5>
                        <input type="password" placeholder="Input Transaction Password" class="form-control" id="i_gocab_cashout_transpass" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="gocab_confirmbutton_cashout">

                </div>
                <button style="margin-top: 10px;" class="btn btn-primary pull-right" id="gocab_process_cashout">CONFIRM</button>
            </div>
        </div>
    </div>
</div>