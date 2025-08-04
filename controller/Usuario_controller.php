<?php 

	class Usuario {

		public static function Listar_Usuarios($idpertenece){

			$filas = UsuarioModel::Listar_Usuarios($idpertenece);
			return $filas;
		
		}

		public static function Listar_Empleados($idpertenece){
			
			$filas = UsuarioModel::Listar_Empleados($idpertenece);
			return $filas;
		
		}

		public static function Insertar_Usuario($usuario, $contrasena, $tipo_usuario, $idempleado,$idPertenece){

			$cmd = UsuarioModel::Insertar_Usuario($usuario, $contrasena, $tipo_usuario, $idempleado,$idPertenece);
			
		}

		public static function Editar_Usuario($idusuario, $usuario, $contrasena, $tipo_usuario, $estado, $idempleado){

			$cmd = UsuarioModel::Editar_Usuario($idusuario, $usuario, $contrasena, $tipo_usuario, $estado, $idempleado);
			
		}

	}


 ?>