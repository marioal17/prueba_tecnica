<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// obtengo los datos mediante el metodo post   

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$activo = (isset($_POST['activo'])) ? $_POST['activo'] : '';
$codigo = (isset($_POST['codigo'])) ? $_POST['codigo'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //crear producto

        //para la no repeticion del codigo
         $consulta = "SELECT * FROM productos WHERE CODIGO = '$codigo'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        if($resultado->rowCount() > 0){
            echo '<script>alert("el codigo ya existe");</script>';
        }

        //para la no  repeticion del nombre
        $consulta = "SELECT * FROM productos WHERE NOMBRE = '$nombre'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 

        if ($resultado->rowCount() > 0){
            echo '<script>alert("el nombre ya existe");</script>';  
        }   
            
        
        $consulta = "CALL `CREAR_PRODUCTO`('$codigo', '$nombre', '$descripcion', '$marca', '$categoria', '$precio') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

         $consulta = "CALL `SP_ULTIMO_PRODUCTO_AGREGADO`()";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
        break;
        
    case 2: //modificación producto
        $consulta = "CALL `SP_ACTUALIZAR_PRODUCTO`('$codigo', '$nombre', '$descripcion', '$marca', '$categoria', '$precio', '$id')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        
        $consulta = "SELECT * FROM productos WHERE ID = '$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
        break;        
    case 3://borrar producto
        $consulta = "CALL `SP_BORRAR_PRODUCTO`('$id')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        
        //hago esta consulta para que me devuelva una respuesta exitosa
        $consulta = "SELECT * FROM respuesta ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break; 
        
        case 4: //crear categoria

                    //para la no repeticion del codigo
         $consulta = "SELECT * FROM categorias_producto WHERE CODIGO = '$codigo'";
         $resultado = $conexion->prepare($consulta);
         $resultado->execute();
         $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 
         if($resultado->rowCount() > 0){
            echo '<script>alert("el codigo ya existe");</script>';
         }
 
         //para la no  repeticion del nombre
         $consulta = "SELECT * FROM categorias_producto WHERE NOMBRE = '$nombre'";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();
             $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
 
         if ($resultado->rowCount() > 0){
            echo '<script>alert("el nombre ya existe");</script>'; 
         } 

            $consulta = "CALL `SP_CREAR_CATEGORIA`('$codigo', '$nombre', '$descripcion', '$activo') ";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
    
             $consulta = "CALL `SP_ULTIMA_CATEGORIA_AGREGADA`()";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
            break;
            
            case 5: //modificación CATEGORIA
                $consulta = "CALL `SP_ACTUALIZAR_CATEGORIA`('$codigo', '$nombre', '$descripcion', '$activo', '$id')";		
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();        
                
                
                $consulta = "SELECT * FROM categorias_producto WHERE ID = '$id' ";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
                break; 
            
            case 6://borrar categoria
                $consulta = "CALL `SP_BORRAR_CATEGORIA`('$id')";		
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();  
                
                //hago esta consulta para que me devuelva una respuesta exitosa
                $consulta = "SELECT * FROM respuesta ";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                break;    
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar respuesta array en formato json a JS
$conexion = NULL;
