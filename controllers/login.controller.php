<?php
    session_start();
    require_once '../config/conn.php';


    if($_SERVER['REQUEST_METHOD']==='POST'){
        $username=$_POST['username'];
        $password=$_POST['password'];

        $dbConn=new DBConn();
        $conn=$dbConn->getConn();
        $query = "select count(*) as count from users where username=? and password = ?";
        $statement= $conn->prepare($query);
        $statement->bind_param("ss",$username,$password);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result-> fetch_assoc();

        if($row['count']==1){
            $_SESSION['admin_logged']=true;
            
            //var_dump($_SESSION['admin_logged']);
            header("Location: ../public/index.php?pag=admin");
        }else{
            echo "credenciales invalidas";
        }
    }
?>