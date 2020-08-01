<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Helper</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset("loginHelper/images/icons/favicon.icologinHelper/")}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("loginHelper/vendor/bootstrap/css/bootstrap.min.css")}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("loginHelper/fonts/font-awesome-4.7.0/css/font-awesome.min.css")}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("loginHelper/fonts/iconic/css/material-design-iconic-font.min.css")}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("loginHelper/vendor/animate/animate.css")}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("loginHelper/vendor/css-hamburgers/hamburgers.min.css")}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("loginHelper/vendor/animsition/css/animsition.min.css")}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("loginHelper/vendor/select2/select2.min.css")}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("loginHelper/vendor/daterangepicker/daterangepicker.css")}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("loginHelper/css/util.css")}}">
	<link rel="stylesheet" type="text/css" href="{{asset("loginHelper/css/main.css")}}">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" method="post" action="{{route("helper.postLogin")}}">
                    @csrf
					<span class="login100-form-title p-b-50">
						Welcome
					</span>
					<div class="wrap-input100 validate-input m-t-50 m-b-35" data-validate = "Enter username">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<ul class="login-more p-t-100">
						<li class="m-b-8">
							<span class="txt1">
								Forgot
							</span>

							<a href="#" class="txt2">
								Username / Password?
							</a>
						</li>

						<li>
							<span class="txt1">
								Don’t have an account?
							</span>

							<a href="{{route('helper.register')}}" class="txt2">
								Sign up
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="{{asset("loginHelper/vendor/jquery/jquery-3.2.1.min.js")}}"></script>
<!--===============================================================================================-->
	<script src="{{asset("loginHelper/vendor/animsition/js/animsition.min.js")}}"></script>
<!--===============================================================================================-->
	<script src="{{asset("loginHelper/vendor/bootstrap/js/popper.js")}}"></script>
	<script src="{{asset("loginHelper/vendor/bootstrap/js/bootstrap.min.js")}}"></script>
<!--===============================================================================================-->
	<script src="{{asset("loginHelper/vendor/select2/select2.min.js")}}"></script>
<!--===============================================================================================-->
	<script src="{{asset("loginHelper/vendor/daterangepicker/moment.min.js")}}"></script>
	<script src="{{asset("loginHelper/vendor/daterangepicker/daterangepicker.js")}}"></script>
<!--===============================================================================================-->
	<script src="{{asset("loginHelper/vendor/countdowntime/countdowntime.js")}}"></script>
<!--===============================================================================================-->
	<script src="{{asset("loginHelper/js/main.js")}}"></script>

</body>
</html>
