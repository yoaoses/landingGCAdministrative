<?php
    require_once '../models/DBQ.php';

    class videoModalController{

        public static function getCats(){
            $dbq = new DBQ();
            $data = $dbq->selectStuff(["*"], "video_categories");
            if (count($data) == 0) {
                return '<span class="w-100 text-muted">No hay datos</span>';
            } else {
                if(count($data) == 0) {
                    return '<option selected>No hay Categorías Agregar Nueva--></option>';
                } else {
                    $options = '<option selected>Listado Categorías</option>';
                    foreach($data as $index => $item) {
                        $options .= "<option value=\"" . $item['id'] . "\">" . $item['modulo'] . "</option>";
                    }
                    return $options;
                }
            }
        }
        public static function addNewCat($incommingValue, $table) {
            /**
             * Recibe datos para enviarlos al controlador de base de datos.
             * $incomingValue = nombre de nueva categoría.
             * $table = tabla objetivo.
             * @return array Respuesta de la operación (éxito o error).
             */
            error_log("addNewCat gets=> incommingValue:".$incommingValue."table:".$table);
            require_once '../models/DBQ.php';
            $dbq = new DBQ();
            $status = $dbq->insertRecords([$incommingValue], $table);
            error_log("addNewCat=>".$status);
            if ($status) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'error'];
            }
        }
    }    
?>