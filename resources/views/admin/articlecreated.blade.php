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
                    <input type="text" class="form-control" id="brandname" name="brandname" @if(isset($options['brandname'])) value="{{$options['brandname']}}" @endif aria-describedby="inputSuccess3Status">
                    <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    <span id="inputSuccess3Status" class="sr-only">(success)</span>
                </div>
            </div>
            <hr/>
            <div class="form-group ">
                <label class="checkbox-inline">
                    <input type="checkbox" id="jmlc" @if(isset($options['ppjs'])) checked @endif name="ppjs" value="jmlc"> 品牌介绍
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="jmlc" @if(isset($options['ppjs'])) checked @endif name="jmlc" value="jmlc"> 加盟流程
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="jmtj" @if(isset($options['jmtj'])) checked @endif name="jmtj" value="jmtj"> 加盟条件
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="jmzc" @if(isset($options['jmzc'])) checked @endif name="jmzc" value="jmzc"> 加盟支持
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="xzjq" @if(isset($options['xzjq'])) checked @endif name="xzjq" value="xzjq"> 选址技巧
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="jyjq" @if(isset($options['jyjq'])) checked @endif name="jyjq" value="jyjq"> 经营技巧
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="tzfx" @if(isset($options['tzfx'])) checked @endif name="tzfx" value="tzfx"> 投资分析
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="lrfx" @if(isset($options['lrfx'])) checked @endif name="lrfx" value="lrfx"> 利润分析
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="comment" @if(isset($options['comment'])) checked @endif name="comment" value="comment"> 品牌评论
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="comment" @if(isset($options['anli'])) checked @endif name="anli" value="anli"> 加盟案例
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
                    <input type="radio" name="replaces" id="replace" value="0"> 是
                </label>

            </div>
            <hr/>
            <button type="submit" class="btn btn-primary">生成数据</button>

        </form>
    </div>
    <hr>
    <div class="row">
    <div class="col-md-10 col-md-offset-1">

        <div class="article">
            @if(isset($options['brandname']) && !empty($options['brandname']) && isset($options['ppjs']))<h2>{{$options['brandname']}}品牌介绍</h2> @endif
            @if( isset($options['ppjs']) && $articledatas['ppjs']->count())

                @foreach($articledatas['ppjs'] as $index=>$ppjsdata)
                    @if(strpos($ppjsdata->content,'@'))
                        @foreach(explode('@',$ppjsdata->content) as $ppjsdatason)
                            <p>{{str_replace('{}',$options['brandname'],$ppjsdatason)}}</p>
                        @endforeach
                    @else
                        <p>{{str_replace('{}',$options['brandname'],$ppjsdata->content)}}</p>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="article">
            @if(isset($options['brandname']) && !empty($options['brandname']) && isset($jmlcdatas))<h2>{{$options['brandname']}}加盟流程</h2> @endif
            @if(isset($jmlcdatas) && !empty($jmlcdatas))
                    @if(strpos($jmlcdatas->content,'@'))
                        @foreach(explode('@',$jmlcdatas->content) as $jmlcdatason)
                            <p>{{str_replace('{}',$options['brandname'],$jmlcdatason)}}</p>
                        @endforeach
                    @else
                        <p>{{str_replace('{}',$options['brandname'],$jmlcdatas->content)}}</p>
                    @endif

            @endif
        </div>
        <div class="article">
            @if(isset($options['brandname']) && !empty($options['brandname']) && isset($options['jmtj']))<h2>{{$options['brandname']}}加盟条件</h2> @endif
            @if(isset($options['jmtj']) && $articledatas['jmtj']->count())
                @foreach($articledatas['jmtj'] as $index=>$jmtjdata)
                    @if(strpos($jmtjdata->content,'@'))
                        @foreach(explode('@',$jmtjdata->content) as $jmtjdatason)
                            <p>{{str_replace('{}',$options['brandname'],$jmtjdatason)}}</p>
                        @endforeach
                    @else
                        <p>{{$index+1}}、{{str_replace('{}',$options['brandname'],$jmtjdata->content)}}</p>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="article">
            @if(isset($options['brandname']) && !empty($options['brandname']) && isset($options['jmzc']))<h2>{{$options['brandname']}}加盟支持</h2> @endif
            @if( isset($options['jmzc']) && $articledatas['jmzc']->count())

                @foreach($articledatas['jmzc'] as $index=>$jmzcdata)
                    @if(strpos($jmzcdata->content,'@'))
                        @foreach(explode('@',$jmzcdata->content) as $jmzcdatason)
                            <p>{{str_replace('{}',$options['brandname'],$jmzcdatason)}}</p>
                        @endforeach
                    @else
                        <p>{{$index+1}}、{{str_replace('{}',$options['brandname'],$jmzcdata->content)}}</p>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="article">
            @if(isset($options['brandname']) && !empty($options['brandname']) && isset($options['xzjq']))<h2>{{$options['brandname']}}选址技巧</h2> @endif
            @if( isset($options['xzjq']) && $articledatas['xzjq']->count())

                @foreach($articledatas['xzjq'] as $index=>$xzjqdata)
                    @if(strpos($xzjqdata->content,'@'))
                        @foreach(explode('@',$xzjqdata->content) as $xzjqdatason)
                            <p>{{str_replace('{}',$options['brandname'],$xzjqdatason)}}</p>
                        @endforeach
                    @else
                        <p>{{$index+1}}、{{str_replace('{}',$options['brandname'],$xzjqdata->content)}}</p>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="article">
            @if(isset($options['brandname']) && !empty($options['brandname']) && isset($options['jyjq']))<h2>{{$options['brandname']}}经营技巧</h2> @endif
            @if(isset($options['jyjq']) && $articledatas['jyjq']->count())

                @foreach($articledatas['jyjq'] as $index=>$jyjqdata)
                    @if(strpos($jyjqdata->content,'@'))
                        @foreach(explode('@',$jyjqdata->content) as $jyjqdatason)
                            <p>{{str_replace('{}',$options['brandname'],$jyjqdatason)}}</p>
                        @endforeach
                    @else
                        <p>{{$index+1}}、{{str_replace('{}',$options['brandname'],$jyjqdata->content)}}</p>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="article">
            @if(isset($options['brandname']) && !empty($options['brandname']) && isset($options['tzfx']))<h2>{{$options['brandname']}}投资分析</h2> @endif
            @if(isset($options['tzfx']) && $articledatas['tzfx']->count())

                @foreach($articledatas['tzfx'] as $index=>$tzfxdata)
                    @if(strpos($tzfxdata->content,'@'))
                        @foreach(explode('@',$tzfxdata->content) as $tzfxdatason)
                            <p>{{str_replace('{}',$options['brandname'],$tzfxdatason)}}</p>
                        @endforeach
                    @else
                        <p>{{$index+1}}、{{str_replace('{}',$options['brandname'],$tzfxdata->content)}}</p>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="article">
            @if(isset($options['brandname']) && !empty($options['brandname']) && isset($options['lrfx']))<h2>{{$options['brandname']}}利润分析</h2> @endif
            @if(isset($options['lrfx']) && $articledatas['lrfx']->count())

                @foreach($articledatas['lrfx'] as $index=>$lrfxdata)
                    @if(strpos($lrfxdata->content,'@'))
                        @foreach(explode('@',$lrfxdata->content) as $lrfxdatason)
                            <p>{{str_replace('{}',$options['brandname'],$lrfxdatason)}}</p>
                        @endforeach
                    @else
                        <p>{{$index+1}}、{{str_replace('{}',$options['brandname'],$lrfxdata->content)}}</p>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="article">
            @if(isset($options['brandname']) && !empty($options['brandname']) && isset($options['comment']))<h2>{{$options['brandname']}}品牌评论</h2> @endif
            @if(isset($options['comment']) && $articledatas['comment']->count())

                @foreach($articledatas['comment'] as $index=>$commentdata)
                    @if(strpos($commentdata->content,'@'))
                        @foreach(explode('@',$commentdata->content) as $commentdatason)
                            <p>{{str_replace('{}',$options['brandname'],$commentdatason)}}</p>
                        @endforeach
                    @else
                        <p>{{$index+1}}、{{str_replace('{}',$options['brandname'],$commentdata->content)}}</p>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="article">
            @if(isset($options['brandname']) && !empty($options['brandname']) && isset($options['anli']))<h2>{{$options['brandname']}}加盟案例</h2> @endif
            @if( isset($options['anli']) && $articledatas['anli']->count())

                @foreach($articledatas['anli'] as $index=>$anlidata)
                    @if(strpos($anlidata->content,'@'))
                        @foreach(explode('@',$anlidata->content) as $anlidatason)
                            <p>{{str_replace('{}',$options['brandname'],$anlidatason)}}</p>
                        @endforeach
                    @else
                        <p>{{$index+1}}、{{str_replace('{}',$options['brandname'],$anlidata->content)}}</p>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    </div>
@stop
