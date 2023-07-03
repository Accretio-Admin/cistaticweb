<!DOCTYPE html>
<html lang="en">
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>

	<style type="text/css">
		.copy{
			width: 100%;
			height: auto;
			padding: 10px;
			border: 1px solid;
			background-image: url("assets/images/upswatermark.png");
			background-repeat: repeat;	
		}
		.data{
			border-collapse:collapse;
			margin: auto;
		}

		.data td:nth-child(2){
			padding-right: 100px;
		}

		html, body {
		    margin: 5px;
		    padding: 0;
		}
	</style>
	
	<body>
		<div class="copy">
			<div style="width:100%;">
				<table style="width:auto; height:auto; margin:0 auto;">
					<tr>
						<td>
							<img src="'.base_url().'assets/images/upslogo.png" height="67" width="67">
						</td>
						<td>
							<b>
								Unified Products and Services, Inc. 
							</b>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="font-size:12px; text-align:center;">MLM TRANSACTION'S RECEIPT</td>
					</tr>
				</table>
			</div>
			<b style="font-size:12px; font-style:italic;">MLM's Copy</b>
			<hr>
			<div style="margin:0 auto;">
				<h4>Tracking No: <?php echo $TRACKING_NO; ?></h4>
				<table class="data" border="1">
					<thead>
						<tr>
							<th>Product code</th>
							<th>Product</th>
							<th>Quantity Product</th>
							<th>Price</th>
						</tr>
					</thead>
					<?php foreach ($info as $val) { ?>
						<tbody>
							<tr>
								<td><?php echo $val->prod_code; ?></td>
								<td><?php echo $val->product; ?></td>
								<td><?php echo $val->quantity_product; ?></td>
								<td><?php echo $val->price; ?></td>
							</tr>
						</tbody>
						
						<!-- <tr>
							<td>Product code:</td>
							<td><?php echo $val->prod_code; ?></td>
						</tr>

						<tr>
							<td>Product:</td>
							<td><?php echo $val->product; ?></td>
						</tr>

						<tr>
							<td>Quantity Product:</td>
							<td><?php echo $val->quantity_product; ?></td>
						</tr>
						<tr>
							<td>Price:</td>
							<td><?php echo $val->price; ?></td>
						</tr> -->
					<?php } ?>
				</table>
			</div>
			<hr>
			<table>
				<tr>
					<td style="font-size:13px;"><b>Transaction date:</b>
					<?php echo $T_DATE; ?></td>
				</tr>
				<tr>
					<td style="font-size:13px;">IMPORTANT: This will serve as your proof of payment.</td>
				</tr>
			</table>
			<br>
			<table style="width:100%; height:auto; text-align:left; font-size:13px;">
				<tr>
					<td style="width:50%;">Authorized Signature:</td>
					<td style="width:50%;">Processed By:</td>
				</tr>
			</table>
			<br>
			<table style="width:100%; height:auto; text-align:center; font-size:13px;">
				<tr>
					<td style="width:50%;"><hr></td>
					<td style="width:50%;"><hr></td>
				</tr>
				<tr>
					<td style="width:50%;"><i>Customer's Signature over printed name</i></td>
					<td style="width:50%;"><i>Employee's Signature over printed name</i></td>
				</tr>
			</table>
		</div>

		<br>
		<hr>
		<br>

		<div class="copy">
			<div style="width:100%;">
				<table style="width:auto; height:auto; margin:0 auto;">
					<tr>
						<td>
							<img src="'.base_url().'assets/images/upslogo.png" height="67" width="67">';
						</td>
						<td>
							<b>
								Unified Products and Services, Inc.
							</b>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="font-size:12px; text-align:center;">MLM TRANSACTION'S RECEIPT</td>
					</tr>
				</table>
			</div>
			<b style="font-size:12px; font-style:italic;">Customer's Copy</b>
			<hr>
			<div style="margin:0 auto;">
				<h4>Tracking No: <?php echo $TRACKING_NO; ?></h4>
				<table class="data" border="1">
					<thead>
						<tr>
							<th>Product code</th>
							<th>Product</th>
							<th>Quantity Product</th>
							<th>Price</th>
						</tr>
					</thead>
				<?php foreach ($info as $val) { ?>
					<tbody>
						<tr>
							<td><?php echo $val->prod_code; ?></td>
							<td><?php echo $val->product; ?></td>
							<td><?php echo $val->quantity_product; ?></td>
							<td><?php echo $val->price; ?></td>
						</tr>
					</tbody>
					
					<!-- <tr>
						<td>Product code:</td>
						<td><?php echo $val->prod_code; ?></td>
					</tr>

					<tr>
						<td>Product:</td>
						<td><?php echo $val->product; ?></td>
					</tr>

					<tr>
						<td>Quantity Product:</td>
						<td><?php echo $val->quantity_product; ?></td>
					</tr>
					<tr>
						<td>Price:</td>
						<td><?php echo $val->price; ?></td>
					</tr> -->
				<?php } ?>
				</table>
			</div>
			<hr>
			<table>
				<tr>
					<td style="font-size:13px;"><b>Transaction date:</b>
					<?php echo $T_DATE; ?></td>
				</tr>
				<tr>
					<td style="font-size:13px;">IMPORTANT: This will serve as your proof of payment.</td>
				</tr>
			</table>
			<br>
			<table style="width:100%; height:auto; text-align:left; font-size:13px;">
				<tr>
					<td style="width:50%;">Authorized Signature:</td>
					<td style="width:50%;">Processed By:</td>
				</tr>
			</table>
			<br>
			<table style="width:100%; height:auto; text-align:center; font-size:13px;">
				<tr>
					<td style="width:50%;"><hr></td>
					<td style="width:50%;"><hr></td>
				</tr>
				<tr>
					<td style="width:50%;"><i>Customer's Signature over printed name</i></td>
					<td style="width:50%;"><i>Employee's Signature over printed name</i></td>
				</tr>
			</table>
		</div>
	</body>
</html>