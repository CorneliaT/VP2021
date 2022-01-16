<?php
function storeVehicle($registry){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpgrain (registry) VALUES(?)");
	echo $conn->error;
	$stmt -> bind_param("s", $registry);
	if($stmt->execute()){
		$notice = "Veok salvestati!";
	} else {
		$notice = "Veoki salvestamisel tekkis tõrge!" .$stmt->error;
	}
	$stmt -> close();
	$conn -> close();
	return $notice;
}

function retrieveVehicle(){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT registry FROM vpgrain");
	echo $conn->error;
	$stmt->bind_result($registryFromDb);
	if($stmt->fetch()){
	  $notice = $registryFromDb;
	}
	$stmt->close();
	$conn->close();
}