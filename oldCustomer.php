

<html>
<body>


<?php

$customer = $_POST["oldname"];
$inSaldo = "0";
$newCustomer = false;


setcookie("customer", $customer);
setcookie("newcustomer", '0');	

define('PUBLIC_PATH',  'public' . DIRECTORY_SEPARATOR);

$mymain = PUBLIC_PATH . 'index.php';

require $mymain;

?>

</body>
</html>
