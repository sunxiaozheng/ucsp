<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- Basic -->
        <meta charset="UTF-8" />

        <title>排课系统</title>

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- start: CSS file-->

        <!-- Vendor CSS-->
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendor/skycons/css/skycons.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />

        <!-- Plugins CSS-->		
        <link href="{{ asset('plugins/bootkit/css/bootkit.css') }}" rel="stylesheet" />	
        <link href="{{ asset('plugins/scrollbar/css/mCustomScrollbar.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/jquery-ui/css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/xcharts/css/xcharts.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/morris/css/morris.css') }}" rel="stylesheet" />

        <!-- Theme CSS -->
        <link href="{{ asset('css/backend/jquery.mmenu.css') }}" rel="stylesheet" />

        <!-- Page CSS -->		
        <link href="{{ asset('css/backend/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/backend/add-ons.min.css') }}" rel="stylesheet" />

        <!-- end: CSS file-->	


        <!-- Head Libs -->
        <script src="{{ asset('plugins/modernizr/js/modernizr.js') }}"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->		

    </head>

    <body>

        <!-- Start: Header -->
        <div class="navbar" role="navigation">
            <div class="container-fluid container-nav">				
                <!-- Navbar Action -->
                <ul class="nav navbar-nav navbar-actions navbar-left">
                    <li class="visible-md visible-lg"><a href="#" id="main-menu-toggle"><i class="fa fa-th-large"></i></a></li>
                    <li class="visible-xs visible-sm"><a href="#" id="sidebar-menu"><i class="fa fa-navicon"></i></a></li>			
                </ul>
                <!-- Navbar Left -->
                <div class="navbar-left">
                    <!-- Search Form -->					
                    <form class="search navbar-form">
                        <div class="input-group input-search">
                            <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>						
                    </form>
                </div>
                <!-- Navbar Right -->
                <div class="navbar-right">
                    <!-- Notifications -->

                    <!-- End Notifications -->
                    <!-- Userbox -->
                    <div class="userbox">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="profile-info">
                                <span class="name">设置</span>
                            </div>			
                            <i class="fa custom-caret"></i>
                        </a>
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="dropdown-menu-header bk-bg-white bk-margin-top-15">						
                                    <a href="{{ url('/admin/logout') }}"><i class="fa fa-power-off"></i> 退出</a>						
                                </li>	
                            </ul>
                        </div>						
                    </div>
                    <!-- End Userbox -->
                </div>
                <!-- End Navbar Right -->
            </div>		
        </div>
        <!-- End: Header -->
        <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >企业网站模板</a></div>
        <!-- Start: Content -->
        <div class="container-fluid content">	
            <div class="row">

                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="sidebar-collapse">
                        <!-- Sidebar Header Logo-->
                        <div class="sidebar-header">
                            <img src="{{ asset('imgs/backend/logo.png') }}" class="img-responsive" alt="" />
                        </div>
                        <!-- Sidebar Menu-->
                        <div class="sidebar-menu">						
                            <nav id="menu" class="nav-main" role="navigation">
                                <ul class="nav nav-sidebar">
                                    <div class="panel-body text-center">								
                                        <div class="bk-avatar">
                                            <img src="{{ asset('imgs/backend/avatar.jpg') }}" class="img-circle bk-img-60" alt="" />
                                        </div>
                                        <div class="bk-padding-top-10">
                                            <i class="fa fa-circle text-success"></i> <small>{{ $username }}</small>
                                        </div>
                                    </div>
                                    <div class="divider2"></div>
                                    <li class="active">
                                        <a href="{{ url('/admin/login') }}">
                                            <i class="fa fa-home" aria-hidden="true"></i><span>主界面</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/admin/setclass') }}">
                                            <i class="fa fa-laptop" aria-hidden="true"></i><span>设置班级</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/admin/setcourse') }}">
                                            <i class="fa fa-table" aria-hidden="true"></i><span>设置课时</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/admin/setsubject') }}">
                                            <i class="fa fa-calendar" aria-hidden="true"></i><span>科目节数</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/admin/setteacher') }}">
                                            <i class="fa fa-tasks" aria-hidden="true"></i><span>教师任课</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/admin/startclass') }}">
                                            <i class="fa fa-bolt" aria-hidden="true"></i><span>开始排课</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-life-bouy" aria-hidden="true"></i><span>打开课程表</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li><a href="icons-font-awesome.html"><span class="text"> Font Awesome</span></a></li>
                                            <li><a href="icons-weathericons.html"><span class="text"> Weather Icons</span></a></li>
                                            <li><a href="icons-glyphicons.html"><span class="text"> Glyphicons</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- End Sidebar Menu-->
                    </div>
                    <!-- Sidebar Footer-->
                    <div class="sidebar-footer">	
                        <ul class="sidebar-terms">
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">About</a></li>
                        </ul>
                        <div class="copyright text-center">
                            <small>Nadhif <i class="fa fa-coffee"></i> Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a> - More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a></small>
                        </div>					
                    </div>
                    <!-- End Sidebar Footer-->
                </div>
                <!-- End Sidebar -->

                <!-- Main Page -->
                <div class="main ">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="pull-left">
                            <ol class="breadcrumb visible-sm visible-md visible-lg">								
                                <li><a href="#"><i class="icon fa fa-home"></i>@yield('category-title')</a></li>
                            </ol>						
                        </div>
                    </div>
                    <!-- End Page Header -->								
                    <div class="row">
                        @yield('content')
                    </div>
                    <!-- End Main Page -->			

                </div>
            </div><!--/container-->

            <!-- Modal Dialog -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title bk-fg-primary">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <p class="bk-fg-danger">Here settings can be configured...</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal Dialog -->		

            <div class="clearfix"></div>		


            <!-- start: JavaScript-->

            <!-- Vendor JS-->				
            <script src="{{ asset('vendor/js/jquery.min.js') }}"></script>
            <script src="{{ asset('vendor/js/jquery-2.1.1.min.js') }}"></script>
            <script src="{{ asset('vendor/js/jquery-migrate-1.2.1.min.js') }}"></script>
            <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('vendor/skycons/js/skycons.js') }}"></script>		

            <!-- Plugins JS-->		
            <script src="{{ asset('plugins/jquery-ui/js/jquery-ui-1.10.4.min.js') }}"></script>
            <script src="{{ asset('plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
            <script src="{{ asset('plugins/bootkit/js/bootkit.js') }}"></script>
            <script src="{{ asset('plugins/moment/js/moment.min.js') }}"></script>	
            <script src="{{ asset('plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>
            <script src="{{ asset('plugins/touchpunch/js/jquery.ui.touch-punch.min.js') }}"></script>
            <script src="{{ asset('plugins/flot/js/jquery.flot.min.js') }}"></script>
            <script src="{{ asset('plugins/flot/js/jquery.flot.pie.min.js') }}"></script>
            <script src="{{ asset('plugins/flot/js/jquery.flot.resize.min.js') }}"></script>
            <script src="{{ asset('plugins/flot/js/jquery.flot.stack.min.js') }}"></script>
            <script src="{{ asset('plugins/flot/js/jquery.flot.time.min.js') }}"></script>
            <script src="{{ asset('plugins/xcharts/js/xcharts.min.js') }}"></script>
            <script src="{{ asset('plugins/autosize/jquery.autosize.min.js') }}"></script>
            <script src="{{ asset('plugins/placeholder/js/jquery.placeholder.min.js') }}"></script>
            <script src="{{ asset('plugins/datatables/js/dataTables.bootstrap.min.js') }}"></script>
            <script src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('plugins/raphael/js/raphael.min.js') }}"></script>
            <script src="{{ asset('plugins/morris/js/morris.min.js') }}"></script>
            <script src="{{ asset('plugins/gauge/js/gauge.min.js') }}"></script>		
            <script src="{{ asset('plugins/d3/js/d3.min.js') }}"></script>		
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

            <!-- Theme JS -->		
            <script src="{{ asset('js/backend/jquery.mmenu.min.js') }}"></script>
            <script src="{{ asset('js/backend/core.min.js') }}"></script>

            <!-- Pages JS -->
            <script src="{{ asset('js/backend/pages/index.js') }}"></script>

            <!-- Vue JS -->
            <script src="{{ asset('js/app.js') }}"></script>

            <!-- end: JavaScript-->
            <script type="text/javascript">
var exampleVM2 = new Vue({
    el: '#example-2',
    data: {
        greeting: true
    }
})
            </script>
    </body>

</html>