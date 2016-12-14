<?php
	if (Url::getModule()) {
		echo "<script> window.location.href = 'https://sirendia.ru'</script>";
	} else {
		mainPage();
	}
	
	function mainPage() 
	{
		// sign-in //
		if (empty($_SESSION['login'])) {
			Template::setFile(SITE_DIR.'/template/main/content/sign-in.html');
			Template::combine('sign-in');
		}
		
		// header //
		Template::setFile(SITE_DIR.'/template/main/content/header.html');
		if (empty($_SESSION['login'])) {
			Template::setCondMark('isLogin');
		} else {
			Template::setCondMark('isLogin',true);
			Template::setMarker('media',Image::getImage(User::GET('media_id')));
			Template::setMarker('name',User::GET('name'));
		}
		Template::combine('header');
		
		// slider //
		$sliders = MyDB::run("SELECT * FROM home_slider WHERE is_active = 1", 1);
		Template::setFile(SITE_DIR.'/template/main/content/home-slider/slider-el.html');
		for ($i = 0; $i < count($sliders); $i++) {
			Template::setMarker('id', $sliders[$i]['id']);
			Template::setMarker('media', Image::getImage($sliders[$i]['media_id']));
			if (Image::getColor($sliders[$i]['media_id'])) {
				Template::setCondMark('isColor');
				Template::setMarker('color', Image::getColor($sliders[$i]['media_id']));	
			} else {
				Template::setCondMark('isColor',true);
			}
			Template::setMarker('title', $sliders[$i]['title']);
			Template::setMarker('price', $sliders[$i]['description']);	
			Template::combine('home-slider-elements');
		}
		Template::setFile(SITE_DIR.'/Templates/main/content/home-slider/index.html');
		Template::setMarker('sliders', Template::getBlock('home-slider-elements'));
		Template::combine('home-slider');
		unset($sliders);
		
		// goods //
		$goods = Item::getByRating(9);
		Template::setFile(SITE_DIR.'/template/main/content/good-el.html');
		for ($j = 0; $j < 2; $j++) {
			for ($i = 0; $i < count($goods); $i++) {
				Template::setMarker('id', $goods[$i]['id']);
				Template::setMarker('media', Image::getImage($goods[$i]['media_id']));
				Template::setMarker('title', $goods[$i]['title']);
				Template::setMarker('price', $goods[$i]['price']);	
				Template::combine('goods');
			}
		}
		unset($goods);

		// footer //
		Template::setFile(SITE_DIR.'/template/main/content/footer.html');
		Template::combine('footer');
		
		// index //
		Template::setFile(SITE_DIR.'/template/main/index.html');
		if (empty($_SESSION['login'])) {
			Template::setCondMark('isLogin');
			Template::setMarker('sign-in', Template::getBlock('sign-in'));
		} else {
			Template::setCondMark('isLogin', true);
		}
		Template::setMarker('header', Template::getBlock('header'));
		Template::setMarker('home-slider', Template::getBlock('home-slider'));
		Template::setMarker('goods', Template::getBlock('goods'));
		Template::setMarker('footer', Template::getBlock('footer'));
		Template::combine('index');
		
		echo Template::getBlock('index');
	}
	