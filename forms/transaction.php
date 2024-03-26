<html>
<body>


<?php


$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('FORM_PATH', $root . 'forms' . DIRECTORY_SEPARATOR);

require APP_PATH . 'app.php';


$category  = $_GET["category"];
$amount1  = $_GET["amount1"];
$amount2  = $_GET["amount2"];


$amount = $amount1 . '.' . $amount2;


writeTransaction($category, $amount);


echo '<script type="text/javascript"> window.location.href="conceptSelectorPrep.php" </script>';	
?>




</body>
</html>
