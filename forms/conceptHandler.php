

<html>
<body>


<?php


$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('FORM_PATH', $root . 'forms' . DIRECTORY_SEPARATOR);

require APP_PATH . 'app.php';

$month = $_GET["month"];
$concept = $_GET["concept"];


$monthIndex = getMonthIndex($month);
$conceptKey = getConceptKey($concept);


// SET COOKIES 
setcookie("monthIndex", $monthIndex);
setcookie("conceptKey", $conceptKey);

$customer = $_COOKIE["customer"];
	
$categories = [];


$categories =	getAllCategories($concept);

require "categorySelectorForm.php";

?>




</body>
</html>
