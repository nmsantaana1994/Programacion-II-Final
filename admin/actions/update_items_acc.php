<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
// echo "<pre>";
// print_r($postData);
// echo "</pre>";

// echo "<pre>";
// print_r($postData["q"]);
// echo "</pre>";

// echo "<pre>";
// print_r($postData["categoria"]);
// echo "</pre>";

if(!empty($postData)){
    (new Carrito())->update_quantities($postData['q'], $postData['categoria']);
    //header('location: ../../index.php?sec=carrito');
}
