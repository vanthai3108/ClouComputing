<?php 
        



function newName ($path,$fileName) {
    while(file_exists($path.$fileName)) {
        $fileName ='n'.$fileName;
    }
    return $path.$fileName;
}
?>