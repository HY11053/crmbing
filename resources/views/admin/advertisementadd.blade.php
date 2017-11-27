@extends('admin.admin')
@section('title')广告渠道添加 @stop
@section('position') <li class="active">广告渠道添加</li> @stop
@section('content')
    <div class="row">
        <div class="register-box">
            <div class="register-box-body">
                <p class="login-box-msg">投放渠道分类</p>
                {{Form::open(array('route' => 'advertisementadd'))}}
                    <div class="form-group  has-feedback">
                        {{Form::text('sections', null,array('class'=>'form-control','id'=>'name','placeholder'=>'投放渠道分类'))}}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-4 pull-right">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">添加</button>
                            </div>
                            <!-- /.col -->
                        </div>
                {!! Form::close() !!}
            </div>
            <!-- /.form-box -->
        </div>
    </div>
@stop