<?php
    require_once "../../functions/autoload.php";

    $postData = $_POST;
    $fileData = $_FILES["imagen"];

    echo "<pre>";
    print_r($postData);
    echo "</pre>";

    try {
        $bicicleta = new Producto();

        

        $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../imagenes/productos/bicicletas", $fileData);

        $idBicicleta = $bicicleta->insert(
            $postData["modelo"],
            $postData["marca_id"],
            $postData["descripcion"],
            $postData["precio"],
            $imagen
        );

        if (isset($postData["marcas_secundarias"])){
            foreach ($postData["marcas_secundarias"] as $marca_id) {
                $bicicleta->add_marcas_sec($idBicicleta, $marca_id);
            }
        };

        (new Alerta())->add_alerta("success", "¡La bicicleta se cargo correctamente!");
        header("Location: ../index.php?sec=admin_bicicletas" );
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_bicicletas");
    }
?>