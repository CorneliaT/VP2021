<?php
  require("../../../config_vp2021.php");
  require("functions_main.php");
  require("functions_news.php");
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
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  $error = "";
  $newsTitle = "";
  $news = "";
  $expiredate = date("Y-m-d");
  
  require("header.php");
  
  if(isset($_POST["newsBtn"])){
	$news = test_input($_POST["newsEditor"]);
	$newsTitle = test_input($_POST["newsTitle"]);
	if(!empty($news) and !empty($newsTitle)){
		$error = storeNews($newsTitle, $news, $expiredate);
	} else {
		$error = "Pealkiri ja sisu on kohustuslikud!";
	}
  }


    echo "<h1>" .$userName ." koolitöö leht</h1>";
?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>

  //Javascript osa:
   <!-- Lisame tekstiredaktory TinyMCE -->
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

  <script>tinymce.init({selector:"textarea#newsEditor", plugins: "link", menubar: "edit",});</script>




  <h2>Lisa uudis</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Uudise pealkiri:</label><br><input type="text" name="newsTitle" id="newsTitle" style="width: 100%;" value="<?php echo $newsTitle; ?>"><br>
		<label>Uudise sisu:</label><br>
		<textarea name="newsEditor" id="newsEditor"><?php echo $news; ?></textarea>
		<br>
		<label>Uudis nähtav kuni (kaasaarvatud)</label>
		<input type="date" name="expiredate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $expiredate; ?>">
		
		<input name="newsBtn" id="newsBtn" type="submit" value="Salvesta uudis!"> <span>&nbsp;</span><span><?php echo $error; ?></span>
	</form>
	
  //Kui lasete uudise läbi test_input funktsiooni, siis html "<" ja ">" muudetakse koodideks. Uudise näitamisel siis tuleb need tagasi muuta ja selleks on vaja andmetabelist loetud uudis lasta läbi php funktsiooni htmlspecialchars_decode()
