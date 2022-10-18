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

@include('admin.sidebar')
@include('admin.notification-header')



<!-- start section content -->
    <div class="content-body ">
        <div class="warper container-fluid">
            <div class="create_invoice main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary">Add User Contributions</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active"><a href="../create-invoice.html">Add User Contributions</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h4 class="card-title"> Add User Contributions</h4>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="form-group">
                                                @foreach($users as $member)
                                                <select class="form-control form-select">
                                                    <option>{{$member->firstname}}</option>
                                                </select>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="form-group">
                                                <select class="form-control form-select">
                                                    <option>Month</option>
                                                    <option>January</option>
                                                    <option>February</option>
                                                    <option>March</option>
                                                    <option>April</option>
                                                    <option>May</option>
                                                    <option>June</option>
                                                    <option>July</option>
                                                    <option>August</option>
                                                    <option>September</option>
                                                    <option>October</option>
                                                    <option>November</option>
                                                    <option>December</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Status">

                                                </input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Invoice Title">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 ">
                                            <div class="form-group">
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary w-100 h-56">Create
                                                    Invoice</button>
                                            </div>
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
    <!-- End section content -->




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


</div>


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
