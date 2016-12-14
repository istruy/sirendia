<?php

	if (!empty($_POST['action'])) {
		switch($_POST['action']) {
			case "type": getGoodCategory($_POST['id']); break;
		}
	} else {
		if (Item::getID()){
			$t = Item::getByID();
		} else if(Item::getCategory()){
			$t = Item::getByCategory();
		} else {
			$t = Item::getInStock();
		}
		echo "<pre>";
		echo var_dump($t);
		echo "</pre>";
	}

	function getGoodCategory($id) {
		$data = MyDB::run("SELECT c.title title FROM item i JOIN category c ON i.category = c.id WHERE is_deleted = 0 AND i.id='".(int)$id."'");
		if (isset($data['title'])){
			echo $data['title'];
		} else {
			echo "invalid";	
		}
	}