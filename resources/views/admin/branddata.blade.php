@extends('admin.admin')
@section('title') 品牌汇总@stop
@section('headlibs')
    <meta name="csrf-token" content="{{ csrf_token() }}">
<link href="/adminlte/plugins/iCheck/all.css" rel="stylesheet">
@stop
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">零食品牌数据/<small>{{$option}}</small></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <table class="table table-condensed">
            <tr>
                <th style="width: 40px">#</th>
                <th>品牌名称</th>
                <th>所属分类</th>
                <th>品牌热度</th>
                <th style="text-align: center;">品牌状态</th>
                <th>操作</th>
            </tr>
            <tr>
                @foreach($branddatas as $branddata)
                <td>{{$loop->iteration}}</td>
                <td>{{$branddata->brands}}</td>
                <td>{{$branddata->type}}</td>
                <td>{{$branddata->nums}}</td>
                <td style="text-align: center">
                    @if($branddata->status)
                        <span class="badge bg-green" style=" font-weight: normal;">已使用</span>
                    @else
                    <span class="badge bg-red" style="cursor: pointer; font-weight: normal;" id="status{{$branddata->id}}" onclick="statuschick('status{{$branddata->id}}',{{$branddata->id}})">未使用</span>
                    @endif
                </td>
                    <td><a href="/branddatas/del/{{$branddata->id}}">删除</a></td>
            </tr>
            @endforeach
        </table>
        <div class="box-footer clearfix">
            {{ $branddatas->links() }}
        </div>
    </div>
    <!-- /.box-body -->
</div>
@stop
@section('flibs')
    <!-- iCheck 1.0.1 -->
    <script src="/adminlte/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        });
        $(function () {
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
        function statuschick(element,id) {
            $.ajax({
                //提交数据的类型 POST GET
                type:"POST",
                //提交的网址
                url:"/status/"+id,
                //提交的数据
                data:{"id":id},
                //返回数据的格式
                datatype: "html",    //"xml", "html", "script", "json", "jsonp", "text".
                success:function (response, stutas, xhr) {
                    //$(".modal-s-m"+id+" .modal-body").html(response);
                   $('#'+element).text(response);
                    $('#'+element).removeClass( "bg-red" );
                    $('#'+element).addClass( "bg-green" );

                }
            });
        }
    </script>

@stop