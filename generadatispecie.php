<?php
session_start();
$speciedati=$_SESSION['specie'];
header('Content-Type: application/json');
echo json_encode($speciedati);
?>