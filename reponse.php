<?php
session_start();

require_once ("class/db.class.php");

if(!isset($_SESSION['login_user'])) {
	Header("Location:login.php");
	die;
}


$db = new Db();

