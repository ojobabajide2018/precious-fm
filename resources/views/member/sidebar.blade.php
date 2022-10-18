<!-- start section sidebar -->
<aside class="left-panel nicescroll-box">
    <nav class="navigation">
        <ul class="list-unstyled main-menu">

            <br>
            <li class="has-submenu active">
                <a href="{{route('member.dashboard')}}">
                    <i class="fas fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="has-submenu">
                <a style="color:#7366FF">
                    <i class="fas fa-arrow-down"></i>
                    <span class="nav-label">LOAN FACILITIES</span>
                </a>
            </li>
            <li class="has-submenu">
                <a href="#" class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">Soft Loan</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('member.soft.loan.apply')}}">Apply</a></li>
                    <li><a href="{{route('member.soft.loan.requests')}}">Soft Loan Requests</a></li>
                    <li> <a href="{{route('member.soft.loan.refunds')}}">Payment Report</a> </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#" class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">Emergency Loan</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('member.emergency.loan.apply')}}">Apply</a></li>
                    <li><a href="{{route('member.emergency.loan.requests')}}">Emergency Loan Requests</a></li>
                    <li> <a href="{{route('member.emergency.loan.refunds')}}">Payment Report</a> </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#" class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">Ordinary Loan</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('member.ordinary.loan.apply')}}">Apply</a></li>
                    <li><a href="{{route('member.ordinary.loan.requests')}}">Ordinary Loan Requests</a></li>
                    <li> <a href="{{route('member.ordinary.loan.refunds')}}">Payment Report</a> </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#" class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">Special Loan</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('member.special.loan.apply')}}">Apply Special Loan</a></li>
                    <li><a href="{{route('member.special.loan.requests')}}">Special Loan Requests</a></li>
                    <li> <a href="{{route('member.special.loan.refunds')}}">Payment Report</a> </li>
                    <li> <a href="{{route('member.special.top-up.loan.apply')}}">Apply Special Top-Up Loan</a> </li>

                </ul>
            </li>
            <li class="has-submenu">
                <a href="#" class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">Food Loan</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('member.food.loan.apply')}}">Apply</a></li>
                    <li><a href="{{route('member.food.loan.requests')}}">Food Loan Requests</a></li>
                    <li> <a href="{{route('member.food.loan.refunds')}}">Payment Report</a> </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#" class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">Appliance Loan</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('member.appliance.loan.apply')}}">Apply</a></li>
                    <li><a href="{{route('member.appliance.loan.requests')}}">Appliance Loan Requests</a></li>
                    <li> <a href="{{route('member.appliance.loan.refunds')}}">Payment Report</a> </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a style="color:#7366FF">
                    <i class="fas fa-arrow-down"></i>
                    <span class="nav-label">MONTHLY CONTRIBUTIONS</span>
                </a>
            </li>
            <li class="has-submenu">
                <a href="{{route('member.contributions')}}" class="">
                    <i class="fas fa-save"></i>
                    <span class="nav-label">Contribution Report</span>
                </a>
            </li>

            <li class="has-submenu">
                <a style="color:#7366FF">
                    <i class="fas fa-arrow-down"></i>
                    <span class="nav-label">SHARES</span>
                </a>
            </li>
            <li class="has-submenu">
                <a href="{{route('member.shares')}}" class="">
                    <i class="fas fa-save"></i>
                    <span class="nav-label">Buy/Sell Shares</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="sidebar-widgets">
    <!--<div class="top-sidebar box-shadow mx-25 m-b-30 p-b-20 text-center">
                <a href="new-appointment.html">
                    <img href="{{asset('frontend/assets/images/appointement.svg')}}" class="side-img" alt="img">
                </a>
                <a href="#">
                    <h4 class="text-primary mb-0">Make an Appointments</h4>
                </a>
            </div>-->
        <div class="copyright text-center">
            <p class="mb-0"> Buy Solutions Hub</p>
            <p class="mb-0"> © <?php echo date("Y"); ?> </p>
        </div>
    </div>
</aside>
<!-- End section sidebar -->
