@extends('admin.admin')
@section('title')信息来源添加 @stop
@section('position') <li class="active">信息来源添加</li> @stop
@section('content')
    <div class="row">
        <div class="register-box">
            <div class="register-box-body">
                <p class="login-box-msg">信息来源添加</p>
                {{Form::open(array('route' => 'refereradd','files' => true,))}}
                    <div class="form-group  has-feedback">
                        {{Form::text('sections', null,array('class'=>'form-control','id'=>'sections','placeholder'=>'信息来源'))}}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-4 pull-right">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">提交</button>
                            </div>
                            <!-- /.col -->
                        </div>
                {!! Form::close() !!}
            </div>
            <!-- /.form-box -->
        </div>
    </div>
@stop