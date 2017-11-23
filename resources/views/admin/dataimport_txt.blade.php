@extends('admin.admin')
@section('title')客户数据数据导入TXT @stop
@section('content')
    <h1 class="text-center">客户数据数据导入</h1>
    <hr/>
    <div class="col-md-12">
        {{Form::open(array('route' => 'textimport','method'=>'put'))}}
            <div class="col-md-12">
                <p class="timeline-header">数据导入区域 一条一行 各组信息之间以‘@’符号分割 example:梁李良@男@百度@liangliliang001@15618897003@998大礼包@测试数据@百度推广</p>
            </div>
            <div class="form-group col-md-12">
                <textarea class="form-control" name="content" rows="27"></textarea>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">提交数据</button>
            </div>
        {!! Form::close() !!}

    </div>

@stop