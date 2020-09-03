@extends('layouts.backend.app')
@push('header')
<script src="{{asset('backend/assets/js/init-scripts/plotly/plotly.min.js')}}"></script>
<script src="https://d3js.org/d3.v5.min.js"></script>
@endpush
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>esp32</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="col-xl-3 col-lg-6 mb-2">
        <div id="w1" style="width: 300px;height:300px"></div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-2">
        <div id="w2" style="width: 300px;height:300px"></div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-2">
        <div id="w3" style="width: 300px;height:300px"></div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-2">
        <div id="w4" style="width: 300px;height:300px"></div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-2">
        <div id="w5" style="width: 300px;height:300px"></div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-2">
        <div id="w6" style="width: 300px;height:300px"></div>
    </div>
    <div class="col-md-12 mb-2">
        <div id="w1-chart"></div>
    </div>
</div>
<!-- .content -->
@endsection
@push('footer')
    <script>
        function initGauge(div,title,value,range){
            var data = [
                {
                  domain: { x: [0, 1], y: [0, 1] },
                  value: value,
                  title: { text: title },
                  type: "indicator",
                  mode: "gauge+number",
                  delta: { reference: 400 },
                  gauge: { axis: { range: range } }
                }
              ];
              var layout = {  margin: { t: 0, b: 0, l: 40, r: 40 }};
              Plotly.newPlot(div, data, layout);
        }
        initGauge('w1','PM 2.5 (ug/m3)',{{$iotData->last()->pm2_5}},[0,2000]);
        initGauge('w2','PM 10 (ug/m3)',{{$iotData->last()->pm10}},[0,2000]);
        initGauge('w3','Temperature', {{$iotData->last()->temp}},[0,100]);
        initGauge('w4','Humidity (%)',{{$iotData->last()->hum}},[0,100]);
        initGauge('w5','Pressure (mbr)', {{$iotData->last()->pressure}},[800,1300]);
        initGauge('w6','Sealevel (meter)', {{$iotData->last()->sealevel}},[0,500]);

        //////////////////////////////////////////////////////
        Plotly.d3.csv("https://raw.githubusercontent.com/plotly/datasets/master/finance-charts-apple.csv", function(err, rows){

            function unpack(rows, key) {
            return rows.map(function(row) { return row[key]; });
          }


          var trace1 = {
            type: "scatter",
            mode: "lines",
            name: 'AAPL High',
            x: unpack(rows, 'Date'),
            y: unpack(rows, 'AAPL.High'),
            line: {color: '#17BECF'}
          }

          var trace2 = {
            type: "scatter",
            mode: "lines",
            name: 'AAPL Low',
            x: unpack(rows, 'Date'),
            y: unpack(rows, 'AAPL.Low'),
            line: {color: '#7F7F7F'}
          }

          var data = [trace1,trace2];

          var layout = {
            title: 'Basic Time Series',
          };

          Plotly.newPlot('w1-chart', data, layout);
          })

    </script>
@endpush
