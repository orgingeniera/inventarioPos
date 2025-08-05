<?php 

	class Tiraje {

		public static function Listar_Tirajes($idpertenece){

			$filas = TirajeModel::Listar_Tirajes($idpertenece);
			return $filas;
		
		}

		public static function Listar_Comprobantes($idpertenece){

			$filas = TirajeModel::Listar_Comprobantes($idpertenece);
			return $filas;
		
		}

		public static function Insertar_Tiraje($fecha_resolucion, $numero_resolucion, $serie, $desde, $hasta, $disponibles, $idcomprobante,$idpertenece){

			$cmd = TirajeModel::Insertar_Tiraje($fecha_resolucion, $numero_resolucion, $serie, $desde, $hasta, $disponibles, $idcomprobante,$idpertenece);
			
		}

		public static function Editar_Tiraje($idtiraje, $fecha_resolucion, $numero_resolucion, $serie, $desde, $hasta, $disponibles, $idcomprobante){

			$cmd = TirajeModel::Editar_Tiraje($idtiraje, $fecha_resolucion, $numero_resolucion, $serie, $desde, $hasta, $disponibles, $idcomprobante);
			
		}

	}


 ?>