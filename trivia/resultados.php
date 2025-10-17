<?php
session_start();
?>

<h2>¡Resultados finales!</h2>
<ul>
<?php foreach ($_SESSION['puntuacion'] as $categoria => $puntaje): ?>
    <li><?php echo $categoria; ?>: <?php echo $puntaje; ?>/10</li>
<?php endforeach; ?>
</ul>

<a href="index.php">Volver a jugar</a>