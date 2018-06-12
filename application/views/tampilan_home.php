<?php
$this->load->library('session');
$session_name = $this->session->userdata("username_gpcomp");
$userId = $this->session->userdata("id_gpcomp");
if (!empty($userId)) {
    $this->db->where('id', $userId);
    $query = $this->db->get('users');
    $exe = $query->row();
    $username = $exe->UserName;
}
?><!DOCTYPE html>
<html lang="en">
    <!-- start: HEAD -->
    <head>
        <title>GP Comp - IT Solution</title>
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- start: MAIN CSS -->
        <link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/style.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main-responsive.css">
<!--        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/skins/all.css">-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme_light.css" id="skin_color">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jQuery-File-Upload/css/jquery.fileupload-ui.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/nprogress/nprogress.css" />
<!--        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/css/datepicker.css">-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
        <!-- end: MAIN CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/DataTables/media/css/DT_bootstrap.css" />
        <link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" />
        <script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!--        <script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.js"></script>-->
        <style>
            .scroll-top-wrapper {
                position: fixed;
                opacity: 1;
                visibility: hidden;
                overflow: hidden;
                text-align: center;
                z-index: 1;
                background-color: #B0BED9;
                background-repeat: no-repeat;
                color: #eeeeee;
                width: 30px;
                height: 30px;
                line-height: 28px;
                right: 10px;
                bottom: 10px;
                padding-top: 2px;
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
                border-bottom-right-radius: 30px;
                border-bottom-left-radius: 30px;
                -webkit-transition: all 0.5s ease-in-out;
                -moz-transition: all 0.5s ease-in-out;
                -ms-transition: all 0.5s ease-in-out;
                -o-transition: all 0.5s ease-in-out;
                transition: all 0.5s ease-in-out;
                right: 20px;
            }
            .scroll-top-wrapper:hover {
                background-color: #888888;
            }
            .scroll-top-wrapper.show {
                visibility:visible;
                cursor:pointer;
                opacity: 1.0;
            }
            .scroll-top-wrapper i.fa {
                line-height: inherit;
            }

        </style>
    </head>
    <!-- end: HEAD -->
    <body>
        <!-- start: HEADER -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <!-- start: TOP NAVIGATION CONTAINER -->
            <div class="container">
                <div class="navbar-header">
                    <!-- start: RESPONSIVE MENU TOGGLER -->
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="clip-list-2"></span>
                    </button>
                    <!-- end: RESPONSIVE MENU TOGGLER -->
                    <!-- start: LOGO -->
                    <img src='<?=base_url();?>assets/images/gpcomp-logo.png' width="100px" height="40px">

                    <!-- end: LOGO -->
                </div>
                <div class="navbar-tools">
                    <!-- start: TOP NAVIGATION MENU -->
                    <ul class="nav navbar-right">
                        <!-- start: USER DROPDOWN -->
                        <li class="dropdown current-user">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img src="<?php echo base_url();?>assets/images/media-user.png" class="circle-img" alt="">
                                <span class="username"><?=$username;?></span>
                                <i class="clip-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="pages_user_profile.html">
                                        <i class="clip-user-2"></i>
                                        &nbsp;My Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="pages_calendar.html">
                                        <i class="clip-calendar"></i>
                                        &nbsp;My Calendar
                                    </a>
                                <li>
                                    <a href="pages_messages.html">
                                        <i class="clip-bubble-4"></i>
                                        &nbsp;My Messages (3)
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="utility_lock_screen.html"><i class="clip-locked"></i>
                                        &nbsp;Lock Screen </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>logout">
                                        <i class="clip-exit"></i>
                                        &nbsp;Log Out
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end: USER DROPDOWN -->
                    </ul>
                    <!-- end: TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- end: TOP NAVIGATION CONTAINER -->
        </div>
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <div class="navbar-content">
                <!-- start: SIDEBAR -->
                <div class="main-navigation navbar-collapse collapse">
                    <!-- start: MAIN MENU TOGGLER BUTTON -->
                    <div class="navigation-toggler">
                        <i class="clip-chevron-left"></i>
                        <i class="clip-chevron-right"></i>
                    </div>
                    <!-- end: MAIN MENU TOGGLER BUTTON -->
                    <!-- start: MAIN NAVIGATION MENU -->
                    <ul class="main-navigation-menu">
                        <li <?php
                        if ($this->uri->segment(1) == "home") {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="<?php echo base_url();?>home"><i class="clip-home-3"></i>
                                <span class="title"> Dashboard </span><span class="selected"></span>
                            </a>
                        </li>
                        <li <?php
                        if ($this->uri->segment(1) == "master") {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="javascript:void(0)"><i class="clip-cog-2"></i>
                                <span class="title"> Master </span><i class="icon-arrow"></i>
                                <span class="selected"></span>
                            </a>
                            <ul class="sub-menu">
                                <li <?php
                                if ($this->uri->segment(2) == "category") {
                                    echo 'class="active"';
                                }
                                ?>>
                                    <a href="<?php echo base_url();?>master/category">
                                        <span class="title">Category</span>
                                    </a>
                                </li>
                                <li <?php
                                if ($this->uri->segment(2) == "produk") {
                                    echo 'class="active"';
                                }
                                ?>>
                                    <a href="<?php echo base_url();?>master/produk">
                                        <span class="title">Produk</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li <?php
                        if ($this->uri->segment(2) == "pembelian") {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="<?php echo base_url();?>transaksi/pembelian"><i class="fa fa-shopping-cart"></i>
                                <span class="title"> Pembelian </span><span class="selected"></span>
                            </a>
                        </li>
                        <li <?php
                        if ($this->uri->segment(2) == "penjualan") {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="<?php echo base_url();?>transaksi/penjualan"><i class="clip-cart"></i>
                                <span class="title"> Penjualan </span><span class="selected"></span>
                            </a>
                        </li>
                        <li <?php
                        if ($this->uri->segment(1) == "report") {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="<?php echo base_url();?>report"><i class="fa fa-bar-chart-o"></i>
                                <span class="title"> Report </span><span class="selected"></span>
                            </a>
                        </li>
                    </ul>
                    <!-- end: MAIN NAVIGATION MENU -->
                </div>
                <!-- end: SIDEBAR -->
            </div>
            <!-- start: PAGE -->
            <div class="main-content">

                <div class="container">
                    <!-- start: PAGE HEADER -->
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- start: PAGE TITLE & BREADCRUMB -->
                            <ol class="breadcrumb">
                                <li>
                                    <i class="clip-file"></i>
                                    <a href="#">
                                        Pages
                                    </a>
                                </li>
                                <li class="active">
                                    Blank Page
                                </li>
                                <li class="search-box">
                                    <form class="sidebar-search">
                                        <div class="form-group">
                                            <input type="text" placeholder="Start Searching...">
                                            <button class="submit">
                                                <i class="clip-search-3"></i>
                                            </button>
                                        </div>
                                    </form>
                                </li>
                            </ol>
                            <!--                            <div class="page-header">
                                                            <h1>Dashboard  <small>overview & stats</small></h1>
                                                        </div>-->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->
                    <?php $this->load->view($content);?>
                    <!-- end: PAGE CONTENT-->
                </div>
            </div>
            <!-- end: PAGE -->
        </div>
        <!-- end: MAIN CONTAINER -->
        <!-- start: FOOTER -->
        <div class="footer clearfix">
            <div class="footer-inner">
                2017 &copy; GP Comp All rights reserved.
            </div>

        </div>
        <a href="#index" class="scroll-top-wrapper">
            <span class="go-top"><i class="icon-arrow fa-chevron-up"></i></span>
        </a>

        <div class="scroll-top-wrapper ">
            <span class="scroll-top-inner">
                <i class="fa fa-arrow-up"></i>
            </span>
        </div>
        <!-- end: FOOTER -->
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/blockUI/jquery.blockUI.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/iCheck/jquery.icheck.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/nprogress/nprogress.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url();?>assets/js/main.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<!--        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>-->
        <script src="<?php echo base_url();?>assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/js/table-data.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

        <script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.categories.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.orderBars.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.pie.js"></script>


        <script src="<?php echo base_url();?>assets/js/charts.js"></script>
        <script src="<?php echo base_url();?>assets/js/index.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script>
            document.onreadystatechange = function () {
                if (document.readyState === "complete") {
                    console.log(document.readyState);
                    NProgress.done();
                } else {
                    NProgress.start();
                }
            }
        </script>
        <script>
            $(".go2top").hide();
            jQuery(document).ready(function () {
                Main.init();
                // TableData.init();

            });

            $(function () {
                $(document).on('scroll', function () {

                    if ($(window).scrollTop() > 100) {
                        $('.scroll-top-wrapper').addClass('show');
                    } else {
                        $('.scroll-top-wrapper').removeClass('show');
                    }
                });

                $('.scroll-top-wrapper').on('click', scrollToTop);
            });

            function scrollToTop() {
                verticalOffset = typeof (verticalOffset) != 'undefined' ? verticalOffset : 0;
                element = $('body');
                offset = element.offset();
                offsetTop = offset.top;
                $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
            }

        </script>
    </body>
</html>
