<?php
	/**
	* Класс MyDB
	* 
	* Для работы с базой данных
	* 
	* @author Иванов Александр Игоревич <alexandr2194@gmail.com>
	*/
	class MyDB 
	{
		private static $dbLogin = "root";
		private static $dbPassword = "password";
		private static $db = "Shop"; 
		private static $dbHost = "localhost";
	
		private static $link;
		private static $err;
		private static $data;
	
		/**
		* Открывает соединение с базой
		* 
		* @access private
		*/
		private static function connect()
		{
			self::$link = mysql_connect(self::$dbHost, self::$dbLogin, self::$dbPassword);
			mysql_select_db(self::$db); 
			mysql_query('SET NAMES utf8');
		}
		
		/**
		* Закрывает соединение с базой
		* 
		* @access public
		*/
		private static function close()
		{
			mysql_close(self::$link);
		}
		
		/**
		* Возвращает сообщение об ошибке MySQL
		* 
		* @access public
		* @return string
		*/
		public static function getError()
		{
			return self::$err;
		}
		
		/**
		* Выполняет запрос MySQL
		* 
		* @param string $query строка
		* @param int $oneRowReturn число
		* @access public
		* @return mixed
		*/
		public static function run($query, $oneRowReturn = 0)
		{
			self::connect();
			$result = null;
			$tmpQuery = $query;
			$tmpResult = mysql_query($tmpQuery, self::$link);
			self::$err = mysql_error();
			switch($oneRowReturn) {
				case 0:
					$result = mysql_fetch_assoc($tmpResult);
					self::close();
					break;
				case 1:
					while ($tmpData = mysql_fetch_assoc($tmpResult)) {
						$result[] = $tmpData;
					}
					self::close();
					break;
				default:
					$result = mysql_insert_id();
					self::close();
			}
			return $result;
		}
	}
