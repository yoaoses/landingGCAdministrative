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
            echo($adminLogged);
            if ($adminLogged) {
                include '../views/pages/admin.php';
            } else {
                include '../views/pages/login.html';
            }
        }
    }
?>
