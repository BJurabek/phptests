<?php
include_once 'config/core.php';
include_once 'config/database.php';

function load_model($class_name){
	$path_to_file = 'objects/' . $class_name . '.php';
	if (file_exists($path_to_file)) {require $path_to_file;	}
}

spl_autoload_register('load_model');

$database = new Database();
$db = $database->getConnection();

	$user = new User($db);
	$text = new Ttext($db);

$page_title = "Тестовое задание";
include_once "layout_header.php";

if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['auth'])){
	$user->login($_POST['login'],$_POST['password']);
}

if(isset($_POST['logout'])){ $user->logout(); }
if(isset($_POST['register'])){ $user->register($_REQUEST); }
if(isset($_POST['sent'])){ $text->sent($_REQUEST); }
if(isset($_POST['update'])){ $text->update($_REQUEST); }
if(isset($_POST['filtr'])){ $text->filtr($_POST['filtr']); }

$stmt = $text->readAll($from_record_num, $records_per_page);

$page_url = "index.php?";

$total_rows = $text->countAll();

include_once "read_template.php";
include_once "layout_footer.php";
?>