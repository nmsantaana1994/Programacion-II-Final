<?PHP
$miCarrito = new Carrito();
$items = $miCarrito->get_carrito();

echo "<pre>";
print_r($items);
echo "</pre>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>

<h1 class="text-center fs-2 my-5"> Carrito de Compras</h1>
<div class="container my-4">
    <?PHP if (count($items)) { ?>
    <form action="admin/actions/update_items_acc.php" method="POST">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" width="15%">Imagen</th>
                    <th scope="col">Datos del producto</th>
                    <th scope="col" width="15%">Cantidad</th>
                    <th class="text-end" scope=" col" width="15%">Precio Unitario</th>
                    <th class="text-end" scope="col" width="15%">Subtotal</th>
                    <th class="text-end" scope="col" width="10%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $key => $item) {
                    //if ($item > 1){
                    foreach ($item as $prod){
                        echo "<pre>";
                        print_r($prod);
                        echo "</pre>";
                        echo "<pre>";
                        print_r($prod["categoria"]);
                        echo "</pre>";
                        echo "<pre>";
                        print_r($key);
                        echo "</pre>";
                        echo "<pre>";
                        print_r(key($item));
                        echo "</pre>";

                        
                        
                    
                    //}
                    
                    // echo "<pre>";
                    // print_r($items);
                    // echo "</pre>";
                    // echo "<pre>";
                    // print_r($key);
                    // echo "</pre>";
                    // echo "<pre>";
                    // print_r($item[key($item)]);
                    // echo "</pre>";
                    // // echo "<pre>";
                    // // print_r($item[key($item)]["id"]);
                    // // echo "</pre>";
                    // echo "<pre>";
                    // print_r($item);
                    // echo "</pre>";
                    
                    ?>
                    <tr>
                        <td><img src="imagenes/productos/<?= $prod["categoria"]?>/<?=$prod["imagen"] ?>" alt="Imágen Illustrativa de <?= $prod["producto"] ?>" class="img-fluid rounded shadow-sm"></td>
                        <td class="align-middle">
                            <h2 class="h5"><?= $prod['producto'] ?></h2>
                            
                        </td>
                        <td class="align-middle">
                            <label for="q_<?=$key?><?= $prod["id"] ?>" class="visually-hidden">Cantidad</label>
                            <input type="number" class="form-control" value="<?= $prod['cantidad'] ?>" id="q_<?=$key?><?= $prod["id"] ?>" name="q[<?= $prod["id"] ?>]">
                            <input type="hidden" value="<?= $key?>" name="categoria[]">
                        </td>
                        <td class="text-end align-middle">
                            <p class="h5 py-3">$<?= number_format($prod['precio'], 2, ",", ".") ?></p>
                        </td>
                        <td class="text-end align-middle">
                            <p class="h5 py-3"> $<?= number_format($prod['cantidad'] * $prod['precio'], 2, ",", ".") ?></p>
                        </td>
                        <td class="text-end align-middle">
                            <a href="admin/actions/remove_item_acc.php?id=<?= $prod["id"] ?>&producto=<?=$key?>" class="btn btn-sm btn-brown">Eliminar</a>
                        </td>
                    </tr>
                <?php }} ?>
                <tr>
                    <td colspan="4" class="text-end">
                        <h2 class="h5 py-3">Total:</h2>
                    </td>
                    <td class="text-end">
                        <p class="h5 py-3">$<?= number_format($miCarrito->precio_total(), 2, ",", ".") ?></p>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-end gap-2">
            <input type="submit" value="Actualizar Cantidades" class="btn btn-yellow">
            <a href="index.php?sec=catalogo_bicis" role="button" class=" btn btn-brown">Seguir comprando</a>
            <a href="admin/actions/clear_items_acc.php" role="button" class="btn btn-brown">Vaciar Carrito</a>
            <a href="#" role="button" class="btn bg-cian fuente">Finalizar Compra</a>
        </div>
    </form>
    <?PHP } else { ?>
        <h2 class="text-center mb-5 text-danger">Su carrito esta vacio</h2>
    <?PHP } ?>
</div>