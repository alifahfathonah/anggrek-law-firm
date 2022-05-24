<?php 
session_start();
unset($_SESSION['bahasa']);

$_SESSION['lang'] = $_POST['lang'];

$data = [
    'message' => 'ok',
    'isi'   => $_SESSION['lang'],
];

echo json_encode($data);

?>