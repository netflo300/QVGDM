<?php
session_start();

if(!isset($_SESSION['login_user'])) {
	Header("Location:login.php");
	die;
}

require_once ("class/db.class.php");

$db = new Db();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>Insert title here</title>
<script type="text/javascript" src="script/ajax.js"></script>
<script type="text/javascript">
	function selectionnerReponse(lettre, question) {
		listeOfLetter = document.getElementsByClassName("lettre");
		listeOfLetter[0].style.backgroundColor = 'white';
		listeOfLetter[1].style.backgroundColor = 'white';
		listeOfLetter[2].style.backgroundColor = 'white';
		listeOfLetter[3].style.backgroundColor = 'white';
		document.getElementById('lettre_'+lettre).style.backgroundColor = 'orange';
		envoyerReponse(lettre, question);
	}

	function envoyerReponse(lettre, question) {
		ajax('reponse.php', 'lettre='+lettre+'&question='+question, 'null');
	}

	 
	
	function refreshGame() {
		//document.getElementById('count').innerHTML=count++;
		ajax('aj_question.php', '', 'game');
		
		setTimeout("refreshGame();", 3000);
	}
	
	
	
</script>
</head>
<body>
<div id="null"></div>
<h1>Joueur : <?php echo $_SESSION['login_user']; ?></h1>
<div id="game">
	
</div>
<span id="count"> </span>
<script type="text/javascript">refreshGame();</script>
</body>
</html>