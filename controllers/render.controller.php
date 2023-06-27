<?php
    class RenderContent{

        public static function views(){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if(isset($_GET['pag'])){
                    $page=$_GET['pag'];
                    error_log("Se està entrando a paginas");
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
                    }
                }
            }else{
                if(isset ($_POST['cat'])){
                    $cat=$_POST['cat'];
                    LandingController::admin();
                    LandingController::loadCatVideos($cat);
                    

                }else if(isset($_POST['formName'])){
                    error_log("se ha ingresado a post de formualrio modo categoria=>".$_POST['formName']);
                    switch($_POST['formName']){
                        case "addCat":
                            error_log("Se ha ingresado a addCat");
                            if(isset($_POST['catNameInput'])){
                                $newCatName=$_POST['catNameInput'];
                                if(LandingController::newCat($newCatName)==200){
                                    LandingController::admin();
                                }else{
                                    error_log("Error 400");
                                }
                            }
                            break;
                        case "updateCat":
                            error_log("Se ha ingresado a upDateCat");
                            if(isset($_POST['catNameInput'])){
                                $catName=$_POST['catNameInput'];
                                $catId=$_POST['catIdInput'];
                                if(LandingController::updateCat($catName,$catId)==200){
                                    LandingController::admin();
                                }else{
                                    error_log("Error 400");
                                }
                            }
                            break;
                        case "addVideo":
                            error_log("Se Ha ingresado a addVideo");
                            LandingController::admin();
                            break;
                        case "updateVideo":
                            error_log("Se Ha ingresado a updateVideo");
                            LandingController::admin();
                            break;
                    }
                }else{
                    error_log("no se ha podido obtener la vista");
                    LandingController::landing();
                }
            }
        }
        
    }
?>