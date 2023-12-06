<?PHP

$marcas = (new Marca())->catalogo_completo();

?>

<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Agregar una nueva Bicicleta</h1>
        <div class="row mb-5 d-flex align-items-center">
        </div>

        <form class="row g-3" action="actions/add_bicicleta_acc.php" method="POST" enctype="multipart/form-data">

            <div class="col-md-6 mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>
            
            <div class="col-md-6 mb-3">
					<label for="marca_id" class="form-label">Marca</label>
					<select class="form-select" name="marca_id" id="marca_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($marcas as $M) { ?>
							<option value="<?= $M->getId() ?>"><?= $M->getNombre() ?></option>
						<?PHP } ?>
					</select>
			</div>

            <div class="col-md-12 mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea class="form-control" id="descripcion" name="descripcion" maxlength="500" required></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label d-block">Marcas Secundarias</label>
			    <?PHP
                    foreach ($marcas as $M) {
                ?>		
                    
				<div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="<?= $M->getId() ?>" id="marcas_secundarias_<?= $M->getId() ?>" name="marcas_secundarias[]">
                    <label class="form-check-label mb-2" for="marcas_secundarias_<?= $M->getId() ?>">
                        <?= $M->getNombre() ?>
                    </label>
                </div>

                <?PHP } ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" required>
            </div>           

            <div class="col-md-6 mb-3">
                <label for="imagen" class="form-label">Foto</label>
                <input class="form-control" type="file" id="imagen" name="imagen">
            </div>

            <button type="submit" class="btn btn-primary">Cargar</button>

        </form>
    </div>