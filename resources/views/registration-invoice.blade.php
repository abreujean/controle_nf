@extends('template.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content_header')

<h1>Cadastro NF</h1>

@endsection

@section('content')
<div class="card card-primary">

    <form id="notaFiscal-form-cadastrar">
        <div class="card-body">

            <div class="form-group">
                <label for="exampleSelectRounded0">Empresa</label>
                <select class="custom-select rounded-0" id="id_empresa" required>
                    <option value="">Selecione uma Empresa</option>
                    @foreach($listarEmpresa as $lista)
                        <option value="{{$lista->id}}">{{$lista->razao_social}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Número</label>
                <input type="int" class="form-control" id="numero" placeholder="Número" required>
            </div>
 
            <div class="form-group">
                <label for="valor">Valor:</label>
                <div class="input-group">
                    <input type="text" name="valor" id="valor" class="form-control" placeholder="0,00" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': 'R$ ', 'placeholder': '0,00', 'radixPoint': ',', 'autoGroup': true, 'autoUnmask': true" style="text-align: left;" required>
                </div>
            </div>

            <div class="form-group">
                <label for="mes_competencia">Mês de competência:</label>
                <div class="input-group">
                    <input type="text" name="mes_competencia" id="mes_competencia" class="form-control" placeholder="MM/AAAA" data-inputmask="'mask': '99/9999'" style="text-align: left;" required>
                </div>
            </div>

            <div class="form-group">
                <label for="mes_caixa">Mês de caixa:</label>
                <div class="input-group">
                    <input type="text" name="mes_caixa" id="mes_caixa" class="form-control" placeholder="MM/AAAA" data-inputmask="'mask': '99/9999'" style="text-align: left;" required>
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

<!-- sweetalert2 -->
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{ asset('js/nota-fiscal.js?') . date('dmYHis') }}"></script>


@endsection