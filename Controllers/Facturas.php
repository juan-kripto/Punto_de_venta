
    <?php 

class Facturas extends Controllers{
	public function __construct()
	{
		parent::__construct();
		session_start();
		session_regenerate_id(true);
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
}
?>