<?php
    require_once "../../functions/autoload.php";

    $id = $_GET["id"] ?? FALSE;
    $marca = (new Marca())->get_x_id($id);

    try {
        if (!empty($marca->getLogo())) {
            (new Imagen())->borrarImagen(__DIR__ . "/../../imagenes/logos_marcas/" . $marca->getLogo());
        }
        $marca->delete();
        (new Alerta())->add_alerta("danger", "¡La marca se elimino correctamente!");
        header("Location: ../index.php?sec=admin_marcas" );
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_marcas");
    }