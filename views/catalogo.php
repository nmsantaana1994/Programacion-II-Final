<?php
$id = $_GET["cat"] ?? FALSE;
$miObjetoProducto = new Repuestos();
$productos = $miObjetoProducto->catalogo_x_producto($id);

?>

<h1 class="text-center p-4">Catalogo completo de repuestos</h1>

<section class="row">

<?php if (count($productos)) { ?>
    <?php foreach($productos AS $producto) { ?>
        <div class="col-4">
            <div class="card mb-4">
                <img class="img_catalogo" src="imagenes/productos/<?= $producto->getCategoria(); ?>/<?= $producto->getFoto(); ?>" alt="Categoria <?= $producto->getCategoria(); ?>, <?= $producto->getMarca(); ?> <?= $producto->getModelo(); ?>" >

                <div class="card-body">
                    <h2 class="card-title"><?= $producto->getMarca(); ?> <?= $producto->getModelo(); ?></h2>
                    <p><?= $producto->recortar_palabras(); ?></p>
                    <a href="index.php?sec=producto&id=<?= $producto->getID(); ?>" class="btn w-100 fw-bold btn-brown">VER MÁS</a>
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