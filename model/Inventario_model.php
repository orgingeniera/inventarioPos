<?php

	require_once('Conexion.php');

	class InventarioModel extends Conexion
	{
		public static function Listar_Kardex($mes)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_kardex_inventario(:mes);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":mes",$mes);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					return $stmt->fetchAll();
				}


				$dbconec = null;
			} catch (Exception $e) {

				echo '<span class="label label-danger label-block">ERROR AL CARGAR LOS DATOS, PRESIONE F5</span>';
			}
		}

		public static function Listar_Entradas($mes)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_entradas(:mes);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":mes",$mes);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					return $stmt->fetchAll();
				}


				$dbconec = null;
			} catch (Exception $e) {

				echo '<span class="label label-danger label-block">ERROR AL CARGAR LOS DATOS, PRESIONE F5</span>';
			}
		}

		public static function Listar_Salidas($mes)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_salidas(:mes);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":mes",$mes);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					return $stmt->fetchAll();
				}


				$dbconec = null;
			} catch (Exception $e) {

				echo '<span class="label label-danger label-block">ERROR AL CARGAR LOS DATOS, PRESIONE F5</span>';
			}
		}



		public static function Validar_Inventario($idpertenece)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				//$query = "CALL sp_validar_inventario($idpertenece)";
				$query = "CALL sp_validar_inventario_pertenece(:idpertenece)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(':idpertenece', $idpertenece, PDO::PARAM_INT);

				if($stmt->execute())
				{
					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					if($row['respuesta'] == 'VALIDADO'){

								$data = "Validado";
		 	   				echo json_encode($data);

					} else if ($row['respuesta'] == 'NO EXISTE'){

								$data = "No Existe";
								echo json_encode($data);

					} else if ($row['respuesta'] == 'SIN PRODUCTOS'){

							$data = "0";
 	   					echo json_encode($data);
					}

				} else {

					$data = "Error";
 	   		 	 	echo json_encode($data);
				}

				$dbconec = null;
			} catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);

			}

		}

		/*
	    Cada mes, el sistema verifica si hay productos registrados.
		Si hay productos y aún no se ha abierto un inventario para este mes,
		lo abre y copia el stock actual como saldo inicial. 
		Si ya existe un inventario, lo reabre si estaba cerrado. 
		Si no hay productos, no hace nada y avisa. */
		public static function Abrir_Inventario($idpertenece)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				//este era el que estaba $query = "CALL sp_abrir_inventario()";
				$query = "CALL  sp_abrir_inventario_pertenece(:pertenece)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(':pertenece', $idpertenece, PDO::PARAM_INT);

				if($stmt->execute())
				{

					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					if($row['respuesta'] == 'ABIERTO'){

						$data = "Validado";
 	   					echo json_encode($data);

					} else {

						$data = "Vigente";
 	   					echo json_encode($data);
					}




				} else {

					$data = "Error";
 	   		 	 	echo json_encode($data);
				}

				$dbconec = null;
			} catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);

			}

		}

		public static function Cerrar_Inventario($idPertenece)
		{

			
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_cerrar_inventario_pertenece($idPertenece)";
				$stmt = $dbconec->prepare($query);
				//$stmt->bindParam(':pertenece', $idpertenece, PDO::PARAM_INT);

				if($stmt->execute())
				{

					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					if($row['respuesta'] == 'CERRADO'){

						$data = $row['respuesta'];
 	   					echo json_encode($data);

					}

				} else {

					$data = "Error";
 	   		 	 	echo json_encode($data);
				}

				$dbconec = null;
			} catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);

			}

		}

		public static function Insertar_Entrada($descripcion,$cantidad,$producto)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_entrada(:descripcion,:cantidad,:producto)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":descripcion",$descripcion);
				$stmt->bindParam(":cantidad",$cantidad);
				$stmt->bindParam(":producto",$producto);

				if($stmt->execute())
				{
					$count = $stmt->rowCount();
					if($count == 0){
						$data = "Duplicado";
 	   					echo json_encode($data);
					} else {
						$data = "Validado";
 	   					echo json_encode($data);
					}
				} else {

					$data = "Error";
 	   		 	 	echo json_encode($data);
				}
				$dbconec = null;
			} catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);

			}

		}


		public static function Insertar_Salida($descripcion,$cantidad,$producto)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_salida(:descripcion,:cantidad,:producto)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":descripcion",$descripcion);
				$stmt->bindParam(":cantidad",$cantidad);
				$stmt->bindParam(":producto",$producto);

				if($stmt->execute())
				{
					$count = $stmt->rowCount();
					if($count == 0){
						$data = "Duplicado";
 	   					echo json_encode($data);
					} else {
						$data = "Validado";
 	   					echo json_encode($data);
					}
				} else {

					$data = "Error";
 	   		 	 	echo json_encode($data);
				}
				$dbconec = null;
			} catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);

			}

		}

	}


 ?>
