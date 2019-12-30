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
	<title>SOSCENTRE -  - SOMALI STUDIES CENTRE</title>

	<!-- favicon -->
	<link rel="shortcut icon" href="img/fav.png" type="image/x-icon">

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
	<!--Main Stylesheet-->
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<!-- Responsive Css -->
	<link rel="stylesheet" href="/assets/css/responsive.css">

</head>

<body class="body-class index details">
	<!--Start Preloader-->
	<div class="site-preloader">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
	<!--End Preloader-->

	<!-- web site Header(main-menu,topbar) area start  -->
	<header id="header" class="bg1">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-xl-3 d-flex align-self-center logo_area1">
					<div class="logo">
						<a href="/">
							<img class="img-fluid" src="/assets/images/favicon_white.png" alt="">
						</a>
					</div>
				</div>
				<div class="col-lg-12 col-xl-9">
					<div id="topbar_area">
						<div class="top-bar d-flex justify-content-between">
							<ul class="left">
								<li>
									<a href="/archive">
										<i class="fas fa-chart-pie"></i>
										Archive
									</a>
								</li>
								<li>
									<a href="/services">
										<i class="fas fa-newspaper"></i>
										Services
									</a>
								</li>
								<li>
									<a href="/forum">
										<i class="fas fa-clipboard-list"></i>
										Forum
									</a>
								</li>
							</ul>
							<ul class="right">
								<li>
									<a href="#">
										<i class="fab fa-dropbox"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fab fa-facebook-f"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fab fa-twitter"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fab fa-linkedin-in"></i>
									</a>
								</li>
								<li>
									<a href="#" data-toggle="modal" data-target=".bd-example-modal-sm">
										<i class="fas fa-search"></i>
									</a>
									<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
									 aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<form method="POST">
													<input type="text" class="mr-search" placeholder="Search">
													<button type="submit" class="submit">
														<i class="fas fa-search"></i>
													</button>
												</form>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- logo 2 hide on xl device-->
					<div class="logoarea2">
						<a href="index.html">
							<img src="/assets/images/favicon_white.png" alt="">
						</a>
					</div>
					<!-- logo 2 -->
					<div class="main_mamu">
						<nav class="navbar navbar-expand-lg navbar-light p-0">
							<a href="index.html" class="logo3">
								<img src="/assets/images/favicon_white.png" alt="">
							</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
							 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>

							<div class="collapse navbar-collapse" id="navbarSupportedContent">
									<ul class="navbar-nav mr-auto">
										<li class="nav-item">
											<a class="nav-link" href="/">Home</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="/aboutus">About Us</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="/profile/submission/new">New Submission</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="/documentations">For Authors</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="/blog">News</a>
										</li>
										<li class="nav-item dropdown">
											<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
											 aria-haspopup="true" aria-expanded="false">
												More
											</a>
											<div class="dropdown-menu" aria-labelledby="navbarDropdown">
												<a class="dropdown-item" href="/contactus">Contact us</a>
												<a class="dropdown-item" href="/issues/new">Report issue</a>
											</div>
										</li>
                                    </ul>
                                    @if(Auth::check())
                                    <a href="/profile" class="mr_btn_solid" target="_blank" ><i class="fa fa-user" ></i> Profile</a>
                                    @else
                                    <a href="/login" class="mr_btn_solid"><i class="fa fa-user" ></i> Sign In</a>
                                    @endif
                                
                                
								</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- web site Header(main-menu,topbar) area start  -->

	@yield('page-content')


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
							<h4>info@soscentre.org</h4>
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
	<!--Main-->
	<script src="/assets/js/custom.js"></script>

</body>

</html>