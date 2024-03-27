

<html>
<body>


<?php

$customer = $_POST["oldname"];
$inSaldo = "0";
$newCustomer = false;


setcookie("customer", $customer);
setcookie("newcustomer", '0');	


require "./main.php";

?>

</body>
</html>
