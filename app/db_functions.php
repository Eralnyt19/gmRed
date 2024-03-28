<?php


function writeOpeningBalanceToDb($customer, $inSaldo) {

require ("db.php");

$timePeriod = "LastYear";


$sql = "SELECT Id FROM Months WHERE Name = '$timePeriod'";

$result = $conn->query($sql);
$month = $result->fetch_assoc();
$monthId = $month["Id"];

// Initially out saldo = in saldo
$sql = "INSERT INTO Saldo (Name, InSaldo, OutSaldo) VALUES ('$customer' , '$inSaldo' , '$inSaldo')";
$result = $conn->query($sql);

$conn->close();

// Return time index indicating Last Year
return $monthId;
}


function getOpeningBalanceFromDb($customer) {
require ("db.php");	


$sql = "SELECT inSaldo FROM Saldo WHERE  Name = '$customer'";       

$result = $conn->query($sql);
$saldos = $result->fetch_assoc();
$saldo = $saldos["inSaldo"];

$conn->close();

// Return time index indicating Last Year
return $saldo;

}

function writeSaldoToDb($customer, $saldo) {
require ("db.php");	

$sql = "UPDATE Saldo  SET OutSaldo = '$saldo' WHERE Name = '$customer'" ;
$result = $conn->query($sql);

$conn->close();

}


function getSaldoFromDb($customer) {
require ("db.php");	


$sql = "SELECT OutSaldo FROM Saldo WHERE  Name = '$customer'";       

$result = $conn->query($sql);
$saldos = $result->fetch_assoc();
$saldo = $saldos["OutSaldo"];

$conn->close();

// Return time index indicating Last Year
return $saldo;

}

function getTotalIncomeFromDb($customer){
	require ("db.php");
	
	$saldo = 0.0;
	$categoryKey = getConceptKeyFromDb("Inkomst");
	$customId = getCustomerIdFromDb($customer);
	
	
	$sql = "SELECT Amount FROM Transactions WHERE  PersonId = '$customId' AND Concept = '$categoryKey'";  

	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while ($amount = $result->fetch_assoc())	 {
			$saldo += floatval($amount['Amount']);
		}
	}
	
	$conn->close();
	return $saldo;
}


function getTotalExpenseFromDb($customer){
	require ("db.php");
	
	$saldo = 0.0;
	$categoryKey = getConceptKeyFromDb("Utgift");
	$customId = getCustomerIdFromDb($customer);
	
	
	$sql = "SELECT Amount FROM Transactions WHERE  PersonId = '$customId' AND Concept = '$categoryKey'";  
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while ($amount = $result->fetch_assoc()) {	
			$saldo += floatval($amount['Amount']);
		}
	}
	
	$conn->close();
	return $saldo;	
}


function checkCustomerInDb($customer){
require ("db.php");

 
$sql = "SELECT Name FROM Saldo WHERE Name = '$customer'"; 
$result = $conn->query($sql);
$conn->close();

return ($result->num_rows > 0);
  
}


function writeTransToDb($customer, $monthIndex, $concept, $category, $amount) {

require ("db.php");

$sql = "SELECT PersonId FROM Saldo WHERE Name = '$customer'";


$result = $conn->query($sql);
$customerInfo = $result->fetch_assoc();
$personId = $customerInfo["PersonId"];


$sql = "INSERT INTO Transactions (PersonId, Month, Concept, Category, Amount) VALUES ('$personId' , '$monthIndex' , '$concept', '$category', '$amount')";


$result = $conn->query($sql);

$conn->close();

}


// Concepts:   Income, Expense, Opening balance
function getConceptKeyFromDb($concept){
require ("db.php");

$sql = "SELECT ConceptKey FROM Concepts WHERE conceptValue = '$concept'";

$result = $conn->query($sql);
$info = $result->fetch_assoc();
$key  = $info["ConceptKey"];

$conn->close();

return $key;

}

// Concepts:   Income, Expense, Opening balance
function getConceptNameFromDb($conceptKey){
require ("db.php");

$sql = "SELECT conceptValue FROM Concepts WHERE ConceptKey  = '$conceptKey'";

$result = $conn->query($sql);
$info = $result->fetch_assoc();
$value  = $info["conceptValue"];

$conn->close();

return $value;

}


function getMonthIndexFromDb($month){
require ("db.php");

$sql = "SELECT Id FROM Months WHERE Name = '$month'";

$result = $conn->query($sql);
$monthIndexes = $result->fetch_assoc();
$monthIndex  = $monthIndexes["Id"];

$conn->close();

return $monthIndex;

}



function getMonthNameFromDb($monthIx){
require ("db.php");

$sql = "SELECT Name FROM Months WHERE Id = '$monthIx'";

$result = $conn->query($sql);
$monthIndexes = $result->fetch_assoc();
$month  = $monthIndexes["Name"];

$conn->close();

return $month;

}



function getCustomerIdFromDb($customer){
require ("db.php");

$sql = "SELECT PersonId FROM Saldo WHERE Name = '$customer'";

$result = $conn->query($sql);
$personIndexes = $result->fetch_assoc();
$personIndex  = $personIndexes["PersonId"];

$conn->close();

return $personIndex;

}



function getCategoryDescriptionFromDb($categoryIndex, $conceptKey){
require ("db.php");

if($conceptKey == 1 ) {
	$sql = "SELECT Description FROM InCat WHERE Id = '$categoryIndex'";
} else {
	$sql = "SELECT Description FROM OutCat WHERE Id = '$categoryIndex'";
}

$result = $conn->query($sql);
$categorys = $result->fetch_assoc();
$category  = $categorys["Description"];


$conn->close();

return $category;

}

function getCategoryIndexFromDb($category, $conceptKey){
require ("db.php");

if($conceptKey == 1 ) {
	$sql = "SELECT Id FROM InCat WHERE Description = '$category'";
} else {
	$sql = "SELECT Id FROM OutCat WHERE Description = '$category'";
}

$result = $conn->query($sql);
$categoryIndexes = $result->fetch_assoc();
$categoryIndex  = $categoryIndexes["Id"];


$conn->close();

return $categoryIndex;

}



function getLatestTransFromDb($customer){
// SELECT MAX(TransId) AS lp FROM Transactions WHERE PersonId='41';

require ("db.php");

$sql = "SELECT PersonId FROM Saldo WHERE Name = '$customer'";

$result = $conn->query($sql);
$personIndexes = $result->fetch_assoc();
$personIndex  = $personIndexes["PersonId"];

$sql= "SELECT MAX(TransId) AS LatestTrans FROM Transactions WHERE PersonId='$personIndex'";


$result = $conn->query($sql);
$info = $result->fetch_assoc();
$maxIndex  = $info["LatestTrans"];


$conn->close();


/*while($row = mysqli_fetch_array($result)){
    echo "Minimum Salary :". $row['MIN(salary)'];
    echo "<br />";
     
}*/

return $maxIndex;

}

function getTransactionFromDb($transId){
require ("db.php");

$sql = "SELECT * FROM Transactions WHERE TransId = '$transId'";

$result = $conn->query($sql);
$transRow = $result->fetch_assoc();
// $personIndex  = $personIndexes["PersonId"];



$conn->close();

return $transRow;
}


function getTransactionsFromDb($customerId, $conceptKey, $categoryIndex, $monthIndex){
require ("db.php");

$sql = "SELECT * FROM Transactions WHERE PersonId = '$customerId' AND Month = $monthIndex AND Concept = $conceptKey AND Category = $categoryIndex";
$result = $conn->query($sql);

$transactions = [];


if ($result->num_rows > 0) {
		while ($transaction = $result->fetch_assoc()) {
//			array_push($transactions, $transaction["Description"]);
			array_push($transactions, $transaction);

		}
	}



$conn->close();

return $transactions;
}


function removeTransactionFromDb($transId){
require ("db.php");
$sql = "DELETE FROM Transactions WHERE TransId='$transId'"; 
$result = $conn->query($sql);

$conn->close();
}



function getAllMonthsFromDb(){
require ("db.php");

$sql = "SELECT * FROM Months WHERE Name != 'LastYear';";

$result = $conn->query($sql);
$month = $result->fetch_assoc();
$month = $month["Name"];

$months = [];
array_push($months, $month);

if ($result->num_rows > 0) {
		while ($month = $result->fetch_assoc()) {
			array_push($months, $month["Name"]);
		}
}
return $months;

}

function getAllConceptsFromDb(){
require ("db.php");

$sql = "SELECT * FROM Concepts WHERE ConceptValue != 'OpeningBalance';";

$result = $conn->query($sql);

$concepts = [];


if ($result->num_rows > 0) {
		while ($concept = $result->fetch_assoc()) {
			array_push($concepts, $concept["ConceptValue"]);
		}
	}
return $concepts;

}

function getAllCategoriesFromDb(string $concept){
require ("db.php");
if($concept == "Inkomst") {
		$sql = "SELECT * FROM InCat;";
}	else {
		$sql = "SELECT * FROM OutCat;";	
}

$result = $conn->query($sql);

$categories = [];


if ($result->num_rows > 0) {
		while ($category = $result->fetch_assoc()) {
			array_push($categories, $category["Description"]);
		}
	}
return $categories;

}

function getTableHeadFromDb(){
require ("db.php");

$sql = "SELECT * FROM TableHead;";

$result = $conn->query($sql);

$tableHead = [];


if ($result->num_rows > 0) {
		while ($item = $result->fetch_assoc()) {
			array_push($tableHead, $item["Description"]);
		}
}
return $tableHead;

}







?>
