<!-- Modal -->
<div class="modal fade" id="modalFormFacturas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog " >
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--Aqui empieza el espacio para el ingreso de datos de cliente-->
                <div class="form-row">
                    <div class="col-sm-8">
                        <input id="code_product" type="text" class="form-control mr-2" placeholder="Ingrese el codigo del producto"> 
                    </div>
                    <div class="col-auto col-sm-4">
                        <button id="btnBuscarCodigoProducto" class="btn btn-primary btn-block">Buscar</button>
                    </div>
                </div>
                <div id="modalBodyProduct"></div>
            </div>
            <div class="modal-footer">
                <button id="agregarProductoTable" type="button" class="btn btn-primary">Agregar producto</button>
                <button id="cancelarProductoTable" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
