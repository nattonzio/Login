<?php
    include_once("../../datos/conexion.php");
    $mysql = new conexion();

    session_start();
    $usuario 	= $_POST['Nombre'];
    $contrasenia = $_POST['Contrasena'];


/*    $rs    = $mysql->ejecutar2("select us.id_usuario,pe.id_persona,pe.num_doc,pe.Nombre,
        pe.Apellido,tu.nombre as 'tipo' from usuario us
        inner join persona pe on us.id_persona=pe.id_persona
        inner join tipousuario tu on us.id_tipo=tu.id_tipo
        WHERE us.usuario = '$usuario' AND us.password = '$contrasenia'"); */
    $rs = $mysql->ejecutar2("select us.cUsuCod,pe.cPerNom,pe.cPerApe,co.cConsDesc,us.cUsuEstado,us.cUsuRol,co.cConsDesc
                                  from pla_empleado em
		                              inner join glob_usuario us on us.cEmpCod=em.cEmpCod
                                  inner join glob_persona pe on pe.cPerCod=em.cPerCod
                                  inner join glob_constante co on co.nConsValor=us.cUsuRol
                                  where us.cUsuNom = '$usuario' and us.cUsuPass = '$contrasenia'");

    $row = mysqli_fetch_assoc($rs);

    $_SESSION['eEstado'] = $row['cUsuEstado'];

    if (count($row)>0){
        if ($_SESSION['eEstado']=='1') {
          $_SESSION['Auth.UsuarioID'] = $row['cUsuCod'];
          $_SESSION['IdUsuario'] = $row['cUsuCod'];
          $_SESSION['eNombres'] = $row['cPerNom'];
          $_SESSION['eApellido'] = $row['cPerApe'];
          $_SESSION['eCargo'] = $row['cConsDesc'];
          $_SESSION['UltimoIngreso'] = date("Y-n-j H:i:s");
          echo "ok";
        }else{
          echo "Usuario Bloqueado";
        }
    }else{
      if (empty($_SESSION['Intento'])) {
        $_SESSION['Intento'] = 0;
      }
      if ($_SESSION['Intento'] >= 3) {
        $rs2 = $mysql->ejecutar2("update glob_usuario set cUsuEstado=0 where cUsuNom= '$usuario'");
        echo "Usuario Bloquedado";
        print_r($_SESSION['Intento']);
        if ($_SESSION['Intento']==3) {
          $_SESSION['Intento']=0;
        }
      }else{
          $_SESSION['Intento'] += 1;
          $Intentos = 4 - $_SESSION['Intento'];
        echo "ERROR - Usuario no valido, verificar su Usuario y/o Clave ". $Intentos  ." Intentos";
      }
    }
?>
