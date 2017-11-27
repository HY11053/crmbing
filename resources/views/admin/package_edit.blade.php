@extends('admin.admin')
@section('title')套餐类型编辑 @stop
@section('position') <li class="active">套餐类型编辑</li> @stop
@section('content')
    <div class="row">
        <div class="register-box">
            <div class="register-box-body">
                <p class="login-box-msg">套餐类型修改</p>
                {{Form::model( $thisPackage,array('route' =>array('package_edit',$thisPackage->id)))}}
                    <div class="form-group  has-feedback">
                        {{Form::text('sections', null,array('class'=>'form-control','id'=>'sections','placeholder'=>'套餐类型'))}}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-4 pull-right">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">修改</button>
                            </div>
                            <!-- /.col -->
                        </div>
                {!! Form::close() !!}
            </div>
            <!-- /.form-box -->
        </div>
    </div>
@stop