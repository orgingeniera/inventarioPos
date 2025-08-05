<?php 

	require_once('Conexion.php');

	class ComprobanteModel extends Conexion
	{
		public static function Listar_Comprobantes($idpertenece)
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				if ($idpertenece != 0) {
					$query = "CALL sp_view_comprobante_pertenece(:pertenece);";
					$stmt = $dbconec->prepare($query);
					$stmt->bindParam(':pertenece', $idpertenece, PDO::PARAM_INT);
				}else{
					$query = "CALL sp_view_comprobante();";
					$stmt = $dbconec->prepare($query);
				}
				
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

		public static function Insertar_comprobante($comprobante,$pertenece)
		{
			$dbconec = Conexion::Conectar();
			try 
			{

				$query = "CALL sp_insertar_comprobante_todo(:comprobante, :pertenece)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":comprobante", $comprobante);
				$stmt->bindParam(":pertenece", $pertenece);

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

		public static function Editar_comprobante($idcomprobante,$comprobante,$estado)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_update_comprobante(:idcomprobante,:comprobante,:estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idcomprobante",$idcomprobante);
				$stmt->bindParam(":comprobante",$comprobante);
				$stmt->bindParam(":estado",$estado);


				if($stmt->execute())
				{

				  $data = "Validado";
   				  echo json_encode($data);
				
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