<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Studio</title>
    <!--favicon-->
    <link rel="icon" href="<?php echo constant('URL') ?>public/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?php echo constant('URL') ?>public/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo constant('URL') ?>public/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php echo constant('URL') ?>public/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?php echo constant('URL') ?>public/assets/css/pace.min.css" rel="stylesheet" />
    <script src="<?php echo constant('URL') ?>public/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/bootstrap.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/icons.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/app.css" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/dark-sidebar.css" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/dark-theme.css" />

    <?php require 'funciones/clientesjs.php'; ?>


</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <!--sidebar-wrapper-->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div class="">
                    <img src="assets/images/logo-icon.png" class="logo-icon-2" alt="" />
                </div>
                <div>
                    <h4 class="logo-text">Syndash</h4>
                </div>
                <a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
                </a>
            </div>
            <!--navigation-->
            <?php require 'sidebar.php'; ?>

            <!--end navigation-->
        </div>
        <!--end sidebar-wrapper-->
        <!--header-->
        <header class="top-header">
            <nav class="navbar navbar-expand">
                <div class="left-topbar d-flex align-items-center">
                    <a href="javascript:;" class="toggle-btn"> <i class="bx bx-menu"></i>
                    </a>
                </div>
                <div class="flex-grow-1 search-bar">
                    <div class="input-group">
                        <!--  <div class="input-group-prepend search-arrow-back">
                            <button class="btn btn-search-back" type="button"><i class="bx bx-arrow-back"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" placeholder="search" />
                        <div class="input-group-append">
                            <button class="btn btn-search" type="button"><i class="lni lni-search-alt"></i>
                            </button>
                        </div> -->
                    </div>
                </div>
                <div class="right-topbar ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item search-btn-mobile">
                            <a class="nav-link position-relative" href="javascript:;"> <i class="bx bx-search vertical-align-middle"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown dropdown-user-profile">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
                                <div class="media user-box align-items-center">
                                    <div class="media-body user-info">
                                        <p class="user-name mb-0">Jessica Doe</p>
                                        <p class="designattion mb-0">Available</p>
                                    </div>
                                    <img src="https://via.placeholder.com/110x110" class="user-img" alt="user avatar">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
                                <a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
                                <a class="dropdown-item" href="javascript:;"><i class="bx bx-tachometer"></i><span>Dashboard</span></a>
                                <a class="dropdown-item" href="javascript:;"><i class="bx bx-wallet"></i><span>Earnings</span></a>
                                <a class="dropdown-item" href="javascript:;"><i class="bx bx-cloud-download"></i><span>Downloads</span></a>
                                <div class="dropdown-divider mb-0"></div> <a class="dropdown-item" href="javascript:;"><i class="bx bx-power-off"></i><span>Logout</span></a>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!--end header-->
        <!--page-wrapper-->
        <div class="page-wrapper">
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">