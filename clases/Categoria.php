<?php

class Categoria {

    private $id;
    private $categoria;
    
    //Funciones para ABM de marcas

        /**
         * Inserta una nueva categoria a la base de datos
         * @param string $categoria Categoria de repuestos
         */
        public function insert($categoria){

            $conexion = Conexion::getConexion();
            $query = "INSERT INTO categoria VALUES (NULL, :categoria)";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'categoria' => $categoria,
                ]
            );
        }

        /**
         * Edita una categoria de la base de datos
         * @param string $categoria Nombre de la categoría
         * @param int $id ID de la marca
         */
        public function edit($categoria, $id){

            $conexion = Conexion::getConexion();
            $query = "UPDATE categoria SET categoria = :categoria WHERE categoria.id = :id";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'id' => $id,
                    'categoria' => $categoria,
                ]
            );
        }

        /**
         * Elimina esta instancia de la base de datos
         */
        public function delete(){
            $conexion = Conexion::getConexion();
            $query = "DELETE FROM categoria WHERE id = ?;";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$this->id]);
        }

    //Funciones generales para uso de la Clase

        /**
         * Devuelve el catálogo completo de categorias
         */
        public function catalogo_completo(): array {

            $conexion = Conexion::getConexion();
            $query = "SELECT * FROM categoria";
            
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();

            $catalogo = $PDOStatement->fetchAll();

            return $catalogo;

        }

        /**
         * Devuelve los datos de una categoria en particular
         * @param int $id El id único de la marca
         */
        public function get_x_id(int $id): ?Categoria {
            $conexion = Conexion::getConexion();
            $query = "SELECT * FROM categoria WHERE id = $id";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();

            $resultado = $PDOStatement->fetch();

            if (!$resultado) {
                return null;
            }

            return $resultado;
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
         * Obtiene el valor de categoria
         */
        public function getCategoria()
        {
            return $this->categoria;
        }
}
