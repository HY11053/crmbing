@extends('admin.admin')
@section('title') 外推工作文档列表 @stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">外推工作文档列表 共{{$works->total()}}条数据</h3>

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
                            <th>详情</th>
                            <th>上传时间</th>
                            <th>上传人</th>

                        </tr>
                        @foreach($works as $work)
                            <tr>
                                <td>{{$work->id}}</td>
                                <td><a href="{{$work->links}}" target="_blank">{{$work->links}}</a></td>
                                <td>{{$work->created_at}}</td>
                                <td>{{\App\User::where('id',$work->user_id)->value('name')}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="box-footer clearfix">
            {{ $works->links() }}
        </div>
    </div>
@stop