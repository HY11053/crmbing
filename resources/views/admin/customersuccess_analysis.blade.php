@extends('admin.admin')
@section('title')已成单客户汇总 @stop
@section('position') <li class="active">成单客户汇总</li> @stop
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
                    <h3 class="box-title">已成单客户汇总</h3>
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
                                {{Form::select('referer', $allreferers, null,array('class'=>'form-control select2  pull-right','style'=>'width: 100%','style'=>'width: 150px;','data-placeholder'=>"信息来源",'multiple'=>"multiple"))}}
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
                            <th>广告来源</th>
                            <th>手机号码</th>
                            <th>套餐类型</th>
                            <th>成单时间</th>
                            <th>成单人员</th>
                            <th>跟进次数</th>
                        </tr>
                        @foreach($allCustomersuccessDatas as $allCustomersuccessData)
                            <tr>
                                <td>{{$allCustomersuccessData->id}}</td>
                                <td>{{$allCustomersuccessData->name}}</td>
                                <td>{{$allCustomersuccessData->gender}}</td>
                                <td>{{\App\Admin\Referer::where('id',$allCustomersuccessData->referer)->value('sections')}}</td>
                                <td>{{\App\Admin\Advertisement::where('id',$allCustomersuccessData->advertisement)->value('sections')}}</td>
                                <td>{{$allCustomersuccessData->phone}}</td>
                                <td>{{\App\Admin\Packagetype::where('id',$allCustomersuccessData->package)->value('sections')}}</td>
                                <td>{{$allCustomersuccessData->successed_at}}</td>
                                <td>{{$allCustomersuccessData->finishuser}}</td>
                                <td class="text-center"><span class="badge bg-red-active" style="cursor: pointer" title="@foreach($allCustomersuccessData->Cnotes as $cnote) 【{{$cnote->notes}}】 @endforeach">{{$allCustomersuccessData->Cnotes->count()-1}}</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $allCustomersuccessDatas->appends($arguments)->links() !!}
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
