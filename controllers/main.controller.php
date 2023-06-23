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
           // $adminLogged = $_SESSION['admin_logged'] ?? false;
           // echo($adminLogged);
           // if ($adminLogged) {
                include '../views/pages/admin.php';
           // } else {
           //     include '../views/pages/login.html';
           // }
        }
        public static function loadCategories(){
            require_once '../models/DBQ.php';
            $dbq = new DBQ();
            $data = $dbq->selectStuff(["*"], "video_categories");
            if (count($data) == 0) {
                return '<span class="w-100 text-muted">No hay datos</span>';
            } else {
                $htmlString = '';
                $isChecked = ''; // Variable para controlar el elemento marcado
                foreach ($data as $index => $item) {
                    if ($_POST['cat'] == $item["id"]) {
                        $isChecked = ' checked';
                    } elseif ($_POST['cat'] == '' && $index === 0) {
                        $isChecked = ' checked';
                    } else {
                        $isChecked = '';
                    }
                    $htmlString .= '<div class="form-check p-0">
                                        <input type="radio" class="btn-check" name="cat" id="radio-' . $item["id"] . '" value="' . $item["id"] . '"' . $isChecked . '>
                                        <label class="btn btn-sm btn-outline-primary w-100 ' . ((isset($_GET["cat"]) && $_GET["cat"] == $item["id"]) ? "checked" : "") . '" for="radio-' . $item["id"] . '">' . $item["modulo"] . '</label>
                                    </div>';
                }
                return $htmlString;
            }
        }
        
        public static function loadCatVideos($cat){
            if ($cat != "") {
                require_once '../models/DBQ.php';
                $dbq = new DBQ();
                $data = $dbq->selectSingleWhere(["videoCode", "videoTitle"], "videos","seccionId", $cat);
                if (count($data) == 0) {
                    return '<span class="w-100 text-muted">No hay videos agregados</span>';
                } else {
                    $htmlString = '';
                    foreach ($data as $index => $item) {
                        $isChecked = ($index === 0) ? ' checked' : '';
                        $htmlString .= '<div class="form-check">
                                            <input type="radio" class="btn-check" name="video" id="radio-' . $item["videoCode"] . '" value="' . $item["videoCode"] . '"' . $isChecked . '>
                                            <label class="btn btn-sm btn-outline-primary w-100" for="radio-' . $item["videoCode"] . '">' . $item["videoTitle"] . '</label>
                                        </div>';
                    }
                    return $htmlString;
                }
            } else {
                return "<span class='text-center text-muted'>Seleccione Categoria de lista</span>";
            }
        }
              
    }
?>
