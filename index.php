<?php 
//Importamos el archivo con la clase
require_once "functions/autoload.php";

$seccion = $_GET["sec"] ?? "home";

//Secciones a las que tiene acceso quien entra a la web
$secciones_validas = [
    //Login
    "login" => [
        "titulo" => "Login",
    ],
    "home" => [
        "titulo" => "Bienvenidos"
    ],
    "producto" => [
        "titulo" => "Repuestos"
    ],
    "producto_bicis" => [
        "titulo" => "Bicicletas"
    ],
    "quienes_somos" => [
        "titulo" => "¿Quienes Somos?"
    ],
    "contacto" => [
        "titulo" => "Contactanos"
    ],
    "alumno" => [
        "titulo" => "Alumno"
    ],
    "catalogo" => [
        "titulo" => "Catálogo Repuestos"
    ],
    "catalogo_bicis" => [
        "titulo" => "Catálogo Bicis"
    ],
    "catalogo_completo" => [
        "titulo" => "Catálogo Repuestos"
    ],
    "procesar_datos" => [
        "titulo" => "Datos"
    ],
    "sandbox" => [
        "titulo" => "Sandbox"
    ],
    "carrito" => [
        "titulo" => "Mi Carrito de Compras"
    ]
];

//Control de secciones, si no existe va a 404
if(!array_key_exists($seccion, $secciones_validas)){
    $vista = "404";
    $titulo = "404 - Página no encontrada";
}else{
    $vista = $seccion;
    $titulo = $secciones_validas[$seccion]['titulo'];
}

$userData = $_SESSION["loggedIn"] ?? FALSE;

$miObjetoCategoria = new Categoria();
$categoria = $miObjetoCategoria->catalogo_completo();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo; ?> - BMX Street</title>
    <link rel="shortcut icon" href="imagenes/favicon.svg" />

    <!--Fuentes de Google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!-- CSS Owner -->
    <link href="css/styles.css" rel="stylesheet"/>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="imagenes/logo.png" alt="Logo de la marca" ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav indexH ms-auto">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php?sec=home">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=quienes_somos">¿Quienes somos?</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=catalogo_bicis&cat=bicicletas">Bicicletas</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Repuestos
                    </a>
                    <ul class="dropdown-menu">
                        <?php  foreach ($categoria as $C){
                            
                           
                            ?>
                            
                            <li><a class="dropdown-item" href="index.php?sec=catalogo&cat=<?=$C->getId()?>"><?=$C->getCategoria()?></a></li>
                        <?php } ?>
                        
                        
                        <!-- <li><a class="dropdown-item" href="index.php?sec=catalogo&cat=1">Cuadros</a></li>
                        <li><a class="dropdown-item" href="index.php?sec=catalogo&cat=2">Mazas</a></li>
                        <li><a class="dropdown-item" href="index.php?sec=catalogo&cat=3">Llantas</a></li>
                        <li><a class="dropdown-item" href="index.php?sec=catalogo&cat=4">Platos</a></li>
                        <li><a class="dropdown-item" href="index.php?sec=catalogo&cat=5">Horquillas</a></li> -->
                        <li><a class="dropdown-item" href="index.php?sec=catalogo_completo">Todos</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=contacto">Contactanos</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=alumno">Alumno</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold  <?= $userData ? "d-none" : ""?>" href="index.php?sec=login">Login</a>
                    </li>
                    <li class="nav-item <?= $userData ? "" : "d-none" ?> fw-bold">
                        <a class="nav-link fw-bold" href="index.php?sec=carrito">Carrito</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold  <?= $userData ? "" : "d-none"?>" href="admin/actions/auth_logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">

        <?php

        require file_exists("views/$vista.php") ? "views/$vista.php" : "views/404.php";
    
        ?>

    </main>

    <footer class="btn-brown text-center">
        <details>
            
          <summary>&copy;Da Vinci 2022 - Proyecto 1er Parcial</summary>
          <ul class="datos">
              <li><img src="imagenes/autor.png" alt="Autor del sitio" title="Autor del sitio"/></li>
              <li>Nombre y Apellido: Nicolás Santa Ana</li>
              <li>Fecha de nacimiento: 31/12/1994</li>
              <li>Email: nmsantaana1994@gmail.com</li>
              <li>Proyecto 1er Parcial</li>
          </ul>
      
        </details>
    </footer>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>