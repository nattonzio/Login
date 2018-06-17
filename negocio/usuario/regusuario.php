<?php
session_start();
        include_once '../../datos/conexion.php';
	$cnn = new conexion();

//	$idper         = $_POST['idper'];
	$usu            = $_POST['usu'];
	$pass         = $_POST['pass'];
	$idcar	= $_POST['idcar'];


         $rs = $cnn->ejecutar2("select * from glob_usuario where cUsuNom='$usu'");
         $var = ("select * from glob_usuario where cUsuNom='$usu'");
       $row = mysqli_fetch_assoc($rs);
	if(count($row)>0){
		     echo "Ya hay un usuario con ese nombre";
         echo $var;
	}else{
    $rs2 = $cnn->ejecutar2("select REPLACE(max(cUsuCod),0,'') cUsuCod  from glob_usuario where cUsuEstado=1");
    $row2 = mysqli_fetch_assoc($rs2);
    $nCod = $row2['cUsuCod'] + 1;
      //    $rs = $cnn->ejecutar("insert into glob_usuario (cUsuCod,cUsuNom,cUsuPass,cUsuEstado,cEmpCod) values ('$nCod','$usu','$pass',1,'$idper')");
            $rs = $cnn->ejecutar("insert into glob_usuario (cUsuCod,cUsuNom,cUsuPass,cUsuEstado) values ('$nCod','$usu','$pass',1)");
            if($rs)
            {
               echo "1";
            }else{
            echo $rs;
            }

	}


?>
