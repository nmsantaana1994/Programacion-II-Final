<?PHP
$categorias = (new Categoria())->catalogo_completo();
?>

<section class="row my-5">
    <div class="col">

        <h1 class="text-center mb-5 fw-bold">Administración de Categorías</h1>
        <div class="row mb-5 d-flex align-items-center">

            <div>
                <?= (new Alerta())->get_alertas(); ?>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Categoría</th>
                        <th scope="col" width="10%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach ($categorias as $C) { ?>
                        <tr>
                            <td><?= $C->getCategoria()?></td>
                            <td>
                                <a href="index.php?sec=edit_categoria&id=<?= $C->getId() ?>" role="button" class="d-block btn btn-sm btn-yellow mb-1">Editar</a>
                                <a href="index.php?sec=delete_categoria&id=<?= $C->getId() ?>" role="button" class="d-block btn btn-sm btn-brown">Eliminar</a>
                            </td>
                        </tr>
                    <?PHP } ?>
                </tbody>
            </table>

            <a href="index.php?sec=add_categoria" class="btn bg-cian fuente mt-5">Cargar nueva categoría</a>
        </div>


    </div>
</section>