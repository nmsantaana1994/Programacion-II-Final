<?php
$id = $_GET["id"] ?? FALSE;
$repuesto = (new Repuestos())->producto_x_id($id);
$marcas = (new Marca())->catalogo_completo();
$categorias = (new Categoria())->catalogo_completo();
$fileData = $_FILES;
$postData = $_POST;
?>

<section class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Editar los datos de un Repuesto</h1>
        <div class="row mb-5 d-flex align-items-center">
        </div>

        <form class="row g-3" action="actions/edit_repuesto_acc.php?id=<?=$repuesto->getID()?>" method="POST" enctype="multipart/form-data">

            <div class="col-md-6 mb-3">
					<label for="categoria_id" class="form-label">Categoria</label>
					<select class="form-select" name="categoria_id" id="categoria_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($categorias as $C) { ?>
							<option value="<?= $C->getId() ?>" <?= $C->getId() == $repuesto->getCategoria_id() ? "selected" : "" ?>><?= $C->getCategoria() ?></option>
						<?PHP } ?>
					</select>
			</div>
        
            <div class="col-md-6 mb-3">
					<label for="marca_id" class="form-label">Marca</label>
					<select class="form-select" name="marca_id" id="marca_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($marcas as $M) { ?>
							<option value="<?= $M->getId() ?>" <?= $M->getId() == $repuesto->getMarca_id() ? "selected" : "" ?>><?= $M->getNombre() ?></option>
						<?PHP } ?>
					</select>
			</div>
            
            <div class="col-md-6 mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?=$repuesto->getModelo()?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?=$repuesto->getPrecio()?>" required>
            </div>

            <div class="col-md-12 mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea class="form-control" id="descripcion" name="descripcion" maxlength="500" required><?=$repuesto->getDescripcion()?></textarea>
            </div>

            <div class="col-md-6 mb-3">
			    <label for="imagen" class="form-label">Imágen actual</label>
			    <img src="../imagenes/productos/<?= $repuesto->getCategoria()?>/<?= $repuesto->getFoto()?>" alt="Imágen Illustrativa de <?= $repuesto->getMarca() ?> <?=$repuesto->getModelo()?>" class="img-fluid rounded shadow-sm d-block">
			    <input class="form-control" type="hidden" id="imagen_og" name="imagen_og" value="<?= $repuesto->getFoto()?>">
		    </div>

            <div class="col-md-6 mb-3">
                <label for="imagen" class="form-label">Reemplazar Logo</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>

            <button type="submit" class="btn bg-cian fuente">Editar</button>

        </form>
    </div>
</section>