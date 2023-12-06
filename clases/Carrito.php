<?PHP

class Carrito {
    /**
     * Agrega un item bicicleta al carrito de compras
     * @param int $productoID El ID del producto que se va a agregar.
     * @param int $cantidad La cantidad de unidades del producto que se van a agregar
     */
    public function add_item(int $productoID, int $cantidad, $producto){
        echo "<pre>";
        print_r($_SESSION["carrito"]);
        echo "</pre>";

        //$_SESSION["carrito"] = [];

        if ($producto == "bici"){
            $itemData = (new Producto)->producto_x_id($productoID);
            if ($itemData) {
                $_SESSION['carrito'][$producto][$productoID] = [
                    'id' => $itemData->getID(),
                    'producto' => $itemData->getMarca()->getNombre() . " " . $itemData->getModelo(),
                    'imagen' => $itemData->getFoto(),
                    'categoria' => "bicicletas",
                    'precio' => $itemData->getPrecio(),
                    'cantidad' => $cantidad
                ];
            }
        }else {
            $itemData = (new Repuestos)->producto_x_id($productoID);
            if ($itemData) {
                $_SESSION['carrito'][$producto][$productoID] = [
                    'id' => $itemData->getID(),
                    'producto' => $itemData->getMarca() . " " . $itemData->getModelo(),
                    'imagen' => $itemData->getFoto(),
                    'categoria' => $itemData->getCategoria(),
                    'precio' => $itemData->getPrecio(),
                    'cantidad' => $cantidad                    
                ];
            }
        }
    }

    /**
     * Devuelve el contenido del carrito de compras de bicis actual
     */
    public function get_carrito(){
        if (!empty($_SESSION['carrito'])) {
            return $_SESSION['carrito'];
        } else {
            return [];
        }
    }
    
    /**
     * Vacia el carrito de compras
     */
    public function clear_items(){
        $_SESSION['carrito'] = [];
    }

    /**
     * Devuelve el precio total actual del carrito de compras de bicis
     */
    public function precio_total(){
        $total = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $key => $item) {
                foreach ($item as $prod) {
                    $total += $prod['precio'] * $prod['cantidad'];
                }
            }
        }
        return $total;
    }

    /**
     * Actualiza las cantidades de los ids provistos
     * @param array $cantidades Array asociativo con las cantidades de cada ID
     * @param array $categoria Array asociativo con las cantidades de cada ID
     */
    public function update_quantities(array $cantidades, $categorias){
        foreach ($cantidades as $key => $value) {

            echo "<pre>";
            print_r($cantidades);
            echo "</pre>";
            echo "<pre>";
            print_r($categorias);
            echo "</pre>";

            foreach ($categorias as $categoria){
                echo "<pre>";
                print_r($categoria);
                echo "</pre>";

                echo "<pre>";
                print_r($_SESSION['carrito'][$categoria]);
                echo "</pre>";

                if (isset($_SESSION['carrito'][$categoria])) {
                    $_SESSION['carrito'][$categoria][$key]['cantidad'] = $value;
                }
            }
        }
    }

    /**
     * Elimina un item del carrito de compras
     * @param int $productoID El id del producto a elminar
     * @param string $producto La categoria del item del producto a eliminar
     */
    public function remove_item(int $productoID, string $producto){
        echo "<pre>";
        print_r($productoID);
        echo "</pre>";
        echo "<pre>";
        print_r($producto);
        echo "</pre>";

        if (isset($_SESSION['carrito'][$producto][$productoID])) {
            unset($_SESSION['carrito'][$producto][$productoID]);
        }

        // if ($_SESSION['carrito'] = ""){
        //     self::clear_items();
        // }
    }
}