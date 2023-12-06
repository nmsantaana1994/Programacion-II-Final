<?php

class Marca {

    private $id;
    private $nombre;
    private $ano;
    private $logo;

    //Funciones para ABM de marcas

        /**
         * Inserta una nueva marca a la base de datos
         * @param string $nombre Nombre de la marca
         * @param int $ano Ano de creacion de la marca
         * @param string $logo Nombre del archivo .jpg o .png 
         */
        public function insert($nombre, $ano, $logo){

            $conexion = Conexion::getConexion();
            $query = "INSERT INTO marca VALUES (NULL, :nombre, :ano, :logo)";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'nombre' => $nombre,
                    'ano' => $ano,
                    'logo' => $logo,
                ]
            );
        }

        /**
         * Edita una marca de la base de datos
         * @param string $nombre Nombre de la marca
         * @param int $ano Ano de creacion de la marca
         * @param string $logo Nombre del archivo .jpg o .png 
         * @param int $id ID de la marca
         */
        public function edit($nombre, $ano, $logo, $id){

            $conexion = Conexion::getConexion();
            $query = "UPDATE marca SET nombre = :nombre, ano = :ano, logo = :logo WHERE id = :id";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'id' => $id,
                    'nombre' => $nombre,
                    'ano' => $ano,
                    'logo' => $logo,
                ]
            );
        }

        /**
         * Elimina esta instancia de la base de datos
         */
        public function delete(){
            $conexion = Conexion::getConexion();
            $query = "DELETE FROM marca WHERE id = ?;";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$this->id]);
        }


    //Funciones generales para uso de la Clase

        /**
         * Reemplaza la imagen de una marca
         * @param string $imagen
         * @param int $id
         */
        public function reemplazar_imagen($imagen, $id){
            $conexion = Conexion::getConexion();
            $query = "UPDATE marca SET logo = :imagen WHERE id = :id"; 
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'id' => $id,
                    'imagen' => $imagen
                ]
            );
        }

        /**
         * Devuelve el catálogo completo de marcas
         */
        public function catalogo_completo(): array {

            $conexion = Conexion::getConexion();
            $query = "SELECT * FROM marca";
            
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();

            $catalogo = $PDOStatement->fetchAll();

            return $catalogo;

        }

        /**
         * Devuelve los datos de una marca en particular
         * @param int $id El id único de la marca
         */
        public function get_x_id(int $id): ?Marca {
            $conexion = Conexion::getConexion();
            $query = "SELECT * FROM marca WHERE id = :id";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(
                [
                    "id" => $id
                ]
            );

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
         * Obtiene el valor de nombre
         */
        public function getNombre()
        {
            return $this->nombre;
        }

        /**
         * Obtiene el valor de ano
         */
        public function getAno()
        {
            return $this->ano;
        }

        /**
         * Obtiene el valor de logo
         */
        public function getLogo()
        {
            return $this->logo;
        }

}