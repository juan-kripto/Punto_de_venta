<?php 
    headerAdmin($data); 
    getModal('modalFacturar',$data);
    
?>

<main class="app-content"> 
    <div class="app-title">
        <div>
            <h1><i class="fas fa-cube"></i> <?= $data['page_title'] ?>
                <?php if($_SESSION['permisosMod']['w']){ ?>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

              <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/facturas"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
<!--Vistas de botones para localizar datos de cliente.-->
<div class="row">
          
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6"> 
                <center>

                <div class="form-group row">
                <label for="Fecha" class="col-lg-3 col-form-label">Fecha de emisión:</label>
                <div class="col-lg-3">
                <input type="date" class="form-control" id="Fecha">
                </div>
                </div>
<!---buqueda de cliente con boton search--
                <div class="form-group row">
                <label class="col-lg-3 col-form-label">NIT de cliente:</label>
                <div class="col-lg-3">
                <form><div class="input-group"><input type="text" class="form-control" placeholder="Ingrese Nit de cliente"> <div class="input-group-btn">
                <button class="btn btn-default" type="submit"> <i class="glyphicon glyphicon-search"></i> </button></div></div></form>
                </div>
                </div>  -->      
                <div class="form-group row">
                <div class="col-lg-3">
                   <!---buqueda de cliente con boton search--
                <input type="hidden" id="idcliente" name="idcliente" value="" required>
             
                <label> Nit<input type="text"  name="nit_cliente" id="nit_cliente"></label>  -->
                <label>Nit</label>
                <input type="text" name="nitCliente">
                <input type="submit" name="enviar" value="Buscar">
                </div>   </div> 
                <?php
                if(isset($_POST['enviar'])){
                  $nitCliente = $_POST['nitCliente'];
                }
              else{
                echo"nit no encontrado";
              }
                ?>


                <div class="form-group row">
                <label for="CodigoFactura" class="col-lg-3 col-form-label">Número de factura:</label>
                <div class="col-lg-3">
                <input type="text" disabled class="form-control" id="CodigoFactura" value="<?php echo $codigofactura; ?>">
      </div>
</div>   
</center>
         </div>
             <div class="col-md-4">
                <div class="action_cliente">
                <a class="btn btn-primary" href="<?= base_url(); ?>/clientes">
                <span class="app-menu__label"><h4>Registrar Nuevo Cliente</h4></span></a>
      
              <h3> Detalles de Cliente</h2>           
             </div>

                <div class="col-md-6">
                <label>Nombres</label>                
                <input type="text" name="nom_cliente" id="nom_cliente" disabled required>
                </div>

                <div class="wd30">
                <label>Apellidos</label>                
                <input type="text" name="ape_cliente" id="ape_cliente" disabled required>
                </div>

                <div class="col-md-6">
                <label>Direccion</label>                
                <input type="text" name="dir_cliente" id="dir_cliente" disabled required>
                </div>
                
                <div class="wd30">
                <label>Telefono</label>                
                <input type="text" name="tel_cliente" id="tel_cliente" disabled required>
                </div>
                

                </div>                
                </div>
                 <div class="row">
                <div class="col-md-6">                  
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
</div>


<!--Aqui se agrega una tabla para agregar productos-->

    
<div class="row mt-4">
      <div class="col-md">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Código de Artículo</th>
              <th>Descripción</th>
              <th class="text-right">Cantidad</th>
              <th class="text-right">Precio Unitario</th>
              <th class="text-right">Total</th>
              <th class="text-right"></th>
            </tr>
          </thead>
          <tbody id="DetalleFactura">

          </tbody>
        </table>
        <button type="button" id="btnAgregarProducto" class="btn btn-success">Agregar Producto</button>
        <button type="button" id="btnTerminarFactura" class="btn btn-success">Terminar Factura</button>
      </div>
    </div>

  </div>

  <!-- Agregar producto en la factura -->
  <div class="modal fade" id="ModalProducto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label>Producto:</label>
            <select class="form-control" id="CodigoProducto">
          
            </select>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Cantidad:</label>
              <input type="number" id="Cantidad" class="form-control" placeholder="" min="1">
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" id="btnConfirmarAgregarProducto" class="btn btn-success">Agregar a la factura</button>
          <button type="button" data-dismiss="modal" class="btn btn-success">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ModalFinFactura -->
  <div class="modal fade" id="ModalFinFactura" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="max-width: 600px" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Acciones</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnConfirmarFactura" class="btn btn-success">Confirmar Factura</button>
          <button type="button" id="btnConfirmarImprimirFactura" class="btn btn-success">Confirmar e Imprimir Factura</button>
          <button type="button" id="btnConfirmarDescartarFactura" class="btn btn-success">Descartar la Factura</button>
        </div>
      </div>
    </div>
  </div>


  <!-- ModalConfirmarBorrar -->
  <div class="modal fade" id="ModalConfirmarBorrar" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="max-width: 600px" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1>¿Realmente quiere borrarlo?</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnConfirmarBorrado" class="btn btn-success">Confirmar</button>
          <button type="button" data-dismiss="modal" class="btn btn-success">Cancelar</button>
        </div>
      </div>
    </div>
  </div>


  </div>




     
</main>
 
<?php footerAdmin($data); ?>
    