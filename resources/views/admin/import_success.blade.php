@extends('admin.admin')
@section('title')客户信息导入——EXCEL @stop
@section('headlibs')
    <link href="/adminlte/dist/css/fileinput.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="col-md-12">
        <div class="col-md-12">
            @if(count($success_info)>0)
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title text-blue">录入成功客户信息{{count($success_info)}} </h3><button type="submit" class=" pull-right btn btn-sm bg-maroon"><a style="color: white" href="/importdatasexcel">继续导入数据</a></button>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width: 10px">#ID</th>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>信息来源</th>
                            <th>QQ/微信</th>
                            <th>手机号码</th>
                            <th>套餐类型</th>
                            <th>备注</th>
                            <th>套餐类型</th>
                            <th>录入者</th>
                            <th>录入状态</th>
                            <th>录入时间</th>
                        </tr>

                            @foreach($success_info as $index=>$value)
                                <tr>
                                    <td>{{$index+1}}.</td>
                                    <td>{{$value['name']}}</td>
                                    <td>{{$value['gender']}}</td>
                                    <td>{{\App\Admin\Referer::where('id',$value['referer'])->value('sections')}}</td>
                                    <td>{{$value['wechat']}}</td>
                                    <td>{{$value['phone']}}</td>
                                    <td>{{\App\Admin\Packagetype::where('id',$value['package'])->value('sections')}}</td>
                                    <td>{{$value['notes']}}</td>
                                    <td>{{\App\Admin\Advertisement::where('id',$value['advertisement'])->value('sections')}}</td>
                                    <td>{{$value['inputer']}}</td>
                                    <td class="text-blue">录入成功</td>
                                    <td>{{$value['created_at']}}</td>
                                </tr>
                            @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                </div>
            </div>
            <!-- /.box -->
            @endif
            @if(count($unsuccess_info)>0)
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title text-danger">录入失败客户{{count($unsuccess_info)}} </h3><button type="submit" class=" pull-right btn btn-sm bg-maroon"><a style="color: white" href="/importdatasexcel">继续导入数据</a></button>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width: 10px">#ID</th>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>信息来源</th>
                            <th>QQ/微信</th>
                            <th>手机号码</th>
                            <th>套餐类型</th>
                            <th>备注</th>
                            <th>套餐类型</th>
                            <th>录入者</th>
                            <th>录入状态</th>
                            <th>录入时间</th>
                        </tr>
                            @foreach($unsuccess_info as $index=>$value)
                                <tr>
                                    <td>{{$index+1}}.</td>
                                    <td>{{$value['name']}}</td>
                                    <td>{{$value['gender']}}</td>
                                    <td>{{\App\Admin\Referer::where('id',$value['referer'])->value('sections')}}</td>
                                    <td>{{$value['wechat']}}</td>
                                    <td>{{$value['phone']}}</td>
                                    <td>{{\App\Admin\Packagetype::where('id',$value['package'])->value('sections')}}</td>
                                    <td>{{$value['notes']}}</td>
                                    <td>{{\App\Admin\Advertisement::where('id',$value['advertisement'])->value('sections')}}</td>
                                    <td>{{$value['inputer']}}</td>
                                    <td class="text-red">{{$value['info']}}</td>
                                    <td>{{$value['created_at']}}</td>
                                </tr>
                            @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                </div>
            </div>
            <!-- /.box -->
            @endif
        </div>
    </div>

@stop


@section('flibs')
    <script src="/js/fileinput.min.js"></script>
@stop