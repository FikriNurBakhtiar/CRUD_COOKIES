<?php 
    require 'functions.php';

    $path = "assets/";
    $full_path = $path.$GET['file_name'];

    if($fd = fopen($full_path, "r")){
        $fsize = filesize($full_path);
        $path_parts = patchinfo($full_path);
        $ext = strtolower($path_parts["extension"]);
        switch ($ext){
            case "jpg":
                header("Content-Type: application/jpg");

                header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
            break;
            default:
                header("Content-type: application/octet-stream");
                header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
            break;
        }
        header("Content-length: $fsize");
        while(!feof($fd)){
            $buffer = fread($fd, 2048);
            echo $buffer;
        }
    }
    fclose($fd);
    exit;

?>  