<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <img src="assets/img/logo/IMCCS-white.png" width="75px" height="100px" alt="">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>


            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">Administrator <?php echo  $_SESSION["fname"] ?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php echo  $_SESSION["fname"] ?></h6>
                        <span><?php echo  $_SESSION["usertype"] ?></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="home-admin.php?page=admin-account-setting&subpage=admin-personal-info">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">

                    <li>
                        <a class="dropdown-item d-flex align-items-center sign-out" href="../logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="admin-sidebar sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Admin Dashboard</li>

        <li class="nav-item">
            <a class="nav-link" href="home-admin.php?page=admin-dashboard">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <hr>
<!--
        <li class="nav-heading">System Users</li>

        <li class="nav-item">
            <a class="nav-link" href="home-admin.php?page=manage-users">
                <i class="fa-solid fa-users"></i> <span>Manage Users</span>
            </a>
        </li>
        <hr>
        -->
        <li class="nav-heading">Educational Institution</li>

        <li class="nav-item">
            <a class="nav-link " href="home-admin.php?page=manage-institution">
                <i class="fa-solid fa-school"></i>
                <span>Manage Institution</span>
            </a>
        </li><!-- End Institution Nav -->
        <hr>

        <li class="nav-heading">Topic Section</li>


        <li class="nav-item">
            <a class="nav-link" href="home-admin.php?page=manage-lesson">
                <i class="fa-solid fa-book-open"></i>
                <span>Manage Topic</span>
            </a>
        </li><!-- End Course Nav -->
        <hr>

        <li class="nav-heading">Assessment Section</li>

        <li class="nav-item">
            <a class="nav-link" href="home-admin.php?page=manage-question">
                <i class="fa-solid fa-file-lines"></i>
                <span>Manage Assessment</span>
            </a>
        </li><!-- End Course Nav -->
        <hr>

<!--
        <li class="nav-heading">Assessment Result Section</li>

        <li class="nav-item">
            <a class="nav-link" href="home-admin.php?page=manage-assessment">
            <i class="fa-solid fa-square-poll-vertical"></i>
                <span>Manage Result</span>
            </a>
        </li>
        <hr>
        -->

        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link" href="home-admin.php?page=manage-faq">
            <i class="fa-solid fa-circle-question"></i>
                <span>Manage FAQ's</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="home-admin.php?page=manage-feedback">
            <i class="fa-solid fa-comments"></i>
                <span>Manage Feedback</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->