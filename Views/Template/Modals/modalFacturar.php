<!-- Modal -->
<div class="modal fade" id="modalFormFacturas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formFacturas" name="formFacturas" class="form-horizontal">
<!--Aqui empieza el espacio para el ingreso de datos de cliente-->


                <form><div class="input-group"><input type="text" class="form-control" placeholder="Ingrese Nit de cliente"> <div class="input-group-btn">
                <button class="btn btn-default" type="submit"> <i class="glyphicon glyphicon-search"></i> </button></div></div></form>
              



<!--Aqui termina el espacio para el ingreso de datos de cliente-->
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalViewFactura" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos de Venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
<!--Aqui empieza las tablas de los detalles de la venta para la factura.-->


   


<!--Aqui Termina las tablas de los detalles de la venta para la factura.-->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
