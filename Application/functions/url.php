<?php

	/**
	* Класс Url
	* 
	* Для работы с url
	* 
	* @author Иванов Александр Игоревич <alexandr2194@gmail.com>
	*/
	class Url
	{
		private static $url;
		
		/**
		* Загружает текущий url из глобального массива $_GET
		* 
		* @param array $url ассоциативный массив
		* @access private
		* @return boolean
		*/
		private static function setURL($url)
		{
			if (!empty($url)) {
				self::$url = $url;
				return true;
			} else {
				return false;	
			}
		}
		
		/**
		* Возвращает название текущиго модуля
		* 
		* @access public
		* @return string
		*/
		public static function getModule()
		{
			self::setURL($_GET);
			if (isset(self::$url['p'])) {
				return self::$url['p'];
			} else {
				return false;	
			}
		}
		
		/**
		* Возвращает название текущего подмодуля 1го уровня
		* 
		* @access public
		* @return string
		*/
		public static function getSubModule()
		{
			self::setURL($_GET);
			if (isset(self::$url['p1'])) {
				return self::$url['p1'];
			} else {
				return false;	
			}
		}
		
		/**
		* Возвращает название текущего подмодуля 2го уровня
		* 
		* @access public
		* @return string
		*/
		public static function getSubSubModule()
		{
			self::setURL($_GET);
			if (isset(self::$url['p2'])) {
				return self::$url['p2'];
			} else {
				return false;	
			}
		}	
	}
