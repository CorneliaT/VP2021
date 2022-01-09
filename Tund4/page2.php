<?php
	$userName = "Cornelia";
	

	
	$today_html = null; 
	$today_adjective_error = null;
	$todays_adjective = null;
	if(isset($_POST["submit_todays_adjective"])){
		if(!empty($_POST["todays_adjective_input"])){
			$today_html = "<p>Tänane päev on " .$_POST["todays_adjective_input"] .".</p>";
			$todays_adjective = $_POST["todays_adjective_input"];
		} else {
			$today_adjective_error = "Palun kirjutage tänase kohta omadussõna!";
		}
	}
	
	$photo_dir = "pildid/";
	$all_files = array_slice(scandir($photo_dir), 2);

	$allowed_photo_types = ["image/jpeg", "image/png"];
	$all_photos = [];
	foreach($all_files as $file){
		$file_info = getimagesize($photo_dir .$file);
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($all_photos, $file);
			}
		}
	}
	
	$file_count = count($all_photos);
	$photo_num = mt_rand(0, $file_count - 1);
    
    if(isset($_POST["photo_select_submit"])){
		$photo_num = $_POST["photo_select"];
	}
    
	$photo_html = '<img src="' .$photo_dir .$all_photos[$photo_num] .'" alt="Tallinna Ülikool">';
	$photo_file_html = "\n <p>".$all_photos[$photo_num] ."</p> \n";
    
    $photo_list_html = "\n <ul> \n";

	
	for($i = 0; $i < $file_count; $i ++){
		$photo_list_html .= "<li>" .$all_photos[$i] ."</li> \n";
	}
	$photo_list_html .= "</ul> \n";

	
	$photo_select_html = '<select name="photo_select">' ."\n";
	for($i = 0; $i < $file_count; $i ++){
		$photo_select_html .= '<option value="' .$i .'"';
        if($i == $photo_num){
			$photo_select_html .= " selected";
		}
        $photo_select_html .= '>' .$all_photos[$i] ."</option> \n";
	}
	$photo_select_html .= "</select> \n";
	
?>

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $userName; ?>, veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $userName; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<p>Õppetöö toimus 2021 sügisel.</p>
	<hr>
	
	<form method="POST">
		<input type="text" name="todays_adjective_input" placeholder="tänase päeva ilma omadus" value="<?php echo $todays_adjective; ?>">
		<input type="submit" name="submit_todays_adjective" value="Saada ära">
		<span><?php echo $today_adjective_error; ?></span>
	</form>
	<?php echo $today_html; ?>
	<hr>
	
	<form method="POST">
		<?php echo $photo_select_html; ?>
        <input type="submit" name="photo_select_submit" value="Näita valitud fotot">
	</form>
	
	<?php
		echo $photo_html;
        echo $photo_file_html;
		echo "<hr> \n";
		echo $photo_list_html;
	?>
</body>
</html>