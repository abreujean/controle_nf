@extends('template.layout')

@section('content_header')

<h1>Cadastro NF</h1>

@endsection

@section('content')
<div class="card card-primary">

    <form>
        <div class="card-body">

            <div class="form-group">
                <label for="exampleSelectRounded0">Empresa</label>
                <select class="custom-select rounded-0" id="exampleSelectRounded0">
                    <option>Value 1</option>
                    <option>Value 2</option>
                    <option>Value 3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Número</label>
                <input type="int" class="form-control" id="numero" placeholder="Número">
            </div>
 
            <div class="form-group">
                <label for="valor">Valor:</label>
                <div class="input-group">
                    <input type="text" name="valor" id="valor" class="form-control" placeholder="0,00" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': 'R$ ', 'placeholder': '0,00', 'radixPoint': ',', 'autoGroup': true, 'autoUnmask': true" style="text-align: left;">
                </div>
            </div>

            <div class="form-group">
                <label for="valor">Mês de competencia:</label>
                <div class="input-group">
                    <input type="text" name="valor" id="valor" class="form-control" placeholder="MM/AAAA" data-inputmask="'mask': '99/9999'" style="text-align: left;">
                </div>
            </div>

            <div class="form-group">
                <label for="valor">Mês de caixa:</label>
                <div class="input-group">
                    <input type="text" name="valor" id="valor" class="form-control" placeholder="MM/AAAA" data-inputmask="'mask': '99/9999'" style="text-align: left;">
                </div>
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


<script src="{{ asset('js/cadastro-nf.js?') . date('dmYHis') }}"></script>


@endsection