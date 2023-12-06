<?php

    require_once "../../functions/autoload.php";

    $postData = $_POST;
    $fileData = $_FILES["imagen"] ?? FALSE;
    $id = $_GET["id"] ?? FALSE;

    // echo "<pre>";
    // print_r($postData);
    // echo "</pre>";

    try {
        $bicicleta = new Producto();

        $bicicleta->clear_marcas_sec($id);
        
        if (isset($postData["marcas_secundarias"])){
            foreach ($postData["marcas_secundarias"] as $marca_id) {
                $bicicleta->add_marcas_sec($id, $marca_id);
            }
        }


        $imagen = new Imagen();

        $imagenFinal = $postData["imagen_og"];

        if (!empty($fileData["tmp_name"])){

            if (!empty($fileData["tmp_name"])){
                $imagen->borrarImagen(__DIR__ . "/../../imagenes/productos/bicicletas/" . $postData["imagen_og"]);
            }
            $imagenFinal = $imagen->subirImagen(__DIR__ . "/../../imagenes/productos/bicicletas/", $fileData);
            $bicicleta->reemplazar_imagen($imagenFinal, $id);
        }

        $bicicleta->edit(
            $postData["marca_id"],
            $postData["modelo"],
            $postData["descripcion"],
            $postData["precio"],
            $id,
            $imagenFinal
        );
        (new Alerta())->add_alerta('warning', "¡La bicicleta se edito correctamente!");
        header("Location: ../index.php?sec=admin_bicicletas" );
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_bicicletas");
    }