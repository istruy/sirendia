	<?php

	/**
	* Класс Image
	* 
	* Для работы с изображениями
	* 
	* @author Иванов Александр Игоревич <alexandr2194@gmail.com>
	*/
	class Image
	{
		/**
		* Возвращает цвет текста на изображении
		* 
		* @param integer $mediaId число
		* @access public
		* @return string
		*/
		public static function getColor($mediaId)
		{
			if ((int)$mediaId > 0) {
				$result = MyDB::run("SELECT color FROM media WHERE id=".$mediaId);
				if ($result['color'] != NULL) {
					return $result['color'];	
				} else {
					return false;	
				}
			} else {
				return false;	
			}
		}
		
		/**
		* Возвращает изображение в формате base64
		* 
		* @param integer $mediaId число
		* @access public
		* @return string
		*/
		public static function getImage($mediaId) 
		{
			if ((int)$mediaId > 0) {
				$result = MyDB::run("SELECT media FROM media WHERE id=".$mediaId);
				if(!empty($result['media'])) {
					return 'data:image/*;base64,'.$result['media'];
				} else {
					return 'data:image/*;base64,'.base64_encode(file_get_contents(OVERALL_DIR.'shop/img/profile.jpg'));
				}
			} else {
				return 'data:image/*;base64,'.base64_encode(file_get_contents(OVERALL_DIR.'shop/img/profile.jpg'));
			}
		}
		
		/**
		* Сохраняет изображение в базе
		* 
		* @param string $name строка
		* @param string $desc строка
		* @access public
		* @return string
		*/
		public static function saveImage($name, $desc = false) 
		{
			if ($desc) {
				$result = MyDB::run("INSERT INTO media(media, description) VALUES('".base64_encode(file_get_contents($name))."', '".$desc."')", 3);
			} else {
				$result = MyDB::run("INSERT INTO media(media) VALUES('".base64_encode(file_get_contents($name))."')", 3);
			}
			
			if($result) {
				return $result;
			} else {
			 	return MyDB::getError();
			}
		}	
	}
