<?PHP
$productos = (new Producto())->catalogo_completo();
?>

<section class="row my-5">
    <div class="col">

        <h1 class="text-center mb-5 fw-bold">Administración de Bicicletas</h1>
        <div class="row mb-5 d-flex align-items-center">

            <div>
                <?= (new Alerta())->get_alertas(); ?>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Modelo</th>
                        <th scope="col">Marca</th>
                        <th scope="col" width="35%">Descripción</th>
                        <th scope="col">Marcas Secundarias</th>
                        <th scope="col">Precio</th>
                        <th scope="col" width="30%">Foto</th>
                        <th scope="col" width="10%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach ($productos as $P) { ?>
                        <tr>
                            <td><?= $P->getModelo()?></td>
                            <td><?= $P->getMarca()->getNombre()?></td>
                            <td><?= $P->getDescripcion()?></td>
                            <td>
                            <?PHP
                            foreach ($P->getMarcas_secundarias() as $MS) {
                                echo "<p>" . $MS->getNombre() . "</p>";
                            }
                            ?>
                            </td>
                            <td>$<?= $P->precio_formateado()?></td>
                            <td><img src="../imagenes/productos/bicicletas/<?= $P->getFoto()?>" alt="Imágen Illustrativa de <?= $P->getModelo() ?> <?= $P->getMarca()->getNombre() ?>" class="img-fluid rounded shadow-sm"></td>
                            <td>
                                <a href="index.php?sec=edit_bicicleta&id=<?= $P->getId() ?>" role="button" class="d-block btn btn-sm btn-yellow mb-1">Editar</a>
                                <a href="index.php?sec=delete_bicicleta&id=<?= $P->getId() ?>" role="button" class="d-block btn btn-sm btn-brown">Eliminar</a></td>
                        </tr>
                    <?PHP } ?>
                </tbody>
            </table>

            <a href="index.php?sec=add_bicicleta" class="btn bg-cian fuente mt-5">Cargar nueva bicicleta</a>
        </div>
    </div>
</section>