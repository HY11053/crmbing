@extends('admin.admin')
@section('title')待分配客户信息列表 @stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">待分配客户信息列表</h3>
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
                            <th>录入者</th>
                            <th>客户状态</th>
                            <th>分配</th>
                            <th>录入时间</th>
                            <th >操作</th>
                        </tr>
                        @foreach($dataUnclaimeds as $dataUnclaimed)
                            <tr>
                                <td>{{$dataUnclaimed->id}}.</td>
                                <td>{{$dataUnclaimed->name}}</td>
                                <td>{{$dataUnclaimed->gender}}</td>
                                <td>{{$dataUnclaimed->referer}}</td>
                                <td>{{str_replace(substr($dataUnclaimed->wechat,1,4),'****',$dataUnclaimed->wechat)}}</td>
                                <td>{{str_replace(substr($dataUnclaimed->phone,5,4),'****',$dataUnclaimed->phone)}}</td>
                                <td>{{$dataUnclaimed->package}}</td>
                                <td>{{$dataUnclaimed->notes}}</td>
                                <td>{{$dataUnclaimed->inputer}}</td>
                                <td>{{$dataUnclaimed->status}}</td>
                                <td id="operate{{$dataUnclaimed->id}}">{{$dataUnclaimed->operate}}</td>
                                <td>{{$dataUnclaimed->created_at}}</td>
                                <td>
                                @if($dataUnclaimed->status=='已领取')
                                    <span class="badge bg-green" style=" font-weight: normal;">已领取</span>
                                @else
                                    <span class="badge bg-red" style="cursor: pointer; font-weight: normal;" id="status{{$dataUnclaimed->id}}" onclick="statusChick('status{{$dataUnclaimed->id}}',{{$dataUnclaimed->id}})">未领取</span>
                                @endif
                            </tr>
                            </td>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $dataUnclaimeds->links() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
    <!-- /.content -->
@stop


@section('flibs')
    <script src="/AdminLTE/plugins/iCheck/icheck.min.js"></script>
    <script src="/AdminLTE/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        })
        function statusChick(element,id) {
            $.ajax({
                //提交数据的类型 POST GET
                type:"POST",
                //提交的网址
                url:"/unclaimed/status/"+id,
                //提交的数据
                data:{"id":id},
                //返回数据的格式
                datatype: "html",    //"xml", "html", "script", "json", "jsonp", "text".
                success:function (response, stutas, xhr) {
                    //$(".modal-s-m"+id+" .modal-body").html(response);
                    console.log(response)
                    $('#'+element).text(response[0]);
                    $('#operate'+id).text(response[1]);
                    $('#'+element).removeClass( "bg-red" );
                    $('#'+element).addClass( "bg-green" );

                }
            });
        }

    </script>


@stop