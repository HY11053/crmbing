@extends('admin.admin')
@section('title')客服来访信息列表 @stop
@section('position') <li class="active">门店客户对接</li> @stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('name')}}文档客服来访信息列表</h3>
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
                            <th>操作</th>
                        </tr>
                        @foreach($customerVisits as $customerVisit)
                            <tr>
                                <td>{{$customerVisit->id}}.</td>
                                <td>{{$customerVisit->name}}</td>
                                <td>{{$customerVisit->gender}}</td>
                                <td>{{$customerVisit->wechat}}</td>
                                <td>{{$customerVisit->phone}}</td>
                                <td>{{\App\Admin\Packagetype::where('id',$customerVisit->package)->value('sections')}}</td>
                                <td>{{$customerVisit->payment}}</td>
                                <td>{{$customerVisit->notes}}</td>
                                <td>{{$customerVisit->operate}}--{{$customerVisit->status}}</td>
                                <td>{{$customerVisit->visit_at}}</td>
                                <td>
                                    @if($customerVisit->storestatus=='已接待')
                                        <span class="badge bg-green" style=" font-weight: normal;">已接待</span>
                                    @else
                                        <span class="badge bg-red" style="cursor: pointer; font-weight: normal;" id="status{{$customerVisit->id}}" onclick="storeStatusChick('status{{$customerVisit->id}}',{{$customerVisit->id}})">{{$customerVisit->storestatus}}</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-red"><a href="/visit/edit/{{$customerVisit->id}}" style="color: #fff; font-weight: normal;">编辑</a></span></td>
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