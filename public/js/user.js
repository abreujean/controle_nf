$(function () {
    //Initialize Select2 Elements
    if ($("#id_company").length) {
        $('#id_company').select2().data('select2').$selection.css('height', '40px');
        $('#id_category').select2().data('select2').$selection.css('height', '40px');
    }

    if ($("#table-user").leUgth) {
        listUser();
    }
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
 * Function to register user
 */
$( "#user-form-register" ).on( "submit", function( event ) {

    event.preventDefault();

    const data = {
     
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
        url: '/' + PREFIX + '/creating-expense',
        dataType : 'json',
        type: 'POST',
        data: data,
        success:function(data) {
            Toast.fire({ icon: 'success', title: data });
            location.href='/' + PREFIX + '/expense-control'
        },
        error: function(jqXHR, status, error) { 
            Toast.fire({ icon: 'error', title: jqXHR.responseJSON });
        }       
    });

});



/**
 * Load table of user
 */

const listUser = () => {

    $.get({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/' + PREFIX + '/list-user',
        dataType : 'json',
        type: 'GET',
        //data: 'codhash='+$("#codhash").val(),
        success:function(data) {
            
            $("#table-user").DataTable({
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
                      {"data":"expense"},
                      {"data":"value"},
                      {"data":"category.category"},
                      {
                        "data": "company.company",
                        "render": function(data, type, row, meta) {
                          if (data) {
                            return data;
                          } else {
                            return "Sem Vínculo";
                          }
                        }
                      },
                      {
                        data: "competition_date",
                        render: function(data) {
                          return moment(data).format("DD/MM/YYYY");
                        }
                      },
                      {
                        data: "receipt_date",
                        render: function(data) {
                          return moment(data).format("DD/MM/YYYY");
                        }
                      },
                      {
                         "data": null,
                         render: function(data, type, row, meta){
                            return `
                            <i class="fas fa-edit text-primary ml-3 mr-3 " onclick="window.open('/${PREFIX}/edit-expense/${row.codhash}','_self')" style="cursor: pointer; font-size: 18px;"></i>
                            <i class="fas fa-trash text-danger " onclick="deleteExpense('${row.codhash}')" style="cursor: pointer; font-size: 18px;"></i>
                           `
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
 * Function to update user
 */
$( "#user-form-update" ).on( "submit", function( event ) {
    
    event.preventDefault();

    const data = {
        codhash : $("#codhash").val(),
        id_profile: $("#id_profile").val(),
        name: $("#name").val(),
        email : $("#email").val(),
        password : $("#password").val(),
        current_password : $("#current_password").val(),
        phone : $("#phone").val(),
        alert: $("#alert").val(),
        active : $("#active").prop("checked") ? 1 : 0,
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
        url: '/' + PREFIX + '/edit-user/editing',
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
 * Function to delete User
 */
const deleteUser = codhash => {

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
        title: 'Deseja excluir esta despesa ?',
        text: "Após a exclusão, este cadastro não poderá ser mais recuperado.",
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
                url: '/' + PREFIX + '/deleting-User',
                dataType : 'json',
                type: 'POST',
                data: data,
                success:function(data) {
                    listUser()
                    Toast.fire({ icon: 'success', title: data })
                },
                error: function(jqXHR, status, error) { 
                Toast.fire({ icon: 'error', title: jqXHR.responseJSON })
                }       
            });

    }
    })

}