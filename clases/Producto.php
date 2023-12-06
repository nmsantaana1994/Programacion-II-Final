<?php

class Producto {

    private $id;
    private $modelo;
    private $marca;
    private $descripcion;
    private $marcas_secundarias;
    private $precio;
    private $foto;

    private static $creacionValores = ["id","modelo","descripcion", "precio","foto"];

    //Funciones para ABM de bicicletas

        /**
         * Inserta una nueva bicileta a la base de datos
         * @param string $modelo Modelo de la bicicleta
         * @param int $marca_id Marca o marcas de la bicicleta separadas por ","
         * @param string $descripcion Descripcion de la bicicleta
         * @param int $precio Precio de la bicicleta
         * @param string $foto Nombre del archivo .jpg o .png
         * @return int El ID correspondiente a la fila ingresada
         */
        public function insert($modelo, $marca_id, $descripcion, $precio, $foto) : int {

            $conexion = Conexion::getConexion();
            $query = "INSERT INTO bicicletas VALUES (NULL, :modelo, :marca_id, :descripcion, :precio, :foto)";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'modelo' => $modelo,
                    'marca_id' => $marca_id,
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'foto' => $foto,
                ]
            );

            return $conexion->lastInsertId();
        }

        /**
         * Edita una bicileta de la base de datos
         * @param string $modelo Modelo de la bicicleta
         * @param int $marca_id Marca o marcas de la bicicleta separadas por ","
         * @param string $descripcion Descripcion de la bicicleta
         * @param int $precio Precio de la bicicleta
         * @param string $imagen Nombre del archivo .jpg o .png 
         */
        public function edit($marca_id, $modelo, $descripcion, $precio, $id, $imagen){

            $conexion = Conexion::getConexion();
            $query = "UPDATE bicicletas SET modelo = :modelo, marca_id = :marca_id, descripcion = :descripcion, precio = :precio, foto = :foto WHERE id = :id";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'id' => $id,
                    'modelo' => $modelo,
                    'marca_id' => $marca_id,
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'foto'=> $imagen
                ]
            );
        }

        /**
         * Elimina esta instancia de la base de datos
         */
        public function delete(){
            $conexion = Conexion::getConexion();
            $query = "DELETE FROM bicicletas WHERE id = ?;";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$this->id]);
        }

    //Funciones generales para uso de la Clase

        /**
         * Reemplaza la imagen de una bicicleta
         * @param string $imagen
         * @param int $id
         */
        public function reemplazar_imagen($imagen, $id){
            $conexion = Conexion::getConexion();
            $query = "UPDATE bicicletas SET foto = :imagen WHERE id = :id"; 
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'id' => $id,
                    'imagen' => $imagen
                ]
            );
        }

        /**
         * Crea un vinculo de marcas secundarias
         * @param int $bicicleta_id
         * @param int $marca_id
         */
        public function add_marcas_sec($bicicleta_id, $marca_id){
            $conexion = Conexion::getConexion();
            $query = "INSERT INTO marca_x_bicicleta VALUES (NULL, :bicicleta_id, :marca_id)";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'bicicleta_id' => $bicicleta_id,
                    'marca_id' => $marca_id
                ]
            );
        }

        /**
         * Vaciar lista de marcas secundarias
         * @param int $bicicleta_id
         */
        public function clear_marcas_sec($bicicleta_id){
            $conexion = Conexion::getConexion();
            $query = "DELETE FROM marca_x_bicicleta WHERE bicicleta_id = :bicicleta_id";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'bicicleta_id' => $bicicleta_id
                ]
            );
        }

        /**
         * Devuelve una instancia del objeto Producto, con todas sus propiedades configuradas
         * @return Producto
         */
        public function crearProducto($datosProducto): Producto {
            $producto = new self();

            foreach (self::$creacionValores as $value){
                $producto->{$value} = $datosProducto[$value];
            }

            $producto->marca = (new Marca())->get_x_id($datosProducto["marca_id"]);

            $MSIds = explode(",", $datosProducto["marcas_secundarias"]);
            $marcas_secundarias = [];
            if(!empty($MSIds[0])){
                foreach ($MSIds as $MSId) {
                    $marcas_secundarias[] = (new Marca())->get_x_id(intval($MSId));
                }
            }

            $producto->marcas_secundarias = $marcas_secundarias;

            return $producto;
        }

        /**
         * Devuelve el catálogo completo de productos
         */
        public function catalogo_completo(): array {
            $catalogo = [];

            $conexion = Conexion::getConexion();
            $query = "SELECT bicicletas.*, GROUP_CONCAT(marca_x_bicicleta.marca_id) AS marcas_secundarias FROM bicicletas LEFT JOIN marca_x_bicicleta ON marca_x_bicicleta.bicicleta_id = bicicletas.id GROUP BY bicicletas.id;";
            
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $PDOStatement->execute();

            while ($result = $PDOStatement->fetch()){
                $catalogo[]= $this->crearProducto($result);
            }

            //$catalogo = $PDOStatement->fetchAll();

            return $catalogo;

        }

        /**
         * Devuelve el catalogo de un grupo de productos en particular
         * @param int $id El id de la bici a buscar
         * @return Producto[] Un Array lleno de instancias de objeto Producto
         */
        function catalogo_x_producto(int $id): array{
            $conexion = Conexion::getConexion();
            $query = "SELECT bicicletas.*, GROUP_CONCAT(marca_x_bicicleta.marca_id) AS marcas_secundarias FROM bicicletas LEFT JOIN marca_x_bicicleta ON marca_x_bicicleta.bicicleta_id = bicicletas.id WHERE id = ? GROUP BY bicicletas.id;";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $PDOStatement->execute([$id]);

            while ($result = $PDOStatement->fetch()){
                $catalogo[]= $this->crearProducto($result);
            }

            //$catalogo = $PDOStatement->fetchAll();

            return $catalogo;
        }

        /**
         * Devuelve los datos de un producto en particular
         * @param int $idProducto El ID único del producto a mostrar
         */
        function producto_x_id(int $idProducto): ?Producto{

            $conexion = Conexion::getConexion();
            $query = "SELECT bicicletas.*, GROUP_CONCAT(marca_x_bicicleta.marca_id) AS marcas_secundarias FROM bicicletas LEFT JOIN marca_x_bicicleta ON marca_x_bicicleta.bicicleta_id = bicicletas.id  WHERE bicicletas.id = :idProducto GROUP BY bicicletas.id;";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $PDOStatement->execute(
                [
                    "idProducto" => $idProducto
                ]
            );

            $resultado = $this->crearProducto($PDOStatement->fetch());

            if (!$resultado) {
                return null;
            }

            return $resultado;
        }

        /**
         * Esta función devuelve las primeras x palabras de un párrafo
         * @param int $cantidad Esta es la cantidad de palabras a extraer (Opcional)
         */
        function recortar_palabras(int $cantidad = 22):string{

            $texto = $this->descripcion;

            $array = explode(" ", $texto);
            if (count($array)<=$cantidad)
            {
                $resultado = $texto;
            }
            else
            {
                array_splice($array, $cantidad);
                $resultado = implode(" ", $array)."...";
            }

            return $resultado;

        }

        /**
         * Devuelve el precio de la unidad, formateado correctamente
         */
        public function precio_formateado(): string {
            return number_format($this->precio, 2, ",", ".");
        }

    //Getters y Setters

        /**
         * Obtiene el valor de id
         */
        public function getID()
        {
            return $this->id;
        }

        /**
         * Obtiene el valor del nombre de la marca
         */ 
        public function getMarca(): Marca
        {
            return $this->marca;
        }

        /**
         * Obtiene el valor del logo de la marca
         */ 
        public function getLogo_Marca()
        {
            return $this->marca->getLogo();
        }

        /**
         * Obtiene el valor de modelo
         */ 
        public function getModelo()
        {
            return $this->modelo;
        }

        /**
         * Obtiene el valor de descripcion
         */ 
        public function getDescripcion()
        {
            return $this->descripcion;
        }

        /**
         * Obtiene el valor de precio
         */ 
        public function getPrecio()
        {
            return $this->precio;
        }

        /**
         * Obtiene el valor de foto
         */ 
        public function getFoto()
        {
            return $this->foto;
        }

        /**
         * Get the value of marcas_secundarias
         * @return Marcas[]
         */ 
        public function getMarcas_secundarias() :array
        {
            return $this->marcas_secundarias;
        }

        /**
         * Devuelve un array compuesto por los IDs de todas las marcas secundarias
         */
        public function getMarcas_secundarias_ids() :array {
            $result = [];
            foreach ($this->marcas_secundarias as $value) {
                $result[] = intval($value->getID());
            }
            return $result;
        }
    }

?>