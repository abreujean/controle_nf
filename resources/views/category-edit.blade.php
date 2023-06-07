@extends('template.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content_header')

<h1>Editar Categoria</h1>

@endsection

@section('content')
<div class="card card-primary">

    <form id="category-form-update">

        @foreach($recoverCategoryDataByCodhash as $category)
        <div class="card-body">

            <input type="hidden" id="codhash" value="{{ $category->codhash }}" />
            <div class="form-group">
                <label for="category">Categoria</label>
                <input type="text" class="form-control" value="{{ $category->category}}" name="category" id="category" placeholder="Nome da Empresa">
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea class="form-control" rows="3" id="description" placeholder="Enter ..."  maxlength="100">{{ $category->description }}</textarea>
            </div>

            <div class="custom-control custom-switch">
                    <input type="checkbox" @if($category->active == $ACTIVE) checked @endif class="custom-control-input" id="active">
                    <label class="custom-control-label" for="active">Ativo</label>
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

<script src="{{ asset('js/category.js?') . date('dmYHis') }}"></script>

@endsection