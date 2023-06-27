<?php
    require_once('../config/conn.php');

    class DBQ{

        public static function selectStuff($fields, $table) {
            /**
             * Ejecuta una consulta SELECT en la base de datos y retorna un array con los datos obtenidos.
             *
             * @param array $campos  Array con los nombres de los campos a seleccionar (puede incluir '*').
             * @param string $tabla  Nombre de la tabla en la base de datos.
             * @return array  Array con los datos obtenidos de la consulta.
             */
            $db = new DBConn();
            $conn = $db->getConn();
            $col = implode(', ', $fields);
            $query = "SELECT $col FROM $table";
            $result = $conn->query($query);
    
            if ($result->num_rows > 0) {
                $data = array();
    
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
    
                return $data;
            } else {
                return array(); // Si no hay results, retornamos un array vacío
            }
        }

        public static function selectSingleWhere($fields, $table, $where,$value) {
            /**
             * Ejecuta una consulta SELECT en la base de datos y retorna un array con los datos obtenidos.
             *
             * @param array $fields  Array con los nombres de los campos a seleccionar (puede incluir '*').
             * @param string $table  Nombre de la tabla en la base de datos.
             * @param array $where  Array con las cláusulas WHERE y sus valores. Ejemplo: array('campo' => 'valor').
             * @return array  Array con los datos obtenidos de la consulta.
             */
            $db = new DBConn();
            $conn = $db->getConn();
            $col = implode(', ', $fields);
            $query = "SELECT $col FROM $table WHERE $where = '$value'";
            $result = $conn->query($query);
        
            if ($result->num_rows > 0) {
                $data = array();
        
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
        
                return $data;
            } else {
                return array(); // Si no hay resultados, retornamos un array vacío
            }
        }

        public static function newCat($value, $tableName) {
            /**
             * Función para insertar un valor en una tabla de la base de datos.
             *
             * @param string $value Valor a insertar
             * @param string $tableName Nombre de la tabla destino
             * @return int Código de respuesta (200 o 400)
             */
            $db = new DBConn(); // Conexión a la base de datos

            // Intentar realizar la inserción en la tabla
            $query = "INSERT INTO $tableName (modulo) VALUES ('$value')";
            $result = $db->getConn()->query($query);

            if ($result) {
                // Registro exitoso
                error_log("Registro insertado en $tableName: $value", 0); // Registrar en el log de Apache
                return 200; // Código de respuesta exitoso
            } else {
                // Error en la inserción
                error_log("Error al insertar en $tableName", 0); // Registrar en el log de Apache
                return 400; // Código de respuesta de error
            }
        }
        function updateCat($value, $where, $tableName) {
            /**
             * Función para actualizar un valor en una tabla de la base de datos.
             *
             * @param string $value Valor a actualizar
             * @param string $where Condición para determinar qué registros actualizar
             * @param string $tableName Nombre de la tabla destino
             * @return int Código de respuesta (200 o 400)
             */
            $db = new DBConn(); // Conexión a la base de datos
        
            // Intentar realizar la actualización en la tabla
            $query = "UPDATE $tableName SET modulo = '$value' WHERE id=$where";
            $result = $db->getConn()->query($query);
        
            if ($result) {
                // Actualización exitosa
                error_log("Registro actualizado en $tableName: $value", 0); // Registrar en el log de Apache
                return 200; // Código de respuesta exitoso
            } else {
                // Error en la actualización
                error_log("Error al actualizar en $tableName", 0); // Registrar en el log de Apache
                return 400; // Código de respuesta de error
            }
        }
        
    }

?>