<html>
<body>


<?php


$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('FORM_PATH', $root . 'forms' . DIRECTORY_SEPARATOR);

require APP_PATH . 'app.php';

$transId =  $_COOKIE["latestTrans"];

removeTransaction($transId);


echo '<script type="text/javascript"> window.location.href="conceptSelectorPrep.php" </script>';	


?>




</body>
</html>