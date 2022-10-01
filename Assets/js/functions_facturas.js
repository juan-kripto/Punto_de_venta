const $$ = (selector) => document.querySelector(selector);

const nit = $$("#nitCliente");
const name = $$("#name");
const lastname = $$("#lastname");
const address = $$("#address");
const phone = $$("#phone");
const codeProduct = $$("#code_product");
const products = [];
const infoClient = {}

const resetFieldsClient = () => {
    name.innerHTML = "";
    lastname.innerHTML = "";
    address.innerHTML = "";
    phone.innerHTML = "";
};

$$("#btnBuscar").addEventListener("click", () => {
    if (nit.value === "") {
        swal("Atención", "Debe ingresar el nit del cliente", "error");
        return;
    }

    const formData = new FormData();
    formData.append("nit", nit.value);

    fetch(`${base_url}/facturas/getClient`, {
        method: "POST",
        body: formData,
    })
        .then((res) => res.json())
        .then((data) => {
            if (Object.entries(data).length === 0) {
                swal("Atención", "El cliente no existe", "error");
                resetFieldsClient();
                return;
            }

            const { idpersona, nombres, apellidos, direccionfiscal, telefono } = data;

            infoClient.idpersona = idpersona;
            infoClient.nombres = nombres;
            infoClient.apellidos = apellidos;
            infoClient.direccionfiscal = direccionfiscal;
            infoClient.telefono = telefono;

            name.innerHTML = nombres;
            lastname.innerHTML = apellidos;
            address.innerHTML = direccionfiscal;
            phone.innerHTML = telefono;
        })
        .catch((err) => console.log(err));
});

$$("#btnAgregarProducto").addEventListener("click", () => {
    $("#modalFormFacturas").modal("show");
});

$$("#btnBuscarCodigoProducto").addEventListener("click", () => {
    if (codeProduct.value === "") {
        swal("Atención", "Debe ingresar el código del producto", "error");
        return;
    }

    const formData = new FormData();
    formData.append("code", codeProduct.value);

    fetch(`${base_url}/facturas/getProduct`, {
        method: "POST",
        body: formData,
    })
        .then((res) => res.json())
        .then((data) => {
            if (Object.entries(data).length === 0) {
                swal("Atención", "El producto no existe", "error");
                return;
            }

            const {
                idproducto,
                nombre,
                precio,
                stock,
            } = data;

            $$("#modalBodyProduct").innerHTML = `
                <div class="mt-2"><strong>Stock: </strong>${stock}</div>
                <input type="hidden" id="idProducto" value="${idproducto}">
                <div class="form-group mt-2">
                    <label for="cantidadProducto">Nombre</label>
                    <input type="text" class="form-control" id="nombreProducto" value="${nombre}" disabled>
                </div>
                <div class="form-group mt-2">
                    <label for="precioProducto">Precio</label>
                    <input type="text" class="form-control" id="precioProducto" value="${precio}" disabled>
                </div>
                <div class="form-group mt-2">
                    <label for="stockProducto">Stock</label>
                    <input type="text" class="form-control" id="stockProducto" value="${stock}" disabled>
                </div>
                <div class="form-group">
                    <label for="cantidadProducto">Cantidad</label>
                    <input id="amount" type="number" class="form-control" placeholder="cantidad de productos" >
                </div>
            `;

            // product = {codigo, nombre, precio, stock };
            // $$('#modalBodyProduct').innerHTML = ''
        })
        .catch((err) => console.log(err));
});

function deleteRow(btn) {
    const row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);

    const index = products.findIndex((item) => item.codigo === row.id);
    products.splice(index, 1);
}

$$("#agregarProductoTable").addEventListener("click", () => {
    const amount = $$("#amount");
    const idProducto = $$("#idProducto");
    const codigo = $$("#code_product")
    const nombre = $$("#nombreProducto")
    const precio = $$("#precioProducto")
    const stock = $$("#stockProducto")

    if(codigo.value === "" || nombre.value === "" || precio.value === "" || stock.value === "" || amount.value === "") return


    if (amount.value === "") {
        swal("Atención", "Debe ingresar la cantidad del producto", "error");
        return;
    }

    if (parseInt(amount.value) > parseInt(stock.value)) {
        swal("Atención", "La cantidad no puede ser mayor al stock", "error");
        return;
    }

    const table = $$("#tableProducts");
    const row = table.insertRow(-1)
    console.log(row)
    row.id = idProducto.value
    row.innerHTML = `
        <td>${codigo.value}</td>
        <td>${nombre.value}</td>
        <td>${precio.value}</td>
        <td>${amount.value}</td>
        <td>${precio.value * amount.value}</td>
        <td>
            <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    // clear fields
    products.push({ 
        idProducto: idProducto.value,
        codigo: codigo.value,
        nombre: nombre.value, 
        precio: precio.value, 
        stock: stock.value,
        cantidad: amount.value 
    });

    codeProduct.value = "";
    $$('#modalBodyProduct').innerHTML = ''
    $("#modalFormFacturas").modal("hide");
});

$$("#btnModalFactura").addEventListener("click", () => {

    if(!infoClient.idpersona) {
        swal("Atención", "Debe seleccionar un cliente", "error");
        return;
    }

    if(products.length === 0) {
        swal("Atención", "Debe agregar productos", "error");
        return;
    }

    $$("#modalBodyFactura").innerHTML = `
        <div class="row">
            <div class="col-12 text-right mb-2">
                <h3>Fecha: ${new Date().toLocaleDateString()}</h3>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <strong>Adule Fashion</strong>
                        <p class="m-0">Avenida las Américas Quetzaltenango, Guatemala</p>
                        <p class="m-0">+(502)78787845</p>
                        <p class="m-0">info@adulefashion.com</p>
                        <p class="m-0">info@adulefashion.com</p>
                    </div>
                    <div class="col-4">
                        <strong>${infoClient.nombres} ${infoClient.apellidos}</strong>
                        <p class="m-0"><strong>NIT: </strong> ${nit.value}</p>
                        <p class="m-0">${infoClient.telefono}</p>
                        <p class="m-0">${infoClient.direccionfiscal}</p>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="serie">Seleccione tipo de pago</label>
                            <select class="form-control" id="tipoPago">
                                <option value="1">Efectivo</option>
                                <option value="2">Tarjeta</option>
                                <option value="3">Depósito</option>
                                <option value="4">Paypal</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${products.map((item) => {
                            return `
                                <tr>
                                    <td>${item.codigo}</td>
                                    <td>${item.nombre}</td>
                                    <td>${item.cantidad}</td>
                                    <td>${item.precio}</td>
                                    <td>${item.precio * item.cantidad}</td>
                                </tr>
                            `
                        })}
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total</strong></td>
                            <td>${products.reduce((acc, item) => acc + (item.precio * item.cantidad), 0)}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    `

    $('#modalFacturaConfirmar').modal('show')
});

$$("#btnConfirmarFactura").addEventListener("click", () => {
    $$('#divLoading').style.display = 'flex'

    const productsFormData = new FormData();
    productsFormData.append("products", JSON.stringify(products));
    productsFormData.append("idpersona", infoClient.idpersona);

    fetch(`${base_url}/facturas/setDetalleFactura`, {
        method: "POST",
        body: productsFormData,
    })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            $$('#divLoading').style.display = 'none'
            cambiarBotonesFactura()
        })
        .catch((err) => {
            console.log(err)
            swal("Atención", "Ocurrió un error", "error");
        });
})

const cambiarBotonesFactura = () => {

    $$("#opcionesFactura").innerHTML = `
        <button id="btnConfirmarFactura" type="button" class="btn btn-primary" onclick="imprimirFactura()">
            <i class="fa fa-print"></i>
            Imprimir
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">
            Cerrar
        </button>
    `
}

const imprimirFactura = () => {
    const printContents = document.getElementById("modalBodyFactura").innerHTML;
    const originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}