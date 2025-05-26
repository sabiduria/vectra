<?php
	include_once ('config.php');
	class Connexion {
		// Declaration des attributs
		private static $ressource;
		
		private function __construct () {}
		
		// Declaration des méthodes
		public static function getConnexion() {
			if(self::$ressource==null) {
				self::$ressource=new PDO(DSN, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_SILENT));
				//self::$ressource=new PDO(DSN, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
				return self::$ressource;
			} else {
				return self::$ressource;
			}
		}
	}
?>