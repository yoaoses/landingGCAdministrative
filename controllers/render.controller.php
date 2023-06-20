<?php
    class RenderContent{

        public static function views(){
            $page=isset($_GET['pag'])?$_GET['pag']:'home';
            switch($page){
                case 'landing':
                    LandingController::landing();
                    break;
                case 'tutorials':
                    LandingController::tutorials();
                    break;
                case 'docs':
                    LandingController::docs();
                    break;
                case 'contacts':
                    LandingController::contacts();
                    break;
                case 'admin':
                    LandingController::admin();
                    break;

                default:
                    LandingController::landing();
                    break;
            }
        }
        public static function redirectToAdmin(){
            LandingController::admin();
        }
    }
?>