<?php
if($_GET['img']){
header('Content-Type: image/jpg');
readfile($_GET['img']);
}else{
    echo "No Picture";
}
?>