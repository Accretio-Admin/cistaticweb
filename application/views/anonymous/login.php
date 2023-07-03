

<div class="container" id="main">
	<div class="row">

    	<div class="col-md-12">
    		<div class="row">
                <hr />
                <div class="col-md-4">
                </div>   
                <div class="col-md-4 well">
                <h2>Login</h2>
    		    <?php echo form_open('user/login_attempt');?>
    		      <div class="form-group">
                        <?php echo validation_errors();?>
    		        <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo set_value('username');?>" required>
    		      </div>
    		      <div class="form-group">
    		        <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo set_value('password');?>" required>
    		      </div>
    		      <!--
    		      <div id="mc-form" style="border-collapse:collapse;">
    				<div id="mc">
    					<p>Please draw the shape in the box to submit the form: (<a onClick="window.location.reload()" href="#" title="Click for a new shape">new shape</a>)</p>
    					<canvas id="mc-canvas">
    						Your browser doesn't support the canvas element - please visit in a modern browser.
    					</canvas>
    				</div>
    				<input class="btn btn-primary" disabled="disabled" autocomplete="false" type="submit" value="Sign In"/>
    			  </div> 
                  -->
                  <input class="btn btn-primary"  autocomplete="false" type="submit" value="Sign In"/>

    		
    		    <?php echo form_close();?>
                </div>
                <div class="col-md-4">
                </div>
                    
                
    		</div>
    	</div><!-- .col-md-12 -->

    </div><!-- .row -->
</div><!-- .container -->
