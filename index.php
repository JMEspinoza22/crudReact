<?php

    include 'bd/bd.php';

    //RECIBIR PETICIONES DE CUALQUIER URL -----

    header('Access-Control-Allow-Origin: *');

    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id'])){
            $query="SELECT * FROM frameworks WHERE id=".$_GET['id'];
            $resultado = metodoGet($query);
            echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
        }else{
            $query="select * from frameworks";
            $resultado=metodoGet($query);
            echo json_encode($resultado->fetchAll());
        }

        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='POST'){
        unset($_POST['METHOD']);
        $nombre = $_POST['nombre'];
        $lanzamiento = $_POST['lanzamiento'];
        $desarrollador = $_POST['desarrollador'];
        $query="insert into frameworks(nombre, lanzamiento, desarrollador) values ('$nombre', '$lanzamiento', '$desarrollador')";
        $queryAutoIncrement="select MAX(id) as id from frameworks";
        $resultado=metodoPost($query, $queryAutoIncrement);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='PUT'){
        unset($_POST['METHOD']);
        $id=$_GET['id'];
        $nombre = $_POST['nombre'];
        $lanzamiento = $_POST['lanzamiento'];
        $desarrollador = $_POST['desarrollador'];
        $query="UPDATE frameworks set nombre='$nombre' lanzamiento='$lanzamiento' desarrollador='$desarrollador' where id='$id'";
        $resultado=metodoPUT($query, $queryAutoIncrement);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='DELETE'){
        unset($_POST['METHOD']);
        $id=$_GET['id'];
        $query="DELETE FROM frameworks where id='$id'";
        $resultado=metodoDelete($query, $queryAutoIncrement);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    header("HTTP/1.1 400 Bad Request");

?>