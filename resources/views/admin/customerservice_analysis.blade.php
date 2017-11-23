@extends('admin.admin')
@section('title')客服接待汇总 @stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">客服接待汇总</h3>
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
                            <th>客户状态</th>
                            <th>分配</th>
                            <th>录入时间</th>
                            <th>跟进次数</th>
                        </tr>
                        @foreach($allCustomerserviceDatas as $allCustomerserviceData)
                            <tr>
                                <td>{{$allCustomerserviceData->id}}</td>
                                <td>{{$allCustomerserviceData->name}}</td>
                                <td>{{$allCustomerserviceData->gender}}</td>
                                <td>{{$allCustomerserviceData->referer}}</td>
                                <td>{{$allCustomerserviceData->wechat}}</td>
                                <td>{{$allCustomerserviceData->phone}}</td>
                                <td>{{$allCustomerserviceData->package}}</td>
                                <td>{{$allCustomerserviceData->notes}}</td>
                                <td>{{$allCustomerserviceData->status}}</td>
                                <td>{{$allCustomerserviceData->operate}}</td>
                                <td>{{$allCustomerserviceData->created_at}}</td>
                                <td class="text-center"><span class="badge bg-red-active" style="cursor: pointer" title="@foreach($allCustomerserviceData->Cnotes as $cnote) 【{{$cnote->notes}}】 @endforeach">{{$allCustomerserviceData->Cnotes->count()-1}}</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $allCustomerserviceDatas->links() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->
    <!-- /.content -->
@stop