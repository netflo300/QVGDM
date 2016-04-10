<?php
session_start();

require_once ("class/db.class.php");

if(!isset($_SESSION['login_user'])) {
	Header("Location:login.php");
	die;
}


$db = new Db();
$db->query("REPLACE INTO qvgdm_user_answer (login_user, id_question, selected_answer, time) VALUES ('".$_SESSION['login_user']."', '".$_POST['question']."', '".$_POST['lettre']."', NOW());  ");

