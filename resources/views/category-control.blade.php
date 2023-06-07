@extends('template.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables/css/buttons.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">

@endsection

@section('content_header')

<h1>Controle Categoria</h1>

@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categorias Cadastradas</h3>
                </div>

                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table-category" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Categoria</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Descrição</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Ativo</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Categoria</th>
                                            <th rowspan="1" colspan="1">Descrição</th>
                                            <th rowspan="1" colspan="1">Ativo</th>
                                            <th rowspan="1" colspan="1">Ações(s)</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('js')


<!-- sweetalert2 -->
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{ asset('js/category.js?') . date('dmYHis') }}"></script>

<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('vendor/datatables/js/buttons.bootstrap4.min.js')}}"></script>


<script>


</script>

@endsection