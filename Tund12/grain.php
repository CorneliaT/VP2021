<?php
  require("../../../config_vp2021.php");
  require("functions_main.php");
  require("functions_grain.php");
  $database = "if21_cornelia";
  
  
  //sessioonihaldus
  require("classes/session.class.php");
  SessionManager::sessionStart("vp", 0, "/~corne", "localhost");
  
  //kui pole sisseloginud
  if(!isset($_SESSION["userId"])){
	  //siis jõuga sisselogimise lehele
	  header("Location: page.php");
	  exit();
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
  }
  
  $notice = null;
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  if(isset($_POST["submitVehicle"])){
	$registry = test_input($_POST["registry"]);
	if(!empty($registry)){
		$notice = storeVehicle($registry);
	} else {
		$notice = "Palun täida lahter!";
	}
  }
 
  require("header.php");
?>


  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | <p>Tagasi <a href="home.php">avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Veoki registrinumbri salvestamine (6 märki)</label><br>
	  <textarea rows="1" cols="50" name="registry" placeholder="Kirjuta siia veoki registrinumber ..."></textarea>
	  <br>
	  <input name="submitVehicle" type="submit" value="Salvesta veoki andmed"><span><?php echo $notice; ?></span>
	</form>
	<li><a href="grainStorage.php">Viljaveo leht</a></li>
	<hr>
  
</body>
</html>
