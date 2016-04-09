<?php
session_start();

if(!isset($_SESSION['login_user'])) {
	Header("Location:login.php");
	die;
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>Insert title here</title>
<script type="text/javascript" src="script/ajax.js"></script>
<script type="text/javascript">
	function selectionnerReponse(lettre) {
		listeOfLetter = document.getElementsByClassName("lettre");
		listeOfLetter[0].style.backgroundColor = 'white';
		listeOfLetter[1].style.backgroundColor = 'white';
		listeOfLetter[2].style.backgroundColor = 'white';
		listeOfLetter[3].style.backgroundColor = 'white';
		document.getElementById('lettre_'+lettre).style.backgroundColor = 'orange';
		envoyerReponse(lettre);
	}

	function envoyerReponse(lettre) {
		ajax('reponse.php', 'lettre='+lettre, '');
	}

	 
	
	function refreshGame() {
		//document.getElementById('count').innerHTML=count++;
		//ajax('reponse.php', '', 'game');
		//actualisation = setTimeout("refreshGame();", 1000);
	}
	
	
	
</script>
</head>
<body>
<h1>Partie : <?php echo $_SESSION['login_user']; ?></h1>
<div id="game">
	<table>
		<tr>
			<td class="lettre" id ="lettre_A" onclick="selectionnerReponse('A');">A</td>
			<td class="lettre" id ="lettre_B" onclick="selectionnerReponse('B');">B</td>
		</tr>
		<tr>
			<td class="lettre" id ="lettre_C" onclick="selectionnerReponse('C');">C</td>
			<td class="lettre" id ="lettre_D" onclick="selectionnerReponse('D');">D</td>
		</tr>
	</table>
</div>
<span id="count"> </span>
<script type="text/javascript">refreshGame();</script>
</body>
</html>