<div class=" d-flex justify-content-center p-5">
    <div>
        <h1 class="text-center mb-5 fw-bold">Probando cosas</h1>
        <div class="row mb-5 d-flex align-items-center">
            <div class="col">
                <?PHP

                    $miVariable = Producto::$creacionValores;

                    echo "<pre>";
                    print_r($miVariable);
                    echo "</pre>";

                ?>
            </div>
        </div>
    </div>
</div>