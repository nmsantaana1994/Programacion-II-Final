<?php
$id = $_GET["cat"] ?? FALSE;
$miObjetoProducto = new Producto();
$productos = $miObjetoProducto->catalogo_completo($id);

?>

<h1 class="text-center p-4">Catalogo completo de bicicletas</h1>

<section class="row">

<?php if (count($productos)) { ?>
    <?php foreach($productos AS $producto) { ?>
        <div class="col-4">
            <div class="card mb-4">
                <img class="img_catalogo" src="imagenes/productos/bicicletas/<?= $producto->getFoto(); ?>" alt="Categoria bicicletas, <?= $producto->getMarca()->getNombre(); ?> <?= $producto->getModelo(); ?>" >

                <div class="card-body">
                    <h2 class="card-title"><?= $producto->getMarca()->getNombre(); ?> <?= $producto->getModelo(); ?></h2>
                    <p><?= $producto->recortar_palabras(); ?></p>
                    <div class="card-body">
                        <h3 class="mb-3">Marcas relacionadas:</h3>
                        <?php foreach($producto->getMarcas_secundarias() as $value) { ?>
                            <img class="m-1 marcaslogos" src="imagenes/logos_marcas/<?= $value->getLogo(); ?>" alt="Logo de la marca">
                        <?php } ?>
                    </div>
                    <a href="index.php?sec=producto_bicis&id=<?= $producto->getID(); ?>" class="btn w-100 fw-bold btn-brown">VER MÁS</a>
                </div>
            </div>
        </div>


    <?php } ?>


<?php }else{ ?>
    <div class="col">
        <h2 class="text-center">No se encontraron productos.</h2>
    </div>
<?php } ?>

</section>