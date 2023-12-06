<?php

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$mail = $_POST["mail"];
$telefono = $_POST["telefono"];
$comentarios = $_POST["comentarios"];

?>

<section class="row" id="datos">

    <h1 class="text-center p-4">¡Procesamiento de datos!</h1>

    <ul class="justify-content-center lista-datos">
        <li><span>Nombre:</span> <?= $nombre; ?></li>
        <li><span>Apellido:</span> <?= $apellido; ?></li>
        <li><span>E-Mail:</span> <?= $mail; ?></li>
        <li><span>Telefono:</span> <?= $telefono; ?></li>
        <li><span>Comentarios:</span> <?= $comentarios; ?></li>
    </ul>

</section>