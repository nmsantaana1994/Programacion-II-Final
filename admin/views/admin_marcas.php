<?PHP
$marcas = (new Marca())->catalogo_completo();
?>

<section class="row my-5">
    <div class="col">

        <h1 class="text-center mb-5 fw-bold">Administración de Marcas</h1>
        <div class="row mb-5 d-flex align-items-center">

            <div>
                <?= (new Alerta())->get_alertas(); ?>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Año</th>
                        <th scope="col" width="30%">Logo</th>
                        <th scope="col" width="10%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach ($marcas as $M) { ?>
                        <tr>
                            <th scope="row"><?= $M->getID()?></th>
                            <td><?= $M->getNombre()?></td>
                            <td><?= $M->getAno()?></td>
                            <td><img src="../imagenes/logos_marcas/<?= $M->getLogo()?>" alt="Imágen Illustrativa de <?= $M->getNombre() ?>" class="img-fluid rounded shadow-sm"></td>
                            <td>
                                <a href="index.php?sec=edit_marca&id=<?= $M->getId() ?>" role="button" class="d-block btn btn-sm btn-yellow mb-1">Editar</a>
                                <a href="index.php?sec=delete_marca&id=<?= $M->getId() ?>" role="button" class="d-block btn btn-sm btn-brown">Eliminar</a>
                            </td>
                        </tr>
                    <?PHP } ?>
                </tbody>
            </table>

            <a href="index.php?sec=add_marca" class="btn bg-cian fuente mt-5">Cargar nueva marca</a>
        </div>


    </div>
</section>