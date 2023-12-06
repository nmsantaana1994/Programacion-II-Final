<?PHP
    $id = $_GET["id"] ?? FALSE;
    $marca = (new Marca())->get_x_id($id);
?>

<section class="row my-5 g-3">
    <h1 class="text-center mb-5 fw-bold">¿Está seguro que desea eliminar esta marca?</h1>
	<div class="col-12 col-md-6">
	    <img src="../imagenes/logos_marcas/<?= $marca->getLogo()?>" alt="Imágen Illustrativa de <?= $marca->getNombre() ?>" class="img-fluid rounded shadow-sm d-block">	
	</div>
	<div class="col-12 col-md-6">
        <h2 class="fs-6">Nombre</h2>
        <p><?= $marca->getNombre() ?></p>

        <h2 class="fs-6">Año</h2>
        <p><?= $marca->getAno() ?></p>

        <a href="actions/delete_marca_acc.php?id=<?= $marca->getID() ?>" role="button" class="d-block btn btn-sm btn-brown mt-4">Eliminar</a>
	</div>
</section>