@extends('template.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content_header')

<h1>Editar Usuario</h1>

@endsection

@section('content')
<div class="card card-primary">

    <form id="user-form-update">

        @foreach($recoverUserDataByCodhash as $user)
        <div class="card-body">

            <input type="hidden" id="codhash" value="{{ $user->codhash }}" />

            <div class="form-group">
                <label>Alerta <i class="fas fa-envelope"></i></label>
                <select class="form-control select" id="alert" name="alert">
                    <option value="desativado" @if($user->alert == 'desativado') selected @endif>Desativado</option>
                    <option value="sms" @if($user->alert == 'sms') selected @endif>SMS</option>
                    <option value="email" @if($user->alert == 'email') selected @endif>Email</option>
                </select>
            </div>

            <div class="form-group">
                <label>Perfil</label>
                <select class="form-control select" id="id_profile" name="state">
                    <option value="">Selecione um Perfil</option>
                    @foreach($listProfile as $list)
                    <option value="{{$list->id}}"  @if($user->id_profile == $list->id) selected @endif >{{$list->profile}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" value="{{$user->name}}" name="name" id="name" placeholder="Nome da Empresa">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" value="{{$user->email}}" name="email" id="email" placeholder="Razão Social">
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" value="{{$user->password}}" name="password" id="password" placeholder="Razão Social">
                <input type="hidden" id="current_password" value="{{ $user->password }}" />
            </div>

            <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{$user->phone}}" data-inputmask="mask:(99)99999-9999" data-mask="" inputmode="text">
            </div>

            <div class="custom-control custom-switch">
                    <input type="checkbox" @if($user->active == $ACTIVE) checked @endif class="custom-control-input" id="active">
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

<script src="{{ asset('js/user.js?') . date('dmYHis') }}"></script>

@endsection