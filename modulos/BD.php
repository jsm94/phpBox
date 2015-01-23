<?php
// Conectar con la base de datos
function conectar($server, $user, $pass, $name){
    try {
        $conn = new PDO("mysql:host=$server;dbname=$name", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexión realizada";
    } catch(PDOException $e){
        echo "Conexión fallida: " . $e->getMessage();
    }
}
?>
