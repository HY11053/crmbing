@extends('admin.admin')
@section('title')客户信息浏览 @stop
@section('content')
    <h1 class="text-center">客户数据数据导入</h1>
    <hr/>
    <div class="col-md-12">
        {{Form::open(array('route' => 'textimport','method'=>'put'))}}
            <div class="col-md-12">
                <p class="timeline-header"><a href="">数据导入区域 一条一行 各组信息之间以‘@’符号分割</a></p>
            </div>
            <div class="form-group col-md-12">
                <textarea class="form-control" name="content" rows="27"></textarea>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">提交数据</button>
            </div>
        {!! Form::close() !!}

    </div>

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

    </script>

    <script>
        $(function () {
            $('#datepicker').datepicker({
                autoclose: true
            });

            //iCheck for checkbox and radio inputs
            $('.basic_info input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //Red color scheme for iCheck
            $('.basic_info input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
            //Flat red color scheme for iCheck
            $('.basic_info input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });


        });
    </script>
@stop