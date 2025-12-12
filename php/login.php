<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        
    $input = json_decode(file_get_contents('php://input'), true);
    $userPOST = $input['userlog'] ?? '';
    $passPOST = $input['passlog'] ?? '';


    if (empty($userPOST) || empty($passPOST)) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "status" => 400,
            "message" => "Usuario y contraseña son requeridos"
        ]);
        exit;
    }

    $url = "http://localhost:5254/api/Auth/Token";
    $data = ["usuario" => $userPOST,"contrasena" => $passPOST];
    $jsonData = json_encode($data);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => $jsonData
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    

    
    if (curl_errno($ch)) {
   http_response_code(500);
   echo json_encode(["success" => false,"error" => curl_error($ch)]);
   curl_close($ch);
   exit;
}

    curl_close($ch);

    $json = json_decode($response, true);
    if ($json === null && json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(502);
        echo json_encode([
            "success" => false,
            "status" => 502,
            "message" => "Respuesta invalida del servidor remoto"
        ]);
        exit;
        
    }

    if ($httpCode == 200 && isset($json['token'])){
        $token = $json['token'];
        $tokenParts = explode('.', $token);

        $payload = [];
        if (count($tokenParts) === 3){
            $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+','/'], $tokenParts[1])), true);
        }

        $expTime = isset($payload['exp']) ? ($payload['exp'] - time()) : 7200;
        if ($expTime <= 0) $expTime =7200;

        setcookie("token", $token, time() + $expTime, "/", "", false, true);

        $_SEESSION['usuario'] = strtolower($payload['sub'] ?? 'sin_usuario');
        $_SEESSION['fullname'] = $payload['fullname'] ?? 'sin_nombre';
        $_SEESSION['role'] = strtolower($payload['role'] ?? 'sin_rol');
        
        http_response_code(200);
        echo json_encode([
            "success" => true,
            "status" => 200,
            "fullname" => $payload['fullname'] ?? null,
            "json" => $json
        ]);
        exit;
    }

    http_response_code($httpCode);
        echo json_encode([
            "success" => false,
            "status" => $httpCode,
            "json" => $json
        ]);


}else{

    http_response_code(405);
    echo json_encode([
        "success" => false,
        "status" => 405,
        "message" => "Metodo no permitido. Usa POST"
         
    ]);

    


}
?>