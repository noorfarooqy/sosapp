<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title> @yield('title') - {{env('APP_NAME')}} </title>
	<!--favicon-->
	<link rel="icon" href="/admin/assets//images/DUMB-LOGO–7.png" type="image/png" />
	<!-- loader-->
	<link href="/admin/assets//css/pace.min.css" rel="stylesheet" />
	<script src="/admin/assets//js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/admin/assets//css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="/admin/assets//css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="/admin/assets//css/app.css" />
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top border-bottom">
			<a class="navbar-brand" href="/">
				<img src="/assets/images/DUMB-LOGO–9.png" width="160" alt="">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">	<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">	<a class="nav-link" href="/">Home</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="error-404 d-flex align-items-center justify-content-center">
			<div class="container">
				@yield('content')
			</div>
		</div>
		<div class="bg-white p-4 fixed-bottom border-top">
			<div class="d-flex align-items-center justify-content-between flex-wrap">
				<ul class="list-inline mb-0">
					<li class="list-inline-item">Follow Us :</li>
					<li class="list-inline-item"><a href="javascript:;"><i class='bx bxl-facebook mr-1'></i>Facebook</a>
					</li>
					<li class="list-inline-item"><a href="javascript:;"><i class='bx bxl-twitter mr-1'></i>Twitter</a>
					</li>
					<li class="list-inline-item"><a href="javascript:;"><i class='bx bxl-google mr-1'></i>Google</a>
					</li>
				</ul>
				<p class="mb-0"> DUMB {{gmdate('@Y', time())}} | Product of : <a href="https://drongo.co.ke" target="_blank">Drongo Technology</a>
				</p>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
	<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="/admin/assets//js/jquery.min.js"></script>
	<script src="/admin/assets//js/popper.min.js"></script>
	<script src="/admin/assets//js/bootstrap.min.js"></script>
</body>

</html>