    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-dark bg-black"
        id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i
                data-feather="menu"></i></button>
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <?php 
            $mainPage = $PATH_SERVER;
            if(isAdmin())
                $mainPage = $PATH_ADMIN;
            if(isEmployee())
                $mainPage = $PATH_EMPLOYEE;
            if(isCustomer())
                $mainPage = $PATH_CUSTOMER
;
         ?>
        <div class="avatar avatar-lg">
            <!-- <img class="avatar-img img-fluid" style="min-width: 32px; min-height: 32px;"
                src="<?php //echo $PATH_SERVER ?>assets/img/favicon.png" /> -->
        </div>
        <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?php echo $mainPage; ?>">
            <!-- <img class="img-fluid" src="<?php //echo $PATH_SERVER ?>assets/img/favicon.png" /> -->
            <?php echo lang("Airport Parking");?>
        </a>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the lg breakpoint-->
        <form class="form-inline me-auto d-none d-lg-block me-3">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control pe-0" type="search" placeholder="<?php echo lang("Search");?>"
                    aria-label="Search" />
                <div class="input-group-text"><i data-feather="search"></i></div>
            </div>
        </form>
        <!-- <form class="form-inline me-auto d-none d-lg-block me-3">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-text"><i data-feather="search"></i></div>
            </div>
        </form> -->
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">
            <!-- Documentation Dropdown-->

            <!-- Navbar Search Dropdown-->
            <!-- * * Note: * * Visible only below the lg breakpoint-->
            <li class="d-none nav-item dropdown no-caret me-3 d-lg-none">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        data-feather="search"></i></a>
                <!-- Dropdown - Search-->
                <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline me-auto w-100">
                        <div class="input-group input-group-joined input-group-solid">
                            <input class="form-control pe-0" type="text"
                                placeholder="<?php echo lang("Search for...");?>" aria-label="Search"
                                aria-describedby="basic-addon2" />
                            <div class="input-group-text"><i data-feather="search"></i></div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Messages Dropdown-->
            <li class="nav-item dropdown no-caret d-sm-block me-3 dropdown-notifications">
                <a class="btn btn-icon btn-transparent-light dropdown-toggle" id="navbarDropdownMessages"
                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i data-feather="globe"></i></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                    aria-labelledby="navbarDropdownMessages">
                    <h6 class="dropdown-header dropdown-notifications-header">
                        <i class="me-2" data-feather="globe"></i>
                        <?php echo lang("Choose Language"); ?>
                    </h6>
                    <!-- Example Message 1  -->
                    <a class="dropdown-item dropdown-notifications-item"
                        href="<?php echo $PATH_SERVER.'change_language.php?lang=ar'; ?>">
                        <!-- <img class="dropdown-notifications-item-img"
                            src="assets/img/illustrations/profiles/profile-2.png" /> -->
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text"> <?php echo lang("Arabic"); ?></div>
                            <!-- <div class="dropdown-notifications-item-content-details">Thomas Wilcox · 58m</div> -->
                        </div>
                    </a>
                    <!-- Example Message 2-->
                    <a class="dropdown-item dropdown-notifications-item"
                        href="<?php echo $PATH_SERVER.'change_language.php?lang=en'; ?>">
                        <!-- <img class="dropdown-notifications-item-img"
                            src="assets/img/illustrations/profiles/profile-2.png" /> -->
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text"> <?php echo lang("English"); ?></div>
                            <!-- <div class="dropdown-notifications-item-content-details">Thomas Wilcox · 58m</div> -->
                        </div>
                    </a>
                    <!-- Footer Link-->
                    <!-- <a class="dropdown-item dropdown-notifications-footer" href="#!">Read All Messages</a> -->
                </div>
            </li>

            <?php if(isLogin()){ ?>
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><img class="img-fluid"
                        src="<?php echo $PATH_SERVER ?>assets/img/illustrations/profiles/profile-1.png" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                    aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img"
                            src="<?php echo $PATH_SERVER ?>assets/img/illustrations/profiles/profile-1.png" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?php echo lang("Welcome"); ?></div>
                            <div class="dropdown-user-details-email">
                                <a href="<?php echo $mainPage; ?>profile.php"><?php echo getLoginEmail();?>
                                </a>
                            </div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo $mainPage; ?>profile.php">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        <?php echo lang("My Profile"); ?>
                    </a>

                    <a class="dropdown-item" href="<?php echo $PATH_SERVER; ?>logout.php">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        <?php echo lang("Logout");?>
                    </a>
                </div>
            </li>

            <?php }?>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-dark">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">

                        <?php if(isLogin()){ ?>


                        <!-- ============================================================  -->
                        <!-- ==============   Admin Pages Link      ==================  -->
                        <!-- ============================================================  -->
                        <?php if(isAdmin()){ ?>
                        <!-- Sidenav Menu Heading (Account)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <!-- <div class="sidenav-menu-heading d-sm-none">Account</div> -->
                        <!-- Sidenav Link (Alerts)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <!-- <a class="nav-link d-sm-none" href="#!">
                            <div class="nav-link-icon"><i data-feather="bell"></i></div>
                            Alerts
                            <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                        </a> -->
                        <!-- Sidenav Link (Messages)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <!-- <a class="nav-link d-sm-none" href="#!">
                            <div class="nav-link-icon"><i data-feather="mail"></i></div>
                            Messages
                            <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                        </a> -->
                        <!-- Sidenav Menu Heading (Core)-->
                        <div class="sidenav-menu-heading"><?php echo lang("Control Panel");?></div>

                        <!-- Sidenav Accordion (Dashboard)-->
                        <!-- <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                            data-bs-target="#collapseDashboards" aria-expanded="false"
                            aria-controls="collapseDashboards">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboards
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="dashboard-1.html">
                                    Default
                                    <span class="badge bg-primary-soft text-primary ms-auto">Updated</span>
                                </a>
                                <a class="nav-link" href="dashboard-2.html">Multipurpose</a>
                                <a class="nav-link" href="dashboard-3.html">Affiliate</a>
                            </nav>
                        </div> -->

                        <a class="nav-link" href="<?php echo $PATH_ADMIN; ?>">
                            <div class="nav-link-icon"><i class="fa fa-home fa-lg"></i>
                            </div>
                            <?php echo lang("Home");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_CUSTOMER; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-feather"></i></div>
                            <?php echo lang("Customers");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_PARK; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-book"></i></div>
                            <?php echo lang("Parks");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_BOOKING; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-book"></i></div>
                            <?php echo lang("Bookings");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_EMPLOYEE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                            <?php echo lang("Employees");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_ADMIN_SETTING; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-sliders"></i></i></div>
                            <?php echo lang("Setting");?>
                        </a>

                        <!-- ============================================================  -->
                        <!-- ==============   Employee Pages Link      ==================  -->
                        <!-- ============================================================  -->

                        <?php }else if(isEmployee()){ ?>

                        <div class="sidenav-menu-heading"><?php echo lang("Control Panel");?></div>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE; ?>">
                            <div class="nav-link-icon"><i class="fa fa-home fa-lg"></i>
                            </div>
                            <?php echo lang("Home");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_AUTHOR; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-feather"></i></div>
                            <?php echo lang("Author");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_BOOK; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-book"></i></div>
                            <?php echo lang("Books");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_COLLEGE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-building-columns"></i></div>
                            <?php echo lang("Colleges");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_DEPARTMENT; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-building"></i></div>
                            <?php echo lang("Departments");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_FINE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-coins"></i></div>
                            <?php echo lang("Fines");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_ISSUE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            <?php echo lang("Issues");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_LANGUAGE; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-language"></i></div>
                            <?php echo lang("Languages");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_LEVEL; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                            <?php echo lang("Levels");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_PUBLISHER; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-file-powerpoint"></i></div>
                            <?php echo lang("Publishers");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_SECTION; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-list-ul"></i></div>
                            <?php echo lang("Section");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_SETTING; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-sliders"></i></div>
                            <?php echo lang("Setting");?>
                        </a>
                        <a class="nav-link" href="<?php echo $PATH_EMPLOYEE_CUSTOMER; ?>">
                            <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            <?php echo lang("Customers");?>
                        </a>

                        <!-- ============================================================  -->
                        <!-- ==============   Customer Pages Link      ==================  -->
                        <!-- ============================================================  -->

                        <?php }else if(isCustomer()){ ?>

                        <div class="sidenav-menu-heading"><?php echo lang("Control Panel");?></div>

                        <a class="nav-link" href="<?php echo $PATH_CUSTOMER;?>index.php">
                            <div class="nav-link-icon"><i class="fa fa-home fa-lg"></i>
                            </div>
                            <?php echo lang("Dashboard");?>
                        </a>
                        <a class="nav-link" href="<?php echo $mainPage; ?>my_issues.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            <?PHP echo lang("My Issues");?>
                        </a>
                        <a class="nav-link" href="<?php echo $mainPage; ?>my_fines.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-coins"></i></div>
                            <?PHP echo lang("My Fines");?>
                        </a>
                        <?php } ?>




                        <!-- ============================================================  -->
                        <!-- ==============   Visitor Pages Link      ==================  -->
                        <!-- ============================================================  -->
                        <?php }
                        //else{ 
                            ?>
                        <div class="sidenav-menu-heading"><?php echo lang("Fast Access"); ?></div>

                        <a class="nav-link active" href="<?php echo $PATH_SERVER;?>index.php">
                            <div class="nav-link-icon"><i class="fa fa-home fa-lg"></i>
                            </div>
                            <?php echo lang("Home");?>
                        </a>
                        <?php if(!isLogin()) {?>
                        <a class="nav-link" href="<?php echo $PATH_SERVER; ?>login.php">
                            <div class="nav-link-icon"><i class="fa-solid fa-right-to-bracket"></i></div>
                            <?php echo lang("Login");?>
                        </a>
                        <?php }?>
                        <?php //} ?>




                    </div>
                </div>
                <?php
                    if(isLogin())
                    {
                ?>
                <!-- Sidenav Footer-->
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title"><?php echo $_SESSION['user']; ?></div>
                    </div>
                </div>
                <?php } ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <!--  ======== Statrt Content ============ -->
            <?php if ( isset($_SESSION['success']) ){ ?>
            <div class="alert alert-success alert-dismissible fade show" id="successmessage" role="alert">
                <strong><?php echo $_SESSION['success'];  $_SESSION['success'] = null; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>

            <?php if ( isset($_SESSION['fail']) ){ ?>
            <div class="alert alert-danger alert-dismissible fade show" id="failmessage" role="alert">
                <strong><?php echo $_SESSION['fail'];  $_SESSION['fail'] = null; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>