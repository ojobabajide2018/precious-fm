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
            <a href="index.html"><img class="brand-title" src="{{asset('frontend/assets/images/logo.png')}}" style="width: 100px; padding-left: 40px"></a>

        </div>
        <div><marquee behavior="" direction=""><h4 style="color: #0096AE; padding: 10px">PRECIOUS <span style="color: #5FBB72">FM COOPERATIVE</span></h4></marquee></div>
        <br>


    </div>
    <!-- End logo components -->

    @include('member.sidebar')
    @include('member.notification-header')






    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="all_appointments main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary">Emergency Loan Refunds</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active"><a href="">Member's Emergency Loan Refunds</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-50">
                            <div class="card-header">
                                <div class="row m-rl w-100">

                                    <div class="col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <input id="daterange" class="form-control input-daterange-datepicker">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display nowrap">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Fullname</th>
                                            <th>Amount</th>
                                            <th>Date</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @forelse($loan_refunds as $loan_refund)
                                                <td>{{$num++}}</td>
                                                <td>{{$loan_refund->user->firstname}} {{$loan_refund->user->lastname}}</td>
                                                <td>₦ {{number_format($loan_refund->amount_refunded)}}</td>
                                                <td>{{$loan_refund->created_at}}</td>
                                        </tr>
                                        @empty
                                            <td>You have no existing refund</td>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
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
