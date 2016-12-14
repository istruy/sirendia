<?php

	/**
	* Класс User
	* 
	* Для работы с текущим пользователем
	* 
	* @author Иванов Александр Игоревич <alexandr2194@gmail.com>
	*/
	class User 
	{
		private static $user;
		private static $id;
		
		/**
		* Получает id пользователя из глобального массива $_SESSION
		* 
		* @access public
		* @return integer
		*/
		public static function getId()
		{
			if (!empty($_SESSION['id'])) {
				self::$id = $_SESSION['id'];
				return self::$id;
			} else {
				return false;
			}
		}
		
		/**
		* Получает информацию о пользователе
		* 
		* @access public
		* @return array
		*/
		public static function getUser()
		{
			if (self::getId()) {
				self::$user = MyDB::run("SELECT * FROM user WHERE id=".self::$id);
				return self::$user;
			} else {
				return false;	
			}

		}
		
		/**
		* Получает информацию о пользователе по ключу
		* 
		* @access public
		* @return mixed
		*/
		public static function get($key)
		{
			self::getUser();
			if (array_key_exists($key,self::$user)) {
				return self::$user[$key];
			}
			return false;
		}
	}
