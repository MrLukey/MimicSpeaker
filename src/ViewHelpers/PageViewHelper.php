<?php

namespace App\ViewHelpers;

class PageViewHelper
{
	public static function createHTMLForPageHead(string $page): string
	{
		switch ($page){
			case 'homePage':
				$pageStyles =
					'<link type="text/css" rel="stylesheet" href="css/mimicEditorStyles.css">
					<link type="text/css" rel="stylesheet" href="css/homePageStyles.css">';
				$pageScripts =
					'<script defer src="js/addHomePageEventListeners.js"></script>';
				break;
			default:
				$pageStyles =
					'<link type="text/css" rel="stylesheet" href="css/loginSignupPageStyles.css">';
				$pageScripts = '';
//					'<script defer src="js/addHomePageEventListeners.js"></script>';
		}
		return
			'<meta charset="utf-8"/>
		    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
		          rel="stylesheet"
		          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
		          crossorigin="anonymous">' .
			$pageStyles .
			'<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
		    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
		            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
		            crossorigin="anonymous"></script>
            <script src="js/pageEventListenerFunctions.js"></script>
		    <script src="js/mimicCreatorEventListenerFunctions.js"></script>
		    <script src="js/editButtonEventListenerFunctions.js"></script>
		    <script src="js/validationEventListenerFunctions.js"></script>'
			. $pageScripts;
	}

	public static function createHTMLForNavbar(string $page): string
	{
		switch ($page){
			case 'homepage':
				if ($_SESSION['loggedIn']){
					$loginLogoutSignupButton = '<a class="nav-link" href="/logout">Logout</a>';;
				} else {
					$loginLogoutSignupButton = '<a class="nav-link" href="/login">Login</a>';
				}
				break;
			case 'loginPage':
				$loginLogoutSignupButton = '<a class="nav-link" href="/signup">Sign Up</a>';
				break;
			case 'signUpPage':
				$loginLogoutSignupButton = '<a class="nav-link" href="/login">Login</a>';
				break;
			default:
				$loginLogoutSignupButton = '';
		}
		if ($_SESSION['user']->getUserName() === 'Guest'){
			$username = '';
		} else {
			$username = $_SESSION['user']->getUserName() . '\'s ';
		}
		return
			'<nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Mimic Speaker Navbar">
				<div class="container-fluid">
					<a class="navbar-brand" href="/">' . $username. 'Mimic Speaker</a>
					<button class="navbar-toggler" 
						type="button" 
						data-bs-toggle="collapse" 
						data-bs-target="#mimicNav" 
						aria-controls="mimicNav" 
						aria-expanded="false" 
						aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="mimicNav">
						<ul class="navbar-nav me-auto mb-2 mb-sm-0">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navDropDown" data-bs-toggle="dropdown" aria-expanded="false">Mimics</a>
								<ul class="dropdown-menu" aria-labelledby="navDropDown">
									<li><a class="dropdown-item" href="#">Highest Rated</a></li>
									<li><a class="dropdown-item" href="#">Most Recent</a></li>
									<li><a class="dropdown-item" href="#">Least Edited</a></li>
								</ul>
							</li>
							<a class="nav-link" href="#">About</a>
						</ul>
						<div class="navbar-nav">' .
							$loginLogoutSignupButton .
						'</div>
					</div>
				</div>
			</nav>';
	}

	// currently broken, carousel height will not extend beyond a small amount without breaking
	public static function createHTMLForMimicCarousel(): string
	{
		return
			'<div id="mostPopularMimicsCarousel" class="carousel slide" data-bs-ride="carousel">
				<div class="carousel-indicators">
					<button type="button" data-bs-target="#mostPopularMimicsCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
					<button type="button" data-bs-target="#mostPopularMimicsCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
					<button type="button" data-bs-target="#mostPopularMimicsCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
				</div>
				<div class="carousel-inner">
					<div class="carousel-item">
						<svg class="bd-placeholder-img" width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
							<rect width="100%" height="100%" fill="#777"></rect>
						</svg>
						<div class="container">
							<h1>TESTESTEST</h1>
							<div class="carousel-caption text-start">
								<h2 class="m-2">Example headline.</h2>
								<h1 class="m-2">Example headline.</h1>
								<h1 class="m-2">Example headline.</h1>
								<h1 class="m-2">Example headline.</h1>
								<p>Some representative placeholder content for the first slide of the carousel.</p>
								<p>Some representative placeholder content for the first slide of the carousel.</p>
								<p>Some representative placeholder content for the first slide of the carousel.</p>
								<p>Some representative placeholder content for the first slide of the carousel.</p>
								<p>Some representative placeholder content for the first slide of the carousel.</p>
								<p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
							</div>
						</div>
					</div>
					<div class="carousel-item active">
						<svg class="bd-placeholder-img" width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
							<rect width="100%" height="100%" fill="#777"></rect>
						</svg>
						<div class="container">
							<div class="carousel-caption">
								<h1>Another example headline.</h1>
								<p>Some representative placeholder content for the second slide of the carousel.</p>
								<p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<svg class="bd-placeholder-img" width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></svg>
						<div class="container">
							<div class="carousel-caption text-end">
								<h1>One more for good measure.</h1>
								<p>Some representative placeholder content for the third slide of this carousel.</p>
								<p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
							</div>
						</div>
					</div>
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#mostPopularMimicsCarousel" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#mostPopularMimicsCarousel" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>';
	}

	public static function createHTMLForLoginPage(): string
	{
		if($_SESSION['error'])
		{
			$error = $_SESSION['errorMessage'];
			$warningText = 'black';
		}
		else {
			$error = 'HELLO WORLD';
			$warningText = 'white';
		}
		return
			'<section class="h-100 gradient-form" style="background-color: #eee;">
				<div class="container py-5 h-100">
					<div class="row d-flex justify-content-center align-items-center h-100">
						<div class="col-xl-10">
							<div class="card rounded-3 text-black">
								<div class="row g-0">
									<div class="col-lg-6">
										<div class="card-body p-md-5 mx-md-4">
											<div class="text-center">
												<h2 class="text-nowrap text-center mt-1 mb-5 pb-1">Mimic Speaker</h2>
											</div>
											<form method="post" action="login">
												<div class="form-outline mb-4">
													<input type="text" maxlength="30" name="username" class="form-control" placeholder="Username" required/>
												</div>
												<div class="form-outline mb-4">
													<input type="password" minlength="8" maxlength="255" name="rawPassword" class="form-control" placeholder="Password" required/>
												</div>
												<div class="text-center pt-1 mb-5 pb-1">' .
													'<p class="warning text-' . $warningText . '">' . $error . ' </p>
													<input type="submit" value="Log in" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
												</div>
												<div class="d-flex align-items-center justify-content-center pb-4">
													<p class="mb-0 me-2">Dont have an account?</p>
													<a href="signup"><button type="button" class="btn btn-outline-danger">Create New</button></a>
												</div>
											</form>
										</div>
									</div>
									<div class="col-lg-6 d-flex align-items-center gradient-custom-2">
										<div class="text-white px-3 py-4 p-md-5 mx-md-4">
											<h4 class="mb-4 text-nowrap">The Best Spamming App Around</h4>
												<p class="small mb-0">Mimic Speaker aims to provide a one stop shop for all your spamming needs, whether they be professional, personal, or both.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>';
	}

	public static function createHTMLForSignUpPage(): string
	{
		if($_SESSION['error'])
		{
			$error = $_SESSION['errorMessage'];
			$warningText = 'black';
		}
		else {
			$error = 'PLACEHOLDER';
			$warningText = 'white';
		}
		return
			'<section class="h-100 gradient-form" style="background-color: #eee;">
				<div class="container py-5 h-100">
					<div class="row d-flex justify-content-center align-items-center h-100">
						<div class="col-xl-10">
							<div class="card rounded-3 text-black">
								<div class="row g-0">
									<div class="col-lg-6">
										<div class="card-body p-md-5 mx-md-4">
											<div class="text-center">' .
//												'<img src="" style="width: 185px;" alt="logo">' .
												'<h1 class="mt-1 mb-5 pb-1">Mimic Speaker</h1>
											</div>
											<form method="post" action="signup" class="needs-validation">
												<div class="form-outline mb-4">
													<input type="text" maxlength="30" name="username" id="username" class="form-control" placeholder="Username" required/>
												</div>
												<div class="form-outline mb-4">
													<input type="email" maxlength="255" name="email" class="form-control" placeholder="Email" required/>
												</div>
												<div class="form-outline mb-4">
													<input type="password" minlength="8" maxlength="255" name="rawPassword" class="form-control" placeholder="Password" required/>
												</div>
												<div class="form-outline mb-4">
													<input type="password" minlength="8" maxlength="255" name="repeatedRawPassword" class="form-control" placeholder="Retype password" required/>
												</div>
												<div class="text-center pt-1 mb-5 pb-1">' .
													'<p class="warning text-' . $warningText . '">' . $error . ' </p>
													<input type="submit" value="Sign up" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">' .
//													'<a class="text-muted" href="#!">Forgot password?</a>' .
												'</div>
												<div class="d-flex align-items-center justify-content-center pb-4">
													<p class="mb-0 me-2">Already have an account?</p>
													<a href="login"><button type="button" class="btn btn-outline-danger">Login</button></a>
												</div>
											</form>
										</div>
									</div>
									<div class="col-lg-6 d-flex align-items-center gradient-custom-2">
										<div class="text-white px-3 py-4 p-md-5 mx-md-4">
											<h4 class="mb-4 text-nowrap">The Best Spamming App Around</h4>
												<p class="small mb-0">Mimic Speaker aims to provide a one stop shop for all your spamming needs, whether they be professional, personal, or both.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>';
	}
}