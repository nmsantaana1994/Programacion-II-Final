<?php
    require_once "../../functions/autoload.php";

    $postData = $_POST;
    $fileData = $_FILES["logo"] ?? FALSE;
    $id = $_GET["id"] ?? FALSE;

    try {
        $marca = new Marca();
        $imagenObjeto = new Imagen();

        $imagen = $postData["imagen_og"];

        if (!empty($fileData['tmp_name'])) {
 
            if(!empty($postData['imagen_og'])){ 
                $imagenObjeto->borrarImagen(__DIR__ . "/../../imagenes/logos_marcas/" . $postData['imagen_og']);
            }
            $imagen = $imagenObjeto->subirImagen(__DIR__ . "/../../imagenes/logos_marcas", $fileData);
            $marca->reemplazar_imagen($imagen, $id);
        }

        $marca->edit($postData["nombre"], $postData["ano"], $imagen, $id);
        (new Alerta())->add_alerta('warning', "¡La marca se edito correctamente!");
        header("Location: ../index.php?sec=admin_marcas" );
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_marcas");
    }


?>