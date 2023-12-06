<?php
$id = $_GET["id"] ?? FALSE;
$marca = (new Marca())->get_x_id($id);
$fileData = $_FILES;
$postData = $_POST;
?>

<section class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Editar los datos de una Marca</h1>
        <div class="row mb-5 d-flex align-items-center">
        </div>

        <form class="row g-3" action="actions/edit_marca_acc.php?id=<?=$marca->getID()?>" method="POST" enctype="multipart/form-data">

            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$marca->getNombre()?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="ano" class="form-label">Año</label>
                <input type="number" class="form-control" id="ano" name="ano" value="<?=$marca->getAno()?>"required>
                <div class="form-text">Ingresar el año con 4 dígitos.</div>
            </div>

            <div class="col-md-2 mb-3">
			    <label for="imagen" class="form-label">Logo actual</label>
			    <img src="../imagenes/logos_marcas/<?= $marca->getLogo()?>" alt="Imágen Illustrativa de <?= $marca->getNombre() ?>" class="img-fluid rounded shadow-sm d-block">
			    <input class="form-control" type="hidden" id="imagen_og" name="imagen_og" value="<?= $marca->getLogo()?>">
		    </div>

            <div class="col-md-6 mb-3">
                <label for="logo" class="form-label">Reemplazar Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>

            <button type="submit" class="btn bg-cian fuente">Editar</button>

        </form>
    </div>
</section>