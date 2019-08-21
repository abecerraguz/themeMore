// javascript Animate onscroll Start
$(document).ready(function () {
    if (screen.width > 1024) {
        AOS.init({
        easing: 'ease-in-out-sine',
        once: true,
        });
    }
});
(new IntersectionObserver(function(e,o){

    if (e[0].intersectionRatio > 0){
        document.documentElement.removeAttribute('class');
    } else {
        document.documentElement.setAttribute('class','stuck');
    };

})).observe(document.querySelector('.trigger'));

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});


function filtrarCategoryfilter(){
    $("#seleccionePublicacion").val('-1');
    filtrar();
}

$(document).ready(filtrar);

$(function() {
  filtrar()
});

function filtrar(){
        var filter = $('#filter');
            $.ajax({
                url:filter.attr('action'),
                data:filter.serialize(),
                type:filter.attr('method'),
                beforeSend:function(xhr){
                    
                    
                },
                success:function(data){
                    $('#response').html(data);
                      _initDatatable();
                },
                complete: function (data) {

                }
            });
            return false;
}


jQuery(function($){


    $('#filter').submit(function(){
        var filter = $('#filter');
        $.ajax({
            url:filter.attr('action'),
            data:filter.serialize(),
            type:filter.attr('method'),
            beforeSend:function(xhr){
                filter.find('button').append('Buscar<i class="fas fa-circle-notch fa-spin"></i>');

                filter.find('i').css({
                    'font-size'  : '18px',
                    'margin-left': '5px'
                });

                filter.find('i.fas.fa-search.mr-2').hide();
            },
            success:function(data){
                filter.find('button').html('<i class="fas fa-search mr-2"></i>Buscar');
                $('#response').html(data);
                _initDatatable();
            },
            complete: function(data){
            
            }

        });
        return false;
    });

});


function _initDatatable(){ 
    var table = $('#_buscarDatosPublicacion').DataTable({
            "responsive":true,
            "paging":true,
            "ordering":true,
            "info":true,
            "searching":false,
            pagingType: "full_numbers",
            bSort: false,
            scrollY:'50vh',
            scrollCollapse: true,
            "language": {
            "sProcessing":    "Procesando...",
            "sLengthMenu":    "Mostrar _MENU_ registros",
            "sZeroRecords":   "No se encontraron resultados",
            "sEmptyTable":    "Ningún dato disponible en esta tabla",
            "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":   "",
            "sSearch":        "Buscar:",
            "sUrl":           "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":    "Último",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
            }
        });
    
        $('#btn-show-all-children').on('click', function(){
            table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
        });
        $('#btn-hide-all-children').on('click', function(){
            table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
        });
        table.rows(':not(.parent)').nodes().to$().find('td:first-child').on('click', function(){
        });
       
}


