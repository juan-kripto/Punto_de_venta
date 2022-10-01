<?php 
    headerAdmin($data); 
    getModal('modalFacturar',$data);
    getModal('modalFacturaConfirmar',$data);
?>

<main class="app-content"> 
    <div class="app-title">
        <h1>
            <em class="fas fa-user-tag"></em> <?= $data['page_title'] ?>
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><em class="fa fa-home fa-lg"></em></li>
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>/facturas"><?= $data['page_title'] ?></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary btn-lg">Registrar Nuevo Cliente</button>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="form-group">
                <label for="nitCliente">Nit</label>
                <input type="text" class="form-control" id="nitCliente" placeholder="Ej: 12345678-h">
            </div>
            <button id="btnBuscar" class="btn btn-success" >Buscar</button>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="nombreCliente">Nombres</label>
                <div class="form-control" id="name"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="apellidoCliente">Apellido</label>
                <div class="form-control" id="lastname"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="telefonoCliente">Teléfono</label>
                <div class="form-control" id="phone"></div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="direccionCliente">Dirección</label>
                <div class="form-control" id="address"></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 mb-3">
            <button id="btnAgregarProducto" class="btn btn-success" >Agregar producto</button>
            <button id="btnModalFactura" class="btn btn-success" >Terminar factura</button>
        </div>
        <div class="col-12">
            <table class="table table-striped" >
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio unitario</th>
                        <th scope="col">Total</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tableProducts">
                    
                </tbody>
            </table>
        </div>
    </div>


</main>
<?php footerAdmin($data); ?>