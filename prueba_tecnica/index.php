<?php
    include_once "bd/conexion.php";
    $objeto= new Conexion();
    $conexion= $objeto->Conectar();

    $consulta= "CALL `SP_PRODUCTOS_ALL`()";
    $resultado= $conexion->prepare($consulta);
    $resultado->execute();
    $data= $resultado->fetchALL(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>PRUEBA TÉCNICA</title>
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.22/css/dataTables.bootstrap4.min.css">       
  </head>
    
  <body> 
     <header>

         <h4 class="text-center text-light">PRODUCTOS <span class="badge badge-danger">DISPONIBLES</span></h4> 
     </header>    
      
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo Producto</button>
                <button id="btnCategoria" type="button" class="btn btn-success float-right" 
                OnClick="location.href='categorias.php'" data-toggle="modal">Categorias</button>     
                
            </div>   
               
        </div>    
    </div>  


    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaProducto" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                        <tr>
                                <th>#</th>
                                <th>CÓDIGO</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>MARCA</th>
                                <th>CATEGORÍA</th>
                                <th>PRECIO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $dat){
                            ?>    
                              <tr>
                                <td><?php echo $dat['ID'] ?> </td>
                                <td><?php echo $dat['CODIGO'] ?></td>
                                <td><?php echo $dat['NOMBRE'] ?></td>
                                <td><?php echo $dat['DESCRIPCION'] ?></td>
                                <td><?php echo $dat['MARCA'] ?></td>
                                <td><?php echo $dat['CATEGORIA'] ?></td>
                                <td><?php echo $dat['PRECIO'] ?></td>
                                <td>
                                </td> 
                              </tr> 
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
      
    <!-- modal-->

<div class="modal fade" id="modalCRUD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formProducto">
        <div class="modal-body">
        <div class="modal-body">

                <div class="form-group">
                    <label for="codigo" class="col-form-label">Codigo:</label>
                    <input type="text" class="form-control" id="codigo"minlength="4" maxlength="10"
                    required pattern="[A-Za-z0-9]+" placeholder="no puede usar caracteres especiales ni espacios">
                </div>  

                <div class="form-group">
                    <label for="nombre" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" minlength="4">
                </div>

                <div class="form-group">
                    <label for="descripcion" class="col-form-label">Descripcion:</label>
                    <input type="text" class="form-control" id="descripcion">
                </div> 

                <div class="form-group">
                    <label for="marca" class="col-form-label">Marca:</label>
                    <!-- <input type="text" class="form-control" id="marca"> -->
                    <select id="marca" required>
                      <option>NIKE</option>
                      <option>RAM</option>
                      <option>DG</option>
                      <option>PUMA</option>
                      <option>LEVIS</option>
                      <option>TOTTO</option>
                      <option>ARTURO CALLE</option>
                    </select>
                </div> 

                <div class="form-group">
                    <label for="categoria" class="col-form-label">Categoria:  </label>
                    <!-- <input type="text" class="form-control" id="categoria"> -->
                    
                    <select id="categoria" require>
                        <!-- <option value="0"> </option> -->
                        <?php
                            // Realizamos la consulta para extraer los datos
                            include_once "bd/conexion.php";
                            $objeto= new Conexion();
                            $conexion= $objeto->Conectar();

                            $consulta= "CALL `SP_LLENAR_SELECT_CATEGORIAS`()";
                            $resultado= $conexion->prepare($consulta);
                            $resultado->execute();
                            $data= $resultado->fetchALL(PDO::FETCH_ASSOC);
                            // En esta sección estamos llenando el select con datos extraidos de una base de datos.
                            foreach($data as $dat){
                                echo '<option value="'.$dat['NOMBRE'].'">'.$dat['NOMBRE'].'</option>';
                            }      
                        ?>
                </select>  
                </div>

                <div class="form-group">
                    <label for="precio" class="col-form-label">Precio:</label>
                    <input type="number" class="form-control" id="precio" step="0.01" required
                    placeholder="solo puede usar numeros">
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="btnAceptar" class="btn btn-primary">Aceptar</button>
        </div>
      </form>
    </div>
  </div>
</div>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.5.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>  
    
    
  </body>
</html>
