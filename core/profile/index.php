<?php
	if (empty($_REQUEST['action'])) {
		mainPage();
	} else {
		switch($_REQUEST['action']){
			case 'save': save(); break;
			case 'enter': enter(); break;
			case 'logout': logout(); break;
		}	
	}
	
	function logout(){
		session_start();
		session_destroy();
		header("location:/main");
		exit();
	}
	
	function enter() {
		if (!empty($_POST['login']) && !empty($_POST['password'])) {
			$login = trim(htmlspecialchars(stripslashes($_POST['login'])));
			$password = base64_encode(trim(htmlspecialchars(stripslashes($_POST['password']))));
			$user = MyDB::run("SELECT * FROM user WHERE login='$login'");
			if (!empty($user['password'])) {
				if ($user['password'] == $password) {
					$_SESSION['login'] = $user['login']; 
					$_SESSION['id'] = $user['id'];
					echo "success";
				} else {
					echo "Логин или пароль неверный.";
				}
			} else {
				echo "Логин или пароль неверный.";
			}
		} else {
			echo "Вы ввели не всю информацию!";
		}
		
	}
	
	function mainPage() {
		if (empty($_SESSION['login'])) {
			Template::setFile(SITE_DIR.'/template/main/enter/index.html');
			Template::combine('sign-in');
		}
		
		Template::setFile(SITE_DIR.'/template/profile/index.html');
		if (empty($_SESSION['login'])) {
			Template::setMarker('user', 'гость');
			Template::setMarker('sign-in', Template::getBlock('sign-in'));
			Template::setCondMark('media');
			Template::setCondMark('logout');
		} else {
			Template::setMarker('user', $_SESSION['login']);
			Template::setCondMark('media', true);
			Template::setCondMark('logout', true);
			Template::setMarker('media', Image::getImage(User::get('media_id')));
			Template::setMarker('sign-in', '');
		}
		Template::combine('index');
		
		echo Template::GetBlock('index');
	}
	
	function save() {
		if (isset($_POST['login']) && isset($_POST['password'])) {
			$login = trim(htmlspecialchars(stripslashes($_POST['login'])));
			$password = base64_encode(trim(htmlspecialchars(stripslashes($_POST['password']))));
			$user = MyDB::run("SELECT id FROM user WHERE login='$login'");
			if (!isset($user['id'])) {
				if (!empty($_FILES['photo']['tmp_name'])) {
					$media_id = Image::saveImage($_FILES['photo']['tmp_name']);
					$result = MyDB::run("INSERT INTO user(login,password,media_id) VALUES('$login','$password','$media_id')", 3);
				} else {
					$result = MyDB::run("INSERT INTO user(login,password) VALUES('$login','$password')", 3);
				}
				if ($result) {
					echo "<script>alert(Вы успешно зарегистрированы! Теперь вы можете зайти на сайт.);</script>";
					echo "<script> window.location.href = 'https://sirendia.ru'</script>";
				} else {
					echo "Ошибка! Вы не зарегистрированы.";
				}
			} else {
				echo "Извините, введённый вами логин уже зарегистрирован. Введите другой логин.";
			}
		} else {
			echo "Вы ввели не всю информацию, вернитесь назад и заполните все поля!";
		} 	
	}