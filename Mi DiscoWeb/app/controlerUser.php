<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------
include_once 'config.php';
include_once 'modeloUser.php';

/*
 * Inicio Muestra o procesa el formulario (POST)
 */
function ctlUserInicio()
{
    $msg = "";
    $user = "";
    $clave = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['user']) && isset($_POST['clave'])) {
            $user = $_POST['user'];
            $clave = $_POST['clave'];
            if (modeloOkUser($user, $clave)) {
                $_SESSION['user'] = $user;
                $_SESSION['tipouser'] = modeloObtenerTipo($user);
                if($user=="admin"){//si el usuario es administrador tendra acceso a la pagina
                if ($_SESSION['tipouser'] == "Máster") {
                    $_SESSION['modo'] = GESTIONUSUARIOS;
                    header('Location:index.php?orden=VerUsuarios');
                } 
                }
                else {
                    ($_SESSION['modo'] ="0");
                    // Usuario normal;
                    // PRIMERA VERSIÓN SOLO USUARIOS ADMISTRADORES
                    $msg = "Error: Acceso solo permitido a usuarios Administradores.";
                    // $_SESSION['modo'] = GESTIONFICHEROS;
                    // Cambio de modo y redireccion a verficheros
                }
            } else {
                $msg = "Error: usuario y contraseña no válidos.";
            }
        }
    }

    include_once 'plantilla/facceso.php';
}

// Cierra la sesión y vuelva los datos
function ctlUserCerrar()
{
    session_destroy();
    modeloUserSave();
    header('Location:index.php');
}

// Muestro la tabla con los usuario
function ctlUserVerUsuarios()
{
    // Obtengo los datos del modelo
    $usuarios = modeloUserGetAll();
    // Invoco la vista
    include_once 'plantilla/verusuariosp.php';
}

function ctlUserBorrar()
{
    $msg = "";
    $user = $_GET['id'];
    if (modeloUserDel($user)) {
        $msg = "El usuario se borró correctamente.";
    } else {
        $msg = "No se pudo borrar el usuario.";
    }
    modeloUserSave();
    ctlUserVerUsuarios();
}

function ctlUserAlta()
{
    if (! isset($_POST["iduser"])) {
        include_once 'plantilla/fnuevo.php';
    } else {
        $msg = "";
        // echo "Estas en ctlUserAlta";
        $id = $_POST["iduser"];
        $data = [
            $_POST["clave1"],
            $_POST["nombre"],
            $_POST["email"],
            $_POST["plan"],
            "B"
        ];
        echo $id;
        var_dump($data);
        // modeloUserAdd($id, $data);
        if (modeloUserAdd($id, $data)) {
            $msg = "El usuario fue creado con éxito";
        } else {
            $msg = "El usuario no fue creado";
        }
        modeloUserSave();
        ctlUserVerUsuarios();
    }
}

function ctlUserModificar()
{
    $msg = "";
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['clave1']) && isset($_POST['email']) && isset($_POST['estado']) && isset($_POST['nombre']) && isset($_POST['plan'])) {
            $id = $_POST['iduser'];
            $nombre = $_POST['nombre'];
            $clave = $_POST['clave1'];
            $mail = $_POST['email'];
            $plan = $_POST['plan'];
            $estado = $_POST['estado'];
            $modificado = [
                $clave,
                $nombre,
                $mail,
                $plan,
                $estado
            ];
            if (modeloUserUpdate($id, $modificado)) {
                $msg = "El usuario fue modificado con éxito";
            } else {
                $msg = "El usuario no pudo ser modificado";
            }
        }
    } else {
        $user = $_GET['id'];
        $datosusuario = $_SESSION["tusuarios"][$user];
        $clave = $datosusuario[0];
        $nombre = $datosusuario[1];
        $mail = $datosusuario[2];
        $plan = $datosusuario[3];
        $estado = $datosusuario[4];
        include_once 'plantilla/fmodificar.php';
    }
    modeloUserSave();
    ctlUserVerUsuarios();
}

function ctlUserDetalles()
{
    $user = $_GET['id'];
    $usuarios = modeloUserGet($user);
    include_once 'plantilla/fdetalles.php';
}


