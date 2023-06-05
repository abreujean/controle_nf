@extends('template.layout')

@section('content_header')

<h1>Painel</h1>

@endsection

@section('content')

<div class="row col-12">
  <div class="col-lg-3 col-6">

    <div class="small-box bg-info">
      <div class="inner">
        <h3>150</h3>
        <p>NF Cadastrados</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer"> <!--i class="fas fa-arrow-circle-right"></i--></a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-success">
      <div class="inner">
        <h3>53<sup style="font-size: 20px">%</sup></h3>
        <p>Total do Mês Atual</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer"> <!--i class="fas fa-arrow-circle-right"></i--></a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
      <div class="inner">
        <h3>44</h3>
        <p>Total a Receber</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer"> <!--i class="fas fa-arrow-circle-right"></i--></a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-danger">
      <div class="inner">
        <h3>65</h3>
        <p>Valor restante para MEI</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer"> <!--i class="fas fa-arrow-circle-right"></i--></a>
    </div>
  </div>

</div>


<div class="card col-6">
  <div class="card-header ui-sortable-handle" style="cursor: move;">
    <h3 class="card-title">
      <i class="fas fa-chart-pie mr-1"></i>
      Ganhos por Mês
    </h3>
    <div class="card-tools">
      <ul class="nav nav-pills ml-auto">
        <!--li class="nav-item">
          <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
        </li-->
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
    </div>
  </div>
</div>
@endsection

@section('js')

<!-- Painel -->
<script src="{{ asset('vendor\chart.js\Chart.min.js')}}"></script>

<script src="{{ asset('js/painel.js?') . date('dmYHis') }}"></script>

@endsection