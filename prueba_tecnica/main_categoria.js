$(document).ready(function(){
    tablaCategoria = $("#tablaCategoria").DataTable({
        "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar2'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }], 
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    

////////////////// opciones JS para las categorias

$("#btnNueva_categoria").click(function(){
    $("#formCategoria").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Categoria");            
    $("#modalCategoria").modal("show");        
    id=null;
    opcion = 4; //crear categoria
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR categoria   
$(document).on("click", ".btnEditar2", function(){
    fila = $(this).closest("tr");
    id =          parseInt(fila.find('td:eq(0)').text());
    codigo =      fila.find('td:eq(1)').text();//$.trim($("#codigo").val());   
    nombre =      fila.find('td:eq(2)').text();//$.trim($("#nombre").val());
    descripcion = fila.find('td:eq(3)').text();//$.trim($("#descripcion").val());
    activo =       fila.find('td:eq(4)').text();//$.trim($("#marca").val()); 
    /* categoria =   fila.find('td:eq(5)').text();//$.trim($("#categoria").val());
    precio =      fila.find('td:eq(6)').text();//$.trim($("#precio").val());  */
    
    
    $("#codigo").val(codigo);
    $("#nombre").val(nombre);
    $("#descripcion").val(descripcion);
    $("#activo").val(activo);
    opcion = 5; //editar categoria
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Categoria");            
    $("#modalCategoria").modal("show");  
    
});

//botón BORRAR categoria
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
   
    opcion = 6; //borrar categoria
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
        success: function(data){ 
             
               // alert("bien");
            tablaCategoria.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formCategoria").submit(function(e){
    e.preventDefault(); //evita el comportamiento por de fecto de un submit que es recargar la pagina
    codigo =      $.trim($("#codigo").val());   
    nombre =      $.trim($("#nombre").val());
    descripcion = $.trim($("#descripcion").val());
    activo =       $.trim($("#activo").val()); 
    /* categoria =   $.trim($("#categoria").val());
    precio =      $.trim($("#precio").val()); */ 
     
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {id:id,opcion:opcion, codigo:codigo, nombre:nombre, descripcion:descripcion, activo:activo},
     success: function(data){ 
            //var js = JSON.parse(data); 
            //console.log(data);//verificamos por consola
            
            id =         data[0].ID;
            codigo =      data[0].CODIGO;           
            nombre =      data[0].NOMBRE;
            descripcion = data[0].DESCRIPCION;
            activo =       data[0].ACTIVO;
            /* categoria =   data[0].CATEGORIA;
            precio =      data[0].PRECIO; */
            //alert ("el dato"+ID);

            if(opcion == 4){tablaCategoria.row.add([id,codigo,nombre,descripcion,activo]).draw(); }
            else{tablaCategoria.row(fila).data([id,codigo,nombre,descripcion,activo]).draw();}            
        }        
    });
    $("#modalCategoria").modal("hide");    
    
}); 


});