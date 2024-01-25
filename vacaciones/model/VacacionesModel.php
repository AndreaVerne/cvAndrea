<?php
class VacacionesModel
{

    protected $conn; // Propiedad para almacenar la conexión

    public function __construct()
    {
        $this->conn = $this->conection(); // Almacena la conexión en la propiedad $conn
    }

    private function conection()
    {
         $servername = "localhost";
         $username = "andreave_admin";
         $password = "Muni3arm0955"; //cambiar 
         $dbname = "andreave_vacaciones";

    //     $servername = "localhost";
    //    $username = "root";
    //    $password = "Muni3ar013"; //cambiar 
    //    $dbname = "andreave_vacaciones";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        return $conn; // Devuelve la instancia de mysqli
    }

    //ARTICULOS PARA LLEVAR
    public function getAllArticulos()
    {
        $sql = "SELECT * FROM articulos";
        $result = $this->conn->query($sql);
        $articulos = array();

        while ($row = $result->fetch_assoc()) {
            $articulos[] = $row;
        }

        return $result;
    }

    public function agregarArticulo($nombre, $idCategoria) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO articulos (nombre, id_categoria) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
    
        // Verificar si la preparación fue exitosa
        if ($stmt) {
            // Suponiendo que $nombre y $idCategoria son las variables con los valores a insertar
            $stmt->bind_param("si", $nombre, $idCategoria);
    
            // Ejecutar la sentencia preparada para insertar los datos
            $stmt->execute();

              // Verificar si la ejecución fue exitosa
              if ($stmt->affected_rows > 0) {
                // La inserción fue exitosa
                return true;
            } else {
                // La inserción no fue exitosa
                return false;
            }
    
        } else {
            // Si hubo un error al preparar la consulta
            die('Error al preparar la consulta: ' . $this->conn->error);
        }
    }

    //PRODUCTO
    public function getAgregado($id)
    {
        $sql = "SELECT agregado FROM articulos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id); // "i" indica que se espera un parámetro de tipo entero
        $stmt->execute();
        $result = $stmt->get_result();
        $articulo = $result->fetch_assoc();
    
        return $articulo;
    }

    public function getArticulosByCategory($id){
        $sql = "SELECT * FROM articulos WHERE id_categoria = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id); // "i" indica que se espera un parámetro de tipo entero
        $stmt->execute();
        $result = $stmt->get_result();
    
        $products = array(); // Array para almacenar los productos
    
        while ($row = $result->fetch_assoc()) {
            $products[] = $row; // Almacena cada fila como un producto en el array
        }
    
        return $products;
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categoria";
        $result = $this->conn->query($sql);
        $categories = array();

        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        return $result;
    }


    public function insertarProducto($nombre, $precio, $categoria, $detalle, $imagen)
    {

        $sql = "INSERT INTO articulos (nombre, precio, id_categoria, detalle, imagen) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . $this->conn->error);
        }
        // Suponiendo que $nombre, $precio, $categoria, $imagen son las variables con los valores a insertar
        $stmt->bind_param("sisss", $nombre, $precio, $categoria, $detalle, $imagen);

        // Ejecutar la sentencia preparada para insertar los datos
        $stmt->execute();
    }

    public function updateAgregado($articuloId, $nuevoValor) {
        $sql = "UPDATE articulos SET agregado = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            die('Error al preparar la consulta: ' . $this->conn->error);
        }
    
        // "ii" indica que se esperan dos parámetros de tipo entero
        $stmt->bind_param("ii", $nuevoValor, $articuloId);
    
        // Ejecutar la sentencia preparada para actualizar el campo "agregado"
        $stmt->execute();
    }
    
}
