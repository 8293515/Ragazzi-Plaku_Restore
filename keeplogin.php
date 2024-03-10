<?php
session_start();

$sessionInfo = array(
    'isLoggedIn' => isset($_SESSION['loggedin']) && $_SESSION['loggedin'],
    'img' => $_SESSION['image'],
    'imginfo' => $_SESSION['imageinfo'],
    'isAdmin' => $_SESSION['isAdmin']
);

header('Content-Type: application/json');
echo json_encode($sessionInfo);
?>