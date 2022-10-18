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
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Appliance Loan</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Appliance Loan</a>
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
                                        <h2 class="mb-2">Appliance Loan Application</h2>
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
                                    About Appliance Loan
                                </button>
                            </li>

                            <li class="nav-item col-md-4" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Applicaion Form</button>
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
                                    <div class="card-body">
                                        <p>
                                            To further provide succour for its members', the Cooperative shall enter into an agreement with an electronics company or land owner to supply/purchase household appliances/land to members.
                                            This attracts an interest rate of 5% only, with six (24) months repayable period. When the amount is above #1,000,000 the rule of special loan shall be applied.
                                            Application fee of #500.00 only applies. Please check the bye-law for more details.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row m-t-30 m-l-0 m-r-0">

                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Fill the form below:</h4>
                                        </div>

                                        <div style="padding: 50px">
                                            Available Balance: <b>₦ {{number_format($total_savings)}}</b> <br>
                                            Maximum Loan: <b>₦ {{number_format($maximum_amount)}}</b> <br>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                <form action="{{route('member.appliance.loan.submit')}}" method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Loan Amount (₦)</label>
                                                                <input type="number" name="amount"  class="form-control" placeholder="Amount">
                                                            </div>
                                                            @if ($errors->has('amount'))
                                                                <span class="text-danger">{{ $errors->first('amount') }}</span>
                                                            @endif
                                                        </div>


                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Attach current pay slip or bank statement</label>
                                                                <input type="file" name="image" class="form-control" placeholder="Attach current pay slip or bank statement">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">1st Guarantor's Name</label>
                                                                <input type="text" name="guarantor_one_name"  class="form-control" placeholder="1st Guarantor's Name" require>
                                                            </div>
                                                            @error('guarantor_one_name') <span class="error">{{ $message }}</span> @enderror
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">1st Guarantor's Phone Number</label>
                                                                <input type="number" name="guarantor_one_phone" class="form-control" placeholder="1st Guarantor's Phone Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">1st Guarantor's Address</label>
                                                                <input type="text" name="guarantor_one_address" class="form-control" placeholder="1st Guarantor's Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">2nd Guarantors Name</label>
                                                                <input type="text" name="guarantor_two_name" class="form-control" placeholder="2nd Guarantors Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">2nd Guarantor's Phone Number</label>
                                                                <input type="number" name="guarantor_two_phone" class="form-control" placeholder="2nd Guarantor's Phone Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">2nd Guarantor's Address</label>
                                                                <input type="text" name="guarantor_two_address" class="form-control" placeholder="2nd Guarantor's Address">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group text-right">
                                                        <button type="submit" class="btn btn-primary float-end ">Submit</button>
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
