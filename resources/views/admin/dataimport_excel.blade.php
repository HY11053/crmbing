@extends('admin.admin')
@section('title')客户信息导入——EXCEL @stop
@section('headlibs')
    <link href="/adminlte/dist/css/fileinput.min.css" rel="stylesheet">
@stop
@section('content')
    <h1 class="text-center">客户数据数据导入——EXCEL</h1>
    <hr/>
    <div class="col-md-6 col-md-offset-3">
        {{Form::open(array('route' => 'import_excel','method'=>'put','files' => true))}}
        <div class="col-md-12">
            <p class="timeline-header"><a href="">请上传.xls或.xlsx格式的文件</a></p>
        </div>
        <div class="form-group col-md-12">
            {{Form::file('customers',  array('class' => 'file col-md-10','id'=>'input-2','multiple data-show-upload'=>'false','data-show-caption'=>'true'))}}
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">提交数据</button>
        </div>
        {!! Form::close() !!}

    </div>

@stop


@section('flibs')
    <script src="/js/fileinput.min.js"></script>
@stop