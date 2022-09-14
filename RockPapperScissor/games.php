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
	<!-- -------------Dynamic Image Loading With Choose Option---------------------------- -->
	<div class="container">
			<h3 class="ccs">Please Choose Card in Sequence<br/>Result Display after all player select card</h3>
			<div class="player-1-box" id="box">
				<h4>Player1</h4>
				<input type="submit" id="pl-1-choose" class="btn btn-primary" value="choose">
				<img class="pl-1-image">
			</div>
			<div class="player-2-box" id="box">
				<h4>Player2</h4>
				<input type="submit" id="pl-2-choose" class="btn btn-primary" value="choose">
				<img class="pl-2-image">
			</div>
			<div class="player-3-box" id="box">
				<h4>Player3</h4>
				<input type="submit" id="pl-3-choose" class="btn btn-primary" value="choose">
				<img class="pl-3-image">
			</div>
			<div class="player-4-box" id="box">
				<h4>Player4</h4>
				<input type="submit" id="pl-4-choose" class="btn btn-primary" value="choose">
				<img class="pl-4-image">
			</div>
	</div>
	<!-- ---------------- Next Button for next round ---------------------- -->
	<form action="<?php $_PHP_SELF ?>" method="POST">
		<input type="hidden" name="iteration" value="1" id="inc">
		<input type="submit" value="Next" id="next-btn" class="btn-primary nxt-btn">	
	</form>
	<!-- ---------------- Result Button for result ---------------------- -->
		<button class="btn-primary result" id="result-id">Result</button>

	<!-- ---------------- Getting Dynamic Image ---------------------- -->
<?php
$json = file_get_contents("https://rockpaperscissor0.herokuapp.com/display.php");
$player_card = json_decode($json,true);

?>
	<!-- ---------------- script for display ---------------------- -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#pl-1-choose').on("click",function(){
			$('.pl-1-image').attr('src','https://rockpaperscissor0.herokuapp.com/<?php echo "{$player_card['1']}" ?>');
			$('.pl-1-image').css('display','block');
			$('.plycard1').html('<?php echo rtrim("{$player_card['1']}",'.png');?>');
		$('#pl-2-choose').on("click",function(){
			$('.pl-2-image').attr('src','https://rockpaperscissor0.herokuapp.com/<?php echo "{$player_card['2']}"?>');
			$('.pl-2-image').css('display','block');
			$('.plycard2').html('<?php echo rtrim("{$player_card['2']}",'.png');?>');
		$('#pl-3-choose').on("click",function(){
			$('.pl-3-image').attr('src','https://rockpaperscissor0.herokuapp.com/<?php echo "{$player_card['3']}"?>');
			$('.pl-3-image').css('display','block');
			$('.plycard3').html('<?php echo rtrim("{$player_card['3']}",'.png');?>');
		$('#pl-4-choose').on("click",function(){
			$('.pl-4-image').attr('src','https://rockpaperscissor0.herokuapp.com/<?php echo "{$player_card['4']}"?>');
			$('.pl-4-image').css('display','block');
			$('.plycard4').html('<?php echo rtrim("{$player_card['4']}",'.png') ;?>');
				$('#result-id').on("click",function(){
					$('.result-table').css('display','table');
				});
		});
			});
		});
			});
	});
</script>
	<!-- ---------------- Setting for Round ---------------------- -->
<?php
	$a = $_COOKIE['iteration'];
	$a+=1;
	if($a<=49){
	setcookie("iteration",$a);
	}
	if($a===50){
		echo '<script>alert("50 iteration is over.Game is restarting.")</script>';
		$a+=1;
	}
	if($a>50){
	$a = 0;
	setcookie("iteration",$a);
	$src='https://rockpaperscissor0.herokuapp.com/games.json';
	$dest='https://rockpaperscissor0.herokuapp.com/game.json';
	copy($src, $dest);

	$srcf = 'https://rockpaperscissor0.herokuapp.com/names.json';
	$destf = 'https://rockpaperscissor0.herokuapp.com/name.json';
	copy($srcf, $destf);
	}
	/*------------------- Getting data for game --------------------------*/
$json_data = file_get_contents("https://rockpaperscissor0.herokuapp.com/game.json");
$res = json_decode($json_data,true);
	$se = $res;
	$b = $a-1;
	if($b === -1){
		$b=0;
	}
	/*------------- function calling for each participant -------------------*/
	$tr1 = winner(rtrim($player_card[1],'.png'),rtrim($player_card[2],'.png'));
	if($tr1 === 1){$res[$b]['pl12_wins']++;}
	else if($tr1 === 0){$res[$b]['pl12_wins']+=0;$res[$b]['pl21_wins']+=0;}
	else if($tr1 === 2){$res[$b]['pl21_wins']++;}
	
	$tr2 = winner(rtrim($player_card[1],'.png'),rtrim($player_card[3],'.png'));
	if($tr2 === 1){$res[$b]['pl13_wins']++;}
	else if($tr2 === 0){$res[$b]['pl13_wins']+=0;$res[$b]['pl31_wins']+=0;}
	else if($tr2 === 2){$res[$b]['pl31_wins']++;}
	
	$tr3 = winner(rtrim($player_card[1],'.png'),rtrim($player_card[4],'.png'));
	if($tr3 === 1){$res[$b]['pl14_wins']++;}
	else if($tr3 === 0){$res[$b]['pl14_wins']+=0;$res[$b]['pl41_wins']+=0;}
	else if($tr3 === 2){$res[$b]['pl41_wins']++;}
	
	$tr5 = winner(rtrim($player_card[2],'.png'),rtrim($player_card[3],'.png'));
	if($tr5 === 1){$res[$b]['pl23_wins']++;}
	else if($tr5 === 0){$res[$b]['pl23_wins']+=0;$res[$b]['pl32_wins']+=0;}
	else if($tr5 === 2){$res[$b]['pl32_wins']++;}
	
	$tr6 = winner(rtrim($player_card[2],'.png'),rtrim($player_card[4],'.png'));
	if($tr6 === 1){$res[$b]['pl24_wins']++;}
	else if($tr6 === 0){$res[$b]['pl24_wins']+=0;$res[$b]['pl42_wins']+=0;}
	else if($tr6 === 2){$res[$b]['pl42_wins']++;}
	
	$tr9 = winner(rtrim($player_card[3],'.png'),rtrim($player_card[4],'.png'));
	if($tr9 === 1){$res[$b]['pl34_wins']++;}
	else if($tr9 === 0){$res[$b]['pl34_wins']+=0;$res[$b]['pl43_wins']+=0;}
	else if($tr9 === 2){$res[$b]['pl43_wins']++;}
	
	$se[$a] = $res[$b];
	/*------------------ function for choosing winner --------------------*/
	function winner($o,$p){
		if($o === 'rock' && $p === 'paper' || $o === 'paper' && $p === 'rock'){
			if($o === 'paper'){
				return 1;
			}
			else if($p === 'paper'){
				return 2;
			}
		}
		if($o === 'rock' && $p === 'scissor' || $o === 'scissor' && $p === 'rock'){
			if($o === 'rock'){
				return 1;
			}
			else if($p === 'rock'){
				return 2;
			}
		}
		if($o === 'scissor' && $p === 'paper' || $o === 'paper' && $p === 'scissor'){
			if($o === 'scissor'){
				return 1;
			}
			else if($p === 'scissor'){
				return 2;
			}
		}
		else if($o === $p){
			return 0;
		}
	}
	/*------------------- sending data for game --------------------------*/
	$json_data = json_encode($se,JSON_PRETTY_PRINT);
	file_put_contents("game.json",$json_data);

	/*------------------- Getting data for card --------------------------*/
	$name_data = file_get_contents("https://rockpaperscissor0.herokuapp.com/name.json");
	$names = json_decode($name_data,true);

	$pl1 = rtrim($player_card['1'],'.png');
	$pl2 = rtrim($player_card['2'],'.png');
	$pl3 = rtrim($player_card['3'],'.png');
	$pl4 = rtrim($player_card['4'],'.png');

	$names[$a]['pl1_chs']=$pl1;
	$names[$a]['pl2_chs']=$pl2;
	$names[$a]['pl3_chs']=$pl3;
	$names[$a]['pl4_chs']=$pl4;

	/*------------------- sending data for card --------------------------*/
	$name_data = json_encode($names,JSON_PRETTY_PRINT);
	file_put_contents("name.json",$name_data);	

?>
	<!-- ---------------- Displaying current card ------------------------ -->
<div class="container">
		<div class="row">
			<h3 class="cc">Current-Choices</h3>
			<table border="1" class="info">
				<tr>
					<th>Player1</th>
					<th>Player2</th>
					<th>Player3</th>
					<th>Player4</th>
				</tr>
				<tr>
					<td class='plycard1'></td>
					<td class="plycard2"></td>
					<td class="plycard3"></td>
					<td class="plycard4"></td>
				</tr>
			</table>
		</div>
	</div>

	<?php 
	if(isset($_COOKIE['iteration'])){
		for ($i=$a; $i >=0; $i--){
			?>
	<!-- ---------------- Displaying card Table ------------------------ -->
		<div class="container result-table">
				<div class="row">
				<table border="1" class="info">
					<h2 class="cc"><?php echo $i+1 ?> Iteration Table</h2>
				<tr>
					<th>Player1</th>
					<th>Player2</th>
					<th>Player3</th>
					<th>Player4</th>
				</tr>
				<tr>
					<td><?php echo $names[$i]['pl1_chs']?></td>
					<td><?php echo $names[$i]['pl2_chs']?></td>
					<td><?php echo $names[$i]['pl3_chs']?></td>
					<td><?php echo $names[$i]['pl4_chs']?></td>
				</tr>
			</table> 
			</div>
	<!-- ---------------- Displaying Winner Table ------------------------ -->
			<div class="row">
				<h4 class="ccs">Result Table</h4>
				<table border="1" class="result-table">
				<tr>
					<th colspan="2" class="pclr">Total</th>
					<th colspan="4" class="pclr">Against</th>
				</tr>
				<tr class="pclr">
					<td></td>
					<td></td>
					<th>Player1</th>
					<th>Player2</th>
					<th>Player3</th>
					<th>Player4</th>
				</tr>
				<tr>
					<th rowspan="4" class="clr">Player Wins</th>
					<th class="clr">Player1</th>
					<td>-</td>
					<td><?php echo $se[$i]['pl12_wins']?></td>
					<td><?php echo $se[$i]["pl13_wins"]?></td>
					<td><?php echo $se[$i]["pl14_wins"]?></td>
				</tr>
				<tr>

					<th class="clr">Player2</th>
					<td><?php echo $se[$i]["pl21_wins"]?></td>
					<td>-</td>
					<td><?php echo $se[$i]["pl23_wins"]?></td>
					<td><?php echo $se[$i]["pl24_wins"]?></td>
				</tr>
				<tr>
					<th class="clr">Player3</th>
					<td><?php echo $se[$i]["pl31_wins"]?></td>
					<td><?php echo $se[$i]["pl32_wins"]?></td>
					<td>-</td>
					<td><?php echo $se[$i]["pl34_wins"]?></td>
				</tr>
				<tr>
					<th class="clr">Player4</th>
					<td><?php echo $se[$i]["pl41_wins"]?></td>
					<td><?php echo $se[$i]["pl42_wins"]?></td>
					<td><?php echo $se[$i]["pl43_wins"]?></td>
					<td>-</td>
				</tr>
			</table>
		</div>
	</div>
	<?php		
		}
	}
	?>

</body>
</html>
<!-- -------- Developed By Ankit ----------- -->