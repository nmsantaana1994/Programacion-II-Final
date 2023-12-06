<?php
    require_once "../../functions/autoload.php";

    $postData = $_POST;
    $fileData = $_FILES["logo"];

    try {
        $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../imagenes/logos_marcas", $fileData);
    
        (new Marca())->insert(
            $postData["nombre"],
            $postData["ano"],
            $imagen
        );
        (new Alerta())->add_alerta("success", "¡La marca se cargo correctamente!");
        header("Location: ../index.php?sec=admin_marcas" );

    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_marcas");
    }
?>