<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-users"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>NETWORK</li>
                </ul>
                <h4>NETWORK</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader --> 
    <div class="contentpanel">
        <!-- Load icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div class="col-xs-6 col-md-6">
        <!-- The form -->
        <form class="example" action="<?php echo BASE_URL(); ?>Network/genealogy/" onsubmit="location.href = this.action + this.txtSessionIdx.value; return false;">
          <input type="text"  placeholder="Search downlines via Regcode.." name="txtSessionIdx" id="txtSessionIdx">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        </div>
        <div class="row text-center">
            <div class="col-xs-12 col-md-12 text-center">
            <h3 style="text-align: center;">MY GENEALOGY</h3>
                <div class="row text-center">
                	<div class="col-xs-2 col-xs-offset-5 col-md-2 col-md-offset-5">
                		<?php
                			    $x = "<table border='0'>
                                                <tr>
                                                    <td>Sponsor</td>
                                                    <td>". $genealogy[0]['sponsor'] ."</td>
                                                </tr>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>".$genealogy[0]['fname']." ".$genealogy[0]['mname']." ".$genealogy[0]['lname']."</td>
                                                </tr>
                                                <tr>
                                                    <td>Left Points</td>
                                                    <td>".$genealogy[0]['l_points']."</td>
                                                </tr>
                                                <tr>
                                                    <td>Right Points</td>
                                                    <td>".$genealogy[0]['r_points']."</td>
                                                </tr>
                                            </table>";  
                		?>
                     
                        	
                        		<?php if ($genealogy[0]['reg_code']==""){ ?>
                                    <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x; ?>">
                        			<img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                        	   <?php }else { ?>
                               
                                <a href="<?php echo BASE_URL(); ?>Network/genealogy/" id= "network_thumb1" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x; ?>">
                                    <?php echo ($genealogy[0]['reg_code']=="")?"Vacant":$genealogy[0]['fname']." ".$genealogy[0]['mname']." ".$genealogy[0]['lname']; ?>
                        			<img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32"> 	
                        	<?php } ?>
                        	
                            <?php echo ($genealogy[0]['reg_code']=="")?"Vacant":$genealogy[0]['reg_code']; ?>
                          
                            <br />
                         
                    	</a> 
                	</div>
            	</div>
                <div class="row text-center">
                	<div class="col-xs-10 col-xs-offset-1 col-md-10 col-md-offset-1">
                		<div class="row text-center">
                   

                			<div class="col-xs-6 col-md-6">
                				<div class="row text-center">
                					<div class="col-xs-4 col-xs-offset-4 col-md-4 col-md-offset-4">
                						<?php
				                			    $x1 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[1]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[1]['fname']." ".$genealogy[1]['mname']." ".$genealogy[1]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[1]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[1]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                		?>	
                                                <?php if ($genealogy[1]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x1; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                     	              <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[1]['reg_code']; ?>" id= "network_thumb2"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x1; ?>" >
                        			             <?php echo ($genealogy[1]['reg_code']=="")?"Vacant":$genealogy[1]['fname']." ".$genealogy[1]['mname']." ".$genealogy[1]['lname'] ?>
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32"> 	
                        	               <?php } ?>
                        	
                                              <?php echo ($genealogy[1]['reg_code']=="")?"Vacant":$genealogy[1]['reg_code'] ?>
                                    	</a>
                                    
                                	</div>
                            	</div>
                        	</div>

             
                			<div class="col-xs-6 col-md-6">
                				<div class="row text-center">
                					<div class="col-xs-4 col-xs-offset-4 col-md-4 col-md-offset-4">
                						<?php
				                			    $x2 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[2]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[2]['fname']." ".$genealogy[2]['mname']." ".$genealogy[2]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[2]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[2]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                		?>	
                                     	<?php if ($genealogy[2]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x2; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[2]['reg_code']; ?>" id= "network_thumb3"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x2; ?>" >
                                                 <?php echo ($genealogy[2]['reg_code']=="")?"Vacant":$genealogy[2]['fname']." ".$genealogy[2]['mname']." ".$genealogy[2]['lname'] ?>
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                        	
                                              <?php echo ($genealogy[2]['reg_code']=="")?"Vacant":$genealogy[2]['reg_code'] ?>
                                    	</a>
                                    	
                                	</div>
                            	</div>
                        	</div>
                        </div>	
                	</div>
            	</div>
            	<div class="row text-center">
            		<div class="col-xs-10 col-xs-offset-1 col-md-10 col-md-offset-1">
                		<div class="row text-center">
                			<div class="col-xs-6 col-md-6">
                				<div class="row text-center">
                					<div class="col-xs-5 col-xs-offset-1 col-md-4 col-md-offset-2">
                					<?php
				                			    $x3 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[3]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[3]['fname']." ".$genealogy[3]['mname']." ".$genealogy[3]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[3]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[3]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                		?>	
                           
                                     	
                                        	        	<?php if ($genealogy[3]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x3; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[3]['reg_code']; ?>" id= "network_thumb4"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x3; ?>" >
                                                 <?php echo ($genealogy[3]['reg_code']=="")?"Vacant":$genealogy[3]['fname']." ".$genealogy[3]['mname']." ".$genealogy[3]['lname'] ?>
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                                              <?php echo ($genealogy[3]['reg_code']=="")?"Vacant":$genealogy[3]['reg_code'] ?>
                                    	</a>
                                    	
                                	</div>
                					<div class="col-xs-5 col-md-4">
                					<?php
				                			    $x4 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[4]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[4]['fname']." ".$genealogy[4]['mname']." ".$genealogy[4]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[4]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[4]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                		?>	
                                     
                                        		        	<?php if ($genealogy[4]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x4; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[4]['reg_code']; ?>" id= "network_thumb5"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x4; ?>" >
                                                 <?php echo ($genealogy[4]['reg_code']=="")?"Vacant":$genealogy[4]['fname']." ".$genealogy[4]['mname']." ".$genealogy[4]['lname'] ?>
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                        	
                                              <?php echo ($genealogy[4]['reg_code']=="")?"Vacant":$genealogy[4]['reg_code'] ?>
                                    	</a>
                                    	
                                	</div>
                            	</div>
                			</div>
                			<div class="col-xs-6 col-md-6">
                				<div class="row text-center">
                					<div class="col-xs-5 col-xs-offset-1 col-md-4 col-md-offset-2">
                					<?php
				                			    $x5 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[5]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[5]['fname']." ".$genealogy[5]['mname']." ".$genealogy[5]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[5]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[5]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                		?>	
                                     	
                                        		    <?php if ($genealogy[5]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x5; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[5]['reg_code']; ?>" id= "network_thumb6"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x5; ?>" >
                                                 <?php echo ($genealogy[5]['reg_code']=="")?"Vacant":$genealogy[5]['fname']." ".$genealogy[5]['mname']." ".$genealogy[5]['lname'] ?>
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                        	
                                              <?php echo ($genealogy[5]['reg_code']=="")?"Vacant":$genealogy[5]['reg_code'] ?>
                                    	</a>
                                    
                                	</div>
                					<div class="col-xs-5 col-md-4">
                					<?php
				                			    $x6 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[6]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[6]['fname']." ".$genealogy[6]['mname']." ".$genealogy[6]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[6]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[6]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                		?>	
                                     	
                                        		<?php if ($genealogy[6]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x6; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[6]['reg_code']; ?>" id= "network_thumb7"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x6; ?>" >
                                                 <?php echo ($genealogy[6]['reg_code']=="")?"Vacant":$genealogy[6]['fname']." ".$genealogy[6]['mname']." ".$genealogy[6]['lname'] ?>
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                        	
                                              <?php echo ($genealogy[6]['reg_code']=="")?"Vacant":$genealogy[6]['reg_code'] ?>
                                    	</a>
                                    	
                                	</div>
                            	</div>
                			</div>
                		</div>
            		</div>
            	</div>
            	<div class="row text-center">
            		<div class="col-xs-10 col-xs-offset-1 col-md-10 col-md-offset-1">
            			<div class="row text-center">
            				<div class="col-xs-6 col-md-6">
            					<div class="row text-center">
            						<div class="col-xs-6 col-md-6">
            							<div class="row text-center">
            								<div class="col-xs-6 col-md-6">
            								<?php
				                			    $x7 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[7]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[7]['fname']." ".$genealogy[7]['mname']." ".$genealogy[7]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[7]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[7]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                		?>	
                    							<?php if ($genealogy[7]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x7; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[7]['reg_code']; ?>" id= "network_thumb8"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x7; ?>" >
                                                      <?php echo ($genealogy[7]['reg_code']=="")?"Vacant":$genealogy[7]['fname']." ".$genealogy[7]['mname']." ".$genealogy[7]['lname'] ?>   
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                        	
                                                      <?php echo ($genealogy[7]['reg_code']=="")?"Vacant":$genealogy[7]['reg_code'] ?>
                                            	</a>
                                            	
                                        	</div>
            								<div class="col-xs-6 col-md-6">
            								<?php
				                			    $x8 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[8]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[8]['fname']." ".$genealogy[8]['mname']." ".$genealogy[8]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[8]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[8]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                		?>	
                    							<?php if ($genealogy[8]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x8; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[8]['reg_code']; ?>" id= "network_thumb9"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x8; ?>" >
                                                 <?php echo ($genealogy[8]['reg_code']=="")?"Vacant":$genealogy[8]['fname']." ".$genealogy[8]['mname']." ".$genealogy[8]['lname'] ?>   
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                        	
                                                      <?php echo ($genealogy[8]['reg_code']=="")?"Vacant":$genealogy[8]['reg_code'] ?>
                                            	</a>
                                            
                                        	</div>
                                    	</div>
            						</div>
            						<div class="col-xs-6 col-md-6">
            							<div class="row text-center">
            								<div class="col-xs-6 col-md-6">
            								<?php
				                			    $x9 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[9]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[9]['fname']." ".$genealogy[9]['mname']." ".$genealogy[9]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[9]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[9]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                		?>	
                    							<?php if ($genealogy[9]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x9; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[9]['reg_code']; ?>" id= "network_thumb10"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x9; ?>" >
                                                 <?php echo ($genealogy[9]['reg_code']=="")?"Vacant":$genealogy[9]['fname']." ".$genealogy[9]['mname']." ".$genealogy[9]['lname'] ?>   
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                        	
                                                      <?php echo ($genealogy[9]['reg_code']=="")?"Vacant":$genealogy[9]['reg_code'] ?>
                                            	</a>
                                            	
                                        	</div>
            								<div class="col-xs-6 col-md-6">
            								<?php
				                			    $x10 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[10]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[10]['fname']." ".$genealogy[10]['mname']." ".$genealogy[10]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[10]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[10]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                				?>	
                    						<?php if ($genealogy[10]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x10; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[10]['reg_code']; ?>" id= "network_thumb11"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x10; ?>" >
                                                 <?php echo ($genealogy[10]['reg_code']=="")?"Vacant":$genealogy[10]['fname']." ".$genealogy[10]['mname']." ".$genealogy[10]['lname'] ?>   
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                        	
                                                      <?php echo ($genealogy[10]['reg_code']=="")?"Vacant":$genealogy[10]['reg_code'] ?>
                                            	</a>
                                            	
                                        	</div>
                                    	</div>
            						</div>
            					</div>
            				</div>
            				<div class="col-xs-6 col-md-6">
            					<div class="row text-center">
            						<div class="col-xs-6 col-md-6">
            							<div class="row text-center">
            								<div class="col-xs-6 col-md-6">
            									<?php
				                			    $x11 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[11]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[11]['fname']." ".$genealogy[11]['mname']." ".$genealogy[11]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[11]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[11]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                				?>	
                    							<?php if ($genealogy[11]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x11; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[11]['reg_code']; ?>" id= "network_thumb12"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x11; ?>" >
                                                 <?php echo ($genealogy[11]['reg_code']=="")?"Vacant":$genealogy[11]['fname']." ".$genealogy[11]['mname']." ".$genealogy[11]['lname'] ?> 
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                                                      <?php echo ($genealogy[11]['reg_code']=="")?"Vacant":$genealogy[11]['reg_code'] ?>
                                            	</a>
                                            	
                                        	</div>
            								<div class="col-xs-6 col-md-6">
            									<?php
				                			    $x12 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[12]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[12]['fname']." ".$genealogy[12]['mname']." ".$genealogy[12]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[12]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[12]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                				?>	
                    							<?php if ($genealogy[12]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x12; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[12]['reg_code']; ?>" id= "network_thumb13"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x12; ?>" >
                                                 <?php echo ($genealogy[12]['reg_code']=="")?"Vacant":$genealogy[12]['fname']." ".$genealogy[12]['mname']." ".$genealogy[12]['lname'] ?> 
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                        	
                                                      <?php echo ($genealogy[12]['reg_code']=="")?"Vacant":$genealogy[12]['reg_code'] ?>
                                            	</a>
                                            
                                        	</div>
                                    	</div>
            						</div>
            						<div class="col-xs-6 col-md-6">
            							<div class="row text-center">
            								<div class="col-xs-6 col-md-6">
            									<?php
				                			    $x13 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[13]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[13]['fname']." ".$genealogy[13]['mname']." ".$genealogy[13]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[13]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[13]['r_points']."</td>
				                                                </tr>
				                                            </table>";  
				                				?>	
                    							<?php if ($genealogy[13]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x13; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[13]['reg_code']; ?>" id= "network_thumb14"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x13; ?>" >
                                                 <?php echo ($genealogy[13]['reg_code']=="")?"Vacant":$genealogy[13]['fname']." ".$genealogy[13]['mname']." ".$genealogy[13]['lname'] ?> 
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
                        	
                                                      <?php echo ($genealogy[13]['reg_code']=="")?"Vacant":$genealogy[13]['reg_code'] ?>
                                            	</a>
                                            	
                                        	</div>
            								<div class="col-xs-6 col-md-6">
            									<?php
				                			    $x14 = "<table border='0'>
				                                                <tr>
				                                                    <td>Sponsor</td>
				                                                    <td>". $genealogy[14]['sponsor'] ."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Name</td>
				                                                    <td>".$genealogy[14]['fname']." ".$genealogy[14]['mname']." ".$genealogy[14]['lname']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Left Points</td>
				                                                    <td>".$genealogy[14]['l_points']."</td>
				                                                </tr>
				                                                <tr>
				                                                    <td>Right Points</td>
				                                                    <td>".$genealogy[14]['r_points']."</td>
				                                                </tr>
				                                 
				                                           </table>"; 
				                				?>	

                    							<?php if ($genealogy[14]['reg_code']==""){ ?>
                                                  <a href="#" id= "network_thumb" class="thumbnail network_thumb"  data-toggle="tooltip"  data-id="<?php echo $x14; ?>">
                                                      <img src="<?php echo BASE_URL() ?>assets/images/empty.png" alt="Newtworking" width="32" height="32"> 
                                                     <?php }else { ?>
                                                      <a href="<?php echo BASE_URL(); ?>Network/genealogy/<?php echo $genealogy[14]['reg_code']; ?>" id= "network_thumb15"class="thumbnail network_thumb" data-toggle="tooltip"  data-id="<?php echo $x14; ?>" >
                                                 <?php echo ($genealogy[14]['reg_code']=="")?"Vacant":$genealogy[14]['fname']." ".$genealogy[14]['mname']." ".$genealogy[14]['lname'] ?> 
                                                 <img src="<?php echo BASE_URL() ?>assets/images/network.png" alt="Newtworking" width="32" height="32">     
                                           <?php } ?>
						                        	
                                                      <?php echo ($genealogy[14]['reg_code']=="")?"Vacant":$genealogy[14]['reg_code'] ?>
                                            	</a>
                                            
                                        	</div>
                                    	</div>
            						</div>
            					</div>
            				</div>
            			</div>
            		</div>
            	</div>

            </div>  
        </div>
    </div><!-- contentpanel -->
</div><!-- mainpanel -->          