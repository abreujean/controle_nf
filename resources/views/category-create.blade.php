@extends('template.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content_header')

<h1>Cadastro Categoria</h1>

@endsection

@section('content')
<div class="card card-primary">

    <form id="category-form-register">
        <div class="card-body">

             <div class="form-group">
                <label for="category">Categoria</label>
                <input type="text" class="form-control" name="category" id="category" placeholder="Nome da Empresa">
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea class="form-control" rows="3" id="description" placeholder="Enter ..."  maxlength="100"></textarea>
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

<script src="{{ asset('js/category.js?') . date('dmYHis') }}"></script>

@endsection