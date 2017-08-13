@extends('admin.admin')
@section('title') 文章生成@stop
@section('headlibs')
    <link href="/adminlte/plugins/iCheck/all.css" rel="stylesheet">
@stop
@section('content')
<h1 class="text-center">零食品牌数据生成</h1>
<hr/>
<div class="ccol-md-6 col-md-offset-3">
    <h3 class="timeline-header"><a href="">数据生成选项</a></h3>
    <hr/>
    <form class="form-horizontal" method="post" action="/articlecreate">
        {{csrf_field()}}
        <div class="form-group has-success has-feedback">
            <div class="col-md-6">
                <label class="checkbox-inline" for="inputSuccess3">品牌名称</label>
                <input type="text" class="form-control" id="brandname" name="brandname" @if(isset($brand)) value="{{$brand}}" @endif aria-describedby="inputSuccess3Status">
                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                <span id="inputSuccess3Status" class="sr-only">(success)</span>
            </div>
        </div>
        <hr/>
        <div class="form-group ">
            <label class="checkbox-inline">
                <input type="checkbox" id="ppjs" checked class="flat-red" name="ppjs" value="ppjs"> 品牌介绍
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="jmlc" checked name="jmlc" value="jmlc"> 加盟流程
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="jmtj" checked  name="jmtj" value="jmtj"> 加盟条件
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="jmzc" checked name="jmzc" value="jmzc"> 加盟支持
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="xzjq" checked name="xzjq" value="xzjq"> 选址技巧
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="jyqj" checked name="jyjq" value="jyjq"> 经营技巧
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="tzfx" checked name="tzfx" value="tzfx"> 投资分析
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="lrfx" checked name="lrfx" value="lrfx"> 利润分析
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="anli" checked name="anli" value="anli"> 品牌案例
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="comment" checked name="comment" value="comment"> 品牌评论
            </label>
        </div>
        <hr/>
        <h3 class="timeline-header"><a href="">是否进行同义词替换</a></h3>
        <hr/>
        <div class="form-group">
            <label class="radio-inline">
                <input type="radio" name="replaces" id="replace" value="0"> 否
            </label>
            <label class="radio-inline">
                <input type="radio" name="replaces" id="replace" value="1"> 是
            </label>

        </div>
        <hr/>
        <button type="submit" class="btn btn-primary">生成数据</button>

    </form>
</div>
@stop
