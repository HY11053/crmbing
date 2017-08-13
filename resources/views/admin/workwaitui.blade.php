@extends('admin.admin')
@section('title') 外推工作报表导入 @stop
@section('content')
    <h1 class="text-center">外推工作报表导入</h1>
    <hr/>
    <div class="col-md-12">
        <hr/>
        <form class="form-horizontal" method="post" action="/works/tuimport">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="col-md-12">
                <h3 class="timeline-header"><a href="">内容提交区域 一条一行 </a></h3>
                <small>example:http://www.baidu.com</small>
            </div>
            <div class="form-group col-md-12">
                <textarea class="form-control" name="content" rows="30"></textarea>

            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">提交数据</button>
            </div>


        </form>
    </div>

@stop