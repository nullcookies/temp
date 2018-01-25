<?php $__env->startSection('content'); ?>

<div class="container-fluid pd-50">
	<div class="container dd">
		<ul class="cart-tab">
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
		</ul>
	</div>
</div>	
<div class="container-fluid pd-30">
	<div class="container cart">
		<h1>Payment Method</h1>
		<br/>
		<div class="cart-div2">
			<div class="col-md-3 col-sm-3">
				<ul class="nav nav-tabs nav-stacked payment-tabs">
					<li class="active"><a href="#credit" data-toggle="tab" >Credit Card</a></li>
					<li><a href="#debit" data-toggle="tab">Debit Card</a></li>
					<li><a href="#net-banking" data-toggle="tab">Net Banking</a></li>
					<li><a href="#wallet" data-toggle="tab">Wallet</a></li>
				</ul>
			</div>
			<div class="col-md-9 col-sm-9">
				<div class="tab-content pd-20">
					<div id="credit" class="tab-pane fade in active">
						<form>
							<div class="input-group col-md-6">
								<input type="text" class="form-control" placeholder="Credit Card Number" aria-describedby="basic-addon2">
							</div>
							<br/>
							<div class="input-group col-md-6">
								<input type="text" class="form-control" placeholder="Name on Card" aria-describedby="basic-addon2">
							</div>
							<br/>
							<div class="input-group col-md-6">
								<select class="payment-control col-md-2 mr-15">
									<option>MM</option>
									<option>01</option>
									<option>02</option>
									<option>03</option>
									<option>04</option>
									<option>05</option>
									<option>06</option>
									<option>07</option>
									<option>08</option>
									<option>09</option>
									<option>10</option>
									<option>11</option>
									<option>12</option>
								</select>
								<select class="payment-control col-md-2">
									<option>YY</option>
									<option>2017</option>
									<option>2018</option>
									<option>2019</option>
									<option>2020</option>
									<option>2021</option>
									<option>2022</option>
									<option>2023</option>
									<option>2024</option>
									<option>2025</option>
									<option>2026</option>
									<option>2027</option>
									<option>2028</option>
									<option>2029</option>
									<option>2030</option>
									<option>2031</option>
									<option>2032</option>
									<option>2033</option>
									<option>2034</option>
									<option>2035</option>
									<option>2036</option>
									<option>2037</option>
									<option>2038</option>
								</select>
								<input type="text" class="payment-control col-md-4 pull-right" maxlength="3" placeholder="CVV" aria-describedby="basic-addon2">
							</div>
						</form>
						<div class="col-md-6">
							<h3 class="center">Total Amount <span class="c-red"><i class="fa fa-inr"></i> 1899</span></h3>
						</div>
						<br/>
						<br/>
						<br/>
						<div class="col-md-6 center">
							<a href="<?php echo e(url('/checkout4')); ?>" class="pay-btn">Pay</a>
						</div>	
						<br/>
						<br/>
						<div class="col-md-6 center">
							<h5>International Card Holders, use PayPal</h5>
						</div>	
							
					</div>
					<div id="debit" class="tab-pane fade">
						<form>
							<div class="input-group col-md-6">
								<input type="text" class="form-control" placeholder="Debit Card Number" aria-describedby="basic-addon2">
							</div>
							<br/>
							<div class="input-group col-md-6">
								<input type="text" class="form-control" placeholder="Name on Card" aria-describedby="basic-addon2">
							</div>
							<br/>
							<div class="input-group col-md-6">
								<select class="payment-control col-md-2 mr-15">
									<option>MM</option>
									<option>01</option>
									<option>02</option>
									<option>03</option>
									<option>04</option>
									<option>05</option>
									<option>06</option>
									<option>07</option>
									<option>08</option>
									<option>09</option>
									<option>10</option>
									<option>11</option>
									<option>12</option>
								</select>
								<select class="payment-control col-md-2">
									<option>YY</option>
									<option>2017</option>
									<option>2018</option>
									<option>2019</option>
									<option>2020</option>
									<option>2021</option>
									<option>2022</option>
									<option>2023</option>
									<option>2024</option>
									<option>2025</option>
									<option>2026</option>
									<option>2027</option>
									<option>2028</option>
									<option>2029</option>
									<option>2030</option>
									<option>2031</option>
									<option>2032</option>
									<option>2033</option>
									<option>2034</option>
									<option>2035</option>
									<option>2036</option>
									<option>2037</option>
									<option>2038</option>
								</select>
								<input type="text" class="payment-control col-md-4 pull-right" maxlength="3" placeholder="CVV" aria-describedby="basic-addon2">
							</div>
						</form>
						<div class="col-md-6">
							<h3 class="center">Total Amount <span class="c-red"><i class="fa fa-inr"></i> 1899</span></h3>
						</div>
						<br/>
						<br/>
						<br/>
						<div class="col-md-6 center">
							<a href="#" class="pay-btn">Pay</a>
						</div>	
						<br/>
						<br/>
						<div class="col-md-6 center">
							<h5>International Card Holders, use PayPal</h5>
						</div>	
					</div>
					<div id="net-banking" class="tab-pane fade">
						<div class="col-md-6">
							<a href="#"><img src="img/sbi.png" class="mr-15" /></a>
							<a href="#"><img src="img/icici.png" class="mr-15"/></a>
							<a href="#"><img src="img/hdfc.png" class="mr-15"/></a>
							<a href="#"><img src="img/axis.png" class="mr-15"/></a>
							<br/><br/>
							<form>
								<select class="form-control">
									<option>State Bank of India</option>
									<option>United Bank of India</option>
								</select>
							</form>
							<br/>
							<br/>
								<div class="col-md-6 center">
									<a href="#" class="pay-btn">Pay</a>
								</div>
						</div>
					</div>
					<div id="wallet" class="tab-pane fade">
						<div class="col-md-6">
							<a href="#"><img src="img/paytm.png" class="mr-15" /></a>
							<a href="#"><img src="img/mobi.png" class="mr-15"/></a>
							<a href="#"><img src="img/fc.png" class="mr-15"/></a>
							<br/><br/>
							<form>
								<select class="form-control">
									<option>Paytm</option>
									<option>Mobikwik</option>
									<option>Freecharge</option>
								</select>
							</form>
							<br/>
							<br/>
								<div class="col-md-6 center">
									<a href="<?php echo e(url('/checkout4')); ?>" class="pay-btn">Pay</a>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid bg-black pd-30">
	<div class="container cart2">
		<div class="col-md-6">
			<h3><span class="c-red">Need Help?</span> Call us on 1234567891</h3>
		</div>
		<div class="col-md-6">
			<h3 class="pull-right"><span class="c-red">3.79 Lakh</span>  People trust us</h3>
		</div>
	</div>
</div>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>