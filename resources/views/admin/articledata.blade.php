@extends('admin.admin')
@section('title') 文章片段汇总@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">文章组合语句列表 共{{$articledatas->total()}}条数据</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>上传人</th>
                            <th>上传时间</th>
                            <th>分类</th>
                            <th>内容</th>
                            <th style="width: 150px " class="">操作</th>
                        </tr>
                        @foreach($articledatas as $articledata)
                        <tr>
                            <td>{{$articledata->id}}</td>
                            <td>{{\App\User::where('id',$articledata->user_id)->value('name')}}</td>
                            <td>{{$articledata->created_at}}</td>
                            <td>{{$articledata->type}}</td>
                            <td>{{str_limit($articledata->content,'100','...')}}</td>
                            <td><a href="/article/{{$articledata->id}}"><span class="label label-warning" style="font-weight: normal">查看</span></a> <a href="/article/edit/{{$articledata->id}}"><span class="label label-success" style="font-weight: normal">编辑</span></a> <a href="/article/del/{{$articledata->id}}"><span style="font-weight: normal" class="label label-danger">删除</span></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="box-footer clearfix">
            {{ $articledatas->links() }}
        </div>
    </div>
@stop