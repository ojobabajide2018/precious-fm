<div class="header">
    <header class="top-head container-fluid">
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
            <!--                <div class="left-header content-header__menu">
                                <ul class="list-unstyled">
                                    <li class="nav-link btn">
                                        <a href="#"><i class="far fa-calendar-check"></i> <span> Make an appointment</span></a>
                                    </li>
                                    <li class="nav-link btn">
                                        <a href="#"><i class="far fa-file-alt"></i> <span> Write a prescription</span></a>
                                    </li>
                                </ul>
                            </div>-->
        </div>
        <div class="header-right">
            <div class="fullscreen notification_dropdown">
                <div class="full">
                    <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="fas fa-expand"></i>
                    </a>
                </div>
            </div>
            <div class="notification_dropdown">
                <div class="cart-wrapper">
                    <div class="cart-icon">
                        <a class="cart-control" href="#">
                            <i class="fas fa-bell"></i>
                            <div class="pulse-css"></div>
                        </a>
                    </div>
<!--                    <div class="cart-dropdown-form dropdown-container">
                        <div class="form-content">
                            <div class="widget-media main-scroll nicescroll-box">
                                <ul class="timeline">
                                    <li>
                                        <h6 class="mb-0">Notitications</h6>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media mr-2">
                                                <img alt="image" src="{{url('frontend/assets/images/avtar/1.jpg')}}">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1 ">Incoming Message</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media mr-2 media-info">
                                                <img alt="image" src="{{url('frontend/assets/images/avtar/1.jpg')}}">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">You got a new email</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media mr-2 media-success">
                                                <img alt="image" src="{{url('frontend/assets/images/avtar/1.jpg')}}">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Hello world!</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media mr-2">
                                                <img alt="image" src="{{url('frontend/assets/images/avtar/1.jpg')}}">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Beep Boop. Beee...</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media mr-2 media-danger">
                                                &lt;!&ndash; KG &ndash;&gt;
                                                <img alt="image" src="{{url('frontend/assets/images/avtar/1.jpg')}}">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Hello world!</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media mr-2 media-primary">
                                                <img alt="image" src="{{url('frontend/assets/images/avtar/1.jpg')}}">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Incoming Message</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a class="all-notification btn btn-primary" href="#">
                                See all notifications
                            </a>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="my-account-wrapper">
                <div class="account-wrapper">
                    <div class="account-control">
                        <a class="login header-profile" href="#" title="Sign in">
                            <div class="header-info">
                                <span>{{$user->firstname}} {{$user->lastname}}</span>
                                <small>{{$user->account_type}}</small>
                            </div>


                        </a>
                        <div class="account-dropdown-form dropdown-container">
                            <div class="form-content">
                                <a href="{{route('member.profile')}}">
                                    <i class="far fa-user"></i>
                                    <span class="ml-2">Profile</span>
                                </a>

                                <a href="{{route('logout')}}">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span class="ml-2">Logout </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
