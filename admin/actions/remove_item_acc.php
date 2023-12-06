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
    (new Carrito())->remove_item($id, $producto);
    // echo "<pre>";
    // print_r($id);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($producto);
    // echo "</pre>";
    header('location: ../../index.php?sec=carrito');
}
