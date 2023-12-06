<?php
    require_once "../../functions/autoload.php";

    $postData = $_POST;
    $fileData = $_FILES["imagen"];
    $categorias = (new Categoria())->get_x_id($postData["categoria_id"]);
    $nombreCategoria = $categorias->getCategoria();

    try {
        $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../imagenes/productos/$nombreCategoria", $fileData);
        (new Repuestos())->insert(
            $postData["categoria_id"],
            $postData["modelo"],
            $postData["marca_id"],
            $postData["descripcion"],
            $postData["precio"],
            $imagen
        );
        (new Alerta())->add_alerta('success', "¡El repuesto se cargo correctamente!");
        header("Location: ../index.php?sec=admin_repuestos");
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_repuestos");
    }
?>