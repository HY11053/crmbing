@extends('admin.admin')
@section('title') 零食品牌数据导入 @stop
@section('content')
    <h1 class="text-center">零食品牌数据导入</h1>
    <hr/>
    <div class="col-md-12">
        <h3 class="timeline-header"><a href="">数据提交选项</a></h3>
        <hr/>
        <form class="form-horizontal" method="post" action="/importdatas">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group col-md-12">
                <select name="type" class="form-control">
                    <option value="ppjs">品牌介绍</option>
                    <option value="jmlc">加盟流程</option>
                    <option value="jmtj">加盟条件</option>
                    <option value="jmzc">加盟支持</option>
                    <option value="xzjq">选址技巧</option>
                    <option value="jyjq">经营技巧</option>
                    <option value="tzfx">投资分析</option>
                    <option value="lrfx">利润分析</option>
                    <option value="comment">品牌评论</option>
                    <option value="anli">加盟案例</option>
                </select>
            </div>
            <div class="col-md-12">
                <h3 class="timeline-header"><a href="">内容提交区域 一条一行</a></h3>
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