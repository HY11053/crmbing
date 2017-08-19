@extends('admin.admin')
@section('title')客户信息浏览 @stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">客户信息列表</h3>
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
                            <th>分配</th>
                            <th>录入时间</th>
                            <th >操作</th>
                        </tr>
                        @foreach($cunstomdatas as $cunstomdata)
                            <tr>
                                <td>{{$cunstomdata->id}}.</td>
                                <td>{{$cunstomdata->name}}</td>
                                <td>{{$cunstomdata->gender}}</td>
                                <td>{{$cunstomdata->referer}}</td>
                                <td>{{$cunstomdata->wechat}}</td>
                                <td>{{$cunstomdata->phone}}</td>
                                <td>{{$cunstomdata->package}}</td>
                                <td>{{$cunstomdata->notes}}</td>
                                <td>{{$cunstomdata->inputer}}</td>
                                <td>{{$cunstomdata->status}}</td>
                                <td>{{$cunstomdata->operate}}</td>
                                <td>{{$cunstomdata->created_at}}</td>
                                <td><span class="badge bg-green"><a href="/admin/phone/edit/" style="color: #fff; font-weight: normal;">编辑</a></span> <span class="badge bg-red"><a href="/admin/phone/delete/" style="color: #fff; font-weight: normal;">删除</a> </span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $cunstomdatas->links() !!}
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