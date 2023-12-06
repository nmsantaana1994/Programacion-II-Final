<?php
    require_once "../../functions/autoload.php";

    $id = $_GET["id"] ?? FALSE;
    $repuesto = (new Repuestos())->producto_x_id($id);
    $categorias = (new Categoria())->get_x_id($repuesto->getCategoria_id());
    $nombreCategoria = $categorias->getCategoria();

    try {
        if (!empty($repuesto->getFoto())) {
            (new Imagen())->borrarImagen(__DIR__ . "/../../imagenes/productos/$nombreCategoria/" . $repuesto->getFoto());
        }
        $repuesto->delete();
        (new Alerta())->add_alerta("danger", "¡El repuesto se elimino correctamente!");
        header("Location: ../index.php?sec=admin_repuestos" );
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_repuestos");
    }