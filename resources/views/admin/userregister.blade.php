@extends('admin.admin')
@section('headlibs')
    <link rel="stylesheet" href="/adminlte/plugins/iCheck/all.css">
    <link href="/adminlte/dist/css/fileinput.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="register-box">
        <div class="register-logo">
            <b>用户信息添加</b>
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">人员添加</p>
            {!! Form::open( array('route' =>'userregister','files' => true)) !!}
            <div class="form-group has-feedback">
                {{Form::text('name',null, array('class' => 'form-control','id'=>'name','placeholder'=>'姓名'))}}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {{Form::file('image',  array('class' => 'file col-md-10','id'=>'input-2','multiple data-show-upload'=>'false','data-show-caption'=>'true'))}}
            </div>
            <div class="form-group has-feedback">
                {{Form::text('email',null, array('class' => 'form-control','id'=>'email','placeholder'=>'电子邮件'))}}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                @if(\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('usertype')==1)
                    {{Form::select('groupid',$groups, null,array('class'=>'form-control select2'))}}
                @else
                    {{Form::select('groupid',\App\Admin\UserGroup::where('id',\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('groupid'))->pluck('groupname','id'), null,array('class'=>'form-control select2'))}}
                @endif
            </div>
            @if(\App\User::where('id',\Illuminate\Support\Facades\Auth::id())->value('usertype')==1)
                <div class="form-group has-feedback" style="margin-top: 10px; padding-left: 10px;">
                    <label style="display: inline-block; margin-right: 10px;">
                        <input type="radio" name="usertype" value="2" class="flat-red")>管理员
                    </label>
                    <label>
                        <input type="radio" name="usertype" value="3" class="flat-red"  checked>非管理员
                    </label>
                </div>
            @endif

            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">添加</button>
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
    <script src="/js/fileinput.min.js"></script>
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