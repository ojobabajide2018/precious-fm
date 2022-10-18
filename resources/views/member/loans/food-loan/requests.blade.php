@include('member.header')
@include('member.sidebar')

<!-- start section header -->
@include('member.notification-header')
<!-- End section header -->



<!-- start section content -->
<div class="content-body">
    <div class="warper container-fluid">
        <div class="all_appointments main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Food Loan Requests</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active"><a href="">Member's Food Loan Requests</a>
                        </li>
                    </ol>
                </div>
            </div>

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
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
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @forelse($loan_requests as $uLa)
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->firstname}} {{$user->lastname}}</td>
                                            <td>{{$uLa->created_at}}</td>
                                            <td>₦{{number_format($uLa->amount)}}</td>
                                            <td>{{$uLa->interest}}%</td>
                                            <td>{{$uLa->duration}}</td>

                                            <td>
                                                <span class="text badge badge-primary">{{$uLa->status}}</span>
                                            </td>
                                    </tr>
                                    @empty
                                        <p>You don't have an active food Loan Requests</p>
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





@include('member.footer')

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

<!-- Chart js -->
<script src="{{url('frontend/assets/plugins/chart/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
<script src="{{url('frontend/assets/js/apex-custom.js')}}"></script>
</body>


<!-- Mirrored from tabib.inaikas.com/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Aug 2022 14:08:44 GMT -->
</html>
