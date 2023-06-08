$(function () {
    //Initialize Select2 Elements
    if ($("#id_company").length) {
        $('#id_company').select2().data('select2').$selection.css('height', '40px');
    }

    if ($("#table-invoice").length) {
        listInvoice();
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
 * Function to register invoice
 */
$( "#invoice-form-register" ).on( "submit", function( event ) {

    event.preventDefault();

    const data = {
        id_company: $("#id_company").val(),
        number : $("#number").val(), 
        value : $("#value").val(),
        month_competency : $("#month_competency").val(),
        receipt_date: $("#receipt_date").val(),
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
        url: '/' + PREFIX + '/creating-invoice',
        dataType : 'json',
        type: 'POST',
        data: data,
        success:function(data) {
            Toast.fire({ icon: 'success', title: data });
            location.href='/' + PREFIX + '/invoice-control'
        },
        error: function(jqXHR, status, error) { 
            Toast.fire({ icon: 'error', title: jqXHR.responseJSON });
        }       
    });

});



/**
 * Load table of invoice
 */

const listInvoice = () => {

    $.get({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/' + PREFIX + '/list-invoice',
        dataType : 'json',
        type: 'GET',
        //data: 'codhash='+$("#codhash").val(),
        success:function(data) {
            
            $("#table-invoice").DataTable({
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
                      {"data":"number"},
                      {"data":"value"},
                      {"data":"company.company"},
                      {
                        data: "month_competency",
                        render: function(data) {
                          return moment(data).format("MM/YYYY");
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
                            <i class="fas fa-edit text-primary ml-3 mr-3 " onclick="window.open('/${PREFIX}/edit-invoice/${row.codhash}','_self')" style="cursor: pointer; font-size: 18px;"></i>
                            <i class="fas fa-trash text-danger " onclick="deleteInvoice('${row.codhash}')" style="cursor: pointer; font-size: 18px;"></i>
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
 * Function to update invoice
 */
$( "#invoice-form-update" ).on( "submit", function( event ) {
    
    event.preventDefault();

    const data = {
        codhash : $("#codhash").val(),
        id_company: $("#id_company").val(),
        number : $("#number").val(), 
        value : $("#value").val(),
        month_competency : $("#month_competency").val(),
        receipt_date: $("#receipt_date").val(),
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
        url: '/' + PREFIX + '/edit-invoice/editing',
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
 * Function to delete invoice
 */
const deleteInvoice = codhash => {

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
        title: 'Deseja excluir esta Nota Fiscal ?',
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
                url: '/' + PREFIX + '/deleting-invoice',
                dataType : 'json',
                type: 'POST',
                data: data,
                success:function(data) {
                    listInvoice()
                    Toast.fire({ icon: 'success', title: data })
                },
                error: function(jqXHR, status, error) { 
                Toast.fire({ icon: 'error', title: jqXHR.responseJSON })
                }       
            });

    }
    })

}