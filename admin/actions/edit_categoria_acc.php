<?php
    require_once "../../functions/autoload.php";

    $postData = $_POST;
    $id = $_GET["id"] ?? FALSE;

    print_r($postData);

    try {
        (new Categoria())->edit($postData["nombre"], $id);
        (new Alerta())->add_alerta('warning', "¡La categoría se edito correctamente!");
        header("Location: ../index.php?sec=admin_categorias" );
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_categorias");
    }


?>