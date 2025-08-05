<?php 

	require_once('Conexion.php');

	class UsuarioModel extends Conexion
	{
		public static function Listar_Usuarios($idpertenece)
		{
			$dbconec = Conexion::Conectar();
			
			try 
			{
				$query = "CALL sp_view_usuario(:pertenece);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(':pertenece', $idpertenece, PDO::PARAM_INT);
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

		public static function Listar_Empleados($idpertenece)
		{
			$dbconec = Conexion::Conectar();
			echo $idpertenece;
			try 
			{

				

				if ($idpertenece != 0) {
					 $query = "CALL sp_view_empleado_activo_por_pertenece(:pertenece);";
					 $stmt = $dbconec->prepare($query);
					 $stmt->bindParam(':pertenece', $idpertenece, PDO::PARAM_INT);
				}else{
					$query = "CALL sp_view_empleado_activo();";
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


		public static function Insertar_Usuario($usuario, $contrasena, $tipo_usuario, $idempleado,$idPertenece)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				//y ahora cifro la clave usando un hash
				$contrasena1 = password_hash($contrasena, PASSWORD_DEFAULT, array("cost"=>10));
				$query = "CALL sp_insert_usuario(:usuario, :contrasena, :tipo_usuario, :idempleado, :pertenece)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":usuario",$usuario);
				$stmt->bindParam(":contrasena",$contrasena1);
				$stmt->bindParam(":tipo_usuario",$tipo_usuario);
				$stmt->bindParam(":idempleado",$idempleado);
				$stmt->bindParam(":pertenece", $idPertenece);

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

		public static function Editar_Usuario($idusuario, $usuario, $contrasena, $tipo_usuario, $estado, $idempleado)
		{
			

			$dbconec = Conexion::Conectar();
			try 
			{
				//y ahora cifro la clave usando un hash
				$contrasena1 = password_hash($contrasena, PASSWORD_DEFAULT, array("cost"=>10));
				$query = "CALL sp_update_usuario(:idusuario, :usuario, :contrasena, :tipo_usuario, :estado, :idempleado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idusuario",$idusuario);
				$stmt->bindParam(":usuario",$usuario);
				$stmt->bindParam(":contrasena",$contrasena1);
				$stmt->bindParam(":tipo_usuario",$tipo_usuario);
				$stmt->bindParam(":estado",$estado);
				$stmt->bindParam(":idempleado",$idempleado);


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