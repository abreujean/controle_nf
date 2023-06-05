@extends('template.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content_header')

<h1>Cadastro Empresa</h1>

@endsection

@section('content')
<div class="card card-primary">

    <form id="empresa-form-cadastrar">
        <div class="card-body">

            <div class="form-group">
                <label for="cnpj">CNPJ:</label>
                <div class="input-group">
                    <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="00.000.000/0000-00" data-inputmask="'mask': '99.999.999/9999-99'">
                </div>
            </div>

            <div class="form-group">
                <label for="razao-social">Razão Social</label>
                <input type="text" class="form-control" name="razao" id="razao" placeholder="Razão Social">
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>



@endsection

@section('js')

<script src="{{ asset('vendor/inputmask/inputmask.min.js')}}"></script>
<script src="{{ asset('vendor/inputmask/inputmask.binding.js')}}"></script>

<!-- sweetalert2 -->
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{ asset('js/empresa.js?') . date('dmYHis') }}"></script>

@endsection