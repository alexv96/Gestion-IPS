(function() {

    $(document).ready(function() {
        $('#tabla-dtbl').DataTable({
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ de _END_ páginas con _TOTAL_ datos",
                "infoEmpty": "No se encontraron datos",
                "infoFiltered": "(Filtrar _MAX_ datos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ datos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": activar para ordenar la columna ascendente",
                    "sortDescending": ": activar para ordenar la columna desentende",
                }
            }
        });
    });

})()