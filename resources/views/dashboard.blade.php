@extends('template.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@endsection

@section('content_header')
<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Painel</h3>
  </div>

  <div class="card-body">
    <div class="row">
      <div class="col-md-6" >
        <div class="form-group" >
          <label>Selecione o ano</label>
          <select class="form-control select"  name="state">
          <option value="AL">Alabama</option>
          <option value="WY">Wyoming</option>
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
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">CPU Traffic</span>
        <span class="info-box-number">
          10
          <small>%</small>
        </span>
      </div>

    </div>

  </div>

  <div class="clearfix hidden-md-up"></div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Sales</span>
        <span class="info-box-number">760</span>
      </div>

    </div>

  </div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Likes</span>
        <span class="info-box-number">41,410</span>
      </div>

    </div>

  </div>




  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bell"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">New Members</span>
        <span class="info-box-number">2,000</span>
      </div>

    </div>

  </div>

</div>

<div class="row">

  <div class="col-lg-6">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Sales</h3>
          <a href="javascript:void(0);">View Report</a>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex">
          <p class="d-flex flex-column">
            <span class="text-bold text-lg">$18,230.00</span>
            <span>Sales Over Time</span>
          </p>
          <p class="ml-auto d-flex flex-column text-right">
            <span class="text-success">
              <i class="fas fa-arrow-up"></i> 33.1%
            </span>
            <span class="text-muted">Since last month</span>
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
            <i class="fas fa-square text-primary"></i> This year
          </span>
          <span>
            <i class="fas fa-square text-gray"></i> Last year
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Online Store Visitors</h3>
          <a href="javascript:void(0);">View Report</a>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex">
          <p class="d-flex flex-column">
            <span class="text-bold text-lg">820</span>
            <span>Visitors Over Time</span>
          </p>
          <p class="ml-auto d-flex flex-column text-right">
            <span class="text-success">
              <i class="fas fa-arrow-up"></i> 12.5%
            </span>
            <span class="text-muted">Since last week</span>
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
            <i class="fas fa-square text-primary"></i> This Week
          </span>
          <span>
            <i class="fas fa-square text-gray"></i> Last Week
          </span>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('js')


<!-- Painel -->
<script src="{{ asset('vendor\chart.js\Chart.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset('js/dashboard.js?') . date('dmYHis') }}"></script>

@endsection