import $ from "jquery";
import Swal from 'sweetalert2';
import {PERFIL_COLABORADOR, PERFIL_ADMINISTRADOR} from './helpers';

(() => {
  console.log(PERFIL_COLABORADOR);
})();



/**
 * Funcao para fazer login
 */
$("#login_form").submit(function (event) {
    event.preventDefault();

    const data = {
        usuario: $("#email").val(),
        senha: $("#senha").val()
    };

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: verificaRotaLogin(),
        dataType: "json",
        type: "POST",
        data: data,
        success: function (data) {
            Toast.fire({ icon: "success", title: data });
            location.href = verificaRotaPainelAposLogin();
        },
        error: function (jqXHR, status, error) {
            Toast.fire({ icon: "error", title: jqXHR.responseJSON });
        },
    });

})



/**
 * Verificar qual rota seguir no login
 */
const verificaRotaLogin = () => {
    var url = ""
    if($("#id_perfil").val() == PERFIL_COLABORADOR){
      url = "/logando-colaborador"
    }else if($("#id_perfil").val() == PERFIL_ADMINISTRADOR){
      url = "/logando-administrador"
    }else{
      url = "/logando-colaborador"
    }
    return url;
};


/**
 * Verificar qual rota seguir no login
 */
const verificaRotaPainelAposLogin = () => {
    var url = ""
    if($("#id_perfil").val() == PERFIL_COLABORADOR){
      url = "/colaborador/painel"
    }else if($("#id_perfil").val() == PERFIL_ADMINISTRADOR){
      url = "/administrador/painel"
    }else{
      url = "/colaborador/painel"
    }

    return url;
};