@extends('template.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content_header')

<h1>Editar Empresa</h1>

@endsection

@section('content')
<div class="card card-primary">

    <form id="company-form-update">

        @foreach($recoverCompanyDataByCodhash as $company)
        <div class="card-body">

            <input type="hidden" id="codhash" value="{{ $company->codhash }}" />
            <div class="form-group">
                <label for="cnpj">CNPJ:</label>
                <div class="input-group">
                    <input type="text" name="cnpj" id="cnpj" class="form-control" value="{{$company->cnpj}}" placeholder="00.000.000/0000-00" data-inputmask="'mask': '99.999.999/9999-99'">
                </div>
            </div>

            <div class="form-group">
                <label for="company">Nome da Empresa</label>
                <input type="text" class="form-control" value="{{$company->company}}" name="company" id="company" placeholder="Nome da Empresa">
            </div>

            <div class="form-group">
                <label for="business_name">Razão Social</label>
                <input type="text" class="form-control" value="{{$company->business_name}}" name="business_name" id="business_name" placeholder="Razão Social">
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        @endforeach
    </form>
</div>



@endsection

@section('js')

<script src="{{ asset('vendor/inputmask/inputmask.min.js')}}"></script>
<script src="{{ asset('vendor/inputmask/inputmask.binding.js')}}"></script>

<!-- sweetalert2 -->
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{ asset('js/company.js?') . date('dmYHis') }}"></script>

@endsection