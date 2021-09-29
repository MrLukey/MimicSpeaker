<?php

namespace App\ViewHelpers;

class PageViewHelper
{
	public static function createHTMLForLoginPage(): string
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
											<form method="post" action="login">
												<div class="form-outline mb-4">
													<input type="text" name="userName" class="form-control" placeholder="Username"/>
												</div>
												<div class="form-outline mb-4">
													<input type="password" name="rawPassword" class="form-control" placeholder="Password"/>
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
		return
			'<section class="h-100" style="background-color: #eee;">
				<div class="container py-5 h-100">
					<div class="row d-flex justify-content-center align-items-center h-100">
						<div class="col-lg-12 col-xl-11">
							<div class="card text-black" style="border-radius: 25px;">
								<div class="card-body p-md-5">
									<div class="row justify-content-center">
										<div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
											<p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
											<form class="mx-1 mx-md-4">
												<div class="d-flex flex-row align-items-center mb-4">
													<i class="fas fa-user fa-lg me-3 fa-fw"></i>
													<div class="form-outline flex-fill mb-0">
														<input type="text" id="form3Example1c" class="form-control" />
														<label class="form-label" for="form3Example1c">Your Name</label>
													</div>
												</div>
												<div class="d-flex flex-row align-items-center mb-4">
													<i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
													<div class="form-outline flex-fill mb-0">
														<input type="email" id="form3Example3c" class="form-control" />
														<label class="form-label" for="form3Example3c">Your Email</label>
													</div>
												</div>
												<div class="d-flex flex-row align-items-center mb-4">
													<i class="fas fa-lock fa-lg me-3 fa-fw"></i>
													<div class="form-outline flex-fill mb-0">
														<input type="password" id="form3Example4c" class="form-control" />
														<label class="form-label" for="form3Example4c">Password</label>
													</div>
												</div>
												<div class="d-flex flex-row align-items-center mb-4">
													<i class="fas fa-key fa-lg me-3 fa-fw"></i>
													<div class="form-outline flex-fill mb-0">
														<input type="password" id="form3Example4cd" class="form-control" />
														<label class="form-label" for="form3Example4cd">Repeat your password</label>
													</div>
												</div>
												<div class="form-check d-flex justify-content-center mb-5">
													<input
													class="form-check-input me-2"
													type="checkbox"
													value=""
													id="form2Example3c"
													/>
													<label class="form-check-label" for="form2Example3">
														I agree all statements in <a href="#!">Terms of service</a>
													</label>
												</div>
												<div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
													<button type="button" class="btn btn-primary btn-lg">Register</button>
												</div>
											</form>
										</div>
										<div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
											<img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">
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