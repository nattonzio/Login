<?php
session_start();
        include_once '../../datos/conexion.php';
	$cnn = new conexion();

	$descripcion	= $_POST['descripcion'];

        $rs = $cnn->ejecutar2("select nConsValor,cConsDesc from glob_constante where cConsDesc='$descripcion' and nConsGrupo=1001 and nConsValor not in(1001)");
       $row = mysqli_fetch_assoc($rs);
	if(count($row)>0){
		     echo "Ya hay un Cargo con ese nombre";
	}else{
        $rs2 = $cnn->ejecutar2("select max(nConsValor) nConsValor from glob_constante where nConsGrupo=1001 and nconsvalor not in(1001)");
        $row2 = mysqli_fetch_assoc($rs2);
        $nCod = $row2['nConsValor'] + 1;
        $rs = $cnn->ejecutar("insert into glob_constante (nConsGrupo,nConsValor,cConsDesc) values (1001,'$nCod','$descripcion')");
            if($rs)
            {
               echo "1";
            }else{
            echo $rs;
            }

	}


?>
