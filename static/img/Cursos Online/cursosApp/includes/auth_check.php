<?php
// --- INICIO: FORZAR NO-CACHE ---
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
// --- FIN: FORZAR NO-CACHE ---

session_start(); // Inicia la sesión

// Si la variable de sesión 'id_usuario' no existe, lo echamos
if (!isset($_SESSION['usuario_id'])) { 
    header("Location: ../index.php");
    exit(); 
}
?>