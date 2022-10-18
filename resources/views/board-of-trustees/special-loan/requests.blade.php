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

@include('board-of-trustees.sidebar')
@include('board-of-trustees.notification-header')



    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="all_appointments main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary">Special Loan Requests</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active"><a href="../billing-list.html">Member's Special Loan Requests</a>
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
                                            <input id="myInputTextField" class="form-control" type="search" placeholder="Search by member's name" aria-label="Search">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <select class="form-control table-filter-select form-select">
                                                <option>Search by Status</option>
                                                <option>Active</option>
                                                <option>Pending</option>
                                            </select>
                                        </div>
                                    </div>
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
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Interest</th>
                                            <th>Duration</th>
                                            <th>Pay Slip/Bank Statement</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @foreach($special_loan_requests as $special_loan_request)
                                            <td>{{$special_loan_request->id}}</td>
                                            <td>{{$special_loan_request->user->firstname}} {{$special_loan_request->user->lastname}}</td>
                                            <td>{{$special_loan_request->created_at}}</td>
                                            <td>₦{{number_format($special_loan_request->amount)}}</td>
                                            <td>{{$special_loan_request->interest}}%</td>
                                            <td>{{$special_loan_request->duration}}</td>
                                                <td><a href="storage/pay_slips/{{$special_loan_request->user->firstname}}_{{$special_loan_request->user->lastname}}/{{$special_loan_request->pay_slip}}">{{$special_loan_request->pay_slip}}</a></td>

                                            <td>
                                                <span class="text badge badge-primary">{{$special_loan_request->status}}</span>
                                            </td>
                                            <td>
                                                <form action="{{route('approve.special.loan')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$special_loan_request->id}}" name="loan_id">
                                                    <input type="hidden" value="{{$special_loan_request->user_id}}" name="user_id">
                                                    <a class='mr-4'><button type="submit" class="text badge badge-success">Approve</button></a>
                                                </form>
                                                <br>
                                                <form action="{{route('refund.special.loan')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$special_loan_request->id}}" name="loan_id">
                                                    <input type="hidden" value="{{$special_loan_request->user_id}}" name="user_id">
                                                    <a class='mr-4'><button class="text badge badge-warning">Refund</button></a>
                                                </form>

                                                <br>

                                                <form action="{{route('delete.special.loan')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$special_loan_request->id}}" name="loan_id">
                                                    <a class='mr-4'><button class="text badge badge-danger">Delete</button></a>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
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
