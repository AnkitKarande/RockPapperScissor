<?php
	/*------------- for Random choosing Image ----------------------*/
$images= array(null,'rock.png','paper.png','scissor.png');
	$plyimg1 = $images[rand(1,3)];

	$plyimg2 = $images[rand(1,3)];

	$plyimg3 = $images[rand(1,3)];

	$plyimg4 = $images[rand(1,3)];

	$final = array("1"=>$plyimg1,"2"=>$plyimg2,"3"=>$plyimg3,"4"=>$plyimg4);
	echo json_encode($final);
	
?>
<!-- ---------- Developed By Ankit ---------- -->