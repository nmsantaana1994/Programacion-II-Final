<?php

class Repuestos {

    private $id;
    private $categoria_id;
    private $modelo;
    private $marca_id;
    private $descripcion;
    private $precio;
    private $foto;

    //Funciones para ABM de repuestos

        /**
         * Inserta un nuevo repuesto a la base de datos
         * @param int $categoria_id Categoria a la que pertenece el repuesto
         * @param string $modelo Modelo del repuesto
         * @param int $marca_id Marca del repuesto // Marca o marcas de la bici separadas por ","
         * @param string $descripcion Descripcion del repuesto
         * @param int $precio Precio del repuesto
         * @param string $foto Nombre del archivo .jpg o .png 
         */
        public function insert($categoria_id, $modelo, $marca_id, $descripcion, $precio, $foto){

            $conexion = Conexion::getConexion();
            $query = "INSERT INTO repuestos VALUES (NULL, :categoria_id, :modelo, :marca_id, :descripcion, :precio, :foto)";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'categoria_id' => $categoria_id,
                    'modelo' => $modelo,
                    'marca_id' => $marca_id,
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'foto' => $foto,
                ]
            );
        }

        /**
         * Edita un repuesto de la base de datos
         * @param int $categoria_id Categoria a la que pertenece el repuesto
         * @param string $modelo Modelo del repuesto
         * @param int $marca_id Marca del repuesto // Marca o marcas de la bici separadas por ","
         * @param string $descripcion Descripcion del repuesto
         * @param int $precio Precio del repuesto
         * @param string $imagen Nombre del archivo .jpg o .png  
         */
        public function edit($categoria_id, $modelo, $marca_id, $descripcion, $precio, $id, $imagen){

            $conexion = Conexion::getConexion();
            $query = "UPDATE repuestos SET categoria_id = :categoria_id, modelo = :modelo, marca_id = :marca_id, descripcion = :descripcion, precio = :precio, foto = :foto WHERE id = :id";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'id' => $id,
                    'categoria_id' => $categoria_id,
                    'modelo' => $modelo,
                    'marca_id' => $marca_id,
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'foto' => $imagen,
                ]
            );
        }

        /**
         * Elimina esta instancia de la base de datos
         */
        public function delete(){
            $conexion = Conexion::getConexion();
            $query = "DELETE FROM repuestos WHERE id = ?;";

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
         * Devuelve el catálogo completo de repuestos
         */
        public function catalogo_completo(): array {

            $conexion = Conexion::getConexion();
            $query = "SELECT * FROM repuestos";
            
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();

            $catalogo = $PDOStatement->fetchAll();

            return $catalogo;

        }

        /**
         * Devuelve el catalogo de un grupo de productos en particular
         * @param int $id El id del repuesto a buscar
         * @return Repuestos[] Un Array lleno de instancias de objeto Repuestos
         */
        function catalogo_x_producto(int $id): array{
            
            $conexion = Conexion::getConexion();
            $query = "SELECT * FROM repuestos WHERE categoria_id = ?";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(
                [$id]
            );

            $catalogo = $PDOStatement->fetchAll();

            return $catalogo;

        }

        /**
         * Devuelve los datos de un producto en particular
         * @param int $idProducto El ID único del producto a mostrar
         */
        function producto_x_id(int $idProducto): ?Repuestos{

            $conexion = Conexion::getConexion();
            $query = "SELECT * FROM repuestos WHERE id = :idProducto";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(
                [
                    "idProducto" => $idProducto
                ]
            );

            $resultado = $PDOStatement->fetch();

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
         * Obtiene el valor de categoria_id
         */
        public function getCategoria()
        {
            $categoria = (new Categoria())->get_x_id($this->categoria_id);
            $nombre = $categoria->getCategoria();
            return $nombre;
        }

        /**
         * Obtiene el valor de marca_id
         */ 
        public function getMarca()
        {
            $marca = (new Marca())->get_x_id($this->marca_id);
            $nombre = $marca->getNombre();
            return $nombre;
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
         * Get the value of marca_id
         */ 
        public function getMarca_id()
        {
            return $this->marca_id;
        }

        /**
         * Get the value of categoria_id
         */ 
        public function getCategoria_id()
        {
            return $this->categoria_id;
        }
}

?>