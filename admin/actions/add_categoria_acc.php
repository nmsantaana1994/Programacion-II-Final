<?php
    require_once "../../functions/autoload.php";

    $postData = $_POST;
    $fileData = $_FILES;

    try {
        (new Categoria())->insert(
            $postData["nombre"]
        );
        (new Alerta())->add_alerta("success", "¡La categoría se cargo correctamente!");
        header("Location: ../index.php?sec=admin_categorias" );
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_categorias");
    }
?>