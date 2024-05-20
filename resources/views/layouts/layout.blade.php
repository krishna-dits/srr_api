<?php $general_details = DB::table('settings')->first();
$login_details = DB::table('users')->where('id', Auth::id())->where('is_active', '1')->first();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Mirrored from laravel.spruko.com/admitro/Vertical-IconSidedar-Light/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Nov 2021 07:28:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->


<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <!-- Title -->
    <title>{{ @$general_details->software_name }}</title>

    <!--Favicon -->
    <link rel="icon" href="{{ asset('public/assets/images/brand') }}/{{ @$general_details->small_logo }}"
        type="image/x-icon" />

    <!--Bootstrap css -->
    <link href="{{ asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('public/assets/css/animated.css') }}" rel="stylesheet" />

    <!--Sidemenu css -->
    <link href="{{ asset('public/assets/css/sidemenu.css') }}" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="{{ asset('public/assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet" />

    <!-- Data table css -->
    <link href="{{ asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/plugins/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <!-- Slect2 css -->
    <link href="{{ asset('public/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />


    <!-- Simplebar css -->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/simplebar/css/simplebar.css') }}">

    <!-- Color Skin css -->
    <link id="theme" href="{{ asset('public/assets/colors/color1.css') }}" rel="stylesheet" type="text/css" />

    <!-- Switcher css -->
    <link rel="stylesheet" href="{{ asset('public/assets/switcher/css/switcher.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/switcher/demo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="app sidebar-mini">
    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ asset('public/assets/images/svgs/loader.svg') }}" alt="loader">
    </div>
    <div class="page">
        <div class="page-main">
            <!-- ====================================navbar start=============================== -->
            <div id="header-area" class="header_area">
                <div class="header_bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <nav role="navigation" class="navbar navbar-expand-sm navbar-default navbar-light mainmenu">
                                <img src="{{ asset('public/assets/images/brand/utkarsh-white-logo.png') }}"
                                    alt="logo" class="sitelogo_design" id="mobile_logo" style="color: white;">
                                <div class="navbar-header">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarCollapse" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                                <!-- Collection of nav links and other content for toggling -->
                                <div id="navbarCollapse" class="collapse navbar-collapse topheader_backarea">
                                    <img src="{{ asset('public/assets/images/brand/utkarsh-white-logo.png') }}"
                                        alt="logo" class="sitelogo_design" id="desktop_logo" style="color: white;">
                                    <ul id="fresponsive" class="nav navbar-nav dropdown">
                                        <li>
                                            <a href="{{ route('dashboard') }}">
                                                {{--  <i class="fas fa-home topheadermenu_icon"></i>  --}}
                                                <img src="{{ asset('public/assets/images/brand/dashboard (2).png') }}"
                                                    alt="img">
                                                Dashboard
                                            </a>
                                        </li>

                                        @if (auth()->user()->can('User'))
                                            <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle">
                                                    {{--  <i class="fas fa-user topheadermenu_icon"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/user (4).png') }}"
                                                        alt="img">
                                                    Manage User
                                                    <span class="caret"></span>
                                                </a>
                                                <ul class=" dropdown-menu">
                                                    @if (auth()->user()->can('User List'))
                                                        <li>
                                                            <a href="{{ route('user-list') }}"
                                                                class="navdropdwn_menuztext"><i
                                                                    class="fas fa-caret-right"></i>&nbsp;&nbsp;User
                                                                List</a>
                                                        </li>
                                                    @endif
                                                    @if (auth()->user()->can('User Add'))
                                                        <li>
                                                            <a href="{{ route('UserCreate') }}"
                                                                class="navdropdwn_menuztext"><i
                                                                    class="fas fa-caret-right"></i>&nbsp;&nbsp;Add New
                                                                User</a>
                                                        </li>
                                                    @endif

                                                </ul>
                                            </li>
                                        @endif

                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle">
                                                {{--  <i class="fas fa-cog topheadermenu_icon"></i>  --}}
                                                <img src="{{ asset('public/assets/images/brand/settings (2).png') }}"
                                                    alt="img">
                                                Setup
                                                <span class="caret"></span>
                                            </a>
                                            <ul class=" dropdown-menu">
                                                @if (auth()->user()->can('General Setting'))
                                                    <li>
                                                        <a href="{{ route('general_setting_details') }}"
                                                            class="navdropdwn_menuztext"><i
                                                                class="fas fa-caret-right"></i>&nbsp;&nbsp;General
                                                            Setting</a>
                                                    </li>
                                                @endif

                                            </ul>
                                        </li>

                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle">
                                                {{--  <i class="fas fa-cog topheadermenu_icon"></i>  --}}
                                                <img src="{{ asset('public/assets/images/brand/file.png') }}"
                                                    alt="img">
                                                Task
                                                <span class="caret"></span>
                                            </a>
                                            <ul class=" dropdown-menu">
                                                {{-- <li>
                                                    <a href="{{ route('category') }}" class="navdropdwn_menuztext"><i
                                                            class="fas fa-caret-right"></i>&nbsp;&nbsp;Task
                                                        Category</a>
                                                </li> --}}
                                                <li>
                                                    <a href="{{ route('my_task') }}" class="navdropdwn_menuztext"><i
                                                            class="fas fa-caret-right"></i>&nbsp;&nbsp;My Task</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('create_task') }}"
                                                        class="navdropdwn_menuztext"><i
                                                            class="fas fa-caret-right"></i>&nbsp;&nbsp;Create
                                                        Task</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('task_list') }}"
                                                        class="navdropdwn_menuztext"><i
                                                            class="fas fa-caret-right"></i>&nbsp;&nbsp;Task
                                                        List</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('my_archive_task') }}"
                                                        class="navdropdwn_menuztext"><i
                                                            class="fas fa-caret-right"></i>&nbsp;&nbsp;My Archive
                                                        Task</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('my_issue') }}" class="navdropdwn_menuztext"><i
                                                            class="fas fa-caret-right"></i>&nbsp;&nbsp;My Issue</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('issue_list') }}" class="navdropdwn_menuztext"><i
                                                            class="fas fa-caret-right"></i>&nbsp;&nbsp;Issue List</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle">
                                                {{--  <i class="fas fa-file topheadermenu_icon"></i>  --}}
                                                <img src="{{ asset('public/assets/images/brand/file.png') }}"
                                                    alt="img">Leave
                                                <span class="caret"></span>
                                            </a>
                                            <ul class=" dropdown-menu">
                                                <li>
                                                    <a href="{{ route('all_leaves') }}"
                                                        class="navdropdwn_menuztext"><i
                                                            class="fas fa-caret-right"></i>&nbsp;&nbsp;All Leaves</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('apply_leave') }}"
                                                        class="navdropdwn_menuztext"><i
                                                            class="fas fa-caret-right"></i>&nbsp;&nbsp;Apply Leave</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('my_leaves') }}"
                                                        class="navdropdwn_menuztext"><i
                                                            class="fas fa-caret-right"></i>&nbsp;&nbsp;My Leaves</a>
                                                </li>
                                            </ul>
                                        </li>


                                        @if (auth()->user()->can('User'))
                                            <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle">
                                                    {{--  <i class="fas fa-user topheadermenu_icon"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/project-manager.png') }}"
                                                        alt="img">
                                                    Role & Permission
                                                    <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @can('view role')
                                                        <li>
                                                            <a href="{{ route('roleList') }}"
                                                                class="navdropdwn_menuztext"><i
                                                                    class="fas fa-caret-right"></i>&nbsp;&nbsp;Role</a>
                                                        </li>
                                                    @endcan

                                                    @can('view permission')
                                                        <li>
                                                            <a href="{{ route('PermissionList') }}"
                                                                class="navdropdwn_menuztext"><i
                                                                    class="fas fa-caret-right"></i>&nbsp;&nbsp;Permission</a>
                                                        </li>
                                                    @endcan

                                                </ul>
                                            </li>
                                        @endif

                                        <li>
                                            <a href="{{ route('dashboard') }}">
                                                {{--  <i class="fas fa-home topheadermenu_icon"></i>  --}}
                                                <img src="{{ asset('public/assets/images/brand/dashboard (2).png') }}"
                                                    alt="img">
                                                Notes
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="userprofile_icon" id="usertop_area">
                                    <img class="menwork_design"
                                        src="{{ asset('public/assets/images/brand/add-friend.png') }}"
                                        alt="img">
                                    <div class="userdetails_area" id="userdown_area">
                                        <i class="fas fa-chevron-up chvrntop_design"></i>
                                        <h2 class="usertext_namedesign">

                                        </h2>
                                        <h6 class="userdesignation_textdesign">

                                        </h6>
                                        <hr class="gaparea">
                                        <ul class="useranother_listarea">
                                            <li>
                                                <a
                                                    href="{{ route('user-profile') }}/{{ base64_encode(Auth::id()) }}">
                                                    <i class="fas fa-user"></i>
                                                    Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('change-password') }}">
                                                    <i class="fas fa-lock-open"></i>
                                                    Change Password
                                                </a>
                                            </li>
                                            <li>
                                                <i class="fas fa-sign-in-alt"></i>
                                                <form id="logout_form" method="POST"
                                                    action="{{ route('logout') }}">
                                                    @csrf

                                                    <div onclick="document.getElementById('logout_form').submit();">
                                                        Sign
                                                        Out</div>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ====================================navbar start=============================== -->
            <div class="row">
                @yield('content')
            </div>
        </div>
        <!--Footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © 2022 <a href="#">{{ @$general_details->software_name }}</a>. Designed by <a
                            href="https://devantitsolutions.com/" target="_blank">Devant IT Solutions Pvt. Ltd.</a>
                        All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->
    </div><!-- End Page -->
    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fe fe-chevrons-up"></i></a>

    {{-- <script type="text/javascript">
        function get_all_item_result() {
            $('#search_result_for_item').empty();
            var item_search_name = $('#item_entry_reslt').val();
            if (item_search_name != '') {
                var div_data_serch_res = '';
                console.log(item_search_name);
                $.ajax({

                    url: "{{ route('get-item-serach') }}",
    type: "post",
    data: {
    item__id: item_search_name,
    _token: '{{ csrf_token() }}',
    },
    dataType: 'json',
    success: function(res) {
    console.log(res);
    $.each(res, function(i, obj) {
    div_data_serch_res +=
    '<a class="dropdown-item" href="{{ url('
                            item - serach - result ') }}/' + obj
                                .item_id + '">' + obj.item_name + '(' + obj.part_no + ')(' + obj
        .item_description + ')</a>';

    });

    $('#search_result_for_item').html(div_data_serch_res);

    }
    });
    }
    }
    </script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        setTimeout(function() {
            var div = document.getElementById("attendence_modal");
            div.parentNode.removeChild(div);
        }, 10000); // 30 seconds in milliseconds
    </script>




    <!-- Jquery js-->
    <script src="{{ asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>

    <!-- Bootstrap4 js-->
    <script src="{{ asset('public/assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--Othercharts js-->
    <script src="{{ asset('public/assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

    <!-- Circle-progress js-->
    <script src="{{ asset('public/assets/js/circle-progress.min.js') }}"></script>

    <!-- Jquery-rating js-->
    <script src="{{ asset('public/assets/plugins/rating/jquery.rating-stars.js') }}"></script>

    <!--Sidemenu js-->
    <script src="{{ asset('public/assets/plugins/sidemenu/sidemenu.js') }}"></script>

    <!-- P-scroll js-->
    <script src="{{ asset('public/assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/p-scrollbar/p-scroll.js') }}"></script>


    <!--INTERNAL Peitychart js-->
    <script src="{{ asset('public/assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/peitychart/peitychart.init.js') }}"></script>

    <!--INTERNAL Apexchart js-->
    <script src="{{ asset('public/assets/js/apexcharts.js') }}"></script>

    <!--INTERNAL ECharts js-->
    <script src="{{ asset('public/assets/plugins/echarts/echarts.js') }}"></script>

    <!--INTERNAL Chart js -->
    <script src="{{ asset('public/assets/plugins/chart/chart.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/chart/utils.js') }}"></script>

    <!-- INTERNAL Select2 js -->
    <script src="{{ asset('public/assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/select2.js') }}"></script>

    <!--INTERNAL Moment js-->
    <script src="{{ asset('public/assets/plugins/moment/moment.js') }}"></script>

    <!--INTERNAL Index js-->
    <script src="{{ asset('public/assets/js/index1.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('public/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <!-- Custom js-->
    <script src="{{ asset('public/assets/js/custom.js') }}"></script>

    <!-- INTERNAL Data tables -->
    <script src="{{ asset('public/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/datatables.js') }}"></script>

    <script src="{{ asset('public/assets/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public/assets/js/flot.js') }}"></script>



    <!-- Switcher js-->
    <script src="{{ asset('public/assets/switcher/js/switcher.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('public/assets/plugins/notify/js/notifIt.js') }}"></script>


    <script>
        (function($) {
            $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
                if (!$(this).next().hasClass('show')) {
                    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                }
                var $subMenu = $(this).next(".dropdown-menu");
                $subMenu.toggleClass('show');

                $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                    $('.dropdown-submenu .show').removeClass("show");
                });

                return false;
            });
        })(jQuery)
    </script>

    <script>
        $(document).ready(function() {
            $("#usertop_area").click(function() {
                $("#userdown_area").toggle();
            });
        });
    </script>
</body>
<!-- Mirrored from laravel.spruko.com/admitro/Vertical-IconSidedar-Light/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Nov 2021 07:29:24 GMT -->

</html>
