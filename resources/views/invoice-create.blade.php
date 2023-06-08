@extends('template.layout')

@section('css')
<!-- sweetalert2 -->
<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
<!-- Select2 -->
<link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content_header')

<h1>Cadastro Nota Fiscal</h1>

@endsection

@section('content')
<div class="card card-primary">

    <form id="invoice-form-register">
        <div class="card-body">
            <div class="form-group">
                <label>Empresa</label>
                <select class="form-control select" id="id_company" name="state" required>
                    <option value="">Selecione uma Empresa</option>
                    @foreach($listCompany as $list)
                    <option value="{{$list->id}}">{{$list->company}} / {{$list->cnpj}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="number">Número</label>
                <input type="int" class="form-control" id="number" placeholder="Número" required>
            </div>

            <div class="form-group">
                <label for="value">Valor:</label>
                <div class="input-group">
                    <input type="text" name="value" id="value" class="form-control" placeholder="R$ 0,00" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': 'R$ ', 'placeholder': '0,00', 'radixPoint': ',', 'autoGroup': true, 'autoUnmask': true" style="text-align: left;" required>
                </div>
            </div>

            <div class="form-group">
                <label for="month_competency">Mês de competência:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" name="month_competency" id="month_competency" class="form-control" placeholder="MM/AAAA" data-inputmask="'mask': '99/9999'" style="text-align: left;" required>
                </div>
            </div>

            <div class="form-group">
                <label>Data de registro</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" id="receipt_date" class="form-control" data-inputmask-alias="datetime" placeholder="DD/MM/AAAA" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </form>
</div>



@endsection

@section('js')
<!-- inputmask -->
<script src="{{ asset('vendor/inputmask/inputmask.min.js')}}"></script>
<script src="{{ asset('vendor/inputmask/inputmask.binding.js')}}"></script>
<!-- sweetalert2 -->
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- MyJs -->
<script src="{{ asset('js/invoice.js?') . date('dmYHis') }}"></script>

@endsection