<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Apostas Online | @yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="description" content="Outline Admin Theme">

        @section('css')
        {{-- <link type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,600'
              rel='stylesheet'>--}}

        <link type="text/css" href="{{ asset('/assets/fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link type="text/css" href="{{ asset('/assets/fonts/themify-icons/themify-icons.css')}}" rel="stylesheet">
        <!-- Themify Icons -->
        <link type="text/css" href="{{ asset('/assets/fonts/weather-icons/css/weather-icons.min.css')}}"
              rel="stylesheet">
        <!-- Weather Icons -->

        <link rel="stylesheet" href="{{ asset('/assets/css/styles-alternative.css')}}" id="theme">
        <!-- Default CSS: Altenate Style -->
        <link rel="prefetch alternate stylesheet" href="{{ asset('/assets/css/styles.css')}}">
        <!-- Prefetched Secondary Style -->

        <link type="text/css" href="{{ asset('/assets/plugins/codeprettifier/prettify.css')}}" rel="stylesheet">
        <!-- Code Prettifier -->
        <link type="text/css" href="{{ asset('/assets/plugins/iCheck/skins/minimal/blue.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('/assets/plugins/switchery/switchery.css')}}" rel="stylesheet">
        <link href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css">
        <link type="text/css" src="{{ asset('/assets/plugins/zTree/jquery.tree.css')}}">
        <link type="text/css" href="{{ asset('/css/bootstrapValidation.mim.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('/css/jquery.datetimepicker.css')}}" rel="stylesheet"/>

        <!-- iCheck -->

        <!-- datatables -->
        {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">--}}
        <link type="text/css" href="{{ asset('/assets/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('/assets/plugins/datatables/dataTables.themify.css')}}" rel="stylesheet">


        <!--[if lt IE 10]>
        <script type="text/javascript" src="{{ asset('/assets/js/media.match.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/js/respond.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/js/placeholder.min.js')}}"></script>
        <![endif]-->

        @show

    </head>

    <body class="animated-content">
        {{-- dashboard --}}
        <div class="extrabar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <div class="info-tile info-tile-alt tile-warning">
                            <div class="tile-icon"><i class="ti ti-eye"></i></div>
                            <div class="tile-heading"><span>Page Views</span></div>
                            <div class="tile-body"><span>1,600</span></div>
                            <div class="tile-footer"><span class="text-danger">-7.6% <i class="ti ti-arrow-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="info-tile info-tile-alt tile-success">
                            <div class="tile-icon"><i class="ti ti-thumb-up"></i></div>
                            <div class="tile-heading"><span>Likes</span></div>
                            <div class="tile-body"><span>345</span></div>
                            <div class="tile-footer"><span class="text-success">+15.4% <i class="ti ti-arrow-up"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="info-tile info-tile-alt tile-danger">
                            <div class="tile-icon"><i class="ti ti-check-box"></i></div>
                            <div class="tile-heading"><span>Bugs Fixed</span></div>
                            <div class="tile-body"><span>21</span></div>
                            <div class="tile-footer"><span class="text-success">+10.4% <i class="ti ti-arrow-up"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="info-tile info-tile-alt tile-info">
                            <div class="tile-icon"><i class="ti ti-user"></i></div>
                            <div class="tile-heading"><span>New Members</span></div>
                            <div class="tile-body"><span>124</span></div>
                            <div class="tile-footer"><span class="text-danger">-25.4% <i class="ti ti-arrow-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="info-tile info-tile-alt tile-teal">
                            <div class="tile-icon"><i class="ti ti-gift"></i></div>
                            <div class="tile-heading"><span>Gifts</span></div>
                            <div class="tile-body"><span>16</span></div>
                            <div class="tile-footer"><span class="text-danger">-7.6% <i class="ti ti-arrow-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="info-tile info-tile-alt tile-indigo">
                            <div class="tile-icon"><i class="ti ti-menu-alt"></i></div>
                            <div class="tile-heading"><span>Tasks</span></div>
                            <div class="tile-body"><span>17</span></div>
                            <div class="tile-footer"><span class="text-danger">-26.4% <i class="ti ti-arrow-down"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="extrabar-underlay"></div>

        <header id="topnav" class="navbar navbar-teal navbar-fixed-top">

            {{-- logo-area --}}
            <div class="logo-area">
                <span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
                    <a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
                        <span class="icon-bg">
                            <i class="ti ti-shift-left"></i>
                        </span>
                    </a>
                </span>

                <a class="navbar-brand" href="index.html">Apostas Online+</a>

                <div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
                    <div class="input-icon">
                        <i class="ti ti-search search"></i>
                        <input type="text" placeholder="Type to search..." class="form-control" tabindex="1">
                        <i class="ti ti-close remove"></i>
                    </div>
                </div>
            </div><!-- logo-area -->


            {{-- Dropdowns do menu do topo --}}
            <div class="yamm navbar-left navbar-collapse collapse in">
                <ul class="nav navbar-nav">
                    <li class="dropdown" id="widget-classicmenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas/Relatórios<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('betting.report.reportVendasView') }} ">Vendas</a></li>
                            {{--<li class="divider"></li>--}}
                        </ul>
                    </li>
                    {{--<li><a href="">Another Link</a></li>--}}
                </ul>
            </div>


            {{-- Opções direitas do menu do topo --}}
            <ul class="nav navbar-nav toolbar pull-right">

                <li class="toolbar-icon-bg hidden-xs" id="trigger-extrabar">
                    <a href="#"><span class="icon-bg"><i class="ti ti-view-grid"></i></span></a>
                </li>

                <li class="toolbar-icon-bg hidden-xs" id="trigger-fullscreen">
                    <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span></a>
                </li>

                {{-- Notificações --}}
                {{--<li class="dropdown toolbar-icon-bg">
                    <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i
                                class="ti ti-bell"></i></span><span class="badge badge-deeporange">2</span></a>
                    <div class="dropdown-menu notifications arrow">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="scroll-pane">
                            <ul class="media-list scroll-content">
                                <li class="media notification-success">
                                    <a href="#">
                                        <div class="media-left">
                                            <span class="notification-icon"><i class="ti ti-pencil"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="notification-heading">Profile page has been updated</h4>
                                            <span class="notification-time">12 mins ago</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#">See all notifications</a>
                        </div>
                    </div>
                </li>--}}

                {{-- Menu do usuário --}}
                <li class="dropdown toolbar-icon-bg">
                    <a href="#" class="dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-user"></i></span></i>
                    </a>
                    <ul class="dropdown-menu userinfo arrow">
                        {{--<li><a href="#/"><i class="ti ti-user"></i><span>Profile</span><span
                                class="badge badge-info pull-right">73%</span></a></li>--}}
                        {{--<li><a href="#/"><i class="ti ti-settings"></i><span>Settings</span></a></li>
                        <li><a href="#/"><i class="ti ti-help-alt"></i><span>Help</span></a></li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li><a href="#/"><i class="ti ti-view-list-alt"></i><span>Statement</span></a></li>
                        <li><a href="#/"><i class="ti ti-stats-up"></i><span>Earnings</span></a></li>
                        <li><a href="#/"><i class="ti ti-money"></i><span>Withdrawals</span></a></li>--}}
                        <li class="divider"></li>
                        <li><a href="{{ url('auth/logout') }}"><i class="ti ti-shift-right"></i><span>Sair</span></a></li>
                    </ul>
                </li>
            </ul>
        </header>

        <div id="wrapper">
            <div id="layout-static">
                <div class="static-sidebar-wrapper sidebar-bluegray">
                    <div class="static-sidebar">
                        <div class="sidebar">
                            <div class="widget">
                                <div class="widget-body">
                                    <div class="userinfo">
                                        <div class="avatar">
                                            <img src="{{asset('/img/profile_small.jpg')}}"
                                                 class="img-responsive img-circle">
                                        </div>
                                        <div class="info">
                                            <span class="username">Glen Maxwell</span>
                                            <span class="useremail">glen@outline.com</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- menu lateral --}}
                            <div class="widget stay-on-collapse" id="widget-sidebar">
                                <nav class="widget-body">
                                    <ul class="acc-menu">
                                        <li class="nav-separator"><span>Menu</span></li>
                                        {{--<li><a href="{{ route('betting.area.index') }} "><i class="ti ti-shield"></i><span>Dashboard</span></a></li>--}}
                                        <li><a href="{{ route('betting.parametro.save') }} "><i class="ti ti-settings"></i><span>Parâmetros</span></a></li>
                                        <li><a href="{{ route('betting.area.index') }} "><i class="ti  ti-location-pin"></i><span>Áreas</span></a></li>
                                        <li><a href="{{ route('betting.vendedor.index') }} "><i class="ti ti-user"></i><span>Vendedores</span></a></li>
                                        <li><a href="{{ route('betting.partidas.index') }} "><i class="ti  ti-clipboard"></i><span>Partidas</span></a></li>
                                        <li><a href="{{ route('betting.gols.index') }} "><i class="ti  ti-clipboard"></i><span>Resultados</span></a></li>
                                        <li><a href="{{ route('betting.modalidades.index') }} "><i class="ti ti-control-play"></i><span>Modalidades</span></a></li>
                                        <li><a href="{{ route('betting.cotacoes.index') }} "><i class="ti ti-control-play"></i><span>Cotações</span></a></li>
                                        <li>
                                            <a href="javascript:;"><i class="ti ti-files"></i><span>Consultas/Relatórios</span></a>
                                            <ul class="acc-menu">
                                                <li><a href="{{ route('betting.report.reportVendasView') }} ">Vendas</a></li>
                                            </ul>
                                        </li>
                                        {{-- menu extras --}}
                                        {{--<li class="nav-separator"><span>Extras</span></li>
                                <li><a href="app-inbox.html"><i class="ti ti-email"></i><span>Inbox</span><span
                                                class="badge badge-danger">3</span></a></li>
                                <li><a href="extras-calendar.html"><i
                                                class="ti ti-calendar	"></i><span>Calendar</span>
                                        <span class="badge badge-orange">1</span></a></li>
                                --}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="static-content-wrapper">
                    <div class="static-content">
                        <div class="page-content">
                            <div class="page-heading">
                                @yield('page-heading')
                                {{--<div class="btn-group pull-right">
                            <a href="#" class="btn btn-default">Settings</a>
                            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false"><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>--}}
                            </div>
                            <div class="container-fluid">

                                @yield('container')

                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>
                    <footer>
                        <div class="clearfix">
                            <ul class="list-unstyled list-inline pull-left">
                                <li><h6 style="margin: 0;">&copy; 2015 KaijuThemes</h6></li>
                            </ul>
                            <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i
                                    class="ti ti-arrow-up"></i></button>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        <!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

        @section('js')
        <script type="text/javascript" src="{{ asset('/assets/js/jquery-1.10.2.min.js')}}"></script>
        <!-- Load jQuery -->
        <script type="text/javascript" src="{{ asset('/assets/js/jqueryui-1.10.3.min.js')}}"></script>
        <!-- Load jQueryUI -->
        <script type="text/javascript" src="{{ asset('/assets/js/bootstrap.min.js')}}"></script>
        <!-- Load Bootstrap -->
        <script type="text/javascript" src="{{ asset('/assets/js/enquire.min.js')}}"></script>
        <!-- Load Enquire -->

        <script type="text/javascript" src="{{ asset('/assets/plugins/velocityjs/velocity.min.js')}}"></script>
        <!-- Load Velocity for Animated Content -->
        <script type="text/javascript" src="{{ asset('/assets/plugins/velocityjs/velocity.ui.min.js')}}"></script>

        <script type="text/javascript" src="{{ asset('/assets/plugins/wijets/wijets.js')}}"></script>
        <!-- Wijet -->

        <script type="text/javascript" src="{{ asset('/assets/plugins/codeprettifier/prettify.js')}}"></script>
        <!-- Code Prettifier  -->
        <script type="text/javascript" src="{{ asset('/assets/plugins/bootstrap-switch/bootstrap-switch.js')}}"></script>
        <!-- Swith/Toggle Button -->

        <script type="text/javascript"
        src="{{ asset('/assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js')}}"></script>
        <!-- Bootstrap Tabdrop -->

        <script type="text/javascript" src="{{ asset('/assets/plugins/iCheck/icheck.min.js')}}"></script>
        <!-- iCheck -->

        <script type="text/javascript"
        src="{{ asset('/assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js')}}"></script>
        <!-- nano scroller -->
        <script type="text/javascript"
        src="{{ asset('/assets/plugins/jquery-mousewheel/jquery.mousewheel.min.js')}}"></script>
        <!-- Mousewheel support needed for Mapael -->

        <script type="text/javascript" src="{{ asset('/assets/plugins/sparklines/jquery.sparklines.min.js')}}"></script>
        <!-- Sparkline -->

        <script type="text/javascript" src="{{ asset('/assets/js/application.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/demo/demo.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/demo/demo-switcher.js')}}"></script>

        {{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
         <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>--}}
        <script type="text/javascript" src="{{ asset('/assets/plugins/datatables/jquery.dataTables.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>

        <!-- Rotas para javascript -->
        <script type="text/javascript" src="{{ asset('/js/laroute.js') }}"></script>

        <!-- plugins adicionais -->
        <script type="text/javascript" src="{{ asset('/assets/plugins/switchery/switchery.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/demo/demo-formcomponents.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/plugins/form-jasnyupload/fileinput.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/plugins/zTree/jquery.tree.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/plugins/form-inputmask/jquery.inputmask.bundle.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/plugins/bootbox/bootbox.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/js/jquery.datetimepicker.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/js/jquery.mask.js')}}"></script>
        <script type="text/javascript" src="{{asset('/js/jquery.validate.js')}}"></script>
        <script src="{{ asset('/js/bootstrapvalidator.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('/js/mascaras.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/js/scripts_api.js')}}"></script>
        <script type="text/javascript">
            $(function() {
                $('.mask').inputmask();
            });
        </script>
        @show


    </body>
</html>
