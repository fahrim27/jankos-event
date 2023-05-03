<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
 <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Page Title -->
	<title>Jankos Event</title>
<!-- /Page title -->

<!-- Seo Tags -->
	<meta name="description" content="Your page description here" />
	<meta name="keywords" content="Your meta keywords, here"/>
	<meta name="robots" content="index, follow"> 
<!-- /Seo Tags -->

<!-- Favicon and Touch Icons
========================================================= -->
	<link rel="shortcut icon" href="{{ asset('eventer-landing/img/favicon2.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{ asset('eventer-landing/img/favicon2.ico')}}" type="image/x-icon">
<!-- /Favicon
========================================================= -->

<!-- >> CSS
============================================================================== -->
	<!-- Bootstrap styles -->
	<link href="{{ asset('eventer-landing/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- /Bootstrap Styles -->
	<!-- Google Web Fonts -->	
	<link href='https://fonts.googleapis.com/css?family=Hind:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<!-- /google web fonts -->
	<!-- owl carousel -->
	<link href="{{ asset('eventer-landing/vendor/owl.carousel/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
	<link href="{{ asset('eventer-landing/vendor/owl.carousel/owl-carousel/owl.theme.css')}}" rel="stylesheet">
	<!-- /owl carousel -->
	<!-- fancybox.css -->
	<link href="{{ asset('eventer-landing/vendor/fancybox/jquery.fancybox.css')}}" rel="stylesheet">
	<!-- /fancybox.css -->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('eventer-landing/vendor/font-awesome/css/font-awesome.min.css')}}">
	<!-- /Font Awesome -->
	<!-- Main Styles -->
	<link href="{{ asset('eventer-landing/css/styles.css')}}" rel="stylesheet">
	<!-- /Main Styles -->
<!-- >> /CSS
============================================================================== -->
</head>

<body>

<!-- Page Loader
========================================================= -->
<div class="loader-container" id="page-loader"> 
  <div class="loading-wrapper loading-wrapper-hide">
  	<div class="loader-animation" id="loader-animation">
  		<svg class="svg-loader" width=100 height=100>
		  <circle cx=50 cy=50 r=25 />
		</svg>
  	</div>    
    <!-- Edit With Your Name -->
    <div class="loader-name" id="loader-name">
      <img src="{{ asset('eventer-landing/img/loader-logo.png')}}" alt="">
    </div>
    <!-- /Edit With Your Name -->
    <!-- Edit With Your Job -->
    <p class="loader-job" id="loader-job">Tanggal Penyelenggaraan Jankos Event</p>
    <!-- /Edit With Your Job -->
  </div>   
</div>
<!-- /End of Page loader
========================================================= -->

<!-- Header
================================================== -->
<header id="header" class="">
	<div class="container">
		<!-- logo -->
		<div class="header-logo" id="header-logo">
			<img src="{{ asset('eventer-landing/img/logo.png')}}" alt=""/>
		</div>
		<!-- /logo -->
		<!-- MAIN MENU -->
	    <nav class="">
	      <ul class="hd-list-menu">
	        <li class="active"><a href="#main-carousel">Intro</a></li>
	        <li><a href="#section-event-infos">About </a></li>
	        <li><a target="_blank" href="{{ Storage::url('uploads/'.$guide->file) }}">Manual Book</a></li>
	        <li><a href="{{route('register')}}">Register</a></li>
	        <li><a href="{{route('login')}}">Login</a></li>
	      </ul> 
	    </nav>
	    <!-- /MAIN MENU -->
	</div>	
</header>
<!-- /Header
================================================== -->


<div class="page-wrapper">
	
	<div id="body-content">

		<!-- SECTION: Intro
		================================================== -->
		<div class="owl-carousel main-carousel" id="main-carousel">

			<!-- slide -->
			<div class="main-intro" style="background-image:url({{url('eventer-landing/img/bg7.jpg')}});">

				<div class="container">	
					<div class="intro-content-wrapper viewport">
						<!-- INTRO CONTENT -->
						<!-- Adjust the margin-top in style atribute according to content to keep always centered vertically-->
						<div class="intro-content intro-content-slide1">
							<!-- row -->
							<div class="row">
								<!-- col -->
								<div class="col-sm-12">
									<!-- event logo -->
									<div class="ic-logo">
										<img src="{{ asset('eventer-landing/img/intro-logo4.png')}}" alt="">
									</div>	
									<!-- /event logo -->
									<!-- Event Infos -->
									<div class="ic-infos">
										<p>Jankos Event</p>
									</div>
									<!-- /Event Infos -->								
									<!-- Register Form -->
									<div class="intro-register-form-text">
										<p>- Register now and participate on it! -</p>
									</div>	
									<form class="form" id="intro-register-form">
										<div class="ic-register">
										</div>
										<!-- Buttons -->
										<div class="ic-buttons">
											<a href="{{route('register')}}" class="fancybox btn"><i class="fa fa-paper-plane"></i> &nbsp; register now</a> 
											<a href="#" class="fancybox btn"><i class="fa fa-picture-o"></i> &nbsp;Upload Photo</a>
										</div>	
										<!-- /buttons -->
									</form>	
									<!-- /Register Form -->							
								</div>
								<!-- /col -->
							</div>
							<!-- /row -->						
															
						</div>	
						<!-- /INTRO CONTENT -->					
					</div>							
				</div>
			</div>
			<!-- /slide -->

			<!-- slide -->
			<div class="main-intro" style="background-image:url({{url('eventer-landing/img/bg4.jpg')}});">
				<div class="container">						
					<div class="intro-content-wrapper viewport">
						<!-- Main Title -->
						<!-- Adjust the margin-top in css according to content to keep always centered vertically-->
						<div class="intro-content countdown-wrapper intro-content-slide2">
							<p class="countdown-title">Remaining time for the event</p>
							<!-- countDown -->
							<div id="countdown" class="row"></div>
							<!-- /countDown -->			
							<p class="countdown-title2"> 
								<a href="{{route('register')}}" class="fancybox btn"><i class="fa fa-paper-plane"></i> &nbsp; register now</a> 
								<a href="#" class="fancybox btn"><i class="fa fa-picture-o"></i> &nbsp;Upload Photo</a>
								
							</p>
						</div>
						<!-- /Main Title -->
					</div>			
				</div>
			</div>
			<!-- /slide -->

			<!-- slide -->
			<div class="main-intro" style="background-image:url({{url('eventer-landing/img/bg3b.jpg')}});">
				<div class="container">						
					<div class="intro-content-wrapper viewport">
						<!-- Adjust the margin-top in css according to content to keep always centered vertically-->
						<div class="intro-content intro-content-slide3">
							<!-- row -->
							<div class="row">
								<!-- col -->
								<div class="col-md-10 col-md-offset-1">
									<img src="img/globe.png" alt="">
									<h1 class="intro-title1">The largest global<br/> Marketing Event</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu neque nulla. In vitae mollis neque. Sed scelerisque mollis metus. In dolor lectus, tincidunt congue porttitor vitae, consequat in eros. Phasellus dapibus eget libero et lobortis. Pellentesque tempus elit sed ultrices fringilla. Quisque feugiat eros lorem, vel egestas eros ultricies a.</p>
									<!-- Buttons -->
									<div class="ic-buttons">
										<a href="{{route('register')}}" class="fancybox btn"><i class="fa fa-paper-plane"></i> &nbsp; register now</a> 
										<a href="#" class="fancybox btn"><i class="fa fa-picture-o"></i> &nbsp;Upload Photo</a>
									</div>
									<!-- /Buttons -->
								</div>
								<!-- /col -->
							</div>
							
							<!-- /row -->						
						</div>
					</div>			
				</div>
			</div>
			<!-- /slide -->
		</div>		
		<!-- /SECTION: Intro
		================================================== -->

		<!-- SECTION: Event Infos
		================================================== -->
		<div class="section-event-infos inverted-section" id="section-event-infos">
			<div class="container-fluid">
				<div class="event-infos row">
					<!-- date -->
					<div class="event-info-col">
						<div class="event-info-ico"><span class="fa fa-calendar"></span></div>
						<h3 class="main-title3">Date:</h3>
						<p>June 4-8, 2023</p>
					</div>
					<!-- /date -->
					<!-- Time -->
					<div class="event-info-col">
						<div class="event-info-ico"><span class="fa fa-location-arrow"></span></div>
						<h3 class="main-title3">Location:</h3>
						<p>Cemengkalang, Sidoarjo, Jawa Timur</p>
					</div>
					<!-- /Time -->
					<!-- Time -->
					<div class="event-info-col">
						<div class="event-info-ico"><span class="fa fa-ticket"></span></div>
						<h3 class="main-title3">Main Contest</h3>
						<p><strong>Presenter - Videografi = Marketing</strong></p>
					</div>
					<!-- /Time -->
					<!-- Time -->
					<div class="event-info-col">
						<div class="event-info-ico"><span class="fa fa-microphone"></span></div>
						<h3 class="main-title3">Side Contest</h3>
						<p><strong>Photo Contest</strong></p>
					</div>
					<!-- /Time -->
				</div>
			</div>
		</div>			
		<!-- SECTION: /Event Infos
		================================================== -->	


		<!-- SECTION: Event Description
		================================================== -->
		<div class="section-about" id="section-about">
			<div class="container-fluid">
				<div class="row">
					<!-- Left Column -->
					<div class="about-picture-wrapper">
						<div class="about-picture" id="about-picture">
							<img src="{{asset('eventer-landing/img/conference-about.jpg')}}" alt="" class="responsive-image">
						</div>
					</div>				
					<!-- /Left Column -->
					<!-- Right Column -->
					<div class="about-text-wrapper"> 
						<div class="about-text" id="about-text">
							<h1 class="title3 title-border"><i class="fa fa-dot-circle-o"></i> About the contest</h1>
							<div class="about-text-content">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sodales varius sagittis. Proin a arcu vitae turpis congue facilisis. Quisque a lectus pretium, sagittis augue in, fringilla risus. Quisque elementum, ante a maximus commodo, dui metus imperdiet mi, sit amet tempor lectus erat ac orci. Mauris suscipit rhoncus lobortis. Quisque tincidunt nisi libero. Fusce nec turpis quis enim finibus porta. Donec eget sapien ac leo tempor elementum a at ante.</p>
							</div>							
						</div>
					</div>
					<!-- /Right Column -->
				</div>
			</div>
		</div>
		<!-- /SECTION: Event Description
		================================================== -->

		<!-- SECTION: Sponsors
		================================================== -->
		<div class="section-sponsors inverted-section2 section-padding " id="section-sponsors">
			<div class="container">
				<!-- Section title -->
				<div class="section-title-wrapper">
					<h2 class="title-section">Proudly sponsored by</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias esse cumque quae, perferendis neque voluptate recusandae, rem soluta quam error reiciendis consequuntur. Officia delectus quidem blanditiis eum incidunt temporibus nobis</p>
				</div>
				<!-- /Section title -->
				
				<div class="sponsors-list-wrapper">
					<div class="sponsors-list" id="sponsors-carousel">
						<!-- item -->
						<div class="sponsor-item">
							<img src="{{asset('eventer-landing/img/partner-1.png')}}" alt="">
						</div>
						<!-- /item -->
						<!-- item -->
						<div class="sponsor-item">
							<img src="{{asset('eventer-landing/img/partner-2.png')}}" alt="">
						</div>
						<!-- /item -->
						<!-- item -->
						<div class="sponsor-item">
							<img src="{{asset('eventer-landing/img/partner-3.png')}}" alt="">
						</div>
						<!-- /item -->
						<!-- item -->
						<div class="sponsor-item">
							<img src="{{asset('eventer-landing/img/partner-1.png')}}" alt="">
						</div>
						<!-- /item -->
						<!-- item -->
						<div class="sponsor-item">
							<img src="{{asset('eventer-landing/img/partner-2.png')}}" alt="">
						</div>
						<!-- /item -->
						<!-- item -->
						<div class="sponsor-item">
							<img src="{{asset('eventer-landing/img/partner-3.png')}}" alt="">
						</div>
						<!-- /item -->
					</div>
				</div>	
			</div>				
		</div>
		<!-- /SECTION: Sponsors
		================================================== -->

		<!-- SECTION: Location
		================================================== -->
		<div class="container-fluid">
			<div class="row">
				<div class="map" id="map">			
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3026.6617384330816!2d-73.9992296355825!3d40.65938630000002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25ae9ec6e2cb3%3A0x39c56782050e447a!2s27th+St%2C+Brooklyn%2C+NY+11232%2C+USA!5e0!3m2!1spt-BR!2sbr!4v1431959746282" height="350"></iframe>
				</div>
			</div>			
		</div>
		<!-- /SECTION: Location
		================================================== -->
	</div>
</div>

<!-- Contact Form - Ajax Messages
========================================================= -->
<!-- Form Sucess -->
<div class="form-result modal-wrap" id="contactSuccess">
  <div class="modal-bg"></div>
  <div class="modal-content">
    <h4 class="modal-title"><i class="fa fa-check-circle"></i> Success!</h4>
    <p>Your message has been sent to us.</p>
  </div>
</div>
<!-- /Form Sucess -->
<!-- form-error -->
<div class="form-result modal-wrap" id="contactError">
  <div class="modal-bg"></div>
  <div class="modal-content">
    <h4 class="modal-title"><i class="fa fa-times"></i> Error</h4>
    <p>There was an error sending your message.</p>
  </div>
</div>
<!-- /form-error -->
<!-- / Contact Form - Ajax Messages
========================================================= -->


<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68836633-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- / Google Analytics -->

<!-- Footer
================================================== -->
<footer id="footer" class="jumb-footer">
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-sm-6">
				"The power of imagination makes us infinite." <i>- fahrim27</i>
			</div>
			<!-- /col -->
			<!-- col -->
			<div class="col-sm-6 text-right">
				<!-- Social Icons -->
				<div class="footer-social-icons">
					<a href="#"><i class="fa fa-instagram"></i></a>
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-youtube"></i></a>
				</div>
				<!-- /Social Icons -->
			</div>
			<!-- /col -->
		</div>
		<!-- /row -->
	</div>	
</footer>
<!-- /Footer
================================================== -->

<!-- >> JS
============================================================================== -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('eventer-landing/vendor/jquery-1.11.3.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('eventer-landing/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Crossbrowser-->
<script src="{{ asset('eventer-landing/vendor/cross-browser.js')}}"></script>
<!-- /Crossbrowser-->
<!-- CountDown -->
<script src="{{ asset('eventer-landing/vendor/jquery.countdown.min.js')}}"></script>
<!-- /CountDown -->
<!-- Waypoints-->
<script src="{{ asset('eventer-landing/vendor/waypoints.min.js')}}"></script>
<!-- /Waypoints-->
<!-- Validate -->
<script src="{{ asset('eventer-landing/vendor/validate.js')}}"></script>
<!-- / Validate -->
<!-- Fancybox -->
<script src="{{ asset('eventer-landing/vendor/fancybox/jquery.fancybox.js')}}"></script>
<!-- /fancybox -->
<!-- Owl Caroulsel -->
<script src="{{ asset('eventer-landing/vendor/owl.carousel/owl-carousel/owl.carousel.js')}}"></script>
<!-- /Owl Caroulsel -->
<!-- Main JS -->
<script src="{{ asset('eventer-landing/js/main.js')}}"></script>
<!-- /Main JS -->

</body>
</html>