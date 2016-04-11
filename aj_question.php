<?php
session_start();
if(!isset($_SESSION['login_user'])) {
	Header("Location:login.php");
	die;
}
require_once ("class/db.class.php");
$db = new Db();

$db->query("SELECT login_user, activate_user, point_user FROM qvgdm_user WHERE login_user = '".$_SESSION['login_user']."' ;");
$o = $db->fetchNextObject();

if($o->activate_user == 0) {
	echo'<h2>En attente de validation du joueur</h2>';
	die;
} else {
	$db->query("SELECT id_question , text_question , second_question, answer_1 , answer_2, answer_3, answer_4, good_answer, check_activate, check_response, check_freeze  FROM qvgdm_question WHERE check_activate = '1' ORDER BY id_question DESC ;");
	$question = $db->fetchNextObject();
	if (isset($question)) {
		$db->query("SELECT selected_answer FROM qvgdm_user_answer WHERE login_user = '".$_SESSION['login_user']."' AND id_question = '".$question->id_question."' ;");
		if ($db->get_num_rows()>0) {
			$reponse = $db->fetchNextObject();
		}
	}
}
?>
<h2>Points  : <?php echo $o->point_user ;?></h2>
<h3><?php echo isset($question)?'Question ' . $question->id_question . ' : ' . stripslashes($question->text_question):'' ;?></h3>
<table>
		<tr>
			<td class="lettre<?php if (isset($question) && $question->check_response == '1') { echo ($question->good_answer=='1'?' fond_vert':''); } echo isset($reponse)&&$reponse->selected_answer == '1'?' fond_orange':''; ?>" id ="lettre_1" <?php if(isset($question)&&$question->check_freeze =='0') {?>onclick="selectionnerReponse('1','<?php echo $question->id_question?>');"<?php }?>><?php echo isset($question)?stripslashes($question->answer_1):'';?></td>
			<td class="lettre<?php if (isset($question) && $question->check_response == '1') { echo ($question->good_answer=='2'?' fond_vert':''); } echo isset($reponse)&&$reponse->selected_answer == '2'?' fond_orange':''; ?>" id ="lettre_2" <?php if(isset($question)&&$question->check_freeze =='0') {?>onclick="selectionnerReponse('2','<?php echo $question->id_question?>');"<?php }?>><?php echo isset($question)?stripslashes($question->answer_2):'';?></td>
		</tr>
		<tr>
			<td class="lettre<?php if (isset($question) && $question->check_response == '1') { echo ($question->good_answer=='3'?' fond_vert':''); } echo isset($reponse)&&$reponse->selected_answer == '3'?' fond_orange':''; ?>" id ="lettre_3" <?php if(isset($question)&&$question->check_freeze =='0') {?>onclick="selectionnerReponse('3','<?php echo $question->id_question?>');"<?php }?>><?php echo isset($question)?stripslashes($question->answer_3):'';?></td>
			<td class="lettre<?php if (isset($question) && $question->check_response == '1') { echo ($question->good_answer=='4'?' fond_vert':''); } echo isset($reponse)&&$reponse->selected_answer == '4'?' fond_orange':''; ?>" id ="lettre_4" <?php if(isset($question)&&$question->check_freeze =='0') {?>onclick="selectionnerReponse('4','<?php echo $question->id_question?>');"<?php }?>><?php echo isset($question)?stripslashes($question->answer_4):'';?></td>
		</tr>
	</table>