<?php

    require_once "../../functions/autoload.php";

    $postData = $_POST;
    $fileData = $_FILES["imagen"] ?? FALSE;
    $id = $_GET["id"] ?? FALSE;
    $categorias = (new Categoria())->get_x_id($postData["categoria_id"]);
    $nombreCategoria = $categorias->getCategoria();

    try {
        $repuesto = new Repuestos();
        $imagen = new Imagen();

        $imagenFinal = $postData["imagen_og"];

        if (!empty($fileData["tmp_name"])){

            if (!empty($fileData["tmp_name"])){
                $imagen->borrarImagen(__DIR__ . "/../../imagenes/productos/$nombreCategoria/" . $postData["imagen_og"]);
            }
            $imagenFinal = $imagen->subirImagen(__DIR__ . "/../../imagenes/productos/$nombreCategoria/", $fileData);
            $repuesto->reemplazar_imagen($imagenFinal, $id);
        }

        $repuesto->edit(
            $postData["categoria_id"],
            $postData["modelo"],
            $postData["marca_id"],
            $postData["descripcion"],
            $postData["precio"],
            $id,
            $imagenFinal
        );
        (new Alerta())->add_alerta('warning', "¡El repuesto se edito correctamente!");
        header("Location: ../index.php?sec=admin_repuestos" );
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_repuestos");
    }