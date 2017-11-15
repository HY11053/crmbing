@extends('admin.admin')
@section('content')
    <div class="register-box">
        <div class="register-logo">
            <b>会员组更改</b>
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">更改对应会员组信息</p>
            {!! Form::model($thisGroupInfo, array('route' => array('groupedit', $thisGroupInfo->id),'method' => 'put')) !!}
            <div class="form-group has-feedback">
                {{Form::text('groupname',null, array('class' => 'form-control','id'=>'groupname','placeholder'=>'组名称'))}}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <span>组类型：</span>
                {{Form::select('grouptype', [1=>'数据录入',2=>'电话客服',3=>'门店客服'], null,array('class'=>'form-control select2'))}}

            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">添加组信息</button>
                </div>
                <!-- /.col -->
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

@stop