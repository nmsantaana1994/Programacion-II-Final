<?php
    require_once "../../functions/autoload.php";

    $id = $_GET["id"] ?? FALSE;
    $bicicleta = (new Producto())->producto_x_id($id);

    try {

        $bicicleta->clear_marcas_sec($id);

        if (!empty($bicicleta->getFoto())) {
            (new Imagen())->borrarImagen(__DIR__ . "/../../imagenes/productos/bicicletas/" . $bicicleta->getFoto());
        }
        $bicicleta->delete();
        (new Alerta())->add_alerta("danger", "¡La bicicleta se elimino correctamente!");
        header("Location: ../index.php?sec=admin_bicicletas" );
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_bicicletas");
    }