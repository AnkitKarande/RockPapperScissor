<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- ---------------- Display Play or Close Block ------------------------ -->
	<div id="modal">
	    <div id="modal-form">
	      <h2>Rock | Paper | Scissor</h2>
	        <input type="button" id="ply-btn" value="Play" class="btn-primary">
	      	<div id="close-btn">X</div>
	    </div>
	</div>
	<!-- ---------------- Script for play or close ------------------------ -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#ply-btn").on("click",function(){
				<?php setcookie("iteration","-1");?>
				var x = window.open("https://rockpaperscissor0.herokuapp.com/games.php","_self");
			});
		$("#close-btn").on("click",function(){	
				var win = window.open("about:blank","_self");
				win.close();
			});
		});
</script>

<?php
	$src='https://rockpaperscissor0.herokuapp.com/games.json';
	$dest='https://rockpaperscissor0.herokuapp.com/game.json';
	copy($src, $dest);

	$srcf = 'https://rockpaperscissor0.herokuapp.com/names.json';
	$destf = 'https://rockpaperscissor0.herokuapp.com/name.json';
	copy($srcf, $destf);
?>
</body>
</html>
<!-- Developed By Ankit -->