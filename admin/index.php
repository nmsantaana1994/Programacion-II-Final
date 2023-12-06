<?php 
//Importamos el archivo con la clase
require_once "../functions/autoload.php";

//Secciones a las que tiene acceso quien entra a la web
$secciones_validas = [
    //Login
    "login" => [
        "titulo" => "Login",
        "restringido" => FALSE
    ],
    
    "dashboard" => [
        "titulo" => "Panel de Control",
        "restringido" => TRUE
    ],

    //Administracion
    "admin_repuestos" => [
        "titulo" => "Administración de Repuestos",
        "restringido" => TRUE
    ],
    "admin_bicicletas" => [
        "titulo" => "Administración de Bicicletas",
        "restringido" => TRUE
    ],
    "admin_categorias" => [
        "titulo" => "Administración de Categorías",
        "restringido" => TRUE
    ],
    "admin_marcas" => [
        "titulo" => "Administración de Marcas",
        "restringido" => TRUE
    ],

    //Agregar
    "add_repuestos" => [
        "titulo" => "Agregar Repuestos",
        "restringido" => TRUE
    ],
    "add_bicicleta" => [
        "titulo" => "Agregar Bicicletas",
        "restringido" => TRUE
    ],
    "add_categoria" => [
        "titulo" => "Agregar Categoría",
        "restringido" => TRUE
    ],
    "add_marca" => [
        "titulo" => "Agregar Categoría",
        "restringido" => TRUE
    ],

    //Editar
    "edit_marca" => [
        "titulo" => "Editar Marca",
        "restringido" => TRUE
    ],
    "edit_categoria" => [
        "titulo" => "Editar Categoría",
        "restringido" => TRUE
    ],
    "edit_bicicleta" => [
        "titulo" => "Editar Bicicleta",
        "restringido" => TRUE
    ],
    "edit_repuesto" => [
        "titulo" => "Editar Repuesto",
        "restringido" => TRUE
    ],
    
    //Borrar
    "delete_marca" => [
        "titulo" => "Eliminar Marca",
        "restringido" => TRUE
    ],
    "delete_categoria" => [
        "titulo" => "Editar Categoría",
        "restringido" => TRUE
    ],
    "delete_bicicleta" => [
        "titulo" => "Editar Bicicleta",
        "restringido" => TRUE
    ],
    "delete_repuesto" => [
        "titulo" => "Editar Repuesto",
        "restringido" => TRUE
    ]
];

$seccion = $_GET['sec'] ?? "dashboard";

//Control de secciones, si no existe va a 404
if(!array_key_exists($seccion, $secciones_validas)){
    $vista = "404";
    $titulo = "404 - Página no encontrada";
}else{
    $vista = $seccion;

    if ($secciones_validas[$seccion]["restringido"]){
        (new Autenticacion)->verify();
    }

    $titulo = $secciones_validas[$seccion]['titulo'];
}

$userData = $_SESSION["loggedIn"] ?? FALSE;
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
    <link href="../css/styles.css" rel="stylesheet"/>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-cian">
        <div class="container-fluid">

            <a class="navbar-brand" href="#"><img src="../imagenes/logo_b.png" alt="Logo de la marca" ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav indexA ms-auto">
                    <li class="nav-item <?= $userData ? "" : "d-none"?>">
                    <a class="nav-link" aria-current="page" href="index.php?sec=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown  <?= $userData ? "" : "d-none"?>">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Administración
                    </a>
                    <ul class="dropdown-menu bg-cian">
                        <li><a class="dropdown-item" href="index.php?sec=admin_repuestos">Repuestos</a></li>
                        <li><a class="dropdown-item" href="index.php?sec=admin_bicicletas">Bicicletas</a></li>
                        <li><a class="dropdown-item" href="index.php?sec=admin_categorias">Categorías</a></li>
                        <li><a class="dropdown-item" href="index.php?sec=admin_marcas">Marcas</a></li>
                    </ul>
                    <li class="nav-item">
                        <a class="nav-link fw-bold  <?= $userData ? "d-none" : ""?>" href="index.php?sec=login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold  <?= $userData ? "" : "d-none"?>" href="actions/auth_logout.php">Logout</a>
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

    <footer class="btn-brown text-center bg-cian">
        <details>
            
          <summary>&copy;Da Vinci 2022 - Proyecto 1er Parcial</summary>
          <ul class="datos">
              <li><img src="../imagenes/autor.png" alt="Autor del sitio" title="Autor del sitio"/></li>
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