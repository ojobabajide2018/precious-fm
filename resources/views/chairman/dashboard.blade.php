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

 @include('chairman.sidebar')
 @include('chairman.notification-header')

    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-lg-12 p-md-0">
                    <h4 class="text-primary">Good {{$dayterm}} <span class="names">Chairman</span></h4>
                    <p class="mb-0">Precious Fm Cooperative</p>
                </div>
            </div>

            <div class="new-patients main_container">
                <div class="row">
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="widget card card-primary">
                            <div class="card-body">
                                <div class="media text-center">
                                        <span>
                                            <i class="fas fa-calendar-check fa-2x"></i>
                                        </span>
                                    <div class="media-body">
                                        <span class="text-white">Registered Members</span>
                                        <h3 class="mb-0 text-white">{{$membercount}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="widget card card-danger">
                            <div class="card-body">
                                <div class="media text-center">
                                        <span>
                                            <i class="fas fa-user-nurse fa-2x"></i>
                                        </span>
                                    <div class="media-body">
                                        <span class="text-white">Non Members</span>
                                        <h3 class="mb-0 text-white">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="widget card card-primary">
                            <div class="card-body">
                                <div class="media text-center">
                                        <span>
                                            <i class="fas fa-user-plus fa-2x"></i>
                                        </span>
                                    <div class="media-body">
                                        <span class="text-white">Shares Sold</span>
                                        <h3 class="mb-0 text-white">{{number_format($shares_sold)}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="widget card card-primary">
                            <div class="card-body">
                                <div class="media text-center">
                                        <span>
                                            <i class="fas fa-database fa-2x"></i>
                                        </span>
                                    <div class="media-body">
                                        <span class="text-white">Amount Saved</span>
                                        <h3 class="mb-0 text-white">{{number_format($amount_saved)}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow widget1">
                            <div class="card-header">
                                <h4 class="card-title">Activity</h4>
                                <span class="subtitle">TODAY {{$date}}</span>
                            </div>
                            <div class="card-body">
                                <canvas id="chart1" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow widget-2">
                            <div class="card-header">
                                <h4 class="card-title">Latest Members</h4>
                            </div>
                            <div class="card-body">
                                <div class="panel-body widget-media main-scroll nicescroll-box">
                                    <ul class="list-group list-unstyled">
                                       @foreach($members as $member)
                                        <li class="list-group-item d-flex justify-content-between align-items-center media">
                                            <div class="d-flex">
                                                <div class="img-patient">
                                                    <img class="rounded-circle" alt="people" src="/storage/images/{{$member->profile_picture->image ?? 'default.png'}}">
                                                    </div>

                                                <div class="media-body">
                                                    <h4 class="mb-0">{{$member->firstname}} {{$member->lastname}}</h4>
                                                    <span>{{$member->account_type}}</span>
                                                </div>
                                            </div>
                                            <button type="button" class="ms-btn-icon btn-success" name="button">
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </li>
                                       @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow widget1">
                            <div class="card-header">
                                <h4 class="card-title">Users Analytics</h4>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <canvas id="chart3" width="100%" height="220"></canvas>
                                    </div>
                                    <div class="col-lg-10">
                                        <ul class="d-flex justify-content-between m-t-30">
                                            <li class="content-widget text-center">
                                                <p class="mb-0 fs-14 text-muted">Admin</p>
                                                <h4 class="mb-0 fs-20 text-dark-gray">8952</h4>
                                            </li>
                                            <li class="content-widget text-center">
                                                <p class="mb-0 fs-14 text-muted">Members</p>
                                                <h4 class="mb-0 fs-20 text-dark-gray">7458</h4>
                                            </li>
                                            <li class="content-widget text-center">
                                                <p class="mb-0 fs-14 text-muted">Non Members</p>
                                                <h4 class="mb-0 fs-20 text-dark-gray">3254</h4>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow widget1">
                            <div class="card-header">
                                <h4 class="card-title">Cooperative Analytics</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="chart2" width="100%" height="299"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title">Appointment List | 04 Aug 2021</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="display nowrap">
                                        <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Date</th>
                                            <th>Patient</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                07:00
                                            </td>
                                            <td>01 Jun 2021</td>
                                            <td> Michael R Sheets </td>
                                            <td> 1468 Selah Way - Rabat</td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start">
                                                <span class="badge badge-primary">Start appt</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                07:30
                                            </td>
                                            <td>02 Jun 2021</td>
                                            <td> Eric J Lane</td>
                                            <td>1468 Selah Way - Agadir</td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge badge-primary">Start
                                                            appt</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                08:00
                                            </td>
                                            <td>03 Jun 2021</td>
                                            <td> Pamela R Matheney </td>
                                            <td>1468 Selah Way - Casablanca</td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge badge-primary">Start
                                                            appt</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                08:30
                                            </td>
                                            <td>04 Jun 2021</td>
                                            <td> Chelsea S Coy
                                            </td>
                                            <td>1468 Selah Way - Fes </td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge btn-danger">Canclled</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                09:00
                                            </td>
                                            <td>05 Jun 2021</td>
                                            <td> Michael R Sheets
                                            </td>
                                            <td> 1468 Selah Way - Oujda</td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge badge-primary">Start
                                                            appt</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                09:30
                                            </td>
                                            <td>06 Jun 2021</td>
                                            <td>Eric J Lane</td>
                                            <td>1468 Selah Way - Marakesh</td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge badge-primary">Start
                                                            appt</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 10:00 </td>
                                            <td>07 Jun 2021</td>
                                            <td> Pamela R Matheney </td>
                                            <td>1468 Selah Way - Lexington</td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge badge-primary">Start
                                                            appt</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 10:30 </td>
                                            <td>08 Jun 2021</td>
                                            <td> Chelsea S Coy </td>
                                            <td>1468 Selah Way - Bakersfield </td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge btn-danger">Canclled</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 11:00 </td>
                                            <td>09 Jun 2021</td>
                                            <td> Michael R Sheets </td>
                                            <td> 1468 Selah Way - Brattleboro</td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge badge-primary">Start
                                                            appt</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 11:30 </td>
                                            <td>10 Jun 2021</td>
                                            <td> Eric J Lane</td>
                                            <td>1468 Selah Way - Laayoune</td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge badge-primary">Start
                                                            appt</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 09:00 </td>
                                            <td>11 Jun 2021</td>
                                            <td> Pamela R Matheney </td>
                                            <td>2320 May Street - Lexington</td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge badge-primary">Start
                                                            appt</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 09:00 </td>
                                            <td>12 Jun 2021</td>
                                            <td> Chelsea S Coy </td>
                                            <td>3342 Lowndes Hill - Berrechid </td>
                                            <td>833 - 844 - 0100</td>
                                            <td class="text-start"> <span class="badge btn-danger">Canclled</span>
                                            </td>
                                            <td>
                                                <a class='mr-4 check'>
                                                    <span class='fas fa-check'></span>
                                                </a>
                                                <a class='delet'>
                                                    <span class='fas fa-trash-alt'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <!-- End section content -->


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
