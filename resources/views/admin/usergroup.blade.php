@extends('admin.admin')
@section('title') 前台用户列表 @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">前台用户列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">id</th>
                            <th>组名称</th>
                            <th style="width: 120px; text-align: center;">操作</th>
                        </tr>
                        @foreach($groups as $group)
                            <tr>
                                <td>{{$group->id}}.</td>
                                <td>{{$group->groupname}}</td>
                                <td style="text-align: center;">
                                    <a href="/usergroup/edit/{{$group->id}}"><span class="label label-success" style="font-weight: normal">编辑</span></a>
                                    {{--<a href="/user/del/{{$user->id}}"><span style="font-weight: normal" class="label label-danger">删除</span></a>--}}
                                </td>
                            </tr>
                            <tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop