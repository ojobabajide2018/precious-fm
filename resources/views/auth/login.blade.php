<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Precious FM Coop</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{url('frontend/assets/images/logo.png')}}">
    <!-- Base Styling  -->
    <link rel="stylesheet" href="{{url('frontend/assets/main/css/fonts.css')}}">
    <link rel="stylesheet" href="{{url('frontend/assets/main/css/style.css')}}">
</head>




<body>
<div id="main-wrapper" class="show">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7 p-0 b-center bg-size">
                <img class="img-fluid" src="{{url('frontend/assets/images/bg-register.jpg')}}" alt="tabib app">
            </div>
            <div class="col-xl-5 p-0">
                <div class="login-tabib">
                    <div>
                        <div class="text-center">
                            <a class="logo" href="index.html">
                                <img class="img-fluid" src="{{url('frontend/assets/images/logo.png')}}" alt="loogin page">
                            </a>
                            <h3 style="color: #0096AE">PRECIOUS <span style="color: #5FBB72">FM COOPERATIVE</span></h3>
                        </div>

                        <div class="login-main">

                            <div>
                                @if(!empty($successMessage))
                                    <div class="alert alert-success">
                                        {{ $successMessage }}
                                    </div>
                                @endif

                                <div class="row setup-content">
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                            <form action="{{url('/login-auth')}}" method="post">
                                                @csrf
                                                <h3> Login Below</h3>
                                                <div class="form-group">
                                                    <label for="title">Email:</label>
                                                    <input type="email" name="email" class="form-control" id="email">
                                                    @error('email') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Password:</label>
                                                    <input type="password" name="password" class="form-control" id="password"/>
                                                    @error('password') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                                <p><b>Don't have an account yet? Click <a href="/register">here</a></b></p>
                                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit">Login</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>

</div>
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }
    .full-height {
        height: 100vh;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .position-ref {
        position: relative;
    }
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
    .content {
        text-align: center;
    }
    .title {
        font-size: 84px;
    }
    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
    .m-b-md {
        margin-bottom: 30px;
    }
    .stepwizard-step p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    .displayNone{
        display: none;
    }
</style>


<!-- jQuery -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script><!-- -->
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

<!-- JQuery v3.5.1 -->
<script src="{{url('frontend/assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- popper js -->
<script src="{{url('frontend/assets/plugins/popper/popper.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{url('frontend/assets/plugins/bootstrap/js/bootstrap.js')}}"></script>

<!-- Moment -->
<script src="{{url('frontend/assets/plugins/moment/moment.min.js')}}"></script>

<!-- Date Range Picker -->
<script src="{{url('frontend/assets/plugins/daterangepicker/daterangepicker.min.js')}}"></script>

<!-- Main Custom JQuery -->
<script src="{{url('frontend/assets/js/toggleFullScreen.js')}}"></script>
<script src="{{url('frontend/assets/js/main.js')}}"></script>

</body>

