<?php 
		session_start();
		session_regenerate_id(true);

class Facturas extends Controllers{
	public function __construct()
	{
		parent::__construct();
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
			die();
		}
		getPermisos(3);
	}

	public function Facturas()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Facturas";
		$data['page_title'] = "FACTURAS <small>Tienda Virtual</small>";
		$data['page_name'] = "facturas";
		$data['page_functions_js'] = "functions_facturas.js";
		$this->views->getView($this,"facturas",$data);
	}

    public function getClient() {
        $nitCliente = $_POST['nit'];
        if(empty($nitCliente)){
            $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');

            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            return 0;
        }

        $requestClient = $this->model->selectClientByNit($nitCliente);

        echo json_encode($requestClient, JSON_UNESCAPED_UNICODE);            
    }

    public function getProduct() {
        $codeProducto = $_POST['code'];
        if(empty($codeProducto)){
            $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            return 0;
        }

        $requestProduct = $this->model->findProductByCode($codeProducto);

        echo json_encode($requestProduct, JSON_UNESCAPED_UNICODE);            
    }

    public function setDetalleFactura() {

        if(!isset($_POST['products']) || !isset($_POST['idpersona'])) {
            $arrResponse = array("status" => false, "msg" => 'No hay productos seleccionados.');

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            return 0;
        }

        $products = $_POST['products'];

        $products = json_decode($products);
        $idPersona = $_POST['idpersona'];

        $request = $this->model->insertDetalleFactura($products, $idPersona);

        echo json_encode($request, JSON_UNESCAPED_UNICODE);
    }
}
?>