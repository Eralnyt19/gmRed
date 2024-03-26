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

</style>

<script>
function validateForm() {
  var x = document.forms["trans"]["amount1"].value;
  if (x == "" || x == null) {
    alert("Fältet kan inte lämnas tomt");
    return false;
  }
}
</script>

</head>
<body>

<div class="amountDiv">
<h2> Kund:  <?=$customer?>   </h2>
<b> Månad: <?=$month?>       </b>
</div>




<p>
<form action="transaction.php" id="trans" name="trans" onsubmit="return validateForm()" >
<div class="amountDiv">
  <label for="category">Välj kategori:</label>
  <select id="category" name="category">
  <?php foreach ($categories as $category ): ?>
		 <option> <?= $category   ?></option> 
	<?php endforeach ?>  
  </select>	


</div>
</p>

<p>
<div class="amountDiv">
	<label for="amount1">kronor:</label>
	<br/>
	<input type="number" id="amount1" name="amount1" size="30" min='1' value='0' form="trans">
	<br/>	
	<label for="amount2">ören (2 siffror)) :</label>
	<br/>
	<input type="number" id="amount2" name="amount2" size="30" min='0' value='0' form="trans">
</div>
</p>	
<p>
<div class="amountDiv">
  <input type="submit" value="Skicka in transaktion" style= "background-color: #6CE9F9";>
  </div>
</form>
</body>




