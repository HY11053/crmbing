@extends('admin.admin')
@section('headlibs')
    <link rel="stylesheet" href="/adminlte/plugins/iCheck/all.css">
@stop
@section('content')
    <div class="register-box">
        <div class="register-logo">
            <b>用户信息编辑</b>
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">更改对应用户信息</p>

            <form action="/adminuser/edit/{{$user->id}}" method="post">
                {!! Form::model($user, array('route' => array('adminuser.edit', $user->id))) !!}
                <div class="form-group has-feedback">
                    {{Form::text('name',null, array('class' => 'form-control','id'=>'name'))}}
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {{Form::text('email',null, array('class' => 'form-control','id'=>'email'))}}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {{Form::select('groupid',$groups, null,array('class'=>'form-control select2'))}}

                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="密码">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">更改信息</button>
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