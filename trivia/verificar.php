<?php
session_start();
include 'includes/db.php';

$respuesta_id = $_POST['respuesta'];
$pregunta_id = $_SESSION['pregunta_actual'];

$sql = "SELECT correcta, pregunta_id FROM respuestas WHERE id = $respuesta_id";
$res = $conn->query($sql)->fetch_assoc();

if ($res['correcta']) {
    $cat = $conn->query("SELECT categoria FROM preguntas WHERE id = {$res['pregunta_id']}")->fetch_assoc()['categoria'];
    $_SESSION['puntuacion'][$cat]++;
}

$_SESSION['contador']++;
header("Location: jugar.php");
exit;