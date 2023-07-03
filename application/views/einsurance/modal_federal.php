<style>
label{
	font-size: smaller;
}
</style>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<img style="width: auto !important; padding: 5px !important;" class="company-logo text-center"  src="<?php echo BASE_URL()?>assets/images/FPG New Logo with Member 2015.png" alt="">
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<h5><b>INSURED INFORMATION</b></h5>
						<div class="form-group row">
							<label for="firstName" class="col-sm-3 col-form-label">First Name</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_firstName" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="middleName" class="col-sm-3 col-form-label">Middle Name</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_middleName" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="lastName" class="col-sm-3 col-form-label">Last Name</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_lastName" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="birthdate" class="col-sm-3 col-form-label">Birth Date</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_birthdate" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="occupation" class="col-sm-3 col-form-label">Occupation</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_occupation" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_email" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="number" class="col-sm-3 col-form-label">Contact No.</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_number" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="address" class="col-sm-3 col-form-label">Address</label>
							<div class="col-sm-9">
								<textarea type="text" readonly class="form-control" id="m_address" value=""></textarea>
							</div>
						</div>
						<h5><b>BENEFICIARY INFORMATION</b></h5>
						<div class="form-group row">
							<label for="bfirstName" class="col-sm-3 col-form-label">First Name</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_bfirstName" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="bmiddleName" class="col-sm-3 col-form-label">Middle Name</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_bmiddleName" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="blastName" class="col-sm-3 col-form-label">Last Name</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_blastName" value="">
							</div>
						</div>
						<div id="vouch_container" class="form-group row ">
							<hr>
							<label for="vcode" class="col-sm-3 col-form-label">Voucher Code</label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="m_vcode" value="">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="" id="m_federalNote" style="display: none;">
						<h5><b>&nbsp</b></h5>
							<div class="form-group">
								
								<table class='table table-condensed table-borderless'>
									<thead>
										<th bgcolor="black">COVERAGE</th>
										<th bgcolor="black">LIMITS</th>
									</thead>
									<tbody>
										<tr>
										<td>ACCIDENTAL DEATH AND DISABLEMENT</td>
										<td id="m_note10" nowrap></td>
										</tr>

										<tr>
										<td>MOTORCYCLING</td>
										<td id="m_note20" nowrap></td>
										</tr>

										<tr>
										<td>ACCIDENTAL BURIAL BENEFIT</td>
										<td id="m_note30" nowrap></td>
										</tr>

										<tr>
										<td>FIRE CASH ASSISTANCE</td>
										<td id="m_note40"></td>
										</tr>

										<tr>
										<td>SELLING PRICE</td>
										<td id="m_selling_price" nowrap></td>
										</tr>
										<tr>
										<td>DISCOUNT</td>
										<td id="m_discount" nowrap></td>
										</tr>
										<tr>
										<td>AMOUNT DUE</td>
										<td id="m_amount_due" nowrap></td>
										</tr>
									</tbody>
								</table> 
								<p style="margin: 0px; font-weight: bold; color: red;">NOTE:</p>
                                <p style="margin: 0px;">Please check the details before you confirm.</p>
                                <p>Once confirmed it will not be amended.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-sm btnConfirm">CONFIRM</button>
			</div>
		</div>
	</div>
</div>