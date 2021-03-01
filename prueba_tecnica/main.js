$(document).ready(function(){
    tablaProducto = $("#tablaProducto").DataTable({
        "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
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
    camposTexto = document.getElementById("formProducto").elements;
    
$("#btnNuevo").click(function(){
    $("#formProducto").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Producto");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //crear producto
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR producto   
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id =          parseInt(fila.find('td:eq(0)').text());
    codigo =      fila.find('td:eq(1)').text();//$.trim($("#codigo").val());   
    nombre =      fila.find('td:eq(2)').text();//$.trim($("#nombre").val());
    descripcion = fila.find('td:eq(3)').text();//$.trim($("#descripcion").val());
    marca =       fila.find('td:eq(4)').text();//$.trim($("#marca").val()); 
    categoria =   fila.find('td:eq(5)').text();//$.trim($("#categoria").val());
    precio =      fila.find('td:eq(6)').text();//$.trim($("#precio").val()); 
    
    
    $("#codigo").val(codigo);
    $("#nombre").val(nombre);
    $("#descripcion").val(descripcion);
    $("#marca").val(marca);
    $("#categoria").val(categoria);
    $("#precio").val(precio);
    opcion = 2; //editar producto
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Producto");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR producto
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3; //borrar producto
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
        success: function(data){ 
             //res = data[0].exito;
               // alert("bien");
            tablaProducto.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formProducto").submit(function(e){
    
    
    for (let i=0; i<5; i++){

        if (camposTexto[i].value == '' && camposTexto[i].type=='text' || 
            camposTexto[4].value == '' && camposTexto[4].type=='float' ){
            alert("El campo " + camposTexto[i].id + " está vacio y es OBLIGATORIO");
        return false;
}
    }

    e.preventDefault(); //evita el comportamiento por de fecto de un submit que es recargar la pagina
    codigo =      $.trim($("#codigo").val());   
    nombre =      $.trim($("#nombre").val());
    descripcion = $.trim($("#descripcion").val());
    marca =       $.trim($("#marca").val()); 
    categoria =   $.trim($("#categoria").val());
    precio =      $.trim($("#precio").val()); 


    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {id:id,opcion:opcion, codigo:codigo, nombre:nombre, descripcion:descripcion, marca:marca, categoria:categoria, precio:precio},
     success: function(data){ 
            
            id =          data[0].ID;
            codigo =      data[0].CODIGO;           
            nombre =      data[0].NOMBRE;
            descripcion = data[0].DESCRIPCION;
            marca =       data[0].MARCA;
            categoria =   data[0].CATEGORIA;
            precio =      data[0].PRECIO;
            //alert ("el dato"+ID);

            if(opcion == 1){tablaProducto.row.add([id,codigo,nombre,descripcion,marca,categoria,precio]).draw(); }
            else{tablaProducto.row(fila).data([id,codigo,nombre,descripcion,marca,categoria,precio]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    

////////////////// opciones JS para las categorias



});