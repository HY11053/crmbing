@extends('admin.admin')
@section('title')门店接待数据汇总 @stop
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
                    <h3 class="box-title">门店接待数据汇总</h3>
                    <form class="form-inline pull-right">
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
                                {{Form::select('advertisement', $allreferers, null,array('class'=>'form-control select2  pull-right','style'=>'width: 100%','style'=>'width: 150px;','data-placeholder'=>"信息来源",'multiple'=>"multiple"))}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user" style="width:10px;"></i>
                                </div>
                                {{Form::select('advertisement', $receptionist, null,array('class'=>'form-control select2  pull-right','style'=>'width: 100%','style'=>'width: 150px;','data-placeholder'=>"接待客服",'multiple'=>"multiple"))}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-jpy" style="width:10px;"></i>
                                </div>
                                {{Form::select('advertisement', ['订单状态'], null,array('class'=>'form-control select2 pull-right','style'=>'width: 100%','style'=>'width: 150px;','data-placeholder'=>"订单状态",'multiple'=>"multiple"))}}
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
                            <th>QQ/微信</th>
                            <th>手机号码</th>
                            <th>套餐类型</th>
                            <th>已付款</th>
                            <th>备注</th>
                            <th>客服信息</th>
                            <th>来店时间</th>
                            <th>门店状态</th>
                        </tr>
                        @foreach($allCustomervisitDatas as $allCustomervisitData)
                            <tr>
                                <td>{{$allCustomervisitData->id}}.</td>
                                <td>{{$allCustomervisitData->name}}</td>
                                <td>{{$allCustomervisitData->gender}}</td>
                                <td>{{$allCustomervisitData->wechat}}</td>
                                <td>{{$allCustomervisitData->phone}}</td>
                                <td>{{$allCustomervisitData->package}}</td>
                                <td>{{$allCustomervisitData->payment}}</td>
                                <td>{{$allCustomervisitData->notes}}</td>
                                <td>{{$allCustomervisitData->operate}}--{{$allCustomervisitData->status}}</td>
                                <td>{{$allCustomervisitData->visit_at}}</td>
                                <td>
                                    @if($allCustomervisitData->storestatus=='已接待')
                                        <span class="badge bg-green" style=" font-weight: normal;">已接待</span>
                                    @else
                                        <span class="badge bg-red" style="cursor: pointer; font-weight: normal;" id="status{{$allCustomervisitData->id}}" onclick="storeStatusChick('status{{$allCustomervisitData->id}}',{{$allCustomervisitData->id}})">{{$allCustomervisitData->storestatus}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $allCustomervisitDatas->links() !!}
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