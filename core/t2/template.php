<?php

	/**
	* Класс Templates
	* 
	* Для работы с динамически подгружаемыми страницами
	* 
	* @author Иванов Александр Игоревич <alexandr2194@gmail.com>
	*/
	class Template
	{
		private static $file;
		private static $markers = array();
		private static $condMarkers = array();
		private static $pages = array();
		
        /**
		* Загружает файл шаблона
		* 
		* @param string $path строка
		* @access public
		* @return boolean
		*/
		public static function setFile($path) 
		{
				self::$file = file_get_contents($path);
				if(!empty(self::$file)) {
					return true; 
				} else {
					return false;
				}
		}
		
		/**
		* Устанавливает маркер
		* 
		* @param string $marker строка
		* @param string $value строка
		* @access public
		* @return boolean
		*/
		public static function setMarker($marker, $value)
		{
			if (!empty($marker)) {
				if (self::isMarkerExist($marker)) {
					for ($i = 0; $i < count(self::$markers); $i++) {
						if (self::$markers[$i]['marker'] == $marker) {
							self::$markers[$i]['value'] = $value;
						}
					}
				} else {
					self::$markers[] = [
					    'marker' => $marker, 
						'value' => $value
					];	
				}
				return true;
			} else {
				return false;
			}
		}
		
		/**
		* Проверяет существование маркера
		* 
		* @param string $marker строка
		* @access private
		* @return boolean
		*/
		private static function isMarkerExist($marker) 
		{
			for ($i = 0; $i < count(self::$markers); $i++) {
				if (self::$markers[$i]['marker'] == $marker) {
					return true;
				}
			}
			return false;
		}

		
		/**
		* Комбинирует блок
		* 
		* @param string $title строка
		* @access public
		* @return boolean
		*/
		public static function combine($title) 
		{
			if (!empty(self::$file)) {
				$tmp = self::$file;
				if (!empty($title)) {					
					foreach (self::$markers as $marker) {
						$tmp = str_replace('['.$marker['marker'].']', $marker['value'], $tmp);
					}
					
					if (!array_key_exists($title, self::$pages)) {
						self::$pages[$title] = $tmp;
					} else {
						self::$pages[$title] .= $tmp;
					}
					return true;
				} else { 
					return false;	
				}
			} else {
				return false;	
			}
		}
		
		/**
		* Возвращает блок шаблона по названию
		* 
		* @param string $title строка
		* @access public
		* @return string
		*/
		public static function getBlock($title) 
		{
			if (array_key_exists($title, self::$pages)) {
				return self::$pages[$title];
			} else {
				return "";	
			}
		}
	}
