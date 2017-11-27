@extends('admin.admin')
@section('title')已退单客户信息汇总 @stop
@section('position') <li class="active">退单客户汇总</li> @stop
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
                    <h3 class="box-title">已退单客户信息汇总 列表</h3>
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
                            <th>信息来源</th>
                            <th>手机号码</th>
                            <th>套餐类型</th>
                            <th>退单原因</th>
                            <th>录入时间</th>
                            <th>跟进次数</th>
                        </tr>
                        @foreach($allCustomerunsuccessDatas as $allCustomerserviceData)
                            <tr>
                                <td>{{$allCustomerserviceData->id}}</td>
                                <td>{{$allCustomerserviceData->name}}</td>
                                <td>{{$allCustomerserviceData->gender}}</td>
                                <td>{{$allCustomerserviceData->referer}}</td>
                                <td>{{$allCustomerserviceData->phone}}</td>
                                <td>{{$allCustomerserviceData->package}}</td>
                                <td>{{$allCustomerserviceData->drainreason}}</td>
                                <td>{{$allCustomerserviceData->created_at}}</td>
                                <td class="text-center"><span class="badge bg-red-active" style="cursor: pointer" title="@foreach($allCustomerserviceData->Cnotes as $cnote) 【{{$cnote->notes}}】 @endforeach">{{$allCustomerserviceData->Cnotes->count()-1}}</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $allCustomerunsuccessDatas->links() !!}
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