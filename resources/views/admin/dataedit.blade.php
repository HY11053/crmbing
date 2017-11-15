@extends('admin.admin')
@section('title')客户信息录入 @stop
@section('headlibs')
    <link href="/AdminLTE/plugins/iCheck/all.css" rel="stylesheet">
    <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
    <style>
        .basic_info .radio{margin-top: 0px;}
    </style>
@stop
@section('content')
    <div class="row">
        {{Form::model($thiscunstomdata,array('route' =>array('postdataedit', $thiscunstomdata->id)))}}
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline basic_info">
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-red">
                     {{date("M j, Y")}}
                  </span>
                </li>
                <!-- timeline item -->
                <li>
                    <i class=" fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                        <h3 class="timeline-header"><a href="#">客户信息更改|</a> 请按需填写</h3>

                        <div class="timeline-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {{Form::label('name', '客户姓名', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="input-group col-md-8 col-sm-9 col-xs-12">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user" style="width:10px;"></i>
                                        </div>
                                        {{Form::text('name',null, array('class' => 'form-control  pull-right','placeholder'=>'客户姓名'))}}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    {{Form::label('gender', '客户性别', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="input-group col-md-8">
                                        <div class="input-group-addon">
                                            <i class="fa fa-venus-double" style="width:10px;"></i>
                                        </div>
                                        {{Form::select('gender', ['男'=>'男','女'=>'女'], null,array('class'=>'form-control pull-right','style'=>'width: 100%'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('referer', '信息来源', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 input-group col-sm-9 col-xs-12">
                                        <div class="input-group-addon">
                                            <i class="fa fa-line-chart" style="width:10px;"></i>
                                        </div>
                                        {{Form::select('referer', $allreferers, null,array('class'=>'form-control pull-right','style'=>'width: 100%'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('wechat', 'QQ/微信', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 input-group col-sm-9 col-xs-12">
                                        <div class="input-group-addon">
                                            <i class="fa fa-weixin" style="width:10px;"></i>
                                        </div>
                                        {{Form::text('wechat', null, array('class' => 'form-control col-md-10 pull-right','placeholder'=>'QQ/微信'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('phone', '手机号码', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 input-group col-sm-9 col-xs-12">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone" style="width:10px;"></i>
                                        </div>
                                        {{Form::text('phone', null, array('class' => 'form-control col-md-10 pull-right','placeholder'=>'手机号码'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('package',  '套餐类型', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 input-group col-sm-9 col-xs-12">
                                        <div class="input-group-addon">
                                            <i class="fa fa-shopping-bag" style="width:10px;"></i>
                                        </div>
                                        {{Form::select('package', $packages, null,array('class'=>'form-control pull-right','style'=>'width: 100%'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('notes', '备注信息', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="input-group col-md-8 col-sm-9 col-xs-12">
                                        <div class="input-group-addon">
                                            <i class="fa fa-file-text-o" style="width:10px;"></i>
                                        </div>
                                        {{Form::text('notes', null, array('class' => 'form-control pull-right','placeholder'=>'备注信息'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('advertisement', '广告来源', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="input-group col-md-8 col-sm-9 col-xs-12">
                                        <div class="input-group-addon">
                                            <i class="fa fa-location-arrow" style="width:10px;"></i>
                                        </div>
                                        {{Form::select('advertisement', $advertisements, null,array('class'=>'form-control pull-right','style'=>'width: 100%'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('visit_at', '到店时间', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="input-group date  col-md-8 col-sm-9 col-xs-12" >
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar" style="width:10px;"></i>
                                        </div>
                                        {{Form::text('visit_at', null, array('class' => 'form-control pull-right','id'=>'datepicker','placeholder'=>'点击选择到店时间','style'=>'width:100%'))}}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    {{Form::label('payment', '已交金额', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="input-group   col-md-8 col-sm-9 col-xs-12" >
                                        <div class="input-group-addon">
                                            <i class="fa fa-jpy" style="width:10px;"></i>
                                        </div>
                                        {{Form::text('payment', null, array('class' => 'form-control pull-right','placeholder'=>'请输入已交金额','style'=>'width:100%'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6 ">
                                    {{Form::label('dealstatus', '订单状态', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="radio col-md-4 col-sm-9 col-xs-12">
                                        {{Form::radio('dealstatus', '1', false,array('class'=>'flat-red'))}} 已成单
                                        {{Form::radio('dealstatus', '2', false,array('class'=>'flat-red'))}} 退单
                                    </div>

                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('drainreason', '退单原因', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="input-group col-md-8 col-sm-9 col-xs-12">
                                        <div class="input-group-addon">
                                            <i class="fa fa-map-o" style="width:10px;"></i>
                                        </div>
                                        {{Form::text('drainreason', null, array('class' => 'form-control pull-right','placeholder'=>'退单原因'))}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="timeline-footer">
                            <button type="submit"  class="btn btn-md bg-maroon">提交数据</button>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                        <h3 class="timeline-header"><a href="#">客户跟踪|</a> 客户数据跟踪时间线</h3>

                        <div class="timeline-body">
                            <ul class="list-group">
                                <li class="list-group-item"><i class="fa fa-blind" style="padding-right: 5px;"></i>{{$thiscunstomdata->created_at}}---{{$thiscunstomdata->inputer}}录入数据</li>
                                @foreach($thiscunstomdata->Cnotes as $cnote)
                                    <li class="list-group-item"><i class="fa fa-blind" style="padding-right: 5px;"></i>{{$cnote->created_at}}{{$cnote->notes}}</li>
                                    @endforeach
                            </ul>
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-warning btn-flat btn-xs">客户信息跟踪时间线</a>
                        </div>
                    </div>
                </li>
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>

        </div>
        <!-- /.col -->
        {!! Form::close() !!}

    </div>


@stop

@section('flibs')
    <script src="/AdminLTE/plugins/iCheck/icheck.min.js"></script>
    <script src="/AdminLTE/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="/AdminLTE/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>

    <script>
        $(function () {
            $('#datepicker').datepicker({
                autoclose: true,
                language: 'zh-CN',
                todayHighlight: true
            });
            //Flat red color scheme for iCheck
            $('.basic_info input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

        });
    </script>
@stop