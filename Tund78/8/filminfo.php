<?php
  require("../../../config_vp2021.php");
  require("fnc_film.php");
  $userName = "Cornelia";
  $database = "if21_cornelia";
  
  $filmInfoHTML = readAllFilms();
?>


<body>

  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <h2>Eesti filmid</h2>
  <p>Praegu on andmebaasis järgmised filmid:</p>
  <?php
	//echo "Server: " .$serverHost .", kasutaja: " .$serverUsername;
	echo $filmInfoHTML;
  ?>
</body>
</html>
