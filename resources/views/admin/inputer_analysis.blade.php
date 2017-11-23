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
                        </tr>
                        @foreach($allInputerDatas as $allInputerData)
                            <tr>
                                <td>{{$allInputerData->id}}</td>
                                <td>{{$allInputerData->name}}</td>
                                <td>{{$allInputerData->gender}}</td>
                                <td>{{$allInputerData->referer}}</td>
                                <td>{{$allInputerData->wechat}}</td>
                                <td>{{$allInputerData->phone}}</td>
                                <td>{{$allInputerData->package}}</td>
                                <td>{{$allInputerData->notes}}</td>
                                <td>{{$allInputerData->inputer}}</td>
                                <td>{{$allInputerData->status}}</td>
                                <td>{{$allInputerData->operate}}</td>
                                <td>{{$allInputerData->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $allInputerDatas->links() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->
    <!-- /.content -->
@stop