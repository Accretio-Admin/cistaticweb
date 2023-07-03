<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-mobile-phone"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>UCREDIT</li>
                                </ul>
                                <h4>AVAIL UCREDIT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">
                  
                    <div class="row1">

                    <?php
                        if( !isset($_POST['loanAmount']) || !isset($_POST['transpass'])) {
                            // if(!isset($msg)) {
                            ?>
                              <div class="col-md-8 alert alert-info" >
                               
                                <p><b>Note :</b></p>
                                <p>Running out of E-cash? Avail an extra E-cash from Unified UCREDIT in just a few clicks.</p>                  
                              </div>
                            <?php
                            // } else {
                            //     if(is_object($msg)) {
                            //         ?>

                                     <?php
                            //     }
                            // } 
                        }
                        ?>

                        
                    </div>
                      <div class="row">
                        <div class="col-md-8" >
                          <?php if ($user['QLS']['S']==2 || $user['QLS']['S']==0): ?> 
                                <div class="alert alert-danger"><?php echo $user['QLS']['M']; ?></div>
                          <?php endif ?>

                            <?php
                            if(isset($msg)) {
                                if(is_object($msg)) {
                                    ?>
                                        <?php if ($msg->S == 0): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $msg->M; ?><br />
                                        </div>
                                        <?php elseif ($msg->S ==1): ?>
                                        <div class="alert alert-success">
                                            <?php echo $msg->M; ?><br />
                                            <!-- <p>Tracking Number:<?php echo $msg->TN?></p> -->
                                            <p><a href="<?php echo $msg->URL?>" target="_blank">Print Receipt</p></p>
                                        </div>
                                        <?php endif ?>
                                    <?php
                                } else {
                                    ?>
                                    <?php if ($msg['S'] == 0): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $msg['M']; ?><br />
                                    </div>
                                    <?php elseif ($msg['S'] ==1): ?>
                                    <div class="alert alert-success">
                                        <?php echo $msg['M']; ?><br />
                                        <p>Tracking Number:<?php echo $msg['TN']?></p>
                                        <p><a href="<?php echo $msg['URL']?>" target="_blank">Print Receipt</p></p>
                                    </div>
                                    <?php endif ?>
                                <?php
                                }
                            }
                            ?>
                            

                          <?php 
                          $msgsuccess = $this->session->flashdata('msgsuccess');
                            if ($msgsuccess['success']==1): ?>
                            <div class="alert alert-success"><b><?php echo $msgsuccess['M']; ?></b></div>
                          <?php endif ?>

                          <?php 
                            $msgsuccess = $this->session->flashdata('msgsuccess');
                            if ($msgsuccess['success']==2): ?>
                            <div class="alert alert-danger"><b><?php echo $msgsuccess['M']; ?></b></div>
                          <?php endif ?>

                        </div>
                      </div>
                      
                      <?php //if ($user['QLS']['S']==1 || $user['R'] == '1234567' || $user['R'] == 'F5033230'): ?>
                          <div class="row">
                              <div class="col-xs-12  col-md-8">
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>    
                                      <h2>Select UCREDIT Amount</h2>
                                      <p>Please choose the amount you want to avail.</p>
                                    </div>
                                    <div class='col-xs-12 col-md-12'>    
                                        <form name="ecashloan" method="post" id="ecashloan" enctype="multipart/form-data" >
                                            <div class="row">
                                                <?php
                                                        ?>
                                                            <div class="col-xs-12 col-md-6">
                                                                <div class="form-group"> 
                                                                    <?PHP
                                                                        // $a = '5000|10000';
                                                                        // print_r(explode)
                                                                    ?>
                                                                    <select class="form-control" name="loanAmount" onChange="ecashloanApp.calculate(this)">
                                                                        <option disabled selected>Select UCREDIT Amount</option>
                                                                        <?php
                                                                            $options = explode('|',$user['QLS']['EEL']);
                                                                            foreach($options as $option) {
                                                                                ?>
                                                                                <option value=<?php echo $option;?>><?php echo $option;?></option>
                                                                                <?php
                                                                            }
                                                                            
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group summaryContainer" style="display:block;"> 
                                                                    <h2>UCREDIT SUMMARY:</h2>
                                                                    <table class="table ecashLoanSummary">
                                                                        <tr class="loanedAmount">
                                                                            <th>E-cash Availed:</th>
                                                                            <td colspan="3" class="loanvalue"><?php echo $defaultLoanValue;?></td>
                                                                        </tr>
                                                                        <tr class="loanDuration">
                                                                            <th>Fund Usage Duration:</th>
                                                                            <td>1 - 7 Days</td>
                                                                            <td>8 - 14 Days</td>
                                                                            <td>15 - 30 Days</td>
                                                                        </tr>
                                                                        <tr class="loanInterest">
                                                                            <th>System Fee:</th>
                                                                            <td class="interest1"><?php echo $defaultLoanValue*.01;?></td>
                                                                            <td class="interest2"><?php echo $defaultLoanValue*.02;?></td>
                                                                            <td class="interest3"><?php echo $defaultLoanValue*.03;?></td>
                                                                        </tr>
                                                                        <tr class="totalPayable">
                                                                            <th>Total Amount Due:</th>
                                                                            <td class="sum1"><?php echo $defaultLoanValue+($defaultLoanValue*.01);?></td>
                                                                            <td class="sum2"><?php echo $defaultLoanValue+($defaultLoanValue*.02);?></td>
                                                                            <td class="sum3"><?php echo $defaultLoanValue+($defaultLoanValue*.03);?></td>
                                                                        </tr>
                                                                    </table>
                                                                    
                                                                    <h2>Terms and Conditions</h2>
                                                                    <div class="tos" onScroll="ecashloanApp.check(this)" style="height:300px; overflow:scroll; border:1px solid black;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;">
                                                                        <?php
                                                                        $this->load->view('ecashloan/termsandconditions');
                                                                        ?>
                                                                    </div>
                                                                    <input type="checkbox" id="agreeTOS" onClick="ecashloanApp.allowSubmit(this)">Do you agree to the 
                                                                        <a href="<?php echo base_url().'ecashloan/termsandconditions';?>" target="_blank">Terms and Conditions</a>
                                                                </div>
                                                                <div class="form-group transpassContainer" style="display:block;">
                                                                    <input type="password" class="form-control" placeholder="Transaction Password" name="transpass" required>
                                                                </div>
                                                                <div class="form-group submitECLContainer" style="display:block;">
                                                                    <button type="submit" class="btn btn-success btn-lg" id="submitECL" disabled>Confirm</button>
                                                                </div>
                                                            </div>
                                                        <?php
                                                ?>
                                            </div>
                                        </form>
                                    </div> <!-- col-xs-12 col-md-8-->
                                </div> <!-- row -->
                              </div> <!--col-xs-6 col-md-6-->
                        </div><!-- row -->
                        <?php //endif     ?>
                    </div><!-- contentpanel -->
    </div><!-- mainpanel -->            