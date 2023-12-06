<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;
$q = $_GET['q'] ?? 1;
$producto = $_GET["producto"];

// echo "<pre>";
// print_r($id);
// echo "</pre>";
// echo "<pre>";
// print_r($q);
// echo "</pre>";
// echo "<pre>";
// print_r($producto);
// echo "</pre>";

if($id){
    (new Carrito())->add_item($id, $q, $producto);
    header('location: ../../index.php?sec=carrito');
}
