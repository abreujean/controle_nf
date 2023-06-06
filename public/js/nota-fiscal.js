$(function () {

    listarNotaFiscal();

});


  /**
 * Função para cadastra nota fiscal
 */
$( "#notaFiscal-form-cadastrar" ).on( "submit", function( event ) {
  //Cancela o comportamento padão de submit do formulário
  event.preventDefault();

  const data = {
      id_empresa : $("#id_empresa").val(),
      numero : $("#numero").val(),
      valor : $("#valor").val(),
      mes_competencia : $("#mes_competencia").val(),
      mes_caixa : $("#mes_caixa").val(),

  }

  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
  })

  $.post({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/' + PREFIXO + '/cadastrando-nota-fiscal',
      dataType : 'json',
      type: 'POST',
      data: data,
      success:function(data) {
          Toast.fire({ icon: 'success', title: data });
      },
      error: function(jqXHR, status, error) { 
          Toast.fire({ icon: 'error', title: jqXHR.responseJSON });
      }       
  });

});



/**
 * Carregar Tabela de nota fiscal
 */

const listarNotaFiscal = () => {

    $.get({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/' + PREFIXO + '/listar-nota-fiscal',
        dataType : 'json',
        type: 'GET',
        //data: 'codhash='+$("#codhash").val(),
        success:function(data) {
            
            $("#tabela-nota-fiscal").DataTable({
                dom: 'Bfrtip',
                responsive: true,
                paging: true,
                rowReorder: {
                  selector: 'td:nth-child(2)'
                },
                destroy: true,
                "aaSorting": [],
                buttons: ["csv", "excel", "pdf"],
                'lengthMenu': [[10, 20, 50], [10, 20, 50]],
                data: data,
                "language": {
                    "url": "/js/dataTableLinguagemJs.json"
                },

                "columns":[
                      
                      {"data":"razao_social"},
                      {"data":"numero"},
                      {"data":"valor"},
                      {"data":"mes_competencia"},
                      {"data":"mes_caixa"},
                      {
                         "data": null,
                         render: function(data, type, row, meta){
                            return `
                            <i class="fas fa-edit text-primary ml-3 mr-3 " onclick="editarNotaFiscal('${row.codhash}')" style="cursor: pointer; font-size: 18px;"></i>
                            <i class="fas fa-trash text-danger " onclick="excluirNotaFiscal('${row.codhash}')" style="cursor: pointer; font-size: 18px;"></i>`
                         }
                      },
                ]
          });

        },
        error: function(jqXHR, status, error) { 
           Toast.fire({ icon: 'error', title: jqXHR.responseJSON })
        }       
    });

}



/**
 * Função para editar nota fiscal
 */
$( "#editar-nota-fiscal" ).on( "submit", function( event ) {
    
    //Cancela o comportamento padão de submit do formulário
    event.preventDefault();

    const data = {
        id_empresa : $("#id_empresa").val(),
        numero : $("#numero").val(),
        valor : $("#valor").val(),
        mes_competencia : $("#mes_competencia").val(),
        mes_caixa : $("#mes_caixa").val(),
        codhash_usuario: window.location.pathname.split('/')[3]
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    $.post({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/' + PREFIXO + '/editar-nota-fiscal/editando',
        dataType : 'json',
        type: 'POST',
        data: data,
        success:function(data) {
            Toast.fire({ icon: 'success', title: data })

        },
        error: function(jqXHR, status, error) { 
            Toast.fire({ icon: 'error', title: jqXHR.responseJSON })
        }       
    });

}); 


/**
 * Função para excluir nota fiscal
 */
const excluirNotaFiscal = codhash => {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    const data = {
        codhash: codhash,
    }

    Swal.fire({
        title: 'Deseja excluir esta nota fiscal ?',
        text: "Após a exclusão este cadastro não poderá ser mais recuperado.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, tenho.',
        cancelButtonText: "Não"
      }).then((result) => {
        if (result.isConfirmed) {

            $.post({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/' + PREFIXO + '/excluindo-nota-fiscal',
                dataType : 'json',
                type: 'POST',
                data: data,
                success:function(data) {
                    listarNotaFiscal()
                    Toast.fire({ icon: 'success', title: data })
                },
                error: function(jqXHR, status, error) { 
                Toast.fire({ icon: 'error', title: jqXHR.responseJSON })
                }       
            });

    }
    })

}