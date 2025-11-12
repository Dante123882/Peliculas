<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $input = json_decode(file_get_contents('php://input'), true);
    $descriptionPOST = $input['description'] ?? '';

    if (empty($descriptionPOST)) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "status" => 400,
            "message" => "La descripcion es requirida"

        ]);
        exit;
    }

    $url = "http://localhost:5254/api/Clasificacion/RegistrarClasificacion",
    $data = ["ClasificacionDesc" => $descriptionPOST];
    $jsonData = json_encode($data);

    $token = $_COOKIE['token'] ?? null;
    if (!$token) {
        http_response_code(401);
        echo json_encode([
            "success" => false,
            "status" => 401,
            "message" => "No se proporciono token de autenticacion"
        ]);
        exit;
    }

    $ch = curl_init($url);
    curl_setopt_array($ch,[
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            "Authorization: Bearer $token"
        ],
        CURLOPT_POSTFIELDS => $jsonData
    ]);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)){
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "error" => curl_error($ch)
        ]);
        curl_close($ch);
        exit;
    }

    
    curl_close($ch);

    $json = json_decode($response, true);
    if ($json === null && json_last_error() !== JSON_ERROR_NONE){
        http_response_code(502);
        echo json_encode([
            "success" => false,
            "status" => 502,
            "message" => "Respuesta invalida del servidor remoto"

        ]);
        exit;

    }

     http_response_code($httpcode);
        echo json_encode([
            "success" => true,
            "status" => $httpcode,
            "json" => $json
        ]);
    }else {
        http_response_code(405);
        echo json_encode([
            "success" => false,
            "status" => 405,
            "message" => "Metodo no permitido. Usa POST"
        ]);
    


}
?>