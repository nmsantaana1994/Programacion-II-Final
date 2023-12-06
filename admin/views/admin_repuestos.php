<?PHP
$repuestos = (new Repuestos())->catalogo_completo();
?>

<section class="row my-5">
    <div class="col">

        <h1 class="text-center mb-5 fw-bold">Administración de Repuestos</h1>
        <div class="row mb-5 d-flex align-items-center">
            <div>
                <?= (new Alerta())->get_alertas(); ?>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Categoría</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Marca</th>
                        <th scope="col" width="35%">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col" width="30%">Foto</th>
                        <th scope="col" width="10%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach ($repuestos as $R) { ?>
                        <tr>
                            <td><?= $R->getCategoria()?></td>
                            <td><?= $R->getModelo()?></td>
                            <td><?= $R->getMarca()?></td>
                            <td><?= $R->getDescripcion()?></td>
                            <td>$<?= $R->precio_formateado()?></td>
                            <td><img src="../imagenes/productos/<?= $R->getCategoria()?>/<?= $R->getFoto()?>" alt="Imágen Illustrativa de <?= $R->getModelo() ?> <?= $R->getMarca() ?>" class="img-fluid rounded shadow-sm"></td>
                            <td>
                                <a href="index.php?sec=edit_repuesto&id=<?= $R->getId() ?>" role="button" class="d-block btn btn-sm btn-yellow mb-1">Editar</a>
                                <a href="index.php?sec=delete_repuesto&id=<?= $R->getId() ?>" role="button" class="d-block btn btn-sm btn-brown">Eliminar</a>
                            </td>
                        </tr>
                    <?PHP } ?>
                </tbody>
            </table>

            <a href="index.php?sec=add_repuestos" class="btn bg-cian fuente mt-5">Cargar nuevo repuesto</a>
        </div>


    </div>
</section>