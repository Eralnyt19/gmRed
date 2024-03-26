<html>
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
  text-align: left;
  font-size:20px;
}
</style>
</head>

<body>

 
 <p>
<div class="removeDiv">
<b>  Kund: <?=$customer?>  </b><br/>
<b>  Månad: <?=$month?>  </b><br/>
<b>   <?=$concept?>:  <?=$category?>  </b><br/>
<b>  Belopp: <?=$amount?> </b>

<form action="removeTransHandler.php">
  	<label >Tryck på den röda knappen för att radera denna transaktion:</label>
  <input type="submit" value="Radera" style= "background-color: red";>
  <br/>
  <label >Eller om du inte vill ta bort transaktionen: Backa i webbläsaren</label>
 </form>
</div>
 </p>
 
</body>




</body>
</html>