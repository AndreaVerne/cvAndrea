<?php

require_once("productos/app/controllers/ProductController.php");
require_once("vacaciones/controller/vacacionesController.php");

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
// define('LOGIN', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/login');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);
$productController = new ProductController();
$vacacionesController = new VacacionesController();

// Lógica de enrutamiento
switch ($params[0]) {
    case 'home':
        include('index.php');
        // $productController->showHome(false);
        break;
    case 'productos':
        $productController->showHome(false);
        break;
    case 'vacaciones':
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            switch ($action) {
                case 'updateAgregado':
                    // Obtener el ID del artículo desde la solicitud POST
                    $articuloId = isset($_POST['articuloId']) ? $_POST['articuloId'] : null;

                    if ($articuloId !== null) {
                        $vacacionesController->updateAgregado($articuloId);
                        echo "Actualización exitosa"; // Puedes enviar cualquier respuesta que desees
                    } else {
                        echo "Error: No se proporcionó el ID del artículo";
                    }
                    break;
                    // Puedes agregar más casos para otras acciones si es necesario
            }
        }
        $vacacionesController->showVacaciones();
        break;
    case 'agregar':
        $productController->showForm();
        break;
    case 'guardar':
        $productController->guardarProducto();
        break;
    case 'ver':
        // Obtener el ID del producto desde la URL
        if (isset($params[1]) && is_numeric($params[1])) {
            $id = $params[1];
            $productController->showProduct($id);
        } else if (isset($_GET["id_categoria"]) && is_numeric($_GET["id_categoria"])) {
            $id = $_GET["id_categoria"];
            $productos = $productController->showProductsByCategory($id);
        } else {
            // Manejar el caso donde el ID no está presente o no es válido
            echo "Error: ID de producto no válido";
        }
        break;
    default:
        echo "Error 404 - Page not found";
        break;
}
