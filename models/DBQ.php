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
        public static function insertRecords($incommingValues, $table) {
            /**
             * Ejecuta una consulta insert en la base de datos y devuelve el estado.
             *
             * @param array $incommingValues Valores a ingresar.
             * @param string $table Nombre de la tabla en la base de datos.
             * @return bool Estado de la operación de inserción (true si es exitosa, false si hay error).
             */
            $db = new DBConn();
            $conn = $db->getConn();
            $query = "INSERT INTO $table VALUES ";
            $values = [];
        
            foreach($incommingValues as $record){
                $values[] = '(' . $record . ')';
            }
        
            $query .= implode(',', $values);
        
            $result = $conn->query($query);
            
            error_log("Inserción de  nueva categoria, result=>".$result);
            return $result;
        }
        
    }

?>