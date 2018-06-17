<?php
session_start();
        include_once '../../datos/conexion.php';
	$cnn = new conexion();



	$id_usuario	= $_POST['id_usuario'];
	$passac	= $_POST['passac'];
	$idper         = $_POST['idper'];
	$usu            = $_POST['usu'];
	$pass         = $_POST['pass'];
	$idcar	= $_POST['idcar'];

        $rs = $cnn->ejecutar2("select * from glob_usuario where cUsuPass='$passac' and REPLACE(cUsuCod,0,'')='$id_usuario'");
        $row = mysqli_fetch_assoc($rs);
        if(count($row)==0){
             echo "La Contraseña no coincide con el usuario";
        }else{
            $rs = $cnn->ejecutar2("select * from glob_usuario where cUsuNom='$usu' and REPLACE(cUsuCod,0,'')<>'$id_usuario'");
            $row = mysqli_fetch_assoc($rs);
            if(count($row)>0){
                        echo "Ya hay un usuario con ese nombre";
            }else{
            $rs = $cnn->ejecutar("update glob_usuario set cUsuNom='$usu',cUsuPass='$pass',CUSUROL='$idcar' where REPLACE(cUsuCod,0,'')='$id_usuario'");
               if($rs)
               {
                  echo "1";
               }else{
               echo $rs;
               }

           }

        }





?>
