import $ from "jquery";
import Swal from 'sweetalert2';
import {PERFIL_ADMINISTRADOR} from './helpers';

/**
 * Função para recuperar o id_perfil administrativo cujo email está como parametro.
 */
window.recuperarIdPerfilAdministrativoPeloEmail = function() {
  const data = { email: $("#email").val() };

  $.post({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: "/recuperar-id-perfil-administrativo-pelo-email",
      type: "POST",
      data: data,
      success: function (data) {
          $("#id_perfil").val(data);
      },
  });

};

/**
 * Funcao para fazer login
 */
$("#login_form").submit(function (event) {
    event.preventDefault();

    const data = {
        email: $("#email").val(),
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
    if($("#id_perfil").val() == PERFIL_ADMINISTRADOR){
      url = "/logando-administrador"
    }else{
      url = "/logando-colaborador"
    }
    return url;
};


/**
 * Verificar qual rota seguir apos realizar o login
 */
const verificaRotaPainelAposLogin = () => {
    var url = ""
    if($("#id_perfil").val() == PERFIL_ADMINISTRADOR){
      url = "/administrador/painel"
    }else{
      url = "/colaborador/painel"
    }

    return url;
};


/*(() => {
  window.teste();
})();*/