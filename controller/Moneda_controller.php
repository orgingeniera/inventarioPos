<?php 

	class Moneda {

		public static function Listar_Monedas($idpertenece){

			$filas = MonedaModel::Listar_Monedas($idpertenece);
			return $filas;
		
		}


		public static function Insertar_Moneda($CurrencyISO, $Language, $CurrencyName, $Money, $Symbol,$idpertenece){

			$cmd = MonedaModel::Insertar_Moneda($CurrencyISO, $Language, $CurrencyName, $Money, $Symbol,$idpertenece);
			
		}

		public static function Editar_Moneda($idcurrency, $CurrencyISO, $Language, $CurrencyName, $Money, $Symbol){

			$cmd = MonedaModel::Editar_Moneda($idcurrency, $CurrencyISO, $Language, $CurrencyName, $Money, $Symbol);
			
		}

	}


 ?>