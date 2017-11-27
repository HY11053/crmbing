@extends('admin.admin')
@section('title')  广告渠道列表@stop
@section('position') <li class="active">广告渠道列表</li> @stop
@section('headlibs')
    <style>td.newcolor span a{color: #fff; font-weight: 400; display: inline-block; padding: 2px;} td.newcolor span{margin-left: 5px;}</style>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">投放渠道分类列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped text-center">
                        <tr>
                            <th style="width: 10px">#ID</th>
                            <th>渠道类型</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($advertisementlists as $advertisementlist)
                            <tr>
                                <td>{{$advertisementlist->id}}</td>
                                <td>{{$advertisementlist->sections}}</td>
                                <td>{{$advertisementlist->created_at}}</td>
                                <td class="newcolor"><span class="badge bg-green"><a href="/sysconf/advertisementedit/{{$advertisementlist->id}}">编辑</a></span> <span class="badge bg-red"><a href="/sysconf/advertisementdelete/{{$advertisementlist->id}}">删除</a> </span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{--!! $adminlists->links() !!--}}
                </div>
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->
    <!-- /.content -->
@stop