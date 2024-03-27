<!DOCTYPE HTML>  
<html>
<head>
<style>

.amountDiv {
  padding: 20px;
  border: 5px outset red;
  background-color: lightblue;
  text-align: center;
  font-size:20px;
}

.conceptDiv {
  padding: 50px;
  border: 5px outset red;
  background-color: lightblue;
  text-align: center;
  font-size:20px;
}

.removeDiv {
  padding: 20px;
  border: 5px outset red;
  background-color: lightsalmon;
  text-align: center;
  font-size:20px;
}

.viewDiv {
  padding: 20px;
  border: 5px outset red;
  background-color: lightgreen;
  text-align: center;
  font-size:20px;
}


</style>
</head>
<body>

<div class="amountDiv">
<h2> Kund:  <?=$customer?>   </h2>    
<b> Saldo:  <?=$saldo?>   </b>  
<br/>
<br/>
<b> Här kan du skapa en ny transaktion, ta bort senaste transaktion eller se sammanställning</b> 

</div>


<p>
<div class="conceptDiv">
<b> Välj månad och om det är insättning eller uttag och tryck på knappen  </b>  
<br/>
<br/>
<form action="conceptHandler.php">
  <label for="month">Välj månad:</label>
  <select id="month" name="month">
  <?php foreach ($months as $month ): ?>
    <option value= <?= $month; ?>  <?= ($month == $preMonth) ? ' selected' : ''; ?>      >   <?= $month   ?></option> 
  <?php endforeach ?>  
  </select>
<br/>
<br/>
  <label for="concept">Typ av transaktion:</label>
 
  <select id="concept" name="concept">
  <?php foreach ($concepts as $concept ): ?>
		 <option> <?= $concept   ?></option>
	<?php endforeach ?>    
  </select>
  <br/>
  <br/>
  <input type="submit" value="Skapa transaktion" style= "background-color: #6CE9F9";>
</form>
 </div> 
 </p>
 
 
 <p>
<div class="removeDiv">
<b>   KONTROLLERA ALLTID ATT SALDOT STÄMMER         </b> 
<br/>
<b>    Blev något fel och du vill ta bort senaste transaktionen?         </b> 
<form action="removeTransPrep.php">
  	<label>Gå vidare för att radera transaktion:</label>
  <input type="submit" value="Radera" style= "background-color: red";>
 </form>
</div>
 </p>
 
 
 <p>
<div class="viewDiv">
<b>     SAMMANSTÄLLNING         </b> 
<br/>

<form action="viewPrep.php">
  	<label>Gå vidare för att visa sammanställnin:</label>
  <input type="submit" value="Hämta" style= "background-color: 6CE9F9";>
 </form>
</div>
 </p>
  
 
</body>




