$(document).ready(function(){

    var dataTable = $('#personal').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            url:"datos.php",
            type:"POST"
        },
        "columnDefs": [{ "targets": -1, "data": null, "defaultContent": "<input id='btnDetails' class='btn btn-success' width='25px' value='Calcular Rentabilidad' />"}]
    });

    $('#personal').on('draw.dt', function(){
        $('#personal').Tabledit({
            url:'edicion.php',
            dataType:'json',
            columns:{
                identifier : [0, 'id'],
                editable:[[1, 'nombre'], [2, 'activo'], [3, 'bolsa'], [4, 'cantidad'], [5, 'precio']]
            },
            restoreButton:false,
            onSuccess:function(data, textStatus, jqXHR)
            {
                if(data.action == 'delete')
                {
                    $('#' + data.idp).remove();
                    $('#personal').DataTable().ajax.reload();
                }
            }
        });
    });

    $('#personal').on('click', '[id*=btnDetails]', function () {
        var data = dataTable.row($(this).parents('tr')).data();
        var parametros = {
            "id" : data[0],
            "nombre" : data[1],
            "activo" : data[2],
            "bolsa" : data[3],
            "cantidad" : data[4],
            "precio" : data[5]
        };
        $.ajax({
            data:  parametros, //datos que se envian a traves de ajax
            url:   'rentabilidad.php', //archivo que recibe la peticion
            type:  'post', //método de envio
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                $("#resultado").html(response);
            }
        });
    });

});