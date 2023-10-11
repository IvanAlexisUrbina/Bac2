$(document).ready(function() {
    // Inicializa la tabla DataTable
    var table = $('.DataTable').DataTable({
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        language: {
            "decimal": "",
            "emptyTable": "No hay datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(Filtro de _MAX_ registros Totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Numero de filas _MENU_",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron resultados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Proximo",
                "previous": "Anterior"
            }
        }
    });

    // Agrega filtros de búsqueda a las columnas
    $('.DataTable thead tr:eq(1) th').each(function(i) {
        var title = $(this).text(); // Nombre de la columna
        $(this).html('<input type="text" class="form form-control" placeholder="' + 'Buscar' + '" />');
        $('input', this).on('keyup change', function() {
            // Realiza la búsqueda en la columna correspondiente cuando se cambia el valor del input
            if (table.column(i).search() !== this.value) {
                table
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });
});
