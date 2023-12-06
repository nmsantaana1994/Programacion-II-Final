<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Agregar una nueva Marca</h1>
        <div class="row mb-5 d-flex align-items-center">
        </div>

        <form class="row g-3" action="actions/add_marca_acc.php" method="POST" enctype="multipart/form-data">

            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="ano" class="form-label">Año</label>
                <input type="number" class="form-control" id="ano" name="ano" required>
                <div class="form-text">Ingresar el año con 4 dígitos.</div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo" required>
            </div>

            <button type="submit" class="btn btn-primary">Cargar</button>

        </form>
    </div>
</div>