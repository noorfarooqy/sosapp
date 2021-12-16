<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="zxx">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<title>{{env('APP_NAME')}}</title>

	<!-- favicon -->
	<link rel="shortcut icon" href="/assets/images/DUMB-LOGO–7.png" type="image/x-icon">

	<!--Google Font-->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
	<!--Bootstrap Stylesheet-->
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<!--Owl Carousel Stylesheet-->
	<link rel="stylesheet" type="text/css" href="/assets/css/plugins/owl.theme.default.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/plugins/owl.carousel.min.css">
	<!--Slick Slider Stylesheet-->
	<link rel="stylesheet" type="text/css" href="/assets/css/plugins/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/plugins/slick.css">
	<!--Font Awesome Stylesheet-->
	<link rel="stylesheet" href="/assets/css/all.min.css">
	<!--Animate Stylesheet-->
	<link rel="stylesheet" type="text/css" href="/assets/css/plugins/animate.css">
	@yield('styles')
	<!--Main Stylesheet-->
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<!-- Responsive Css -->
	<link rel="stylesheet" href="/assets/css/responsive.css">
	<livewire:styles/>

</head>

<body class="body-class index details" style="font-family: "Times New Roman", Times, serif;">
	<!--Start Preloader-->
	<div class="site-preloader">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
	<!--End Preloader-->

	@include('includes.header')

	@yield('content')


	<!-- Footer Area Start -->
	<footer id="footer">
		<div class="container">
			<div class="row d-flex justify-content-end">
				<div class="col-md-6 col-xl-4">
					<div class="item d-flex">
						<div class="left">
							<i class="fas fa-phone"></i>
						</div>
						<div class="right">
							<p>Call Anytime</p>
							<h4>+86(186) 8593 1209</h4>
						</div>
					</div>
					<div class="item d-flex">
						<div class="left">
							<i class="fas fa-check-square"></i>
						</div>
						<div class="right">
							<p>Available Support</p>
							<h4>24/7 Support</h4>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xl-4">
					<div class="item d-flex">
						<div class="left">
							<i class="fas fa-envelope-open"></i>
						</div>
						<div class="right">
							<p>Get In Touch</p>
							<h4>info@dumb.co.ke</h4>
						</div>
					</div>
					<div class="item d-flex">
						<div class="left">
							<i class="fas fa-clock"></i>
						</div>
						<div class="right">
							<p>Get In Touch</p>
							<h4>8:00AM - 12:000PM</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Area End -->




	<!--Start ClickToTop-->
	<div class="totop">
		<a href="#top"><i class="fa fa-arrow-up"></i></a>
	</div>


	<!--End ClickToTop-->
	<!--End Body Wrap-->
	<!--jQuery JS-->
	<script src="/assets/js/jquery-1.12.4.min.js"></script>
	<!--Bootstrap JS-->
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/popper.min.js"></script>
	<!--Owl Carousel JS-->
	<script src="/assets/js/plugins/owl.carousel.min.js"></script>
	<!--Venobox JS-->
	<script src="/assets/js/plugins/venobox.min.js"></script>
	<!--Slick Slider JS-->
	<script src="/assets/js/plugins/slick.min.js"></script>
	@yield('scripts')
	<!--Main-->
	<script src="/assets/js/custom.js"></script>
	<livewire:scripts/>

</body>

</html>