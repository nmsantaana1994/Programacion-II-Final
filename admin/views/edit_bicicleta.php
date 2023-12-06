<?php
$id = $_GET["id"] ?? FALSE;
$bicicleta = (new Producto())->producto_x_id($id);
$marcas = (new Marca())->catalogo_completo();
$fileData = $_FILES;
$postData = $_POST;
?>

<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Editar los datos de una Bicicleta</h1>
        <div class="row mb-5 d-flex align-items-center">
        </div>

        <form class="row g-3" action="actions/edit_bicicleta_acc.php?id=<?=$bicicleta->getID()?>" method="POST" enctype="multipart/form-data">

            <div class="col-md-6 mb-3">
					<label for="marca_id" class="form-label">Marca</label>
					<select class="form-select" name="marca_id" id="marca_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($marcas as $M) { ?>
							<option value="<?= $M->getId() ?>" <?= $M->getId() == $bicicleta->getMarca()->getID() ? "selected" : "" ?>><?= $M->getNombre() ?></option>
						<?PHP } ?>
					</select>
			</div>
            
            <div class="col-md-6 mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?=$bicicleta->getModelo()?>" required>
            </div>

            <div class="col-md-12 mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea class="form-control" id="descripcion" name="descripcion" maxlength="500" required><?=$bicicleta->getDescripcion()?></textarea>
            </div>

            <div class="col-md-6 mb-3">
			    <label for="imagen" class="form-label">Imágen actual</label>
			    <img src="../imagenes/productos/bicicletas/<?= $bicicleta->getFoto()?>" alt="Imágen Illustrativa de <?= $bicicleta->getMarca()->getNombre() ?> <?=$bicicleta->getModelo()?>" class="img-fluid rounded shadow-sm d-block">
			    <input class="form-control" type="hidden" id="imagen_og" name="imagen_og" value="<?= $bicicleta->getFoto()?>">
		    </div>

            <div class="col-md-6 mb-3">
                <label for="imagen" class="form-label">Reemplazar Logo</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label d-block">Marcas Secundarias</label>
			    <?PHP
                    foreach ($marcas as $M) {
                        $ms_selected = $bicicleta->getMarcas_secundarias_ids();
                ?>		
                    
				<div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="<?= $M->getId() ?>" id="marcas_secundarias_<?= $M->getId() ?>" name="marcas_secundarias[]" <?= in_array($M->getId(), $ms_selected) ? "checked" : ""?> >
                    <label class="form-check-label mb-2" for="marcas_secundarias_<?= $M->getId() ?>">
                        <?= $M->getNombre() ?>
                    </label>
                </div>

                <?PHP } ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?=$bicicleta->getPrecio()?>" required>
            </div>

            <button type="submit" class="btn bg-cian fuente">Editar</button>

        </form>
    </div>
</div>