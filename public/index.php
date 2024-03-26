<?php

// declare(strict_types = 1);


$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('FORM_PATH', $root . 'forms' . DIRECTORY_SEPARATOR);


                
$newCustomerOk = false;
$customerExist = false;

require APP_PATH . 'app.php';
require APP_PATH . 'helper.php';





$customerExist = checkIfCustomerExist($customer);



if($newCustomer) {
		$newCustomerOk  = createNewCustomer($customer, FILES_PATH, $inSaldo);
} 
	
				
if( ($customerExist && !$newCustomer) ||   $newCustomerOk ){




echo '<script type="text/javascript"> window.location.href="forms/conceptSelectorPrep.php" </script>';	

} else {
	
	if($newCustomer){	
		alreadyExist();
	} else {
		notKnown();
		
	}	
	
	$show = true;
	
	require($root  . "fullFormSwitch.php"); 
}


?>
