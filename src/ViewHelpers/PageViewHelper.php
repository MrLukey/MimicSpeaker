<?php

namespace App\ViewHelpers;

class PageViewHelper
{
	public static function createHTMLForPageHead(): string
	{
		return '<meta charset="utf-8"/>
			    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
			          rel="stylesheet"
			          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
			          crossorigin="anonymous">
			    <link type="text/css" rel="stylesheet" href="css/mimicEditorStyles.css">
			    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
			    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
			            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
			            crossorigin="anonymous"></script>
			    <script src="js/mimicCreatorEventListenerFunctions.js"></script>
			    <script src="js/editButtonEventListenerFunctions.js"></script>
			    <script src="js/validationEventListenerFunctions.js"></script>
			    <script defer src="js/addAllEventListeners.js"></script>';
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
											<div class="text-center">' .
//												'<img src="" style="width: 185px;" alt="logo">' .
												'<h1 class="mt-1 mb-5 pb-1">Slim ToDo App</h1>
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
													<input type="submit" value="Log in" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">' .
//													'<a class="text-muted" href="#!">Forgot password?</a>' .
												'</div>
												<div class="d-flex align-items-center justify-content-center pb-4">
													<p class="mb-0 me-2">Dont have an account?</p>
													<a href="signup"><button type="button" class="btn btn-outline-danger">Create New</button></a>
												</div>
											</form>
										</div>
									</div>
									<div class="col-lg-6 d-flex align-items-center gradient-custom-2">
										<div class="text-white px-3 py-4 p-md-5 mx-md-4">
											<h4 class="mb-4">A PHP Monolith Application</h4>
												<p class="small mb-0">Built using the Slim framework, the frontend has been kept minimal,  most functionality being handled by the backend. What frontend exists is handled by Bootstrap.</p>
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
												'<h1 class="mt-1 mb-5 pb-1">Slim ToDo App</h1>
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
											<h4 class="mb-4">A PHP Monolith Application</h4>
												<p class="small mb-0">Built using the Slim framework, the frontend has been kept minimal,  most functionality being handled by the backend. What frontend exists is handled by Bootstrap.</p>
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