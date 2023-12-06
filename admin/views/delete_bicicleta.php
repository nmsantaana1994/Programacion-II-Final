<?PHP
    $id = $_GET["id"] ?? FALSE;
    $bicicleta = (new Producto())->producto_x_id($id);
    $marcas = (new Marca())->catalogo_completo();
?>

<div class="row my-5 g-3">
<h1 class="text-center mb-5 fw-bold">¿Está seguro que desea eliminar esta bicicleta?</h1>
	<div class="col-12 col-md-6">
	    <img src="../imagenes/productos/bicicletas/<?= $bicicleta->getFoto()?>" alt="Imágen Illustrativa de <?= $bicicleta->getMarca()->getNombre() ?> <?= $bicicleta->getModelo() ?>" class="img-fluid rounded shadow-sm d-block">	
	</div>
	<div class="col-12 col-md-6">
        <h2 class="fs-6">Marca</h2>
        <p><?= $bicicleta->getMarca()->getNombre() ?></p>

        <h2 class="fs-6">Modelo</h2>
        <p><?= $bicicleta->getModelo() ?></p>

        <h2 class="fs-6">Descripción</h2>
        <p><?= $bicicleta->getDescripcion() ?></p>

        <div class="col-md-12 mb-3">
            <h2 class="form-label d-block fs-6">Marcas Secundarias</h2>
            <?PHP
                foreach ($marcas as $M) {
                    $ms_selected = $bicicleta->getMarcas_secundarias_ids();
            ?>		
                
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="<?= $M->getId() ?>" id="marcas_secundarias_<?= $M->getId() ?>" name="marcas_secundarias[]" <?= in_array($M->getId(), $ms_selected) ? "checked" : ""?> disabled>
                <label class="form-check-label mb-2" for="marcas_secundarias_<?= $M->getId() ?>">
                    <?= $M->getNombre() ?>
                </label>
            </div>

            <?PHP } ?>
        </div>

        <h2 class="fs-6">Precio</h2>
        <p><?= $bicicleta->getPrecio() ?></p>

        <a href="actions/delete_bicicleta_acc.php?id=<?= $bicicleta->getID() ?>" role="button" class="d-block btn btn-sm btn-brown mt-4">Eliminar</a>
	</div>
</div>