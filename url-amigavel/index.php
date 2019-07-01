 
<?php

$url = (isset($_GET["url"])) ? $_GET["url"] : false;

$url = array_filter(explode('/',$url));
print_r($url);
$file = (isset($url[0])) ? $url[0].".php" : "home.php";

if(file_exists($file)){
	include $file;
} else {
	include '404.php';
}

?>
