<?php
//echo constant('base_path');
function __autoload($className) {
	if ($className == 'dbConnection') {
		require "../../database/".$className.".php";
	}
	else {
		require "../controller/".$className.".php";
	}
}
?>