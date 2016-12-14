<?php
	class OtherFunctions
	{
		public static function dump($obj) 
		{
			echo "<pre>";
			echo var_dump($obj);
			echo "</pre>";	
		}
		
		public static function loadHttps()
		{
			if ($_SERVER['REQUEST_SCHEME'] == 'http') {
				if (Url::getModule()) {
					echo "<script> window.location.href='https://sirendia.ru/".Url::getModule()."';</script>";
				} else {
					echo "<script> window.location.href='https://sirendia.ru';</script>";
				}
				
			}	
		}
		
		public static function loadModules()
		{
			$url = explode('.', $_SERVER['HTTP_HOST']);
			if ($url[0] == "sirendia") {
				if (Url::getModule()) {
					if (file_exists(SITE_DIR."core/".Url::getModule()."/index.php")) {
						include(SITE_DIR."core/".Url::getModule()."/index.php");
					} else {
						echo file_get_contents(SITE_DIR."Templates/error/index.html");
					}
				} else {
					include(SITE_DIR."core/main/index.php");
				}
			} else {
				echo file_get_contents(SITE_DIR."Templates/error/index.html");
			}	
		}
	}
