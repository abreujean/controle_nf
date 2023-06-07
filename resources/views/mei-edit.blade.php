@extends('template.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content_header')

<h1>Editar MEI</h1>

@endsection

@section('content')
<div class="card card-primary">

    <form id="mei-form-update">

        @foreach($recoverMeiDataByCodhash as $mei)
        <div class="card-body">

            <input type="hidden" id="codhash" value="{{ $mei->codhash }}" />

            <div class="form-group">
                <label for="max_value">Valor Máximo:</label>
                <div class="input-group">
                    <input type="text" value="{{$mei->max_value}}" name="max_value" id="max_value" class="form-control" placeholder="R$ 0,00" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': 'R$ ', 'placeholder': '0,00', 'radixPoint': ',', 'autoGroup': true, 'autoUnmask': true" style="text-align: left;" required>
                </div>
            </div>

        </div>
        @endforeach

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

<script src="{{ asset('js/mei.js?') . date('dmYHis') }}"></script>

@endsection