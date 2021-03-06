<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Customer</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('/')}}">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="{{asset("css/custom.css?v=1")}}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Register Customer
					</span>
            </div>

            <form action="{{route('customer.postRegister')}}" method="POST" class="login100-form validate-form">
                @csrf
                <div class="wrap-input100 validate-input m-b-26" data-validate="UserName is required">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="name" placeholder="Enter username">
                    <span class="focus-input100"></span>
                    @if($errors->has('name'))
                        <div class="messages-error">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
                <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" name="email" placeholder="Enter email">
                    <span class="focus-input100"></span>
                    @if($errors->has('email'))
                        <div class="messages-error">
                            {{$errors->first('email')}}
                        </div>
                    @endif
                </div>
                <div class="wrap-input100 validate-input m-b-26" data-validate="Phone is required">
                    <span class="label-input100">Phone</span>
                    <input class="input100" type="text" name="phone" placeholder="Enter phone">
                    <span class="focus-input100"></span>
                    @if($errors->has('phone'))
                        <div class="messages-error">
                            {{$errors->first('phone')}}
                        </div>
                    @endif
                </div>
                <div class="wrap-input100 validate-input m-b-26" data-validate="Address is required">
                    <span class="label-input100">District</span>
                    <select class="form-control custom-select option" name="district_id" type="text" id="district">
                        <option value="">chọn quận huyện</option>
                        @foreach($address as $a)
                            <option value="{{$a->maqh}}">{{$a->name}}</option>
                        @endforeach
                    </select>
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                    <span class="label-input100">Ward</span>
                    <select class="form-control" name="ward_id" id="ward">
                    </select>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="Enter password">
                    <span class="focus-input100"></span>
                    @if($errors->has('password'))
                        <div class="messages-error">
                            {{$errors->first('password')}}
                        </div>
                    @endif
                </div>
                <div class="wrap-input100 validate-input m-b-18" data-validate="Confirm Password is required">
                    <span class="label-input100">Confirm Password</span>
                    <input class="input100" type="password" name="password" placeholder="Enter password">
                    <span class="focus-input100"></span>
                </div>

                <div class="flex-sb-m w-full p-b-30">
                    <div class="contact100-form-checkbox">
                        <a href="{{route('customer.login')}}">Already account? Login now</a>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/main.js"></script>
<script src="{{asset('js/getAddress.js')}}">
</script>

</body>
</html>
