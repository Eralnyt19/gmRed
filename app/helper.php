<?php

declare(strict_types=1);

// function formatDollarAmount(string $amount): string {
	
function formatDollarAmount(float $amount): string {

/*
		$isNegative = $amount < 0;
		
		return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
		*/
	return number_format($amount, 2);

}

function formatDate(string $date): string {
	
//	return date('M j, Y', strtotime($date));
	return $date;
}	
	
	
// print some error messages
	
function alreadyExist()  {
		
		echo "<div style=\"color: red; background-color: black; font-size:300%; border: thick solid #FF0000; \"";
		echo '<strong>';
		echo 'Kan ej skapa ny kund';
		echo '<br />';
		echo 'Finnas redan kund med samma namn';
		echo '</strong>';
		echo "</div>";
}

function notKnown()  {
		
		echo "<div style=\"color: red; background-color: black; font-size:300%; border: thick solid #FF0000; \"";
		echo '<strong>';
		echo 'Ej känd kund';
		echo '<br />';
		echo 'Försök igen eller skapa ny kund';
		echo '</strong>';
		echo "</div>";
}

				



?>