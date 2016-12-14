<?php
	/**
	* Класс Item
	* 
	* Класс для работы с товаром
	* 
	* @author Иванов Александр Игоревич <alexandr2194@gmail.com>
	*/
	class Item 
	{
		private static $items;
		private static $category;
		private static $id;
		
		/**
		* Возвращает идентификатор текущего товара
		* 
		* @access public
		* @return integer
		*/
		public static function getId()
		{
			if (Url::getSubSubModule()) {
				self::$id = Url::getSubSubModule();
				return self::$id;
			} else {
				return false;
			}
		}
		
		/**
		* Возвращает категорию текущего товара
		* 
		* @access public
		* @return string
		*/
		public static function getCategory()
		{
			if (Url::getSubModule()) {
				self::$category = Url::getSubModule();
				return self::$category;
			} else {
				return false;
			}
		}
		
		/**
		* Возвращает товары в наличии
		*
		* @access public
		* @return array
		*/
		public static function getInStock()
		{
			self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND status='Есть в наличии'", 1);
			return self::$items;
		}
		
		/**
		* Возвращает удаленные товары
		*
		* @access public
		* @return array
		*/
		public static function getRemoved()
		{
			self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND status='Удален'", 1);
			return self::$items;
		}
		
		/**
		* Возвращает распроданные товары
		*
		* @access public
		* @return array
		*/
		public static function getSoldOut()
		{
			self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND status='Распродан'", 1);
			return self::$items;
		}
		
		/**
		* Возвращает товары по их наличию
		*
		* @access public
		* @return array
		*/
		public static function getByCount($count, $less = false)
		{
			if (!$less)
				self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND count>=".$count, 1);
			else
				self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND count<=".$count, 1);
			return self::$items;
		}
		
		/**
		* Возвращает товары по дате добавления
		*
		* @access public
		* @return array
		*/
		public static function getByDate($date, $less = false)
		{
			if (!$less)
				self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND date_add>=".$date."'", 1);
			else
				self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND date_add<='".$date."'", 1);
			return self::$items;
		}
		
		/**
		* Возвращает товары по количеству продаж
		*
		* @access public
		* @return array
		*/
		public static function getBySales($sales, $less = false)
		{
			if (!$less)
				self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND number_of_sales>=".$sales, 1);
			else
				self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND number_of_sales<=".$sales, 1);
			return self::$items;
		}
		
		/**
		* Возвращает товары по цене
		*
		* @access public
		* @return array
		*/
		public static function getByPrice($price, $less = false)
		{
			if (!$less)
				self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND price>=".$price, 1);
			else
				self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 AND price<=".$price, 1);
			return self::$items;
		}
		
		/**
		* Возвращает товары в категории
		*
		* @access public
		* @return array
		*/
		public static function getByCategory()
		{
			self::getCategory();
			self::$items = MyDB::run("SELECT i.* FROM item i JOIN category c ON i.category = c.id WHERE is_deleted = 0 AND c.title='".self::$category."'", 1);
			return self::$items;
		}
		
		/**
		* Возвращает товар по идентификатору
		*
		* @access public
		* @return array
		*/
		public static function getByID()
		{
			self::getID();
			self::getCategory();
			self::$items = MyDB::run("SELECT i.* FROM item i JOIN category c ON i.category = c.id WHERE is_deleted = 0 AND c.title='".self::$category."' AND i.id=".self::$id);
			return self::$items;
		}
	
	    /**
		* Возвращает популярные товары
		*
		* @access public
		* @return array
		*/
		public static function getByRating($limit)
		{
			self::$items = MyDB::run("SELECT * FROM item WHERE is_deleted = 0 ORDER BY number_of_sales DESC LIMIT ".$limit, 1);
			return self::$items;
		}
		
		/**
		* Возвращает поле объекта item по ключу
		*
		* @access public
		* @return array
		*/
		public static function get($key)
		{
			self::getItem();
			if (array_key_exists($key, self::$item)){
				return self::$item[$key];
			}
			return false;
		}
	}
