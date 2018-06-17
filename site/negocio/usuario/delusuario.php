<?php
session_start();
        include_once '../../datos/conexion.php';
	$cnn = new conexion();

	$id_usuario	= $_POST['id_usuario'];

        $rs = $cnn->ejecutar("update glob_usuario set cUsuEstado=0 where REPLACE(cUsuCod,0,'')='$id_usuario'");

            if($rs)
            {
               echo "1";
            }else{
            echo $rs;
            }
?>
