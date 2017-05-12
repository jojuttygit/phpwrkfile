<?php 
function __autoload($className) {
	//echo 
	require $className.".php";
}
?>