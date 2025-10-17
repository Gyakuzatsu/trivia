<?php
session_start();
$_SESSION['puntuacion'] = [
    'Matemáticas' => 0,
    'Ciencias Naturales' => 0,
    'Sociales' => 0,
    'Español' => 0,
    'Inglés' => 0
];
$_SESSION['contador'] = 0;

header('Location: jugar.php');
exit;