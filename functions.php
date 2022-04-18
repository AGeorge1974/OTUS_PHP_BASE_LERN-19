<?php
function image_resize(
    $source_path,
    $destination_path,
    $newwidth,
    $newheight = FALSE,
    $quality = FALSE // качество для формата jpeg
    ) {
    ini_set("gd.jpeg_ignore_warning", 1); // иначе на некотоых jpeg-файлах не работает
    list($oldwidth, $oldheight, $type) = getimagesize($source_path);
    switch ($type) {
        case IMAGETYPE_JPEG: $typestr = 'JPEG'; break;
        case IMAGETYPE_GIF: $typestr = 'GIF' ;break;
        case IMAGETYPE_PNG: $typestr = 'PNG'; break;
    }
    $function = "imagecreatefrom$typestr";
    $src_resource = $function($source_path);
   
    if (!$newheight) { $newheight = round($newwidth * $oldheight/$oldwidth); }
    elseif (!$newwidth) { $newwidth = round($newheight * $oldwidth/$oldheight); }
    $destination_resource = imagecreatetruecolor($newwidth,$newheight);
   
    imagecopyresampled($destination_resource, $src_resource, 0, 0, 0, 0, $newwidth, $newheight, $oldwidth, $oldheight);
   
    if ($type = 2) { # jpeg
        imageinterlace($destination_resource, 1); // чересстрочное формирование изображение
        imagejpeg($destination_resource, $destination_path, $quality);     
    }
    else { # gif, png
        $function = "image$typestr";
        $function($destination_resource, $destination_path);
    }
   
    imagedestroy($destination_resource);
    imagedestroy($src_resource);
};

function showPicture (){
    global $dir;
    global $dirMini;
    global $aListExtPicture;
    $aFiles = scandir($dir);
    $showImage = "";
    foreach ($aFiles as $itemFile) {
        $aFile = explode(".", $itemFile);
        $nameFileExt = strtoupper($aFile[1]);
        if (in_array($nameFileExt, $aListExtPicture)) {
            if (!file_exists($dirMini . $itemFile)){  // На случай, если сжатое изображение "потерялось"
            image_resize($dir.'/'.$itemFile, $dirMini.'/'.$itemFile, 100,100,100);
            }
            $ref = $dir.'/'.$itemFile;
            $showImage = $showImage . '<div class=refPicture>';
            $showImage = $showImage . '<a target="_blank" href=' . $ref . '>';
            $showImage = $showImage .  '<img src="'. $dirMini . '/' . $itemFile . '" vspace="1" hspace="1">';
            $showImage = $showImage .  '</a>';
            $showImage = $showImage .  '</div>';
        };
    };
    return $showImage;
}

function creteFormSend (){
    $result = "";
    $result = $result . '<form action="/" method="POST" enctype="multipart/form-data">';
    $result = $result . '<input type="file" name="photo"><br>';
    $result = $result . '<input type="submit" name="send" value="Отправить">';
    $result = $result . '</form>';
    return $result;
}

function creteFormLogin (){
    $result = "";
    $result = $result . '<form action="index.php?action=login" method="POST" enctype="multipart/form-data">';
    $result = $result . '<div class="form-group">';
    $result = $result . '<label for="name">Имя пользователя:</label>';
    $result = $result . '<input type="text" class="form-control" name="name">';
    $result = $result . ' </div>';
    $result = $result . '<div class="form-group">';
    $result = $result . '<label for="password">Пароль:</label>';
    $result = $result . '<input type="password" class="form-control" name="password">';
    $result = $result . '</div>';
    $result = $result . '<div class="form-group form-check">';
    $result = $result . '<input type="checkbox" class="form-check-input" name="remember_me">';
    $result = $result . '<label for="remember">Запомнить:</label>';
    $result = $result . '</div>';
    $result = $result . '<input type="submit" class="btn btn-primary" value="Войти">';
    $result = $result . '<div class="form-group">';
    $result = $result . '<a target="_blank" href="newUser">Зарегистрироваться</a>';
    $result = $result . ' </div>';
    $result = $result . '</form>';
    return $result;
}

?>

