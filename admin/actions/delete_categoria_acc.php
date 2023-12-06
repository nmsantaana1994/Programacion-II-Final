<?php
    require_once "../../functions/autoload.php";

    $id = $_GET["id"] ?? FALSE;
    $categoria = (new Categoria())->get_x_id($id);

    try {
        $categoria->delete();
        (new Alerta())->add_alerta("danger", "¡La categoria se elimino correctamente!");
        header("Location: ../index.php?sec=admin_categorias" );
    } catch (\Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrio un error inesperado, por favor pongase en contacto con el administrador del sistema.");
        header("Location: ../index.php?sec=admin_categorias");
    }