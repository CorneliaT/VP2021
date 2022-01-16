<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
  require("functions_news.php");
  $database = "if21_cornelia";

  //sessioonihaldus
  require("classes/session.class.php");
  SessionManager::sessionStart("vp", 0, "/~corne", "greeny.cs.tlu.ee");
  
  //kontrollime, kas on sisse logitud
  if(!isset($_SESSION["userId"])){
	  header("Location: page.php");
	  exit();
  }
  
  //logime välja
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
  }
  
  //cookie ehk küpsis
  //nimi, väärtus, aegumisaeg, path ehk kataloogid, domeen, kas https, kas üle http ehk üle veebi
  setcookie("vpusername", $_SESSION["userFirstname"] .$_SESSION["userLastname"], time() + (86400 * 31), "/~corne/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]), true);
  if(isset($_COOKIE["vpusername"])){
	  echo "Leiti küpsis: " .$_COOKIE["vpusername"];
  } else {
	  echo "Küpsist ei leitud!";
  }
  //count($_COOKIE) kui palju cookiesid salvestatud on
 
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
    
  $newsHTML = readNews(5);
  
  require("header.php");
	
  echo "<h1>" .$userName .", veebiprogrammeerimine</h1>";
  
  ?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <hr>
  <br>
  <p><?php echo $userName; ?> | Logi <a href="?logout=1">välja</a>!</p>
  <ul>
    <li><a href="userprofile.php">Kasutajaprofiil</a></li>
	<li><a href="messages.php">Sõnumid</a></li>
	<li><a href="picupload.php">Piltide üleslaadimine</a></li>
	<li><a href="gallery.php">Pildigalerii</a></li>
	<li><a href="news.php">Uudiste lisamine</a></li>
	<li><a href="grain.php">Viljalao haldus</a></li>
  </ul>
  <hr>
  <?php
	  echo $newsHTML;
	?>
</body>
</html>

