<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Agregar una nueva Categoria</h1>
        <div class="row mb-5 d-flex align-items-center">
        </div>

        <form class="row g-3" action="actions/add_categoria_acc.php" method="POST" enctype="multipart/form-data">

            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Categoria</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <button type="submit" class="btn btn-primary">Cargar</button>

        </form>
    </div>