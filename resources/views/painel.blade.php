@extends('template.layout')



@section('content_header')
<div class="card">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Sales
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content p-0">

            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="revenue-chart-canvas" height="300" style="height: 300px; display: block; width: 578px;" width="578" class="chartjs-render-monitor"></canvas>
            </div>
            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                <canvas id="sales-chart-canvas" height="0" style="height: 0px; display: block; width: 0px;" class="chartjs-render-monitor" width="0"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<!-- Painel -->
<script src="{{ asset('vendor\chart.js\Chart.min.js')}}"></script>

<script src="{{ asset('js/painel.js?') . date('dmYHis') }}"></script>

@endsection