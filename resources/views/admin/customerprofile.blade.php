@extends('admin.admin')
@section('title')客户信息查看 @stop
@section('content')
    <!-- The timeline -->
    <ul class="timeline timeline-inverse">
        <!-- timeline time label -->
        <li class="time-label">
                        <span class="bg-red">{{date("M j, Y")}} </span>
        </li>
        <li>
            <i class="fa fa-user bg-blue"></i>

            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i>  录入时间 {{$customer->created_at}}</span>

                <h3 class="timeline-header"><a href="#">客户信息</a>| 客户当前基本信息</h3>

                <div class="timeline-body">
                   <p>客户姓名：{{$customer->name}}</p>
                   <p>客户性别：{{$customer->gender}}</p>
                   <p>客户电话：{{$customer->phone}}</p>
                   <p>客户微信：{{$customer->wechat}}</p>
                   <p>订单状态：@if(empty($customer->dealstatus)) 进行中 @elseif($customer->dealstatus==1)已成单 @else 已退单@endif</p>
                   <p>套餐类型：{{\App\Admin\Packagetype::where('id',$customer->package)->value('sections')}}</p>
                   <p>信息来源：{{\App\Admin\Referer::where('id',$customer->referer)->value('sections')}}</p>
                   <p>广告来源：{{\App\Admin\Advertisement::where('id',$customer->advertisement)->value('sections')}}</p>
                </div>
                <div class="timeline-footer"> </div>
            </div>
        </li>

        <li>
            <i class="fa fa-comments bg-yellow"></i>

            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 最后回访@if(count($customer->Cnotes)>0) {{$customer->Cnotes->last()->created_at}}@endif</span>

                <h3 class="timeline-header"><a href="#">回访记录</a> commented on your post</h3>

                <div class="timeline-body">
                    <ul class="list-group">
                        <p><i class="fa fa-blind" style="padding-right: 5px;"></i>{{$customer->created_at}}---{{$customer->inputer}}录入数据</p>
                        @foreach($customer->Cnotes as $cnote)
                            <p><i class="fa fa-blind" style="padding-right: 5px;"></i>{{$cnote->created_at}}{{$cnote->notes}}</p>
                        @endforeach
                    </ul>
                </div>
                <div class="timeline-footer">
                </div>
            </div>
        </li>
        <!-- END timeline item -->
        <!-- timeline time label -->
        <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
        </li>
        <!-- /.timeline-label -->
        <!-- timeline item -->
        <li>
            <i class="fa fa-camera bg-purple"></i>

            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                <h3 class="timeline-header"><a href="#">客户合同</a> uploaded new photos</h3>

                <div class="timeline-body">
                    <img src="" alt="..." class="margin">
                    <img src="" alt="..." class="margin">
                    <img src="" alt="..." class="margin">
                    <img src="" alt="..." class="margin">
                </div>
            </div>
        </li>
        <!-- END timeline item -->
        <li>
            <i class="fa fa-clock-o bg-gray"></i>
        </li>
    </ul>
@stop