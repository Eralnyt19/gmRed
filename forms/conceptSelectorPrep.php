<html>
<body>


<?php


$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('FORM_PATH', $root . 'forms' . DIRECTORY_SEPARATOR);
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);

require APP_PATH . 'app.php';


 
$months = getAllMonths();
$concepts = getAllConcepts();


$customer = $_COOKIE["customer"];

$monthIndex = $_COOKIE["monthIndex"];

if ($monthIndex == NULL) {
	 $monthIndex = 1;
}

$preMonth = getMonth($monthIndex);

$saldo =  getSaldo($customer);

$saldo = number_format($saldo,2);

require "conceptSelectorForm.php";

?>




</body>
</html>
