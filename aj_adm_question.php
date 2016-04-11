<?php
session_start();

require_once ("class/db.class.php");
$db = new Db();

if(isset($_POST['login'])) {
	$db->query("UPDATE qvgdm_user SET activate_user = (activate_user + 1)%2 WHERE login_user = '".$_POST['login']."' ;");
}

if(isset($_POST['activate_question'])) {
	$db->query("UPDATE qvgdm_question SET  	check_activate = ( 	check_activate + 1)%2 WHERE id_question = '".$_POST['activate_question']."' ;");
}

if(isset($_POST['freeze_question'])) {
	$db->query("UPDATE qvgdm_question SET check_freeze = (check_freeze + 1)%2 WHERE id_question = '".$_POST['freeze_question']."' ;");
}

if(isset($_POST['response_question'])) {
	$db->query("UPDATE qvgdm_question SET check_response = (check_response + 1)%2 WHERE id_question = '".$_POST['response_question']."' ;");
	
	$db->query("UPDATE qvgdm_user u SET point_user = (SELECT sum(point) FROM qvgdm_user_answer a JOIN qvgdm_question q ON a.id_question = q.id_question WHERE u.login_user = a.login_user)");
}
?>
<table>
	<caption>Questions</caption>
	<thead>
	<tr>
		<th>id</th><th>question</th><th>points</th><th>A</th><th>F</th><th>R</th><th>count</th>
	</tr>
	</thead>
	<tbody>
<?php 
$db->query("SELECT q.id_question, q.text_question, q.point, q.check_activate, q.check_response, q.check_freeze, count(a.login_user) as count FROM qvgdm_question q left join qvgdm_user_answer a on a.id_question = q.id_question GROUP BY q.id_question, q.text_question, q.point, q.check_activate, q.check_response, q.check_freeze");
if ($db->get_num_rows()>0) {
	foreach ($db->fetch_array() as $k => $v) {
		echo'<tr><td>'.$v['id_question'].'</td><td>'.stripslashes($v['text_question']).'</td><td>'.$v['point'].'</td><td><input type="checkbox" '.($v['check_activate']=='1'?'checked="checked"':'').' onchange="activate_question(\''.$v['id_question'].'\');" /></td><td><input type="checkbox" '.($v['check_freeze']=='1'?'checked="checked"':'').' onchange="freeze_question(\''.$v['id_question'].'\');" /></td><td><input type="checkbox" '.($v['check_response']=='1'?'checked="checked"':'').' onchange="response_question(\''.$v['id_question'].'\');" /></td><td>'.$v['count'].'</td></tr>';
	}
}
?>
</tbody>
</table>
<input type="button" value="Actualiser" onclick="ajax('aj_adm_question.php', '', 'game_question');" />