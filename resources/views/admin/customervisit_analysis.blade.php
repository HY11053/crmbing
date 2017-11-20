@extends('admin.admin')
@section('title')门店接待数据汇总 @stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">门店接待数据汇总</h3>
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
    <script src="/AdminLTE/plugins/iCheck/icheck.min.js"></script>
    <script src="/AdminLTE/plugins/datepicker/bootstrap-datepicker.js"></script>
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
                autoclose: true
            });

            //iCheck for checkbox and radio inputs
            $('.basic_info input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //Red color scheme for iCheck
            $('.basic_info input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
            //Flat red color scheme for iCheck
            $('.basic_info input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });


        });
    </script>
@stop