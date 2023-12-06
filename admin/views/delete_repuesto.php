<?PHP
    $id = $_GET["id"] ?? FALSE;
    $repuesto = (new Repuestos())->producto_x_id($id);
    $categorias = (new Categoria())->get_x_id($repuesto->getCategoria_id());
    $nombreCategoria = $categorias->getCategoria();
?>

<section class="row my-5 g-3">
    <h1 class="text-center mb-5 fw-bold">¿Está seguro que desea eliminar esta repuesto?</h1>
	<div class="col-12 col-md-6">
	    <img src="../imagenes/productos/<?=$nombreCategoria?>/<?= $repuesto->getFoto()?>" alt="Imágen Illustrativa de <?= $repuesto->getMarca() ?> <?= $repuesto->getModelo() ?>" class="img-fluid rounded shadow-sm d-block">	
	</div>
	<div class="col-12 col-md-6">
        <h2 class="fs-6">Categoría</h2>
        <p><?= $repuesto->getCategoria() ?></p>

        <h2 class="fs-6">Marca</h2>
        <p><?= $repuesto->getMarca() ?></p>

        <h2 class="fs-6">Modelo</h2>
        <p><?= $repuesto->getModelo() ?></p>

        <h2 class="fs-6">Descripción</h2>
        <p><?= $repuesto->getDescripcion() ?></p>

        <h2 class="fs-6">Precio</h2>
        <p><?= $repuesto->getPrecio() ?></p>

        <a href="actions/delete_repuesto_acc.php?id=<?= $repuesto->getID() ?>" role="button" class="d-block btn btn-sm btn-brown mt-4">Eliminar</a>
	</div>
</section>