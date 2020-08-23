<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset("loginManager/images/icons/favicon.ico")}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("loginManager/vendor/bootstrap/css/bootstrap.min.css")}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("loginManager/fonts/font-awesome-4.7.0/css/font-awesome.min.css")}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("loginManager/vendor/animate/animate.css")}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("loginManager/vendor/css-hamburgers/hamburgers.min.css")}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("loginManager/vendor/select2/select2.min.css")}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("loginManager/css/util.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("loginManager/css/main.css")}}">
    <!--===============================================================================================-->
    <style>
        .errorCustom {
            margin-left: 10px;
            font-style: italic;
            color: firebrick;
        }
    </style>
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset("loginManager/images/img-01.png")}}" alt="IMG">
            </div>

            <form method="post" action="{{route('manager.postLogin')}}" class="login100-form validate-form">
                @csrf
					<span class="login100-form-title">
						Manager

					</span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100 @if($errors->has('email'))  border border-info @endif" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100 @if($errors->has('password'))  border border-info @endif" type="password" name="password" placeholder="Mật khẩu">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Đăng nhập
                    </button>
                </div>

                <div class="text-center p-t-12">
						<span class="txt1">

						</span>
                    <a class="txt2" href="#">

                    </a>
                </div>
                @if($errors->has('email'))
                    <span class="errorCustom">Thông tin xác thực không chính xác</span>
                @endif

                <div class="text-center p-t-136">
                    <a class="txt2" href="#">


                    </a>
                </div>
            </form>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="{{asset("loginManager/vendor/jquery/jquery-3.2.1.min.js")}}"></script>
<!--===============================================================================================-->
<script src="{{asset("loginManager/vendor/bootstrap/js/popper.js")}}"></script>
<script src="{{asset("loginManager/vendor/bootstrap/js/bootstrap.min.js")}}"></script>
<!--===============================================================================================-->
<script src="{{asset("loginManager/vendor/select2/select2.min.js")}}"></script>
<!--===============================================================================================-->
<script src="{{asset("loginManager/vendor/tilt/tilt.jquery.min.js")}}"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{asset("loginManager/js/main.js")}}"></script>

</body>
</html>
