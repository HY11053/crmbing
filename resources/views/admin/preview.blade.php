@extends('admin.admin')
@section('title') 内容预览 @stop
@section('headlibs')
    <link href="/adminlte/plugins/iCheck/all.css" rel="stylesheet">
@stop
@section('content')
<p>{{$thisarticle->content}}</p>
@stop
