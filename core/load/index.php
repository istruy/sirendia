<html>
    <head>
    	<title>Загрузка изображений</title>
    </head>
    <body>
        <h2>Загрузка изображений</h2>
        <form action="" method="post" enctype="multipart/form-data">
    		<input type="hidden" name="MAX_FILE_SIZE" value="134217728" />
            <p>
                <label>Изображения:<br></label>
                <input type="file" name="photo[]" multiple accept="image/*,image/jpeg">
            </p>
            <p>
                <label>Описание:<br></label>
                <input type="text" name="description">
            </p>
            <p>
                <input type="submit" name="submit" value="Загрузить">
            </p>
    	</form>
	</body>
</html>	
<?php
	ini_set('display_errors',1);
	if (isset($_POST['submit'])) {

		for ($i=0;$i<count($_FILES['photo']['tmp_name']); $i++) {
			echo Image::saveImage($_FILES['photo']['tmp_name'][$i], $_POST['description']);
		}
		unset($_POST['submit']);
	} 

?>
