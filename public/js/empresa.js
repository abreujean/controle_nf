$(function () {
    listarEmpresa();
})

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

/**
 * Função para cadastra Empresa
 */
$( "#empresa-form-cadastrar" ).on( "submit", function( event ) {
    //Cancela o comportamento padão de submit do formulário
    event.preventDefault();

    const data = {
        cnpj : $("#cnpj").val(),
        razao_social : $("#razao").val(),
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
        url: '/' + PREFIXO + '/cadastrando-empresa',
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
 * Carregar Tabela de empresas
 */

const listarEmpresa = () => {

    $.get({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/' + PREFIXO + '/listar-empresa',
        dataType : 'json',
        type: 'GET',
        //data: 'codhash='+$("#codhash").val(),
        success:function(data) {
            
            $("#tabela-empresa").DataTable({
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
                      {"data":"cnpj"},
                      {
                         "data": null,
                         render: function(data, type, row, meta){
                            return `
                            <div type="button" class="btn btn-block btn-danger btn-sm" onclick="excluirEmpresa('${row.codhash}')">Deletar</div>`

                            
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
 * Função para excluir acadêmico vinculado a aluno
 */
const excluirEmpresa = codhash => {

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
        title: 'Deseja excluir este empresa ?',
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
                url: '/' + PREFIXO + '/excluindo-empresa',
                dataType : 'json',
                type: 'POST',
                data: data,
                success:function(data) {
                    listarEmpresa()
                    Toast.fire({ icon: 'success', title: data })
                },
                error: function(jqXHR, status, error) { 
                Toast.fire({ icon: 'error', title: jqXHR.responseJSON })
                }       
            });

    }
    })

}