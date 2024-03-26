<html>
<body>
<?php
// declare(strict_types = 1);




$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);




$income_list = ["Sjukersättning", "Merkostnad", "Habilitering", "Bostadbidrag", "Lön", "Räntor",
               "Skatteåterbäring", "Övrigt"];

$expense_list = ["Hyra", "Medicin", "Tfn TV", "Försäkring", "Privat", "Övrigt", "Skatt",
                "BankAvg/KvSkatt", "Arvode", "Arvodesskatt", "Färdtjänst", "FUB/ABF",
                "Vattenfall", "Spärrkonto"];

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
	
require VIEWS_PATH . 'transactions.php';




?>
</body>
</html>

