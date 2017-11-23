@extends('admin.admin')
@section('title')客服接待信息列表 @stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('name')}}客服接待信息列表</h3>
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
                            <th>已交金额</th>
                            <th>备注</th>
                            <th>录入者</th>
                            <th>录入时间</th>
                            <th>客户状态</th>
                            <th>分配</th>
                            <th>分配时间</th>
                            <th>跟进次数</th>
                            <th >操作</th>
                        </tr>
                        @foreach($cunstomdatas as $cunstomdata)
                            <tr>
                                <td>{{$cunstomdata->id}}.</td>
                                <td>{{$cunstomdata->name}}</td>
                                <td>{{$cunstomdata->gender}}</td>
                                <td>{{$cunstomdata->wechat}}</td>
                                <td>{{$cunstomdata->phone}}</td>
                                <td>{{\App\Admin\Packagetype::where('id',$cunstomdata->package)->value('sections')}}</td>
                                <td>{{$cunstomdata->payment}}</td>
                                <td>{{str_limit($cunstomdata->notes,20,'...')}}</td>
                                <td>{{$cunstomdata->inputer}}</td>
                                <td>{{$cunstomdata->created_at}}</td>
                                <td>{{$cunstomdata->status}}</td>
                                <td>{{$cunstomdata->operate}}</td>
                                <td>{{$cunstomdata->allocated_at}}</td>
                                <td class="text-center"><span class="badge bg-red-active" style="cursor: pointer" title="@foreach($cunstomdata->Cnotes as $cnote) 【{{$cnote->notes}}】 @endforeach">{{$cunstomdata->Cnotes->count()-1}}</span></td>
                                <td><span class="badge bg-green"><a href="/service/edit/{{$cunstomdata->id}}" style="color: #fff; font-weight: normal;">编辑</a></span> </td>
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