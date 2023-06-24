<?php
    class RenderContent{

        public static function views(){
            if(isset($_GET['pag'])){
                $page=$_GET['pag'];
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
                    case 'closeSession':
                        LandingController::closeSession();
                        break;
                    case 'addNewCategory':
                        $value=isset($_POST['catNameInput'])?$_POST['catNameInput']:'';
                        ModalController::addNewCat('['.$Value.']','video_categories');
                        break;
                }
            }else if(isset ($_POST['cat'])){
                $cat=$_POST['cat'];
                LandingController::loadCatVideos($cat);
            }else{
                LandingController::landing();
            }
        }
        
    }
?>