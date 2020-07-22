var idioma =

    {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "NingÃºn dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Ãšltimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copyTitle": 'Informacion copiada',
            "copyKeys": 'Use your keyboard or menu to select the copy command',
            "copySuccess": {
                "_": '%d filas copiadas al portapapeles',
                "1": '1 fila copiada al portapapeles'
            },

            "pageLength": {
                "_": "Mostrar %d filas",
                "-1": "Mostrar Todo"
            }
        }
    };
var columnas;
var columNoOrdenar;
var titulo;


$(document).ready(function () {
    var table = $('#miTabla').DataTable({
        dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "language": idioma,
        "columnDefs": [{
            "orderable": false,
            "targets": columNoOrdenar
        }, ],

        buttons: {
            dom: {
                buttonLiner: {
                    tag: null
                }
            },
            buttons: [{
                    extend: 'collection',
                    text: '<i class="fa fa-download"></i> Descargar',
                    buttons: [{
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>CSV',
                            title: titulo,
                            titleAttr: 'CSV',
                            className: 'btn btn-app export csv',
                            exportOptions: {
                                columns: [columnas]
                            }
                        }, {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>PDF',
                            title: titulo,
                            titleAttr: 'PDF',
                            className: 'btn btn-app export pdf',
                            exportOptions: {
                                columns: [columnas]
                            },
                            customize: function (doc) {

                                doc.styles.title = {
                                    color: '#4c8aa0',
                                    fontSize: '30',
                                    alignment: 'center'
                                }
                                doc.styles['td:nth-child(2)'] = {
                                        width: '100px',
                                        'max-width': '100px'
                                    },
                                    doc.styles.tableHeader = {
                                        fillColor: '#4c8aa0',
                                        color: 'white',
                                        alignment: 'center'
                                    },
                                    doc.content[1].margin = [100, 0, 100, 0]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>Excel',
                            title: titulo,
                            titleAttr: 'Excel',
                            className: 'btn btn-app export excel',
                            exportOptions: {
                                columns: [columnas]
                            },
                        }

                    ]
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Imprimir',
                    title: titulo,
                    titleAttr: 'Imprimir',
                    className: 'btn export buttons-collection',
                    exportOptions: {
                        columns: [columnas]
                    }
                }
            ],
        }
    });
});