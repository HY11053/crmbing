@extends('admin.admin')
@section('headlibs')
    <link rel="stylesheet" href="/adminlte/plugins/iCheck/all.css">
@stop
@section('content')
    <div class="register-box">
        <div class="register-logo">
            <b>会员信息编辑</b>
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">更改对应会员信息</p>

            <form action="/user/edit/{{$user->id}}" method="post">
                {{csrf_field()}}
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="name" placeholder="{{$user->name}}" value="{{$user->name}}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="{{$user->email}}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                <select name="gid" class="form-control">
                    @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->groupname}}</option>
                    @endforeach
                </select>
                <div class="form-group has-feedback" style="margin-top: 10px; padding-left: 10px;">
                    <label style="display: inline-block; margin-right: 10px;">
                        <input type="radio" name="type" value="1" class="flat-red" @if($user->type) checked @endif>管理员
                    </label>
                    <label>
                        <input type="radio" name="type" value="0" class="flat-red" @if(!$user->type) checked @endif>普通会员
                    </label>
                </div>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="密码">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback" style="margin-top: 10px; padding-left: 10px;">
                    <label style="display: inline-block; margin-right: 10px;">
                        <input type="radio" name="is_create" value="1" class="flat-red" @if($user->is_create) checked @endif>允许生成文章
                    </label>
                    <label>
                        <input type="radio" name="is_create" value="0" class="flat-red" @if(!$user->is_create) checked @endif>不允许
                    </label>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">更会员信息</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

@stop
@section('flibs')
    <!-- iCheck 1.0.1 -->
    <script src="/adminlte/plugins/iCheck/icheck.min.js"></script>

    <script>

    $(function () {
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });

</script>
@stop