@inject('notications',App\Notification')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <title>@yield('title') _CRM客户管理系统</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/adminlte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/fonts/css/font-awesome.min.css">
    <link rel="stylesheet" href="/adminlte/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/skins/_all-skins.min.css">
    @yield('headlibs')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/admin/index" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>Y</b>SG</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>YSG</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">{{count($notications->ReceivedNotications())}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">你有{{count($notications->ReceivedNotications())}}个客户领取通知</li>
                            <li>
                                <ul class="menu">
                                    @foreach($notications->ReceivedNotications() as $receivednotication)
                                        @if($loop->index>6)
                                            @break
                                        @endif
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src=" /AdminLTE/dist/img/user4-128x128.jpg " class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        数据领取通知
                                                        <small><i class="fa fa-clock-o"></i>{{\Carbon\Carbon::parse($receivednotication->created_at)->diffForHumans()}}</small>
                                                    </h4>
                                                    <p>{{$receivednotication->data['name']}}--{{$receivednotication->data['phone']}}已领取</p>
                                                </a>
                                            </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer"><a href="/notification/clear">清除所有消息通知</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">{{count($notications->ReturnedNotications())}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">你有{{count($notications->ReturnedNotications())}}个退单通知</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">

                                    @foreach($notications->ReturnedNotications() as $returnednotication)
                                        @if($loop->index>6)
                                            @break
                                        @endif
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i>{{$returnednotication['phone']}}---{{$returnednotication['drainreason']}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer"><a href="/notification/clear">清除所有消息通知</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown  messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">{{count($notications->VisitedNotications())}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">你有{{count($notications->VisitedNotications())}}个门店接待通知</li>
                            <li>
                                <ul class="menu">
                                    @foreach($notications->VisitedNotications() as $visitednotication)
                                        @if($loop->index>6)
                                            @break
                                        @endif
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src=" /AdminLTE/dist/img/user4-128x128.jpg " class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    门店接待通知
                                                    <small><i class="fa fa-clock-o"></i>{{\Carbon\Carbon::parse($visitednotication->created_at)->diffForHumans()}}</small>
                                                </h4>
                                                <p>{{$visitednotication->data['name']}}--{{$visitednotication->data['phone']}}待接待</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer"><a href="/notification/clear">清除所有消息通知</a></li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="@if(\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('avatar')) {{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('avatar')}} @else/adminlte/dist/img/user5-128x128.jpg @endif" class="user-image" alt="{{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('name')}}">
                            <span class="hidden-xs">{{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('name')}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="@if(\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('avatar')) {{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('avatar')}} @else/adminlte/dist/img/user5-128x128.jpg @endif" class="img-circle" alt="{{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('name')}}">

                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">个人中心</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/logout" class="btn btn-default btn-flat">注销登录</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="@if(\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('avatar')) {{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('avatar')}} @else/adminlte/dist/img/user5-128x128.jpg @endif" class="img-circle" alt="{{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('name')}}">
                </div>
                <div class="pull-left info">
                    <p>{{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('name')}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="/search/" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="tel" class="form-control" placeholder="输入客户电话">
                    <span class="input-group-btn">
                <button type="submit"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">常用核心功能模块</li>
                <li class=" treeview">
                    <a href="#">
                        <i class="fa fa-user-circle-o"></i> <span>客户数据管理</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::getRequestUri()=='/data/add') class="active" @endif><a href="/data/add"><i class="fa fa-circle-o"></i> 客户数据录入</a></li>
                        <li @if(Request::getRequestUri()=='/data/view') class="active" @endif><a href="/data/view"><i class="fa fa-circle-o"></i> 客户数据浏览</a></li>
                        <li @if(Request::getRequestUri()=='/data/unclaimed') class="active" @endif><a href="/data/unclaimed"><i class="fa fa-circle-o"></i> 客服接待中心</a></li>
                        <li @if(Request::getRequestUri()=='/data/customerservice') class="active" @endif><a href="/data/customerservice"><i class="fa fa-circle-o"></i> 已接待的客户</a></li>
                        <li @if(Request::getRequestUri()=='/data/customervisit') class="active" @endif><a href="/data/customervisit"><i class="fa fa-circle-o"></i> 门店接待中心</a></li>
                        <li @if(Request::getRequestUri()=='/data/customervisit/own') class="active" @endif><a href="/data/customervisit/own"><i class="fa fa-circle-o"></i> 门店客户对接</a></li>
                        <li @if(Request::getRequestUri()=='/contractmanagement') class="active" @endif><a href="/contractmanagement"><i class="fa fa-circle-o"></i> 客户合同管理</a></li>
                     </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dropbox"></i>
                        <span>推广渠道管理</span>
                        <span class="pull-right-container">
              <span class="label label-primary pull-right">6</span>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::getRequestUri()=='/sysconf/refereradd') class="active" @endif><a href="/sysconf/refereradd"><i class="fa fa-circle-o"></i> 信息来源添加</a></li>
                        <li @if(Request::getRequestUri()=='/sysconf/refereraddlist') class="active" @endif><a href="/sysconf/refereraddlist"><i class="fa fa-circle-o"></i> 信息来源列表</a></li>
                        <li @if(Request::getRequestUri()=='/sysconf/packageadd') class="active" @endif><a href="/sysconf/packageadd"><i class="fa fa-circle-o"></i>  套餐类型添加</a></li>
                        <li @if(Request::getRequestUri()=='/sysconf/packagelist') class="active" @endif><a href="/sysconf/packagelist"><i class="fa fa-circle-o"></i> 套餐分类列表</a></li>
                        <li @if(Request::getRequestUri()=='/sysconf/advertisementadd') class="active" @endif><a href="/sysconf/advertisementadd"><i class="fa fa-circle-o"></i> 广告渠道添加</a></li>
                        <li @if(Request::getRequestUri()=='/sysconf/advertisementlist') class="active" @endif><a href="/sysconf/advertisementlist"><i class="fa fa-circle-o"></i> 广告渠道列表</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user-secret"></i> <span>用户权限管理</span>
                        <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::getRequestUri()=='/user/register') class="active" @endif><a href="/user/register"><i class="fa fa-circle-o"></i>部门人员添加</a></li>
                        <li @if(Request::getRequestUri()=='/user/list') class="active" @endif><a href="/user/list"><i class="fa fa-circle-o"></i>部门人员列表</a></li>
                        <li @if(Request::getRequestUri()=='/user/group') class="active" @endif><a href="/user/group"><i class="fa fa-circle-o"></i>部门分组管理</a></li>
                        <li @if(Request::getRequestUri()=='/user/groupcreate') class="active" @endif><a href="/user/groupcreate"><i class="fa fa-circle-o"></i>部门分组添加</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>数据汇总分析</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
			            <li @if(Request::getRequestUri()=='/admin/index') class="active" @endif><a href="/admin/index"><i class="fa fa-circle-o"></i>部门数据汇总</a></li>
			            <li @if(Request::getRequestUri()=='/inputer/index') class="active" @endif><a href="/inputer/index"><i class="fa fa-circle-o"></i>数据录入汇总</a></li>
			            <li @if(Request::getRequestUri()=='/customerservice/index') class="active" @endif><a href="/customerservice/index"><i class="fa fa-circle-o"></i>客服接待汇总</a></li>
			            <li @if(Request::getRequestUri()=='/customervisit/index') class="active" @endif><a href="/customervisit/index"><i class="fa fa-circle-o"></i>门店接待汇总</a></li>
			            <li @if(Request::getRequestUri()=='/customer/success') class="active" @endif><a href="/customer/success"><i class="fa fa-circle-o"></i>已成单的客户</a></li>
			            <li @if(Request::getRequestUri()=='/customer/unsuccess') class="active" @endif><a href="/customer/unsuccess"><i class="fa fa-circle-o"></i>已退单的客户</a></li>

                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>客户数据导入</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li @if(Request::getRequestUri()=='/importdatastxt') class="active" @endif><a href="/importdatastxt"><i class="fa fa-circle-o"></i>TXT格式导入</a></li>
                        <li @if(Request::getRequestUri()=='/importdatasexcel') class="active" @endif><a href="/importdatasexcel"><i class="fa fa-circle-o"></i>EXCEL格式导入</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>工作报表汇总</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                     </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>推广分析汇总</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">

                    </ul>
                </li>
                <li>
                    <a href="pages/calendar.html">
                        <i class="fa fa-calendar"></i> <span>待开发</span>
                        <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
                    </a>
                </li>
                <li>
                    <a href="pages/mailbox/mailbox.html">
                        <i class="fa fa-envelope"></i> <span>待开发</span>
                        <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-share"></i> <span>待开发</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                <li><a href="#"><i class="fa fa-book"></i> <span>使用文档</span></a></li>
                <li class="header">LABELS</li>
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>documentation</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <h1>YSGCRM<small>Version 2.0.1</small></h1>
            <ol class="breadcrumb">
                <li><a href="/admin/index"><i class="fa fa-dashboard"></i> 主页</a></li>
                @yield('position')
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0.1
        </div>
        <strong>Copyright &copy; 2014-2017 <a href="{{env('APP_URL')}}">YSG Studio</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">系统消息</h3>
                <ul class="control-sidebar-menu">
                    @foreach($notications->Allnotifications() as $allnotification)
                        @if($loop->index>3)
                            @break
                        @endif

                        @if(class_basename(($allnotification['type']))=='ReceivedNotification')
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-user bg-red"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">{{$allnotification->data['name']}} :{{$allnotification->data['phone']}}</h4>
                                        <p>领取时间：{{$allnotification['created_at']}}</p>
                                    </div>
                                </a>
                            </li>
                        @elseif(class_basename(($allnotification['type']))=='VisitedNotification')
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                                        <div class="menu-info">
                                            <h4 class="control-sidebar-subheading">{{$allnotification->data['name']}} :{{$allnotification->data['phone']}}</h4>
                                            <p>接待时间：{{$allnotification['created_at']}}</p>
                                        </div>
                                    </a>
                                </li>
                            @else
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">{{$allnotification->data['name']}}：{{$allnotification->data['phone']}} </h4>

                                        <p>退单原因：{{$allnotification->data['drainreason']}} </p>
                                    </div>
                                </a>
                            </li>

                        @endif

                    @endforeach
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">客服回访完成比</h3>
                <ul class="control-sidebar-menu">
                    @foreach(\App\User::where('groupid',2)->take(4)->inRandomOrder()->get() as $index=>$user)
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                {{$user->name}}
                                @if(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())
                                    @if(sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100<70)

                                        <span class="label label-danger pull-right">{{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%</span>
                                    @elseif(sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100>90)
                                        <span class="label label-success pull-right">{{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%</span>
                                    @elseif(sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100<60)
                                        <span class="label label-warning pull-right">{{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%</span>
                                    @elseif(sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100<70)
                                        <span class="label label-primary pull-right">{{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%</span>
                                    @endif
                                @endif
                            </h4>

                            <div class="progress progress-xxs">
                                @if(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())
                                    @if(sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100<70)
                                        <div class="progress-bar progress-bar-danger" style="width: {{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%"></div>
                                        @elseif(sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100>90)
                                            <div class="progress-bar progress-bar-success" style="width: {{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%"></div>
                                    @elseif(sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100<60)
                                        <div class="progress-bar progress-bar-warnin" style="width: {{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%"></div>
                                    @elseif(sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100<70)
                                        <div class="progress-bar progress-bar-primary" style="width: {{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%"></div>
                                    @endif
                                @endif
                            </div>
                        </a>
                    </li>

                        @endforeach
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">统计信息选项卡内容</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">常规设置</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            面板使用反馈
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            有关此常规设置选项的一些信息
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            允许邮件重定向
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            其他可用选项
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            公开评论用户名
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            允许用户在博客帖子中显示其姓名
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">对话设置</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            显示当前在线
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            关闭通知
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            删除聊天记录
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<script src="/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/adminlte/bootstrap/js/bootstrap.min.js"></script>
<script src="/adminlte/plugins/fastclick/fastclick.js"></script>
<script src="/adminlte/dist/js/app.min.js"></script>
<script src="/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/adminlte/dist/js/demo.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
</script>
@yield('flibs')
</body>
</html>
