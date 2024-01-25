<?php

require_once('vacaciones/model/VacacionesModel.php');


class VacacionesController
{

    private $vacacionesModel;

    public function __construct()
    {
        $this->vacacionesModel = new VacacionesModel();
    }

    //***********************************************************//
    //*************************** VACACIONES *************************//
    //***********************************************************//
    public function showVacaciones($mensaje)
    {

        $articulos = $this->vacacionesModel->getAllArticulos();
        // $cantidadArticulos = $this->vacacionesModel->getCantidad();
        $categorias = $this->vacacionesModel->getAllCategories();

        include('vacaciones/index.php');
    }

    /*public function agregarArticulo()
    {
        //  datos del formulario
        $nombre = $_POST["nombre"];
        $categoria = $_POST["categoria"];

        $ok = $this->vacacionesModel->agregarArticulo($nombre, $categoria);
        if ($ok) {
            $mensaje = 'Se agregó tu artículo';
            $this->showVacaciones($mensaje);
        }
    }*/
    public function agregarArticulo()
{
    //  datos del formulario
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];

    $ok = $this->vacacionesModel->agregarArticulo($nombre, $categoria);
    
    if ($ok) {
        // Se agregó el artículo con éxito, redirigir a la página de vacaciones
        header("Location: index.php?mensaje=ok");
        exit();
    } else {
        // Manejar el caso en el que agregar el artículo no fue exitoso
        $mensaje = 'Error al agregar el artículo';
        $this->showVacaciones($mensaje);
    }
}

    public function updateAgregado()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articuloId = isset($_POST['articuloId']) ? $_POST['articuloId'] : null;

            if ($articuloId !== null) {
                // Obtener el valor actual del campo "agregado"
                $articulo = $this->vacacionesModel->getAgregado($articuloId);
                $valorActual = $articulo['agregado'];

                // Calcular el nuevo valor (alternar entre 0 y 1)
                $nuevoValor = ($valorActual == 1) ? 0 : 1;

                // Actualizar el campo "agregado" con el nuevo valor
                $this->vacacionesModel->updateAgregado($articuloId, $nuevoValor);

                // Devolver una respuesta en formato JSON
                echo json_encode(["success" => true, "nuevoValor" => $nuevoValor]);
                exit();
            } else {
                // Si no se proporcionó el ID del artículo
                echo json_encode(["success" => false, "message" => "Error: No se proporcionó el ID del artículo"]);
                exit();
            }
        } else {
            // Si el método de solicitud no es POST
            echo json_encode(["success" => false, "message" => "Error: Método de solicitud no permitido"]);
            exit();
        }
    }
}
