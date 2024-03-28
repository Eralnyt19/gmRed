<html>
<body>
<?php
// declare(strict_types = 1);




$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);




require  'app.php';
require  'helper.php';

$customer = $_COOKIE["customer"];





// Make visable for html
$incomeTable = [];
$expenseTable = [];
$transactions = [];



//$transactions[] = getTransactionsNew($customer);
//$transactions[] = getTransactionsNew("Rune);



$incomeTable  = getIncome($customer);
$expenseTable  = getExpence($customer); 


$totals = calculateTotals($customer);
	
require VIEWS_PATH . 'compilation.php';



?>
</body>
</html>

