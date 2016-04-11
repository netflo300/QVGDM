<?php
session_start();
require_once ("class/db.class.php");
$db = new Db();


if (false) {
	$db->query("SELECT u.login_user, sum(q.point) FROM qvgdm_user u
join qvgdm_user_answer a on u.login_user = a.login_user
join qvgdm_question q on a.id_question = q.id_question
WHERE a.selected_answer = q.good_answer
group by u.login_user ;");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<title>Admin</title>
<script type="text/javascript" src="script/ajax.js"></script>
<script type="text/javascript">

function activate_user(login) {
	ajax('aj_adm_user.php', 'login='+login, 'game_user');
}


function activate_question(activate_question) {
	ajax('aj_adm_question.php', 'activate_question='+activate_question, 'game_question');
}

function freeze_question(freeze_question) {
	ajax('aj_adm_question.php', 'freeze_question='+freeze_question, 'game_question');
}

function response_question(response_question) {
	ajax('aj_adm_question.php', 'response_question='+response_question, 'game_question');
}


</script>
</head>
<body>
<div id="null"></div>
<div id="game_user">
	
</div>
<div id="game_question">
	
</div>
<span id="count"> </span>
<script type="text/javascript">ajax('aj_adm_user.php', '', 'game_user');</script>
<script type="text/javascript">ajax('aj_adm_question.php', '', 'game_question');</script>
</body>
</html>



