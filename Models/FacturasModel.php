<?php 
	class FacturasModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

        public function selectClientByNit($nitCliente) {
            $sql = "SELECT idpersona, identificacion, nombres, apellidos, telefono, email_user, direccionfiscal FROM persona WHERE nit = '{$nitCliente}' and rolid = 7 and status != 0";
            return $this->select($sql);
        }

        public function findProductByCode($codigoProducto) {
            $sql = "SELECT idproducto, codigo, nombre, precio, descripcion, stock FROM producto WHERE codigo = '{$codigoProducto}' and status != 0 and stock > 0";
            return $this->select($sql);
        }

        public function insertDetalleFactura($productos, $idPersona) {
            try {
                $this->beginTransaction();
                $query_invoice = "INSERT INTO factura (idpersona, fecha) VALUES (?,?)";

                $data_invoice = [
                    $idPersona,
                    date('Y-m-d H:i:s'),
                ];

                $request_invoice = $this->insert($query_invoice, $data_invoice);

                $lastIdInvoice = $this->lastInsertId();

                for($i = 0; $i < count($productos); $i++) {
                    $query_detalle = "INSERT INTO detalle_facturas (productoid, precio, cantidad, transaccionid, num_factura) VALUES (?,?,?,?,?)";
                    $data_detalle = [
                        $productos[$i]->idProducto,
                        $productos[$i]->precio,
                        $productos[$i]->cantidad,
                        "0",
                        $lastIdInvoice,
                    ];

                    $this->insert($query_detalle, $data_detalle);

                    // Actualizar el stock tabla producto
                    $stock = "SELECT stock FROM producto WHERE idproducto = {$productos[$i]->idProducto}";

                    $stock = $this->select($stock);

                    $stock = $stock['stock'] - $productos[$i]->cantidad;

                    $query_stock = "UPDATE producto SET stock = ? WHERE idproducto = ?";

                    $data_stock = [
                        $stock,
                        $productos[$i]->idProducto,
                    ];

                    $this->update($query_stock, $data_stock);
                }

                $this->commit();
                return $request_invoice;

            } catch (\Throwable $th) {
                $this->rollback();
                echo "Fallo: ".$th->getMessage();
            }
        }

		public function selectPedido(int $idpedido, $idpersona = NULL){
			$busqueda = "";
			if($idpersona != NULL){
				$busqueda = " AND p.personaid =".$idpersona;
			}
			$request = array();
			$sql = "SELECT p.idpedido,
							p.referenciacobro,
							p.idtransaccionpaypal,
							p.personaid,
							DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha,
							p.costo_envio,
							p.monto,
							p.tipopagoid,
							t.tipopago,
							p.direccion_envio,
							p.status
					FROM pedido as p
					INNER JOIN tipopago t
					ON p.tipopagoid = t.idtipopago
					WHERE p.idpedido =  $idpedido ".$busqueda;
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idpersona = $requestPedido['personaid'];
				$sql_cliente = "SELECT idpersona,
										nombres,
										apellidos,
										telefono,
										email_user,
										nit,
										nombrefiscal,
										direccionfiscal 
								FROM persona WHERE idpersona = $idpersona ";
				$requestcliente = $this->select($sql_cliente);
				$sql_detalle = "SELECT p.idproducto,
											p.nombre as producto,
											d.precio,
											d.cantidad
									FROM detalle_pedido d
									INNER JOIN producto p
									ON d.productoid = p.idproducto
									WHERE d.pedidoid = $idpedido";
				$requestProductos = $this->select_all($sql_detalle);
				$request = array('cliente' => $requestcliente,
								'orden' => $requestPedido,
								'detalle' => $requestProductos
								 );
			}
			return $request;
		}

		

	}
 ?>