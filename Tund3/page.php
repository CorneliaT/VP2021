<?php
  $userName = "Cornelia Tšaplõgin";
  $weekdayNamesET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  $weekdayNow = date("N");
  $dateNow = date("d");
  $monthNow = date("m");
  $yearNow = date("Y");
  $timeNow = date("H:i:s");
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
 
  if($hourNow >= 8 and $hourNow < 18){
		$partOfDay = "Kooliaeg!";
	}
	if($hourNow >= 18 and $hourNow < 23){
		$partOfDay = "Vaba aeg!";
	}
	if($hourNow > 23){
		$partOfDay = "Uneaeg!";
	}

	require("header.php");

    if($weekdayNow <= 5){
		$partOfWeek = "Koolipäev!";
    } else {
        $partOfWeek = "Vaba päev!";
	}

?>


<body>
  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <?php
    echo $semesterInfoHTML;
  ?>
  
  <hr>
  <p>Lehe avamise hetkel oli aeg: 
  <?php
    //echo $fullTimeNow;
	echo $weekdayNamesET[$weekdayNow - 1] .", " .$dateNow .". " .$monthNamesET[$monthNow - 1] ." " .$yearNow ." kell " .$timeNow;
  ?>
  .</p>
  <?php
    echo "<p>Lehe avamise hetkel oli " .$partOfDay ."</p>";
    echo "<p>Ning see on " .$partOfWeek ."</p>";

  ?>
  <hr>
</body>
</html>
