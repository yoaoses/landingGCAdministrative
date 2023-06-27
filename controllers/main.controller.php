<?php 
    class LandingController{

        public static function index(){
            include '../views/layouts/app.php';
        }
        public static function landing(/*userId */ ){
            //cargarmodulos asignados al usuario
            include '../views/pages/home.php';
        }
        public static function tutorials(/*userId */ ){
            //cargartutoriales de modulos asignados al usuario
            include '../views/pages/tutorials.php';
        }
        public static function docs( ){
            //obtener archivos del directorio
            include '../views/pages/documentation.php';
        }
        public static function contacts(/*userId */ ){
            //cargaren select lista de contactos disponibles
            include '../views/pages/contacts.php';
        }
        public static function admin() {
            $adminLogged = $_SESSION['admin_logged'] ?? false;
            //echo($adminLogged);
            if ($adminLogged) {
                include '../views/pages/admin.php';
            } else {
                include '../views/pages/login.html';
            }
        }
        public static function closeSession(){
            session_destroy();
            include '../views/pages/home.php';
        }
        public static function loadCategories($output){
            require_once '../models/DBQ.php';
            $dbq = new DBQ();
            $data = $dbq->selectStuff(["*"], "video_categories");
            if (count($data) == 0) {
                return '<span class="w-100 text-muted">No hay datos</span>';
            } else {
                if($output=="radios"){
                    $htmlString = '';
                    $isChecked = ''; // Variable para controlar el elemento marcado
                    foreach ($data as $index => $item) {
                        if (isset($_POST['cat']) && $_POST['cat'] == $item["id"]) {
                            $isChecked = ' checked';
                        } elseif (empty($_POST['cat']) && $index === 0) {
                            $isChecked = ' checked';
                        } else {
                            $isChecked = '';
                        }
                        $radioButtonName = 'cat'; // Nombre común para todos los radio buttons
                        $htmlString .= '<div class="form-check p-0">
                                            <input type="radio" class="btn-check catRadio" name="' . $radioButtonName . '" id="radio_' . $item["id"] . '" value="' . $item["id"] . '"' . $isChecked . '>
                                            <label class="btn btn-sm btn-outline-primary w-100 ' . ((isset($_GET["cat"]) && $_GET["cat"] == $item["id"]) ? "checked" : "") . '" for="radio_' . $item["id"] . '">' . $item["modulo"] . '</label>
                                        </div>';
                    }                
                    return $htmlString;
                }else{
                    $htmlString = '';
                    $selectedValue = ''; // Variable para controlar el valor seleccionado
                    foreach ($data as $index => $item) {
                        if (isset($_POST['cat']) && $_POST['cat'] == $item["id"]) {
                            $selectedValue = 'selected';
                        } elseif (empty($_POST['cat']) && $index === 0) {
                            $selectedValue = 'selected';
                        } else {
                            $selectedValue = '';
                        }
                        $htmlString .= '<option value="' . $item["id"] . '" ' . $selectedValue . '>' . $item["modulo"] . '</option>';
                    }
                    return $htmlString;
                }
            }
        } 
        public static function loadCatVideos($cat){
            if ($cat != "") {
                require_once '../models/DBQ.php';
                $dbq = new DBQ();
                $data = $dbq->selectSingleWhere(["recordId","videoCode", "videoTitle"], "videos","seccionId", $cat);
                if (count($data) == 0) {
                    return '<span class="w-100 text-muted">No hay videos agregados</span>';
                } else {
                    $htmlString = '';
                    foreach ($data as $index => $item) {
                        $isChecked = ($index === 0) ? ' checked' : '';
                        $htmlString .= '<div class="form-check p-0">
                                            <input type="radio" class="videoRadio btn-check" name="video" id="videoRadio_' . $item["recordId"] . '" value="' . $item["videoCode"] . '"' . $isChecked . '>
                                            <label class="btn btn-sm btn-outline-primary w-100" for="videoRadio_' . $item["recordId"] . '">' . $item["videoTitle"] . '</label>
                                        </div>';
                    }
                    return $htmlString;
                }
            } else {
                return "<span class='text-center text-muted'>Seleccione Categoria de lista</span>";
            }
        }
        public static function newCat($newCatName){
                /**
                 * Recibe datos para enviarlos al controlador de base de datos.
                 * $incomingValue = nombre de nueva categoría.
                 * $table = tabla objetivo.
                 * @return array Respuesta de la operación (éxito o error).
                 */
                error_log("addNewCat gets=> incommingValue:".$newCatName);
                require_once '../models/DBQ.php';
                $dbq = new DBQ();
                $status = $dbq->newCat($newCatName, "video_categories");
                error_log("addNewCat=>".$status);
                return $status;
        }
        public static function updateCat($catName,$where){
            /**
             * Recibe datos para enviarlos al controlador de base de datos.
             * $incomingValue = nombre de nueva categoría.
             * $table = tabla objetivo.
             * @return array Respuesta de la operación (éxito o error).
             */
            error_log("addNewCat gets=> incommingValue:".$catName);
            require_once '../models/DBQ.php';
            $dbq = new DBQ();
            $status = $dbq->updateCat($catName,$where, "video_categories");
            error_log("addNewCat=>".$status);
            return $status;
        }
        public static function newVideo($category,$code,$title){
            error_log("newVideoFunction recieves=>".$category.",".$code.",".$title);
            require_once '../models/DBQ.php';
            $dbq = new DBQ();
            $status = $dbq->addVideo($category,$code,$title);
            return $status;
        }  
        public static function updateVideo($recordId,$catId,$videoDir,$videoName){
            error_log("updateVideoFunction(LandingController) recieves=>".$recordId.",".$catId.",".$videoDir.",".$videoName);
            require_once '../models/DBQ.php';
            $dbq = new DBQ();
            $status = $dbq->updateVideo($recordId,$catId,$videoDir,$videoName);
            return $status;
        }    
    }
?>
