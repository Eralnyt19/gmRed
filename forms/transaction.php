<html>
<body>


<?php


$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);

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
