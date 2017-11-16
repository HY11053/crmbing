<script>
    $(function () {
        'use strict';
        var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
        var salesChart = new Chart(salesChartCanvas);
        var salesChartData = {
            labels: [
                "星期{{\Carbon\Carbon::parse(date('Y-m-d H:i:s',strtotime(\Carbon\Carbon::now())-3600*24*7))->dayOfWeek?:'日'}}",
                "星期{{\Carbon\Carbon::parse(date('Y-m-d H:i:s',strtotime(\Carbon\Carbon::now())-3600*24*6))->dayOfWeek?:'日'}}",
                "星期{{\Carbon\Carbon::parse(date('Y-m-d H:i:s',strtotime(\Carbon\Carbon::now())-3600*24*5))->dayOfWeek?:'日'}}",
                "星期{{\Carbon\Carbon::parse(date('Y-m-d H:i:s',strtotime(\Carbon\Carbon::now())-3600*24*4))->dayOfWeek?:'日'}}",
                "星期{{\Carbon\Carbon::parse(date('Y-m-d H:i:s',strtotime(\Carbon\Carbon::now())-3600*24*3))->dayOfWeek?:'日'}}",
                "星期{{\Carbon\Carbon::parse(date('Y-m-d H:i:s',strtotime(\Carbon\Carbon::now())-3600*24*2))->dayOfWeek?:'日'}}",
                "星期{{\Carbon\Carbon::yesterday()->dayOfWeek}}", "星期{{\Carbon\Carbon::now()->dayOfWeek?:'日'}}"

            ],
            datasets: [
                {
                    label: "上一周数据",
                    fillColor: "rgb(210, 214, 222)",
                    strokeColor: "rgb(210, 214, 222)",
                    pointColor: "rgb(210, 214, 222)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgb(220,220,220)",
                    data: [
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(14))->where('created_at','<',\Carbon\Carbon::today()->subDays(13))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(13))->where('created_at','<',\Carbon\Carbon::today()->subDays(12))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(12))->where('created_at','<',\Carbon\Carbon::today()->subDays(11))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(11))->where('created_at','<',\Carbon\Carbon::today()->subDays(10))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(10))->where('created_at','<',\Carbon\Carbon::today()->subDays(9))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(9))->where('created_at','<',\Carbon\Carbon::today()->subDays(8))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(8))->where('created_at','<',\Carbon\Carbon::today()->subDays(7))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(7))->where('created_at','<',\Carbon\Carbon::today()->subDays(6))->count()}},

                    ]
                },
                {
                    label: "近一周数据",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(7))->where('created_at','<',\Carbon\Carbon::today()->subDays(6))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(6))->where('created_at','<',\Carbon\Carbon::today()->subDays(5))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(5))->where('created_at','<',\Carbon\Carbon::today()->subDays(4))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(4))->where('created_at','<',\Carbon\Carbon::today()->subDays(3))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(3))->where('created_at','<',\Carbon\Carbon::today()->subDays(2))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today()->subDays(2))->where('created_at','<',\Carbon\Carbon::today()->subDays(1))->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::yesterday())->where('created_at','<',\Carbon\Carbon::today())->count()}},
                        {{\App\Admin\Customer::where('created_at','>',\Carbon\Carbon::today())->count()}}
                    ]
                }
            ]
        };

        var salesChartOptions = {
            showScale: true,
            scaleShowGridLines: false,
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleGridLineWidth: 1,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            bezierCurve: true,
            bezierCurveTension: 0.3,
            pointDot: false,
            pointDotRadius: 4,
            pointDotStrokeWidth: 1,
            pointHitDetectionRadius: 20,
            datasetStroke: true,
            datasetStrokeWidth: 2,
            datasetFill: true,
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
            maintainAspectRatio: true,
            responsive: true
        };
        salesChart.Line(salesChartData, salesChartOptions);
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
    @foreach($advertisementsInfos as $index=>$advertisementsInfo)
        {
            value: {{$advertisementsInfo}},
            color: "{{$colorfuls[$j++]}}",
                highlight: "{{$colorfuls[$j-1]}}",
            label: "{{\App\Admin\Advertisement::where('id',$index)->value('sections')}}"
        },

        @endforeach
        ];
        var pieOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 1,
            percentageInnerCutout: 50,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
            responsive: true,
            maintainAspectRatio: false,
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
            tooltipTemplate: "<%=value %> <%=label%> 人数"
        };
        pieChart.Doughnut(PieData, pieOptions);
    });
    </script>