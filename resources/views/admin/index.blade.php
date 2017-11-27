@extends('admin.admin')
@section('title') 数据汇总预览 @stop
@section('position') <li class="active">数据汇总预览</li> @stop
@section('headlibs')
    <link rel="stylesheet" href="/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
@stop
@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-clipboard"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">今日订单完成数</span>
                    <span class="info-box-number">{{\App\Admin\Customer::where('dealstatus',1)->where('successed_at','>',Carbon\Carbon::today())->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">今日数据录入数</span>
                    <span class="info-box-number">{{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today())->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-bonfire"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">客服已接单数</span>
                    <span class="info-box-number">{{\App\Admin\Customer::where('allocated_at','>',Carbon\Carbon::today())->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-pulse"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">未接单数量</span>
                    <span class="info-box-number">{{\App\Admin\Customer::where('status','未分配')->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">近两周新增数据</h3><span style="margin-left: 5px; display: inline-block;"><i class="ion ion-bonfire text-red"></i>今日数据新增数：{{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today())->count()}}</span><span style=" margin-left: 5px;isplay: inline-block;"><i class="ion ion-ios-pulse text-red"></i>今日客服接单数：{{\App\Admin\Customer::where('allocated_at','>',Carbon\Carbon::today())->count()}}</span>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-wrench"></i></button>
                            <ul class="dropdown-menu" role="menu">
                            </ul>
                        </div>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-center">
                                <strong>截止当前: {{\Carbon\Carbon::now()}}:近两周新增数据</strong>
                            </p>

                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart" style="height: 180px;"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>客服回访完成比</strong>
                            </p>
                            @foreach(\App\User::where('groupid',2)->take(4)->get() as $user)
                            <div class="progress-group">
                                <span class="progress-text">{{$user->name}}</span>
                                <span class="progress-number"><b>{{\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count()}}</b>/{{\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()}}</span>

                                <div class="progress sm">
                                    @if(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())
                                        @if(sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100>=80)
                                        <div class="progress-bar progress-bar-success" style="width: {{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%"></div>
                                        @elseif((sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100>=60 && sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100<80))
                                            <div class="progress-bar progress-bar-warning" style="width: {{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%"></div>
                                        @elseif((sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100<60))
                                            <div class="progress-bar progress-bar-red" style="width: {{sprintf("%.4f", (\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->where('follownum','>',0)->count())/(\App\Admin\Customer::where('operate',$user->name)->where('allocated_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}}%"></div>
                                        @endif
                                        @else
                                        <div class="progress-bar progress-bar-aqua" style="width: 0%"></div>
                                    @endif
                                </div>
                            </div>
                       @endforeach
                            <!-- /.progress-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i>  0%  </span>
                                <h5 class="description-header">0</h5>
                                <span class="description-text">微信</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>  0% </span>
                                <h5 class="description-header">0</h5>
                                <span class="description-text">今日头条</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i>  0% </span>
                                <h5 class="description-header">0</h5>
                                <span class="description-text">腾讯智慧推</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block">
                                <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>  0% </span>
                                <h5 class="description-header">0</h5>
                                <span class="description-text">搜狐汇算</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">推广渠道分析</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="chart-responsive">
                            <canvas id="pieChart" height="160" width="328" style="width: 328px; height: 160px;"></canvas>
                        </div>
                        <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <ul class="chart-legend clearfix">
                            @foreach($advertisementsInfos as $index=>$advertisementsInfo)
                                @if($i<6)
                                    <li><i class="fa fa-circle-o {{$colors[$i++]}}"></i> {{\App\Admin\Advertisement::where('id',$index)->value('sections')}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($advertisementsInfos as $index=>$advertisementsInfo)
                    <li><a href="#">{{\App\Admin\Advertisement::where('id',$index)->value('sections')}}
                                    @if(\App\Admin\Customer::where('advertisement',$index)->where('created_at','>',\Carbon\Carbon::today())->count() < \App\Admin\Customer::where('advertisement',$index)->where('created_at','>',\Carbon\Carbon::yesterday())->where('created_at','<',\Carbon\Carbon::today())->count())
                                        <span class="pull-right text-red"><i class="fa fa-angle-down"></i>
                                     @elseif(\App\Admin\Customer::where('advertisement',$index)->where('created_at','>',\Carbon\Carbon::today())->count() == \App\Admin\Customer::where('advertisement',$index)->where('created_at','>',\Carbon\Carbon::yesterday())->where('created_at','<',\Carbon\Carbon::today())->count())
                                        <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i>
                                    @else
                                        <span class="pull-right text-green"><i class="fa fa-angle-up"></i>
                                    @endif
                                            @if((\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today())->count())) {{sprintf("%.4f",(\App\Admin\Customer::where('advertisement',$index)->where('created_at','>',\Carbon\Carbon::today())->count())/(\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today())->count()),0,-1)*100}} @else 0 @endif% </span></a></li>
                    @endforeach
                </ul>
            </div>
            <!-- /.footer -->
        </div>
    </div>
        <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">电话客服排行榜</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        @foreach($topOperateusers as $index=>$topOperateuser)
                        <li>
                            <img src="/adminlte/dist/img/user1-128x128.jpg" alt="{{\App\User::where('name',$index)->value('name')}}">
                            <a class="users-list-name" href="#">{{\App\User::where('name',$index)->value('name')}}</a>
                            <span class="users-list-date">{{$topOperateuser}}</span>
                        </li>
                       @endforeach
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">最新录入信息</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>姓名</th>
                                    <th>电话</th>
                                    <th>录入时间</th>
                                    <th style="text-align: center;">录入人员</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestDatas as $index=>$latestData)
                                    <tr>
                                        <th>{{$index+1}}</th>
                                        <th>{{$latestData->name}}</th>
                                        <th>{{str_replace(substr($latestData->phone,5,4),'****',$latestData->phone)}}</th>
                                        <th>{{$latestData->created_at}}</th>
                                        <th style="text-align: center;">{{$latestData->inputer}}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@stop

@section('flibs')
    <script src="/adminlte/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="/adminlte/plugins/chartjs/Chart.min.js"></script>
    @include('admin.charpie')
@stop