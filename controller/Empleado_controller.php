<?php 

	class Empleado {

		public static function Listar_Empleados($idpertenece){

			$filas = EmpleadoModel::Listar_Empleados($idpertenece);
			return $filas;
		
		}

		public static function Insertar_Empleado($nombre_empleado, $apellido_empleado, $telefono_empleado, $email_empleado, $imagen,$idPertenece){

			$cmd = EmpleadoModel::Insertar_Empleado($nombre_empleado, $apellido_empleado, $telefono_empleado, $email_empleado, $imagen,$idPertenece);
			
		}

		public static function Editar_Empleado($idempleado, $nombre_empleado, $apellido_empleado, $telefono_empleado, $email_empleado, $estado, $imagen,$cimagen){

			$cmd = EmpleadoModel::Editar_Empleado($idempleado, $nombre_empleado, $apellido_empleado, $telefono_empleado, $email_empleado, $estado, $imagen,$cimagen);
			
		}

	}


 ?>