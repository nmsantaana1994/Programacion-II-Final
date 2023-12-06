<?PHP
    $id = $_GET["id"] ?? FALSE;
    $categoria = (new Categoria())->get_x_id($id);
?>

<div class="row my-5 g-3">
<h1 class="text-center mb-5 fw-bold">¿Está seguro que desea eliminar esta categoría?</h1>
	<div class="col-12 col-md-6">
        <h2 class="fs-6">Nombre</h2>
        <p><?= $categoria->getCategoria() ?></p>

        <a href="actions/delete_categoria_acc.php?id=<?= $categoria->getID() ?>" role="button" class="d-block btn btn-sm btn-brown mt-4">Eliminar</a>
	</div>
</div>