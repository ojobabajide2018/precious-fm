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
                        <h4 class="text-primary">Member's Profile & Settings</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active"><a href="../doctor-profile.html">Member Profile</a>
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

                                        @foreach($profile_pic as $pp)
                                            <img alt="image" class="rounded-circle shadow" width="90" src="/storage/images/{{$pp->image}}">
                                        @endforeach
                                        <div class="pulse-css"></div>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="mb-2">{{$user->firstname}} {{$user->lastname}}</h2>
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


            <div class="row">
                <div class="col-lg-12">
                    <div class="doctor-info-content">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item col-md-4" role="presentation">
                                <button class="nav-link  active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    Profile
                                </button>
                            </li>
                            <!--                                <li class="nav-item col-md-4" role="presentation">
                                                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                                                    Patient
                                                                </button>
                                                            </li>-->
                            <li class="nav-item col-md-4" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Settings</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card m-t-30">
                                    <div class="row">
                                        <div style="padding-top: 20px">
                                            @if(session()->has('message'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('message') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Profile Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <ul class="widget-timline list-unstyled">
                                                        <li>
                                                            <div class="timeline-dots border-success"></div>
                                                            <h4 class="mb-1">Full Name</h4>
                                                            <p class="mb-0">{{$user->firstname}} {{$user->lastname}}</p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-danger"></div>
                                                            <h4 class="mb-1">Email</h4>
                                                            <p class="mb-0">{{$user->email}}</p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-primary"></div>
                                                            <h4 class="mb-1">Account Type</h4>
                                                            <p class="mb-0">{{$user->account_type}}</p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-success"></div>
                                                            <h4 class="mb-1">Phone Number</h4>
                                                            <p class="mb-0">{{$user->phone}}</p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-danger"></div>
                                                            <h4 class="mb-1">Gender</h4>
                                                            <p class="mb-0">{{$user->gender}}</p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-primary"></div>
                                                            <h4 class="mb-1">IPPS Number</h4>
                                                            <p class="mb-0">{{$user->ippis_no}}</p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-success"></div>
                                                            <h4 class="mb-1">Staff Number</h4>
                                                            <p class="mb-0">{{$user->staff_no}}</p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-primary"></div>
                                                            <h4 class="mb-1">Address</h4>
                                                            <p class="mb-0">{{$user->address}}</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Bank Details</h4>
                                                </div>
                                                <div class="card-body">

                                                        @forelse($bank_details as $bd)
                                                    <ul class="widget-timline list-unstyled">
                                                        <li>
                                                            <div class="timeline-dots border-success"></div>
                                                            <h4 class="mb-1">Bank Name</h4>
                                                            <p class="mb-0">{{$bd->bank_name}} </p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-danger"></div>
                                                            <h4 class="mb-1">Account Name</h4>
                                                            <p class="mb-0">{{$bd->account_name}}</p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-primary"></div>
                                                            <h4 class="mb-1">Account Number</h4>
                                                            <p class="mb-0">{{$bd->account_number}}</p>
                                                        </li>
                                                    </ul>
                                                        @empty
                                                            <h4>Bank details empty! <br> Kindly go to settings and update you information</h4>
                                                        @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Next of Kin Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <ul class="widget-timline list-unstyled">
                                                        <li>
                                                            <div class="timeline-dots border-success"></div>
                                                            <h4 class="mb-1">Full Name</h4>
                                                            <p class="mb-0">{{$user->nok_fname}} {{$user->nok_lname}}</p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-danger"></div>
                                                            <h4 class="mb-1">Address</h4>
                                                            <p class="mb-0">{{$user->nok_address}}</p>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-dots border-primary"></div>
                                                            <h4 class="mb-1">Relationship</h4>
                                                            <p class="mb-0">{{$user->nok_relationship}}</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card m-t-30">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="items p-4 mb-4">
                                                    <div class="bootstrap-media">
                                                        <div class="d-flex media">
                                                            <img class="mr-3 img-fluid rounded" width="60" src="{{url('frontend/assets/images/patients/user1.jpg')}}" alt="DexignZone">
                                                            <div class="media-body">
                                                                <a href="#">
                                                                    <h4 class="mt-0 mb-1">Pt. Airi Satou </h4>
                                                                </a>
                                                                <p class="mb-0">Rabat, Maroc</p>
                                                            </div>
                                                            <div class="btn-group btn-group-style-1">
                                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <div class="form-content">
                                                                        <a href="#">
                                                                            <span class="ml-2">Edit</span>
                                                                        </a>
                                                                        <a href="#">
                                                                            <span class="ml-2">Delete </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 ">
                                                <div class="items p-4 mb-4">
                                                    <div class="bootstrap-media">
                                                        <div class="d-flex media">
                                                            <img class="mr-3 img-fluid rounded" width="60" src="assets/images/patients/user2.jpg" alt="DexignZone">
                                                            <div class="media-body">
                                                                <a href="#">
                                                                    <h4 class="mt-0 mb-1">Pt. Airi Satou </h4>
                                                                </a>
                                                                <p class="mb-0">Rabat, Maroc</p>
                                                            </div>
                                                            <div class="btn-group btn-group-style-1">
                                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <div class="form-content">
                                                                        <a href="#">
                                                                            <span class="ml-2">Edit</span>
                                                                        </a>
                                                                        <a href="#">
                                                                            <span class="ml-2">Delete </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 ">
                                                <div class="items p-4 mb-4">
                                                    <div class="bootstrap-media">
                                                        <div class="d-flex media">
                                                            <img class="mr-3 img-fluid rounded" width="60" src="assets/images/patients/user3.jpg" alt="DexignZone">
                                                            <div class="media-body">
                                                                <a href="#">
                                                                    <h4 class="mt-0 mb-1">Pt. Airi Satou </h4>
                                                                </a>
                                                                <p class="mb-0">Rabat, Maroc</p>
                                                            </div>
                                                            <div class="btn-group btn-group-style-1">
                                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <div class="form-content">
                                                                        <a href="#">
                                                                            <span class="ml-2">Edit</span>
                                                                        </a>
                                                                        <a href="#">
                                                                            <span class="ml-2">Delete </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="items p-4 mb-4">
                                                    <div class="bootstrap-media">
                                                        <div class="d-flex media">
                                                            <img class="mr-3 img-fluid rounded" width="60" src="assets/images/patients/user4.jpg" alt="DexignZone">
                                                            <div class="media-body">
                                                                <a href="#">
                                                                    <h4 class="mt-0 mb-1">Pt. Airi Satou </h4>
                                                                </a>
                                                                <p class="mb-0">Rabat, Maroc</p>
                                                            </div>
                                                            <div class="btn-group btn-group-style-1">
                                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <div class="form-content">
                                                                        <a href="#">
                                                                            <span class="ml-2">Edit</span>
                                                                        </a>
                                                                        <a href="#">
                                                                            <span class="ml-2">Delete </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 ">
                                                <div class="items p-4 mb-4">
                                                    <div class="bootstrap-media">
                                                        <div class="d-flex media">
                                                            <img class="mr-3 img-fluid rounded" width="60" src="assets/images/patients/user5.jpg" alt="DexignZone">
                                                            <div class="media-body">
                                                                <a href="#">
                                                                    <h4 class="mt-0 mb-1">Pt. Airi Satou </h4>
                                                                </a>
                                                                <p class="mb-0">Rabat, Maroc</p>
                                                            </div>
                                                            <div class="btn-group btn-group-style-1">
                                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <div class="form-content">
                                                                        <a href="#">
                                                                            <span class="ml-2">Edit</span>
                                                                        </a>
                                                                        <a href="#">
                                                                            <span class="ml-2">Delete </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 ">
                                                <div class="items p-4 mb-4">
                                                    <div class="bootstrap-media">
                                                        <div class="d-flex media">
                                                            <img class="mr-3 img-fluid rounded" width="60" src="assets/images/patients/user6.jpg" alt="DexignZone">
                                                            <div class="media-body">
                                                                <a href="#">
                                                                    <h4 class="mt-0 mb-1">Pt. Airi Satou </h4>
                                                                </a>
                                                                <p class="mb-0">Rabat, Maroc</p>
                                                            </div>
                                                            <div class="btn-group btn-group-style-1">
                                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <div class="form-content">
                                                                        <a href="#">
                                                                            <span class="ml-2">Edit</span>
                                                                        </a>
                                                                        <a href="#">
                                                                            <span class="ml-2">Delete </span>
                                                                        </a>
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
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row m-t-30 m-l-0 m-r-0">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Personal Information</h4>
                                        </div>
                                        <form action="{{route('update.profile.pic')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-xl-4">
                                                <div class="form-group row widget-3">
                                                    <div class="form-input">
                                                        <label class="labeltest" for="file-ip-1">
                                                                                <span> Drop image here or click to
                                                                                    upload. </span>
                                                        </label>
                                                        <input type="file" id="file-ip-1" name="image" accept="image/*" onchange="showPreview(event);">
                                                        <div class="preview">
                                                            <img id="file-ip-1-preview" src="#" alt="img">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary float-end">
                                                Upload
                                            </button>
                                        </form>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                <form action="">
                                                    {{--{{route('edit-member-profile')}}--}}
                                                    <div class="row">

                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Mobile No.">
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="gender" id="gender" class="form-control form-select">
                                                                    <option>Account Type</option>
                                                                    <option value="member">Member</option>
                                                                    <option value="nonmember">Non Member</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <select name="gender" id="gender" class="form-control form-select">
                                                                    <option>Gender</option>
                                                                    <option value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="department" id="department" class="form-control" placeholder="Department">
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <div class="form-group">
                                                                        <input type="text" name="ippis_no" id="ippis_no" class="form-control" placeholder="IPPIS NO">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <input type="text" name="staff_no" id="staff_no" class="form-control" placeholder="Staff NO">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"> Change Login Credentials </h4>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Password</label>
                                                            <input type="password" name="password" id="password" class="form-control"  placeholder="Password">
                                                        </div>
                                                    </div>
                                                    <!--                                                        <div class="col-xl-6">
                                                                                                                <div class="form-group">
                                                                                                                    <label class="form-label">Confirm Password</label>
                                                                                                                    <input type="password" class="form-control" id="cnpassword" placeholder="Confirm Password">
                                                                                                                </div>
                                                                                                            </div>-->

                                                </div>
                                                <button type="submit" class="btn btn-primary float-end">
                                                    Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"> Bank Details </h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('update.bank.details')}}" method="post">
                                                @csrf
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Bank Name</label>
                                                            <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Bank Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Account Name</label>
                                                            <input type="text" name="account_name" id="account_name" class="form-control"  placeholder="Account Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Account Number</label>
                                                            <input type="number" name="account_number" id="account_number" class="form-control"  placeholder="Account Number">
                                                        </div>
                                                    </div>

                                                </div>
                                                <button type="submit" class="btn btn-primary float-end">
                                                    Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Notifications</h4>
                        </div>
                        <div class="card-body">
                            <ul class="widget-timline list-unstyled">
                                <!--                                    <li>
                                                                        <div class="timeline-dots border-success"></div>
                                                                        <h4 class="mb-1">Dr. Roberts Send you Photo</h4>
                                                                        <p class="mb-0">12 aout 2021</p>
                                                                    </li>
                                                                    <li>
                                                                        <div class="timeline-dots border-danger"></div>
                                                                        <h4 class="mb-1">Reminder : Opertion Time!</h4>
                                                                        <p class="mb-0">12 aout 2021</p>
                                                                    </li>
                                                                    <li>
                                                                        <div class="timeline-dots border-primary"></div>
                                                                        <h4 class="mb-1">Patient Call</h4>
                                                                        <p class="mb-0">12 aout 2021</p>
                                                                    </li>-->
                            </ul>
                        </div>
                    </div>
                </div>
<!--                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Work Progress </h4>
                        </div>
                        <div class="card-body">
                            <ul class="widget-progress list-unstyled">
                                <li>
                                    <h4 class="mb-1">OPD</h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                </li>
                                <li>
                                    <h4 class="mb-1">Operations</h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 35%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">35%</div>
                                    </div>
                                </li>
                                <li>
                                    <h4 class="mb-1">Patient visit</h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 45%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">45%</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>-->
            </div>


        </div>
    </div>
</div>


</div>
<!-- End section content -->


<!-- start section footer -->
<div class="footer ">
    <div class="copyright ">
        <p class="mb-0">Copyright © Designed &amp; Developed by <a href="geenius.zyrocs.com" target="_blank">Buy Solutions Hub |</a> <?php echo date("Y"); ?>
        </p>
    </div>
</div>
<!-- End section footer -->


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


<!-- Mirrored from tabib.inaikas.com/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Aug 2022 14:08:44 GMT -->
</html>
