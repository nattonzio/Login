<?php
session_start();
        include_once '../../datos/conexion.php';
	$cnn = new conexion();

	$id_cargo	= $_POST['id_cargo'];

        $rs = $cnn->ejecutar("delete from glob_constante where nConsValor='$id_cargo'");

            if($rs)
            {
               echo "1";
            }else{
            echo $rs;
            }
?>
