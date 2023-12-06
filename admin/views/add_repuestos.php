<?PHP

$marcas = (new Marca())->catalogo_completo();
$categorias = (new Categoria())->catalogo_completo();

?>

<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Agregar un nuevo Repuesto</h1>
        <div class="row mb-5 d-flex align-items-center">
        </div>

        <form class="row g-3" action="actions/add_repuesto_acc.php" method="POST" enctype="multipart/form-data">

            <div class="col-md-6 mb-3">
					<label for="categoria_id" class="form-label">Categoria</label>
					<select class="form-select" name="categoria_id" id="categoria_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($categorias as $C) { ?>
							<option value="<?= $C->getId() ?>"><?= $C->getCategoria() ?></option>
						<?PHP } ?>
					</select>
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
            
            <div class="col-md-6 mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>

            <div class="col-md-12 mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea class="form-control" id="descripcion" name="descripcion" maxlength="500" required></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label for="imagen" class="form-label">Foto</label>
                <input class="form-control" type="file" id="imagen" name="imagen">
            </div>

            <div class="col-md-6 mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" required>
            </div>

            <button type="submit" class="btn btn-primary">Agregar</button>

        </form>
    </div>
</div>