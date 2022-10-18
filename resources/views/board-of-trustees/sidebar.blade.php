<!-- start section sidebar -->
<aside class="left-panel nicescroll-box">
    <nav class="navigation">
        <ul class="list-unstyled main-menu">


            <li class="has-submenu active">
                <a href="{{route('board-of-trustees.dashboard')}}">
                    <i class="fas fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="has-submenu">
                <a href="#" class="has-arrow mm-collapsed">
                    <i class="fas fa-users"></i>
                    <span class="nav-label">MANAGE USERS</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="">All Users</a></li>
                    <li><a href="">Members</a></li>
                    <li> <a href="">Non Members</a> </li>
                </ul>
            </li>
            <li class="has-submenu active">
                <a class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">LOANS REQUESTS</span>
                </a>

            <li class="has-submenu">
                <a href="#" class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">Special Loan</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('special.loan.requests')}}">Loan Requests</a></li>
                    <li> <a href="{{route('special.top-up.loan.requests')}}">Top Up Requests</a> </li>
                </ul>
            </li>


            <li class="has-submenu">
                <a href="#" class="has-arrow mm-collapsed">
                    <i class="fas fa-money-bill"></i>
                    <span class="nav-label">MONTHLY CONTRIBUTIONS</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href=""></a></li>
                    <li><a href="">All Contributions</a></li>
                    <li> <a href="">Import Monthly Contribution</a> </li>
                    <li> <a href="">Account Upgrade Requests</a> </li>
                    <li> <a href="">Import Monthly Contribution</a> </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#" class="has-arrow mm-collapsed">
                    <i class="fas fa-money-bill"></i>
                    <span class="nav-label">SHARES</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="add-doctor.html"></a></li>
                    <li><a href="doctor-list.html">Add Shares</a></li>
                    <li><a href="doctor-list.html">Shares Requests</a></li>
                </ul>
            </li>

        </ul>
    </nav>
    <div class="sidebar-widgets">
    <!--            <div class="top-sidebar box-shadow mx-25 m-b-30 p-b-20 text-center">
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
