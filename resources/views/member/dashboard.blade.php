@include('member.header')
@include('member.sidebar')

    <!-- start section header -->
@include('member.notification-header')
    <!-- End section header -->



    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="main_container">
                <div class="row page-titles mx-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between doctor-info-details">
                                        <div class="d-flex left-content">
                                            <div class="media align-self-start">

                                                <img alt="image" class="rounded-circle shadow" width="90" src="/storage/images/{{auth()->user()->profile_picture->image}}">

                                                <div class="pulse-css"></div>
                                            </div>
                                            @if(!empty($successMsg))
                                                <div class="alert alert-success">
                                                    {{ $successMsg }}
                                                </div>
                                            @endif
                                            <div class="media-body">
                                                <h2 class="mb-2">Good {{$dayterm}} {{$user->firstname}} {{$user->lastname}}</h2>
                                                <p class="mb-md-2 mb-sm-4 mb-2">{{$user->account_type}}</p>
                                                <div class="star-review">
                                                    <i class="fa fa-star text-orange"></i>
                                                    <i class="fa fa-star text-orange"></i>
                                                    <i class="fa fa-star text-orange"></i>
                                                    <i class="fa fa-star text-orange"></i>
                                                    <i class="fa fa-star text-gray"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">January</a></li>
                                <li><a class="dropdown-item" href="#">February </a></li>
                                <li><a class="dropdown-item" href="#">March </a></li>
                            </ul>
                        </div>
                    </div>-->
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-sm-6 col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media d-flex justify-content-between">
                                            <div class="media-body">
                                                <p class="text-primary mb-0 fs-14">TOTAL CONTRIBUTION</p>
                                                <h4 class="mb-0 fs-20 text-dark-gray">₦ {{number_format($total_savings)}}</h4>
                                            </div>
                                            <div id="chart4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media d-flex justify-content-between">
                                            <div class="media-body">
                                                <p class="text-warning mb-0 fs-14">ACTIVE LOAN</p>
                                                @forelse($active_loan as $al)
                                                <h4 class="mb-0 fs-20 text-dark-gray">{{$al->loan_type}}</h4>

                                                @empty
                                                    <h4>You have no active loan</h4>
                                                @endforelse

                                            </div>
                                            <div id="chart5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media d-flex justify-content-between">
                                            <div class="media-body">
                                                <p class="text-success mb-0 fs-14">SHARES</p>
                                                <h4 class="mb-0 fs-20 text-dark-gray">₦20.100</h4>
                                            </div>
                                            <div id="chart7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div id="chart6" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="chart8"></div>
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
