<!-- start section sidebar -->
<aside class="left-panel nicescroll-box">
    <nav class="navigation">
        <ul class="list-unstyled main-menu">

            <br>
            <li class="has-submenu active">
                <a href="{{route('chairman.dashboard')}}">
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
                    <li><a href="{{route('members')}}">All Members</a></li>
                </ul>
            </li>
            <li class="has-submenu active">
                <a class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">LOANS REQUESTS</span>
                </a>
            <li class="has-submenu">
                <a class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">Soft Loan</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('soft.loan.requests')}}">Loan Requests</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">Emergency Loan</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('emergency.loan.requests')}}">Loan Requests</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a class="has-arrow mm-collapsed">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-label">Food Loan</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('food.loan.requests')}}">Loan Requests</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a class="has-arrow mm-collapsed">
                    <i class="fas fa-money-bill"></i>
                    <span class="nav-label">MONTHLY CONTRIBUTIONS</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href=""></a></li>
                    <li><a href="{{route('contributions')}}">All Contributions</a></li>
                    <li> <a href="{{route('batch.upload.savings')}}">Import Monthly Contribution</a> </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a class="has-arrow mm-collapsed">
                    <i class="fas fa-money-bill"></i>
                    <span class="nav-label">SHARES</span>
                </a>
                <ul class="list-unstyled mm-collapse">
                    <li><a href="{{route('admin.add-shares')}}">Add Shares</a></li>
                    <li><a href="{{route('shares.requests')}}">Shares Requests</a></li>
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
