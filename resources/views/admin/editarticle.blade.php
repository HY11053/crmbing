@extends('admin.admin')
@section('title') 文章内容编辑@stop
@section('headlibs')
@stop
@section('content')
    <!-- /.box -->
    <!-- general form elements disabled -->
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">语句编辑</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" method="post" action="/article/edit/{{$thisarticle->id}}">
                {{csrf_field()}}
                <!-- text input -->
                <div class="form-group">
                    <label>录入人员：{{\App\User::where('id',$thisarticle->user_id)->value('name')}}</label>
                </div>
                <div class="form-group">
                    <label>分类</label>
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

                <!-- textarea -->
                <div class="form-group">
                    <label>内容编辑</label>
                    <textarea class="form-control" rows="3" name="content">{{$thisarticle->content}}</textarea>
                </div>
                <button type="submit" class="btn btn-block btn-primary">提交修改</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@stop
