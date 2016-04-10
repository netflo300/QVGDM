<?php
session_start();
if(!isset($_SESSION['login_user'])) {
	Header("Location:login.php");
	die;
}
require_once ("class/db.class.php");
$db = new Db();

$db->query("SELECT login_user, activate_user FROM qvgdm_user WHERE login_user = '".$_SESSION['login_user']."' ;");
$o = $db->fetchNextObject();

if($o->activate_user == 0) {
	echo'<h2>En attente de validation du joueur</h2>';
	die;
} else {
	$db->query("SELECT id_question 	, text_question , second_question, answer_1 , answer_2, answer_3, answer_4, good_answer, check_activate, check_response  FROM qvgdm_question WHERE check_activate = '1' ORDER BY id_question DESC ;");
	$question = $db->fetchNextObject();
	
	$db->query("SELECT selected_answer FROM qvgdm_user_answer WHERE login_user = '".$_SESSION['login_user']."' AND id_question = '".$question->id_question."' ;");
	if ($db->get_num_rows()>0) {
		$reponse = $db->fetchNextObject();
	}
}
?>
<h3><?php echo $question->text_question ;?></h3>
<table>
		<tr>
			<td class="lettre<?php echo isset($reponse)&&$reponse->selected_answer == '1'?' fond_orange':''?>" id ="lettre_1" <?php if(isset($question)&&$question->check_freeze =='0') {?>onclick="selectionnerReponse('1','<?php echo $question->id_question?>');" <?php }?>>A</td>
			<td class="lettre<?php echo isset($reponse)&&$reponse->selected_answer == '2'?' fond_orange':''?>" id ="lettre_2" <?php if(isset($question)&&$question->check_freeze =='0') {?>onclick="selectionnerReponse('2','<?php echo $question->id_question?>');"<?php }?>>B</td>
		</tr>
		<tr>
			<td class="lettre<?php echo isset($reponse)&&$reponse->selected_answer == '3'?' fond_orange':''?>" id ="lettre_3" <?php if(isset($question)&&$question->check_freeze =='0') {?>onclick="selectionnerReponse('3','<?php echo $question->id_question?>');"<?php }?>>C</td>
			<td class="lettre<?php echo isset($reponse)&&$reponse->selected_answer == '4'?' fond_orange':''?>" id ="lettre_4" <?php if(isset($question)&&$question->check_freeze =='0') {?>onclick="selectionnerReponse('4','<?php echo $question->id_question?>');"<?php }?>>D</td>
		</tr>
	</table>