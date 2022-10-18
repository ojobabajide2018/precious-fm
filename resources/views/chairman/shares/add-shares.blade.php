<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Precious FM Cooperative</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{asset('frontend/assets/images/logo.png')}}">
    <!-- Base Styling  -->
    <link rel="stylesheet" href="{{asset('frontend/assets/main/css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/main/css/style.css')}}">
</head>

<body>
<div id="main-wrapper" class="show">


    <!-- start logo components -->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="index.html"><img class="brand-title" src="{{asset('frontend/assets/images/logo.png')}}"></a>
        </div>


    </div>

    <!-- End logo components -->

    @include('chairman.sidebar')
    @include('chairman.notification-header')





    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="main_container">


                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary">Shares</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active"><a href="">Shares</a>
                            </li>
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between doctor-info-details">
                                    <div class="d-flex left-content">
                                        <div class="media align-self-start">


                                        </div>
                                        <div class="media-body">
                                            <h2 class="mb-2">Shares Transactions</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="doctor-info-content">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item col-md-4" role="presentation">
                                <button class="nav-link  active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    Add Shares
                                </button>
                            </li>

                        </ul>
                        <div style="padding-top: 20px">
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                        </div>
                        <div style="padding-top: 20px">
                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card m-t-30">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Add New Shares Below:</h4>
                                        </div>

                                        <div style="padding: 50px">
                                            <strong>SHARES WALLET</strong> <br> <br>
                                            Available Shares <b>₦ {{number_format($shares_released)}}</b> <br>
                                            Shares Remaining: <b>₦ {{number_format($shares_remaining)}}</b> <br>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                <form action="{{route('add-shares')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Enter Name of Shares To Add(₦)</label>
                                                                <input type="name" name="name"  class="form-control" placeholder="Name">
                                                                <br>
                                                            </div>
                                                            @if ($errors->has('name'))
                                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                            @endif
                                                        </div>
                                                        <br>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Enter Amount of Shares To Add(₦)</label>
                                                                <input type="number" name="amount"  class="form-control" placeholder="Amount">
                                                                <br>
                                                                <button type="submit" class="btn btn-primary">Add</button>
                                                            </div>
                                                            @if ($errors->has('amount'))
                                                                <span class="text-danger">{{ $errors->first('amount') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
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






    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function(){
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click",".btn-danger",function(){
                $(this).parents(".hdtuto control-group lst").remove();
            });
        });
    </script>

    @include('admin.footer');




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

<!-- Datatable -->
<script src="{{url('frontend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('frontend/assets/js/init-tdatatable.js')}}"></script>

<!-- Chart js -->
<script src="{{url('frontend/assets/plugins/chart/chart/Chart.min.js')}}"></script>
<script src="{{url('frontend/assets/js/charts-custom.js')}}"></script>

<!-- Main Custom JQuery -->
<script src="{{url('frontend/assets/js/toggleFullScreen.js')}}"></script>
<script src="{{url('frontend/assets/js/main.js')}}"></script>

</body>


</html>
