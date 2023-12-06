<?php
$id = $_GET["id"] ?? FALSE;
$miObjetoProducto = new Producto();
$producto = $miObjetoProducto->producto_x_id($id);
?>

<section class="row" id="producto">

<?php if (isset($producto)) { ?>
    
    <div class="col">
        <div class="card mt-5 mb-5 p-3">
            <div class="row align-items-center">
                <div class="col-md">
                    <img class="ancho" src="imagenes/productos/bicicletas/<?= $producto->getFoto() ?>" alt="<?= $producto->getMarca()->getNombre(); ?> <?= $producto->getModelo() ?>" style="width: 100%;">
                </div>
                <div class="col-md align-items-center">
                    <div class="card-body border-bottom">
                        <h1 class="mb-3"><?= $producto->getMarca()->getNombre(); ?> <?= $producto->getModelo() ?></h1>
                        <p class="card-text"><?= $producto->getDescripcion() ?></p>
                    </div>
                    <div class="card-body border-top border-bottom">
                        <h2 class="mb-3">Marca Principal:</h2>
                        <img class="m-3 marcaslogos" src="imagenes/logos_marcas/<?= $producto->getLogo_Marca(); ?>" alt="Logo de la marca">
                    </div>

                    <div class="card-body border-top border-bottom">
                        <h2 class="mb-3">Marcas secundarias:</h2>
                        <?php foreach($producto->getMarcas_secundarias() as $value) { ?>
                            <img class="m-3 marcaslogos" src="imagenes/logos_marcas/<?= $value->getLogo(); ?>" alt="Logo de la marca">
                        <?php } ?>
                    </div>

                    <div class="card-body border-top">
                        <h2 class="mb-3">Precio:</h2>
                        <div class="precio"><span>$<?= $producto->precio_formateado(); ?></span></div>
                        <form action="admin/actions/add_item_acc.php" method="GET" class="row mt-3">
                            <div class="col-6 d-flex align-items-center">
                                <label for="q" class="fw-bold me-2">Cantidad: </label>
                                <input type="number" class="form-control" value="1" name="q" id="q">
                            </div>
                            <div class="col-6">
                                <input type="submit" value="COMPRAR" class="btn w-100 btn-brown fuente">
                                <input type="hidden" value="<?=$id?>" name="id" id="id">
                                <input type="hidden" value="bici" name="producto" id="producto">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }else{ ?>
    
    <div class="col">
        <h2 class="text-center">No se encontró el producto deseado.</h2>
    </div>

<?php } ?>

</section>