<?php


                
$newCustomerOk = false;
$customerExist = false;

require 'app/app.php';
require 'app/helper.php';



$customerExist = checkIfCustomerExist($customer);



if($newCustomer) {
		$newCustomerOk  = createNewCustomer($customer,  $inSaldo);
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
