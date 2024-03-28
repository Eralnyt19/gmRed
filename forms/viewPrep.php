<html>
<body>


<?php


$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('FORM_PATH', $root . 'forms' . DIRECTORY_SEPARATOR);

require APP_PATH . 'app.php';

//$link = APP_PATH . 'displayView.php';

$link = "../app/displayView.php";




echo "<script type='text/javascript'> window.location.href='$link'</script>";


?>


</body>
</html>
