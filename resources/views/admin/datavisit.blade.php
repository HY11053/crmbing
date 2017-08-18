@extends('admin.admin')
@section('title')客服来访信息列表 @stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('name')}}客服来访信息列表</h3>
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
                            <th>备注</th>
                            <th>客户状态</th>
                            <th>分配</th>
                            <th>分配时间</th>
                            <th >操作</th>
                        </tr>
                        @foreach($customerVisits as $customerVisit)
                            <tr>
                                <td>{{$customerVisit->id}}.</td>
                                <td>{{$customerVisit->name}}</td>
                                <td>{{$customerVisit->gender}}</td>
                                <td>{{$customerVisit->wechat}}</td>
                                <td>{{$customerVisit->phone}}</td>
                                <td>{{$customerVisit->package}}</td>
                                <td>{{$customerVisit->notes}}</td>
                                <td>{{$customerVisit->status}}</td>
                                <td>{{$customerVisit->operate}}</td>
                                <td>{{$customerVisit->allocated_at}}</td>
                                <td><span class="badge bg-green"><a href="/data/edit/{{$customerVisit->id}}" style="color: #fff; font-weight: normal;">编辑</a></span> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $customerVisits->links() !!}
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