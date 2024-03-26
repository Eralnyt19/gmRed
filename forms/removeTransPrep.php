<html>
<body>


<?php


$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('FORM_PATH', $root . 'forms' . DIRECTORY_SEPARATOR);

require APP_PATH . 'app.php';



$customer = $_COOKIE["customer"];

$trans =[];

$trans = retrieveLatestTransaction();

$latestTrans =  $trans["TransId"];
setcookie("latestTrans", $latestTrans);


$conceptKey = $trans["Concept"];
$categoryIndex = $trans["Category"];
$monthIx= $trans["Month"];
$amount = $trans["Amount"];

$concept = getConceptName($conceptKey);

$category = getCategoryDescription($categoryIndex, $conceptKey);
$month = getMonth($monthIx);

// If attempt made to remove the OpeningBalance
// So adjust the info accordingly

if($concept == "OpeningBalance") {
	$category = "För att ändra måste man skapa ny kund";
	$month = "Detta är ingående balans";
}


require "removeTransForm.php";

?>




</body>
</html>