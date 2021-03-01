<?php
    include_once "bd/conexion.php";
    $objeto= new Conexion();
    $conexion= $objeto->Conectar();

    $consulta= "SELECT * FROM categorias_producto";
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

         <h4 class="text-center text-light">CATEGORIAS <span class="badge badge-danger">DISPONIBLES</span></h4> 
     </header>    
      
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
                <button id="btnNueva_categoria" type="button" class="btn btn-success" data-toggle="modal">Nueva Categoria</button>
                <button id="btnProducto" type="button" class="btn btn-success float-right" 
                OnClick="location.href='index.php'" data-toggle="modal">Producto</button>     
            </div>   
               
        </div>    
    </div>  


    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaCategoria" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                        <tr>
                                <th>#</th>
                                <th>CÓDIGO</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>ACTIVO</th>
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
                                <td><?php echo $dat['ACTIVO'] ?></td>
                                <td></td>
            
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
      
      
    <!-- modal modificado -->

<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formCategoria">
        <div class="modal-body">
        <div class="modal-body">

                <div class="form-group">
                    <label for="codigo" class="col-form-label">Codigo:</label>
                    <input type="text" class="form-control" id="codigo" required
                     pattern="[A-Za-z0-9]+" placeholder="no puede usar caracteres especiales ni espacios">
                </div>  

                <div class="form-group">
                    <label for="nombre" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" required
                     minlength="2">
                </div>

                <div class="form-group">
                    <label for="descripcion" class="col-form-label">Descripcion:</label>
                    <input type="text" class="form-control" id="descripcion" required>
                </div> 

                <div class="form-group">
                    <label for="activo" class="col-form-label">Activo:</label>
                    <!-- <input type="text" class="form-control" id="activo" required> -->
                    <select id="activo" required>
                      <option>S</option>
                      <option>N</option>
                    </select>

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
     
    <script type="text/javascript" src="main_categoria.js"></script>  
    
    
  </body>
</html>
