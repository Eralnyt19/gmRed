<html>
<body>
<?php



$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);




require  'app.php';
require  'helper.php';

$customer = $_COOKIE["customer"];





// Make visable for html
$incomeTable = [];
$expenseTable = [];
$transactions = [];



$incomeTable  = getIncome($customer);
$expenseTable  = getExpence($customer); 
$tableHead = getTableHead();

$totals = calculateTotals($customer);
	
require VIEWS_PATH . 'compilation.php';



?>
</body>
</html>

