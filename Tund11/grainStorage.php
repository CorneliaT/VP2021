<?php
  require("../../../config_vp2021.php");
  require("functions_main.php");
  require("functions_grain.php");
  $database = "if21_cornelia";
  
  
  //sessioonihaldus
  require("classes/session.class.php");
  SessionManager::sessionStart("vp", 0, "/~corne", "greeny.cs.tlu.ee");
  
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
  $registryNr = null;
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
  $stmt = $conn->prepare("SELECT registry FROM vpgrain");
  echo $conn->error;
  $stmt->bind_result($registryFromDb);
  if($stmt->fetch()){
	$notice = $registryFromDb;
  }
  $stmt->close();
  $conn->close();
  
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
  
  <label>Registrinumber: </label>
	  <?php
	    echo '<select name="registryNr">' ."\n";
		echo "\t \t" .'<option value="" selected disabled></option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo "\t \t" .'<option value="' .$i .'"';
			
			echo ">" .$registryFromDb[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?> 
  
</body>
</html>
