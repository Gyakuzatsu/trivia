<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión
$conexion = new mysqli("localhost:3307", "root", "", "trivia");

if ($conexion->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conexion->connect_error]));
}

// Categorías esperadas
$categorias = ["Matemáticas", "Español", "Ciencias Naturales", "Sociales", "Inglés"];
$preguntas_finales = [];

foreach ($categorias as $categoria) {
    $stmt = $conexion->prepare("
        SELECT p.id, p.texto, p.categoria, r.texto AS respuesta_texto, r.correcta
        FROM preguntas p
        JOIN respuestas r ON p.id = r.pregunta_id
        WHERE p.categoria = ?
        ORDER BY RAND()
    ");
    $stmt->bind_param("s", $categoria);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $preguntas_categoria = [];

    while ($fila = $resultado->fetch_assoc()) {
        $id = $fila["id"];
        if (!isset($preguntas_categoria[$id])) {
            $preguntas_categoria[$id] = [
                "id" => $id,
                "texto" => $fila["texto"],
                "categoria" => $fila["categoria"],
                "respuestas" => []
            ];
        }

        $preguntas_categoria[$id]["respuestas"][] = [
            "texto" => $fila["respuesta_texto"],
            "correcta" => $fila["correcta"] == 1
        ];
    }

    $preguntas_finales = array_merge(
        $preguntas_finales,
        array_slice(array_values($preguntas_categoria), 0, 10)
    );
}

echo json_encode($preguntas_finales, JSON_UNESCAPED_UNICODE);
