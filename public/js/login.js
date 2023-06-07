/**
 * Functio to recover user id_profile by email
 */
const recoveProfileIdByEmail = () => {
  const data = { email: $("#email").val() };

  $.post({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: "/recover-profile-id-by-email",
      type: "POST",
      data: data,
      success: function (data) {
          $("#id_profile").val(data);
      },
  });

};

/**
 * Funcao para fazer login
 */
$( "#login_form" ).on( "submit", function( event ) {
    event.preventDefault();

    const data = {
        email: $("#email").val(),
        password: $("#password").val()
    };

    console.log(data);

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
        url: checkRouteLogin(),
        dataType: "json",
        type: "POST",
        data: data,
        success: function (data) {
            Toast.fire({ icon: "success", title: data });
            location.href = checkRouteDashboardAfterLogin();
        },
        error: function (jqXHR, status, error) {
            Toast.fire({ icon: "error", title: jqXHR.responseJSON });
        },
    });

})


/**
 * Verificar qual rota seguir no login
 */
const checkRouteLogin = () => {
    var url = ""
    if($("#id_profile").val() == PROFILE_ADMINISTRATOR){
      url = "/logging-administrato"
    }else{
      url = "/logging-contributor"
    }
    return url;
};


/**
 * Verificar qual rota seguir apos realizar o login
 */
const checkRouteDashboardAfterLogin = () => {
    var url = ""
    if($("#id_profile").val() == PROFILE_ADMINISTRATOR){
      url = "/administrator/dashboard"
    }else{
      url = "/collaborator/dashboard"
    }

    return url;
};


/*(() => {
  window.teste();
})();*/