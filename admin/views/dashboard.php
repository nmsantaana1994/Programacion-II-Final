<?php
$usuario = $_SESSION["loggedIn"];
if ($usuario["roles"] == "usuario"){
    header("location: ../index.php?sec=home");
}
?>

<section class=" d-flex justify-content-center p-5">
    <div>
        <h1 class="text-center mb-5 fw-bold">Panel de Administración</h1>
        <div class="row mb-5 d-flex align-items-center">
            <h2 class="text-center">Bienvenido ¡<?= $usuario["nombre"]?> <?= $usuario["apellido"]?>!</h2>
            
        </div>
    </div>
</section>