<?php
session_start();
        include_once '../../datos/conexion.php';
	$cnn = new conexion();

	$id_cargo	= $_POST['id_cargo'];
	$descripcion	= $_POST['descripcion'];

        $rs = $cnn->ejecutar("select * from glob_constante where cConsDesc='$descripcion' and nConsValor<>'$id_cargo'");
       $row = mysqli_fetch_assoc($rs);
	if(count($row)>0){
		     echo "Ya hay un Cargo con ese nombre";
	}else{
        $rs = $cnn->ejecutar("update glob_constante set  cConsDesc='$descripcion' where nConsValor='$id_cargo'");
            if($rs)
            {
               echo "1";
            }else{
            echo $rs;
            }

	}


?>
