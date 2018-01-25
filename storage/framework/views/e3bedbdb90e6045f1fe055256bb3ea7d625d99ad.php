<html>
<head>
<meta name="viewport" content="width=device-width">
<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
</head>
<body style="padding:0;margin:0;font-family: 'Roboto', sans-serif !important;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
		<tbody>
			<tr>
			
				<td align="center" valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr>
								<!--<td align="center" valign="top" style="padding-top:0px;padding-left:20px;padding-right:20px">
									<table style="max-width:100%;" border="0" cellpadding="0" cellspacing="0" class="m_6020577058123972369m_1812917511877826244mobemailfullwidth" align="center" bgcolor="#d80003">-->
									<td align="center" valign="top" style="padding-left:20px;padding-right:20px;">
									<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" align="center">
										<tbody>
											<tr>
												<td style="padding:40px 0;" align="center">
													<img src="<?php echo e(asset('massengers/emailer_images/logo.png')); ?>" align="center" border="0" vspace="0" hspace="0" alt="">
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr>
								<td align="center" valign="top" style="padding-top:0px;padding-left:20px;padding-right:20px">
									<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td><img src="<?php echo e(asset('massengers/emailer_images/spacer2.png')); ?>" align="center" border="0" vspace="0" hspace="0" alt=""></td>
												<!-- <td style="height:50px;background-color:#d80003;text-align: center;display: block;"><img src="http://new.massengers.com/massengers/emailer_images/gola.png" align="center" border="0" vspace="0" hspace="0" alt=""></td> -->
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr> 
								<td align="center" valign="top" style="padding-left:20px;padding-right:20px;">
									<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td align="center" style="color:#4e4e4e;padding-top:0px;padding-bottom:0px;padding-left:40px;padding-right:40px;font-size:16px;">
													<h4 style="font-weight:400;font-family: 'Roboto', sans-serif;font-size:30px;color:#d80003;margin:0;margin-top:20px;">Hi <?php echo $order->customerName; ?></span></h4> 
													<h4 style="font-weight:400;font-family: 'Roboto', sans-serif;font-size:22px;color:#4e4e4e;margin:0;margin-top:10px;">Thank you for your order!<h4>												
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr> 
								<td align="center" valign="top" style="padding-left:20px;padding-right:20px;">
									<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td align="left" style="color:#4e4e4e;padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;font-size:16px;">
													<h4 style="font-weight:900;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;margin-top:20px;">Here's a summary of your purchase. When we ship the item, we will send an update with tracking details.</span></h4> 												
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr> 
								<td align="center" valign="top" style="padding-left:20px;padding-right:20px;">
									<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td align="left" style="color:#4e4e4e;padding-top:0px;border:2px solid #4e4e4e;border-left:none;border-right:none;padding-bottom:20px;padding-left:40px;padding-right:40px;font-size:16px;">
													<h4 style="font-weight:900;font-family: 'Roboto', sans-serif;font-size:16px;color:#fff;margin:0;margin-top:20px;"><span style="background-color:#d80003;padding:0 5px;">Order ID</span> : <span style="color:#d80003;padding:0 5px;"><?php echo $order->id; ?></span></h4> 												
												</td>
												<td align="left" style="color:#4e4e4e;padding-top:0px;border:2px solid #4e4e4e;border-left:none;border-right:none;padding-bottom:20px;padding-left:40px;padding-right:40px;font-size:16px;">
													<h4 style="font-weight:900;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;margin-top:20px;">Placed on : <?php echo Carbon\Carbon::parse($order->created_at)->format('D d-m-Y'); ?></span></h4> 												
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr> 
								<td align="center" valign="top" style="padding-left:20px;padding-right:20px;">
									<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td align="left" style="color:#4e4e4e;padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;font-size:16px;">
													<h4 style="font-weight:900;font-family: 'Roboto', sans-serif;font-size:20px;color:#4e4e4e;margin:0;margin-top:20px;"><span style="color:#d80003;">Delivery Address</h4> 												
												</td>
												<td align="left" style="color:#4e4e4e;padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;font-size:16px;">
													<h4 style="font-weight:900;font-family: 'Roboto', sans-serif;font-size:20px;color:#4e4e4e;margin:0;margin-top:20px;"><span style="color:#d80003;">Phone Number</span></h4> 												
												</td>
											</tr>
											<tr>
												<td align="left" style="color:#4e4e4e;padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;font-size:16px;">
													<h4 style="font-weight:400;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;"><?php echo $order->shippingName; ?></h4>
													<h4 style="font-weight:400;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;"><?php echo $order->shippingAddress; ?></h4>
													<h4 style="font-weight:400;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;"><?php echo $order->shippingCity; ?> - <?php echo $order->shippingPostCode; ?></h4>
													<h4 style="font-weight:400;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;"><?php echo $order->shippingState; ?>, India</h4>	
												</td>
												<td align="left" style="color:#4e4e4e;padding-top:0px;vertical-align:top;padding-bottom:20px;padding-left:40px;padding-right:40px;font-size:16px;">
													<h4 style="font-weight:400;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;">+91-<?php echo e($order->shippingPhone); ?></h4> 												
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr> 
								<td align="center" valign="top" style="padding-left:20px;padding-right:20px;">
									<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td align="left" colspan="2" style="color:#4e4e4e;padding-top:0px;padding-left:40px;padding-right:40px;font-size:16px;">
													<h4 style="font-weight:900;font-family: 'Roboto', sans-serif;font-size:20px;color:#4e4e4e;margin:0;margin-bottom:0px;"><span style="color:#d80003;">Payment Summary</h4> 												
												</td>
											</tr>
											<tr>
												<td align="left" style="color:#4e4e4e;padding-top:10px;padding-bottom:10px;padding-left:40px;padding-right:40px;font-size:16px;border-bottom: 1px solid #ccc;">
													<h4 style="font-weight:900;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;">Total Price</h4>
												</td>
												<td align="right" style="color:#4e4e4e;padding-top:10px;vertical-align:top;padding-bottom:10px;padding-left:40px;padding-right:40px;font-size:16px;border-bottom: 1px solid #ccc;">
													<h4 style="font-weight:900;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;">Rs. <?php echo $order->orderAmount; ?></h4> 												
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr>
								<td align="center" valign="top" style="padding-top:0px;padding-left:20px;padding-right:20px">
									<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td align="center" style="padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:20px;border-bottom:1px solid #ccc;"><a href="#" style="font-weight:400;font-family: 'Roboto', sans-serif;text-align:center;color:#d80003;text-decoration:none;border:2px solid #d80003;padding: 10px 20px;">Cancel Order</a></td>
												<td align="center" style="padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:20px;border-bottom:1px solid #ccc;"><a href="#" style="font-weight:400;font-family: 'Roboto', sans-serif;background-color:#d80003;text-align:center;color:#fff;text-decoration:none;padding: 10px 20px;">Track Order</a></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<!--<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr>
								<td align="center" valign="top" style="padding-top:0px;padding-left:20px;padding-right:20px">
									<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr> 
											 <td style="padding-left:40px;vertical-align:top;font-size:13px;line-height:18px;font-family: 'Roboto', sans-serif;"> 
											  <table style="width:95%;border-collapse:collapse"> 
											   <tbody>
												<tr> 
												 <td width="175" height="175" style="text-align:center;padding:16px 0 10px 0;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
													<a href="#" style="text-decoration:none;font-family: 'Roboto', sans-serif;" target="_blank"> <img src="https://kibakibi.com/emailer_images/Product.png" style="border:0" class="CToWUd" width="100%">
													</a>
												 </td> 
												 <td style="color:rgb(102,102,102);padding:10px;font-family: 'Roboto', sans-serif;">
													<h4 style="font-weight:900;font-family: 'Roboto', sans-serif;font-size:20px;color:#4e4e4e;margin:0;color:#d80003;">Safari Maroon Polyester 2 Wheel Troller</h4>
													<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
														<tbody>
															<tr>
																<td colspan="2"><h4 style="font-weight:900;padding:10px 0;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;"><img src="https://kibakibi.com/emailer_images/calendar.png" style="position:relative;top:10px;margin-right:20px;">Estimated Delivery</h4></td>
															</tr>
															<tr>
																<td><h4 style="font-weight:900;padding:10px 0;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;">Price</h4></td>
																<td><h4 style="font-weight:900;padding:10px 0;text-align:right;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;">Rs. 1599</h4></td>
															</tr>
															<tr>
																<td><h4 style="font-weight:900;padding:10px 0;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;">Delivery Charges</h4></td>
																<td><h4 style="font-weight:900;padding:10px 0;text-align:right;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;">Rs. 1599</h4></td>
															</tr>
															<tr>
																<td><h4 style="font-weight:900;padding:10px 0;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;">Quantity</h4></td>
																<td><h4 style="font-weight:900;padding:10px 0;text-align:right;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;">1</h4></td>
															</tr>
														</tbody>	
													</table>
												 </td> 
												</tr> 
											   </tbody>
											  </table> </td> 
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>-->
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr> 
								<td align="center" valign="top" style="padding-left:20px;padding-right:20px;">
									<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td align="center" style="color:#4e4e4e;padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;font-size:16px;">
													<h4 style="font-weight:900;font-family: 'Roboto', sans-serif;font-size:16px;color:#4e4e4e;margin:0;margin-top:20px;">We look forward to seeing you again soon. Team <span style="color:#d80003;">Massengers</span></h4> 												
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr> 
								<td align="center" valign="top" style="padding-left:20px;padding-right:20px;">
									<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
										<tbody>
											<tr>
												<td style="height:20px;background-color:#fff;"></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
						<tbody>
							<tr>
								<td align="center" valign="top" style="padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:20px;">
									<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" align="center">
										<tbody style="text-align:center">	
											<tr>
												<td>
												<a href="https://www.facebook.com/techturtle12/" style="padding:10px;"><img src="<?php echo e(asset('massengers/emailer_images/fb.png')); ?>"></a>
												<a href="https://twitter.com/techturtlein" style="padding:10px;"><img src="<?php echo e(asset('massengers/emailer_images/tw.png')); ?>"></a>
												<a href="https://plus.google.com/u/1/108896876946228247659" style="padding:10px;"><img src="<?php echo e(asset('massengers/emailer_images/g+.png')); ?>"></a>
												<a href="https://www.linkedin.com/company/techturtle" style="padding:10px;"><img src="<?php echo e(asset('massengers/emailer_images/link.png')); ?>"></a></td>	
											</tr>
											<tr>
												<td>
												<p style="margin:0; font-size:12px;margin:5px; color:#000;font-family: 'Roboto', sans-serif;">2017 Massengers.com | All Rights Reserved</p>
												<!-- <p style="margin:0; font-size:12px;margin:5px; color:#000;font-family: 'Roboto', sans-serif;">Ghaziabad 201014 (Uttar Pradesh), INDIA</p> -->
												</td>
											</tr>
											<tr>
												<td><a href="http://www.techturtle.in/contact-us/" style="padding:10px; color:#000; text-decoration:none; font-size:12px;font-family: sans-serif;">Contact Us</a> <a href="#" style="padding:10px; color:#000; text-decoration:none; font-size:12px;font-family: sans-serif;">Terms &amp; conditions</a> <a href="#" style="padding:10px; color:#000; text-decoration:none; font-size:12px;font-family: sans-serif;">Privacy Policy</a></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>	
		</tbody>
	</table>
</body>
</html>