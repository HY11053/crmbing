@extends('admin.admin')
@section('title')客户信息浏览 @stop
@section('headlibs')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
    <link href="/adminlte/plugins/select2/select2.min.css" rel="stylesheet">
@stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">客户信息列表</h3>
                    <form class="form-inline pull-right" method="get" action="/inputer/index">
                        <div class="form-group">
                            <div class="input-group date " >
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar" style="width:10px;"></i>
                                </div>
                                {{Form::text('start_at', null, array('class' => 'form-control pull-right','id'=>'datepicker','placeholder'=>'开始时间','style'=>'width:100%'))}}
                            </div>
                        </div>
                        <div class="input-group date " >
                            <div class="input-group-addon">
                                <i class="fa fa-calendar" style="width:10px;"></i>
                            </div>
                            {{Form::text('end_at', null, array('class' => 'form-control pull-right','id'=>'datepicker1','placeholder'=>'结束时间','style'=>'width:100%'))}}
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-location-arrow" style="width:10px;"></i>
                                </div>
                                {{Form::select('advertisement', $advertisements, null,array('class'=>'form-control select2 pull-right','style'=>'width: 150px;','data-placeholder'=>"广告来源",'multiple'=>"multiple"))}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-line-chart" style="width:10px;"></i>
                                </div>
                                {{Form::select('referer', $allreferers, null,array('class'=>'form-control select2  pull-right','style'=>'width: 100%','style'=>'width: 150px;','data-placeholder'=>"信息来源",'multiple'=>"multiple"))}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user" style="width:10px;"></i>
                                </div>
                                {{Form::select('inputer', $inputers, null,array('class'=>'form-control select2  pull-right','style'=>'width: 100%','style'=>'width: 150px;','data-placeholder'=>"录入人员",'multiple'=>"multiple"))}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-jpy" style="width:10px;"></i>
                                </div>
                                {{Form::select('dealstatus', [1=>'已成单',2=>'未成单'], null,array('class'=>'form-control select2  pull-right','style'=>'width: 100%','style'=>'width: 150px;','data-placeholder'=>"订单状态",'multiple'=>"multiple"))}}

                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger">筛选数据</button>
                    </form>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width: 10px">#ID</th>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>信息来源</th>
                            <th>QQ/微信</th>
                            <th>手机号码</th>
                            <th>套餐类型</th>
                            <th>备注</th>
                            <th>录入者</th>
                            <th>客户状态</th>
                            <th>订单状态</th>
                            <th>录入时间</th>
                        </tr>
                        @foreach($allInputerDatas as $allInputerData)
                            <tr>
                                <td>{{$allInputerData->id}}</td>
                                <td>{{$allInputerData->name}}</td>
                                <td>{{$allInputerData->gender}}</td>
                                <td>{{\App\Admin\Referer::where('id',$allInputerData->referer)->value('sections')}}</td>
                                <td>{{$allInputerData->wechat}}</td>
                                <td>{{$allInputerData->phone}}</td>
                                <td>{{\App\Admin\Packagetype::where('id',$allInputerData->package)->value('sections')}}</td>
                                <td>{{$allInputerData->notes}}</td>
                                <td>{{$allInputerData->inputer}}</td>
                                <td>{{$allInputerData->status}}</td>
                                <td>@if($allInputerData->dealstatus==1) 已成单 @elseif($allInputerData->dealstatus==2) 已退单 @else 进行中 @endif</td>
                                <td>{{$allInputerData->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $allInputerDatas->appends($arguments)->links() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->
    <!-- /.content -->
@stop
@section('flibs')
    <script src="/adminlte/plugins/iCheck/icheck.min.js"></script>
    <script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="/adminlte/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js"></script>
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
        $('.select2').select2();
        $(function () {
            $('#datepicker,#datepicker1').datepicker({
                autoclose: true,
                language: 'zh-CN',
                todayHighlight: true
            });
        });
    </script>
@stop