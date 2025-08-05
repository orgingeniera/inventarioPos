<?php 

	class Comprobante {

		public static function Listar_Comprobantes($idpertenece){

			$filas = ComprobanteModel::Listar_Comprobantes($idpertenece);
			return $filas;
		
		}

		public static function Insertar_Comprobante($comprobante,$idpertenece){

			$cmd = ComprobanteModel::Insertar_Comprobante($comprobante,$idpertenece);
			
		}

		public static function Editar_Comprobante($idcomprobante,$comprobante,$estado){

			$cmd = ComprobanteModel::Editar_Comprobante($idcomprobante,$comprobante,$estado);
			
		}

	}


 ?>