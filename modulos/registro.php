<?php
//ini_set('display_errors', 'On');
session_start();
include_once '../global.php';
if($_POST["nick"] == "" && $_POST["password"] == "" && $_POST["email"] == ""){
    die("Error");
}
try {
    // Realizamos la conexión
    $conn = new PDO("mysql:host=$BOX_BD_server;dbname=$BOX_BD_name", $BOX_BD_user, $BOX_BD_pass);
    // Añadimos errores
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Consultamos si existe ese usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nick='" . $_POST["nick"] . "';");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    // Si existe...
    if ($row->nick == $_POST['nick']) {
        echo "2"; // Ya existe el usuario
        return 2;
    } else {
        // Insertamos el usuario en la base de datos
        $stmt2 = $conn->prepare("INSERT INTO usuarios (nick,password,email) VALUES ('" . $_POST['nick'] . "','" . $_POST['password'] . "','" . $_POST['email'] . "')");
        $stmt2->execute();
        // Creamos los directorios para el usuario
        $dirUsuario = $BOX_RAIZ . $BOX_prefixUser . $_POST['nick'];
        mkdir($dirUsuario . '/.tmp', 0755, true);
        mkdir($dirUsuario . '/.informes', 0755, true);
        mkdir($dirUsuario . '/.backups', 0755, true);
        $_SESSION['nick'] = $row->nick; // Lo guardamos en la sesión
        echo "1"; // Usuario registrado
        return 1;
    }
    $conn->close();
} catch(PDOException $e){
    echo "0";
    //echo "Conexión fallida: " . $e->getMessage();
    return 0;
}
?>
