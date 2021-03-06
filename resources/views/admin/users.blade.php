@extends('admin.admin')
@section('title') 部门人员列表 @stop
@section('position') <li class="active">部门人员列表</li> @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">部门人员列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th style="width: 10px">id</th>
                            <th>姓名</th>
                            <th>账号</th>
                            <th>所属分组</th>
                            <th>用户类型</th>

                            <th style="width: 120px; text-align: center;">操作</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}.</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}} </td>
                                <td>@if($user->id==1) 超级管理员@else @if(isset($user->group->groupname)){{$user->group->groupname}}@endif @endif</td>
                                <td>@if($user->id==1) 超级管理员@else @if(isset($user->group->grouptype))@if($user->group->grouptype==1)数据录入@elseif($user->group->grouptype==2) 电话客服 @else 门店客服 @endif @endif @endif</td>
                                <td style="text-align: center;">
                                    <a href="/adminuser/edit/{{$user->id}}"><span class="label label-success" style="font-weight: normal">编辑</span></a>
                                    <a href="/user/del/{{$user->id}}"><span style="font-weight: normal" class="label label-danger">删除</span></a>
                                </td>
                            </tr>
                            <tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{$users->links()}}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop