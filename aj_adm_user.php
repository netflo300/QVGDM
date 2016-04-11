<?php
session_start();

require_once ("class/db.class.php");
$db = new Db();

if(isset($_POST['login'])) {
	$db->query("UPDATE qvgdm_user SET activate_user = (activate_user + 1)%2 WHERE login_user = '".$_POST['login']."' ;");
}

if(isset($_POST['actu'])) {
	$db->query("UPDATE qvgdm_user u SET point_user = (SELECT sum(point) FROM qvgdm_user_answer a JOIN qvgdm_question q ON a.id_question = q.id_question WHERE u.login_user = a.login_user)");
}
?>
<table>
	<caption>Joueurs</caption>
	<thead>
	<tr>
		<th>login</th><th>point</th><th>activation</th>
	</tr>
	</thead>
	<tbody>
<?php 
$db->query("SELECT login_user, point_user, activate_user FROM qvgdm_user");
if ($db->get_num_rows()>0) {
	foreach ($db->fetch_array() as $k => $v) {
		echo'<tr><td>'.$v['login_user'].'</td><td>'.$v['point_user'].'</td><td><input type="checkbox" '.($v['activate_user']=='1'?'checked="checked"':'').' onchange="activate_user(\''.$v['login_user'].'\');" /></td></tr>';
	}
}
?>
</tbody>
</table>
<input type="button" value="Actualiser" onclick="ajax('aj_adm_user.php', 'actu=1', 'game_user');" />
