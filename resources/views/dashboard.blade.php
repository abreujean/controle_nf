@extends('template.layout')

@section('css')
<!-- Select2 -->
<link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content_header')
<div class="card card-default col-md-12 d-flex justify-content-center">
  <div class="card-header">
    <h3 class="card-title">Painel</h3>
  </div>

  <div class="card-body">
    <div class="row">
      <div class="col-md-6">

        <div class="form-group">
          <a class="btn btn-app bg-secondary text-md" href="{{ URL('/') }}/{{ $PREFIX }}/invoice-create">
            <i class="fas fa-barcode"></i> Cadastrar Nota Fiscal
          </a>

          <a class="btn btn-app bg-danger text-md" href="{{ URL('/') }}/{{ $PREFIX }}/expense-create">
            <i class="fas fa-barcode"></i> Cadastrar Despesa
          </a>
        </div>

        <div class="form-group">
          <label>Ano Graficos</label>
          <select class="form-control select" name="state" id="graphic-year">
            <option value="0">Selecione o ano</option>
            @foreach($listRegisteredInvoiceYears as $list)
            <option value="{{$list->year}}">{{$list->year}}</option>
            @endforeach
          </select>
        </div>

      </div>
    </div>

  </div>

  <div class="card-footer">

  </div>
</div>

@endsection

@section('content')

<div class="row">

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bell"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Faturamento Disponivel</span>
        <span class="info-box-number" id="available-billing"></span>
      </div>

    </div>

  </div>

  <div class="clearfix hidden-md-up"></div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Receita</span>
        <span class="info-box-number" id="invoice-value-sum"></span>
      </div>

    </div>

  </div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Despesas</span>
        <span class="info-box-number" id="expense-value-sum"></span>
      </div>

    </div>

  </div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total de Cadastro Notas Ficais</span>
        <span class="info-box-number" id="invoice-count">

        </span>
      </div>

    </div>

  </div>

</div>

<div class="row">

  <div class="col-lg-6">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Valores Receita x Despesas</h3>
          <a href="javascript:void(0);"></a>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex">
          <p class="d-flex flex-column">
            <!--span class="text-bold text-lg">$18,230.00</span-->
            <span>Receita x Despesas</span>
          </p>
          <p class="ml-auto d-flex flex-column text-right">
            <span class="text-success">
              <!--i class="fas fa-arrow-up"></i-->
            </span>
            <!--span class="text-muted"></span-->
          </p>
        </div>

        <div class="position-relative mb-4">
          <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
              <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
              <div class=""></div>
            </div>
          </div>
          <canvas id="sales-chart" height="200" style="display: block; width: 765px; height: 200px;" width="765" class="chartjs-render-monitor"></canvas>
        </div>
        <div class="d-flex flex-row justify-content-end">
          <span class="mr-2">
            <i class="fas fa-square text-primary"></i> Receitas
          </span>
          <span>
            <i class="fas fa-square text-gray"></i> Despesas
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Balanço Simples</h3>
          <a href="javascript:void(0);"></a>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex">
          <p class="d-flex flex-column">
            <!--span class="text-bold text-lg"></span-->
            <span>Receita - Despesa</span>
          </p>
          <p class="ml-auto d-flex flex-column text-right">
            <span class="text-success">
              <!--i class="fas fa-arrow-up"></i-->
            </span>
            <span class="text-muted"></span>
          </p>
        </div>

        <div class="position-relative mb-4">
          <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
              <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
              <div class=""></div>
            </div>
          </div>
          <canvas id="visitors-chart" height="200" width="765" style="display: block; width: 765px; height: 200px;" class="chartjs-render-monitor"></canvas>
        </div>
        <div class="d-flex flex-row justify-content-end">
          <span class="mr-2">
            <i class="fas fa-square text-primary"></i> Balanço Simples
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
  <div class="card">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
      <h3 class="card-title">
        <!--i class="fas fa-chart-pie mr-1"></i-->
        Despesas por Categorias
      </h3>
      <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
          <li class="nav-item">
            <!--a class="nav-link active" href="#sales-chart" data-toggle="tab">Despesas por Categoria</a-->
          </li>
        </ul>
      </div>
    </div>
    <div class="card-body">
      <div class="tab-content p-0">

        <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;">
          <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
              <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
              <div class=""></div>
            </div>
          </div>
          <canvas id="sales-chart-canvas" height="300" style="height: 300px; display: block; width: 901px;" class="chartjs-render-monitor" width="901"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

</div>



@endsection

@section('js')


<!-- Painel -->
<script src="{{ asset('vendor\chart.js\Chart.min.js')}}"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- MyJs -->
<script src="{{ asset('js/dashboard.js?') . date('dmYHis') }}"></script>

@endsection