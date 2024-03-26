<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}

form#hiddenform {
    padding: 20px;
    border-radius: 3px;
    border-width: 2px;
    border-color: #b95d52;
    border-style: double;
}

form#form1 {
    padding: 20px;
    border-radius: 3px;
    border-width: 2px;
    border-color: #b95d52;
    border-style: double;
}


</style>
 
</head>
<body> 
 
<?php


$nameErr = $saldoErr = "";


if(!isset($customer)) {
	$customer = "";
}
if(!isset($inSaldo)) {
	$inSaldo = "";
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
  if (empty($_POST["name"])) {
     $nameErr = "Name is required";

  } else {
    $customer = test_input($_POST["name"]);
 }

 
    // check if name only contains letters and whitespace
//    if (!preg_match("/^[a-zA-Z-' ]*$/",$customer)) {
//      $nameErr = "Only letters and white space allowed";
//    }

if (isset($_POST["inSaldo"])) {
	$inSaldo =   $_POST["inSaldo"];
 } 

//  	if(empty($inSaldo ) && $inSaldo  != '0') {

  	if(empty($inSaldo ) ) {
  		$saldoOk = false;
  	} else {
  	 		$saldoOk = true;
  	}
  	
  	
	if ($saldoOk) {
   	 $inSaldo = test_input($inSaldo );		
	}	 else {
		$saldoErr = "Saldo is required";
 	   $inSaldo = false;
	}
	  


//    SET COOKIES BEFORE ESCAPING THE CUSTOMER FORM	
  if (empty($_POST["name"]) || !$saldoOk) {
		setcookie("customer", "");
		setcookie("insaldo", "");
		setcookie("newcustomer", false);	
	} else {
		setcookie("customer", $customer);
		setcookie("insaldo", $inSaldo);
		setcookie("newcustomer", true);	
	

		echo '<script type="text/javascript"> window.location.href="newCustomer.php" </script>';
	
	}
}	
	
?>
<br><br><br>
<form action="oldCustomer.php" id= "form1" name="form1" method="post">
<br><br><br><br><br>
<input type="submit" style= "background-color: #6CE9F9";  value="Hämta redovisning">
<br><br>
<label for="oldname">Kundens namn:</label>
<input type="text" id="name1" name="oldname"><br><br><br>
</form>
<br><br><br>


<!-- <span id="eller" style="color:blue">---------------- ELLER -----------------</span> -->                 


<br><br>
<!--    Any point with the php include ? -->
<form method="post" id="hiddenform" name="hiddenform" action="<?php echo htmlspecialchars("/gm-view/fullFormSwitch.php");?>">  
<br><br><br><br><br>

<input type="submit" style= "background-color: #6CE9F9";  value="Skapa ny redovisning">
<br><br>
<label for="name">Namn på ny kund:</label>
<input type="text" name="name" id = "name2" value="<?php echo $customer;?>">
<span class="error">* <?php echo $nameErr;?></span><br><br><br>
<label for="inSaldo">Saldo vid årest början:</label>
<input type="number" id="inSaldo" step='any'name="inSaldo" value="<?php echo $inSaldo;?>">  
<span class="error">* <?php echo $saldoErr;?></span><br><br><br>

</form>


<?php



if (isset($show)) {
	if($show) {
		echo '<script type="text/javascript"> document.getElementById("hiddenform").style.display="block" </script>';
		echo '<script type="text/javascript"> document.getElementById("eller").style.display="block" </script>';

	} else {
		echo '<script type="text/javascript"> document.getElementById("hiddenform").style.display="none" </script>';	
		echo '<script type="text/javascript"> document.getElementById("eller").style.display="none" </script>';

	}		
} else {
		echo '<script type="text/javascript"> document.getElementById("hiddenform").style.display="block" </script>';
		echo '<script type="text/javascript"> document.getElementById("eller").style.display="block" </script>';

}

?>


</body> 
</html>

