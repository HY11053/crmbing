@extends('admin.admin')
@section('title')已成单客户汇总 @stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">已成单客户汇总</h3>
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
                        @foreach($allCustomersuccessDatas as $allCustomersuccessData)
                            <tr>
                                <td>{{$allCustomersuccessData->id}}</td>
                                <td>{{$allCustomersuccessData->name}}</td>
                                <td>{{$allCustomersuccessData->gender}}</td>
                                <td>{{$allCustomersuccessData->referer}}</td>
                                <td>{{$allCustomersuccessData->wechat}}</td>
                                <td>{{$allCustomersuccessData->phone}}</td>
                                <td>{{$allCustomersuccessData->package}}</td>
                                <td>{{$allCustomersuccessData->notes}}</td>
                                <td>{{$allCustomersuccessData->status}}</td>
                                <td>{{$allCustomersuccessData->operate}}</td>
                                <td>{{$allCustomersuccessData->created_at}}</td>
                                <td class="text-center"><span class="badge bg-red-active" style="cursor: pointer" title="@foreach($allCustomersuccessData->Cnotes as $cnote) 【{{$cnote->notes}}】 @endforeach">{{$allCustomersuccessData->Cnotes->count()-1}}</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $allCustomersuccessDatas->links() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->
    <!-- /.content -->
@stop
