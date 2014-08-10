<?php 
	$text = "I would like to inform";

	$excerpt = implode(' ', array_slice(explode(' ', $text), 0, 10));
	echo $excerpt;
	echo '</br>';

	$dateToday = date("Y-m-d");
	echo $dateToday;



?>