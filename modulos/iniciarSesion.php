<?php
session_start();
include_once '../global.php';
if($_POST["nick"] == "" && $_POST["password"] == ""){
    die("Error");
}
try {
    // Realizamos la conexión
    $conn = new PDO("mysql:host=$BOX_BD_server;dbname=$BOX_BD_name", $BOX_BD_user, $BOX_BD_pass);
    // Añadimos errores
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Consultamos si existe ese usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nick='" . $_POST["nick"] . "' AND password='" . $_POST["password"] . "';");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    // Si existe...
    if ($row->nick == $_POST['nick'] && $row->password == $_POST['password']) {
        $_SESSION['nick'] = $row->nick; // Lo guardamos en la sesión
        echo "1"; // Usuario validado
        return 1;
    } else {
        echo "2"; // Usuario no válido
        return 2;
    }
    $conn->close();
} catch(PDOException $e){
    echo "0";
    //echo "Conexión fallida: " . $e->getMessage();
    return 0;
}
?>
