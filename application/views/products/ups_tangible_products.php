
    <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>MLM PRODUCT DISTRIBUTION</li>
                                </ul>
                                <h4>PRODUCT DISTRIBUTION</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->


                    <div class="contentpanel container1" style="max-width: 100%; background:#fff;">
                      <div class="row">
							    <!-- start dto -->
								<div class="col-md-12" id="container-cart">
									<div class="row1">
										<h4>UPS Inventory System</h4>
										<!-- 1st Product -->
								        <div class="col-md-6">
								        	<div class="row">
												<?php
												$count = 0;
												foreach ($products as $key => $row):
												?>
												<div class="col-sm-4 col-md-4 content portfolio-item" style="padding-left: 0px;">
													<div class="panel panel-primary">
													  <div class="panel-heading" style="font-size: 2vmin; height: 35px;"><p style="font-family: 'Times New Roman', Times, serif; font-size: 15px; margin-top: 0px; overflow:hidden; white-space:nowrap; text-overflow: ellipsis; color:#000000;"><span style="color:#FFFFFF;"><strong><?php echo $row['product_code'];?></strong></span> - <span style="color:#000000;"><?php echo $row['product_name'];?></span></p></div>
													  <div class="panel-body" style="font-size: 2vmin 1vmax;">
													  	<?php 
													  	if($user['L'] == 16)
													  	{
													  		$discounted_price = $row['ecc_price'];
													  	}
													  	else if($user['L'] == 7)
													  	{
													  		$discounted_price = $row['hub_price'];
													  	}
													  	else
													  	{
													  		$discounted_price = $row['dealer_price'];
													  	}
													  	?>
														<a data-toggle="modal" onclick="<?php echo 'modalViewProd(\''.$row['rowid'].'\',\''.$row['product_code'].'\',\''.$row['product_name'].'\',\''.$row['product_desc'].'\',\''.$row['price'].'\',\''.$row['distributor_price'].'\',\''.$row['pv'].'\',\''.$row['status'].'\',\''.$row['inventory'].'\',\''.$row['sold'].'\',\''.'admin'.'\',\''.$discounted_price.'\')'; ?>" style="cursor: pointer;">	
															<img src="<?php echo 'https://mobilereports.globalpinoyremittance.com/assets/images/MLMProducts/'.$row['product_code'].'.jpg' ?>" style="height:60px; width:100px; background-image: url('https://mobilereports.globalpinoyremittance.com/assets/images/MLMProducts/noimage.jpg'); background-size: 100px; margin:0 auto; display:block;"> <span class="text-center" style="margin:0 auto; display:block; font-size:11px;"><b><?php echo $row['product_name'];?></b></span>
														</a>								  	 
														<p style="font-family: 'Times New Roman', Times, serif; margin-top:10px;">
															<strong>Total Stocks : </strong><span style="color:#4e4e4e;"><?php echo number_format($row['inventory']);?></span>
															<br/>
															<strong>Distributed : </strong><span style="color:#4e4e4e;"><?php echo number_format($row['sold']);?></span>
															<br/>
															<strong>Available Stocks : </strong>
																<?php if(($row['inventory'] - $row['sold']) <= 50) { ?>
																	<span style="color:#ff3000;"><b><?php echo number_format($row['inventory'] - $row['sold']);?></b></span>
																<?php } else { ?>
																	<span style="color:#4e4e4e;"><b><?php echo number_format($row['inventory'] - $row['sold']);?></b></span>
																<?php } ?>
														</p>
													  </div>
													</div>
												</div>
												<?php
												$counter++; 
												endforeach;
												$total_count=($counter/$imageLimit);
												?>
												<input type="hidden" class="tiggerclassProd" data-toggle="modal" data-target=".loadingtsreditcon">

										        <span id="totalcount" hidden><?php echo $total_count ?></span>
										        <span id="imagelimit" hidden><?php echo $imageLimit ?></span>
										        <div class="col-sm-12 col-md-12 text-center">
									                <ul class="pagination" id="pagin" style="margin-top: 0px;">
									                    <li>
									                        <a href="#" id="prev" class="btn">&laquo;</a>
									                    </li>
									                    <li class="current">
									                        <a href="#">1</a>
									                    </li>
									                    <?php for ($i=1; $i < $total_count ; $i++) { ?>
									                     <li>
									                        <a href="#"><?php echo $i+1 ?></a>
									                    </li>
									                    <?php } ?>
									                    <li>
									                        <a href="#" id="next" class="btn">&raquo;</a>
									                    </li>
									                </ul>
								                </div>
											</div>
								        </div>

										<!-- Add Cart Product -->
										<div class="col-md-6 well">
											<h4 class="hr2 animated fadeIn handwritten">Product Cart</h4>
											<div class="table table-responsive">
											<div class="alert alert-danger" id="alertCart" style="display: none; word-wrap:break-word;"></div>
							                    <table class="table table-hover" style=" display:block; height:230px; overflow:auto;">
							                        <thead>
							                        	<th class="animated fadeIn delay025s"><i class='glyphicon glyphicon-pencil btn-xs'></i></th>
							                            <th class="animated fadeIn delay025s" nowrap="">Qty</th>
							                            <th class="animated fadeIn delay050s" nowrap="">Product Code</th>
							                            <th class="animated fadeIn delay050s" nowrap="">Product Name</th>
							                            <th class="animated fadeIn delay050s" nowrap="">Price</th>
							                            <th class="animated fadeIn delay1s" style="text-align: center;">Action</th>
							                            <!-- <th></th> -->
							                        </thead>
							                        <tbody id="cart">
							                        </tbody>
							                    </table>
							                    <h4 class="hr2 animated fadeIn handwritten"></h4>
							                    <table class="table table-hover">
							                        <thead>
							                        </thead>
							                        <tbody>
							                           	<tr>
							                                <td><b>Total Price :</b></td>
							                                <td><b><input type="text" id="total-price" readonly class="form-control"/></b></td>
							                                <td></td>
							                                <td></td>
							                            </tr>
							                            <tr>
							                            <form id="form-validate-cart">
							                                <td><b>Branch Regcode :</b></td>
							                                <td hidden><input type="text" id="getall" name="getall"></td>
							                                <td><input type="text" id="regcode" value="" class="cart_regcode form-control col-md-6" name="regcode" disabled="" /></td>
							                            </tr>
							                        </tbody>
							                    </table>
							                    <div class="form-group margin-top-small margin-bottom-large pull-right">
							                        <button class="btn btn-primary animated bounceIn delay125s pull-right" id="btn-totalcart" style="margin-left: 5px;" disabled=""><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Checkout</button>
							                        </form>
													<a href="<?php echo base_url();?>Products/ups_tangible_products" class="btn btn-default animated bounceIn delay125s" id="btn-cancelcart" disabled=""><span class="glyphicon glyphicon-remove" aria-hidden="true">Cancel</a>
							                    </div>
							                           
							                </div>
										</div>
										<!-- Add Cart Product -->
									</div>
									<!-- Start Modal -->

							         <!-- Start Tangible Products -->
									<div id="loadingtsreditcon" class="modal fade loadingtsreditcon" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<!-- <div class="modal-content" style="max-height: 600px;"> -->
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h5 class="modal-title color" id="myModalLabel">UPS Tangible Product Details</h5>
												</div>
												<!-- <div class="modal-body" style="max-height: 600px;"> -->
												<div class="modal-body">
													<!-- <div class="jumbotron" style="max-height: 500px;  padding-top: 2%;"> -->
													<div class="jumbotron" style="padding: 5%; margin-bottom: 0px;">
												<!-- Start Flash Messages -->
														<div class="alert flasher" style="display: none;"><strong><span class="mensahe"></span></strong></div>
												<!-- End Flash Messages -->

												<!-- First View -->
														<div class="pinoyFirstview" >
																<div class="table table-responsive" style="overflow: hidden;">
																	<div class="container" style="padding-left:0%; padding-right:0%;">
																	  <div class="row">
																	    <div class="col-md-12">
																            <table class="table table-responsive">
<!-- 																                <thead>
																                    <tr class="EditUPStangibleProd2"></tr>
																                </thead> -->
																                <tbody id="EditUPStangibleProd" class="EditUPStangibleProd" style="font-family: 'Times New Roman', Times, serif;">
																                  	<tr class="EditUPStangibleProd2"></tr>
																                  	<tr class="EditUPStangibleProd44"></tr>
																                	<tr class="EditUPStangibleProd3"></tr>
																                	<tr class="EditUPStangibleProd4"></tr>
																                	<tr class="EditUPStangibleProd12"></tr>
																                	<tr class="EditUPStangibleProd6"></tr>
																                	<tr class="EditUPStangibleProd5"></tr>
																                	<tr class="EditUPStangibleProd7"></tr>
																                	<tr class="EditUPStangibleProd8"></tr>
																                	<tr class="EditUPStangibleProd1"></tr>
																                </tbody>
																            </table>
																	    </div>
																		</div>
																	</div>

														            <h4 class="hr2 animated fadeIn handwritten"></h4>
														            <table class="table table-hover" style="margin-bottom: 0px;">
														                <thead>
														                </thead>
														                <tbody>
														                	<tr>
														                		<td>
														                        	Quantity: </br></br>
														                        	Total Amount:	</br>	
														                        </td>
														                        <td>
														                        	<input type="number" id="quantity" min="1" value="1" class="form-control col-md-6" name="quantity" /> </br>
														                        	<span id="product-total-price"></span></br>
														                        	<span hidden id="product-total-discount"></span></br>
														                        	<span hidden id="product-total-pv"></span>
														                        	</br>
														                        	<span hidden id="product-final-price"></span></br>
														                        	<span hidden id="product-final-discount"></span>
														                        	<span hidden id="product-final-pv"></span>
														                        </td>
														                	</tr>
														                    <input type="hidden" class="tiggerclassEditProd" data-toggle="modal" data-target=".editTangibleprod">
														                </tbody>
														            </table>  
														        </div>

														        <div class="form-group margin-top-small margin-bottom-large">
														            <button class="btn btn-primary btn-addtocart pull-right animated bounceIn delay125s" id="btn-addtocart" value="" name="btn-addtocart" data-dismiss="modal" style="margin-left: 5px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to cart</button>
														        	<button type="button" class="btn btn-default pull-right animated bounceIn delay75s" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true">Cancel</button>
														        </div>
														</div>
												<!-- First View -->   
													</div>
												</div>    	            
											</div>
										</div>
									</div>

                      </div>
                    </div>

					  <!-- Modal -->
					  <div class="modal fade" id="modalPaymentMode" data-backdrop="static" role="dialog" style="margin-top: 5%;">
					    <div class="modal-dialog">
					    
					      <!-- Modal content-->
					      <div class="modal-content" id="cart-paymentmodal">
					        <div class="modal-header" id="modalhead">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h4 class="modal-title">Payment Option</h4>
					        </div>
					        <div class="modal-body" id="modalbody">
					          <p>How would you like to pay?</p>
					          <div class="form-group">
					                <select class="form-control" name="selinvpaymenttype" id="selinvpaymenttype" required>
					                      <option value="" disabled selected>--Choose--</option>
					                      <option value="CASH">CASH</option>
					                      <option value="ECASH">ECASH</option>
					                </select>  
					          </div>
					        </div>
					        <div class="modal-footer" id="modalfooter" style="display:block;">
					          <button class='btn btn-default' id='' data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Cancel</button>
					          <button class='btn btn-primary' id='btn-payout' disabled=""><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Checkout</button>
					        </div>
					      </div>
					      
					    </div>
					  </div>

	</div><!-- mainpanel -->    


