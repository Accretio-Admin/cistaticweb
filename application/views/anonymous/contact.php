<hr class="padding-bottom-small" />

<iframe id="googlemaps-page-top" width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d7720.501932048901!2d121.03184375907206!3d14.641690335369946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sunified+products+and+services!5e0!3m2!1sen!2sph!4v1401362489247"></iframe>

<div class="container" id="main">

	<h3 class="hr2">We would love to hear from you</h3>	
	<div class="row">	
		<div class="col-sm-6">
			<p class="lead">
				Our qualified support is waiting for you, literally. Ask us anything you want. We will get back to you within 24h, seven days a week.</strong>
			</p>
			<form name="contactform" id="contactform" class="margin-bottom-large" method="post" action="<?php echo base_url()?>Unified/contact" id="transaction_form">		
				<?php if ($output['S'] == 1): ?>
					<div class="alert alert-success">
						<?php echo $output['M'] ?>
					</div>
				<?php elseif ($output['S'] == 2): ?>
					<div class="alert alert-danger">
						<?php echo $output['M'] ?>
					</div>
				<?php endif ?>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="name">Name</label>
						<input type="text" name="name" id="name" placeholder="Full Name" class="form-control" required/>
					</div>
					<div class="form-group col-md-6">
						<label for="email">Email <span class="text-warning">*</span></label>
						<input type="text" name="email" id="email" placeholder="Active email address" class="form-control" required/>
					</div>
				</div>
                <div class="row">
					<div class="form-group col-md-6">
                        <label for="number">Contact Number</label>
                        <input type="text" name="mobile" id="number" class="form-control" maxlength="11" placeholder="11-digit number" required/>
					</div>
					<div class="form-group col-md-6">
					   <label for="subject">Subject</label>
					   <input type="text" name="subject" id="subject" class="form-control" placeholder=""required/>
					</div>
                </div>
				<div class="form-group">
					<label for="message">Message <span class="text-warning">*</span></label>
					<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Message..." required></textarea>
				</div>
				<div class="margin-top-base">
                    <button type="submit" class="btn btn-primary" name="submit_contact_form">Send</button>	
				</div>
				
			</form>
		</div>	
		<!-- update by nhez 03/21/2017 -->
		<div class="col-sm-5 col-sm-offset-1 contactinfo">
			<h5 class="hr2 margin-top-small margin-bottom-small text-muted"><i class="icon-time"></i>Customer Support Contact Numbers</h5>
			<address>
				<i class="fa fa-map-marker"></i> JR Bldg. 1520 Quezon Ave., South Triangle, Quezon City<br />
				<i class="fa fa-envelope"></i> support.upsexpress.com.ph<br />
                <i class="fa fa-mobile-phone"></i> <span class="color">Smart:</span> 0908-444-2728<br />
                <i class="fa fa-mobile-phone"></i> <span class="color">Globe:</span> 0917-783-1922<br />
                <i class="fa fa-mobile-phone"></i> <span class="color">Sun:</span> 0933-995-2860<br />
			</address>
            <h5 class="hr2 margin-top-small margin-bottom-small text-muted"><i class="icon-time"></i> Corporate Office</h5>
			<address>
				
				<i class="fa fa-building"></i> <span class="color">Office hours:</span> Mondays to Sundays / 10:00am - 9:00pm<br />
				<i class="fa fa-map-marker"></i> JR Bldg. 1520 Quezon Ave., South Triangle, Quezon City<br />
				<i class="fa fa-envelope"></i> mail@upsglobal.net<br />
				<i class="fa fa-phone"></i> <span class="color">Landline:</span> 373-1215<br />
                <i class="fa fa-mobile-phone"></i> <span class="color">Smart:</span> 0929-777-6855<br />
                <i class="fa fa-mobile-phone"></i> <span class="color">Globe:</span> 0926-672-2072<br />
                <i class="fa fa-mobile-phone"></i> <span class="color">Sun:</span> 0942-460-5544 / 0923-477-0191<br />
                

			</address>
			<h5 class="hr2 margin-top-small margin-bottom-small text-muted"><i class="icon-time"></i> Cebu Office</h5>
            <address>
            	<i class="fa fa-building"></i> <span class="color">Office hours:</span> Mondays to Sundays 10:00am - 9:00pm<br />
                <i class="fa fa-map-marker"></i> Ground flr Rafael Yu Building, Gen. Maxilom Ave, Cebu City, Philippines<br />
                <i class="fa fa-envelope"></i> mail@upsglobal.net<br />
                <i class="fa fa-phone"></i> <span class="color">Landline:</span> (032) 254-0090<br />
                <i class="fa fa-mobile-phone"></i> <span class="color">Cellphone:</span> 0923-133-6322<br />
            </address><!--
			<h5 class="hr2 margin-top-small margin-bottom-small text-muted"><i class="icon-time"></i> Davao Office</h5>
            <address>
                <i class="fa fa-map-marker"></i> HRTV Corp. Building, Bolton St., Brgy. 3, Davao City, Philippiness<br />
                <i class="fa fa-envelope"></i> mail@upsglobal.net<br />
                <i class="fa fa-phone"></i> <span class="color">Landline:</span> (082) 222-3644<br />
                <i class="fa fa-mobile-phone"></i> <span class="color">Cellphone:</span> 0919-819-0224<br />
            </address> -->

            <h5 class="hr2 margin-top-small margin-bottom-small text-muted"><i class="icon-time"></i>Davao Office</h5>
            <address>
            	<i class="fa fa-building"></i> <span class="color">Office hours:</span> Mondays to Sundays 10:00am - 9:00pm<br />
                <i class="fa fa-map-marker"></i> HRTV Corp. Building, Bolton St., Brgy. 3, Davao City<br />
                <i class="fa fa-envelope"></i> mail@upsglobal.net<br />
                <i class="fa fa-phone"></i> <span class="color">Landline:</span> (082) 222 3644<br />
                <i class="fa fa-mobile-phone"></i> <span class="color">Globe:</span> 0916-453-9749<br />
                <i class="fa fa-mobile-phone"></i> <span class="color">Smart:</span> 0948-342-8095<br />
            </address>

		
		</div>		
	</div>

</div><!-- .container -->