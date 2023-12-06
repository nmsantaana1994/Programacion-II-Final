<?php
$id = $_GET["id"] ?? FALSE;
$categoria = (new Categoria())->get_x_id($id);
?>



<section class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Editar los datos de una Categoría</h1>
        <div class="row mb-5 d-flex align-items-center">
        </div>

        <form class="row g-3" action="actions/edit_categoria_acc.php?id=<?=$categoria->getID()?>" method="POST" enctype="multipart/form-data">

            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$categoria->getCategoria()?>" required>
            </div>

            <button type="submit" class="btn bg-cian fuente">Editar</button>

        </form>
    </div>
</section>