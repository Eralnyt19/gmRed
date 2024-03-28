<?php

require("db_functions.php");



// $tableHead = ["Category", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Total"];

define ('INCOME' , 1) ; 
define ('EXPENSE' , 2) ; 
define ('DESCRIPTIONPOS' , 0) ; 
define ('TOTALPOS' , 13) ; 
define ('MONTHINYEAR' , 12) ; 




function  getIncome($customer){
	return getTransactions($customer, "Inkomst");
}


function  getExpence($customer){
	return getTransactions($customer, "Utgift");
}



////////////////////////////////////////////////
////////// GET TRANSACTIONS ///////////////////
///////////////////////////////////////////////////
function  getTransactions($customer, $concept) {


	$table = [];
	$customerId = getCustomerIdFromDb($customer);
	$conceptKey = getConceptKeyFromDb($concept);
	
	$inCat = getAllCategoriesFromDb($concept);	

	$categoryIndex=0;	
	
	foreach($inCat as $category ) {
		
			$rowAndTotal = getRow($customerId, $conceptKey, $category, $categoryIndex);
			$row = $rowAndTotal['row'];
			$total = floatval($rowAndTotal['total']);
			$row[TOTALPOS] += $total;
			$table[] =  $row;
			$categoryIndex++;
		
	}
return $table;
}	



function getRow($customerId, $conceptKey, $category, $categoryIndex){
	
	$row = [];
	$row[DESCRIPTIONPOS] = $category;
	


	// Initiate
	$categoryTotal = 0.0;
	for ($i = 1; $i <=TOTALPOS; $i++ )  {
		$row[$i] = 0.0;
	}
	
		
	for($monthIx = DESCRIPTIONPOS; $monthIx <= MONTHINYEAR; $monthIx++ ) {
		$transactions = getTransactionsFromDb($customerId, $conceptKey, $categoryIndex, $monthIx);
		foreach($transactions as $transaction ) {
			$row[$monthIx] += formatAmount($transaction["Amount"], $conceptKey);
		}
		$categoryTotal += floatVal($row[$monthIx]);
	}
	return ['row' => $row, 'total' => $categoryTotal];
}



function formatAmount($amount, $conceptKey) {
	$amount =  (float) preg_replace("/[^-0-9\.]/","", $amount);
	
	$conceptName = getConceptNameFromDb($conceptKey);

	if ($conceptName == 'Utgift') { $amount = -$amount;}   
	return $amount;
}
	


function  calculateTotals($customer){
	$totals = ['inSaldo' => 0, 'netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];
	
	$totals['inSaldo'] = getOpeningBalanceFromDb($customer);
	$totals['totalIncome'] = getTotalIncomeFromDb($customer);
	$totals['totalExpense'] = -(float)getTotalExpenseFromDb($customer);
	$totals['netTotal'] =  (floatval($totals['inSaldo'] ) + floatval($totals['totalIncome']) + floatval($totals['totalExpense']));
	
	return $totals;

}




function checkIfCustomerExist($customer)  {

	$res = checkCustomerInDb($customer);
	return $res;
}




////////////////////////////////////////////////
////////// CREATE NEW CUSTOMER ///////////////////
///////////////////////////////////////////////////
function createNewCustomer($customer, $inSaldo) {

		// Just to be sure
	$res = checkCustomerInDb($customer);
	

	if(!$res) {
		$inSaldoIx = writeOpeningBalanceToDb($customer, $inSaldo);
	
		$conceptKey = getConceptKeyFromDb("OpeningBalance");
	
	
	  // Customer, Index representing last year, DB key for Opening Balance, No Category, The opening balance 
		writeTransToDb($customer, $inSaldoIx, $conceptKey, '0', $inSaldo);
	
	}			
	

	return !$res;
}


///////////////////////////////////////////////////
////////// WRITE TRANSACTION///////////////////
///////////////////////////////////////////////////
function writeTransaction($category, $amount) {


	$customer = $_COOKIE["customer"];
	$monthIndex = $_COOKIE["monthIndex"];
	$conceptKey = $_COOKIE["conceptKey"];

	$categoryIndex = getCategoryIndexFromDb($category, $conceptKey);

	writeTransToDb($customer, $monthIndex, $conceptKey, $categoryIndex , $amount);
	$saldo = updateSaldo($customer, $conceptKey, $amount);
	return $saldo;

}


function updateSaldo($customer,$conceptKey, $amount){

	$saldo = getSaldoFromDb($customer);
	
	$concept = getConceptNameFromDb($conceptKey);
	
	if($concept== "Inkomst") {
		$saldo += floatval($amount);
	} else {
		$saldo -= floatval($amount);
	}
	
	
	writeSaldoToDb($customer, $saldo);
	return $saldo;

}


function retrieveLatestTransaction(){

// SELECT MAX(TransId) AS lp FROM Transactions WHERE PersonId='41';

	$customer = $_COOKIE["customer"];
	$transId = getLatestTransFromDb($customer);

	$transaction = getTransactionFromDb($transId);	
	
return $transaction;
}


function getConceptName($conceptKey) {
	return getConceptNameFromDb($conceptKey);
}


function getCategoryDescription($categoryIndex, $conceptKey) {
 	return getCategoryDescriptionFromDb($categoryIndex, $conceptKey);
}


function getMonth($monthIx) {
	 return getMonthNameFromDb($monthIx);
}

function getSaldo($customer){

	return  getSaldoFromDb($customer);
}


///////////////////////////////////////////////////
////////// REMOVE TRANSACTION///////////////////
///////////////////////////////////////////////////
function removeTransaction($transId){
	
	$customer = $_COOKIE["customer"];	
	
	$row = getTransactionFromDb($transId);
	
	$amount = floatval($row['Amount']);
	$conceptKey = intval($row['Concept']);
	$concept = getConceptNameFromDb($conceptKey);	

	// We cannot remove the Opening Balance
	if($concept != 'OpeningBalance')  {
	
	// Remove, so reverse sign
	$amount = - $amount;
	
	$saldo = updateSaldo($customer, $conceptKey, $amount);
	removeTransactionFromDb($transId);
	
	}
	
}

function getAllMonths(){

	return getAllMonthsFromDb();

}


function getAllConcepts(){

	return getAllConceptsFromDb();
}


function getAllCategories($concept){
	return getAllCategoriesFromDb($concept);
}


function getMonthIndex($month) {
	return getMonthIndexFromDb($month);
}


function getConceptKey($concept) {
	return getConceptKeyFromDb($concept);
}

function getTableHead() {
	return getTableHeadFromDb();
}


?>
